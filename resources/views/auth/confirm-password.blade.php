<x-guest-layout>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card card-custom shadow p-4" style="width:400px;">
        <h5 class="text-main mb-3 brand">Confirm Password</h5>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <input type="password" name="password" class="form-control mb-3" required>
            <button class="btn btn-main w-100">Confirm</button>
        </form>
    </div>
</div>
</x-guest-layout>