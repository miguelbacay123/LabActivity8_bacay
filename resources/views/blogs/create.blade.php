@extends('layout')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card shadow-sm">
      <div class="card-header bg-white"><h5 class="mb-0">Create Blog</h5></div>
      <div class="card-body">
        <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data" class="vstack gap-3">
          @csrf
          <div>
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
          </div>
          <div>
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="4" required>{{ old('content') }}</textarea>
            @error('content')<div class="text-danger small">{{ $message }}</div>@enderror
          </div>
          <div>
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
          </div>
          <div class="d-flex gap-2">
            <button class="btn btn-primary">Create</button>
            <a href="{{ route('blogs.index') }}" class="btn btn-light border">Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection