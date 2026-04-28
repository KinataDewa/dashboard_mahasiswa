<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: white;
            position: fixed;
            padding: 20px;
            border-right: 1px solid #eee;
        }

        .logo {
            font-family: 'Poetsen One', sans-serif;
            font-size: 22px;
            color: #1E40AF;
        }

        .menu-item {
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 8px;
            cursor: pointer;
        }

        .menu-item.active {
            background: #eef2ff;
            color: #1E40AF;
            font-weight: 600;
        }

        .main {
            margin-left: 240px;
            padding: 20px;
        }

        .topbar {
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .card-custom {
            border-radius: 16px;
            border: none;
            box-shadow: 0 6px 16px rgba(0,0,0,0.05);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
        }

        .badge-status {
            padding: 6px 10px;
            border-radius: 10px;
            font-size: 12px;
        }

        .bg-soft-success { background: #dcfce7; color: #166534; }
        .bg-soft-warning { background: #fef9c3; color: #854d0e; }
        .bg-soft-danger { background: #fee2e2; color: #991b1b; }
        .bg-soft-orange { background: #ffedd5; color: #9a3412; }
        .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

@php
    $user = auth()->user();

    function hitungIP($data) {
        $total = 0;
        $jumlah = count($data);

        foreach ($data as $n) {
            $nilaiAkhir = ($n->tugas*0.3)+($n->uts*0.3)+($n->uas*0.4);

            if ($nilaiAkhir >= 85) $bobot=4;
            elseif ($nilaiAkhir >= 75) $bobot=3;
            elseif ($nilaiAkhir >= 65) $bobot=2;
            elseif ($nilaiAkhir >= 50) $bobot=1;
            else $bobot=0;

            $total += $bobot;
        }

        return $jumlah ? $total/$jumlah : 0;
    }

    $ipk = hitungIP($user->nilais);
@endphp

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="logo mb-4">🎓 Academia</div>

    <div class="menu-item active">Dashboard</div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-danger w-100 mt-4">Logout</button>
    </form>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- TOPBAR --}}
    <div class="topbar d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0 fw-bold">Halo! {{ $user->name }} 👋</h5>
            <small class="text-muted">Selamat datang di Dashboard Akademik</small>
        </div>

        <div class="d-flex align-items-center gap-3">
            <div class="text-end">
                <div class="fw-semibold">{{ $user->name }}</div>
                <small class="text-muted">Mahasiswa</small>
            </div>
        </div>
    </div>

    {{-- STAT --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card card-custom p-3">
                <h6 class="text-muted">Indeks Prestasi Kumulatif</h6>
                <div class="stat-number text-primary">
                    {{ number_format($ipk,2) }}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom p-3">
                <h6 class="text-muted">Jumlah Nilai D/E</h6>
                <div class="stat-number text-warning">
                    {{ $user->nilais->filter(function($n){
                        $na = ($n->tugas*0.3)+($n->uts*0.3)+($n->uas*0.4);
                        return $na < 65;
                    })->count() }}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom p-3">
                <h6 class="text-muted">Total Ketidakhadiran</h6>
                <div class="stat-number text-danger">
                    {{ $user->absensis->count() }}
                </div>
            </div>
        </div>

    </div>

    {{-- CONTENT --}}
    <div class="row g-3">

        {{-- NILAI --}}
        <div class="col-md-6">
            <div class="card card-custom p-3">
                <h6 class="mb-3">Nilai Akademik</h6>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->nilais as $n)
                            @php
                                $na = ($n->tugas*0.3)+($n->uts*0.3)+($n->uas*0.4);
                            @endphp
                            <tr>
                                <td>{{ $n->mataKuliah->nama }}</td>
                                <td class="fw-semibold">{{ number_format($na,1) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ABSENSI --}}
<div class="col-md-6">
    <div class="card card-custom p-3">
        <h6 class="mb-3">Riwayat Absensi</h6>

        <table class="table">
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                @forelse(
                    $user->absensis
                        ->whereIn('status', ['alpha','izin','sakit'])
                        ->sortByDesc(function($item){
                            return $item->tanggal . '-' . $item->jam_ke;
                        })
                        ->take(5)
                    as $a
                )

                <tr>
                    <td>{{ $a->mataKuliah->nama }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}
                    </td>

                    <td>
                        <span class="badge-status
                            @if($a->status=='alpha') bg-soft-danger
                            @elseif($a->status=='izin') bg-soft-warning
                            @elseif($a->status=='sakit') bg-soft-orange
                            @endif
                        ">
                            {{ ucfirst($a->status) }}
                        </span>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        Tidak ada data absensi
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>
</div>

    </div>

</div>

</body>
</html>