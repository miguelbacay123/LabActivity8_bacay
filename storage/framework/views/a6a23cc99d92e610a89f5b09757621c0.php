

<?php $__env->startSection('title', 'Edit Post'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Edit Post</h1>

    <form method="POST" action="<?php echo e(route('posts.update', $post->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo e(old('title', $post->title)); ?>" required>
        </div>

        <div class="form-group">
            <label>Category</label>
            <input type="text" name="category" value="<?php echo e(old('category', $post->category)); ?>">
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea name="content" required><?php echo e(old('content', $post->content)); ?></textarea>
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image">
            <?php if($post->image_path): ?>
                <p>Current image:</p>
                <img src="<?php echo e(Storage::url($post->image_path)); ?>" alt="Post image" width="200">
            <?php endif; ?>
        </div>

        <button type="submit">Update</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\LabActivity8_Bacay\resources\views/posts/edit.blade.php ENDPATH**/ ?>