@extends('layouts.admin')

@section('content')
<div style="max-width:1000px; margin:auto; padding:30px;">

    <h2 style="margin-bottom:20px;">📘 Pre-Marriage Courses</h2>

    <!-- Upload new course button -->
    <a href="{{ route('admin.courses.create') }}"
       style="
            padding:10px 18px;
            background:#00ADC0;
            color:white;
            border-radius:8px;
            text-decoration:none;
            display:inline-block;
            margin-bottom:25px;
            font-weight:600;
       ">
        + Upload New Course
    </a>

    <!-- Success message -->
    @if(session('success'))
        <div style="
            background:#e6fffa;
            color:#065f46;
            padding:12px 16px;
            border-radius:6px;
            margin-bottom:20px;
        ">
            {{ session('success') }}
        </div>
    @endif

    <ul style="list-style:none; padding:0;">
        @forelse($courses as $course)
            <li style="
                margin-bottom:25px;
                padding:20px;
                background:#ffffff;
                border-radius:10px;
                box-shadow:0 4px 10px rgba(0,0,0,0.08);
            ">

                <!-- TITLE + STATUS -->
                <div style="display:flex; align-items:center; justify-content:space-between;">
                    <strong style="font-size:18px;">{{ $course->title }}</strong>

                    @if($course->is_published)
                        <span style="
                            background:#dcfce7;
                            color:#166534;
                            padding:5px 12px;
                            border-radius:20px;
                            font-size:12px;
                            font-weight:600;
                        ">
                            Published
                        </span>
                    @else
                        <span style="
                            background:#fee2e2;
                            color:#991b1b;
                            padding:5px 12px;
                            border-radius:20px;
                            font-size:12px;
                            font-weight:600;
                        ">
                            Hidden
                        </span>
                    @endif
                </div>

                <!-- DESCRIPTION -->
                <p style="margin-top:10px; color:#444;">
                    {{ $course->description }}
                </p>

                <!-- IMAGE -->
                @if($course->image)
                    <img src="{{ asset('storage/' . $course->image) }}"
                         width="220"
                         style="margin-top:12px; border-radius:8px;">
                @endif

                <!-- ACTION BUTTONS -->
                <div style="margin-top:15px;">

                    <!-- EDIT -->
                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                       style="
                            background:#1890ff;
                            color:white;
                            padding:7px 14px;
                            border-radius:6px;
                            text-decoration:none;
                            margin-right:8px;
                            font-size:14px;
                       ">
                        Edit
                    </a>

                    <!-- PUBLISH / UNPUBLISH -->
                    <form action="{{ route('admin.courses.toggle-publish', $course->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('PATCH')

                        <button type="submit"
                                style="
                                    background: {{ $course->is_published ? '#f59e0b' : '#22c55e' }};
                                    color:white;
                                    padding:7px 14px;
                                    border:none;
                                    border-radius:6px;
                                    margin-right:8px;
                                    cursor:pointer;
                                ">
                            {{ $course->is_published ? 'Unpublish' : 'Publish' }}
                        </button>
                    </form>

                    <!-- DELETE -->
                    <form action="{{ route('admin.courses.destroy', $course->id) }}"
                          method="POST"
                          style="display:inline;"
                          onsubmit="return confirm('Are you sure you want to delete this course?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                style="
                                    background:#ff4d4f;
                                    color:white;
                                    padding:7px 14px;
                                    border:none;
                                    border-radius:6px;
                                    cursor:pointer;
                                ">
                            Delete
                        </button>
                    </form>

                </div>
            </li>
        @empty
            <p style="color:#555;">No courses uploaded yet.</p>
        @endforelse
    </ul>

</div>
@endsection
