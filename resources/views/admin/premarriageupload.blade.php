<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Marriage Admin | mySoulmate@IIUM</title>
    <style>
        /* NAVBAR STYLING */
        .navbar {
            background-color: #000;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            position: relative;
            z-index: 2;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 45px;
            width: 45px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
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

        .nav-links a {
            color: #B2F5EA;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background-color: #00ADC0;
            color: white;
        }

        /* BODY */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 25px;
        }

        .student-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .student-info {
            display: flex;
            align-items: center;
        }

        .student-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }

        .student-info div {
            color: #333;
        }

        form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        input[type="file"] {
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
        }

        button {
            background-color: #00ADC0;
            border: none;
            color: white;
            padding: 8px 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        button:hover {
            background-color: #008b9b;
        }

        .success {
            text-align: center;
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <div class="navbar">
        <div class="logo">
            <a href="{{ url('/') }}" class="nav-logo" style="display:flex; align-items:center; text-decoration:none;">
                <img src="{{ asset('images/soulmate-iium-logo.jpeg') }}" alt="Soulmate@IIUM Logo">
                <span><strong>mySoulmate@IIUM</strong></span>
            </a>
        </div>

        <ul class="nav-links">
            <li><a href="{{ url('/about') }}">About Us</a></li>
            <li><a href="{{ url('/testimony') }}">Testimony</a></li>
            <li><a href="{{ url('/premarriageupload') }}" class="active">Pre-Marriage Knowledge</a></li>
            <li><a href="{{ route('login') }}" class="btn-admin">User Login</a></li>
        </ul>
    </div>

    <!-- CONTENT -->
    <div class="container">
        <h2>Pre-Marriage Photo Upload (Admin)</h2>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @foreach($students as $student)
            <div class="student-card">
                <div class="student-info">
                    @if($student->premarriage_photo)
                        <img src="{{ asset('storage/' . $student->premarriage_photo) }}" alt="Pre-Marriage Photo">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="No Photo">
                    @endif
                    <div>
                        <strong>{{ $student->name }}</strong><br>
                        ID: {{ $student->id }}
                    </div>
                </div>

                <form action="{{ route('admin.premarriage.upload', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="premarriage_photo" required>
                    <button type="submit">Upload</button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>
