<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'name_coupon',
        'code_coupon',
        'type_coupon',
        'price_coupon',
        'limit_coupon',
        'limit_number_coupon',
        'date_coupon',
        'exp_date_coupon',
        'description_coupon',
        'status_coupon',
    ];

    protected $primaryKey = 'id_coupon';
    protected $table = 'coupon';
}
