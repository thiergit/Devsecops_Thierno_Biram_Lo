<?php

namespace App\Http\Controllers;

use App\Http\Requests\BilanRequest;
use App\Http\Requests\UpdateProfilePatient;
use App\Mail\UserMail;
use App\Models\BilanPredictif;
use App\Models\Consultation;
use App\Models\DemandeConsultation;
use App\Models\Medecin;
use App\Models\Message;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller
{
    public function sendMail($destinataire,  $subject, $titre, $messages){
        Mail::to($destinataire)->send(new UserMail($subject,$titre,$messages));
    }
    
    public function updateProfile(UpdateProfilePatient $request){
        $credentials = $request->validated();
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $user->nom = $credentials["nom"];
        $user->prenom = $credentials["prenom"];
        $user->dateNaiss = $credentials["dateNaiss"];
        $user->tel = $credentials["tel"];
        $user->lieuNaiss = $credentials["lieuNaiss"];
        $user->patient->adresse =  $credentials["adresse"];
        $user->patient->telUrgent =  $credentials["telUrgent"];
        $user->patient->codePostale =  $credentials["codePostale"];
        $user->patient->sexe =  $credentials["sexe"];
        $user->save();
        $user->patient->save();
        return redirect()->route('dashboard')->with('success', 'Vos information ont été modifié avec succés.');
    }

    public function listeMedecin(){
        $medecins = Medecin::whereHas('user', function ($query) {
            $query->where('activate', true);
        })->with('user')->get();
        
        return view('/patient/medecins', compact('medecins'));
    }
    public function demandeConsultation($id)
    {
        $redirect = "/patient/medecins";
        try{
            $medecin = Medecin::findOrFail($id);
            $patient = Auth::user()->patient;
            DemandeConsultation::create([
                "medecin_id" =>$medecin->id,
                "patient_id" =>$patient->id,
                "date"=> date('Y-m-d'),
            ]);
        }catch (ModelNotFoundException $e) {
            return redirect()->to($redirect)->with('erreur', 'Vous ne pouvez pas demander une consultation à ce medecin.');
        }
        $subject= "Nouvelle demande de Consultation";
        $titre="Vous avez reçu un nouvelle de demande de consultation";
        $messages=[
            "De la part de ". $patient->user->nom." ".$patient->user->prenom,
            "Allez vite traiter cette demande sur l'application !!!",
        ];
        $this->sendMail($medecin->user->email,  $subject, $titre, $messages);
        return redirect()->to($redirect)->with('success', 'Demande de consultation envoyée avec succès.');
    }
    public function listConsultation(){
        $patient = Auth::user()->patient;
        $demandes = DemandeConsultation::where('patient_id', $patient->id)
                                        ->where('annuler', false)
                                        ->where('valider', false)
                                        ->get();
        $historiquesDemandes = DemandeConsultation::where('patient_id', $patient->id)
                                        ->where('annuler', true)
                                        ->get();

        $consultations = Consultation::where('patient_id', $patient->id)
                                    ->where('annuler', false)
                                    ->where('valider', false)
                                    ->get();
        
        $historiqueConsultations =  Consultation::where('patient_id', $patient->id)
                                                ->where(function ($query) {
                                                    $query->where('valider', true)
                                                    ->orWhere('annuler', true);
                                                })->get();
        return view('/patient/consultation', [
            'demandes' => $demandes,
            'consultations'=>$consultations,
            'historiquesDemandes' => $historiquesDemandes,
            'historiqueConsultations' => $historiqueConsultations,
        ]);
    }
    public function annulerDemandeConsultation($id){
        $demande = DemandeConsultation::find($id);
        if ($demande && $demande->annuler == 0) {
            $demande->annuler = true;
            $demande->save();
        }
        $destinataire = $demande->medecin->user->email;
        $patient = $demande->patient->user->nom." ".$demande->patient->user->prenom;
        $subject= "Annulation de la demande de Consultation";
        $titre="Vous avez reçu une annulation d'une de demande de consultation";
        $messages=[
            "Cette annulationà été faite par ". $patient,
        ];
        $this->sendMail($destinataire,  $subject, $titre, $messages);
        return to_route('medecins.consultation');
    }

    public function annulerConsultation($id){
        $consultation = Consultation::findOrFail($id);
        $consultation->annuler = true;
        $consultation->valider = false;
        $consultation->save();
        $subject= "Annulation de la consultation";
        $titre="Votre consultation à été annulé.";
        $messages=[
            "Votre consultation du ".$consultation->date." à ".$consultation->heure,
            "Auprés de Dr. ".$consultation->patient->user->nom." ".$consultation->patient->user->prenom." a été annulé.",
            "Veuillez le contacter via la plateforme pour plus de détails.",
        ];
        $this->sendMail($consultation->medecin->user->email,$subject, $titre, $messages);
        return to_route('medecins.consultation');
    }

    public function chatView(){
        $user = Auth::user();
        $MedecinIds = Consultation::where('patient_id',$user->patient->id)
                    ->pluck('medecin_id')
                    ->unique();
        $medecins = Medecin::whereIn('id', $MedecinIds)->get();
        
        return view('patient.chat', [
            'medecins'=>$medecins,
        ]);
    }
    public function getConversations($medecinId){
        $patient = Auth::user()->patient;
        $conversations = Message::where('patient_id', $patient->id)
                                    ->Where('medecin_id',$medecinId)
                                    ->get();
        return response()->json($conversations);
    }
    
    public function sendMessage(Request $request){
        $user = Auth::user();
        $medecin_id = $request->input('medecin_id');
        $message = $request->input('message');
        $now = Carbon::now();
        $messageSend = Message::create([
            "patient_id"=> $user->patient->id,
            "medecin_id"=> $medecin_id,
            "expediteur"=>$user->patient->id,
            "message"=> $message,
            "date" => $now->toDateString(), 
            "heure" => $now->toTimeString(),
        ]);
        return response()->json($messageSend);
    }
    

}
