@foreach ($blogs as $blog)
    <div class="post">
        <h3>{{ $blog->title }}</h3>
        <p>{{ $blog->content }}</p>

        @if ($blog->image_path)
            <img src="{{ asset('storage/' . $blog->image_path) }}" alt="Post image" style="max-width: 300px; margin-top: 10px;">
        @endif
    </div>
@endforeach
