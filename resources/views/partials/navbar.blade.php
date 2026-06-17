@php
    $user = auth()->user();
    $roles = collect();

    if ($user !== null) {
        $roles = $user->relationLoaded('roles') ? $user->roles : $user->roles()->orderBy('name')->get();
    }
@endphp

<nav class="navbar navbar-expand bg-white border-bottom sticky-top">
    <div class="container-fluid px-3 px-md-4">
        <button
            class="btn btn-outline-secondary d-lg-none me-2"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#adminSidebar"
            aria-controls="adminSidebar"
            aria-label="Open navigation"
        >
            <i class="bi bi-list"></i>
        </button>

        <div class="d-flex flex-column">
            <span class="navbar-brand mb-0 h1 fs-5">@yield('title', 'Dashboard')</span>
            <span class="text-body-secondary small d-none d-sm-inline">HRMS administration</span>
        </div>

        <div class="dropdown ms-auto">
            <button class="btn btn-light border d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary" style="width: 2rem; height: 2rem;">
                    <i class="bi bi-person"></i>
                </span>
                <span class="d-none d-md-flex flex-column align-items-start lh-sm">
                    <span class="fw-semibold">{{ $user?->name }}</span>
                    @if ($roles?->isNotEmpty())
                        <span class="small text-body-secondary">{{ $roles->pluck('name')->join(', ') }}</span>
                    @endif
                </span>
                <i class="bi bi-chevron-down small text-body-secondary"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-end shadow-sm">
                <div class="px-3 py-2">
                    <div class="fw-semibold">{{ $user?->name }}</div>
                    <div class="small text-body-secondary">{{ $user?->email }}</div>
                    @if ($roles?->isNotEmpty())
                        <div class="small text-body-secondary mt-1">{{ $roles->pluck('name')->join(', ') }}</div>
                    @endif
                </div>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item d-flex align-items-center gap-2">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
