<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --admin-sidebar-width: 280px;
        }

        body {
            min-height: 100vh;
        }

        .admin-shell {
            min-height: 100vh;
        }

        .admin-sidebar {
            width: var(--admin-sidebar-width);
            min-height: 100vh;
        }

        .admin-main {
            min-width: 0;
        }

        .admin-content {
            max-width: 1440px;
        }

        .sidebar-link {
            color: rgba(255, 255, 255, .76);
        }

        .sidebar-link:hover,
        .sidebar-link:focus,
        .sidebar-link.active {
            color: #fff;
            background: rgba(255, 255, 255, .12);
        }

        .sidebar-section {
            color: rgba(255, 255, 255, .48);
            font-size: .72rem;
            letter-spacing: .08em;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-body-tertiary">
    <div class="admin-shell d-flex">
        <aside class="admin-sidebar d-none d-lg-flex flex-column bg-dark text-white">
            @include('partials.sidebar')
        </aside>

        <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
            <div class="offcanvas-header border-bottom border-secondary">
                <h5 class="offcanvas-title" id="adminSidebarLabel">{{ config('app.name', 'HRMS Laravel') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                @include('partials.sidebar')
            </div>
        </div>

        <div class="admin-main flex-grow-1 d-flex flex-column">
            @include('partials.navbar')

            <main class="flex-grow-1 py-4">
                <div class="admin-content container-fluid px-3 px-md-4 mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
