@extends('layouts.admin')

@section('title', 'Admin Dashboard | mySoulmate@IIUM')

@section('content')

<style>
    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0,0,0,.1);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card h3 {
        margin-bottom: 10px;
        color: #111;
    }

    .card p {
        color: #555;
        font-size: 14px;
    }

    .card a {
        display: inline-block;
        margin-top: 12px;
        background-color: #00ADC0;
        color: white;
        padding: 10px 20px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 14px;
        transition: 0.3s;
    }

    .card a:hover {
        background-color: #008b9b;
    }
</style>

<h1>Welcome, Admin!</h1>

<div class="grid">

    <div class="card">
        <h3>Upload Premarriage Course</h3>
        <p>Manage images, content, and knowledge resources.</p>
        <a href="{{ route('admin.courses.index') }}">Manage Courses</a>
    </div>


    <div class="card">
        <h3>View Student Matches</h3>
        <p>Monitor ta’aruf process & partner interactions.</p>
        <a href="#">Coming Soon</a>
    </div>

    <div class="card">
        <h3>View Messages</h3>
        <p>Check communication between matched partners.</p>
        <a href="#">Coming Soon</a>
    </div>

    <div class="card">
        <h3>Manage Users</h3>
        <p>Students, Guardians & Admin accounts.</p>
        <a href="#">Coming Soon</a>
    </div>

</div>

@endsection
