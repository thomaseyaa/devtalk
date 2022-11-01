<!-- HEADER-->
@if(session('user'))
    <nav class="py-3 navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand py-0" href="/">
                <h1 class="text-dark">DevTalk</h1>
            </a>
            <div class="collapse navbar-collapse" id="navbar-content">
                <ul class="navbar-nav">
                    <li class="nav-item mx-1"><a class="nav-link text-dark" href="/home">Accueil</a></li>
                    <li class="nav-item mx-1"><a  href="{{ url('profile') }}" class="nav-link text-dark">Profil</a></li>
                    <li class="nav-item mx-1"><a class="nav-link text-dark" href="/legal-notice">Mentions légales</a></li>
                    <li class="nav-item mx-1"><a href="{{ url('disconnect') }}" class="nav-link text-dark">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </nav>
@else
    <nav class="py-3 navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand py-0" href="/">
                <h1 class="text-dark">DevTalk</h1>
            </a>
            <div class="collapse navbar-collapse" id="navbar-content">
                <ul class="navbar-nav">
                    <li class="nav-item mx-1"><a class="nav-link text-dark" href="/">Accueil</a></li>
                    <li class="nav-item mx-1"><a  href="{{ url('login') }}" class="nav-link text-dark">Connexion</a></li>
                    <li class="nav-item mx-1"><a  href="{{ url('register') }}" class="nav-link text-dark">Inscription</a></li>
                    <li class="nav-item mx-1"><a class="nav-link text-dark" href="/legal-notice">Mentions légales</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endif

