<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'id_brand',
        'name_category',
        'status_category',
        'description_category',
        'img_category',
        'slug_category',
        'key_category'
    ];

    protected $primaryKey = 'id_category';
    protected $table = 'category';

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'id_category');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'id_brand');
    }
}
