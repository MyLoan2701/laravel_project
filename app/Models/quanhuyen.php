<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quanhuyen extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_qh',
        'type_qh',
        'id_tp'
    ];

    protected $primaryKey = 'id_qh';
    protected $table = 'quanhuyen';
}
