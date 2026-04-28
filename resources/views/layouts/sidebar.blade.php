<aside class="bg-white border-end" style="width:250px;">

    <div class="p-4 border-bottom fw-bold text-primary fs-5">
        🎓 Academia
    </div>

    <ul class="nav flex-column p-3">

        <li class="nav-item">
            <a href="/dashboard" class="nav-link active bg-primary text-white rounded mb-2">
                📊 Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link text-dark">
                📚 Nilai
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link text-dark">
                🕒 Absensi
            </a>
        </li>

    </ul>

    <div class="p-3 border-top mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger w-100">
                🚪 Logout
            </button>
        </form>
    </div>

</aside>