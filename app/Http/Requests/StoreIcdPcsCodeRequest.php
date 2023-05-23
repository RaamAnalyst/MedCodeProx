<?php

namespace App\Http\Requests;

use App\Models\IcdPcsCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIcdPcsCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('icd_pcs_code_create');
    }

    public function rules()
    {
        return [
            'pcs_codes' => [
                'string',
                'nullable',
            ],
            'pcs_code_title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
