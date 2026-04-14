<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheArticle extends Model
{
    use HasFactory;
    protected $fillable = [
    'fiche_numFiche',
    'articleDemande',
    'quantite',
    'unite',
    // 'prix',
];

    // public function fiche()
    // {
    //     return $this->belongsTo(FicheCommande::class, 'fiche_numFiche', 'numFiche');
    // }
    public function fiche()
    {
        return $this->belongsTo(FicheCommande::class, 'fiche_numFiche', 'numFiche');
    }
}
