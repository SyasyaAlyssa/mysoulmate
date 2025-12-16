@extends('layouts.admin')

@section('title','Edit Profile')

@section('content')
<h1 class="text-xl font-semibold mb-4">Edit Profile</h1>

<form action="{{ route('admin.profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">
  @csrf @method('PUT')

  <div>
    <label class="block text-sm font-medium mb-1">User ID</label>
    <input type="number" name="user_id" value="{{ old('user_id', $profile->user_id) }}" class="w-full border rounded px-3 py-2" required>
    @error('user_id') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Name</label>
    <input type="text" name="name" value="{{ old('name', $profile->name) }}" class="w-full border rounded px-3 py-2" required>
    @error('name') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Current Photo</label>
    <div class="h-44 w-full bg-gray-100 rounded overflow-hidden">
      @if($profile->photo)
        <img src="{{ asset('storage/'.$profile->photo) }}" class="object-cover h-full w-full">
      @else
        <div class="flex items-center justify-center h-full text-gray-400">No photo</div>
      @endif
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Replace Photo (optional)</label>
    <input type="file" name="photo" accept="image/*" class="w-full">
    @error('photo') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="flex gap-2">
    <a href="{{ route('admin.profiles.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancel</a>
    <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded">Update</button>
  </div>
</form>
@endsection
