<?php

namespace App\Http\Controllers;

use App\Http\Requests\BilanRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Mail\UserMail;
use App\Models\BilanPredictif;
use App\Models\Consultation;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{    
    
    public function sendMail($destinataire,  $subject, $titre, $messages){
        Mail::to($destinataire)->send(new UserMail($subject,$titre,$messages));
    }
    
    public function connexion(LoginRequest $request){
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->activate){
                $request->session()->regenerate();
                if($user->medecin){
                    return redirect()->intended(route('indexM')); 
                }
                if($user->patient){
                    return redirect()->intended(route('index'));
                }                
            }else{
                return redirect()->route('connexion')->with('erreur', 'Votre compte n\'est pas activé !');
            }
        }
        return redirect()->route('connexion')->with('erreur', 'Email ou mot de passe incorrecte !');   
    }
        
 

    public function inscription(CreateUserRequest $request){
        $credentials = $request->validated();
        if(!$credentials['email']){
            return to_route('connexion')->withErrors([
                "email "=> "email existe "
            ])->onlyInput('message');
            
        }elseif(!$credentials['mdp']){
            return to_route('connexion')->withErrors([
                "mdp "=> "Mot de passe différent"
            ])->onlyInput('message');
        }

        $user = User::create([
            'email'=>$credentials['email'],
            'password' => Hash::make($credentials['mdp']), // Hachage du mot de passe
            'nom'=>$credentials['nom'],
            'prenom'=>$credentials['prenom'] ,
            'dateNaiss'=>$credentials['dateNaiss'],
            'lieuNaiss'=>$credentials['lieuNaiss'],
            'tel'=>$credentials['tel'],
        ]);
        
        Patient::create([
            'user_id'=>$user->id
        ]);

        $messages_mails = [
            "votre nom d'utilisateur est : ". $user->email,
            "veuillez activez votre compte via l'email ci-dessous",
            "localhost:8000/user/activation",
        ];
        $titre = "Bienvenue sur l'applicaton SenSante ou vous pourrez interragir directement avec vos médecins.";
        $subject = "Creation et Activation du compte";

        $this->sendMail($user->email,$subject, $titre,$messages_mails);
        return redirect()->route('connexion')->with('success', 'Votre compte à bien été créer. Veuillez l\'activer depuis votre boite mail !');
        ;
    }
    public function deconnexion(){
        Auth::logout();
        return to_route('connexion');
    }

    public function activationCompte(LoginRequest $request){
        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            return redirect()->route('activation')->with('erreur', 'Login ou mot de passe incorrecte.');
        } 
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        if($user->activate){
            return redirect()->route('connexion')->with('success', 'Votre Compte est déja activé !');   
        }
        $user->activate = true;
        $user->save();
        $request->session()->regenerate();
        if($user->medecin){
            return redirect()->route('indexM')->with('no_prediction', 'Votre compte à bien été activé');
        }
        if($user->patient){
            return redirect()->route('index')->with('no_prediction', 'Votre compte à bien été activé');
        }
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $credentials = $request->validated();
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $oldmdp = $credentials["oldmdp"];
        $newmdp = $credentials["newmdp"];
        $confnewmdp = $credentials["confnewmdp"];
        
        if ($newmdp !== $confnewmdp) {
            return redirect()->route('updatePassword')->with('error', 'Le nouveau mot de passe et la confirmation du mot de passe doivent être identique.');
        }
        if ($oldmdp===$newmdp) {
            return redirect()->route('updatePassword')->with('error', 'Votre Nouveau mot de passe doit être différent de l\'ancien.');
        }
        if (!Hash::check($oldmdp, $user->password)) {
            return redirect()->route('updatePassword')->with('error', 'Votre ancien mot de passe est incorrecte.');
        }
        if($user->medecin){
            $route = "dashboardM";
        }
        if($user->patient){
            $route = "dashboard";
        }    
        $user->password = Hash::make($newmdp);
        $user->save();
        return redirect()->route($route)->with('success', 'Votre mot de passe à été modifié avec succés.');    
    }
    private function transformToBoolean($value){
        return $value === 'oui' ? true : false;
    }
    public function addBilanPredictif(BilanRequest $bilanRequest){
        $credentials = $bilanRequest->validated();
        $user = Auth::user();
        $convertResponse = [
            "abdo" => $this->transformToBoolean($credentials["abdo"]),
            "nause" => $this->transformToBoolean($credentials["nause"]),
            "fatigue" => $this->transformToBoolean($credentials["fatigue"]),
            "fievre" => $this->transformToBoolean($credentials["fievre"]),
            "jaune" => $this->transformToBoolean($credentials["jaune"]),
            "articulation" => $this->transformToBoolean($credentials["articulation"]),
            "urine" => $this->transformToBoolean($credentials["urine"]),
            "selle" => $this->transformToBoolean($credentials["selle"]),
            "appetit" => $this->transformToBoolean($credentials["appetit"]),
            "tete" => $this->transformToBoolean($credentials["tete"]),
        ];
 
        $responseModel = false;
        BilanPredictif::create([
            "patient_id"=> $user->patient->id,
            "abdo"=> $convertResponse['abdo'],
            "nause"=> $convertResponse["nause"],
            "fatigue"=> $convertResponse["fatigue"],
            "fievre"=> $convertResponse["fievre"],
            "jaune"=> $convertResponse["jaune"],
            "articulation"=> $convertResponse["articulation"],
            "urine"=> $convertResponse["urine"],
            "selle"=> $convertResponse["selle"],
            "appetit"=> $convertResponse["appetit"],
            "tete"=> $convertResponse["tete"],
            "prediction"=> $responseModel,
            "date"=> date('Y-m-d'),
        ]);
        if($user->medecin){
            $route = "indexM";
        }elseif($user->patient){
            $route  = "index";
            $subject= "Résultat du questionnaire de ".$user->nom." ".$user->prenom;
            $titre="Voici les résultats de votre patient du questionnaire de ".$user->nom." ".$user->prenom;
            $messages = [];
            foreach ($convertResponse as $key => $value) {
                $result = $key . ";" . ($value ? "oui" : "non");
                $messages[] = $result;
            }

            $medecinIds = Consultation::where('patient_id',$user->patient->id)
                                            ->pluck('medecin_id')
                                            ->unique();
            $medecins = Medecin::whereIn('id', $medecinIds)->get();
            
            
            foreach ($medecins as $medecin) {
                $destinataire = $medecin->user->email;
                $this->sendMail($destinataire,  $subject, $titre, $messages);
            }

        }else{
            return redirect()->route('connexion')->with('erreur', 'Erreur de connexion');
        }


        if($responseModel){
            return redirect()->route($route)->with('yes_prediction', 'Veuillez prendre rendez-vous pour une consultation le plus vite possible !!!');
        }else{
            return redirect()->route($route)->with('no_prediction', 'Vos Symptomes ne sont pas préoccupant.');
        }
    }

}
