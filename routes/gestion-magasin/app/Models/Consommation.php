<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consommation extends Model
{
    use HasFactory;
    // protected $table = 'consommations';

    protected $primaryKey = 'numConsommation';
    // public $incrementing = false;

    protected $fillable = [
        'chantier',
        'article',
        'quantiteDemande',
        'quantiteConsomme',
        'unite',
        'coutUnitaire',
        'demande_achat_id',
        'numProduction',
    ];
    //  public function demandeAchat()
    // {
    //     return $this->belongsTo(DemandeAchat::class, 'NumbonCommande', 'NumbonCommande');
    // }

    public function production()
    {
        return $this->belongsTo(Production::class, 'numProduction');
    }
}
