<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeeShip extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_tp',
        'id_qh',
        'id_xp',
        'price_fee'
    ];

    protected $primaryKey = 'id_fee';
    protected $table = 'fee_ship';

    public function tinhthanhpho() : BelongsTo {
        return $this->belongsTo(tinhthanhpho::class, 'id_tp');
    }
    public function quanhuyen() : BelongsTo {
        return $this->belongsTo(quanhuyen::class, 'id_qh');
    }
    public function xaphuongthitran() : BelongsTo {
        return $this->belongsTo(xaphuongthitran::class, 'id_xp');
    }
}
