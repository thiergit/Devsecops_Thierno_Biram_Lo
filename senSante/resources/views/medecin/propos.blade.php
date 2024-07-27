
@push('styles')
    <link rel="stylesheet" href="{{url('css/propos.css')}}">
@endpush
@push('scripts')
    <script src="{{ url('js/propos.js') }}"></script>
@endpush

@extends('../medecin.app')

@section('content')
<div class="container-fluid bg-light py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 text-primary">À propos de Sensante</h1>
                <p class="lead text-muted mb-4">Nous sommes une jeune entreprise sénégalaise dédiée à rendre la santé accessible à tous. Avec notre application de e-santé, nous révolutionnons la façon dont les soins de santé sont dispensés, en les rendant plus accessibles, pratiques et abordables pour tout le monde.</p>
                <a href="#team" class="btn btn-primary btn-lg">Rencontrez notre équipe</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ url('images/myLogo.png') }}" class="img-fluid rounded shadow" alt="About Us">
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <h2 class="font-weight-light">Notre Vision</h2>
            <p class="text-muted">Chez Sensante, nous croyons en un monde où chaque individu, où qu'il se trouve, a accès à des soins de santé de qualité. Nous nous efforçons de réduire les barrières géographiques et économiques à l'accès aux soins de santé.</p>
        </div>
        <div class="col-lg-4">
            <h2 class="font-weight-light">Notre Mission</h2>
            <p class="text-muted">Notre mission est de fournir une plateforme complète et intuitive qui connecte les patients avec les professionnels de santé, permettant des consultations à distance, des diagnostics précoces et une gestion efficace des traitements.</p>
        </div>
        <div class="col-lg-4">
            <h2 class="font-weight-light">Nos Valeurs</h2>
            <p class="text-muted">Nous valorisons l'innovation, l'accessibilité, la compassion et l'excellence. Nous nous engageons à améliorer constamment notre technologie et nos services pour répondre aux besoins de nos utilisateurs.</p>
        </div>
    </div>
</div>

<div id="team" class="container py-5 bg-light">
    <div class="row text-center text-primary mb-4">
        <div class="col-lg-8 mx-auto">
            <h2 class="display-4">Notre Équipe</h2>
            <p class="lead">Découvrez les visages derrière Sensante, une équipe passionnée et dédiée à la transformation des soins de santé.</p>
        </div>
    </div>
    <div class="row text-center">
        <!-- Team member -->
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4">
                <img src="{{ url('images/equipes/user_logo.png') }}" alt="Thierno Ousmane DIALLO" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Thierno Ousmane DIALLO</h5>
                <span class="small text-uppercase text-muted">Fondateur & CEO</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bxl-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bxl-linkedin"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bxl-facebook"></i></a></li>
                </ul>
            </div>
            
        </div>
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4">
                <img src="{{url('images/equipes/user_logo.png')}}" alt="Ndathie LO" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Ndathie LO</h5>
                <span class="small text-uppercase text-muted">Ingénieur logiciel</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bxl-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bxl-linkedin"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bxl-facebook"></i></a></li>
                </ul>
            </div>
            
        </div>
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4">
                <img src="{{url('images/equipes/user_logo.png')}}" alt="Mame Biram Pathé NDIAYE" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Mame Biram Pathé NDIAYE</h5>
                <span class="small text-uppercase text-muted">Data Scientist</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bxl-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bxl-linkedin"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bx bxl-facebook"></i></a></li>
                </ul>
            </div>
            
        </div>
        <!-- More team members -->
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="display-4">Pourquoi Choisir Sensante?</h2>
            <p class="lead text-muted mb-4">Avec Sensante, vous bénéficiez de soins de santé personnalisés à portée de main. Voici pourquoi notre application est la meilleure solution pour vos besoins en matière de santé :</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Accessibilité</h5>
                    <p class="card-text">Accédez à des consultations médicales à tout moment et de n'importe où.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Innovation</h5>
                    <p class="card-text">Utilisez les dernières technologies pour des diagnostics et des traitements efficaces.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Soutien Continu</h5>
                    <p class="card-text">Profitez d'un suivi médical continu et personnalisé pour une meilleure gestion de votre santé.</p>
                </div>
            </div>
        </div>
    </div>
</div>
        
@endsection