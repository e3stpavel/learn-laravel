@extends('layout')
@section('title', 'home page')
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
            <td>{{$post->body}}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{$post->created_at}}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{$post->updated_at}}</td>
        </tr>
        <tr>
            <th>Picture</th>
            <td><img src="{{$post->image_path}}" alt="{{$post->image_path}}" style="width: -webkit-fill-available;"></td>
        </tr>
        <tr>
            <th>Picture URL</th>
            <td>{{$post->image_path}}</td>
        </tr>
        </tbody>
    </table>
@endsection
