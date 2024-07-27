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
    <form action="{{route('activation')}}" method="POST">
        @csrf
        <label for="chk" aria-hidden="true">Activation du compte </label>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button>Se connecter</button>
    </form>
</div>


@endsection
