<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SatuHati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column;
            font-family: 'Inter', Arial, sans-serif;
        }

        .wrapper { 
            display: flex; 
            flex: 1;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #2c3e50;
            color: white;
            min-height: 100vh;
            overflow-y: auto;
            position: relative;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar .nav-link { 
            color: rgba(255,255,255,0.8); 
            padding: 15px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover { 
            color: white;
            background: #34495e;
            border-left-color: #27ae60;
        }

        .sidebar .nav-link.active {
            color: white;
            background: #34495e;
            border-left-color: #27ae60;
        }

        .content { 
            flex: 1; 
            padding: 20px; 
            background: #f8f9fa;
            overflow-y: auto;
        }

        .card-stat { 
            border: none; 
            border-radius: 10px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            margin-right: 15px;
        }

        .navbar-brand {
            flex: 1;
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 768px) {
            .wrapper {
                position: relative;
            }

            .sidebar {
                position: fixed;
                left: 0;
                top: 56px;
                width: 100%;
                max-width: 100%;
                min-width: 100%;
                height: calc(100vh - 56px);
                transform: translateX(-100%);
                z-index: 1000;
                border-radius: 0;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-toggle {
                display: block;
            }

            .content {
                padding: 15px;
                width: 100%;
            }

            .navbar-brand {
                font-size: 18px;
            }

            /* Sidebar overlay backdrop */
            body.sidebar-open::before {
                content: '';
                position: fixed;
                top: 56px;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand {
                font-size: 16px;
            }

            .content {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-success px-3">
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
            <i class="bi bi-list"></i>
        </button>
        <a class="navbar-brand fw-bold" href="#">SatuHati Admin</a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3">Halo, {{ Auth::user()->full_name }}</span>
        </div>
    </nav>

    <div class="wrapper">
        <nav class="sidebar" id="sidebar">
            <div class="py-4 px-3 mb-2 bg-dark">
                <small class="text-uppercase text-muted fw-bold">Menu Utama</small>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.user') }}">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const body = document.body;

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                body.classList.toggle('sidebar-open');
            });

            // close sidebar
            const navLinks = sidebar.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('active');
                        body.classList.remove('sidebar-open');
                    }
                });
            });

            // untuk tampilan mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                        body.classList.remove('sidebar-open');
                    }
                }
            });
        });
    </script>
</body>
</html>