<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FMIS | User Login</title>
<link rel="icon" href="{{ asset('assets/login-workspace/images/nemsu-logo.png') }}">
<link rel="stylesheet" href="{{ asset('assets/login-workspace/vendors/dist/css/adminlte.min.css?v=3.2.0') }}">
<link href="{{ asset('assets/layouts/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/layouts/css/style.css') }}" rel="stylesheet">

<style>
    /* .fa-google {
        background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        -webkit-text-fill-color: transparent;
    } */

    /* Center the content within the body */
    body {
        display: flex;
        flex-direction: column; /* Stack children vertically */
        justify-content: center;
        align-items: center;
        min-height: 100vh; /* Ensure the body covers the full viewport height */
    }

    /* Style the footer */
    /* footer {
        margin-top: auto; 
        text-align: center;
    } */
</style>
</head>
<body class="hold-transition">
    
    <div class="login-box mt-2">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1">
                    <img src="{{ asset('assets/login-workspace/images/nemsu-logo.png') }}" class="img-fluid" style="width: 100px;">
                </a>
                <p class="login-box-msg"></p>
            </div>
            <div class="card-body">
              
                {{-- <div class="text-center my-4">
                    <p class="text-center fw-bold mb-0 text-muted">OR</p>
                </div> --}}
                
                <div class="text-center my-2">
                    {{-- <p class="text-center fw-bold mb-0 text-muted">OR</p> --}}
                </div>

                <div class="text-center my-2">
                    <p class="text-center fw-bold mb-0 text-muted">USER LOGIN</p>
                </div>
                <form method="POST" action="{{ route('login') }}">

                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId">
                            @error('email')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
                        @error('password')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                    </div>
                </form>

            
            </div>
        </div>
    </div>

    <footer class="mt-2 text-muted text-center text-sm">
    {{-- <footer class="mt-5 text-muted text-center text-sm border-top pt-5"> --}}

        <p class="mb-1">&copy; 2024 <a href="https://nemsu.edu.ph/" class="font-weight-bold text-dark" target="_blank">North Eastern Mindanao State University</a>, All Rights Reserved.</p>
        <p class="mb-1">Developed and Maintained by <a href="https://dev-directory.nemsu.edu.ph/" target="_blank" class="font-weight-bold text-dark">ICT Unit</a></p>

        {{-- <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul> --}}
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="mailto:ict@nemsu.edu.ph">ict@nemsu.edu.ph</a> | <a href="mailto:webteam@nemsu.edu.ph">webteam@nemsu.edu.ph</a>
            </li>
        </ul>
    </footer>

    <script src="{{ asset('assets/layouts/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
