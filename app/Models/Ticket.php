<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_no',
        'type',
        'status',
        'priority',
        'description',
        'email_reported_by'
    ];

    // ? Manipulate data => change date format
    protected $casts = [
        'created_at' => 'date:d/m/Y',
        'updated_at' => 'date:d/m/Y'
    ];


    // ? Includes specific value from different table, so no need inlcude refs in controller
    protected $appends = ['type_val', 'status_val', 'priority_val'];

    // ? Hide any data
    protected $hidden = ['typeRef','created_at'];


    protected static function boot()
    {
        // ? This will auto generate a ticket number
        parent::boot();
        static::creating(function ($model) {
            $model->ticket_no = "TICKET/" . time();
        });
    }

    // * Setup relation
    public function typeRef()
    {
        return $this->hasOne(Reference::class, 'id', 'type');
    }

    public function statusRef()
    {
        return $this->hasOne(Reference::class, 'id', 'status');

    }
    public function priorityRef()
    {
        return $this->hasOne(Reference::class, 'id', 'priority');
    }



    // ? Includes specific value from different table, so no need inlcude refs in controller
    public function getTypeValAttribute()
    {
        return empty($this->typeRef->value) ? '' : $this->typeRef->value;
    }
    public function getStatusValAttribute()
    {
        return empty($this->statusRef->value) ? '' : $this->statusRef->value;

    }
    public function getPriorityValAttribute()
    {
        return empty($this->priorityRef->value) ? '' : $this->priorityRef->value;
    }

}