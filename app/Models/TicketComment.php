<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','ticket_id','comment'];

    public function attachments() {
        return $this->hasMany(Attachment::class, 'parent_id','id')->where('parent_model',TicketComment::class);
    }

}
