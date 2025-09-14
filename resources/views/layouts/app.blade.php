<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Blog Manager')</title>
  <style>
    body { font-family: 'Segoe UI', Arial, sans-serif; background: #fafafa; margin: 0; padding: 0; color: #222; }
    .header { display: flex; justify-content: flex-end; padding: 24px 40px 0; }
    nav { display: flex; gap: 24px; }
    nav a { text-decoration: none; color: #222; font-weight: 500; font-size: 1.05em; }
    nav a.active { color: #e91e63; border-bottom: 2px solid #e91e63; }

    .container { max-width: 900px; margin: 32px auto 60px; padding: 0 40px; }
    h1 { color: #e91e63; margin: 20px 0; }

    form { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 40px; }
    .form-group { margin-bottom: 14px; }
    label { font-weight: bold; display: block; margin-bottom: 6px; }
    input, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; }
    textarea { resize: vertical; min-height: 120px; }
    button { background: #e91e63; color: white; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer; }

    .error { background: #ffe6e6; color: #b00020; padding: 10px; border-radius: 8px; margin-bottom: 16px; }

    .post { background: #fff; padding: 16px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 20px; }
    .post h2 { margin: 0 0 6px; }
    .post img { max-width: 100%; border-radius: 8px; margin-top: 10px; }
    .meta { color: #666; font-size: 0.9em; margin-bottom: 10px; }
    .actions a { margin-right: 12px; text-decoration: none; color: #e91e63; font-weight: bold; }
  </style>
</head>
<body>
  <div class="header">
    <nav>
      <a href="{{ route('posts.index') }}" class="active">Home</a>
      <a href="#">About</a>
      <a href="#">Portfolio</a>
      <a href="#">Contact</a>
    </nav>
  </div>

  <div class="container">
    @yield('content')
  </div>
</body>
</html>
