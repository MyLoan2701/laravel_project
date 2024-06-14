<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_post',
        'slug_post',
        'status_post',
        'content_post',
        'avatar_post',
        'author_post',
        'poster_post',
        'tag_post',
        'link_product_post',
        'view_post'
    ];

    protected $primaryKey = 'id_post';
    protected $table = 'post';

    public function type(): BelongsTo
    {
        return $this->belongsTo(TypePost::class, 'tag_post');
    }
}
