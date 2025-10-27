

<?php $__env->startSection('title', 'Blog Manager'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <!-- Logout Button -->
        <div style="text-align: left; margin-bottom: 20px;">
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="display: inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" style="background: #e91e63; color: white; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer;">
                    Logout
                </button>
            </form>
        </div>

        <h1>Create a New Post</h1>

        
        <?php if($errors->any()): ?>
            <div class="error">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>- <?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <div style="color: green;"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('posts.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo e(old('title')); ?>" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" value="<?php echo e(old('category')); ?>">
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea name="content" required><?php echo e(old('content')); ?></textarea>
            </div>

            <div class="form-group">
                <label>Image (optional)</label>
                <input type="file" name="image" accept="image/*">
            </div>

            <button type="submit">Publish</button>
        </form>

        <h1>All Posts</h1>

        <?php if($posts->isEmpty()): ?>
            <div>No posts yet. Create your first one above.</div>
        <?php endif; ?>

        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="post">
                <h2><?php echo e($post->title); ?></h2>
                <div class="meta">
                    <?php echo e($post->created_at->format('F j, Y')); ?>

                    <?php if($post->category): ?>
                        · <?php echo e($post->category); ?>

                    <?php endif; ?>
                </div>
                <p><?php echo nl2br(e($post->content)); ?></p>

                   <?php if($post->image_path): ?>
                    <img src="<?php echo e(asset('storage/' . $post->image_path)); ?>" alt="Post image" style="max-width: 300px; margin-top: 10px;">
                <?php endif; ?>

                <div class="actions">
                    <a href="<?php echo e(route('posts.edit', $post->id)); ?>">Edit</a>

                    <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="POST" style="display: inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" onclick="return confirm('Delete this post?')">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\LabActivity8_Bacay\resources\views/posts/index.blade.php ENDPATH**/ ?>