<x-guest-layout>
    <head>
        <meta charset="UTF-8">
        <title>About Us | mySoulmate@IIUM</title>
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

            .nav-logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: white;
    gap: 10px; /* space between image and text */
}

.nav-logo img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
}

.nav-logo span {
    font-weight: bold;
    font-size: 1.1rem;
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
                border: 2px solid #00ADC0;
            }

            /* About Section */
            .about-section {
                background: white;
                border-radius: 20px;
                box-shadow: 0 6px 12px rgba(0,0,0,0.15);
                width: 80%;
                max-width: 900px;
                margin: 60px auto;
                padding: 40px 60px;
                text-align: center;
            }

            .about-section h1 {
                color: #00ADC0;
                font-size: 36px;
                margin-bottom: 20px;
            }

            .about-section h2 {
                color: #333;
                font-size: 22px;
                margin-top: 30px;
            }

            .about-section p {
                color: #555;
                line-height: 1.8;
                font-size: 16px;
                margin-bottom: 20px;
            }

            .about-section img {
                width: 140px;
                height: 140px;
                border-radius: 50%;
                object-fit: cover;
                margin-bottom: 20px;
                box-shadow: 0 4px 12px rgba(0, 173, 192, 0.3);
                border: 3px solid #fff;
            }

            .values {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
                margin-top: 30px;
            }

            .value-box {
                background-color: #E0F7FA;
                border-radius: 15px;
                padding: 20px;
                width: 250px;
                margin: 10px;
                box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            }

            .value-box h3 {
                color: #00ADC0;
                margin-bottom: 10px;
            }

            .value-box p {
                color: #333;
                font-size: 14px;
            }

            /* Footer */
            footer {
                text-align: center;
                color: #777;
                padding: 20px;
                font-size: 13px;
            }

            @media (max-width: 768px) {
                .about-section {
                    padding: 30px 20px;
                }

                .about-section h1 {
                    font-size: 28px;
                }

                .values {
                    flex-direction: column;
                    align-items: center;
                }

                .value-box {
                    width: 80%;
                }
            }
        </style>
    </head>

    <!-- Navbar -->
    <nav class="navbar">

        <div class="logo">
             <a href="{{ url('/') }}" class="nav-logo">
    <img src="{{ asset('images/soulmate-iium-logo.jpeg') }}" alt="Soulmate@IIUM Logo">
    <span><strong>mySoulmate@IIUM</strong></span>
</a>
        </div>
        <div>
            <a href="#" class="active">About Us</a>
            <a href="#">Testimony</a>
            <a href="#">Pre-Marriage Knowledge</a>
            <a href="{{ route('login') }}">Login User</a>
        </div>
    </nav>

    <!-- About Us Content -->
    <div class="about-section">
        <h1>About mySoulmate@IIUM</h1>
        <p>
            <strong>mySoulmate@IIUM</strong> is a halal matchmaking platform created exclusively for IIUM students,
            inspired by Islamic values of <em>ta’aruf</em> (getting to know each other modestly) and sincerity.
            Our goal is to connect individuals who seek meaningful relationships built upon faith, respect,
            and the vision of forming a righteous family for the sake of Allah.
        </p>

        <h2>Our Vision</h2>
        <p>
            To become a trusted Islamic platform that nurtures love, understanding, and
            lifelong companionship among IIUM students — grounded in <strong>iman</strong> and <strong>akhlaq</strong>.
        </p>

        <h2>Our Mission</h2>
        <p>
            We aim to guide IIUM students in their journey of finding compatible life partners through a
            respectful, transparent, and Shariah-compliant system that encourages self-awareness and Islamic ethics.
        </p>

        <div class="values">
            <div class="value-box">
                <h3>🌸 Modesty</h3>
                <p>Interactions and profiles are monitored to maintain Islamic adab and privacy at all times.</p>
            </div>

            <div class="value-box">
                <h3>🤝 Trust</h3>
                <p>We build confidence by ensuring user authenticity and transparency through the IIUM network.</p>
            </div>

            <div class="value-box">
                <h3>💖 Purpose</h3>
                <p>We promote sincere connections aimed toward nikah — not casual dating — in line with Islamic values.</p>
            </div>
        </div>
    </div>

    <footer>
        © {{ date('Y') }} mySoulmate@IIUM. All rights reserved. | Inspired by BaitulJannah | Developed by IIUM Students
    </footer>
</x-guest-layout>
