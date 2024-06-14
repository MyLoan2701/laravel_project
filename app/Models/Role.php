<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'name_role',
        'status_role',
        'description_role',
    ];

    protected $primaryKey = 'id_role';
    protected $table = 'role';

    public function admin(): BelongsToMany {
        return $this->belongsToMany(Admin::class);
    }
}
