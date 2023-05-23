<?php

namespace App\Http\Requests;

use App\Models\IcdPcsOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIcdPcsOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('icd_pcs_order_create');
    }

    public function rules()
    {
        return [
            'pcs_order_number' => [
                'string',
                'nullable',
            ],
            'icd_pcs_code' => [
                'string',
                'nullable',
            ],
            'pcs_short_desc' => [
                'string',
                'nullable',
            ],
        ];
    }
}
