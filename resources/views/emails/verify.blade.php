<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>
<body>

<div>
  <h2 style="font-weight: normal; color: #3d2b13; font-size: 30px;">you're almost there, {{ $user['username'] }}</h2>
  <p style="font-size: 20px; color: #49361c;">all that's left to do is to click the link below, this will verify your account and you can spend your life savings with us!</p>
  <p style="font-size: 20px; color: #49361c;">verification link: <a style="color: rgb(88, 137, 87);" href="{{ URL::to('verify/activate/' . $user['confirmation_token']) }}">{{ URL::to('verify/activate/' . $user['confirmation_token']) }}</a></p>
</div>

</body>
</html>
