<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('admin/loginstyle.css')}}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            @if (session('error'))
            <div class="alert alert-danger">{{(session('error'))}}</div>
          @endif
            <h2>User Register</h2>
            <form action="{{route('user.registed')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <label for="username">User Name</label>
                    <input type="username" id="username" name="name">
                    @error('name')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="username">User Email</label>
                    <input type="email" id="useremail" name="email">
                    @error('email')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="mobile">User Mobile</label>
                    <input type="text" id="usermobile" name="mobile">
                    @error('mobile')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    @error('password')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="login-button">Register</button>
            </form>
        </div>
    </div>
  </body>
</html>
