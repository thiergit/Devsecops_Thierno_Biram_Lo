@push('styles')
<link rel="stylesheet" href="{{url('css/manageMedecin.css')}}">
@endpush
@push('scripts')
<script src="{{ url('js/manageMedecin.js') }}"></script>

@endpush
@extends('../medecin.app')
    
@section('content')
<section>
    <div class="d-flex justify-content-end mt-3">
        <a href="{{route('addMedecin')}}" class="btn btn-light"><i class="bx bx-plus-medical"></i>Medecins</a> 
    </div>
</section>
<section class="container">
    <h1>Liste des médecins</h1>
    <div class="tbl-header">
      <table cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Spécialité</th>
            <th>Centre ou lieu de travail</th>
            <th>Rôle</th>
            <th>Modifier Rôle</th>
            <th>Bloquer / Débloquer l'utilisateur</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tbl-content">
      <table cellpadding="0" cellspacing="0" border="0">
        <tbody>
            @foreach ($allMedecins as $medecin)
                <tr>
                    <form action="{{ route('updateRole')}}" method="POST">
                        @csrf
                        <td>{{$medecin->user->nom}}</td>
                        <td>{{$medecin->user->prenom}} </td>
                        <td>{{$medecin->specialite}}</td>
                        <td>{{$medecin->centre}}</td>
                        <td>
                            <select name="admin" id="ManageRoleselect">
                                <option value="0" {{ $medecin->admin == false ? 'selected' : '' }}>Medecin</option>
                                <option value="1" {{ $medecin->admin == true ? 'selected' : '' }}>Administrateur</option>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="idMedecin" value="{{$medecin->id}}">
                            <button type="submit" class="btn btn-warning"><i class="bx bx-edit"></i></button>
                        </td>
                        <td>                                
                            @if ($medecin->user->activate)
                                <a href="/medecin/manage/block/{{$medecin->id}}"><i class="btn btn-danger bx bx-block"></i></a>
                            @else
                                <a href="/medecin/manage/deblock/{{$medecin->id}}"><i class="btn btn-success bx bx-check"></i></a>
                            @endif
                        </td>
                    </form>
                </tr>
            @endforeach

        </tbody>
      </table>
    </div>
  </section>
@endsection