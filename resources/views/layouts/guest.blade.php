<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Auth</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Poetsen One -->
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            background: #f5f7fb;
        }

        /* HANYA heading pakai Poetsen */
        h1, h2, h3, h4, h5, .brand {
            font-family: 'Poetsen One', sans-serif;
        }

        .text-main {
            color: #1E40AF;
        }

        .btn-main {
            background-color: #1E40AF;
            color: white;
            border: none;
        }

        .btn-main:hover {
            background-color: #1a3696;
            color: white;
        }

        .card-custom {
            border-radius: 15px;
        }
    </style>
</head>
<body>

    {{ $slot }}

</body>
</html>