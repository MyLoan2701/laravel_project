<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'email',
        'password',
        'name',
        'status',
        'phone',
        'address',
        'sex',
        'avatar',
    ];

    protected $primaryKey = 'id_client';
    protected $table = 'client';

    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'id_client');
    }
}
