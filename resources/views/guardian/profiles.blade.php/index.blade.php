@extends('layouts.guardian')

@section('title','My Profile')

@section('content')
<h1 class="text-xl font-semibold mb-4">My Profile</h1>

@if($profile)
  <div class="bg-white p-6 rounded shadow">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
      <div class="col-span-1">
        <div class="h-48 w-full bg-gray-100 rounded overflow-hidden">
          @if($profile->photo)
            <img src="{{ asset('storage/'.$profile->photo) }}" alt="profile" class="object-cover h-full w-full">
          @else
            <div class="h-full flex items-center justify-center text-gray-400">No photo</div>
          @endif
        </div>
      </div>

      <div class="sm:col-span-2">
        <p class="text-lg font-medium">{{ $profile->name ?? '—' }}</p>
        <p class="text-sm text-gray-600">Phone: {{ $profile->phone ?? '—' }}</p>
        <p class="text-sm text-gray-600">Gender: {{ $profile->gender ?? '—' }}</p>
        <p class="text-sm text-gray-600">DOB: {{ $profile->dob ?? '—' }}</p>
      </div>
    </div>
  </div>
@else
  <div class="bg-yellow-50 border border-yellow-200 p-4 rounded">No profile uploaded yet by admin.</div>
@endif
@endsection
