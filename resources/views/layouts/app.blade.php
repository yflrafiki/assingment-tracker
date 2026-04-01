<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Activity Tracker') - nPunto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
            padding-top: 56px;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .container-fluid {
            flex: 1;
        }
        footer {
            flex-shrink: 0;
            margin-top: auto;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 56px;
            width: 16.66667%;
            height: calc(100vh - 56px);
            background-color: #212529;
            overflow-y: auto;
            padding-top: 1rem;
        }
        .sidebar a {
            color: #a8aaaf;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #343a40;
            color: #fff;
            border-left-color: #0d6efd;
        }
        .sidebar a.active {
            background-color: #343a40;
            color: #fff;
            border-left-color: #0d6efd;
        }
        .main-content {
            padding: 2rem;
            margin-left: 16.66667%;
            margin-top: 56px;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
        }
        .badge-pending {
            background-color: #ffc107;
            color: #000;
        }
        .badge-done {
            background-color: #28a745;
            color: #fff;
        }
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        .welcome-page {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
    </style>
    @yield('styles')
</head>
<body>
    @include('layouts.navbar')
    
    <div class="container-fluid">
        <div class="row">
            @auth
                <div class="col-md-2 sidebar d-none d-lg-block">
                    @include('layouts.sidebar')
                </div>
                <div class="col-12 col-lg-10 main-content">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            @else
                <div class="col-12">
                    @yield('content')
                </div>
            @endauth
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2026 Activity Tracker by Raphael Taylor</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
