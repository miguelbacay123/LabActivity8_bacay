<?php $__env->startSection('content'); ?>
    <h1>Blog List</h1>
    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <h3><?php echo e($blog->title); ?></h3>
            <p><?php echo e($blog->content); ?></p>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/includes/db.php';

// Ensure uploads/ exists
$uploadDir = __DIR__ . '/uploads';
if (!is_dir($uploadDir)) {
  mkdir($uploadDir, 0777, true);
}

$errors = [];
$request = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Create post
if ($request === 'POST') {
  $title = trim($_POST['title'] ?? '');
  $content = trim($_POST['content'] ?? '');
  $category = trim($_POST['category'] ?? '');
  $imagePath = null;

  if ($title === '' || $content === '') {
    $errors[] = 'Title and content are required.';
  }

  if (!empty($_FILES['image']['name'])) {
    $file = $_FILES['image'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($ext, $allowed, true)) {
      $errors[] = 'Invalid image type.';
    } else {
      $newName   = uniqid('img_', true) . '.' . $ext;
      $targetRel = 'uploads/' . $newName;       // for browser
      $targetAbs = $uploadDir . '/' . $newName; // for filesystem
      if (!move_uploaded_file($file['tmp_name'], $targetAbs)) {
        $errors[] = 'Failed to upload image.';
      } else {
        $imagePath = $targetRel;
      }
    }
  }

  if (!$errors) {
    $stmt = $conn->prepare("INSERT INTO posts (title, category, content, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $category, $content, $imagePath);
    $stmt->execute();
    header("Location: index.php");
    exit;
  }
}

// Fetch posts
$res = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blog Manager</title>
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
      <a href="index.php" class="active">Home</a>
      <a href="index.html">About</a>
      <a href="#">Portfolio</a>
      <a href="#">Contact</a>
    </nav>
  </div>

  <div class="container">
    <h1>Create a New Post</h1>

    <?php if ($errors): ?>
      <div class="error">
        <?php foreach ($errors as $e): ?>
          <div>- <?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" required>
      </div>
      <div class="form-group">
        <label>Category</label>
        <input type="text" name="category">
      </div>
      <div class="form-group">
        <label>Content</label>
        <textarea name="content" required></textarea>
      </div>
      <div class="form-group">
        <label>Image (optional)</label>
        <input type="file" name="image" accept="image/*">
      </div>
      <button type="submit">Publish</button>
    </form>

    <h1>All Posts</h1>

    <?php if (!$posts): ?>
      <div>No posts yet. Create your first one above.</div>
    <?php endif; ?>

    <?php foreach ($posts as $post): ?>
      <div class="post">
        <h2><?= htmlspecialchars($post['title']) ?></h2>
        <div class="meta">
          <?= htmlspecialchars($post['created_at']) ?>
          <?= $post['category'] ? ' · ' . htmlspecialchars($post['category']) : '' ?>
        </div>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <?php if (!empty($post['image_path'])): ?>
          <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="Post image">
        <?php endif; ?>
        <div class="actions">
          <a href="edit.php?id=<?= (int)$post['id'] ?>">Edit</a>
          <a href="delete.php?id=<?= (int)$post['id'] ?>" onclick="return confirm('Delete this post?')">Delete</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\blogs\Laravel-Image-main\resources\views/blogs/index.blade.php ENDPATH**/ ?>