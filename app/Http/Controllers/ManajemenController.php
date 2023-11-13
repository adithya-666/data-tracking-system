<?php

namespace App\Http\Controllers;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doc_patient;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManajemenController extends Controller
{
    public function index(Request $request) 
    {

        $jmlPatient = array();
        $tgl = array();
        for($i = 7; $i >= 0; $i--) {
            $jmlPatient[] = Patient::selectRaw('count(id) as jml, date_in')
            ->where('date_in', '>=', Carbon::now()->startOfDay()->subDays($i))->groupBy('date_in')
            ->where('date_in', '<=', Carbon::now()->endOfDay()->subDays($i))->groupBy('date_in')
            ->first();
            $tgl[] = date('Y-M-d', strtotime(Carbon::now()->startOfDay()->subDays($i)));
        }

        $dokter = Patient::selectRaw('count(doctor) as jml, doctor')->groupBy('doctor')->orderBy('jml', 'desc')->limit(10)->get();
        
        $data['dokter'] = $dokter;
        $data['jml_patient'] = $jmlPatient;
        $data['jml_hari'] = 7;
        $data['tgl'] = $tgl;
        
        $ver = Patient::where('doc_status_patient', 'Verifikasi');
        $val = Patient::where('doc_status_patient', 'Validasi');
        $sub = Patient::where('doc_status_patient', 'Diajukan');
        $group = Patient::where('doc_status_patient', 'Grouping');
        $revisi = Patient::where('doc_status_patient', 'Revisi');
        $selesaiDokumen = Patient::where('doc_status_patient', 'Selesai');
        $arsipDokumen = Patient::where('doc_status_patient', 'Arsipkan');

        if ($request->input('date_from') != '' && $request->input('date_to')) {
            $ver = $ver->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
            $val = $val->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
            $sub = $sub->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
            $group = $group->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
            $revisi = $revisi->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
        }

        $data['jml_ver'] = $ver->count();
        $data['jml_val'] = $val->count();
        $data['jml_submission'] = $sub->count();
        $data['jml_grouping'] = $group->count();
        $data['jml_revisi'] = $revisi->count();
        $data['jml_total'] = Patient::count();
        $data['jml_selesai'] = $selesaiDokumen->count();
        $data['jml_arsip'] = $arsipDokumen->count();
        $data['request'] = $request;

        // $column_chart = Patient::selectRaw('room, count(room)')


        return view('dashboard-manajemen', $data);
    }


        /**
 * Showing Data.
 *
 * @return \Illuminate\Http\Response
 */
public function datatable(Request $request)
{

    $patients = Patient::query();
//  return response()->json($request->input('submission'));
    if ($request->input('submission') == '1') {
        $patients = $patients->where('doc_status_patient', 'Diajukan');
    } else if($request->input('validated') == '1') {
        $patients = $patients->where('doc_status_patient', 'Validasi');
    } else if($request->input('verifikasi') == '1') {
        $patients = $patients->where('doc_status_patient', 'Verifikasi');
    }else if($request->input('grouping') == '1') {
        $patients = $patients->where('doc_status_patient', 'Grouping');
    }else if($request->input('revisi') == '1') {
        $patients = $patients->where('doc_status_patient', 'Revisi');
    } else if($request->input('ajukan-dokumen') == '1') {
        $patients = $patients->where('doc_status_patient', 'Ajukan Dokumen');
    }
    else if($request->input('allData') == '1') {
        $patients = $patients;
    }


if (($request->input('date_from') != 'null' && $request->input('date_to') != 'null')) {
    $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
    $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
    $patients = $patients->where('date_in', '>=', $date_from)->where('date_in', '<=', $date_to);
}
    
  return DataTables::of($patients)
  ->addIndexColumn()
  ->addColumn('action', function($row) {
    $btn = '<div class="dropdown">
    <span>&#8285;</span>
    <div class="dropdown-content">
        <div class="dropdown-item">
            <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-id="'. $row->id .'"><i class="bi bi-pencil"></i> Edit</a>
        </div>
        <div class="dropdown-item">
        <a href="javascript:void(0)" class="detailDocument btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailDocument-modal" data-id="'. $row->id .'"><i class="bi bi-ticket-detailed"></i> Detail</a>

        </div>
    </div>
</div>';
return $btn;
})
  ->rawColumns(['action'])
  ->escapeColumns()
  ->make(true);
}
}
