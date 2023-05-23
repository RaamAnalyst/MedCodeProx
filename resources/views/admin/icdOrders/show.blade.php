@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.icdOrder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.icd-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.icdOrder.fields.id') }}
                        </th>
                        <td>
                            {{ $icdOrder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdOrder.fields.order_number') }}
                        </th>
                        <td>
                            {{ $icdOrder->order_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdOrder.fields.icd_cm') }}
                        </th>
                        <td>
                            {{ $icdOrder->icd_cm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdOrder.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\IcdOrder::CATEGORY_RADIO[$icdOrder->category] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdOrder.fields.short_desc') }}
                        </th>
                        <td>
                            {{ $icdOrder->short_desc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.icdOrder.fields.long_desc') }}
                        </th>
                        <td>
                            {!! $icdOrder->long_desc !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.icd-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection