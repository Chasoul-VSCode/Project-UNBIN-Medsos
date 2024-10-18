<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="register-container">
        <h1>Create Account</h1>
        <div id="passwordAlert" class="alert">Password must be at least 8 characters long.</div>
        <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">
            @csrf
            <div class="input-group">
                <input type="email" name="email" id="email" required autofocus placeholder=" ">
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <input type="text" name="npm" id="npm" required placeholder=" ">
                <label for="npm">NPM</label>
            </div>
            <div class="input-group">
                <input type="text" name="username" id="username" required placeholder=" ">
                <label for="username">Username</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" required placeholder=" " minlength="8">
                <label for="password">Password</label>
            </div>
            <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder=" " minlength="8">
                <label for="password_confirmation">Confirm Password</label>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login here</a>
        </div>
    </div>

<script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
