<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>This is user dashboard</h1>
    <ul>
    <!-- @if($LoggedUserInfo) -->
        <li>{{ $LoggedUserInfo['name'] }}</li>
        <li>{{ $LoggedUserInfo['email'] }}</li><br>
        <li><a href="{{route('user.logout')}}" >logout</a></li>
    <!-- @endif -->
    </ul>
</body>
</html>