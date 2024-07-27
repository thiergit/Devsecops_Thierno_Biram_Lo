@push('styles')
<link rel="stylesheet" href="{{url('css/consultation.css')}}">
@endpush
@push('scripts')
<script src="{{ url('js/consultation.js')}}"></script>

@endpush
@extends('../medecin.app')
    
@section('content')
<div>
    <button id="btnConsultation1" class="consultation-btn">Consultations</button>
    <button id="btnConsultation2" class="consultation-btn">Demandes</button>
    <button id="btnConsultation3" class="consultation-btn">Historiques</button>
</div>


    <div id="consultation1" class="container">
        <h2>Mes consultations</h2>
        <ul class="responsive-table">
            <li class="table-header row">
                <div class="col col-4">Nom du medecin</div>
                <div class="col col-4">Date - Heure</div>
                <div class="col col-1">valider</div>
                <div class="col col-1">Annuler</div>
            </li>
            @foreach($consultations as $consultation)
                <li class="table-row row">
                    <div class="col col-4">{{$consultation->patient->user->nom}} {{$consultation->patient->user->nom}}</div>
                    <div class="col col-4">{{$consultation->date}} à {{$consultation->heure}}</div>
                    <div class="col col-1"> <a href="/medecin/consultation/valider/{{$consultation->id}}"><i class="btn btn-success bx bx-check"></i></a></div>
                    <div class="col col-1"> <a href="/medecin/consultation/annuler/{{$consultation->id}}"><i class="btn btn-danger bx bx-block"></i></a></div>
                </li>
            @endforeach
        </ul>
    </div>
    <div id="consultation2" class="container-fluid">
        <h2>Mes Demandes de consultations</h2>
        <ul class="responsive-table">
        <li class="table-header row">
            <div class="col col-3">Nom du Patient</div>
            <div class="col col-3">Date de demande</div>
            <div class="col col-5">Date et Heure du rendez vous</div>            
        </li>
        @foreach($demandes as $demande)
            <form action="{{route('validerDemandeM')}}" method="POST" class="table-row row" style="padding: 3%; margin-bottom: 3%;">
                @csrf
                <div class="col-3">
                    <span>{{$demande->patient->user->nom}} {{$demande->patient->user->prenom}}</span>
                </div>
                <div class="col-3">
                    <span>{{$demande->date}}</span>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <input type="date" name="date" class="form-control me-2" required>
                    <input type="time" name="heure" class="form-control me-2" required> 
                    <input type="hidden" name="idDemande" value="{{$demande->id}}">
                </div>
                <div class="col-1">
                    <button type="submit" class="btn btn-success" style="align-items: flex-end">
                        <i class="bx bx-check"></i>
                    </button>
                </div>
            </form>
        @endforeach
        </ul>
    </div> 
    <div id="consultation3" class="container-fluid">
        <h2>Historique des consultations</h2>
        <ul class="responsive-table ">
            <li class="table-header row">
                <div class="col col-4">Nom du médecin</div>
                <div class="col col-4">Date de consultation</div>
                <div class="col col-4">État de Consultation</div>
            </li>
            @foreach($historiqueConsultations as $historiqueConsultation)
                <li class="table-row row">
                    <div class="col col-4">{{$historiqueConsultation->patient->user->nom}} {{$historiqueConsultation->patient->user->prenom}}</div>
                    <div class="col col-4">{{$historiqueConsultation->date}}</div>
                    <div class="col col-4">{{$historiqueConsultation->annuler?"Annulée":"Validée"}}</div>
                </li>
            @endforeach
            @foreach($historiquesDemandes as $historiquesDemande)
                <li class="table-row row">
                    <div class="col col-4">{{$historiquesDemande->patient->user->nom}} {{$historiquesDemande->patient->user->prenom}}</div>
                    <div class="col col-4">{{$historiquesDemande->date}}</div>
                    <div class="col col-4">Annulée</div>
                </li>
            @endforeach
        </ul>
    </div>
      






@endsection