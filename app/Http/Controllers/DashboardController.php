<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Room;
use App\Models\Doc_patient;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class DashboardController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin');

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
            $ver = Patient::where('room', $room)->where('doc_status_patient', 'Verifikasi')->get();
            $val = Patient::where('room', $room)->where('doc_status_patient', 'Validasi')->get();
            $sub = Patient::where('room', $room)->where('doc_status_patient', 'Diajukan')->get();
            $subRepeat = Patient::where('room', $room)->where('doc_status_patient', 'Diajukan ulang')->get();
            $group = Patient::where('room', $room)->where('doc_status_patient', 'Grouping')->get();
            $revisi = Patient::where('room', $room)->where('doc_status_patient', 'Revisi')->get();
            $ajukanDokumen = Patient::where('room', $room)->where('doc_status_patient', 'Ajukan Dokumen')->get();
            $selesai = Patient::where('room', $room)->where('doc_status_patient', 'Selesai')->get();
                  
        }

        

        if ($request->input('date_from') != '' && $request->input('date_to') != '') {
            $ver = $ver->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
            $val = $val->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
            $sub = $sub->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
            $group = $group->where('date_in', '>=', Carbon::parse($request->input('date_from'))->startOfDay())->where('date_in', '<=', Carbon::parse($request->input('date_to'))->endOfDay());
        }

        $total = 0;

        $total = $sub->count() + $subRepeat->count();

        $data['jml_ver'] = $ver->count();
        $data['jml_val'] = $val->count();
        $data['jml_submission'] = $total;
        $data['jml_grouping'] = $group->count();
        $data['jml_revisi'] = $revisi->count();
        $data['jml_selesai'] = $selesai->count();
        $data['request'] = $request;
        $data['jml_ajukan_dokumen'] = $ajukanDokumen->count();

        $data['rooms'] = Room::pluck('room', 'id')->all();

       return view('dashboard.index', $data);
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
            $patients = $patients->whereIn('doc_status_patient', ['Diajukan', 'Diajukan ulang']);
        } else if($request->input('validated') == '1') {
            $patients = $patients->where('doc_status_patient', 'Validasi');
        } else if($request->input('verifikasi') == '1') {
            $patients = $patients->where('doc_status_patient', 'Verifikasi');
        }else if($request->input('grouping') == '1') {
            $patients = $patients->where('doc_status_patient', 'Grouping');
        } else if($request->input('ajukan-dokumen') == '1') {
            $patients = $patients->where('doc_status_patient', 'Ajukan Dokumen');
        } else if($request->input('selesai-dokumen') == '1') {
            $patients = $patients->where('doc_status_patient', 'Selesai');
        }
        else if($request->input('revisi') == '1') {
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

      return DataTables::of($patients)
      ->addIndexColumn()
      ->addColumn('action', function($row) {
        $btn = '<div class="dropdown text-center" >
        <span><i class="bi bi-list"></i></span>
        <div class="dropdown-content">
            <div class="dropdown-item mb-1">
                <a href="javascript:void(0)" class="btn btn-success btn-sm sync-single-data" data-id="'. $row->id .'"  data-no-order="'.$row->no_order .'"><i class="bi bi-pencil"></i> Perbarui Data</a>
            </div>
            <div class="dropdown-item mb-1">
                <a href="javascript:void(0)" class="btn btn-secondary btn-sm pindahkan-patient-btn" data-id="'. $row->id .'"  data-no-order="'.$row->no_order .'" data-bs-toggle="modal" data-bs-target="#pindahkan-patient-modal"><i class="bi bi-person-fill"></i> Pindahkan Pasien</a>
            </div>
            <div class="dropdown-item">
            <a href="javascript:void(0)" class="detailDocument btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailDocument-modal" data-id="'. $row->id .'"><i class="bi bi-ticket-detailed"></i> Detail Pasien</a>
            </div>';

            if($row->doc_status_patient == 'Revisi'){
                $btn .= '<div class="dropdown-item">
                <a href="javascript:void(0)" class="ajukanDokumenUlang btn  btn-sm m-2 ml-4"  style="background-color: orange;" data-id="'. $row->id .'"><i class="bi bi-file-arrow-down-fill"></i> Ajukan Ulang</a>
                </div>';
            } else {

                $btn .= '<div class="dropdown-item">
                <a href="javascript:void(0)" class="ajukanDokumen btn btn-warning btn-sm m-2 ml-4"  data-id="'. $row->id .'"><i class="bi bi-file-arrow-down-fill"></i> Ajukan</a>
                </div>';
            }


        

    $btn .= ' </div>
    </div>';
    return $btn;
    })
      ->addColumn('checkbox', function($row) {
    $check = '<input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">';
    return $check;
    })
      ->rawColumns(['action','checkbox'])
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

    public function pindahkanPasien(Request $request) {
        try {
            $patient = Patient::find($request->id);
            $patient->doc_status_patient = 'Pindah ke ' . $request->room;
            $patient->save();

            return response()->json(['data' => $patient]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }


    public function historyPatient($id)
    {
        $query = DB::table('doc_patients')
        ->select('doc_patients.id as doc_id', 'doc_patients.doc_name', 'doc_patients.doc_note_sub', 'doc_patients.doc_status', 'doc_patients.patient_id', 'patients.status_grouping', 'doc_patients.doc_revisi' , 'doc_patients.patient_id')
        ->leftJoin('patients', 'doc_patients.patient_id', 'patients.id')
        ->where('doc_patients.patient_id', $id)
        ->get();


        // dd($query);

        return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action', function($row) {

            if($row->status_grouping == 0){
            
          $btn = '<div class="dropdown">
          <span><i class="bi bi-list"></i></span>
          <div class="dropdown-content">';
          if($row->doc_revisi == 1){
            $btn .=   '<div class="dropdown-item">
                  <a href="javascript:void(0)" class="revisiDocument btn  btn-sm" data-toggle="tooltip" data-original-tittle="Revisi" data-patient-id="'. $row->doc_id .'"><span class="badge bg-warning"><i class="bi bi-pencil"></i> Revisi</span></a>
              </div>';
            }else {
                $btn .=   '<div class="dropdown-item">
                  <a href="javascript:void(0)" class="editDocument btn  btn-sm" data-toggle="tooltip" data-original-tittle="Edit" data-patient-id="'. $row->doc_id .'"><span class="badge bg-warning"><i class="bi bi-pencil"></i> Edit</span></a>
              </div>';
            }
            $btn .=  '<div class="dropdown-item">
              <a href="javascript:void(0)" class="deleteDocument btn  btn-sm"  data-patient-id="'. $row->patient_id .'" data-id="'. $row->doc_id .'"><span class="badge bg-danger"><i class="bi bi-trash"></i> Delete</span></a>
  
              </div>
          </div>
      </div>';
            } else {
                $btn = '';
            }
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
                'document.*' => 'required',
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
                $newData->doc_status = "Upload";
                $newData->doc_time_sub = Carbon::now();
                $newData->doc_user_sub = Auth::user()->id;
                $newData->file = $request->file('file')[$index]->store('post-files');
                $newData->file_name = $request->file('file')[$index]->getClientOriginalName();
                $newData->save();
            }

            $update = [
                'status_submission' => 1,
                'doc_status_patient' => 'Upload',
                'note_admin' => $request->note_patient,
                'time_submission' => Carbon::now()
            ];


            DB::table('patients')->where('id',  $patientId)->update($update);

            return response()->json(['message' => 'Data berhasil disimpan']);
        }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
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
            $validator = Validator::make($request->all(), [
                'edit_doc' => ['required']
            ]);
            // return $validator;
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'errors' => $validator->errors()], 422);
            }

        if($request->file('file')){

            $doc = DB::table('doc_patients')->where('id', $id)->first();

            if ($doc->file) {
                Storage::delete($doc->file);
            }

            $update = [
                'doc_name'     => $request->edit_doc,
                'file'          => $request->file('file')->store('post-files'),
                'file_name'     => $request->file('file')->getClientOriginalName(),
                'updated_at'   => Carbon::now()
            ];
        } else {
            $update = [
                'doc_name'     => $request->edit_doc,
                'updated_at'   => Carbon::now()
            ];
        }
        
    
     
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
    public function destroyDocument(Request $request, $id)
    {
        try {

            $doc = DB::table('doc_patients')->where('id', $id)->first();

            if ($doc->file) {
                Storage::delete($doc->file);
            }

            $doc = Doc_patient::find($id);
            $doc->delete(); 
            

            $existsUpload = DB::table('doc_patients')
            ->select('doc_patients.patient_id','doc_patients.doc_status')
            ->where('doc_patients.patient_id', $id)
            ->where('doc_patients.doc_status', 'Upload')
            ->exists();

            if(!$existsUpload){
                DB::table('patients')->where('id', $request->patientId)
                ->update([
                    'doc_status_patient' => 'Diajukan'
                ]);
            }




            return response()->json(['message' => 'Data Berhasil di hapus']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
    }

    public function revisiDocument(Request $request, $id, $patientId){

        // return $request->file('revisi-file')->store('post-files');

        try{
            $validator = Validator::make($request->all(), [
                'revisi_doc' => ['required']
            ]);
            // return $validator;
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'errors' => $validator->errors()], 422);
            }
        
        $update_doc = [
            'doc_name'     => $request->revisi_doc,
            'file'          => $request->file('revisi-file')->store('post-files'),
            'file_name'     => $request->file('revisi-file')->getClientOriginalName(),
            'doc_note_sub'  => $request->revisi_doc_note_revisi,
            'doc_sub'       => 1,
            'doc_ver'       => 0,
            'doc_revisi'    => 0,
            'doc_status'    => 'Diajukan',
            'updated_at'   => Carbon::now()
        ];
     
        DB::table('doc_patients')->where('id', $id)->update($update_doc);

        $existsRevisi = DB::table('doc_patients')
            ->select('doc_patients.patient_id','doc_patients.doc_status')
            ->where('doc_patients.patient_id', $patientId)
            ->where('doc_patients.doc_status', 'Revisi')
            ->exists();

            $existsAjukan = DB::table('doc_patients')
            ->select('doc_patients.patient_id','doc_patients.doc_status')
            ->where('doc_patients.patient_id', $patientId)
            ->where('doc_patients.doc_status', 'Ajukan Dokumen')
            ->exists();

            $existsSub = DB::table('doc_patients')
            ->select('doc_patients.patient_id','doc_patients.doc_status')
            ->where('doc_patients.patient_id', $patientId)
            ->where('doc_patients.doc_status', 'Diajukan')
            ->exists();

            $existsVer = DB::table('doc_patients')
            ->select('doc_patients.patient_id','doc_patients.doc_status')
            ->where('doc_patients.patient_id', $patientId)
            ->where('doc_patients.doc_status', 'Verifikasi')
            ->exists();


            
        if($existsRevisi ){
            $doc_status_patient = 'Revisi';
            $status_ver = $request->ver;

        } elseif($existsAjukan) {
            $doc_status_patient = 'Ajukan Dokumen';
            $status_ver = $request->ver;
        } elseif($existsSub) {
            $doc_status_patient = 'Diajukan';
            $status_ver = $request->ver;
        } 
        elseif($existsVer){
            $doc_status_patient = 'Verifikasi';
            $status_ver = $request->ver;
        }

            $update_patient = [
                'doc_status_patient' =>  $doc_status_patient,
                'status_revisi' => 0
            ];
         
            DB::table('patients')->where('id', $patientId)->update($update_patient);



        return response()->json(['message' => 'Data Berhasil di update']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
    }
    }

    public function editStatusPasien(Request $request, $patientId)
    {
        // return $patientId;
        try {
            DB::beginTransaction();
                if($request->status){
                    $update_doc = [
                        'doc_status_patient' => $request->status,
                        'note_admin' => $request->note,
                        'status_submission' => 0,
                        'status_ver' => 0,
                        'status_revisi' => 0,
                        'status_grouping' => 0
                    ];
                } else {
                    $update_doc = [
                        'note_admin' => $request->note,
                        'status_submission' => 0,
                        'status_ver' => 0,
                        'status_revisi' => 0,
                        'status_grouping' => 0
                    ];
                }
             
    
                DB::table('patients')->where('id', $patientId)->update($update_doc);
    
                DB::commit();
    
                return response()->json(['message' => 'Data Berhasil di hapus']);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
            }
    }

    public function ajukanDokumenStatus($id)
    {
        // return $id;
        try {

            $update_doc = [
                'doc_status_patient' => 'Diajukan'
            ];
         
            DB::table('patients')->where('id', $id)->update($update_doc);
       

            return response()->json(['message' => 'Data Berhasil di hapus']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
    }

    public function ajukanDokumenUlang($id)
    {
        // return $id;
        try {

            $update_doc = [
                'doc_status_patient' => 'Diajukan ulang'
            ];
         
            DB::table('patients')->where('id', $id)->update($update_doc);
       

            return response()->json(['message' => 'Data Berhasil di hapus']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
    }
}
