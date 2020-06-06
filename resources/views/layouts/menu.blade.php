
<div id="mySidenav" class="sidenav">
    <a href="/dentist/profile/{{$user->id}}" class="nav-link">
        <i class="fas fa-user-circle"></i>
        My profile
    </a>
    <a href="/dentist/services" class="nav-link">
        <i class="fas fa-tooth"></i>
        Services
    </a>
    <a href="/dentist/appointments" class="nav-link">
        <i class="far fa-calendar-check"></i>
        My appointments
    </a>
    <a href="/dentist/calendar" class="nav-link">
        <i class="fas fa-calendar"></i>
        Calendar
    </a>
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
        <i class="fas fa-sign-out-alt"> </i>
        Logout
    </a>    
    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
  </div>

  {{-- <div class="sidebar" id="sidenav">
    <nav class="sidebar-nav" style="list-style: none;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <li class="nav-item">
            <a href="/dentist/profile/{{$user->id}}" class="nav-link">
                <i class="fas fa-user-circle"></i>
                My profile
            </a>
        </li>
        <li class="nav-item">
            <a href="/dentist/services" class="nav-link">
                <i class="fas fa-tooth"></i>
                Services
            </a>
        </li>
        <li class="nav-item">
            <a href="/dentist/appointments" class="nav-link">
                <i class="far fa-calendar-check"></i>
                My appointments
            </a>
        </li>
        <li class="nav-item">
            <a href="/dentist/calendar" class="nav-link">
                <i class="fas fa-calendar"></i>
                Calendar
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"> </i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
       
    </nav>
</div> --}}