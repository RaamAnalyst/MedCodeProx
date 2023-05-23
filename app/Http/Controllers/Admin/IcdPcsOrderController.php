<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIcdPcsOrderRequest;
use App\Http\Requests\StoreIcdPcsOrderRequest;
use App\Http\Requests\UpdateIcdPcsOrderRequest;
use App\Models\IcdPcsOrder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IcdPcsOrderController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('icd_pcs_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IcdPcsOrder::with(['created_by'])->select(sprintf('%s.*', (new IcdPcsOrder)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'icd_pcs_order_show';
                $editGate      = 'icd_pcs_order_edit';
                $deleteGate    = 'icd_pcs_order_delete';
                $crudRoutePart = 'icd-pcs-orders';

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
            $table->editColumn('pcs_order_number', function ($row) {
                return $row->pcs_order_number ? $row->pcs_order_number : '';
            });
            $table->editColumn('icd_pcs_code', function ($row) {
                return $row->icd_pcs_code ? $row->icd_pcs_code : '';
            });
            $table->editColumn('pcs_category', function ($row) {
                return $row->pcs_category ? IcdPcsOrder::PCS_CATEGORY_RADIO[$row->pcs_category] : '';
            });
            $table->editColumn('pcs_short_desc', function ($row) {
                return $row->pcs_short_desc ? $row->pcs_short_desc : '';
            });
            $table->editColumn('pcs_long_desc', function ($row) {
                return $row->pcs_long_desc ? $row->pcs_long_desc : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.icdPcsOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('icd_pcs_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.icdPcsOrders.create');
    }

    public function store(StoreIcdPcsOrderRequest $request)
    {
        $icdPcsOrder = IcdPcsOrder::create($request->all());

        return redirect()->route('admin.icd-pcs-orders.index');
    }

    public function edit(IcdPcsOrder $icdPcsOrder)
    {
        abort_if(Gate::denies('icd_pcs_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdPcsOrder->load('created_by');

        return view('admin.icdPcsOrders.edit', compact('icdPcsOrder'));
    }

    public function update(UpdateIcdPcsOrderRequest $request, IcdPcsOrder $icdPcsOrder)
    {
        $icdPcsOrder->update($request->all());

        return redirect()->route('admin.icd-pcs-orders.index');
    }

    public function show(IcdPcsOrder $icdPcsOrder)
    {
        abort_if(Gate::denies('icd_pcs_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdPcsOrder->load('created_by');

        return view('admin.icdPcsOrders.show', compact('icdPcsOrder'));
    }

    public function destroy(IcdPcsOrder $icdPcsOrder)
    {
        abort_if(Gate::denies('icd_pcs_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdPcsOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyIcdPcsOrderRequest $request)
    {
        $icdPcsOrders = IcdPcsOrder::find(request('ids'));

        foreach ($icdPcsOrders as $icdPcsOrder) {
            $icdPcsOrder->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
