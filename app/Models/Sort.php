<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sort extends Model
{
    use HasFactory;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'name_sort',
        'status_sort',
        'description_sort',
        'id_brand',
        'href_sort',
        'from_sort',
        'to_sort'
    ];

    protected $primaryKey = 'id_sort';
    protected $table = 'sort';

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'id_brand');
    }
}
