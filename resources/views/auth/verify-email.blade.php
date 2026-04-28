<x-guest-layout>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card card-custom shadow p-4 text-center" style="width:420px;">
        <h5 class="text-main mb-3 brand">Verifikasi Email</h5>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="btn btn-main w-100 mb-2">Kirim Ulang</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-secondary w-100">Logout</button>
        </form>
    </div>
</div>
</x-guest-layout>