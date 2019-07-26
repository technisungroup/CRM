@extends('layouts.auth')
@section('content')
<section class="login-page">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="text-center col-lg-12 tech-logo">
                <img src="{{ asset('theme/images/logo.png') }}" alt="logo-image" class="img-fluid">
            </div>
            <div class="login-bg text-center col-lg-6">
                <div class="form-block">
                    <form action="{{ route('login') }}" class="login-form" method="post">
                        <h4>{{ __('Login') }}</h4>
                        @csrf
                        <div class="col-lg-10 col-md-10 offset-lg-1 ">
                            <div class="form-group">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10 offset-lg-1">
                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10 offset-lg-1 text-center">
                            <div class="select-location-box">
                                <div class="form-check mb-2 mr-sm-2">
                                    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10 offset-lg-1 text-center forgt-txt login-btn">
                            <button type="submit" class="btn  custom-btns">  {{ __('Login') }}</button>
                            <div class="forget-password">
                                <ul>
                                    <li>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <!--<div class="inner">&nbsp;</div>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
{{--@endsection--}}
