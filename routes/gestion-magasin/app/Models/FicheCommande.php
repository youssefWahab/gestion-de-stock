<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheCommande extends Model
{
    use HasFactory;
    protected $primaryKey = 'numFiche';
    public $incrementing = false;
    protected $fillable = ['numFiche','nomDemandeur', 'chantier', 'chefAtelier', 'atelier', 'dateCommande', 'articleDemande', 'photo', 'quantite', 'schemaPlan','description'];

    public function demandeAchats()
    {
        return $this->hasMany(DemandeAchat::class, 'numFiche', 'numFiche');
    }
    // public function demandeAchat()
    // {
    //     return $this->belongsTo(DemandeAchat::class, 'demande_achat_id', 'numBonCommande');
    // }
    public function articles()
    {
        return $this->hasMany(FicheArticle::class, 'fiche_numFiche', 'numFiche');
    }

}
