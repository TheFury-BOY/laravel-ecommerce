<ul class="navbar-nav ml-auto d-flex flex-row">
    <!-- Authentication Links -->
    @guest
    <li class="nav-item ml-2">
        <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('SE CONNECTER') }}</a>
    </li>
    @if (Route::has('register'))
    <li class="nav-item ml-2">
        <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('S\'ENREGISTRER') }}</a>
    </li>
    @endif
    @else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('home') }}">
                Mes Commandes
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                {{ __('Se Déconnecter') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
    @endguest
</ul>
