<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends User
{
    use HasFactory;
    protected $table = 'patients';

    protected $fillable = [
        'user_id',
        'adresse',
        'telUrgent',
        'codePostale',
        'sexe',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function demandesConsultation()
    {
        return $this->hasMany(DemandeConsultation::class, 'patient_id');
    }
    public function Consultation()
    {
        return $this->hasMany(Consultation::class, 'patient_id');
    }
    public function message()
    {
        return $this->hasMany(Message::class, 'message_id');
    }
    
   
}
