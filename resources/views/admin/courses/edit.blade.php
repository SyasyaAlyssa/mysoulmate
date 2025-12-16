@extends('layouts.admin')

@section('content')
<div style="max-width:600px; margin:auto; padding:20px;">
    <h2>Edit Pre-Marriage Course</h2>

    <form method="POST"
          action="{{ route('admin.courses.update', $course->id) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div style="margin-bottom:15px;">
            <label>Course Title</label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $course->title) }}"
                   required
                   style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Description</label>
            <textarea name="description"
                      style="width:100%; padding:8px;">{{ old('description', $course->description) }}</textarea>
        </div>

        <div style="margin-bottom:15px;">
            <label>Current Image</label><br>
            @if($course->image)
                <img src="{{ asset('storage/'.$course->image) }}"
                     width="150"
                     style="border-radius:5px; margin-bottom:10px;">
            @else
                <p>No image uploaded</p>
            @endif
        </div>
        <div style="margin-bottom:15px;">
    <label>
        <input type="checkbox"
               name="is_published"
               value="1"
               {{ $course->is_published ? 'checked' : '' }}>
        Publish this course
    </label>
</div>


        <div style="margin-bottom:15px;">
            <label>Replace Image (optional)</label>
            <input type="file" name="image">
        </div>

        <button type="submit"
                style="background:#00ADC0; color:white; padding:10px 20px; border:none; border-radius:8px;">
            Update Course
        </button>

        <a href="{{ route('admin.courses.
