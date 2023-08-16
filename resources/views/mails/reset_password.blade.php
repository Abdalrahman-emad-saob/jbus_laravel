<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Jbus App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Jbus App</h1>
        </div>
        <div class="content">
            <p>Hello {{ $user->name }},</p>
            <p>Welcome to Jbus App!</p>
            <p>Your URL is: <strong>{{ $url }}</strong></p>
            <p>Thank you for joining Jbus App!</p>
        </div>
    </div>
</body>

</html>
