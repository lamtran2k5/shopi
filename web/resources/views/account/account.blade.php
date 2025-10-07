<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
    <title>Document</title>
</head>
<body>
    @php 
        use App\Models\User;
        $userId = session('user_id');
        $user = $userId ? User::find($userId) : null;
        if ($user && $user->background_image) {
            $bg = '/upload/' . $user->background_image;
        } else {
            $bg = '/img/default.png';
        }
    @endphp
    <form action="" method="post" enctype="multipart/form-data" class="upload-form">
        @csrf
        <div class="avatar">
            <img src="{{ asset($bg) }}" alt="Avatar">
        </div>
        <label for="fileToUpload" class="upload-label">Select image to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" class="file-input">
        @if(session('error'))
        <div style="color: red; margin-bottom: 5px;">
            {{ session('error') }}
        </div>
        @endif
        <input type="submit" value="Upload Image" name="submit" class="btn-upload">
    </form>
</body>
</html>