@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.icdPcsCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.icd-pcs-codes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="pcs_codes">{{ trans('cruds.icdPcsCode.fields.pcs_codes') }}</label>
                <input class="form-control {{ $errors->has('pcs_codes') ? 'is-invalid' : '' }}" type="text" name="pcs_codes" id="pcs_codes" value="{{ old('pcs_codes', '') }}">
                @if($errors->has('pcs_codes'))
                    <span class="text-danger">{{ $errors->first('pcs_codes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdPcsCode.fields.pcs_codes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pcs_code_title">{{ trans('cruds.icdPcsCode.fields.pcs_code_title') }}</label>
                <input class="form-control {{ $errors->has('pcs_code_title') ? 'is-invalid' : '' }}" type="text" name="pcs_code_title" id="pcs_code_title" value="{{ old('pcs_code_title', '') }}">
                @if($errors->has('pcs_code_title'))
                    <span class="text-danger">{{ $errors->first('pcs_code_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdPcsCode.fields.pcs_code_title_helper') }}</span>
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