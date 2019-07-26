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

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <form class="login-form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h4>FORGOT PASSWORD?</h4>
                        <div class="col-lg-10 col-md-10 offset-lg-1">
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10 offset-lg-1 text-center forgt-txt login-btn">
                            <button type="submit" class="btn  custom-btns">SUBMIT</button>
                            <div class="forget-password">
                                <ul>
                                    <li><a href="{{ route('login') }}">Back</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

