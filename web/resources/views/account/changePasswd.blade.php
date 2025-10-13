<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/change_passwd.css') }}">
    <title>Change Password</title>
</head>
<body>
    <div class="passwd-form">
        <form method="POST" action="">
            @csrf
            <h2>Change Password</h2>

            <label for="crpasswd" class="form-label">Current Password</label>
            <input type="password" id="crpasswd" name="crpasswd" placeholder="Enter current password" required class="form-input">

            <label for="newpasswd" class="form-label">New Password</label>
            <input type="password" id="newpasswd" name="newpasswd" placeholder="Enter new password" required class="form-input">

            <label for="otp" class="form-label">One-Time Password</label>
            <input type="number" id="otp" name="otp" placeholder="Enter OTP" required class="form-input">
            
            @if(session('error'))
            <div style="color: red; margin-bottom: 5px;">
                {{ session('error') }}
            </div>
            @endif
            <div class="button-row">
                <button type="button" id="btn-get-otp" class="btn-get-otp">Get OTP</button>
                <button type="submit" id="btn-submit" class="btn-submit">Submit</button>
            </div>
        </form>
    </div>

<script>
document.getElementById('btn-get-otp').addEventListener('click', function() {
    fetch('{{ route("account.upchangePasswd") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ action: 'get_otp' })
    })
    .then(res => res.json())
    .then(data => {
        alert('OTP: ' + data.otp); // hiển thị OTP nếu muốn
    });
});
</script>

</body>
</html>
