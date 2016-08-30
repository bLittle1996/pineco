<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>
<body>

  <div>
    <h2 style="font-weight: normal; color: #3d2b13; font-size: 30px;">so you want to change your password, {{ $user['username'] }}</h2>
    <p style="font-size: 20px; color: #49361c;">you will need the seven character code below to help you change your password</p>
    <p style="font-size: 20px; color: #49361c;">password change code: <span style="color: rgb(88, 137, 87);">{{ $user['password_token'] }}</span></p>
  </div>

</body>
</html>
