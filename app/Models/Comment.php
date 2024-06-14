<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamp = false; // set time to false

    protected $fillable = [
        'name_comment',
        'status_comment',
        'content_comment',
        'email_comment',
        'id_product',
        'id_client',
        'id_admin',
        'rep_comment'
    ];

    protected $primaryKey = 'id_comment';
    protected $table = 'comment';
}
