@extends('layout')
@section('title', 'Post #' . $post->id . ' view')
@section('content')
    <table class="table table-striped">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{$post->id}}</td>
            </tr>
            <tr>
                <th>Title</th>
                <td>{{$post->title}}</td>
            </tr>
            <tr>
                <th>Content</th>
                <td>{!! $post->body !!}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{$post->created_at}}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{$post->updated_at}}</td>
            </tr>
        </tbody>
    </table>

    <form method="POST" action="{{route('posts.destroy', ['post'=> $post->id])}}" style="width:fit-content; margin-left:auto;">
        @method('DELETE')
        @csrf
        <a class="btn btn-dark" href="{{url()->previous()}}">Back</a>
        <a class="btn btn-warning" href="{{route('posts.edit', ['post'=>$post->id])}}">Edit</a>
        <input class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit" value="Delete">
    </form>
@endsection