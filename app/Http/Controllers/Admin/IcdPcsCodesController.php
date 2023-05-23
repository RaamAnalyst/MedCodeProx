<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIcdPcsCodeRequest;
use App\Http\Requests\StoreIcdPcsCodeRequest;
use App\Http\Requests\UpdateIcdPcsCodeRequest;
use App\Models\IcdPcsCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IcdPcsCodesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('icd_pcs_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IcdPcsCode::with(['created_by'])->select(sprintf('%s.*', (new IcdPcsCode)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'icd_pcs_code_show';
                $editGate      = 'icd_pcs_code_edit';
                $deleteGate    = 'icd_pcs_code_delete';
                $crudRoutePart = 'icd-pcs-codes';

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
            $table->editColumn('pcs_codes', function ($row) {
                return $row->pcs_codes ? $row->pcs_codes : '';
            });
            $table->editColumn('pcs_code_title', function ($row) {
                return $row->pcs_code_title ? $row->pcs_code_title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.icdPcsCodes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('icd_pcs_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.icdPcsCodes.create');
    }

    public function store(StoreIcdPcsCodeRequest $request)
    {
        $icdPcsCode = IcdPcsCode::create($request->all());

        return redirect()->route('admin.icd-pcs-codes.index');
    }

    public function edit(IcdPcsCode $icdPcsCode)
    {
        abort_if(Gate::denies('icd_pcs_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdPcsCode->load('created_by');

        return view('admin.icdPcsCodes.edit', compact('icdPcsCode'));
    }

    public function update(UpdateIcdPcsCodeRequest $request, IcdPcsCode $icdPcsCode)
    {
        $icdPcsCode->update($request->all());

        return redirect()->route('admin.icd-pcs-codes.index');
    }

    public function show(IcdPcsCode $icdPcsCode)
    {
        abort_if(Gate::denies('icd_pcs_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdPcsCode->load('created_by');

        return view('admin.icdPcsCodes.show', compact('icdPcsCode'));
    }

    public function destroy(IcdPcsCode $icdPcsCode)
    {
        abort_if(Gate::denies('icd_pcs_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $icdPcsCode->delete();

        return back();
    }

    public function massDestroy(MassDestroyIcdPcsCodeRequest $request)
    {
        $icdPcsCodes = IcdPcsCode::find(request('ids'));

        foreach ($icdPcsCodes as $icdPcsCode) {
            $icdPcsCode->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
