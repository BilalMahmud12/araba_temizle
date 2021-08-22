@extends('dashboard.user.auth.auth-layout')

@section('content')
    <main class="max-w-5xl">
        <div class="company-brand flex items-center justify-center mb-6">
            <img src="{{ asset('site/images/araba_temizle_logo.svg') }}" alt="araba_temizle_logo" width="160px">
        </div>
        <div class="login-form-container mx-auto">
            <form method="POST" action="{{ route('login') }}" autocomplete="off" class="user-login-form">
                @csrf

                <div class="form-group">
                    <label for="email" class="user-login-label">{{ __('E-Mail Address') }}</label>
                    <div class="input-group">
                        <input id="email" type="email" class="user-login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="user-login-label">{{ __('Password') }}</label>
                    <div class="input-group">
                        <input id="password" type="password" class="user-login-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="flex justify-center rounded-lg w-full px-6 py-2.5 bg-gray-800 hover:bg-green-600 text-white mt-5">Login</button>
            </form>
        </div>
        <div class="w-[350px] flex justify-center">
            <a class="text-sm text-center text-gray-300 hover:text-red-600" href="">{{ __('forgot your password?') }}</a>
        </div>
    </main>
@stop
