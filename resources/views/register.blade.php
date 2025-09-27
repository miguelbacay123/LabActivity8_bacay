<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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

        .form-container {
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

        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #e91e63;
            color: white;
            border: none;
            padding: 10px 20px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #d81b60;
        }

        .error-list {
            color: red;
            text-align: left;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Register</h1>

        @if ($errors->any())
            <div class="error-list">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>
</html>
