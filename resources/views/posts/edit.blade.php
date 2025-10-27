@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container">
        <!-- Logout Button -->
        <div style="text-align: left; margin-bottom: 20px;">
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: #e91e63; color: white; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer;">
                    Logout
                </button>
            </form>
        </div>

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
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" style="max-width: 300px; margin-top: 10px;">
                @endif
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
@endsection