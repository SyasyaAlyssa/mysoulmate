<x-guest-layout>
    <head>
        <meta charset="UTF-8">
        <title>Login | Soulmate@IIUM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Doppio+One&family=EB+Garamond:wght@400;600&display=swap" rel="stylesheet">
        <style>
            body {
                margin: 0;
                background-color: #f3faff;
                font-family: "Doppio One", sans-serif;
            }
            /* Navbar */
            .navbar {
                background-color: #000;
                padding: 10px 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                color: white;
            }
            .navbar a {
                color: #B2F5EA;
                text-decoration: none;
                margin-inline: 5px;
                padding: 8px 10px;
                border-radius: 20px;
                transition: all 0.3s ease;
            }
            .navbar a:hover,
            .navbar a.active {
                background-color: #00ADC0;
                color: white;
            }
            .logo {
                display: flex;
                align-items: center;
            }
            .logo img {
                height: 40px;
                width: 40px;
                border-radius: 50%;
                object-fit: cover;
                margin-right: 12px;
            }
            /* Login Card */
            .card {
                background: white;
                border-radius: 15px;
                box-shadow: 0 6px 12px rgba(0,0,0,0.15);
                width: 500px;
                margin: 80px auto;
                padding: 30px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .center-content {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                width: 100%;
                margin-bottom: 20px;
            }
            .card img.logo-top {
                width: 140px;
                height: 140px;
                border-radius: 50%;
                object-fit: cover;
                box-shadow: 0 4px 12px rgba(0, 173, 192, 0.3);
                border: 3px solid #fff;
                display: block;
                margin: 0 auto;
            }
            .card input,
            .card select {
                width: 100%;
                padding: 10px;
                margin-bottom: 14px;
                border: none;
                border-radius: 0px;
                outline: none;
                background-color: #f9f9f9;
                box-shadow: 0 4px 8px rgba(0.1, 0, 0, 0.2);
                font-size: 14px;
                height: 42px;
                box-sizing: border-box;
                appearance: none;
            }
            .card input:focus,
            .card select:focus {
                background-color: #fff;
                box-shadow: 0 0 0 2px #00ADC0;
            }
            .card button {
                background-color: #00ADC0;
                color: white;
                padding: 10px;
                border: none;
                border-radius: 5px;
                font-weight: bold;
                width: 60%;
                cursor: pointer;
                transition: background 0.3s ease;
                display: block;
                margin: 20px auto 0 auto;
            }
            .card button:hover {
                background-color: #0097a7;
            }
            .card p {
                margin-top: 15px;
                font-size: 14px;
                color: #333;
                text-align: center;
            }
            .card p a {
                color: #00ADC0;
                font-weight: bold;
                text-decoration: none;
            }
            .card p a:hover {
                text-decoration: underline;
            }
            @media (max-width: 600px) {
                .card {
                    width: 90%;
                    padding: 20px;
                }
                .card img.logo-top {
                    width: 120px;
                    height: 120px;
                }
            }
        </style>
    </head>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/soulmate-iium-logo.jpeg') }}" alt="Soulmate Logo">
            <span>Soulmate @IIUM</span>
        </div>
        <div>
            <a href="#">About Us</a>
            <a href="#">Testimony</a>
            <a href="#">Pre-Marriage Knowledge</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </nav>

    <!-- Login Card -->
    <div class="card">
        <div class="center-content">
            <img src="{{ asset('images/soulmate-iium-logo.jpeg') }}" alt="Soulmate@IIUM" class="logo-top">
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- ROLE SELECTION -->
    <label for="role">Select Role</label>
    <select name="role" id="role" onchange="toggleFields()" required>
        <option value="">-- Choose Role --</option>
        <option value="student">Student</option>
        <option value="guardian">Guardian</option>
        <option value="admin">Admin</option>
    </select>

    <!-- STUDENT LOGIN FIELD -->
    <div id="matric-container" style="display: none;">
        <label for="matric_no">Matric Number</label>
        <input type="text" name="matric_no" id="matric_no">
    </div>

    <!-- GUARDIAN/ADMIN LOGIN FIELD -->
    <div id="email-container" style="display: none;">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>

    <!-- PASSWORD -->
    <label for="password">Password</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

<script>
function toggleFields() {
    const role = document.getElementById('role').value;

    if (role === "student") {
        document.getElementById('matric-container').style.display = "block";
        document.getElementById('email-container').style.display = "none";
    } else {
        document.getElementById('matric-container').style.display = "none";
        document.getElementById('email-container').style.display = "block";
    }
}
</script>

    </div>
</x-guest-layout>
