<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'id_client',
        'email_contact',
        'name_contact',
        'phone_contact',
        'status_contact',
        'subject_contact',
        'message_contact'
    ];

    protected $primaryKey = 'id_contact';
    protected $table = 'contact';
}
