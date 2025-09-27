<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .success-container {
            width: 400px;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            color: #e91e63;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        strong {
            color: #333;
        }

        .btn {
            margin-top: 20px;
            display: inline-block;
            background-color: #e91e63;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #d81b60;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Registration Successful</h1>
        <p><strong>Name:</strong> <?php echo e($name); ?></p>
        <p><strong>Email:</strong> <?php echo e($email); ?></p>

        <a href="<?php echo e(route('register.form')); ?>" class="btn">Back to Register</a>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel-image-blogsystem\resources\views/success.blade.php ENDPATH**/ ?>