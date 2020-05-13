<div class="sidebar">
    <nav class="sidebar-nav" style="list-style: none;">
        <li class="nav-item">
            <a href="/profile/{{$user->id}}" class="nav-link">
                <i class="fas fa-user-circle"></i>
                My profile
            </a>
        </li>
        <li class="nav-item">
            <a href="/services" class="nav-link">
                <i class="fas fa-tooth"></i>
                Services
            </a>
        </li>
        <li class="nav-item">
            <a href="/appointments" class="nav-link">
                <i class="fas fa-tooth"></i>
                My appointments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
       
    </nav>
</div>