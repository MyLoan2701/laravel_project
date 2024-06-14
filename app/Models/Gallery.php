<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_product',
        'name_gallery',
        'img_gallery',
        'status_gallery'
    ];

    protected $primaryKey = 'id_gallery';
    protected $table = 'gallery';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

}
