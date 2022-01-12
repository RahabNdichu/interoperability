@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.kpApplication.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kp-applications.update", [$kpApplication->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="kp_amount">{{ trans('cruds.kpApplication.fields.kp_amount') }}</label>
                <input class="form-control {{ $errors->has('kp_amount') ? 'is-invalid' : '' }}" type="number" name="kp_amount" id="kp_amount" value="{{ old('kp_amount', $kpApplication->kp_amount) }}" step="0.01" required>
                @if($errors->has('kp_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kp_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kpApplication.fields.kp_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.kpApplication.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $kpApplication->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kpApplication.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.kpApplication.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kpApplication.fields.status_helper') }}</span>
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
