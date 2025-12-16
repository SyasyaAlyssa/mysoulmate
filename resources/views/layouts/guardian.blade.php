<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Guardian | mySoulmate')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
  <nav style="background:black; box-shadow:0 2px 4px rgba(0,0,0,0.3);">
    <div style="
        max-width:1200px;
        margin:auto;
        padding:14px 30px;
        display:flex;
        align-items:center;
        justify-content:space-between;
    ">

        <!-- LEFT: LOGO / BRAND -->
        <div style="display:flex; align-items:center; gap:12px;">
             <img src="{{ asset('images/soulmate-iium-logo.jpeg') }}" alt="logo" class="h-10 w-10 rounded-full object-cover">
            <span style="color:#00e0e0; font-weight:600; font-size:18px;">
                mySoulmate@IIUM
            </span>
            <span style="color:#9ca3af; font-size:14px;">
                Guardian
            </span>
        </div>

        <!-- CENTER: NAV LINKS -->
        <div style="display:flex; gap:28px;">
            <a href="#" style="color:#7fffd4; text-decoration:none; font-size:15px;">
                About Us
            </a>
            <a href="#" style="color:#7fffd4; text-decoration:none; font-size:15px;">
                Testimony
            </a>
            <a href="{{ route('guardian.dashboard') }}"
               style="color:#7fffd4; text-decoration:none; font-size:15px;">
                Pre-Marriage Knowledge
            </a>
        </div>

        <!-- RIGHT: LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                style="
                    background:#00c2c2;
                    color:white;
                    padding:8px 18px;
                    border:none;
                    border-radius:20px;
                    font-size:14px;
                    cursor:pointer;
                ">
                Logout
            </button>
        </form>

    </div>
</nav>


  <main class="max-w-4xl mx-auto p-6">
    @yield('content')
  </main>
</body>
</html>
