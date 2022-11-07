<!DOCTYPE html>
<html>
<head>
    <title>MyMessager</title>
</head>
<body>
    
    <h3>{{ $details['title'] }}</h3>
    <p>{{ $details['body'] }}<br><br>
    {{ $details['info'] }}<br><br>
     Email Address: {{ $details['email'] }}<br><br>
      Fullname: {{ $details['fullname'] }}<br><br>
        @if ($details['status'] == 1)
              Congrats! Your Account is Activated, you can now login.
@else
             Oops! Your Account is Deactivated, you have been denied access.     
        @endif
   </p>
    <p>Regards</p> 
    Administrator<br>MyMessager
</body>
</html>