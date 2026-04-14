<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    // protected $fillable = ['article', 'chantier', 'quantite', 'entree', 'sortie', 'stockActuel'];
    protected $fillable = [
        'article',
        'chantier',
        'atelier',
        'unite',
        'sortie',
        'stockInitial',
        'minimum',
        'stockActuel',
    ];

    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
