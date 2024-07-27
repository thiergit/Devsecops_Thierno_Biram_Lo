<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function(){
    return view('user/connexion');
})->name("connexion");

Route::post('/',[ UserController::class, 'connexion']);
Route::post('inscription',[ UserController::class, 'inscription'])->name("inscription");
Route::delete('deconnexion',[ UserController::class, 'deconnexion'])->name("deconnexion");
Route::post('/addBilan', [UserController::class, 'addBilanPredictif'])->name("addBilan");
Route::get('/user/activation', function(){
    return view('user/activation');
})->name('activation');
Route::post('/user/activation', [UserController::class, 'activationCompte'])->name("activation");


//patient



Route::post('/patient/updateProfile', [PatientController::class, 'updateProfile'])->name("updateProfile");
Route::post('/patient/updatePassword', [UserController::class, 'updatePassword'])->name("updatePassword");

Route::get('/patient/index', function(){
    return view('patient/index');
})->name('index');


Route::get('/patient/profile', function(){
    return view('patient/profile');
})->name('dashboard');

Route::get('/patient/updatePassword', function(){
    return view('patient/updatePasseword');
})->name("updatePassword");

Route::get('/patient/chat', function(){
    return view('patient/chat');
})->name('chat');

Route::get('/medecin/chat',  [MedecinController::class, 'chatView'])->name('chatM');
Route::get('/medecin/chat/{patientId}', [MedecinController::class, 'getConversations']);
Route::post('/medecin/chat/send', [MedecinController::class, 'sendMessage']);


Route::get('/patient/chat',  [PatientController::class, 'chatView'])->name('chat');
Route::get('/patient/chat/{patientId}', [PatientController::class, 'getConversations']);
Route::post('/patient/chat/send', [PatientController::class, 'sendMessage']);

Route::get('/patient/medecins',  [PatientController::class, 'listeMedecin'])->name('medecins');

Route::get('/patient/medecins/consultation/',  [PatientController::class, 'listConsultation'])->name('medecins.consultation');
Route::get('/demande-consultation/annuler/{id}', [PatientController::class, 'annulerDemandeConsultation']);

Route::get('/demande-consultation/{id}', [PatientController::class, 'demandeConsultation']);
Route::get('/patient/consultation/annuler/{id}', [PatientController::class, 'annulerConsultation']);


Route::get('/patient/propos', function(){
    return view('patient/propos');
})->name('propos');

//Medecin

Route::get('/medecin/index', function(){
    return view('medecin/index');
})->name('indexM');

Route::post('/medecin/updateProfile', [MedecinController::class, 'updateProfile'])->name("updateProfileM");
Route::get('/medecin/consultation/valider/{id}', [MedecinController::class, 'validerConsultation']);
Route::get('/medecin/consultation/annuler/{id}', [MedecinController::class, 'annulerConsultation']);
Route::post('/demande-consultation/valider', [MedecinController::class, 'validerDemandeConsultation'])->name("validerDemandeM");


Route::get('/medecin/profile', function(){
    return view('medecin/profile');
})->name('dashboardM');

Route::get('/medecin/consultations',  [MedecinController::class, 'listeConsultation'])->name('consultationsM');


Route::post('/medecin/ajouter',  [MedecinController::class, 'addMedecin'])->name('addMedecin');
Route::get('/medecin/ajouter',  [MedecinController::class, 'viewMedecin'])->name('addMedecin');
Route::get('/medecin/manage',  [MedecinController::class, 'manageMedecin'])->name('manageMedecin');
Route::post('/medecin/updateRole',  [MedecinController::class, 'updateRole'])->name('updateRole');
Route::get('/medecin/manage/block/{id}',  [MedecinController::class, 'blockedMedecin']);
Route::get('/medecin/manage/deblock/{id}',  [MedecinController::class, 'deblockedMedecin']);


Route::get('/medecin/updatePassword', function(){
    return view('medecin/updatePasseword');
})->name("updatePasswordM");

Route::post('/medecin/updatePassword', [UserController::class, 'updatePassword'])->name("updatePasswordM");


Route::get('/medecin/medecins', function(){
    return view('medecin/medecins');
})->name('medecinsM');

Route::get('/medecin/consultation', function(){
    return view('medecin/consultation');
})->name('consultationM');
Route::get('/medecin/propos', function(){
    return view('medecin/propos');
})->name('proposM');


/*
//medecin
Route::middleware(['role:medecin'])->group(function () {
    Route::get('/medecin/dashboard', [MedecinController::class, 'dashboard'])->name('medecin.dashboard');
});
//patient
Route::middleware(['role:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
});


Route::get('/unauthorized', function () {
    return 'Unauthorized';
})->name('unauthorized');
*/



