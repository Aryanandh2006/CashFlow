<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Page Not Found</title>
    <style>
        body {
            text-align: center;
            font-family: sans-serif;
            padding: 50px;
        }

        h1 {
            font-size: 50px;
            color: #333;
        }

        p {
            font-size: 20px;
            color: #666;
        }

        a {
            color: #3490dc;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1>404</h1>
    <p>Oops! The page you are looking for does not exist.</p>
    <a href="{{ url('/') }}">Return Home</a>
</body>

</html>