@extends('layout.default')

@section('content')
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="row g-4">
                    <div class="col-sm-6 col-lg-12">
                        <div class="card">
                            <div class="card-header pb-0 border-0">
                                <h5 class="card-title mb-0">Tendances 🔥</h5>
                            </div>

                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="mb-0"><a href="#" class="text-primary">#DevOps</a></h6>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-0"><a href="#" class="text-danger">#Vuejs</a></h6>
                                </div>
                            
                                <div class="mb-3">
                                    <h6 class="mb-0"><a href="#" class="text-warning">#Laravel</a></h6>
                                </div>
                            
                                <div class="mb-3">
                                    <h6 class="mb-0"><a href="#">#Python</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="card">
                            <div class="card-header pb-0 border-0">
                                <h5 class="card-title mb-0">Utilisateurs 👨‍💻</h5>
                            </div>
                            <div class="card-body">
                                <div class="hstack gap-2 mb-3">
                                    <div class="avatar">
                                        <a href="#!"><img class="avatar-img rounded-circle" src="{{ asset('img/3.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="overflow-hidden">
                                        <a class="h6 mb-0" href="#!">Lucas Lubasinski</a>
                                        <p class="mb-0 small text-truncate">Dev 2</p>
                                    </div>
                                </div>

                                <div class="hstack gap-2 mb-3">
                                    <div class="avatar">
                                        <a href="#!"> <img class="avatar-img rounded-circle" src="{{ asset('img/2.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="overflow-hidden">
                                        <a class="h6 mb-0" href="#!">Amanda Elfassy</a>
                                        <p class="mb-0 small text-truncate">Dev 3</p>
                                    </div>
                                </div>

                                <div class="hstack gap-2 mb-3">
                                    <div class="avatar">
                                        <a href="#"><img class="avatar-img rounded-circle" src="{{ asset('img/default.png') }}" alt=""></a>
                                    </div>
                                    <div class="overflow-hidden">
                                        <a class="h6 mb-0" href="#!">Junior Sanka</a>
                                        <p class="mb-0 small text-truncate">Dev 1</p>
                                    </div>
                                </div>

                                <div class="hstack gap-2 mb-3">
                                    <div class="avatar">
                                        <a href="#"> <img class="avatar-img rounded-circle" src="{{ asset('img/1.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="overflow-hidden">
                                        <a class="h6 mb-0" href="#!">Thomas Bernard</a>
                                        <p class="mb-0 small text-truncate">Dev 3</p>
                                    </div>
                                </div>

                                <div class="hstack gap-2 mb-3">
                                    <div class="avatar">
                                        <a href="#"> <img class="avatar-img rounded-circle" src="{{ asset('img/default.png') }}" alt=""></a>
                                    </div>
                                    <div class="overflow-hidden">
                                        <a class="h6 mb-0" href="#!">Léa Krief</a>
                                        <p class="mb-0 small text-truncate">Dev 2</p>
                                    </div>
                                </div>

                                <div class="d-grid mt-3">
                                    <a class="btn btn-sm btn-primary-soft" href="#!">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-lg-6 vstack gap-4">
                <div class="card">
                    <div class="card-header pb-0 border-0">
                        <h5 class="card-title mb-0">Créer une publication 🤩</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                        <div class="mb-3">
                            <form action="/home" method="POST" enctype="multipart/form-data" class="w-100">
                                @csrf
                                <textarea class="form-control pe-4 rounded" name="body" ows="2" placeholder="Quoi de neuf ?"></textarea>
                                <input type="file"  class="form-control rounded my-3" placeholder="Image" name="image"/>
                                <button class="btn btn-lg btn-primary rounded w-100" type="submit">Publier</button>
                            </form>
                        </div>
                    </div>
                </div>

                @foreach ($posts as $p)
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2">
                                        <a href="profile/{{$p->user->id}}">
                                            @if($p->user->img_url)
                                                <img class="avatar-img rounded-circle" src="{{$p->user->img_url}}" alt="Profile">
                                            @else
                                                <img class="avatar-img rounded-circle" src="{{ asset('img/default.png') }}" alt="Profile">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="nav nav-divider">
                                        <h6 class="nav-item card-title mb-0">
                                            <a href="profile/{{$p->user->id}}">{{ $p->user->first_name }}</a>
                                        </h6>
                                        <span class="nav-item small">{{$p->publication_date }}</span>
                                    </div>
                                </div>
                                @if($p->user_id == session('user')->id)
                                    <div class="dropdown">
                                        <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardFeedAction" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardFeedAction">
                                            <li>
                                                <a class="dropdown-item" href="/deletePost/{{$p->id}}" > <i class="bi bi-x-circle fa-fw pe-2"></i>Supprimer</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                <p>{{$p->body}}</p>
                                @if ($p->img_id)
                                    <img class="card-img" src="{{$p->img_url}}" alt="Post" width="150px" height="150px">
                                @endif
                            </div>
                            <div>
                                <ul class="nav nav-stack py-3 small">
                                    <li class="nav-item d-flex">
                                        @if ($p->likes()->count() != 0)
                                            @if ($p->hasLiked())
                                                <a href="/likePost/{{$p->id}}" class="text-danger nav-link">{{$p->likes()->count()}} <i class="bi bi-suit-heart-fill"></i></a>
                                            @else
                                                <a href="/likePost/{{$p->id}}" class="nav-link">{{$p->likes()->count()}} <i class="bi bi-suit-heart-fill"></i></a>
                                            @endif
                                        @else
                                            <a href="/likePost/{{$p->id}}" class="nav-link">0 <i class="bi bi-suit-heart-fill"></i></a>
                                        @endif
                                    </li>
                                    <li class="nav-item dropdown d-flex ms-sm-auto">
                                        <a type="button" class="nav-link text-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$p->id}}"><i class="bi bi-chat-fill pe-1"></i>Ajouter un commentaire</a>
                                        <a class="nav-link mb-0 ms-3" href="#" id="cardShareAction" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-reply-fill flip-horizontal ps-1"></i>Partager</a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction">
                                            <li>
                                                <a class="dropdown-item" href="#"><i class="bi bi-envelope fa-fw pe-2"></i>Envoyer par message</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#"><i class="bi bi-link fa-fw pe-2"></i>Copier le lien</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#"><i class="bi bi-share fa-fw pe-2"></i>Partager via …</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <ul class="comment-wrap list-unstyled">
                                    <li class="comment-item">
                                        @foreach ($p->comments as $c)
                                            @if($c->body)
                                                <div class="d-flex position-relative">
                                                    <div class="avatar avatar-xs">
                                                        <a href="profile/{{$p->user->id}}">  
                                                            @if($p->user->img_url)
                                                                <img class="avatar-img rounded-circle" src="{{$p->user->img_url}}" alt="Profile">
                                                            @else
                                                                <img class="avatar-img rounded-circle" src="{{ asset('img/default.png') }}" alt="Profile">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="ms-2 w-100">
                                                        <div class="bg-light rounded-start-top-0 p-3 rounded">
                                                            <div class="d-flex justify-content-between">
                                                                <h6 class="mb-1">
                                                                    <a href="profile/{{$p->user->id}}">{{$c->user_name}}</a>
                                                                </h6>
                                                                <small class="ms-2">{{$c->publication_date}}</small>
                                                            </div>
                                                            <p class="small mb-0">{{$c->body}}</p>
                                                        </div>
                                                        <div>
                                                            <ul class="nav nav-divider py-2 small">
                                                                <li class="nav-item">
                                                                @if($c->likes()->count() != 0)
                                                                    @if($c->hasLiked())
                                                                        <a href="/likeComment/{{$c->id}}" class="text-danger">{{$c->likes()->count()}} <i class="bi bi-suit-heart-fill"></i></a>
                                                                    @else
                                                                        <a href="/likeComment/{{$c->id}}" class="nav-link">{{$c->likes()->count()}} <i class="bi bi-suit-heart-fill"></i></a>
                                                                    @endif
                                                                @else
                                                                    <a href="/likeComment/{{$c->id}}" class="nav-link">0 <i class="bi bi-suit-heart-fill"></i></a>
                                                                @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div> 
                    </div>

                    <div class="modal fade" id="exampleModal{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Votre commentaire...</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/commentPost/{{$p->id}}" method="post">
                                        @csrf
                                        <textarea class="form-control" name="comment_body" id="" cols="15" rows="5"></textarea>
                                        <button class="btn btn-lg btn-primary text-white text-primary mb-3 mt-3 w-100" type="submit">Envoyer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row pb-12 d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item ml-auto"><a class="page-link" href="{{ $posts->previousPageUrl() }}">Précedent</a></li>
                            <li class="page-item mr-auto"><a class="page-link" href="{{ $posts->nextPageUrl() }}">Suivant</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="row g-4">
                    <div class="col-sm-6 col-lg-12">
                        <div class="card">
                            <div class="card-header pb-0 border-0">
                                <h5 class="card-title mb-0">Actualités 🗞</h5>
                            </div>

                            <div class="card-body">
                                <div class="mb-3">
                                <h6 class="mb-0"><a href="#">DevOps : GitLab en 5 dates clés</a></h6>
                                <small>20min</small>
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-0">
                                        <a href="#">GitHub active les profils privés : quelles options pour commencer ?</a>
                                    </h6>
                                    <small>10min</small>
                                </div>
                            
                                <div class="mb-3">
                                    <h6 class="mb-0">
                                        <a href="#">DevOps et performance : une corrélation évidente selon Google</a>
                                    </h6>
                                    <small>25min</small>
                                </div>
                            
                                <div class="mb-3">
                                    <h6 class="mb-0"><a href="#">JavaScript change de licence : un alignement sur le W3C</a></h6>
                                    <small>10min</small>
                                </div>

                                <div class="d-grid mt-3">
                                    <a class="btn btn-sm btn-primary-soft" href="#!">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
