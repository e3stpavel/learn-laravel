@extends('layout')
@section('title', $post->title)
@section('content')
    <a href="{{url()->previous()}}" class="btn btn-dark">Back</a>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{!! $post->displayBody !!}</p>
            <p class="card-text text-muted">by {{$post->user->name}}</p>
            <p class="card-text text-muted">{{$post->created_at->diffForHumans()}}</p>
            <!--<img src="{{$post->image_path}}" alt="image" style="width: -webkit-fill-available; border-radius: 10px">-->
            @if($post->images->count() > 1)
                @include('partials.carousel', ['images' => $post->images, 'id' => $post->id])
            @elseif($post->images->count() == 1)
                <img src="{{$post->images->first()->path}}" alt="image" style="width: -webkit-fill-available; margin-bottom: 1.5em; border-radius: 10px">
            @endif
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="/post/{{$post->id}}" method="POST">
                @csrf
                <textarea name="body" id="" rows="3" class="form-control"></textarea>
                <input type="submit" class="btn btn-dark mt-3">
            </form>
        </div>
    </div>

    @foreach($post->comments as $comment)
        <div class="card mt-3">
            <div class="card-body">
                <p class="card-text text-muted">Commented by {{$comment->user->name}}</p>
                <p class="card-text">{{ $comment->body }}</p>
                <p class="card-text text-muted">{{$comment->created_at->diffForHumans()}}</p>
                <p class="card-text text-muted" style="margin-right: 0; margin-left: auto">{{$comment->likes()->count()}} liked</p>

                <a href="{{route('comment.like', ['$comment' => $comment->id])}}" style="margin-bottom: 1em;" class="btn btn-dark" >
                    @if($comment->auth_has_liked)
                        Unlike
                    @else
                        Like
                    @endif
                </a>
            </div>
        </div>
    @endforeach
@endsection
