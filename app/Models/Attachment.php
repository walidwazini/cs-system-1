<?php

namespace App\Models;

use Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model {
    use HasFactory;

    public $table = 'attachments';

    protected $fillable = ['parent_model', 'parent_id', 'path'];

    protected $hidden = ['parent_model','parent_id','created_at','updated_at'];

    protected $appends = ['link'];

    public function getLinkAttribute() {
        return url("/storage/$this->path");
    }

    public static function put($files, $parent_id, $parent_model) {
        $attachments = [];

        foreach ($files as $key => $file) {
            $filename = rand() . '-' . $file->getClientOriginalName();

            $attachments[] = [
                'parent_id' => $parent_id,
                'parent_model' => $parent_model,
                'path' => $filename
            ];

            // ?  Update our storage in  app
            Storage::put("public/$filename", file_get_contents($file->getRealPath()));
        }

        // ?   Record the transaction in the database
        Attachment::insert($attachments);
        return $attachments;
    }
}