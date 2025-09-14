<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
      <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('blogs.index') }}">Blog CRUD</a>
        <div class="ms-auto">
          <a href="{{ route('blogs.create') }}" class="btn btn-primary">Create Blog</a>
        </div>
      </div>
    </nav>
    <main class="container py-4">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @yield('content')
    </main>
    <footer class="py-4 border-top bg-white">
      <div class="container text-center text-muted small">
        Laravel 10 + Bootstrap 5 CRUD • Images in storage/app/public/uploads
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>