<div class="actu-container">
    @foreach ($post as $p)
        <h1>{{$p->title}}</h1>
        @if($p->img_id)
            <img class="img-actu-actu" src="{{$p->img_url}}" alt="" style="max-height: 60%; max-width:60%">
        @endif
        <p>{{$p->body}}</p>
        <a href="/deletePost/{{$p->id}}">Supprimer</a>
    @endforeach
</div>
