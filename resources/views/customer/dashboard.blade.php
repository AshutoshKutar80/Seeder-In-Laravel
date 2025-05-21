<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <style>
        body {
            background-color: #1e1e2f;
            font-family: Arial, sans-serif;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .dashboard-box {
            background-color: #2d2d44;
            border: 2px solid #00ffff;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 0 10px #00ffff;
            text-align: center;
        }

        .dashboard-box h2 {
            margin-bottom: 20px;
        }

        .dashboard-box p {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .dashboard-box button {
            background-color: #00ffff;
            border: none;
            padding: 10px 20px;
            color: #000;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        .dashboard-box button:hover {
            background-color: #00cccc;
        }
    </style>
</head>

<body>

    <div class="dashboard-box">
        <h2>Customer Dashboard</h2>
        <p>Welcome, {{ Auth::user()->name }}</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

</body>

</html>
