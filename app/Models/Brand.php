<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    public $timestamp = false; // set time to false

    protected $fillable = [
        'name_brand',
        'status_brand',
        'description_brand',
        'slug_brand',
        'key_brand',
        'parent_brand',
    ];

    protected $primaryKey = 'id_brand';
    protected $table = 'brand';
    
    public function category(): HasMany 
    {
        return $this->hasMany(Category::class, 'id_brand');

    }
}
