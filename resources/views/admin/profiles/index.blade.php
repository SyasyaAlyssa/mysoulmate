<h2>All Student & Guardian Photos</h2>

<a href="{{ route('admin.profiles.create') }}">Upload New</a>

@foreach($profiles as $p)
    <div style="margin-bottom:20px">
        <p>{{ $p->user->name }} ({{ $p->user->role }})</p>
        <img src="{{ asset('storage/' . $p->photo) }}" width="200">

        <a href="{{ route('admin.profiles.edit', $p->id) }}">Edit</a>

        <form method="POST" action="{{ route('admin.profiles.destroy', $p->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach
