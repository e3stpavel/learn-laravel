@extends('layout')
@section('title', 'Posts')
@section('content')
    <a href="{{route('posts.create')}}" class="btn btn-primary">New Post</a>
    {{$posts->links()}}
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>
                        <h4 style="font-size: 1.7rem">{{$post->title}}</h4>
                        <p class="text-muted"> - by {{$post->user->name}}</p>
                    </td>
                    <td>{{$post->created_at->setTimezone('Europe/Tallinn')}}</td>
                    <td>{{$post->updated_at->setTimezone('Europe/Tallinn')}}</td>
                    <td style="vertical-align: middle">
                        <form action="{{route('posts.destroy', ['post' => $post->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="/admin/posts/{{$post->id}}" class="btn btn-dark">View</a>
                            <a href="{{route('posts.edit', ['post' => $post->id])}}" class="btn btn-warning">Edit</a>
                            <input type="submit" value="Delete" class="btn btn-danger" style="margin-top: .5em; width: 8.7em">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$posts->links()}}
@endsection
