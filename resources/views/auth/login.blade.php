<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
 
</head>
<style>
   body {
    font-family: 'Roboto', sans-serif;
    background-color: #1a1a1a;
    color: #e0e0e0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-container {
    background-color: #2c2c2c;
    padding: 2.5rem;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    width: 350px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.logo {
    width: 80px;
    height: 80px;
    margin-bottom: 20px;
}

.logo img {
    width: 100%;
    height: auto;
}

form {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.input-group {
    position: relative;
    margin-bottom: 1.5rem;
    margin-right: 25px;
}

input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #444444;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s, box-shadow 0.3s;
    background-color: #333333;
    color: #e0e0e0;
}

input:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
}

label {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    background-color: #333333;
    padding: 0 4px;
    font-size: 0.9rem;
    color: #a0a0a0;
    transition: all 0.3s;
    pointer-events: none;
}

input:focus + label,
input:not(:placeholder-shown) + label {
    top: 0;
    font-size: 0.8rem;
    color: #3498db;
}

button {
    background-color: #3498db;
    color: white;
    padding: 0.75rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 1rem;
    font-weight: 500;
}

button:hover {
    background-color: #2980b9;
}

.register-link {
    text-align: center;
    margin-top: 1rem;
    font-size: 0.9rem;
}

.register-link a {
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
}

.register-link a:hover {
    text-decoration: underline;
}

.error-message {
    color: #e74c3c;
    text-align: center;
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .login-container {
        width: 90%;
        margin: 30px;
    }
}

</style>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('images/logo unbin.png') }}" alt="Logo">
        </div>
        <h1>Login</h1>
        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <input type="text" name="username" id="username" required autofocus placeholder=" ">
                <label for="username">Username</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" required placeholder=" ">
                <label for="password">Password</label>
            </div>
            <button type="submit">Log In</button>
        </form>
        <div class="register-link">
            Don't have an account? <a href="{{ route('register') }}">Register here</a>
        </div>
    </div>
</body>
</html>
