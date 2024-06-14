<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_id_admin',
        'role_id_role'
    ];
    protected $primaryKey = 'id_admin_role';
 	protected $table = 'admin_role';
}
