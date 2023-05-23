<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIcdCmCodeRequest;
use App\Http\Requests\UpdateIcdCmCodeRequest;
use App\Http\Resources\Admin\IcdCmCodeResource;
use App\Models\IcdCmCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IcdCmCodesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('icd_cm_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IcdCmCodeResource(IcdCmCode::with(['created_by'])->get());
    }

    public function store(StoreIcdCmCodeRequest $request)
    {
        $icdCmCode = IcdCmCode::create($request->all());

        return (new IcdCmCodeResource($icdCmCode))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IcdCmCode $icdCmCode)
    {
        abort_if(Gate::denies('icd_cm_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IcdCmCodeResource($icdCmCode->load(['created_by']));
    }

    public function update(UpdateIcdCmCodeRequest $request, IcdCmCode $icdCmCode)
    {
        $icdCmCode->update($request->all());

        return (new IcdCmCodeResource($icdCmCode))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IcdCmCode $icdCmCode)
    {
        abort_if(Gate::denies('icd_cm_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdCmCode->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
