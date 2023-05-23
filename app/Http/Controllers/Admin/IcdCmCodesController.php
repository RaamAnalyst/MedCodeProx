<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIcdCmCodeRequest;
use App\Http\Requests\StoreIcdCmCodeRequest;
use App\Http\Requests\UpdateIcdCmCodeRequest;
use App\Models\IcdCmCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IcdCmCodesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('icd_cm_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IcdCmCode::with(['created_by'])->select(sprintf('%s.*', (new IcdCmCode)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'icd_cm_code_show';
                $editGate      = 'icd_cm_code_edit';
                $deleteGate    = 'icd_cm_code_delete';
                $crudRoutePart = 'icd-cm-codes';

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
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('code_title', function ($row) {
                return $row->code_title ? $row->code_title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.icdCmCodes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('icd_cm_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.icdCmCodes.create');
    }

    public function store(StoreIcdCmCodeRequest $request)
    {
        $icdCmCode = IcdCmCode::create($request->all());

        return redirect()->route('admin.icd-cm-codes.index');
    }

    public function edit(IcdCmCode $icdCmCode)
    {
        abort_if(Gate::denies('icd_cm_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdCmCode->load('created_by');

        return view('admin.icdCmCodes.edit', compact('icdCmCode'));
    }

    public function update(UpdateIcdCmCodeRequest $request, IcdCmCode $icdCmCode)
    {
        $icdCmCode->update($request->all());

        return redirect()->route('admin.icd-cm-codes.index');
    }

    public function show(IcdCmCode $icdCmCode)
    {
        abort_if(Gate::denies('icd_cm_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdCmCode->load('created_by');

        return view('admin.icdCmCodes.show', compact('icdCmCode'));
    }

    public function destroy(IcdCmCode $icdCmCode)
    {
        abort_if(Gate::denies('icd_cm_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdCmCode->delete();

        return back();
    }

    public function massDestroy(MassDestroyIcdCmCodeRequest $request)
    {
        $icdCmCodes = IcdCmCode::find(request('ids'));

        foreach ($icdCmCodes as $icdCmCode) {
            $icdCmCode->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
