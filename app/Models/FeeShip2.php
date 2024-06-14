<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeeShip2 extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_tp',
        'price_fee'
    ];

    protected $primaryKey = 'id_fee';
    protected $table = 'fee_ship2';

    public function tinhthanhpho() : BelongsTo {
        return $this->belongsTo(tinhthanhpho::class, 'id_tp');
    }
}
