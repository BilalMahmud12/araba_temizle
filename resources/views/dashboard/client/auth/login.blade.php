@extends('dashboard.client.auth.auth-layout')

@section('content')
    <main class="max-w-5xl">
        <div class="company-brand flex items-center justify-center mb-6">
            <img src="{{ asset('site/images/araba_temizle_logo.svg') }}" alt="araba_temizle_logo" width="160px">
        </div>
        <div class="login-form-container mx-auto">
            <form method="POST" action="{{ route('client.check') }}" autocomplete="off" class="user-login-form">
                @csrf

                @if( Session::get('fail') )
                    <div class="flex items-center justify-center px-6 py-3 mb-4 rounded-lg bg-red-50 text-xs text-red-800 text-center">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="phone" class="user-login-label">{{ __('Phone Number') }}</label>
                    <div class="input-group">
                        <input id="phone" type="number" placeholder="5xx xxx xxxx" class="user-login-input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                        @error('phone')
                        <span class="flex text-xs mt-1 text-red-600" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="user-login-label">{{ __('Password') }}</label>
                    <div class="input-group">
                        <input id="password" type="password" class="user-login-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="flex text-xs mt-1 text-red-600" role="alert">
                        {{ $message }}
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

