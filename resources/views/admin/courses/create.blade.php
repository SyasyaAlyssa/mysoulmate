@extends('layouts.admin')

@section('content')
<div style="max-width:600px; margin:auto; padding:20px;">
    <h2>Upload New Pre-Marriage Course</h2>

    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" style="margin-top:20px;">
        @csrf

        <div style="margin-bottom:15px;">
            <label for="title">Course Title</label><br>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                   style="width:100%; padding:8px; border-radius:5px; border:1px solid #ccc;">
            @error('title')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label for="description">Description</label><br>
            <textarea name="description" id="description" rows="4"
                      style="width:100%; padding:8px; border-radius:5px; border:1px solid #ccc;">{{ old('description') }}</textarea>
        </div>
        <div style="margin-bottom:15px;">
    <label>
        <input type="checkbox" name="is_published" value="1" checked>
        Publish this course (visible to students)
    </label>
</div>


        <div style="margin-bottom:15px;">
            <label for="image">Upload Image</label><br>
            <input type="file" name="image" id="image" accept="image/*">
            @error('image')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" style="background:#00ADC0; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;">
            Upload
        </button>
    </form>
</div>
@endsection
