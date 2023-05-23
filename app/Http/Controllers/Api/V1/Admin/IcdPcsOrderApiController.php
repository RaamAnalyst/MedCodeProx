<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIcdPcsOrderRequest;
use App\Http\Requests\UpdateIcdPcsOrderRequest;
use App\Http\Resources\Admin\IcdPcsOrderResource;
use App\Models\IcdPcsOrder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IcdPcsOrderApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('icd_pcs_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IcdPcsOrderResource(IcdPcsOrder::with(['created_by'])->get());
    }

    public function store(StoreIcdPcsOrderRequest $request)
    {
        $icdPcsOrder = IcdPcsOrder::create($request->all());

        return (new IcdPcsOrderResource($icdPcsOrder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IcdPcsOrder $icdPcsOrder)
    {
        abort_if(Gate::denies('icd_pcs_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IcdPcsOrderResource($icdPcsOrder->load(['created_by']));
    }

    public function update(UpdateIcdPcsOrderRequest $request, IcdPcsOrder $icdPcsOrder)
    {
        $icdPcsOrder->update($request->all());

        return (new IcdPcsOrderResource($icdPcsOrder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IcdPcsOrder $icdPcsOrder)
    {
        abort_if(Gate::denies('icd_pcs_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdPcsOrder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
