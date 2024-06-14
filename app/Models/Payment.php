<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'method_payment',
        'status_payment',
        'description_payment',
    ];

    protected $primaryKey = 'id_payment';
    protected $table = 'payment';

    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'id_order');
    }
}
