@extends('layout.default')

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(!isset($user))
                <div class="col-lg-4 col-md-12 col-sm-12 pt-12">
                    <div class="card rounded-lg overflow-hidden hvr-float mb-4">
                        <div class="card-header bg-white px-5">
                            <div class="d-flex align-items-center">
                                <span>Mon profil</span>
                            </div>
                        </div>
                        <div class="card-body px-5">
                            <div class="d-flex justify-content-center">
                                @if(session('user')->img_url != null)
                                    <img class="rounded-circle mr-3 border my-auto" alt="Photo" src="{{ session('user')->img_url }}" height="100">
                                @else
                                    <img class="rounded-circle mr-3 border my-auto" alt="Photo" src="{{ asset('img/default.png') }}" height="100">
                                @endif
                                <div class="my-auto">
                                    <h1 class="text-dark" href="#">{{ session('user')->first_name }}</h1>
                                    <span>{{ session('user')->email }}</span>
                                </div>
                            </div>
                            @if(session('user')->bio != null)
                            <div class="mt-3">
                                <p>Bio : {{ session('user')->bio }}</p>
                            </div>
                            @endif
                            <div class="my-3">
                                <form method="post" action='{{ url('deleteprofile') }}'>
                                    @csrf
                                    <button class="btn btn-danger text-white w-100">Supprimer mon compte</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-12 overscroll">
                    <div class="card rounded-lg overflow-hidden hvr-float mb-4">
                        <div class="card-header bg-white px-5">
                            <div class="d-flex align-items-center">
                                <span>Modifier mes informations</span>
                            </div>
                        </div>
                        <div class="card-body px-5 pt-4">
                            <div @if(session()->has('message')) class="alert alert-{{session('message')['status']}}">
                                {{ session('message')['text'] }}
                            </div @endif>
                            <form method="post" action='{{ url('profile') }}' enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <input class="form-control rounded" type="text" name="first_name" placeholder="Prénom" @if(old('first_name'))value="{{ old('first_name') }}"@else value="{{ session('user')->first_name }}" @endif>
                                </div>
                                <div class="form-group mb-3">
                                    <input class="form-control rounded" type="file" id="img" name="img" placeholder="img">
                                </div>
                                <div class="form-group mb-3">
                                    <input class="form-control rounded" type="email" id="email" name="email" placeholder="Email" @if(old('email')) value="{{ old('email') }}" @else value="{{ session('user')->email }}" @endif>
                                </div>
                                <div class="form-group mb-3">
                                    <input class="form-control rounded" type="password" id="password" name="password" placeholder="Password" @if(old('password')) value="{{ old('password') }}" @else value="{{ session('user')->password }}" @endif>
                                </div>
                                <div class="form-group mb-3">
                                    <input class="form-control rounded" type="text" id="bio" name="bio" placeholder="Bio" @if(old('bio')) value="{{ old('bio') }}" @else value="{{ session('user')->bio }}" @endif>
                                </div>
                                <button class="btn btn-primary text-white mb-3 w-100" type="submit">Modifier</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-4 col-md-12 col-sm-12 pt-12">
                    <div class="card rounded-lg overflow-hidden hvr-float mb-4">
                        <div class="card-header bg-white px-5">
                        <div class="d-flex align-items-center">
                            <span>Profil</span>
                        </div>
                    </div>
                        <div class="card-body px-5">
                        <div class="d-flex justify-content-center">
                            @if($user->img_url != null)
                                <img class="rounded-circle mr-3 border my-auto" alt="Photo" src="{{ $user->img_url }}" height="100">
                            @else
                                <img class="rounded-circle mr-3 border my-auto" alt="Photo" src="{{ asset('img/default.png') }}" height="100">
                            @endif
                            <div class="my-auto">
                                <h1 class="text-dark" href="#">{{ $user->first_name }}</h1>
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>
                        @if(session('user')->bio != null)
                            <div class="mt-3">
                                <p>Bio :  {{ $user->bio }}</p>
                            </div>
                        @endif
                    </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
