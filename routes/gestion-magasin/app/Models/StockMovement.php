<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;
    protected $casts = [
    'date_movement' => 'datetime',
    ];
    protected $fillable = [
        'stock_id',
        'type',
        'reference',
        'quantite',
        'date_movement',
        'note',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
