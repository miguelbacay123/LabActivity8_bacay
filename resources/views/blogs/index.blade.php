@extends('layout')

@section('content')
    <h1>Blog List</h1>
    @foreach ($blogs as $blog)
        <div>
            <h3>{{ $blog->title }}</h3>
            <p>{{ $blog->content }}</p>
        </div>
    @endforeach
@endsection