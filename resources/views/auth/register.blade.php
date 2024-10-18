<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #1a1a1a;
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .register-container {
            background-color: #2c2c2c;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: #ffffff;
            font-weight: 500;
            font-size: 2rem;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #444444;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #333333;
            color: #e0e0e0;
        }
        input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.3);
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
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
        .login-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .login-link a:hover {
            color: #2980b9;
            text-decoration: underline;
        }
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            display: none;
        }
    </style>
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

    <script>
        function validateForm() {
            var password = document.getElementById('password').value;
            var alert = document.getElementById('passwordAlert');
            
            if (password.length < 8) {
                alert.style.display = 'block';
                return false;
            }
            
            alert.style.display = 'none';
            return true;
        }
    </script>
</body>
</html>
