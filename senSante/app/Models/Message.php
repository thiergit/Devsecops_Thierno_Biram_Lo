<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'message';

    protected $fillable = [
        'medecin_id', 
        'patient_id',
        'date',
        'heure',
        'message',
        'expediteur'
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

