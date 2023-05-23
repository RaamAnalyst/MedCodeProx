<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIcdPcsCodeRequest;
use App\Http\Requests\UpdateIcdPcsCodeRequest;
use App\Http\Resources\Admin\IcdPcsCodeResource;
use App\Models\IcdPcsCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IcdPcsCodesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('icd_pcs_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IcdPcsCodeResource(IcdPcsCode::with(['created_by'])->get());
    }

    public function store(StoreIcdPcsCodeRequest $request)
    {
        $icdPcsCode = IcdPcsCode::create($request->all());

        return (new IcdPcsCodeResource($icdPcsCode))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IcdPcsCode $icdPcsCode)
    {
        abort_if(Gate::denies('icd_pcs_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IcdPcsCodeResource($icdPcsCode->load(['created_by']));
    }

    public function update(UpdateIcdPcsCodeRequest $request, IcdPcsCode $icdPcsCode)
    {
        $icdPcsCode->update($request->all());

        return (new IcdPcsCodeResource($icdPcsCode))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IcdPcsCode $icdPcsCode)
    {
        abort_if(Gate::denies('icd_pcs_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdPcsCode->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
