@push('styles')
<link rel="stylesheet" href="{{url('css/medecins.css')}}">
@endpush
@push('scripts')
<script src="{{ url('js/medecins.js') }}"></script>
@endpush
@extends('../medecin.app')
    
@section('content')
<div class="search-box ">
    <form action="#" method="get">
        @csrf
        <button class="btn-search"><i class="bx bx-search"></i></button>
        <input type="text" class="input-search" placeholder="Type to Search...">
    </form>
</div>

<div class="container py-5">
    <div class="row text-center text-white">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4">Nos Médecins <br><i class='bx bx-health '></i></h1>
            <p class="lead mb-0">Voici les medecins avec lesquels vous pouvez directement discuter</p>
            
        </div>
    </div>
</div><!-- End -->

<div class="container">
    <div class="row text-center">

        <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
            
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{url('images/medecin1.png')}}" alt="" width="200"  class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Dr André Diouf</h5><span class="small text-uppercase text-muted">Neurochirurgien à l'Hopital Principale</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bx-comment-dots"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link rdv-link" ><i class="bx bx-health"></i></a></li>
                </ul>
            </div>
        </div><!-- End -->
        <div id="alertContainer" class="container mt-3"></div>


    </div>
</div>

@endsection