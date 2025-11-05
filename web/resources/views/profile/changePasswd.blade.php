<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/changepasswd.css') }}">
    <title>Change Password</title>
</head>
<body>
    <div class="passwd-form">
        <form method="POST" action="{{ route('profile.upchangePasswd') }}">
            @csrf
            <h2>Change Password</h2>

            <label for="crpasswd" class="form-label">Current Password</label>
            <input type="password" id="crpasswd" name="crpasswd" placeholder="Enter current password" required class="form-input">

            <label for="newpasswd" class="form-label">New Password</label>
            <input type="password" id="newpasswd" name="newpasswd" placeholder="Enter new password" required class="form-input">
            
            <div class="button-row">
                <button type="submit" id="btn-submit" class="btn-submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
