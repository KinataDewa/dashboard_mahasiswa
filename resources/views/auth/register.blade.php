<x-guest-layout>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card card-custom shadow p-4" style="width:420px;">
        <h3 class="text-center text-main mb-4 brand">Register</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-select">
                    <option value="">Pilih Role</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dpa">DPA</option>
                    <option value="civitas">Civitas</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button class="btn btn-main w-100">Register</button>
        </form>
    </div>
</div>
</x-guest-layout>