<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xaphuongthitran extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_xp',
        'type_xp',
        'id_qh'
    ];

    protected $primaryKey = 'id_xp';
    protected $table = 'xaphuongthitran';
}
