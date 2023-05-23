@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.icdPcsCode.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.icd-pcs-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.icdPcsCode.fields.id') }}
                        </th>
                        <td>
                            {{ $icdPcsCode->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdPcsCode.fields.pcs_codes') }}
                        </th>
                        <td>
                            {{ $icdPcsCode->pcs_codes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdPcsCode.fields.pcs_code_title') }}
                        </th>
                        <td>
                            {{ $icdPcsCode->pcs_code_title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.icd-pcs-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection