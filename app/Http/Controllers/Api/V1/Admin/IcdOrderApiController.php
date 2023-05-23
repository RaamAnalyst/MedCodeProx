<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreIcdOrderRequest;
use App\Http\Requests\UpdateIcdOrderRequest;
use App\Http\Resources\Admin\IcdOrderResource;
use App\Models\IcdOrder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IcdOrderApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('icd_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IcdOrderResource(IcdOrder::with(['created_by'])->get());
    }

    public function store(StoreIcdOrderRequest $request)
    {
        $icdOrder = IcdOrder::create($request->all());

        return (new IcdOrderResource($icdOrder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IcdOrder $icdOrder)
    {
        abort_if(Gate::denies('icd_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IcdOrderResource($icdOrder->load(['created_by']));
    }

    public function update(UpdateIcdOrderRequest $request, IcdOrder $icdOrder)
    {
        $icdOrder->update($request->all());

        return (new IcdOrderResource($icdOrder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IcdOrder $icdOrder)
    {
        abort_if(Gate::denies('icd_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdOrder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
