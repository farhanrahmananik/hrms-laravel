@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $user = auth()->user();

        // Real dashboard statistics will be added during module development.
        $cards = [
            ['label' => 'Employees', 'icon' => 'bi-person-vcard', 'text' => 'Employee directory overview'],
            ['label' => 'Departments', 'icon' => 'bi-diagram-3', 'text' => 'Department structure summary'],
            ['label' => 'Attendance', 'icon' => 'bi-calendar-check', 'text' => 'Daily attendance snapshot'],
            ['label' => 'Leave Requests', 'icon' => 'bi-calendar2-week', 'text' => 'Pending leave workflow'],
            ['label' => 'Payroll', 'icon' => 'bi-cash-stack', 'text' => 'Payroll processing status'],
            ['label' => 'Reports', 'icon' => 'bi-bar-chart', 'text' => 'Operational reporting hub'],
        ];
    @endphp

    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Dashboard</h1>
            <p class="text-body-secondary mb-0">Welcome, {{ $user->name }}.</p>
        </div>
        <div class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2">
            HRMS Laravel
        </div>
    </div>

    <div class="row g-3">
        @foreach ($cards as $card)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-start gap-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded bg-primary-subtle text-primary flex-shrink-0" style="width: 3rem; height: 3rem;">
                            <i class="bi {{ $card['icon'] }} fs-4"></i>
                        </div>
                        <div>
                            <h2 class="h5 mb-1">{{ $card['label'] }}</h2>
                            <p class="text-body-secondary mb-0">{{ $card['text'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
