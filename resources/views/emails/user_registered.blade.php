<!DOCTYPE html>
<html>
<head>
    <title>Welcome!</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}!</h1>
    <p>Thank you for registering on our platform.</p>
    <ul>
        <li><strong>Name:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Registration Date:</strong> {{ $user->created_at->format('d M Y, H:i:s') }}</li>
    </ul>
    <p>We are excited to have you onboard!</p>
</body>
</html>
