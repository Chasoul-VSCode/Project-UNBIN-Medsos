<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Redirecting to Login</title>
    <script>
        window.location.href = "{{ route('login') }}"; // Menggunakan route yang benar
    </script>
</head>
<body>
    <p>If you are not redirected automatically, follow this <a href="{{ route('login') }}">link to login</a>.</p>
</body>
</html>
