@extends('layout')
@section('title', 'Posts')
@section('content')
    <a href="/admin/posts/create" class="btn btn-primary">New Post</a>
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
                    <td>{{$post->title}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                    <td>
                        <form method="POST" action="{{route('posts.destroy', ['post'=> $post->id])}}">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-dark" href="{{route('posts.show', ['post'=>$post->id])}}">View</a>
                            <a class="btn btn-warning" href="{{route('posts.edit', ['post'=>$post->id])}}">Edit</a>
                            <input class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$posts->links()}}
@endsection
