<!DOCTYPE html>
<html>
<head>
    <title>Choose Your Role</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        button { padding: 10px 20px; margin: 10px; font-size: 16px; }
    </style>
</head>
<body>
    <h1>Please Choose Your Role</h1>

    <form method="POST" action="{{ route('choose-role.save') }}">
        @csrf
        <button type="submit" name="role" value="guardian">Guardian</button>
        <button type="submit" name="role" value="student">Student</button>
        <button type="submit" name="role" value="admin">Admin</button>
    </form>
</body>
</html>
