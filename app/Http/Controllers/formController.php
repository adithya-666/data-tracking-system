<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Doc_patient;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class formController extends Controller
{
    public function create(Request $request){

        // return $request->all();

        try {
            // Lakukan operasi penyimpanan data
   
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
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); 
        }
    }
}
