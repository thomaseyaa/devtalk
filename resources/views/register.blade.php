@extends('layout.default')

@section('content')
    <div class="pt-8 pb-16">
        <div class="container">
            <div class="row mt-8">
                <div class="col-lg-6 col-md-10 m-auto">
                    <div class="row">
                        <div class="col text-center">
                            <h1 class="mt-6 mb-5">Inscription</h1>
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
                        <form method="post" action='{{ url('register') }}'>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-lg-6 pr-2">
                                    <input class="form-control rounded" type="text" name="first_name" placeholder="Prénom" value="{{ old('first_name') }}">
                                </div>
                                <div class="form-group col-lg-6 pl-2">
                                    <input class="form-control rounded" type="text" name="last_name" placeholder="Nom" value="{{ old('last_name') }}">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control rounded" type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control rounded" type="password" id="password" name="password" placeholder="Mot de passe">
                            </div>
                            <button class="btn btn-primary text-white mb-4 w-100" type="submit">S'inscire</button>
                        </form>
                        <div class="mb-3">
                            <small>Déja inscrit ? <a href="/login">Connectez-vous !</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
