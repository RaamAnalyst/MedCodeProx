@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.icdPcsOrder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.icd-pcs-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.icdPcsOrder.fields.id') }}
                        </th>
                        <td>
                            {{ $icdPcsOrder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdPcsOrder.fields.pcs_order_number') }}
                        </th>
                        <td>
                            {{ $icdPcsOrder->pcs_order_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdPcsOrder.fields.icd_pcs_code') }}
                        </th>
                        <td>
                            {{ $icdPcsOrder->icd_pcs_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdPcsOrder.fields.pcs_category') }}
                        </th>
                        <td>
                            {{ App\Models\IcdPcsOrder::PCS_CATEGORY_RADIO[$icdPcsOrder->pcs_category] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdPcsOrder.fields.pcs_short_desc') }}
                        </th>
                        <td>
                            {{ $icdPcsOrder->pcs_short_desc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdPcsOrder.fields.pcs_long_desc') }}
                        </th>
                        <td>
                            {{ $icdPcsOrder->pcs_long_desc }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.icd-pcs-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection