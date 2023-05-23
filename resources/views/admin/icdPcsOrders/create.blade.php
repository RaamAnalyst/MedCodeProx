@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.icdPcsOrder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.icd-pcs-orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="pcs_order_number">{{ trans('cruds.icdPcsOrder.fields.pcs_order_number') }}</label>
                <input class="form-control {{ $errors->has('pcs_order_number') ? 'is-invalid' : '' }}" type="text" name="pcs_order_number" id="pcs_order_number" value="{{ old('pcs_order_number', '') }}">
                @if($errors->has('pcs_order_number'))
                    <span class="text-danger">{{ $errors->first('pcs_order_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdPcsOrder.fields.pcs_order_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icd_pcs_code">{{ trans('cruds.icdPcsOrder.fields.icd_pcs_code') }}</label>
                <input class="form-control {{ $errors->has('icd_pcs_code') ? 'is-invalid' : '' }}" type="text" name="icd_pcs_code" id="icd_pcs_code" value="{{ old('icd_pcs_code', '') }}">
                @if($errors->has('icd_pcs_code'))
                    <span class="text-danger">{{ $errors->first('icd_pcs_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdPcsOrder.fields.icd_pcs_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.icdPcsOrder.fields.pcs_category') }}</label>
                @foreach(App\Models\IcdPcsOrder::PCS_CATEGORY_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('pcs_category') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="pcs_category_{{ $key }}" name="pcs_category" value="{{ $key }}" {{ old('pcs_category', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="pcs_category_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('pcs_category'))
                    <span class="text-danger">{{ $errors->first('pcs_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdPcsOrder.fields.pcs_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pcs_short_desc">{{ trans('cruds.icdPcsOrder.fields.pcs_short_desc') }}</label>
                <input class="form-control {{ $errors->has('pcs_short_desc') ? 'is-invalid' : '' }}" type="text" name="pcs_short_desc" id="pcs_short_desc" value="{{ old('pcs_short_desc', '') }}">
                @if($errors->has('pcs_short_desc'))
                    <span class="text-danger">{{ $errors->first('pcs_short_desc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdPcsOrder.fields.pcs_short_desc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pcs_long_desc">{{ trans('cruds.icdPcsOrder.fields.pcs_long_desc') }}</label>
                <textarea class="form-control {{ $errors->has('pcs_long_desc') ? 'is-invalid' : '' }}" name="pcs_long_desc" id="pcs_long_desc">{{ old('pcs_long_desc') }}</textarea>
                @if($errors->has('pcs_long_desc'))
                    <span class="text-danger">{{ $errors->first('pcs_long_desc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdPcsOrder.fields.pcs_long_desc_helper') }}</span>
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