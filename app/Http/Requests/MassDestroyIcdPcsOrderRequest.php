<?php

namespace App\Http\Requests;

use App\Models\IcdPcsOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIcdPcsOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('icd_pcs_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:icd_pcs_orders,id',
        ];
    }
}
