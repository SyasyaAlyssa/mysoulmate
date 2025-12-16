<x-guest-layout>
<head>
    <meta charset="UTF-8">
    <title>Register | Soulmate@IIUM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Doppio+One&family=EB+Garamond:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background-color: #f3faff;
            font-family: "Doppio One", sans-serif;
        }

        .navbar { background-color: #000; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .navbar a { color: #B2F5EA; text-decoration: none; margin-inline: 5px; padding: 8px 10px; border-radius: 20px; transition: all 0.3s ease; }
        .navbar a:hover, .navbar a.active { background-color: #00ADC0; color: white; }
        .logo { display: flex; align-items: center; }
        .logo img { height: 40px; width: 40px; border-radius: 50%; object-fit: cover; margin-right: 12px; }

        .card { background: white; border-radius: 15px; box-shadow: 0 6px 12px rgba(0,0,0,0.15); width: 500px; margin: 80px auto; padding: 30px; display: flex; flex-direction: column; align-items: center; }
        .center-content { display: flex; justify-content: center; align-items: center; flex-direction: column; width: 100%; margin-bottom: 20px; }
        .card img.logo-top { width: 140px; height: 140px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; }
        .card input, .card select { width: 100%; padding: 10px; margin-bottom: 14px; border: none; border-radius: 0px; outline: none; background-color: #f9f9f9; box-shadow: 0 4px 8px rgba(0.1,0,0,0.2); font-size: 14px; height: 42px; box-sizing: border-box; }
        .card input:focus, .card select:focus { background-color: #fff; box-shadow: 0 0 0 2px #00ADC0; }
        .card button { background-color: #00ADC0; color: white; padding: 10px; border: none; border-radius: 5px; font-weight: bold; width: 60%; cursor: pointer; margin: 20px auto 0 auto; transition: background 0.3s ease; }
        .card button:hover { background-color: #0097a7; }
        .card p { margin-top: 15px; font-size: 14px; color: #333; text-align: center; }
        .card p a { color: #00ADC0; font-weight: bold; text-decoration: none; }
        .card p a:hover { text-decoration: underline; }

        @media (max-width: 600px) { 
            .card { width: 90%; padding: 20px; } 
            .card img.logo-top { width: 120px; height: 120px; } 
        }
    </style>
</head>

<nav class="navbar">
    <div class="logo">
        <img src="{{ asset('images/soulmate-iium-logo.jpeg') }}" alt="Soulmate Logo">
        <span>Soulmate @IIUM</span>
    </div>
    <div>
        <a href="#">About Us</a>
        <a href="#">Testimony</a>
        <a href="#">Pre-Marriage Knowledge</a>
        <a href="{{ route('login') }}">Login User</a>
    </div>
</nav>

<div class="card">
    <div class="center-content">
        <img src="{{ asset('images/soulmate-iium-logo.jpeg') }}" alt="Soulmate@IIUM" class="logo-top">
    </div>

    <x-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('register') }}" style="width: 100%;">
        @csrf

        <!-- ROLE -->
        <div>
            <x-label for="role" value="{{ __('Register as') }}" />
            <select id="role" name="role" required onchange="toggleMatricNo()">
                <option value="student" selected>Student</option>
                <option value="guardian">Guardian</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- NAME -->
        <div>
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>

        <!-- EMAIL (ADDED) -->
        <div>
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
        </div>

        <!-- MATRIC NUMBER (STUDENT ONLY) -->
        <div id="matric_no_field">
            <x-label for="matric_no" value="{{ __('Matric Number') }}" />
            <x-input id="matric_no" type="text" name="matric_no" :value="old('matric_no')" />
        </div>

        <!-- PASSWORD -->
        <div>
            <x-label for="password" value="{{ __('Password') }}" />
            <x-input id="password" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- CONFIRM PASSWORD -->
        <div>
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="mt-6 center-content">
            <button type="submit">{{ __('Register') }}</button>
        </div>

        <p>{{ __('Already registered?') }} <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
    </form>
</div>

<script>
    function toggleMatricNo() {
        const role = document.getElementById('role').value;
        const matricField = document.getElementById('matric_no_field');
        const matricInput = document.getElementById('matric_no');

        if(role === 'student') {
            matricField.style.display = 'block';
            matricInput.required = true;
        } else {
            matricField.style.display = 'none';
            matricInput.required = false;
        }
    }

    window.onload = toggleMatricNo;
</script>

</x-guest-layout>
