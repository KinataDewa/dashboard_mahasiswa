<x-guest-layout>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card card-custom shadow p-4" style="width:400px;">
        <h5 class="text-main mb-3 brand">Forgot Password</h5>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <button class="btn btn-main w-100">Kirim Link</button>
        </form>
    </div>
</div>
</x-guest-layout>