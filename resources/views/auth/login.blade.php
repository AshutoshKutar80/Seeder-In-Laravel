<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background-color: #1e1e2f;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-box {
            background-color: #2d2d44;
            border: 2px solid #609090;
            padding: 30px;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 0 10px #00ffff;
            color: #fff;
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-box input[type="email"],
        .form-box input[type="password"] {
            width: 92%;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #1e1e2f;
            border: 2px solid #609090;
            color: #fff;
            border-radius: 5px;
        }

        .form-box button {
            width: 100%;
            padding: 10px;
            background-color: #52caca;
            border: none;
            color: #000;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-box button:hover {
            background-color: #00ffff;
            transition: background-color 0.3s ease;
        }


        .form-box p {
            color: white;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            text-align: center;
        }

        .form-box p a {
            color: #00ffff;
            text-decoration: none;
        }


        .error p {
            color: #ff4d4d;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="form-box">
        <h2>Login</h2>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p>Don't have an account?<a href="/"> Register</a></p>
    </div>

</body>

</html>
