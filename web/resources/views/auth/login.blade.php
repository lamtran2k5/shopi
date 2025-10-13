<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <form action="{{ route('login.submit') }}" method="post">
                @csrf
                <div class="field input">
                    <label for="email">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                @if(session('error'))
                <div style="color: red; margin-bottom: 5px;">
                    {{ session('error') }}
                </div>
                @endif

                <div class="field">   
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="{{ route('register.form') }}">Sign Up Now</a>
                </div>
            </form>
        </div>
      </div>
</body>
</html>