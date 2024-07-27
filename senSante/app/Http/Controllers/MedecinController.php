<?php

namespace App\Http\Controllers;

use App\Http\Requests\addMedecinRequest;
use App\Http\Requests\UpdateProfileMedecin;
use App\Http\Requests\updateRoleMedecinRequest;
use App\Http\Requests\validerDemandeConsultationRequest;
use App\Mail\UserMail;
use App\Models\Consultation;
use App\Models\DemandeConsultation;
use App\Models\Medecin;
use App\Models\Message;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MedecinController extends Controller
{

    public function sendMail($destinataire,  $subject, $titre, $messages){
        Mail::to($destinataire)->send(new UserMail($subject,$titre,$messages));
    }
    

    public function updateProfile(UpdateProfileMedecin $request){
        $credentials = $request->validated();
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $user->nom = $credentials["nom"];
        $user->prenom = $credentials["prenom"];
        $user->dateNaiss = $credentials["dateNaiss"];
        $user->tel = $credentials["tel"];
        $user->lieuNaiss = $credentials["lieuNaiss"];
        $user->medecin->centre =  $credentials["centre"];
        $user->medecin->specialite =  $credentials["specialite"];
        $user->medecin->annee_doctorat =  $credentials["annee_doctorat"];
        $user->save();
        $user->medecin->save();
        return redirect()->route('dashboardM')->with('success', 'Vos information ont été modifié avec succés.');
    }
    public function addMedecin(addMedecinRequest $request){
        $credentials = $request->validated();
        $password = $this->generatePassword();
        $medecin = Auth::user()->medecin;
        if(!$medecin->admin){
            return redirect()->route('indexM')->with('yes_prediction', "Vous ne posséder pas l\'habilitation requis pour accéder à cette page.");
        }
        $user = User::create([
            'email'=>$credentials['email'],
            'password' => Hash::make($password), // Hachage du mot de passe
            'nom'=>$credentials['nom'],
            'prenom'=>$credentials['prenom'] ,
            'dateNaiss'=>$credentials['dateNaiss'],
            'lieuNaiss'=>$credentials['lieuNaiss'],
            'tel'=>$credentials['tel'],
        ]);
        Medecin::create([
            'user_id'=>$user->id,
            'centre'=>$credentials['centre'],
            'specialite'=>$credentials['specialite'],
            'annee_doctorat'=>$credentials['annee_doctorat'],
        ]);
        $destinataire = $user->email;
        $subject= "Ajout de nouveau médecin";
        $titre="Vous avez été ajouter en tant que nouveau médecin !";
        $messages=[
            "Votre ajout a été fait par l'Administrateur.",
            "vos identifiants de connection sont: ",
            "Login: ".$destinataire,
            "Mot de passe: ".$password,
            "Bienvenu sur l'application avec se privilége.",
        ];
        $this->sendMail($destinataire,  $subject, $titre, $messages);
        return redirect()->route('manageMedecin');
    }
    public function viewMedecin(){
        $medecin = Auth::user()->medecin;
        if($medecin->admin){
            return view("/medecin/addMedecin");
        }else{
            return redirect()->route('indexM')->with('yes_prediction', 'Vous ne posséder pas l\'habilitation requis pour accéder à cette page".');
        }
    }

    public function manageMedecin(){
        $medecin = Auth::user()->medecin;
        if(!$medecin->admin){
            return redirect()->route('indexM')->with('yes_prediction', 'Vous ne posséder pas l\'habilitation requis pour accéder à cette page".');
        }
        $allMedecins = Medecin::where('id','!=' ,$medecin->id)->get();
        return view("/medecin/manageMedecin", [
            "allMedecins"=>$allMedecins,
        ]);
    }
    public function updateRole(updateRoleMedecinRequest $request){
        if(!Auth::user()->medecin->admin){
            return redirect()->route('indexM')->with('yes_prediction', 'Vous ne posséder pas l\'habilitation requis pour accéder à cette page".');
        }
        $credentials = $request->validated();
        $id = $credentials["idMedecin"];
        $admin = $credentials["admin"];
        $medecin = Medecin::find($id);
        if($medecin->admin != $admin){
            $medecin->admin = $admin;
            $medecin->save();
            $role = $medecin->admin==0?"Medecin":"Administratrateur";
            $subject= "Modification des Roles";
            $titre="L'Administrateur à mis à jours vos rôle dans l'application";
            $messages=[
                "Votre rôle à été mis à jours.",
                "Vous êtes maintenant ".$role,
            ];
            $this->sendMail($medecin->user->email,  $subject, $titre, $messages);
        }
        return redirect()->route('manageMedecin');
    }
    public function blockedMedecin($id){
        if(!Auth::user()->medecin->admin){
            return redirect()->route('indexM')->with('yes_prediction', 'Vous ne posséder pas l\'habilitation requis pour accéder à cette page".');
        }
        $medecin = Medecin::find($id);
        if($medecin->user->activate){
            $medecin->user->activate = false;
            $medecin->user->save();
            $subject= "Blocage du compte";
            $titre="Votre Compte a été bloqué par l'Administrateur";
            $messages=[
                "Pour tout renseignement, veuillez vous rapproché de vos centre.",
            ];
            $this->sendMail($medecin->user->email,  $subject, $titre, $messages);
        }
        return redirect()->route('manageMedecin');
    }
    public function deblockedMedecin($id){
        if(!Auth::user()->medecin->admin){
            return redirect()->route('indexM')->with('yes_prediction', 'Vous ne posséder pas l\'habilitation requis pour accéder à cette page".');
        }
        $medecin = Medecin::find($id);
        if(!$medecin->user->activate){
            $medecin->user->activate = true;
            $medecin->user->save(); 

            $subject= "Déblocage du compte";
            $titre="Votre Compte a été débloqué par l'Administrateur";
            $messages=[
                "Pour tout renseignement, veuillez vous rapproché de vos centre.",
            ];
            $this->sendMail($medecin->user->email,  $subject, $titre, $messages);
        }
        return redirect()->route('manageMedecin');
    }

    public function listeConsultation(){
        $medecin = Auth::user()->medecin;
        $consultations = Consultation::where('medecin_id', $medecin->id)
                                        ->where('annuler', false)
                                        ->where('valider', false)
                                        ->get();

                                        
        $historiqueConsultations =  Consultation::where('medecin_id', $medecin->id)
                                                    ->where(function ($query) {
                                                        $query->where('valider', true)
                                                        ->orWhere('annuler', true);
                                                    })->get();
                                                    
        $demandes  = DemandeConsultation::where('medecin_id', $medecin->id)
                                            ->where('annuler', false)
                                            ->where('valider', false)
                                            ->get();

        $historiquesDemandes = DemandeConsultation::where('medecin_id', $medecin->id)
                                        ->where('annuler', true)
                                        ->get();
        //dd($demandes[0]->medecin->user->nom);
        return view('/medecin/consultation', [
            'demandes' => $demandes,
            'consultations' => $consultations,
            'historiquesDemandes' => $historiquesDemandes,
            'historiqueConsultations' => $historiqueConsultations,
        ]);
    }
  
    public function validerDemandeConsultation(validerDemandeConsultationRequest $request){
        $credentials = $request->validated();
        $medecin = Auth::user()->medecin;
        $demande = DemandeConsultation::findOrFail($credentials["idDemande"]);
        $consultation = Consultation::create([
            "medecin_id"=>$medecin->id,
            "patient_id"=>$demande->patient->id,
            "date"=>$credentials["date"],
            "heure"=>$credentials["heure"],
        ]);
        
        $subject= "Demande de Consultation accepté";
        $titre="La demande de consultation faite à été accepté";
        $messages=[
            "Votre demande de consultation faite le ".$demande->date,
            "Auprés de Dr. ".$medecin->user->nom." ".$medecin->user->prenom." a été accepté.",
            "Nous vous donnons rendez vous le ".$consultation->date." à ".$consultation->heure.".",
            "Lieu: ".$medecin->centre.".",
        ];
        $this->sendMail($demande->patient->user->email,$subject, $titre, $messages);
        $demande->delete();
        return to_route('consultationsM');
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
            "Auprés de Dr. ".$consultation->medecin->user->nom." ".$consultation->medecin->user->prenom." a été annulé.",
            "Veuillez le contacter via la plateforme pour plus de détails.",
        ];
        $this->sendMail($consultation->patient->user->email,$subject, $titre, $messages);
        return to_route('consultationsM');
    }
    public function validerConsultation($id){
        $consultation = Consultation::findOrFail($id);
        $consultation->annuler = false;
        $consultation->valider = true;
        $consultation->save();
        return to_route('consultationsM');
    }



    public function generatePassword()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $minLength = 7;
        $maxLength = 12;
        $length = random_int($minLength, $maxLength);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function chatView(){
        //$request->input('medecin_id');
        $user = Auth::user();
        $patientIds = Consultation::where('medecin_id',$user->medecin->id)
                    ->pluck('patient_id')
                    ->unique();
        $patients = Patient::whereIn('id', $patientIds)->get();
        
        return view('medecin.chat', [
            'patients'=>$patients,
        ]);
    }
    public function getConversations($patientId){
        $medecin = Auth::user()->medecin;
        $conversations = Message::where('patient_id', $patientId)
                                    ->Where('medecin_id',$medecin->id)
                                    ->get();
        return response()->json($conversations);
    }
    
    public function sendMessage(Request $request){
        $user = Auth::user();
        $patient_id = $request->input('patient_id');
        $message = $request->input('message');
        $now = Carbon::now();
        $messageSend = Message::create([
            "patient_id"=> $patient_id,
            "medecin_id"=> $user->medecin->id,
            "expediteur"=>$user->medecin->id,
            "message"=> $message,
            "date" => $now->toDateString(), 
            "heure" => $now->toTimeString(),
        ]);
        return response()->json($messageSend);
    }
}
