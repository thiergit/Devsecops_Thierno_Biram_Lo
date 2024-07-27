@push('styles')
<link rel="stylesheet" href="{{url('css/consultation.css')}}">
@endpush
@push('scripts')
<script src="{{ url('js/consultation.js')}}"></script>

@endpush
@extends('../patient.app')
    
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
            <div class="col col-3">Nom du medecin</div>
            <div class="col col-4">Date - Heure</div>
            <div class="col col-4">Lieu</div>
            <div class="col col-1">Annuler</div>
        </li>
        @foreach($consultations as $consultation)
        <li class="table-row row">
            <div class="col col-3">{{$consultation->medecin->user->nom}} {{$consultation->medecin->user->prenom}}</div>
            <div class="col col-4">{{$consultation->date}} à {{$consultation->heure}}</div>
            <div class="col col-4">{{$consultation->medecin->centre}}</div>
            <div class="col col-1"> <a href="/patient/consultation/annuler/{{$consultation->id}}"><i class="btn btn-danger bx bx-block"></i></a></div>
        </li>
        @endforeach
        </ul>
    </div>
    <div id="consultation2" class="container">
        <h2>Mes Demandes de consultations</h2>
        <ul class="responsive-table">
        <li class="table-header row">
            <div class="col col-3">Nom du medecin</div>
            <div class="col col-4">Date de demande</div>
            <div class="col col-4">Lieu</div>
            <div class="col col-1">Annuler</div>
        </li>
        @foreach($demandes as $demande)
        <li class="table-row row">
            <div class="col col-3">{{$demande->medecin->user->nom}} {{$demande->medecin->user->prenom}}</div>
            <div class="col col-4">{{$demande->date}}</div>
            <div class="col col-4">{{$demande->medecin->centre}}</div>
            <div class="col col-1"> <a href="/demande-consultation/annuler/{{$demande->id}}"><i class="btn btn-danger bx bx-block"></i></a></div>
        </li>
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