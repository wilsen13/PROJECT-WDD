<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SatuHati')</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    
    @stack('styles')
</head>
<body>
    <div class="navbar">
        <div class="brand">
            <div class="logo">
                <a href="{{ url('/') }}"><img src="{{ asset('image/Logo.png') }}" alt="SatuHati Logo"></a>
            </div>
            <a href="{{ url('/') }}" class="brand-name">SatuHati</a>
        </div>

        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Cari Donasi" id="searchInput">
            <div class="search-results" id="searchResults"></div>
        </div>

        <nav class="nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/donasi') }}">Donasi</a>
            <a href="{{ url('/news') }}">Berita</a>
            <a href="{{ url('/about') }}">Tentang Kami</a>
            <a href="{{ url('/faq') }}">FAQ</a>
        </nav>

        <div class="user-actions">
            <div class="language-selector"><span>ID</span></div>
            
            @auth
    <div class="dropdown ms-3">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark fw-bold" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            Halo, {{ Auth::user()->full_name }}
        </a>
        
        <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser1">
            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-gear me-2"></i> Edit Profil
                </a>
            </li>
            
            <li><hr class="dropdown-divider"></li>
            
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
@else
    <div class="btn-login"><a href="{{ route('login') }}">Login</a></div>
    <div class="btn-register"><a href="{{ route('register') }}">Daftar</a></div>
@endauth
        </div>
    </div>
    @yield('content')
    <footer style="background-color: #f8f9fa; padding: 60px 0 20px; border-top: 2px solid #e9ecef;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div style="text-align: center; margin-bottom: 40px;">
                <img src="{{ asset('image/Logo.png') }}" alt="SatuHati Logo" style="height: 60px; margin-bottom: 20px;">
                <p style="color: #6c757d; max-width: 600px; margin: 0 auto;">Bersama menciptakan harapan dan memberikan bantuan kepada mereka yang membutuhkan.</p>
            </div>
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; margin-bottom: 40px;">
                <div>
                    <h4 style="color: #2c3e50; font-weight: 600; margin-bottom: 20px;">Tentang Kami</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 12px;"><a href="{{ url('/about') }}" style="text-decoration: none; color: #6c757d;">Tentang SatuHati</a></li>
                        <li style="margin-bottom: 12px;"><a href="{{ url('/news') }}" style="text-decoration: none; color: #6c757d;">Berita</a></li>
                        <li style="margin-bottom: 12px;"><a href="{{ url('/contact') }}" style="text-decoration: none; color: #6c757d;">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="color: #2c3e50; font-weight: 600; margin-bottom: 20px;">Donasi</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 12px;"><a href="{{ url('/faq') }}" style="text-decoration: none; color: #6c757d;">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="color: #2c3e50; font-weight: 600; margin-bottom: 20px;">Sosial Media</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 12px;"><a href="#" style="text-decoration: none; color: #6c757d;"><i class="bi bi-facebook"></i> Facebook</a></li>
                        <li style="margin-bottom: 12px;"><a href="#" style="text-decoration: none; color: #6c757d;"><i class="bi bi-instagram"></i> Instagram</a></li>
                        <li style="margin-bottom: 12px;"><a href="#" style="text-decoration: none; color: #6c757d;"><i class="bi bi-twitter"></i> Twitter</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="color: #2c3e50; font-weight: 600; margin-bottom: 20px;">Kontak</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 12px; color: #6c757d;"><i class="bi bi-envelope"></i> info@satuhati.org</li>
                        <li style="margin-bottom: 12px; color: #6c757d;"><i class="bi bi-telephone"></i> +62123456789</li>
                        <li style="margin-bottom: 12px; color: #6c757d;"><i class="bi bi-geo-alt"></i> Tangerang, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div style="text-align: center; padding-top: 20px; border-top: 1px solid #dee2e6;">
                <p style="color: #6c757d; margin: 0;">© Kelompok 2</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/webdonasi.js') }}"></script>
    
    @stack('scripts')
</body>
</html>