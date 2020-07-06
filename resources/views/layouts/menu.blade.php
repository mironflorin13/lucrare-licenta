
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
    <a href="/dentist/reviews" class="nav-link">
        <i class="fas fa-pencil-alt"></i>
        My reviews
    </a>
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
        <i class="fas fa-sign-out-alt"> </i>
        Logout
    </a>    
    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
  </div>
