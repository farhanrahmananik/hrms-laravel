@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $user = auth()->user();
        $stats = $stats ?? [];
        $recentEmployees = collect($stats['recent_employees'] ?? []);
        $recentLeaveRequests = collect($stats['recent_leave_requests'] ?? []);
        $recentPayrolls = collect($stats['recent_payrolls'] ?? []);

        $summaryCards = [
            ['label' => 'Total Employees', 'value' => $stats['total_employees'] ?? 0, 'icon' => 'bi-person-vcard', 'tone' => 'primary'],
            ['label' => 'Total Departments', 'value' => $stats['total_departments'] ?? 0, 'icon' => 'bi-diagram-3', 'tone' => 'success'],
            ['label' => 'Total Designations', 'value' => $stats['total_designations'] ?? 0, 'icon' => 'bi-award', 'tone' => 'info'],
            ['label' => 'Today Attendance', 'value' => $stats['today_attendance_count'] ?? 0, 'icon' => 'bi-calendar-check', 'tone' => 'warning'],
            ['label' => 'Pending Leave Requests', 'value' => $stats['pending_leave_requests_count'] ?? 0, 'icon' => 'bi-calendar2-week', 'tone' => 'danger'],
            ['label' => 'Current Month Payrolls', 'value' => $stats['current_month_payrolls_count'] ?? 0, 'icon' => 'bi-cash-stack', 'tone' => 'secondary'],
        ];

        $quickLinks = [
            ['label' => 'Employees', 'permission' => 'employee.view', 'route' => 'admin.employees.index', 'icon' => 'bi-person-vcard'],
            ['label' => 'Departments', 'permission' => 'department.view', 'route' => 'admin.departments.index', 'icon' => 'bi-diagram-3'],
            ['label' => 'Designations', 'permission' => 'designation.view', 'route' => 'admin.designations.index', 'icon' => 'bi-award'],
            ['label' => 'Attendance', 'permission' => 'attendance.view', 'route' => 'admin.attendance.index', 'icon' => 'bi-calendar-check'],
            ['label' => 'Leaves', 'permission' => 'leave.view', 'route' => 'admin.leaves.index', 'icon' => 'bi-calendar2-week'],
            ['label' => 'Payrolls', 'permission' => 'payroll.view', 'route' => 'admin.payrolls.index', 'icon' => 'bi-cash-stack'],
            ['label' => 'Roles', 'permission' => 'role.view', 'route' => 'admin.roles.index', 'icon' => 'bi-person-badge'],
        ];
    @endphp

    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Dashboard</h1>
            <p class="text-body-secondary mb-0">
                Welcome, {{ $user?->name ?? 'User' }}. HRMS overview and current system summary.
            </p>
        </div>
        <div class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2">
            {{ now()->format('M d, Y') }}
        </div>
    </div>

    <div class="row g-3 mb-4">
        @foreach ($summaryCards as $card)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-between gap-3">
                        <div>
                            <p class="text-body-secondary small mb-1">{{ $card['label'] }}</p>
                            <div class="h3 mb-0">{{ number_format((int) $card['value']) }}</div>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-center rounded bg-{{ $card['tone'] }}-subtle text-{{ $card['tone'] }}" style="width: 3rem; height: 3rem;">
                            <i class="bi {{ $card['icon'] }} fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">
                <div>
                    <h2 class="h5 mb-1">Quick Actions</h2>
                    <p class="text-body-secondary mb-0">Open modules available to your permissions.</p>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                @foreach ($quickLinks as $link)
                    @if ($user?->hasPermission($link['permission']) && Illuminate\Support\Facades\Route::has($link['route']))
                        <a href="{{ route($link['route']) }}" class="btn btn-outline-primary">
                            <i class="bi {{ $link['icon'] }} me-1"></i>
                            {{ $link['label'] }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3">
                    <h2 class="h5 mb-0">Recent Employees</h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentEmployees as $employee)
                                    @php
                                        $employeeName = $employee->user?->name
                                            ?: trim(($employee->first_name ?? '').' '.($employee->last_name ?? ''));
                                    @endphp
                                    <tr>
                                        <td class="fw-semibold">{{ $employeeName ?: 'N/A' }}</td>
                                        <td>{{ $employee->department?->name ?? 'N/A' }}</td>
                                        <td>{{ $employee->designation?->name ?? 'N/A' }}</td>
                                        <td>{{ $employee->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-body-secondary py-4">
                                            No recent employees found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3">
                    <h2 class="h5 mb-0">Recent Leave Requests</h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Employee</th>
                                    <th>Date Range</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentLeaveRequests as $leaveRequest)
                                    @php
                                        $employee = $leaveRequest->employee ?? null;
                                        $employeeName = $employee?->user?->name
                                            ?: trim(($employee->first_name ?? '').' '.($employee->last_name ?? ''));
                                        $status = $leaveRequest->status ?? null;
                                        $startDate = $leaveRequest->start_date ? \Illuminate\Support\Carbon::parse($leaveRequest->start_date)->format('M d, Y') : null;
                                        $endDate = $leaveRequest->end_date ? \Illuminate\Support\Carbon::parse($leaveRequest->end_date)->format('M d, Y') : null;
                                    @endphp
                                    <tr>
                                        <td class="fw-semibold">{{ $employeeName ?: 'N/A' }}</td>
                                        <td>{{ $startDate && $endDate ? $startDate.' - '.$endDate : 'N/A' }}</td>
                                        <td>
                                            @if ($status)
                                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                                    {{ ucfirst(str_replace('_', ' ', (string) $status)) }}
                                                </span>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $leaveRequest->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-body-secondary py-4">
                                            No recent leave requests found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3">
                    <h2 class="h5 mb-0">Recent Payrolls</h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Employee</th>
                                    <th>Pay Period</th>
                                    <th>Net Salary</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentPayrolls as $payroll)
                                    @php
                                        $employee = $payroll->employee ?? null;
                                        $employeeName = $employee?->user?->name
                                            ?: trim(($employee->first_name ?? '').' '.($employee->last_name ?? ''));
                                        $payPeriod = $payroll->payroll_month
                                            ?? ($payroll->month ?? null)
                                            ?? ($payroll->period_month ?? null)
                                            ?? ($payroll->payroll_run_id ? 'Run #'.$payroll->payroll_run_id : null);
                                        $payYear = $payroll->year ?? $payroll->period_year ?? null;
                                        $status = $payroll->payment_status ?? $payroll->status ?? null;
                                    @endphp
                                    <tr>
                                        <td class="fw-semibold">{{ $employeeName ?: 'N/A' }}</td>
                                        <td>{{ $payPeriod ? trim($payPeriod.' '.$payYear) : 'N/A' }}</td>
                                        <td>{{ isset($payroll->net_salary) ? number_format((float) $payroll->net_salary, 2) : 'N/A' }}</td>
                                        <td>
                                            @if ($status)
                                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                                    {{ ucfirst(str_replace('_', ' ', (string) $status)) }}
                                                </span>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $payroll->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-body-secondary py-4">
                                            No recent payroll records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
