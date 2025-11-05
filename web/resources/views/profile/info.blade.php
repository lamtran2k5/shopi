<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ asset('css/info.css') }}">
</head>
<body>
    @php 
        use App\Models\User;
        $user = auth()->user();
    @endphp
    <div class="edit-form-container">
        <h2>Info User</h2>
        <form action="" method="POST">
            @csrf

            <label>Full Name:</label>
            <input type="text" name="name" value="{{ $user->name }}">

            <label>Email:</label>
            <input type="email" name="email" value="{{ $user->email }}">

            <label>Phone:</label>
            <input type="number" name="phone" value="{{ $user->phone }}">

            <label>Address:</label>
            <input type="text" name="address" value="{{ $user->address }}">
            
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
