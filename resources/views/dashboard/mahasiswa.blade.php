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

    {{-- CHART --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
    font-family: 'Inter', sans-serif;
    background: #f1f5f9;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    height: 100vh;
    background: #ffffff;
    position: fixed;
    padding: 20px;
    border-right: 1px solid #e5e7eb;
}

.logo {
    font-family: 'Poetsen One', sans-serif;
    font-size: 22px;
    color: #2563eb;
}

.menu-item {
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: 0.2s;
}

.menu-item:hover {
    background: #f1f5f9;
}

.menu-item.active {
    background: #e0e7ff;
    color: #2563eb;
    font-weight: 600;
}

/* MAIN */
.main {
    margin-left: 240px;
    padding: 25px;
}

/* TOPBAR */
.topbar {
    background: white;
    padding: 18px 22px;
    border-radius: 14px;
    margin-bottom: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.04);
}

/* CARD */
.card-custom {
    border-radius: 18px;
    border: none;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    transition: 0.2s;
}

.card-custom:hover {
    transform: translateY(-2px);
}

/* STAT */
.stat-number {
    font-size: 30px;
    font-weight: 700;
}

/* BADGE */
.badge-status {
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 12px;
}

/* TABLE */
.table {
    font-size: 14px;
}

.table th {
    color: #6b7280;
    font-weight: 500;
}

/* CHART FIX */
.chart-container {
    width: 100%;
    height: 220px; /* 🔥 ini kunci: lebih pendek */
}

/* RESPONSIVE */
@media(max-width: 768px) {
    .sidebar {
        display: none;
    }

    .main {
        margin-left: 0;
        padding: 15px;
    }
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

    {{-- chart --}}
    @php
        $alpha = $user->absensis->where('status','alpha')->count();
        $izin = $user->absensis->where('status','izin')->count();
        $sakit = $user->absensis->where('status','sakit')->count();

        // hadir = total - lainnya (kalau kamu simpan hadir)
        $hadir = $user->absensis->where('status','hadir')->count();
    @endphp

    @php
        $labels = [];
        $dataNilai = [];

        foreach($user->nilais as $n){
            $labels[] = $n->mataKuliah->nama;

            $na = ($n->tugas*0.3)+($n->uts*0.3)+($n->uas*0.4);
            $dataNilai[] = round($na,1);
        }
    @endphp

    <div class="row mb-4">

    {{-- CHART ABSENSI --}}
    <div class="col-md-6 mb-3">
        <div class="card card-custom p-4 h-100">
            <h6 class="mb-3">Statistik Absensi</h6>
            <div class="chart-container">
                <canvas id="absensiChart"></canvas>
            </div>
        </div>
    </div>

    {{-- CHART NILAI --}}
    <div class="col-md-6 mb-3">
        <div class="card card-custom p-4 h-100">
            <h6 class="mb-3">Grafik Nilai Mata Kuliah</h6>
            <div class="chart-container">
                <canvas id="nilaiChart"></canvas>
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
<script>
const ctx = document.getElementById('absensiChart');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Hadir', 'Izin', 'Sakit', 'Alpha'],
        datasets: [{
            data: [
                {{ $hadir }},
                {{ $izin }},
                {{ $sakit }},
                {{ $alpha }}
            ],
            backgroundColor: [
                '#22c55e', // hijau (hadir)
                '#facc15', // kuning (izin)
                '#fb923c', // orange (sakit)
                '#ef4444'  // merah (alpha)
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // 🔥 TARUH DI SINI
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

</script>

<script>
const ctxNilai = document.getElementById('nilaiChart');

new Chart(ctxNilai, {
    type: 'bar',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Nilai Akhir',
            data: {!! json_encode($dataNilai) !!},
            borderRadius: 8,
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // 🔥 TARUH DI SINI
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
</body>
</html>