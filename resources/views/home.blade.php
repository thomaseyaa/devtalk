@extends('layout.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 pt-12">
                <div class="card rounded-lg overflow-hidden hvr-float mb-4">
                    <div class="card-header bg-white px-5">
                        <div class="d-flex align-items-center">
                            <span>Créer une publication</span>
                        </div>
                    </div>
                    <div class="card-body px-5 pt-4">
                        <div class="form-group">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                            <form action="/home" method="POST" enctype="multipart/form-data">
                                @csrf
                                <textarea class="form-control rounded" rows="4" name="body" placeholder="Quoi de neuf ?"></textarea>
                                <input type="file"  class="form-control rounded my-3" placeholder="Image" name="image"/>
                                <button class="btn btn-primary text-white text-primary w-100" type="submit">Publier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-12 overscroll">
                @foreach ($posts as $p)
                    <div class="card rounded-lg overflow-hidden hvr-float mb-4">
                        <div class="card-header bg-white px-5">
                            <a class="text-body" href="profile/{{$p->user->id}}">
                                <div class="d-flex align-items-center">
                                    @if(!$p->user->img_url)
                                        <img src="{{ asset('img/default.png') }}" class="rounded-circle mr-3 border my-auto" height="32" width="32">
                                    @endif
                                    @if($p->user->img_url)
                                        <img class="rounded-circle my-auto mr-3" src="{{$p->user->img_url}}" height="32" width="32">
                                    @endif
                                        <span>{{ $p->user->first_name }} - {{$p->publication_date }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="card-body px-5 pt-4">
                            @if($p->img_id)
                                <img class="img-actu-actu mb-2" src="{{$p->img_url}}" alt="" width="150px" height="150px">
                            @endif
                            <div>
                                <p class="text-dark">
                                    {{$p->body}}
                                </p>
                                <div class="row">
                                    <div class="ml-3 mr-4">
                                    @if($p->likes()->count() != 0)
                                        <p class="mr-2">
                                            {{$p->likes()->count()}}
                                            @if($p->hasLiked())
                                                <a href="/likePost/{{$p->id}}" class="text-red mr-2">
                                                    <i class="bi bi-suit-heart-fill"></i>
                                                </a>
                                            @else
                                                <a href="/likePost/{{$p->id}}" class="text-dark mr-2">
                                                    <i class="bi bi-suit-heart"></i>
                                                </a>
                                            @endif
                                        </p>
                                    @else
                                        <p class="mr-2">
                                            0
                                            <a href="/likePost/{{$p->id}}" class="text-dark mr-2">
                                                <i class="bi bi-suit-heart"></i>
                                            </a>
                                        </p>
                                    @endif
                                    </div>
                                    <div class="mr-4">
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$p->id}}">
                                            <i class="bi bi-chat-left"></i>
                                        </a>
                                    </div>
                                    <div class="ml-3">
                                        @if($p->user_id == session('user')->id)
                                            <a href="/deletePost/{{$p->id}}" class="text-red">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                @foreach ($p->comments as $c)
                                        @if($c->body)
                                            <div class="px-3">
                                                <blockquote class="blockquote text-white">#</blockquote>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <a class="text-body" href="profile/{{$p->user->id}}">
                                                    @if($c->user_image)
                                                        <img src="{{$c->user_image}}" class="rounded-circle mr-3 border my-auto" height="32" width="32">
                                                    @else
                                                        <img src="{{ asset('img/default.png') }}" class="rounded-circle mr-3 border my-auto" height="32" width="32">
                                                    @endif
                                                    <span>{{$c->user_name}} - {{$c->publication_date}}</span>
                                                </a>
                                            </div>
                                            <div>
                                                <p>
                                                    {{$c->body}}
                                                </p>
                                                <div class="ml-3 mr-4">
                                                    @if($c->likes()->count() != 0)
                                                        <p class="mr-2">
                                                            {{$c->likes()->count()}}
                                                            @if($c->hasLiked())
                                                                <a href="/likeComment/{{$c->id}}" class="text-red mr-2">
                                                                    <i class="bi bi-suit-heart-fill"></i>
                                                                </a>
                                                            @else
                                                                <a href="/likeComment/{{$c->id}}" class="text-dark mr-2">
                                                                    <i class="bi bi-suit-heart"></i>
                                                                </a>
                                                            @endif
                                                        </p>
                                                    @else
                                                        <p class="mr-2">
                                                            0
                                                            <a href="/likeComment/{{$c->id}}" class="text-dark mr-2">
                                                                <i class="bi bi-suit-heart"></i>
                                                            </a>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Votre commentaire...</h5>
                                    <button type="button" class="close text-muted" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fas fa-times-circle" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="/comment/{{$p->id}}" method="post">
                                        @csrf
                                        <textarea class="form-control" name="comment_body" id="" cols="15" rows="5"></textarea>
                                        <button class="btn btn-primary text-white text-primary mb-3 mt-3 w-100" type="submit">Envoyer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row pb-12">
                    <div class="col">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item ml-auto"><a class="page-link text-muted" href="{{ $posts->previousPageUrl() }}">Précedent</a></li>
                                <li class="page-item mr-auto"><a class="page-link text-muted" href="{{ $posts->nextPageUrl() }}">Suivant</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
