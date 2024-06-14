<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    
    public $timestamp = false; // set time to false

    protected $fillable = [
        'date_order_statistic',
        'sales_statistic',
        'profit_statistic',
        'quantity_statistic',
        'total_order_statistic',
    ];

    protected $primaryKey = 'id_statistic';
    protected $table = 'statistic';
}
