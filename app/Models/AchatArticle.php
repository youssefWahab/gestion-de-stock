<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchatArticle extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_id',
        'demande_achat_id',
        'articleDemande',
        'quantite',
        'unite',
        'prix',
    ];
    public function demandeAchat()
    {
        return $this->belongsTo(DemandeAchat::class, 'demande_achat_id', 'id');
    }
}
