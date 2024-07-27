@push('styles')
<link rel="stylesheet" href="{{url('css/medecins.css')}}">
@endpush
@push('scripts')
<script src="{{ url('js/medecins.js') }}"></script>
@endpush
@extends('../patient.app')
    
@section('content')
<div class="search-box ">
    <form action="#" method="get">
        @csrf
        <button class="btn-search"><i class="bx bx-search"></i></button>
        <input type="text" class="input-search" placeholder="Type to Search...">
    </form>
</div>
<a href="{{route('medecins.consultation')}}" class="btn btn-light consultation-count"><i class="bx bx-bookmark"></i>mes consultations</a>

<div class="container py-5">
    <div class="row text-center text-white">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4">Nos Médecins <br><i class='bx bx-health '></i></h1>
            <p class="lead mb-0">Voici les medecins avec lesquels vous pouvez directement discuter</p>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show w-100 fs-3 text-center" role="alert">
        {{ session('success') }}
    </div> 
    @endif
    @if(session('erreur'))
    <div class="alert alert-danger alert-dismissible fade show w-100 fs-3 text-center" role="alert">
        {{ session('erreur') }}
        </div> 
    @endif  
</div><!-- End -->

<div class="container">
    <div class="row text-center">
        <div id="alertContainer" class="container mt-3"></div>
        @foreach($medecins as $medecin)
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{url('images/medecin1.png')}}" alt="" width="200"  class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Dr. {{$medecin->user->nom}} {{$medecin->user->prenom}}</h5><span class="small text-uppercase text-muted">{{$medecin->specialite}}</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bx-comment-dots"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link rdv-link" data-id="{{ $medecin->id }}"><i class="bx bx-health"></i></a></li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection