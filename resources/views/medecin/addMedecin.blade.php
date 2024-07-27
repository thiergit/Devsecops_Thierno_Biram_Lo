@push('styles')
<link rel="stylesheet" href="{{url('css/addMedecin.css')}}">
@endpush
@push('scripts')
<script src="{{ url('js/addMedecin.js') }}"></script>

@endpush
@extends('../medecin.app')
    
@section('content')
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Ajouter un médecin</h3>
            <p class="blue-text">Cette page vous permet d'ajouter un médecin<br>Ce médecin pourra vous aider à gérer les patients.</p>
            <div class="card">
                @error('email')
                    <div class="alert alert-danger alert-dismissible fade show w-100 mt-3" role="alert">
                        {{$message }}
                    </div>
                @enderror

                <form class="form-card" action="{{route('addMedecin')}}" method="POST">
                    @csrf
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Nom<span class="text-danger"> *</span></label> 
                            <input type="text" id="fname" required name="nom"> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Prenom<span class="text-danger"> *</span></label> 
                            <input type="text" id="lname" required name="prenom"> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Date de naissance <span class="text-danger"> *</span></label> 
                            <input type="date" name="dateNaiss"  required> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Lieu de naissance<span class="text-danger"> *</span></label> 
                            <input type="text" name="lieuNaiss" required> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Centre ou lieu de travail <span class="text-danger"> *</span></label> 
                            <input type="text" name="centre"  required> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Specialité<span class="text-danger"> *</span></label> 
                            <input type="text" name="specialite" required> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Année d'obtention du diplome de spécialisation<span class="text-danger"> *</span></label> 
                            <input type="number" name="annee_doctorat" required> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Numéro de telephone <span class="text-danger"> *</span></label> 
                            <input type="number" name="tel"  required> 
                        </div>
                    </div>

                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 flex-column d-flex"> 
                            <label class="form-control-label px-3">Adesse email<span class="text-danger"> *</span></label> 
                            <input type="email" id="email" name="email" onblur="" required> </div>
                        </div>
                    <div class="row justify-content-end">
                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary">Ajouter</button> </div>
                    </div>
                </form>
            </div>
            <a href="{{ route('manageMedecin')}}" class="btn btn-danger">Retour</a>
        </div>
    </div>
</div>







@endsection