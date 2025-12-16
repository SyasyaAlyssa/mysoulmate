<h2>Edit Profile</h2>

<form method="POST" action="{{ route('admin.profiles.update', $profile->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Select User:</label>
    <select name="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $profile->user_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }} ({{ $user->role }})
            </option>
        @endforeach
    </select>

    <label>Current Photo:</label><br>
    <img src="{{ asset('storage/' . $profile->photo) }}" width="200"><br><br>

    <label>New Photo (optional):</label>
    <input type="file" name="photo">

    <button type="submit">Update</button>
</form>
