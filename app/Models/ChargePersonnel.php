<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargePersonnel extends Model
{
    use HasFactory;
    // protected $table = 'charge_personnels';
    protected $fillable = ['numProduction','employe','role','heures_travail','cout_horaire'];

    public function production()
    {
        return $this->belongsTo(Production::class, 'numProduction', 'numProduction');
    }
}
