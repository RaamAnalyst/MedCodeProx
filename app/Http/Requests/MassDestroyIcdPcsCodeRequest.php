<?php

namespace App\Http\Requests;

use App\Models\IcdPcsCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIcdPcsCodeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('icd_pcs_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:icd_pcs_codes,id',
        ];
    }
}
