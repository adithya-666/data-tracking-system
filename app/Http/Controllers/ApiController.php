<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Patient;
use DB;

class ApiController extends Controller
{
    const BASE_URL = 'http://192.168.71.5';


    public function syncData(Request $request)
    {

        // 192.168.71.5/webservice/digitaltrackingsystem/kunjungan?AWAL=2023-06-01&AKHIR=2023-06-01&RUANGAN=101030403&start=0&limit=100
        // 192.168.71.5/webservice/digitaltrackingsystem/kunjungan

        // contoh data
        // {
        //     "NOMOR": "1011101012306240020",
        //     "NOPEN": "2306240206",
        //     "NORM": "22377",
        //     "NAMAPASIEN": "WARKHAYATI",
        //     "NOSEP": "1021R0010623V009311",
        //     "PENJAMIN": "BPJS / JKN",
        //     "RUANGAN": "Kamar Operasi",
        //     "MASUK": "2023-06-24 19:34:41",
        //     "KELUAR": "2023-10-12 08:59:01",
        //     "DOKTER": "dr. Siswono, Sp.OG"
        // }
        $response = Http::withHeaders(['accept' => '*/*'])
            ->get(ApiController::BASE_URL . '/webservice/digitaltrackingsystem/kunjungan?AWAL=' . $request->input('date_from') . '&AKHIR=' . $request->input('date_to'));

        $jsonData = $response->json();

        $data = $jsonData['data'];
        $dataMasuk = [];

        try {
            DB::beginTransaction();
            foreach($data as $value) {
                $checkPatient = Patient::where('no_order', $value['NOMOR'])->first();
                
                if($checkPatient) {
                    continue;
                }
    
                $newData = new Patient();
                $newData->no_order = $value['NOMOR'];
                $newData->no_pen = $value['NOPEN'];
                $newData->medrec = $value['NORM'];
                $newData->patient_name = $value['NAMAPASIEN'];
                $newData->no_sep = $value['NOSEP'] != '' ? $value['NOSEP'] : '-';
                $newData->insurance = $value['PENJAMIN'];
                $newData->room = $value['RUANGAN'];
                $newData->kode_ruangan = $value['KODE_RUANGAN'];
                $newData->gender = $value['JENIS_KELAMIN'];
                $newData->date_in = $value['MASUK'];
                $newData->date_out = $value['KELUAR'];
                $newData->doctor = $value['DOKTER'];
                $newData->birthdate = $value['TANGGAL_LAHIR'];
                $newData->save();
                $dataMasuk[] = $newData;
            }
            // dd($dataMasuk);
            
            DB::commit();
            return response()->json($dataMasuk, 201);
    
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => "Data Error: ".$e->getMessage()], 400);
        }
    }

    public function syncSingleData(Request $request)
    {
        $nomor = $request->input('nomor');
        $response = Http::withHeaders(['accept' => '*/*'])
            ->get(ApiController::BASE_URL . '/webservice/digitaltrackingsystem/kunjungan?NOMOR=' . $nomor);

        $jsonData = $response->json();

        $data = $jsonData['data'];
        
        try {
            DB::beginTransaction();
            foreach($data as $value) {
                $existingPatient = Patient::where('no_order', $nomor)->first();
                if ($existingPatient) {
                    $existingPatient->no_order = $value['NOMOR'];
                    $existingPatient->no_pen = $value['NOPEN'];
                    $existingPatient->medrec = $value['NORM'];
                    $existingPatient->patient_name = $value['NAMAPASIEN'];
                    $existingPatient->no_sep = $value['NOSEP'] != '' ? $value['NOSEP'] : '-';
                    $existingPatient->insurance = $value['PENJAMIN'];
                    $existingPatient->room = $value['RUANGAN'];
                    $existingPatient->kode_ruangan = $value['KODE_RUANGAN'];
                    $existingPatient->gender = $value['JENIS_KELAMIN'];
                    $existingPatient->date_in = $value['MASUK'];
                    $existingPatient->date_out = $value['KELUAR'];
                    $existingPatient->doctor = $value['DOKTER'];
                    $existingPatient->birthdate = $value['TANGGAL_LAHIR'];
                    $existingPatient->save();
                } else {
                    continue;
                }
            }

            DB::commit();

            return response()->json($data, 201);
        } catch(\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Data error: ' . $e->getMessage()], 400);
        }
    }
}
