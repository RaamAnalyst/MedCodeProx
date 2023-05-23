@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.icdCmCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.icd-cm-codes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="code">{{ trans('cruds.icdCmCode.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}">
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdCmCode.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="code_title">{{ trans('cruds.icdCmCode.fields.code_title') }}</label>
                <input class="form-control {{ $errors->has('code_title') ? 'is-invalid' : '' }}" type="text" name="code_title" id="code_title" value="{{ old('code_title', '') }}">
                @if($errors->has('code_title'))
                    <span class="text-danger">{{ $errors->first('code_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdCmCode.fields.code_title_helper') }}</span>
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