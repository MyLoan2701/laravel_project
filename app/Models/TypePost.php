<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePost extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_typePost',
        'slug_typePost',
        'status_typePost',
        'description_typePost',
    ];

    protected $primaryKey = 'id_typePost';
    protected $table = 'type_post';
}
