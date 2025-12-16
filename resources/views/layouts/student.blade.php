<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Student | mySoulmate@IIUM')</title>

    <style>
        body {
            margin: 0;
            background: #f3f4f6;
            font-family: Arial, sans-serif;
        }

        /* NAVBAR */
        .navbar {
            background: #000;
            box-shadow: 0 2px 6px rgba(0,0,0,.35);
        }

        .nav-container {
            max-width: 1200px;
            margin: auto;
            padding: 12px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* BRAND */
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .brand-title {
            font-weight: 700;
            font-size: 17px;
            color: #7fffd4;
        }

        .role-badge {
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 20px;
            background: rgba(0, 224, 224, 0.15);
            color: #7fffd4;
        }

        /* LINKS */
        .nav-links {
            display: flex;
            gap: 26px;
        }

        .nav-links a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 14px;
            padding: 6px 14px;
            border-radius: 18px;
            transition: .25s;
            position: relative;
        }

        .nav-links a:hover {
            background: #00c2c2;
            color: white;
        }

        .nav-links a.active {
            background: #00c2c2;
            color: white;
            font-weight: 600;
        }

        /* NOTIFICATION BADGE */
        .badge {
            position: absolute;
            top: -6px;
            right: -12px;
            background: red;
            color: white;
            font-size: 11px;
            padding: 2px 6px;
            border-radius: 50%;
        }

        /* USER AREA */
        .user-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #00c2c2;
            transition: .2s;
        }

        .avatar:hover {
            transform: scale(1.05);
        }

        .logout-btn {
            background: #00c2c2;
            color: white;
            padding: 7px 16px;
            border: none;
            border-radius: 20px;
            font-size: 13px;
            cursor: pointer;
            transition: .25s;
        }

        .logout-btn:hover {
            background: #009999;
        }

        hr {
            border: none;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>

@php
    use App\Models\StudentNotification;

    $notificationCount = auth()->check()
        ? StudentNotification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count()
        : 0;
@endphp

<!-- NAVBAR -->
<nav class="navbar">
    <div class="nav-container">

        <!-- LEFT: BRAND -->
        <a href="{{ route('student.dashboard') }}" class="brand">
            <img src="{{ asset('images/soulmate-iium-logo.jpeg') }}" alt="logo">
            <span class="brand-title">mySoulmate@IIUM</span>
            <span class="role-badge">Student</span>
        </a>

        <!-- CENTER: NAV LINKS -->
        <div class="nav-links">

            <a href="{{ route('student.dashboard') }}"
               class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('student.courses.index') }}"
               class="{{ request()->routeIs('student.courses.*') ? 'active' : '' }}">
                Pre-Marriage Knowledge
            </a>

            <a href="{{ route('student.profile.index') }}"
               class="{{ request()->routeIs('student.profile.*') ? 'active' : '' }}">
                Profile
            </a>

            <a href="{{ route('student.messages.users') }}"
   class="{{ request()->routeIs('student.messages.*') ? 'active' : '' }}">
   Messages
</a>


            <!-- 🔔 NOTIFICATIONS -->
            <a href="{{ route('student.notifications.index') }}"
               class="{{ request()->routeIs('student.notifications.*') ? 'active' : '' }}">
                Notifications

                @if($notificationCount > 0)
                    <span class="badge">{{ $notificationCount }}</span>
                @endif
            </a>

        </div>

        <!-- RIGHT: USER -->
        <div class="user-area">
            <img
                src="{{ auth()->user()->profile_photo
                    ? asset('storage/profile/' . auth()->user()->profile_photo)
                    : asset('images/default-avatar.png') }}"
                class="avatar"
                alt="avatar">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

    </div>
</nav>

<hr>

{{-- PAGE CONTENT --}}
@yield('content')

</body>
</html>
