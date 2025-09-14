@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1>Edit Post</h1>

    <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="form-group">
            <label>Category</label>
            <input type="text" name="category" value="{{ old('category', $post->category) }}">
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea name="content" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image">
            @if ($post->image_path)
                <p>Current image:</p>
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" width="200">
            @endif
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
