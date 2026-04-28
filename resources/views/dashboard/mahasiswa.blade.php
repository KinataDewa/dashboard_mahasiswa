@extends('layouts.app')

@section('content')

{{-- CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <div class="bg-white rounded-xl p-6 shadow">
        <p class="text-gray-500 text-sm">Indeks Prestasi Kumulatif</p>
        <h2 class="text-3xl font-bold text-blue-600 mt-2">3.80</h2>
        <p class="text-sm text-gray-500 mt-1">Bagus! Ada peningkatan</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow">
        <p class="text-gray-500 text-sm">Nilai D / E</p>
        <h2 class="text-3xl font-bold text-blue-600 mt-2">2</h2>
        <p class="text-sm text-gray-500 mt-1">Perlu ditingkatkan</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow">
        <p class="text-gray-500 text-sm">Total Ketidakhadiran</p>
        <h2 class="text-3xl font-bold text-blue-600 mt-2">16 Jam</h2>
        <p class="text-sm text-gray-500 mt-1">Hampir batas</p>
    </div>

</div>

@endsection