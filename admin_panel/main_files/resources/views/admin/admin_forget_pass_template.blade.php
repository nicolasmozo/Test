<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    {!! clean($template) !!}
    <a href="{{ route('admin.reset.password',$admin->forget_password_token) }}">{{ $admin->forget_password_token }}</a>
</body>
</html>
