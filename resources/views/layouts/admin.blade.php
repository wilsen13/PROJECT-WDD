<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SatuHati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { min-height: 100vh; display: flex; flex-direction: column; }
        .wrapper { display: flex; flex: 1; }
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #2c3e50;
            color: white;
            min-height: 100vh;
        }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 15px 20px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white; background: #34495e;
        }
        .content { flex: 1; padding: 20px; background: #f8f9fa; }
        .card-stat { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-success px-3">
        <a class="navbar-brand fw-bold" href="#">SatuHati Admin</a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3">Halo, {{ Auth::user()->full_name }}</span>
        </div>
    </nav>

    <div class="wrapper">
        <nav class="sidebar">
            <div class="py-4 px-3 mb-2 bg-dark">
                <small class="text-uppercase text-muted fw-bold">Menu Utama</small>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-megaphone me-2"></i> Kelola Campaign
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-newspaper me-2"></i> Kelola Berita
                    </a> -->
                <!-- </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <i class="bi bi-people me-2"></i> Data User
                    </a>
                </li>
                <li class="nav-item mt-5">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link bg-danger text-white border-0 w-100 text-start">
                            <i class="bi bi-box-arrow-left me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <main class="content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>