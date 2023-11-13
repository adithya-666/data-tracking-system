<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doc_patient;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DashboardKaruController extends Controller
{
    public function index(Request $request) 
    {
        $this->authorize('kepala ruangan');

        $jmlPatient = array();
        $tgl = array();
        for($i = 7; $i >= 0; $i--) {
            $jmlPatient[] = Patient::selectRaw('count(id) as jml, date_in')
                ->where('date_in', '>=', Carbon::now()->startOfDay()->subDays($i))->groupBy('date_in')
                ->where('date_in', '<=', Carbon::now()->endOfDay()->subDays($i))->groupBy('date_in')
                ->first();
            $tgl[] = date('Y-M-d', strtotime(Carbon::now()->startOfDay()->subDays($i)));
        }

        // $dokter = array();
        $dokter = Patient::selectRaw('count(doctor) as jml, doctor')->groupBy('doctor')->orderBy('jml', 'desc')->limit(10)->get();
        
        $data['dokter'] = $dokter;
        $data['jml_patient'] = $jmlPatient;
        $data['jml_hari'] = 7;
        $data['tgl'] = $tgl;

        if (Auth::check()) {
            $room = Auth::user()->room;
            $ver = Patient::where('room', $room)->where('doc_status_patient', 'Validasi')->get();
            $val = Patient::where('room', $room)->where('doc_status_patient', 'Verifikasi')->get();
            $sub = Patient::where('room', $room)->where('doc_status_patient', 'Diajukan')->get();
            $group = Patient::where('room', $room)->where('doc_status_patient', 'Grouping')->get();
            $revisi = Patient::where('room', $room)->where('doc_status_patient', 'Revisi')->get();
        }

        if ($request->input('date_from') != '' && $request->input('date_to')) {
            $ver = $ver->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
            $val = $val->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
            $sub = $sub->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
            $group = $group->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
        }

        $data['jml_ver'] = $ver->count();
        $data['jml_val'] = $val->count();
        $data['jml_submission'] = $sub->count();
        $data['jml_grouping'] = $group->count();
        $data['jml_revisi'] = $revisi->count();
        $data['request'] = $request;

        return view('dashboard-karu.index', $data);
    }


        /**
 * Showing Data.
 *
 * @return \Illuminate\Http\Response
 */
public function datatable(Request $request)
{

    $patients = Patient::query();

   
    $roomExists = $patients->where('room', Auth::user()->room)->exists();
    //  return response()->json($request->input('submission'));
     if($roomExists){
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
        }else if($request->input('allData') == '1') {
            $patients = $patients;
        }
    }

    // return response()->json($patients->toSql());

    // return response()->json(Auth::user()->room);
    // return response()->json($patients->toSql());
    if (($request->input('date_from') != 'null' && $request->input('date_to') != 'null')) {
        $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
        $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
        $patients = $patients->where('date_in', '>=', $date_from)->where('date_in', '<=', $date_to);
    }

    
//   dd($patients);



  return DataTables::of($patients )
  ->addIndexColumn()
  ->addColumn('action', function($row) {
    $btn = '<div class="dropdown">
    <span><i class="bi bi-list"></i></span>
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


public function docDetail($id)
{

    try {
 $query = DB::table('doc_patients')
        ->select('doc_patients.*')
        ->leftJoin('patients', 'doc_patients.patient_id', 'patients.id')
        ->where('doc_patients.patient_id', $id)
        ->get();

        return response()->json(['data' => $query]);
    }  catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
    }

}


public function historyPatient($id)
{
    $query = DB::table('doc_patients')
    ->select('doc_patients.id as doc_id', 'doc_patients.doc_name', 'doc_patients.doc_note_sub', 'doc_patients.doc_status', 'doc_patients.patient_id', 'doc_patients.doc_ver', 'patients.status_grouping' , 'doc_patients.doc_note_ver', 'doc_patients.doc_note_val', 'doc_patients.doc_val')
    ->leftJoin('patients', 'doc_patients.patient_id', 'patients.id')
    ->where('doc_patients.patient_id', $id)
    ->get();

  
    // dd($query);

    return DataTables::of($query)
    ->addIndexColumn()
    ->addColumn('action', function($row) {

  
        $btn = '<div class="dropdown">
        <span><i class="bi bi-list"></i></span>
        <div class="dropdown-content">
            <div class="dropdown-item">
                <a href="javascript:void(0)" class="editDocument btn  btn-sm" data-toggle="tooltip" data-original-title="Edit" data-patient-id="' . $row->doc_id . '"><span class="badge bg-warning btn-revisi"><i class="bi bi-pencil"></i>Catatan</span></a>
            </div>';

    // Cek nilai doc_ver
    if ($row->doc_ver == 0  ) {
        $btn .= '<div class="dropdown-item">
                    <a href="javascript:void(0)" class="verifikasiDocument btn  btn-sm " data-verifikasi = "1"  data-id="' . $row->doc_id . '" data-patient-id="' . $row->patient_id . '"><span class="badge bg-info btn-verifikasi"><i class="bi bi-file-earmark-check"></i> Verifikasi</span></a>
                </div>';
    } else{
        $btn .= '<div class="dropdown-item">
        <a href="javascript:void(0)" class="verifikasiDocument btn  btn-sm " data-verifikasi = "0"  data-id="' . $row->doc_id . '" data-patient-id="' . $row->patient_id . '"><span class="badge bg-info btn-verifikasi"><i class="bi bi-file-earmark-check-fill"></i> Tidak Verifikasi</span></a>
    </div>';
    }

    $btn .= '</div>
        </div>';
 
  return $btn;
  })
    ->rawColumns(['action'])
    ->escapeColumns()
    ->make(true);
}



/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create(Request $request)
{
    try {

        $validator = Validator::make($request->all(), [
            'document.*' => ['required']

             
        ]);
        // return $validator;
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()], 422);
        } else {
        $patientId  = $request->patient_id;


        foreach ($request->document as $index => $doc) {
            $newData = new Doc_patient();
            $newData->patient_id = $patientId;
            $newData->doc_name = $doc;
            $newData->doc_status = "Submitted";
            $newData->doc_note_sub = $request->note[$index];
            $newData->doc_time_ver = Carbon::now();
            $newData->doc_time_val = Carbon::now();
            $newData->save();
        }
        return response()->json(['message' => 'Data berhasil disimpan']);
    }
    } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
    }
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
dd('Masukkkk');
}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show($id)
{
    //
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function editDocument($id)
{
    try{
 $data = DB::table('doc_patients')
        ->select('doc_patients.*')
        ->where('doc_patients.id', $id)
        ->get();

        return response()->json($data);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
    }
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function updateDocument(Request $request, $id)
{
    try{
        $status = 'Verifikasi';
        $update = [
            'doc_name' =>   $request->doc,
            'doc_note_ver' => $request->note,
            'doc_status' =>  $status,
            'updated_at' => Carbon::now()
        ];
 
    DB::table('doc_patients')->where('id', $id)->update($update);

    return response()->json(['message' => 'Data Berhasil di update']);
} catch (\Exception $e) {
    return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
}
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroyDocument($id)
{
    try {

        $doc = Doc_patient::find($id);
        $doc->delete(); 

        return response()->json(['message' => 'Data Berhasil di hapus']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
    }
}


public function updateVerify(Request $request, $id){


    try{

        if($request->verify == 0){
            $status = 'Diajukan';
        } else {
            $status = 'Verifikasi';
        }
        $update = [
            'doc_ver' =>   $request->verify,
            'doc_status' =>  $status,
        ];

        DB::table('doc_patients')->where('id', $id)->update($update);

        $exists = DB::table('doc_patients')
        ->select('doc_patients.patient_id','doc_patients.doc_status')
        ->where('doc_patients.patient_id', $request->patientId)
        ->where('doc_patients.doc_status', 'Diajukan')
        ->exists();

        

    if($exists){
        $doc_status_patient = 'Diajukan';
        $status_ver = 0;

    } else {
        $doc_status_patient = 'Verifikasi';
        $status_ver = 1;
    }

        $update_patient = [
            'doc_status_patient' =>  $doc_status_patient,
            'status_ver' => $status_ver
        ];
     
        DB::table('patients')->where('id', $request->patientId)->update($update_patient);

     

        return response()->json(['message' => 'Data Berhasil di update']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
    }
}

public function updateVerifyAll(Request $request, $id){

    // return 'joss';

    try{

        if($request->status_verify == 0){
            $verify = 1;
            $status = 'Verifikasi';
        } elseif($request->status_verify == 1) {
            $verify = 0;
     
            $status = 'Diajukan';
        }

        $update_doc = [
            'doc_ver' =>   $verify,
            'doc_status' =>  $status,
        ];

        DB::table('doc_patients')->where('patient_id', $id)->update($update_doc);

        $exists = DB::table('doc_patients')
            ->where('patient_id', $id)
            ->where('doc_status', 'Diajukan')
            ->exists();

        if($exists){
            $doc_status_patient = 'Diajukan';

        } else {
            $doc_status_patient = 'Verifikasi';
        }

    

        $update_patient = [
            'status_ver' =>   $verify,
            'doc_status_patient' =>  $doc_status_patient
        ];
     


        DB::table('patients')->where('id', $id)->update($update_patient);

        return response()->json($verify);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
    }
}

public function checkStatus($id){


    try{

        $status =  DB::table('doc_patients')->select('doc_patients.*')->where('patient_id', $id)->get();

        return response()->json($status);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
    }
}

public function getFile($id)
{

}
}
