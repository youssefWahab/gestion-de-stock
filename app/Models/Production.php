<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;
    protected $primaryKey = 'numProduction';
    protected $fillable = ['chantier', 'produitFinale', 'numBonTransfert', 'quantite', 'unite', 'coutReviens', ];
    // 'demande_achat_id'

    // public function demandeAchat()
    // {
    //     return $this->belongsTo(DemandeAchat::class, 'numBonCommande', 'numBonCommande');
    // }
    public function demandeAchat()
    {
        return $this->belongsTo(DemandeAchat::class, 'demande_achat_id');
    }

    public function articles()
    {
        return $this->hasMany(ProductionArticle::class, 'numProduction', 'numProduction');
    }
    public function chargesPersonnels()
    {
        return $this->hasMany(ChargePersonnel::class, 'numProduction', 'numProduction');
    }
    public function consommations()
    {
        return $this->hasMany(Consommation::class, 'numProduction');
    }
}
