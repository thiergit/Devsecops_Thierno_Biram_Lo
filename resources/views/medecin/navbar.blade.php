<header class="header" id="header">
  <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
  @if (Auth::user()->medecin && Auth::user()->medecin->admin)
  <p class="text-primary">Administrateur <i class="bx bx-lock-open-alt"></i></p>
  @endif 
  <div class="header_img"> {{Auth::user()->prenom[0]}} {{Auth::user()->nom[0]}}</div>
</header>
<div class="l-navbar" id="nav-bar">
  <nav class="nav">
      <div> 
        <a href="{{route('indexM')}}" class="nav_logo"> 
          <i class='bx bx-grid-alt nav_logo-icon'></i> 
          <span class="nav_logo-name">Accueil</span> 
        </a>
          <div class="nav_list"> 
            <a href="{{route('dashboardM')}}" class="nav_link"> 
              <i class='bx bx-user nav_icon'></i> 
              <span class="nav_name">Utilisateurs</span> 
            </a> 
            <a href="{{route('consultationsM')}}" class="nav_link"> 
              <i class='bx bx-phone-call nav_icon'></i> 
              <span class="nav_name">Suivis</span> 
            </a> 
            <a href="{{route('chatM')}}" class="nav_link"> 
              <i class='bx bx-message-square-detail nav_icon'></i> 
              <span class="nav_name">Messages</span> 
            </a>
            @if (Auth::user()->medecin && Auth::user()->medecin->admin)
              <a href="{{route('manageMedecin')}}" class="nav_link"> 
                <i class='bx bx-user-plus nav_icon'></i> 
                <span class="nav_name">Manager vos Medecins</span> 
              </a>  
            @endif 

            <a href="{{route('proposM')}}" class="nav_link"> 
              <i class='bx bx-group nav_icon'></i> 
              <span class="nav_name">A Propos</span> 
            </a>
          </div>
      </div> 
      <form class="nav_link" action="{{route('deconnexion')}}" method="POST">
        @method('delete')
        @csrf
        <button id="logout-btn">
          <i class='bx bx-log-out nav_icon'></i> 
        </button>
      </form>
      
  </nav>
</div>