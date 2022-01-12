@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kpaApplication.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kpa-applications.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="kpa_amount">{{ trans('cruds.kpaApplication.fields.kpa_amount') }}</label>
                <input class="form-control {{ $errors->has('kpa_amount') ? 'is-invalid' : '' }}" type="number" name="kpa_amount" id="kpa_amount" value="{{ old('kpa_amount', '') }}" step="0.01" required>
                @if($errors->has('kpa_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kpa_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kpaApplication.fields.kpa_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.kpaApplication.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kpaApplication.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
