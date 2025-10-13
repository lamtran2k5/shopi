<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ asset('css/info.css') }}">
</head>
<body>
    <div class="edit-form-container">
        <h2>Info User</h2>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('account.upinfo', $user->id) }}" method="POST">
            @csrf

            <label>Full Name:</label>
            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}">

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}">

            <label>Phone:</label>
            <input type="number" name="sdt" value="{{ old('sdt', $user->sdt) }}">

            <label>Address:</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}">

            <div class="form-row">
                <label>Sex:</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="sex" value="1" {{ old('sex', $user->sex) == 1 ? 'checked' : '' }}>
                        Male
                    </label>
                    <label>
                        <input type="radio" name="sex" value="0" {{ old('sex', $user->sex) == 0 ? 'checked' : '' }}>
                        Female
                    </label>
                </div>
            </div>
            @if(session('error'))
            <div style="color: red; margin-bottom: 5px;">
                {{ session('error') }}
            </div>
            @endif
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
