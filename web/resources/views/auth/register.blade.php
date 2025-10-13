<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <form action="{{ route('register.submit') }}" method="post">
                @csrf
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div>
                    <input type="radio" id="user" name="role" value=2 required>
                    <label for="user">User</label>

                    <input type="radio" id="shop" name="role" value=3 required>
                    <label for="shop">Shop</label>
                </div>
                @if(session('error'))
                <div style="color: red; margin-bottom: 5px;">
                    {{ session('error') }}
                </div>
                @endif
                <div class="field">                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="{{ route('login.form') }}">Sign In</a>
                </div>
            </form>
        </div>
      </div>
</body>
</html>