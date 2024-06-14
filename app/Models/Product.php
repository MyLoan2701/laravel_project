<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'id_category',
        'id_brand',
        'type_brand_product',
        'name_product',
        'price_product',
        'priceOld_product',
        'priceOrigin_product',
        'status_product',
        'description_product',
        'info_product',
        'img_product',
        'sale_product',
        'stock_product',
        'stock2_product',
        'sold_product',
        'release_product',
        'view_product'
    ];

    protected $primaryKey = 'id_product';
    protected $table = 'product';

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'id_brand');
    }
}
