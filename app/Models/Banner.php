<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'name_banner',
        'img_banner',
        'status_banner',
        'description_banner',
    ];

    protected $primaryKey = 'id_banner';
    protected $table = 'banner';
}
