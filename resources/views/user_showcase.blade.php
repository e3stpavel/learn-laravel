@extends('layout')
@section('title', $user->name . ' page')
@section('content')
    <div class="head-container">
        <div class="head-container-inner">
            <h1>This is {{$user->name}}'s page. </h1>
            <span>Discover his page immediately</span>
        </div>
        <div class="round-profile">
            <i class="ph-user ph-7x text-white"></i>
        </div>
    </div>

    <!-- counters -->
    <div class="row counters">
        <div class="cntr-container">
            <i class="ph-note-pencil ph-6x text-white"></i>

            <span class="text-white count">{{$user->posts()->count()}}</span>
            <span class="text-white sign">Posts made</span>
        </div>
        <div class="cntr-container">
            <i class="ph-thumbs-up ph-6x text-white"></i>

            <span class="text-white count">{{$user->likes()->count()}}</span>
            <span class="text-white sign">Posts liked</span>
        </div>
        <div class="cntr-container">
            <i class="ph-heart ph-6x text-white"></i>

            <span class="text-white count">{{$user->comments()->count()}}</span>
            <span class="text-white sign">Comments made</span>
        </div>

        <div class="cntr-container">
            <i class="ph-heart ph-6x text-white"></i>

            <span style="color: white; font-size: 3em; font-weight: bold;">{{$user->userHasLikes()->count()}}</span>
            <span style="color: white; font-size: 1em; text-align: center;">Other users liked</span>
        </div>
    </div>

    <h1 style="margin-top: 3em;">Recent posts</h1>
    <span style="font-size: 1.3em; color: #6b7280; ">Start by reading some fresh posts by {{$user->name}}</span>

    <div class="row row-cols-4" style="display: flex; flex-direction: row; justify-content: space-between; margin-top: 5em;">
        @foreach($posts as $post)
            <div class="col">
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 style="font-size: 1.7rem" class="card-title">{{$post->title}}</h4>
                        <p class="card-text">{{ $post->snippet }}</p>

                        <p class="card-text text-muted"> - by {{$post->user->name}}</p>
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
