<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles for Sidebar */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            margin-bottom: 5px;
        }
        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    {{request()->routeIs('dashboard')}}
    <h3 class="text-center">Dashboard</h3>
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Home</a>
    <a href="{{ route('dashboard.products') }}" class="{{ request()->routeIs('dashboard.products') ? 'active' : '' }}">Products</a>
    <a href="{{ route('dashboard.preorders') }}" class="{{ request()->routeIs('dashboard.preorders') ? 'active' : '' }}">Preorders</a>
    <a href="#" id="logout-link" class="{{ request()->routeIs('auth.logout') ? 'active' : '' }}">Logout</a>

    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>@yield('page-title', 'Dashboard')</h2>
        <span>Welcome,  {{\Illuminate\Support\Facades\Session::get('auth_user')->name}}</span>
    </div>

    <!-- Page Content -->
    @yield('content')
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('logout-link').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    });
</script>

</body>
</html>
