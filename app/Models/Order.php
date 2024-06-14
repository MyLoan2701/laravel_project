<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'id_client',
        'id_payment',
        'code_order',
        'email_order',
        'name_order',
        'status_order',
        'phone_order',
        'address_order',
        'code_coupon_order',
        'price_coupon_order',
        'fee_delivery_order',
        'total_order',
        'note_order',
        'note_a'
    ];

    protected $primaryKey = 'id_order';
    protected $table = 'order';

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'id_payment');
    }

    public function orderDetail(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'id_order');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

}
