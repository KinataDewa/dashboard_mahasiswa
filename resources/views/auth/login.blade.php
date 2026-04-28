<x-guest-layout>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card card-custom shadow p-4" style="width:400px;">
        <h3 class="text-center text-main mb-4 brand">Login</h3>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('password.request') }}" class="small text-main">Lupa password?</a>
            </div>

            <button class="btn btn-main w-100">Login</button>
        </form>
    </div>
</div>
</x-guest-layout>