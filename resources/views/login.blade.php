@extends('layout.default')

@section('content')
    <div class="pt-8 pb-16">
        <div class="container">
            <div class="row mt-8">
                <div class="col-lg-6 col-md-10 m-auto">
                    <div class="row">
                        <div class="col text-center">
                            <h1 class="mt-6 mb-5">Connexion</h1>
                        </div>
                    </div>

                    <div class="card-block px-lg-7 px-4 pb-5">
                        @if ($errors->any())
                        <div class="alert alert-danger pb-0">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div @if(session()->has('message')) class="alert alert-{{session('message')['status']}}">
                        {{ session('message')['text'] }}
                    </div @endif>
                        <form method="post" action='{{ url('login') }}'>

                            @csrf
                            <div class="form-group mb-3">
                                <input class="form-control rounded" type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control rounded" type="password" id="password" name="password" placeholder="Mot de passe">
                            </div>
                            <div class="align-content-center mb-3">
                                <small>
                                    <a>
                                        <i class="fas fa-question-circle mr-2"></i>
                                        Mot de passe oublié
                                    </a>
                                </small>
                            </div>
                            <button class="btn btn-primary text-white mb-4 w-100" type="submit">Connexion</button>
                        </form>
                        <div class="mb-3">
                            <small>Pas de compte ? <a href="/register">Inscrivez-vous !</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
