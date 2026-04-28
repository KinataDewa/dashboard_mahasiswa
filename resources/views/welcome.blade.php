<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academia</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Poetsen One (HANYA UNTUK HEADING) -->
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
        }

        /* Heading pakai Poetsen */
        h1, h2, h3, h4, h5, .navbar-brand {
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

        .hero {
            padding: 80px 0;
        }

        .card-custom {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-main" href="#">
            🎓 Academia
        </a>

        <div class="ms-auto">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-main">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                    Login
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-main">
                        Register
                    </a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="container text-center hero">

    <h1 class="display-5 text-main">
        Sistem Akademik Modern
    </h1>

    <p class="lead text-muted mt-3">
        Kelola data mahasiswa, nilai, dan absensi dengan mudah dan cepat.
    </p>

    <div class="mt-4">
        @auth
            <a href="/dashboard" class="btn btn-main btn-lg">
                Masuk Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-main btn-lg">
                Mulai Sekarang
            </a>
        @endauth
    </div>

</div>

<!-- FEATURES -->
<div class="container pb-5">
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card card-custom shadow-sm h-100 text-center p-4">
                <h5 class="text-main">📊 Dashboard</h5>
                <p class="text-muted">
                    Monitoring data akademik secara real-time.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom shadow-sm h-100 text-center p-4">
                <h5 class="text-main">📚 Nilai</h5>
                <p class="text-muted">
                    Kelola dan lihat nilai mahasiswa dengan mudah.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom shadow-sm h-100 text-center p-4">
                <h5 class="text-main">🕒 Absensi</h5>
                <p class="text-muted">
                    Sistem absensi digital yang praktis.
                </p>
            </div>
        </div>

    </div>
</div>

<!-- FOOTER -->
<footer class="text-center py-3 text-muted small">
    © {{ date('Y') }} Academia
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>