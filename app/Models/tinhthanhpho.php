<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tinhthanhpho extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_tp',
        'type_tp',
    ];

    protected $primaryKey = 'id_tp';
    protected $table = 'tinhthanhpho';
}
