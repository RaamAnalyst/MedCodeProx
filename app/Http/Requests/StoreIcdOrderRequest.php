<?php

namespace App\Http\Requests;

use App\Models\IcdOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIcdOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('icd_order_create');
    }

    public function rules()
    {
        return [
            'order_number' => [
                'string',
                'nullable',
            ],
            'icd_cm' => [
                'string',
                'nullable',
            ],
            'short_desc' => [
                'string',
                'nullable',
            ],
        ];
    }
}
