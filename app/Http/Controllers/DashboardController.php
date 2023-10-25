<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Models\Patient;
use Yajra\DataTables\DataTables;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('dashboard.index');
    }



    /**
     * Showing Data.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
    
     $patients = Patient::all();

    //   dd($patients);


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
        ->select('doc_patients.*')
        ->leftJoin('patients', 'doc_patients.patient_id', 'patients.id')
        ->where('doc_patients.patient_id', $id)
        ->get();

        return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
          $btn = '<div class="dropdown">
          <span>&#8285;</span>
          <div class="dropdown-content">
              <div class="dropdown-item">
                  <a href="javascript:void(0)" class="editDocument btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDocument-modal" data-id="'. $row->id .'"><i class="bi bi-pencil"></i> Edit</a>
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



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
