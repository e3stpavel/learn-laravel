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
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">{{ $post->snippet }}</p>
                        <a href="{{route('post', ['post' => $post->id])}}" class="btn {{ array("btn-primary", "btn-warning", "btn-success", "btn-danger", "btn-dark")[array_rand(array("btn-primary", "btn-warning", "btn-success", "btn-danger", "btn-dark"))] }}">Read more</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$posts->links('partials.pagination')}}
@endsection
