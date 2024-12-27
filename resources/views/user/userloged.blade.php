<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('admin/loginstyle.css')}}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            @if (session('error'))
            <div class="alert alert-danger">{{(session('error'))}}</div>
          @endif
            <h2>User Login</h2>
            <form action="{{route('user.loged')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <label for="username">User Email</label>
                    <input type="email" id="useremail" name="email">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
