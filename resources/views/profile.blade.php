@extends('layout.default')

@section('content')
  <div class="container">
    <div class="row g-4">
      @if(!isset($user))
        <div class="col-lg-6 vstack gap-4">
          <div class="card">
            <div class="h-100px rounded-top" style="background-color: #32C7FF; background-position: center; background-size: cover; background-repeat: no-repeat;"></div>
              <!-- Card body START -->
              <div class="card-body py-0">
                <div class="d-sm-flex align-items-start text-center text-sm-start">
                  <div>
                    <div class="avatar avatar-xxl mt-n5 mb-3">
                      @if(session('user')->img_url != null)
                        <img class="avatar-img rounded-circle border border-white border-3" src="{{ session('user')->img_url }}" alt="Photo">
                      @else
                        <img class="avatar-img rounded-circle border border-white border-3" src="{{ asset('img/default.png') }}" alt="Photo">
                      @endif
                    </div>
                  </div>
                  <div class="ms-sm-4 mt-sm-3">
                    <!-- Info -->
                    <h1 class="mb-0 h5">{{ session('user')->first_name }} {{ session('user')->last_name }}</h1>
                    <p class="mb-0">{{ session('user')->email }}</h1>
                  </div>
                  <!-- Button -->
                </div>
                <!-- List profile -->
                <ul class="list-inline mb-3 text-center text-sm-start mt-3 mt-sm-0">
                  <li class="list-inline-item"><i class="bi bi-briefcase me-1"></i> Développeur Front-End</li>
                  <li class="list-inline-item"><i class="bi bi-geo-alt me-1"></i>Paris</li>
                </ul>
              </div>
            </div>
    
            <div class="card">
              <div class="card-header border-0 pb-0">
                <h5 class="card-title">À propos</h5> 
              </div>
              <div class="card-body">
                @if(session('user')->bio != null)
                  <p>{{ session('user')->bio }}</p>
                @else
                  <p>Aucune bio</p>
                @endif
              </div>
              <div class="card-header border-0 pb-0">
                <h5 class="card-title">Supprimer mon compte</h5> 
              </div>
              <div class="card-body">
                <p class="pb-3">
                  Donec tempor porttitor gravida. Nulla turpis lectus, pretium vel sagittis sed, vehicula vel magna. Praesent bibendum consectetur nulla, 
                </p>
                <form method="post" action='{{ url('deleteprofile') }}'>
                      @csrf
                      <button class="btn btn-sm btn-danger">Supprimer mon compte</button>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
              <div class="card rounded-lg overflow-hidden hvr-float mb-4">
                  <div class="card-header border-0 pb-0">
                    <h5 class="card-title">Modifier mes informations</h5> 
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
                          <div class="input-group-lg mb-3">
                              <input class="form-control rounded" type="file" id="img" name="img" placeholder="img">
                          </div>
                          <div class="input-group-lg mb-3">
                              <input class="form-control rounded" type="email" id="email" name="email" placeholder="Email" @if(old('email')) value="{{ old('email') }}" @else value="{{ session('user')->email }}" @endif>
                          </div>
                          <div class="input-group-lg mb-3">
                              <input class="form-control rounded" type="password" id="password" name="password" placeholder="Password" @if(old('password')) value="{{ old('password') }}" @else value="{{ session('user')->password }}" @endif>
                          </div>
                          <div class="input-group-lg mb-3">
                              <input class="form-control rounded" type="text" id="bio" name="bio" placeholder="Bio" @if(old('bio')) value="{{ old('bio') }}" @else value="{{ session('user')->bio }}" @endif>
                          </div>
                          <button class="btn btn-lg btn-primary mb-3 w-100" type="submit">Modifier</button>
                      </form>
                  </div>
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
      @endif
    </div>
  </div>
@endsection
