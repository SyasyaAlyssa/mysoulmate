<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin | mySoulmate@IIUM')</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F5F5F5;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            background-color: #000;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 45px;
            width: 45px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        .logo span {
            font-weight: bold;
            font-size: 1.1rem;
            color: #B2F5EA;
        }

        .nav-links {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        .nav-links a,
        .nav-links button {
            color: #B2F5EA;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 20px;
            transition: 0.3s;
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 14px;
        }

        .nav-links a:hover,
        .nav-links a.active,
        .nav-links button:hover {
            background-color: #00ADC0;
            color: white;
        }

        .btn-logout {
            background-color: #00ADC0;
            color: white !important;
            font-weight: bold;
        }

        /* ================= PAGE CONTENT ================= */
        .page-container {
            max-width: 1100px;
            margin: auto;
            padding: 35px 25px;
        }

        .alert-success {
            background: #e6fffa;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}"
           style="display:flex; align-items:center; text-decoration:none;">
            <img src="{{ asset('images/soulmate-iium-logo.jpeg') }}" alt="Logo">
            <span>mySoulmate@IIUM</span>
        </a>
    </div>

    <ul class="nav-links">
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('admin.courses.index') }}"
               class="{{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                Pre-Marriage Courses
            </a>
        </li>

      

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn-logout">Logout</button>
            </form>
        </li>
    </ul>
</nav>

<!-- ================= PAGE CONTENT ================= -->
<main class="page-container">

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</main>

</body>
</html>
