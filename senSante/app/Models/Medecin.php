<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medecin extends User
{
    use HasFactory;
    protected $table = 'medecins';

    protected $fillable = [
        'user_id', 
        'centre',
        'specialite',
        'annee_doctorat',
        'admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function demandesConsultation()
    {
        return $this->hasMany(DemandeConsultation::class, 'medecin_id');
    }
    public function Consultation()
    {
        return $this->hasMany(Consultation::class, 'medecin_id');
    }
    public function message()
    {
        return $this->hasMany(Message::class, 'message_id');
    }
   
}
