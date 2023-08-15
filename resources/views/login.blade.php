<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Login Page') }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
     href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('storage/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('storage/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('storage/assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img class="animation__shake" src="{{getStorage('settings','splash_image.png')}}" alt="AdminLTELogo"
                height="100" width="100">
        </div>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <b class="h1">{{ __('Login Page') }}</b>
            </div>
            <div class="card-body login-card-body">
                <ul>
                  @if (session()->has("error"))
                  <li class="text-danger text-bold">{{ session("error") }}</li>
                  @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li class="text-danger text-bold">{{ $error }}</li>
                        @endforeach
                    @endif
                </ul>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required value="admin">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        @csrf
                        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" required value="admin">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
                        </div>

                    </div>
                </form>

            </div>

        </div>
    </div>

</body>

</html>
