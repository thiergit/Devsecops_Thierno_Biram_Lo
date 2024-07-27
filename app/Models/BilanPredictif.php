<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BilanPredictif extends Model
{
    use HasFactory;
    protected $table = 'bilanPredictif';
    protected $fillable = [
        "patient_id",
        "medecin_id",
        "abdo", 
        "nause",
        "fatigue", 
        "fievre", 
        "jaune", 
        "articulation", 
        "urine",
        "selle",
        "appetit", 
        "tete",
        "prediction",
        "resultat",
        "date",
    ];
}
