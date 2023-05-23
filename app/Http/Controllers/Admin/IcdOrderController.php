<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyIcdOrderRequest;
use App\Http\Requests\StoreIcdOrderRequest;
use App\Http\Requests\UpdateIcdOrderRequest;
use App\Models\IcdOrder;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IcdOrderController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('icd_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IcdOrder::with(['created_by'])->select(sprintf('%s.*', (new IcdOrder)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'icd_order_show';
                $editGate      = 'icd_order_edit';
                $deleteGate    = 'icd_order_delete';
                $crudRoutePart = 'icd-orders';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('order_number', function ($row) {
                return $row->order_number ? $row->order_number : '';
            });
            $table->editColumn('icd_cm', function ($row) {
                return $row->icd_cm ? $row->icd_cm : '';
            });
            $table->editColumn('category', function ($row) {
                return $row->category ? IcdOrder::CATEGORY_RADIO[$row->category] : '';
            });
            $table->editColumn('short_desc', function ($row) {
                return $row->short_desc ? $row->short_desc : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.icdOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('icd_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.icdOrders.create');
    }

    public function store(StoreIcdOrderRequest $request)
    {
        $icdOrder = IcdOrder::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $icdOrder->id]);
        }

        return redirect()->route('admin.icd-orders.index');
    }

    public function edit(IcdOrder $icdOrder)
    {
        abort_if(Gate::denies('icd_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdOrder->load('created_by');

        return view('admin.icdOrders.edit', compact('icdOrder'));
    }

    public function update(UpdateIcdOrderRequest $request, IcdOrder $icdOrder)
    {
        $icdOrder->update($request->all());

        return redirect()->route('admin.icd-orders.index');
    }

    public function show(IcdOrder $icdOrder)
    {
        abort_if(Gate::denies('icd_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdOrder->load('created_by');

        return view('admin.icdOrders.show', compact('icdOrder'));
    }

    public function destroy(IcdOrder $icdOrder)
    {
        abort_if(Gate::denies('icd_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyIcdOrderRequest $request)
    {
        $icdOrders = IcdOrder::find(request('ids'));

        foreach ($icdOrders as $icdOrder) {
            $icdOrder->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('icd_order_create') && Gate::denies('icd_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new IcdOrder();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
