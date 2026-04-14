<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeAchat extends Model
{
    use HasFactory;

    protected $fillable = ['numFiche', 'numBonCommande', 'natureTravaux', 'atelier'];

    
    public function ficheCommande()
    {
        return $this->belongsTo(FicheCommande::class, 'numFiche', 'numFiche');
    }
    // old code 
    // public function fiches()
    // {
    //     return $this->hasMany(FicheCommande::class, 'demande_achat_id', 'numBonCommande');
    // }

    // public function articles()
    // {
    //     return $this->hasMany(AchatArticle::class, 'demande_achat_id', 'numBonCommande');
    // }

    public function productions()
    {
        return $this->hasMany(Production::class, 'numBonCommande', 'numBonCommande');
    }
    // public function consommations()
    // {
    //     return $this->hasMany(Consommation::class, 'NumbonCommande', 'NumbonCommande');
    // }
    // public function consommation()
    // {
    //     return $this->hasOne(Consommation::class, 'NumbonCommande', 'NumbonCommande');
    // }
    public function articles()
    {
        return $this->hasMany(AchatArticle::class, 'demande_achat_id', 'id');
    }
}
