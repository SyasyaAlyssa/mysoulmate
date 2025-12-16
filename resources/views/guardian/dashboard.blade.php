@extends('layouts.guardian')

@section('content')
<div style="max-width:1200px; margin:auto; padding:30px;">

    <h2 style="margin-bottom:5px;">Welcome, {{ auth()->user()->name }}</h2>
    <p style="color:#555; margin-bottom:30px;">
        Guardian dashboard – view latest pre-marriage courses
    </p>

    <h3 style="margin-bottom:20px;">Published Pre-Marriage Courses</h3>

    @if($courses->count() == 0)
        <p>No published courses available.</p>
    @endif

    <div style="
        display:grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap:20px;
    ">
        @foreach($courses as $course)
            <div style="
                background:#fff;
                border-radius:12px;
                box-shadow:0 4px 12px rgba(0,0,0,0.08);
                overflow:hidden;
            ">

                {{-- Image --}}
                @if($course->image)
                    <img src="{{ asset('storage/'.$course->image) }}"
                         style="width:100%; height:180px; object-fit:cover;">
                @endif

                {{-- Content --}}
                <div style="padding:15px;">
                    <h4 style="margin-bottom:8px;">
                        {{ $course->title }}
                    </h4>

                    <p style="font-size:14px; color:#555;">
                        {{ $course->description }}
                    </p>

                    <div style="
                        font-size:13px;
                        color:#777;
                        margin-top:10px;
                        border-top:1px solid #eee;
                        padding-top:8px;
                    ">
                        👨‍👩‍👧 Guardian View Only
                    </div>
                </div>

            </div>
        @endforeach
    </div>

</div>
@endsection
