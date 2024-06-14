<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderDetail extends Model
{
    use HasFactory;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'id_order',
        'code_order',
        'id_product',
        'name_productD',
        'price_productD',
        'quantity'
    ];

    protected $primaryKey = 'id_orderDetail';
    protected $table = 'order_details';

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
