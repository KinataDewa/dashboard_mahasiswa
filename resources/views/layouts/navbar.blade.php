<nav class="navbar navbar-expand-lg bg-white border-bottom px-4">

    <div>
        <h5 class="mb-0 fw-bold">
            Dashboard
        </h5>
        <small class="text-muted">
            Halo, {{ auth()->user()->name }}
        </small>
    </div>

    <div class="ms-auto d-flex align-items-center gap-3">

        {{-- NOTIF --}}
        <button class="btn position-relative">
            🔔
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                3
            </span>
        </button>

        {{-- PROFILE --}}
        <div class="d-flex align-items-center gap-2">
            <img
                src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                class="rounded-circle"
                width="40"
                height="40"
            >
            <div>
                <div class="fw-semibold">
                    {{ auth()->user()->name }}
                </div>
                <small class="text-muted">
                    {{ auth()->user()->role ?? 'User' }}
                </small>
            </div>
        </div>

    </div>

</nav>