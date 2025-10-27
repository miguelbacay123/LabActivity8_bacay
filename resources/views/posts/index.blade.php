@extends('layouts.app')

@section('title', 'Blog Manager')

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
                <p>{!! nl2br(e($post->content)) !!}</p>

                   @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" style="max-width: 300px; margin-top: 10px;">
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
    </div>
@endsection

@section('styles')
    <style>
        .container { max-width: 900px; margin: 32px auto 60px; padding: 0 40px; }
        h1 { color: #e91e63; margin: 20px 0; }
        .error { background: #ffe6e6; color: #b00020; padding: 10px; border-radius: 8px; margin-bottom: 16px; }
        .form-group { margin-bottom: 14px; }
        label { font-weight: bold; display: block; margin-bottom: 6px; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; }
        textarea { resize: vertical; min-height: 120px; }
        button { background: #e91e63; color: white; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer; }

        .post { background: #fff; padding: 16px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .post h2 { margin: 0 0 6px; }
        .post img { max-width: 100%; border-radius: 8px; margin-top: 10px; }
        .meta { color: #666; font-size: 0.9em; margin-bottom: 10px; }
        .actions a, .actions button { margin-right: 12px; text-decoration: none; color: #e91e63; font-weight: bold; }
    </style>
@endsection