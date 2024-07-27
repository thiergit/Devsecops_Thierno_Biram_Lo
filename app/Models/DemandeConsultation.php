<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeConsultation extends Model
{
    use HasFactory;
    protected $table = 'demandes_consultation';
    protected $fillable = [
        "medecin_id",
        "patient_id",
        "date", 
        "annuler",
        "valider", 
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }
}
