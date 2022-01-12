@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="mx-4 card">
            <div class="p-4 card-body">

                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h1>{{ trans('panel.site_title') }}</h1>
                    <p class="text-muted">{{ trans('global.register') }}</p>

                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="firstname" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.firstname') }}" value="{{ old('firstname', null) }}">
                        @if($errors->has('firstname'))
                            <div class="invalid-feedback">
                                {{ $errors->first('firstname') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.lastname') }}" value="{{ old('lastname', null) }}">
                        @if($errors->has('lastname'))
                            <div class="invalid-feedback">
                                {{ $errors->first('lastname') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="id_no" class="form-control{{ $errors->has('id_no') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.id_no') }}" value="{{ old('id_no', null) }}">
                        @if($errors->has('id_no'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_no') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-4 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>

                    <button class="btn btn-block btn-primary">
                        {{ trans('global.register') }}
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection
