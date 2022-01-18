@extends('layout')
@section('title', 'posts page')
@section('content')
    <div class="row">
        <div class="col">
            @if(!$posts->previousPageUrl())
                <a href="{{$posts->previousPageUrl()}}" class="btn btn-primary disabled" aria-disabled="true" >
                    Previous Page
                </a>
            @else
                <a href="{{$posts->previousPageUrl()}}" class="btn btn-primary" >
                    Previous Page
                </a>
            @endif
        </div>
        <div class="col text-end">
            @if(!$posts->nextPageUrl())
            <a href="{{$posts->nextPageUrl()}}" class="btn btn-primary disbled" aria-disabled="true">
                Next Page
            </a>
            @else
                <a href="{{$posts->nextPageUrl()}}" class="btn btn-primary">
                    Next Page
                </a>
            @endif
        </div>
    </div>
    <div class="row row-cols-4">
        @foreach($posts as $post)
            <div class="col">
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 style="font-size: 1.7rem" class="card-title">{{$post->title}}</h4>
                        <p class="card-text">{{ $post->snippet }}</p>

                        <a href="{{route('show_user_by_id', ['user' => $post->user->id])}}" style="text-decoration: none;"><p class="card-text text-muted"> - by {{$post->user->name}}</p></a>
                        <p class="card-text text-muted">{{$post->created_at->diffForHumans()}}</p>

                        <!--class="card-img-top"-->
                        @if($post->images->count() > 1)
                            @include('partials.carousel', ['images' => $post->images, 'id' => $post->id])
                        @elseif($post->images->count() == 1)
                            <img src="{{$post->images->first()->path}}" alt="image" style="width: -webkit-fill-available; margin-bottom: 1.5em; border-radius: 10px">
                        @endif

                        <div class="data-container" style="display: flex; flex-direction: row">
                            <p class="card-text text-muted" style="margin-right: auto; margin-left: 0">{{$post->comments()->count()}} commented</p>
                            <p class="card-text text-muted" style="margin-right: 0; margin-left: auto">{{$post->likes()->count()}} liked</p>
                        </div>

                        <div class="like-container" style="display: flex; flex-direction: column; align-items: flex-start">
                            <a href="{{route('post.like', ['post' => $post->id])}}" style="margin-bottom: 1em;" class="btn btn-dark" >
                                @if($post->auth_has_liked)
                                    Unlike
                                @else
                                    Like
                                @endif
                            </a>

                            <p class="card-text text-muted" style="display: flex; flex-direction: row; width: 100%; flex-wrap: wrap;">
                                @foreach($post->tags as $tag)
                                    <a href="/tag/{{$tag->id}}" style="text-decoration: none; border-radius: 20px; background-color: #6cb2eb; color: white; padding: .5em 1em; margin: .5em .25em;">#{{$tag->name}}</a>
                                @endforeach
                            </p>

                            <a href="{{route('post', ['post' => $post->id])}}" class="btn {{ array("btn-primary", "btn-warning", "btn-success", "btn-danger", "btn-dark")[array_rand(array("btn-primary", "btn-warning", "btn-success", "btn-danger", "btn-dark"))] }}">Read more</a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$posts->links('partials.pagination')}}
@endsection
