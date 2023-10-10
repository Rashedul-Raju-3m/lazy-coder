@extends('layouts.app-login')

@section('body')
    <div class="form-box">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input id="email" placeholder="User Email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">


            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{--                        {{ __('Forgot Your Password?') }}--}}
                </a>
            @endif
            <button class="btn btn-primary btn-block login" type="submit">Login</button>
        </form>
    </div>
@endsection
