<header class="header" id="header">
  <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
  <div class="header_img"> {{Auth::user()->prenom[0]}} {{Auth::user()->nom[0]}}</div>
</header>
<div class="l-navbar" id="nav-bar">
  <nav class="nav">
      <div> 
        <a href="{{route('index')}}" class="nav_logo"> 
          <i class='bx bx-grid-alt nav_logo-icon'></i> 
          <span class="nav_logo-name">Accueil</span> 
        </a>
          <div class="nav_list"> 
            <a href="{{route('dashboard')}}" class="nav_link"> 
              <i class='bx bx-user nav_icon'></i> 
              <span class="nav_name">Utilisateurs</span> 
            </a> 
            <a href="{{route('chat')}}" class="nav_link"> 
              <i class='bx bx-message-square-detail nav_icon'></i> 
              <span class="nav_name">Messages</span> 
            </a> 
            <a href="{{route('medecins')}}" class="nav_link"> 
              <i class='bx bx-health nav_icon'></i> 
              <span class="nav_name">Medecins</span> 
            </a> 
            <a href="{{route('propos')}}" class="nav_link"> 
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