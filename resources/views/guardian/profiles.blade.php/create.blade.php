@extends('layouts.admin')

@section('title','Upload Profile')

@section('content')
<h1 class="text-xl font-semibold mb-4">Upload Profile</h1>

<form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">
  @csrf

  <div>
    <label class="block text-sm font-medium mb-1">Assign to User (ID)</label>
    <input type="number" name="user_id" value="{{ old('user_id') }}" class="w-full border rounded px-3 py-2" placeholder="Enter user id" required>
    <p class="text-xs text-gray-400 mt-1">You can put the user id for the student or guardian that will get this profile.</p>
    @error('user_id') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Name</label>
    <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
    @error('name') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Photo (jpg, png)</label>
    <input type="file" name="photo" accept="image/*" class="w-full">
    @error('photo') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="flex gap-2">
    <a href="{{ route('admin.profiles.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancel</a>
    <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded">Save</button>
  </div>
</form>
@endsection
