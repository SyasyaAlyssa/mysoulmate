<h2>Upload Photo</h2>

<form method="POST" action="{{ route('admin.profiles.store') }}" enctype="multipart/form-data">
    @csrf

    <label>Select User:</label>
    <select name="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
        @endforeach
    </select>

    <label>Upload Photo:</label>
    <input type="file" name="photo">

    <button type="submit">Save</button>
</form>
