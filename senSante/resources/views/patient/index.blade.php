@auth
    @push('styles')
        <link rel="stylesheet" href="{{url('css/index.css')}}">
    @endpush
    @push('scripts')
        <script src="{{ url('js/index.js') }}"></script>
    @endpush

    @extends('../patient.app')
    @section('content')
    <body id="body-pd">      
        <div class="container-fluid form_click_div text-white text-center py-5">
            <div class="container">
                <h1 class="display-4">Bienvenue chez Sensante</h1>
                <p class="lead">Rendre la santé accessible à tous, partout au Sénégal.</p>
                <button class="btn btn-light btn-lg" id="openFormBtn">Répondre à une série de questions</button>
                @if(session('no_prediction'))
                <div class="alert alert-success alert-dismissible fade show w-100 mt-3" role="alert">
                    {{ session('no_prediction') }}
                </div> 
                @endif
                @if(session('yes_prediction'))
                    <div class="alert alert-danger alert-dismissible fade show w-100 mt-3" role="alert">
                        {{ session('yes_prediction') }}
                </div> 
                @endif
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
        
        <div class="container py-5">
            <h2 class="text-center font-weight-light">Fonctionnalités</h2>
            <div class="row">
                <div class="col-lg-4 text-center">
                    <i class='bx bx-phone-call display-3 text-primary'></i>
                    <h3>Consultations à Distance</h3>
                    <p class="text-muted">Consultez des médecins qualifiés sans quitter le confort de votre maison.</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class='bx bx-calendar display-3 text-primary'></i>
                    <h3>Suivi des Rendez-vous</h3>
                    <p class="text-muted">Gérez vos rendez-vous médicaux en toute simplicité avec notre application.</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class='bx bx-notification display-3 text-primary'></i>
                    <h3>Notifications & Rappels</h3>
                    <p class="text-muted">Recevez des notifications et des rappels pour ne jamais manquer un rendez-vous important.</p>
                </div>
            </div>
        </div>
        
        <div class="container py-5">
            <h2 class="text-center font-weight-light">Témoignages</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text">"Sensante a complètement changé la façon dont je gère ma santé. Les consultations à distance m'ont fait gagner beaucoup de temps." - Fatou S.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text">"L'application est très facile à utiliser et m'aide à suivre tous mes rendez-vous médicaux." - Aliou D.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text">"Je recommande fortement Sensante à tous ceux qui veulent une gestion efficace de leur santé." - Marie N.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Popup Form -->
        <div id="formPopup" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <h2>Répondez à ces questions</h2>
                <form action="{{route('addBilan')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fievre">Avez-vous de la fièvre ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fievre" id="fievre_non" value="non" checked>
                            <label class="form-check-label" for="fievre_non">Non</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fievre" id="fievre_oui" value="oui">
                            <label class="form-check-label" for="fievre_oui">Oui</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fatigue">Ressentez vous de la fatigue ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fatigue" id="fatigue_non" value="non" checked>
                            <label class="form-check-label" for="fatigue_non">Non</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fatigue" id="fatigue_oui" value="oui">
                            <label class="form-check-label" for="fatigue_oui">Oui</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nause">Avez vous des nausées et des vomissements ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nause" id="nause_non" value="non" checked>
                            <label class="form-check-label" for="nause_non">Non</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nause" id="nause_oui" value="oui">
                            <label class="form-check-label" for="nause_oui">Oui</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="abdo">Avez vous des douleurs abdominales ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="abdo" id="abdo_non" value="non" checked>
                            <label class="form-check-label" for="abdo_non">Non</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="abdo" id="abdo_oui" value="oui">
                            <label class="form-check-label" for="abdo_oui">Oui</label>
                        </div>
                    </div>                 
                    <div class="form-group">
                        <label for="jaune">Remarquez vous un jaunissement de la peau ou des yeux ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jaune" id="jaune_non" value="non" checked>
                            <label class="form-check-label" for="jaune_non">Non</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jaune" id="jaune_oui" value="oui">
                            <label class="form-check-label" for="jaune_oui">Oui</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="articulation">Ressentez vous des douleurs au niveau des articulations ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="articulation" id="articulation_non" value="non" checked>
                            <label class="form-check-label" for="articulation_non">Non</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="articulation" id="articulation_oui" value="oui">
                            <label class="form-check-label" for="articulation_oui">Oui</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="urine">Remarquez vous que vos urines deviennent plus foncés ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urine" id="urine_non" value="non" checked>
                            <label class="form-check-label" for="urine_non">Non</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urine" id="urine_oui" value="oui">
                            <label class="form-check-label" for="urine_oui">Oui</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selle">Remarquez vous une décoloration de vos selles ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="selle" id="selle_non" value="non" checked>
                            <label class="form-check-label" for="selle_non">Non</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="selle" id="selle_oui" value="oui">
                            <label class="form-check-label" for="selle_oui">Oui</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="appetit">Avez vous une perte d'appétit ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="appetit" id="appetit_non" value="non" checked>
                            <label class="form-check-label" for="appetit_non">Non</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="appetit" id="appetit_oui" value="oui">
                            <label class="form-check-label" for="appetit_oui">Oui</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tete">Avez vous des maux de têtes ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tete" id="tete_non" value="non" checked>
                            <label class="form-check-label" for="tete_non">Non</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tete" id="tete_oui" value="oui">
                            <label class="form-check-label" for="tete_oui">Oui</label>
                        </div>
                    </div>
                    <!--name = -->
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </form>
            </div>
        </div> 
    @endsection
@endauth
@guest
    <h1>Erreur de connexion</h1>
    <a href="{{route('connexion')}}">Se connecter </a>
@endguest