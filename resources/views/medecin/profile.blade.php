@push('styles')
<link rel="stylesheet" href="{{url('css/profile.css')}}">
@endpush

@extends('../medecin.app')
    
@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show w-100 mt-3" role="alert">
        <button type="button" class="close btn btn-success" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('success') }}
    </div> 
@endif
<form action="{{route('updateProfileM')}}" method="post">
    @csrf
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="{{url('images/user_logo.png')}}">
                    <span class="font-weight-bold">{{Auth::user()->prenom}}</span>
                    <span class="text-black-50">{{Auth::user()->nom}}</span>
                    <span> </span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Prénom</label>
                            <input type="text" class="form-control" value="{{Auth::user()->prenom}}" name="prenom">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Nom</label>
                            <input type="text" class="form-control" value="{{Auth::user()->nom}}" name="nom">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Date de Naissance</label>
                            <input type="date" class="form-control" value="{{Auth::user()->dateNaiss}}" name="dateNaiss">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Lieu de naissance</label>
                            <input type="text" class="form-control" value="{{Auth::user()->lieuNaiss}}" name="lieuNaiss">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Numéro de téléphone</label>
                            <input type="number" class="form-control" name="tel" value="{{Auth::user()->tel}}" placeholder="776400000">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Nom du Centre </label>
                            <input type="text" class="form-control" name="centre" value="{{Auth::user()->medecin->centre}}" placeholder="Hopitale Principale">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Specialite</label>
                            <input type="text" class="form-control" name="specialite" value="{{Auth::user()->medecin->specialite}}" placeholder="Neurochirurgie">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Annee d'optention du doctorat</label>
                            <input type="number" class="form-control" name="annee_doctorat" value="{{Auth::user()->medecin->annee_doctorat}}" placeholder="2008" min ="1825" max="2024">
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Enregistrer</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span class="border px-3 p-1 add-experience">
                            <i class="bx bx-error-alt"></i>&nbsp;Information de connexion</span>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <label class="labels">Email</label>
                        <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" disabled>
                    </div> 
                    <div class="col-md-12">
                        <label class="labels">Role</label>
                        <input type="text" class="form-control"  value="Medecin" disabled>                   
                    </div>
                    @if (Auth::user()->medecin && Auth::user()->medecin->admin)
                    <div class="col-md-12">
                            <label class="labels"><i class='bx bx-health'></i></label>
                            <input type='text' class='form-control' value='Administrateur' disabled>
                        </div>
                    @endif 
                    <br>
                    <div class="col-md-12">
                        <a class="btn btn-primary profile-button" href="{{route('updatePasswordM')}}">Modifier mot de passe</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection


