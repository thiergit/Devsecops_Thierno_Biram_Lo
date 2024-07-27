@push('styles')
<link rel="stylesheet" href="{{url('css/connexion.css')}}">
@endpush


@extends('../user/app')
@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div> 
@endif
@if(session('erreur'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('erreur') }}
    </div> 
@endif

<div class="main">  	
    <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup">
            <form action="{{route('inscription')}}" method="post">
                @csrf
                <label for="chk" aria-hidden="true">Inscription</label>
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="text" name="prenom" placeholder="Prénom" required>
                <input type="date" name="dateNaiss" required>
                <input type="text" name="lieuNaiss" placeholder="Lieu de naissance" required>
                <input type="number" name="tel" placeholder="Numéro de Telephone" required>
                <input type="email" name="email" placeholder="Email" required min="5">
                @error('email')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{$message}}
                </div>
                @enderror
                <input type="password" name="mdp" placeholder="Mot de passe " required min="5">
                @error('mdp')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div>{{ $message }}</div>
                </div>
                @enderror
                <input type="password" name="cmdp" placeholder="Confirmation du mot de passe" required>
                @error('cmdp')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div>{{ $message }}</div>
                </div>
                @enderror
                <button type="submit">S'inscrire</button>

            </form>
        </div>

        <div class="login">
            <form action="{{route('connexion')}}" method="post">
                @csrf
                <label for="chk" aria-hidden="true">Connexion</label>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button>Se connecter</button>
                <div class="text-center">
                    <a href="#" class="btn btn-link">Mot de passe oublié</a>
                </div>
            </form>
        </div>
</div>


@endsection
