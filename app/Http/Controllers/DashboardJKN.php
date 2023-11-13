<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doc_patient;
use App\Models\Room;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class DashboardJKN extends Controller
{   
    

        public function index(Request $request) 
        {
            $this->authorize('JKN');

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
        
        $ver = Patient::where('doc_status_patient', 'Verifikasi');
        $val = Patient::where('doc_status_patient', 'Validasi');
        $sub = Patient::where('doc_status_patient', 'Diajukan');
        $group = Patient::where('doc_status_patient', 'Grouping');
        $revisi = Patient::where('doc_status_patient', 'Revisi');
        $ajukanDokumen = Patient::where('doc_status_patient', 'Ajukan Dokumen');
        $selesaiDokumen = Patient::where('doc_status_patient', 'Selesai');
        $arsipDokumen = Patient::where('doc_status_patient', 'Arsipkan');
        $selesaiDokumen = Patient::where('doc_status_patient', 'Selesai');

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
        $data['jml_ajukan_dokumen'] = $ajukanDokumen->count();
        $data['jml_selesai'] = $selesaiDokumen->count();
        $data['jml_arsip'] = $arsipDokumen->count();
        $data['jml_selesai'] = $selesaiDokumen->count();
        $data['request'] = $request;
        $rooms = Room::orderBy('room', 'asc')->get();

        $index = 0;
        foreach($rooms as $value) {
            $all_rooms[$index]['kode_ruangan'] = $value->general_code;
            $all_rooms[$index]['nama_ruangan'] = $value->room;
            $all_rooms[$index]['jenis_ruangan'] = $value->jenis;
            $index++;
        }

            $data['rooms'] = $all_rooms;
            return view('dashboard-jkn.index', $data);
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
            $patients = $patients->whereIn('doc_status_patient', ['Diajukan', 'Diajukan ulang']);
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
        } else if($request->input('selesai-dokumen') == '1') {
            $patients = $patients->where('doc_status_patient', 'Selesai');
        }
        else if($request->input('allData') == '1') {
            $patients = $patients;
        }

    // return response()->json($patients->toSql());

    // return response()->json(Auth::user()->room);
    // return response()->json($patients->toSql());

    if (($request->input('date_from') != '' && $request->input('date_to') != '')) {
        $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
        $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
        $patients = $patients->where('date_in', '>=', $date_from)->where('date_in', '<=', $date_to);
    }

    // return $request->input('room');

    # TODO
    if ($request->input('kode_ruangan') != '' || $request->input('jenis_room')) {
        // $patients = $patients->where('kode_ruangan', $request->input('room'));
        $patients = $patients->leftJoin('rooms', 'rooms.general_code', 'patients.kode_ruangan');
        
        if ($request->input('kode_ruangan') != '') {
            $patients = $patients->where('rooms.general_code', $request->input('kode_ruangan'));

        }

        if ($request->input('jenis_room') != '') {
            $patients = $patients->where('rooms.jenis', $request->input('jenis_room'));
        }
    }


    $patients->where('doc_status_patient', '!=', 'Arsip');


        
      return DataTables::of($patients)
      ->addIndexColumn()
      ->addColumn('action', function($row) {
        $btn = '<div class="dropdown">
        <span><i class="bi bi-list"></i></span>
        <div class="dropdown-content">';
        if ($row->doc_status_patient == 'Verifikasi') {
            $btn .= '  <div class="dropdown-item">
                <a href="javascript:void(0)" class="patientAction btn btn-info btn-sm mt-2"  data-verifikasi="0" data-id="'. $row->id .'"><i class="bi bi-check-circle-fill"></i>Unverified</a></div>';
        } else {
            $btn .= '  <div class="dropdown-item">
                <a href="javascript:void(0)" class="patientAction btn btn-info btn-sm mt-2"  data-verifikasi="1" data-id="'. $row->id .'"><i class="bi bi-check-circle-fill"></i>Verifikasi</a></div>';
        }


        $btn .= '  <div class="dropdown-item">
            <a href="javascript:void(0)" class="revisiDocument btn btn-danger btn-sm mt-2"  data-id="'. $row->id .'"><i class="bi bi-file-arrow-up-fill"></i> Revisi</a></div>';

        

            if ($row->doc_status_patient == 'Grouping') {
                $btn .= '  <div class="dropdown-item">
                    <a href="javascript:void(0)" class="btn-grouping btn btn-secondary btn-sm mt-2" data-status-grouping="1"  data-id="'. $row->id .'"><i class="bi bi-collection"></i> UnGroup</a></div>';

                    $btn .= '  <div class="dropdown-item">
                    <a href="javascript:void(0)" class="btn-selesai btn btn-success btn-sm mt-2" data-status-grouping="1"  data-id="'. $row->id .'"><i class="bi bi-collection"></i> Selesai</a></div>';
            } else {
                $btn .= '  <div class="dropdown-item">
                    <a href="javascript:void(0)" class="btn-grouping btn btn-secondary btn-sm mt-2" data-status-grouping="0"  data-id="'. $row->id .'"><i class="bi bi-collection"></i> Grouping</a></div>';
            }

            $btn .= ' </div>
    </div>';
    return $btn;
    })
    // ->addColumn('checkbox', function($row) {
    //     $check = '<input class="row-checkbox form-check-input mt-0" name="" data-id="'. $row->id .'" type="checkbox" value="" aria-label="Checkbox for following text input" >';
    //     return $check;
    //     })
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
        ->select('doc_patients.file', 'doc_patients.id as doc_id', 'doc_patients.doc_name', 'doc_patients.doc_note_sub', 'doc_patients.doc_status', 'doc_patients.patient_id', 'doc_patients.doc_val', 'patients.status_grouping' , 'doc_patients.doc_note_ver', 'doc_patients.doc_note_val', 'doc_patients.doc_ver' , 'doc_patients.file' )
        ->leftJoin('patients', 'doc_patients.patient_id', 'patients.id')
        ->where('doc_patients.patient_id', $id)
        ->get();


        // dd($query);

        return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
    
            $btn = '<a href="/storage/' . $row->file . '"><i class="bi bi-file-arrow-down"></i></a>';
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
        // return $request->all();
        try {

   
            $patientId  = $request->patient_id;

    
            foreach ($request->document as $index => $doc) {
                $newData = new Doc_patient();
                $newData->patient_id = $patientId;
                $newData->doc_name = $doc;
                $newData->doc_status = "Diajukan";
                $newData->doc_time_sub = Carbon::now();
                $newData->doc_note_sub = $request->note[$index];
                $newData->doc_user_sub = Auth::user()->id;
                $newData->save();
            }

            $update = [
                'status_submission' => 1,
                'doc_status_patient' => 'Diajukan',
                'note_jkn' => $request->note_jkn,
                'time_submission' => Carbon::now()
            ];

            DB::table('patients')->where('id', $patientId)->update($update);


            return response()->json(['message' => 'Data berhasil disimpan']);
        
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
     $data = DB::table('patients')
            ->select('patients.*')
            ->where('patients.id', $id)
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
        $update = [
            'doc_name' =>   $request->doc,
            'doc_note_sub' => $request->note,
            'updated_at' => Carbon::now()
        ];
     
        DB::table('doc_patients')->where('id', $id)->update($update);

        return response()->json(['message' => 'Data Berhasil di update']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
    }

    public function updateStatusDocument(Request $request, $id)
    {
        try {
            Patient::where('id', $id)->update(['doc_status_patient' => $request->status]);
            Doc_patient::where('patient_id', $id)->update(['doc_status' => $request->status]);

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


    public function updateVer(Request $request, $id){

    // return $id;
        try{

            if($request->ver == 1){
                $status = 'Verifikasi';
            } else {
                $status = 'Diajukan';
            }

            $update = [
                'doc_status_patient' => $status,
                'status_ver' =>  $request->ver,
                'time_ver' => Carbon::now()
            ];

            DB::table('patients')->where('id', $id)->update($update);

            
    
    
            return response()->json(['message' => 'Data Berhasil di update']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
    }

    public function updateVerAll(Request $request, $id){


        try{

            if($request->status_ver == 0){
                $ver = 1;
                $status = 'Verifikasi';
            } elseif($request->status_ver == 1) {
                $ver = 0;
                $status = 'Diajukan';
            }

            $update_doc = [
                'doc_ver' =>   $ver,
                'doc_status' =>  $status,
                'doc_time_ver' => Carbon::now()
            ];

            DB::table('doc_patients')->where('patient_id', $id)->update($update_doc);

            $existsRev = DB::table('doc_patients')
                ->where('patient_id', $id)
                ->where('doc_status', 'Revisi')
                ->exists();

            $existsSub = DB::table('doc_patients')
                ->where('patient_id', $id)
                ->where('doc_status', 'Diajukan')
                ->exists();

            $existsVer = DB::table('doc_patients')
                ->where('patient_id', $id)
                ->where('doc_status', 'Verifikasi')
                ->exists();

            if($existsRev){
                $doc_status_patient = 'Revisi';

            } elseif($existsSub) {
                $doc_status_patient = 'Diajukan';

            } elseif($existsVer) {
                $doc_status_patient = 'Verifikasi';
            }

        

            $update_patient = [
                'status_ver' =>   $ver,
                'doc_status_patient' =>  $doc_status_patient
            ];
         
  

            DB::table('patients')->where('id', $id)->update($update_patient);
    
            return response()->json($ver);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
    }


    public function updateGroupingAll(Request $request, $id){

        // return 'joss';

        try{

            if($request->status_grouping == 0){
                $grouping = 1;
                $status = 'Grouping';
            } elseif($request->status_grouping == 1) {
                $grouping = 0;
                $status = 'Verifikasi';
            }


            $update_patient = [
                'status_grouping' =>   $grouping,
                'doc_status_patient' =>  $status,
                'status_ver' => 0
            ];
         
  

            DB::table('patients')->where('id', $id)->update($update_patient);
    
            return response()->json($grouping);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
    }


    public function revisiDocument(Request $request, $patientId)
    {
        try {
            DB::beginTransaction();


            $update_patient = [
                'doc_status_patient' =>  'Revisi',
                'note_revisi' => $request->note,
                'status_revisi' => 1,
                'status_submission' => 0,
                'status_ver' => 0,
                'status_val' => 0,
                'status_grouping' => 0,
            ];

            DB::table('patients')->where('id', $patientId)->update($update_patient);

            DB::commit();
            return response()->json(['message' => 'Data Berhasil di update']);
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
            
        }
    }

    public function editRevisiDocument(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $update_doc = [
                'doc_note_revisi' =>  $request->doc
            ];

            DB::table('doc_patients')->where('id', $id)->update($update_doc);

           
            DB::commit();
            return response()->json(['message' => 'Data Berhasil di update']);
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }


      
    }

    public function validasiNoteDocument(Request $request, $id){
        try {
            DB::beginTransaction();

            $update_doc = [
                'doc_note_val' =>  $request->doc
            ];

            DB::table('doc_patients')->where('id', $id)->update($update_doc);

           
            DB::commit();
            return response()->json(['message' => 'Data Berhasil di update']);
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
    }

 

    public function updateStatusPatient(Request $request)
    {
   

        try {
          

            $rowIds = $request->rowIds;

       
            Patient::whereIn('id', $rowIds)
                ->update(['doc_status_patient' => 'Arsip']);

           
            DB::commit();
            return response()->json(['message' => 'Data Berhasil di update']);
        } catch (\Exception $e) {
            //throw $th;
          
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
    }

    public function arsip(Request $request)
    {

        $this->authorize('JKN');

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
        
        $ver = Patient::where('doc_status_patient', 'Verifikasi');
        $val = Patient::where('doc_status_patient', 'Validasi');
        $sub = Patient::where('doc_status_patient', 'Diajukan');
        $group = Patient::where('doc_status_patient', 'Grouping');
        $revisi = Patient::where('doc_status_patient', 'Revisi');
        $ajukanDokumen = Patient::where('doc_status_patient', 'Ajukan Dokumen');
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
        $data['jml_ajukan_dokumen'] = $ajukanDokumen->count();
        $data['jml_selesai'] = $selesaiDokumen->count();
        $data['jml_arsip'] = $arsipDokumen->count();
        $data['request'] = $request;
        $rooms = Room::orderBy('room', 'asc')->get();

        $index = 0;
        foreach($rooms as $value) {
            $all_rooms[$index]['kode_ruangan'] = $value->general_code;
            $all_rooms[$index]['nama_ruangan'] = $value->room;
            $all_rooms[$index]['jenis_ruangan'] = $value->jenis;
            $index++;
        }

        $data['rooms'] = $all_rooms;

       return view('dashboard-jkn.arsip',$data);
    }

    public function datatableArsip(Request $request)
    {
        $patients = Patient::query();
        //  return response()->json($request->input('submission'));
            if ($request->input('submission') == '1') {
                $patients = $patients->whereIn('doc_status_patient', ['Diajukan', 'Diajukan ulang']);
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
            } else if($request->input('selesai-dokumen') == '1') {
                $patients = $patients->where('doc_status_patient', 'Selesai');
            }
            else if($request->input('allData') == '1') {
                $patients = $patients;
            }
    
        // return response()->json($patients->toSql());
    
        // return response()->json(Auth::user()->room);
        // return response()->json($patients->toSql());
    
        if (($request->input('date_from') != '' && $request->input('date_to') != '')) {
            $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
            $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
            $patients = $patients->where('date_in', '>=', $date_from)->where('date_in', '<=', $date_to);
        }
    
        // return $request->input('room');
    
        # TODO
        if ($request->input('kode_ruangan') != '' || $request->input('jenis_room')) {
            // $patients = $patients->where('kode_ruangan', $request->input('room'));
            $patients = $patients->leftJoin('rooms', 'rooms.general_code', 'patients.kode_ruangan');
            
            if ($request->input('kode_ruangan') != '') {
                $patients = $patients->where('rooms.general_code', $request->input('kode_ruangan'));
    
            }
    
            if ($request->input('jenis_room') != '') {
                $patients = $patients->where('rooms.jenis', $request->input('jenis_room'));
            }
        }
    
    
        $patients->where('doc_status_patient', '=', 'Arsip');
    
    
            
          return DataTables::of($patients)
          ->addIndexColumn()
          ->addColumn('action', function($row) {
            $btn = '<div class="dropdown">
            <span><i class="bi bi-list"></i></span>
            <div class="dropdown-content">';
            if ($row->doc_status_patient == 'Verifikasi') {
                $btn .= '  <div class="dropdown-item">
                    <a href="javascript:void(0)" class="patientAction btn btn-info btn-sm mt-2"  data-verifikasi="0" data-id="'. $row->id .'"><i class="bi bi-check-circle-fill"></i>Unverified</a></div>';
            } else {
                $btn .= '  <div class="dropdown-item">
                    <a href="javascript:void(0)" class="patientAction btn btn-info btn-sm mt-2"  data-verifikasi="1" data-id="'. $row->id .'"><i class="bi bi-check-circle-fill"></i>Verifikasi</a></div>';
            }
    
    
            $btn .= '  <div class="dropdown-item">
                <a href="javascript:void(0)" class="revisiDocument btn btn-danger btn-sm mt-2"  data-id="'. $row->id .'"><i class="bi bi-file-arrow-up-fill"></i> Revisi</a></div>';
    
            
    
                if ($row->doc_status_patient == 'Grouping') {
                    $btn .= '  <div class="dropdown-item">
                        <a href="javascript:void(0)" class="btn-grouping btn btn-secondary btn-sm mt-2" data-status-grouping="1"  data-id="'. $row->id .'"><i class="bi bi-collection"></i> UnGroup</a></div>';
    
                        $btn .= '  <div class="dropdown-item">
                        <a href="javascript:void(0)" class="btn-selesai btn btn-success btn-sm mt-2" data-status-grouping="1"  data-id="'. $row->id .'"><i class="bi bi-collection"></i> Selesai</a></div>';
                } else {
                    $btn .= '  <div class="dropdown-item">
                        <a href="javascript:void(0)" class="btn-grouping btn btn-secondary btn-sm mt-2" data-status-grouping="0"  data-id="'. $row->id .'"><i class="bi bi-collection"></i> Grouping</a></div>';
                }
    
                $btn .= ' </div>
        </div>';
        return $btn;
        })
        // ->addColumn('checkbox', function($row) {
        //     $check = '<input class="row-checkbox form-check-input mt-0" name="" data-id="'. $row->id .'" type="checkbox" value="" aria-label="Checkbox for following text input" >';
        //     return $check;
        //     })
              ->rawColumns(['action'])
          ->escapeColumns()
          ->make(true);
    }
}
