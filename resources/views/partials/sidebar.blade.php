@php
    $user = auth()->user();

    // Replace placeholder href values with named routes as each module is implemented.
    $menuItems = [
        ['label' => 'Dashboard', 'permission' => 'dashboard.view', 'href' => route('dashboard'), 'icon' => 'bi-speedometer2', 'active' => request()->routeIs('dashboard')],
        ['label' => 'User Management', 'permission' => 'user.view', 'href' => '#', 'icon' => 'bi-people', 'active' => false],
        ['label' => 'Roles', 'permission' => 'role.view', 'href' => route('admin.roles.index'), 'icon' => 'bi-person-badge', 'active' => request()->routeIs('admin.roles.*')],
        ['label' => 'Permissions', 'permission' => 'permission.view', 'href' => route('admin.permissions.index'), 'icon' => 'bi-shield-lock', 'active' => request()->routeIs('admin.permissions.*')],
        ['label' => 'Employees', 'permission' => 'employee.view', 'href' => Illuminate\Support\Facades\Route::has('admin.employees.index') ? route('admin.employees.index') : '#', 'icon' => 'bi-person-vcard', 'active' => request()->routeIs('admin.employees.*')],
        ['label' => 'Departments', 'permission' => 'department.view', 'href' => Illuminate\Support\Facades\Route::has('admin.departments.index') ? route('admin.departments.index') : '#', 'icon' => 'bi-diagram-3', 'active' => request()->routeIs('admin.departments.*')],
        ['label' => 'Designations', 'permission' => 'designation.view', 'href' => Illuminate\Support\Facades\Route::has('admin.designations.index') ? route('admin.designations.index') : '#', 'icon' => 'bi-award', 'active' => request()->routeIs('admin.designations.*')],
        ['label' => 'Attendance', 'permission' => 'attendance.view', 'href' => Illuminate\Support\Facades\Route::has('admin.attendance.index') ? route('admin.attendance.index') : '#', 'icon' => 'bi-calendar-check', 'active' => request()->routeIs('admin.attendance.*')],
        ['label' => 'Leave Management', 'permission' => 'leave.view', 'href' => Illuminate\Support\Facades\Route::has('admin.leaves.index') ? route('admin.leaves.index') : '#', 'icon' => 'bi-calendar2-week', 'active' => request()->routeIs('admin.leaves.*')],
        ['label' => 'Payroll', 'permission' => 'payroll.view', 'href' => Illuminate\Support\Facades\Route::has('admin.payrolls.index') ? route('admin.payrolls.index') : '#', 'icon' => 'bi-cash-stack', 'active' => request()->routeIs('admin.payrolls.*')],
        ['label' => 'Reports', 'permission' => 'report.view', 'href' => Illuminate\Support\Facades\Route::has('admin.reports.index') ? route('admin.reports.index') : '#', 'icon' => 'bi-bar-chart', 'active' => request()->routeIs('admin.reports.*')],
    ];
@endphp

<div class="d-flex flex-column h-100">
    <div class="px-4 py-4 border-bottom border-secondary">
        <a href="{{ route('dashboard') }}" class="d-inline-flex align-items-center gap-2 text-white text-decoration-none">
            <span class="d-inline-flex align-items-center justify-content-center rounded bg-primary" style="width: 2.25rem; height: 2.25rem;">
                <i class="bi bi-building"></i>
            </span>
            <span class="fw-semibold">{{ config('app.name', 'HRMS Laravel') }}</span>
        </a>
    </div>

    <nav class="flex-grow-1 overflow-auto p-3" aria-label="Main navigation">
        <div class="sidebar-section fw-semibold text-uppercase mb-2">Workspace</div>

        <ul class="nav nav-pills flex-column gap-1">
            @foreach ($menuItems as $item)
                @if ($user?->hasPermission($item['permission']))
                    <li class="nav-item">
                        <a
                            href="{{ $item['href'] }}"
                            class="nav-link sidebar-link d-flex align-items-center gap-2 rounded-2 px-3 py-2 {{ $item['active'] ? 'active' : '' }}"
                            @if ($item['href'] === '#') aria-disabled="true" @endif
                        >
                            <i class="bi {{ $item['icon'] }}"></i>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
</div>
