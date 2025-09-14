@extends('layouts.app')

@section('title', 'Blog Manager')

@section('content')
    <h1>Create a New Post</h1>

    {{-- Laravel Validation Errors --}}
    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label>Category</label>
            <input type="text" name="category" value="{{ old('category') }}">
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea name="content" required>{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label>Image (optional)</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <button type="submit">Publish</button>
    </form>

    <h1>All Posts</h1>

    @if ($posts->isEmpty())
        <div>No posts yet. Create your first one above.</div>
    @endif

    @foreach ($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <div class="meta">
                {{ $post->created_at->format('F j, Y') }}
                @if ($post->category)
                    · {{ $post->category }}
                @endif
            </div>
            <p>{{ $post->content }}</p>
            @if ($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image">
            @endif
<div class="actions">
    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Delete this post?')">Delete</button>
    </form>
</div>
        </div>
    @endforeach
@endsection
