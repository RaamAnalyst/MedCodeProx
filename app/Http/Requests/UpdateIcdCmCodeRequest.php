<?php

namespace App\Http\Requests;

use App\Models\IcdCmCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIcdCmCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('icd_cm_code_edit');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'nullable',
            ],
            'code_title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
