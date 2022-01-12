@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter">
        <div class="container">
            <div class="row">
                <div class="ml-auto mr-auto col-lg-4 col-md-6 col-sm-8">
                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card card-login">
                            <div class="text-center card-header card-header-primary">
                                <h4 class="card-title">{{ trans('global.login') }}</h4>
                            </div>

                            @if(session('status'))
                                <div class="card-body" style="padding: .9375rem 20px;">
                                    <p class="alert alert-info">
                                        {{ session('status') }}
                                    </p>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">email</i>
                                            </span>
                                        </div>
                                        <input name="email" type="email" class="form-control" placeholder="{{ trans('global.login_email') }}..." value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                    @error('email')
                                        <div class="error" for="email">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                        </div>
                                        <input name="password" type="password" class="form-control" placeholder="{{ trans('global.login_password') }}..." autocomplete="current-password" required>
                                    </div>
                                    @error('password')
                                        <div class="error" for="email">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember" class="form-check-input">
                                        <span class="form-check-sign"><span class="check"></span></span>
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer justify-content-center flex-column">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('global.login') }}
                                </button>

                                @if(Route::has('password.request'))
                                    <a class="btn btn-link btn-primary" href="{{ route('password.request') }}">
                                        {{ trans('global.forgot_password') }}
                                    </a>
                                @endif

                                <a class="px-0 btn btn-link" href="{{ route('register') }}">
                                    
                                {{ trans('global.register') }}
                            </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
