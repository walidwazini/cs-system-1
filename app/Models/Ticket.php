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

    protected static function boot()
    {
        // ? This will auto generate a ticket number
        parent::boot();
        static::creating(function ($model) {
            $model->ticket_no = "TICKET/" . time();
        });
    }
}