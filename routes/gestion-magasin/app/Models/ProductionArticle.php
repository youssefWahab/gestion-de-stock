<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionArticle extends Model
{
    use HasFactory;
    protected $fillable = [
        'numProduction',
        'articleDemande',
        'quantite', 
        'unite',
        'prix',
    ];
    // public function production()
    // {
    //     return $this->belongsTo(Production::class, 'numProduction', 'numProduction');
    // }
    public function production()
    {
        return $this->belongsTo(Production::class, 'numProduction');
    }


    public function demandeAchat()
    {
        return $this->belongsTo(DemandeAchat::class, 'numBonCommande', 'numBonCommande');
    }
    
}
