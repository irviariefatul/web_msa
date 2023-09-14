@extends('layouts.app2')

@section('content')
    <div class="login-wrap p-4 p-lg-5">
        <div class="d-flex">
            <div class="w-100">
                <h3 class="mb-4">Sign In</h3>
            </div>
            <div class="w-100">
                <p class="social-media d-flex justify-content-end align-items-center">
                    <a href="mailto:cs@gmail.com?subject=Permintaan%20Akun%20Baru"
                        class="social-icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-envelope"></span>
                    </a>
                    <a>
                        <span class="email-text">cs@gmail.com</span>
                    </a>
                </p>
            </div>
        </div>
        <form method="POST" action="{{ route('login') }}" class="signin-form">
            @csrf

            <div class="form-group mb-3">
                <label class="label" for="name">{{ __('Username') }}</label>
                <input id="username" type="username" placeholder="Username"
                    class="form-control @error('username') is-invalid @enderror" name="username"
                    value="{{ old('username') }}" required autocomplete="username" autofocus>

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="label" for="password">{{ __('Password') }}</label>
                <input id="password" type="password" placeholder="Password"
                    class="form-control @error('password') is-invalid @enderror" name="password" required
                    autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" class="form-control btn btn-primary submit px-3" value="Sign In">
            </div>
        </form>
    </div>
@endsection
