<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Doc_patient;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class formController extends Controller
{
    public function create(Request $request){

        // return $request->all();

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
}
