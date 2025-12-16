@extends('layouts.app') <!-- If you have a common layout -->

@section('content')
<div style="padding:30px; text-align:center;">
    <h1>Upload Student Picture</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.upload-photo.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="photo" required>
        <button type="submit" class="btn-manage">Upload</button>
    </form>
</div>
@endsection
