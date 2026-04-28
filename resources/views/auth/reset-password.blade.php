<x-guest-layout>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card card-custom shadow p-4" style="width:400px;">
        <h5 class="text-main mb-3 brand">Reset Password</h5>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <input type="email" name="email" class="form-control mb-3" required>
            <input type="password" name="password" class="form-control mb-3" required>
            <input type="password" name="password_confirmation" class="form-control mb-3" required>

            <button class="btn btn-main w-100">Reset</button>
        </form>
    </div>
</div>
</x-guest-layout>