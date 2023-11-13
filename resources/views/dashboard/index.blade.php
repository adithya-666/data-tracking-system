@extends('layouts.dashboard')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

        <!-- Modal datatable -->
<div class="modal fade" id="detailDocument-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pasien </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table>
                <tr>
                  <th class="py-1 w-100px">No. SEP </th>
                  <th>:</th>
         
                  <td class="sep-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                </tr>
                <tr>
                  <th class="py-1 w-100px">Nama Pasien </th>
                  <th>:</th>
                  <td class="name-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                </tr>
                <tr>
                  <th class="py-1 w-100px">Medrec </th>
                  <th>:</th>
                  <td class="medrec-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                </tr>
                <tr>
                  <th class="py-1 w-100px">Ruangan</th>
                  <th>:</th>
                  <td class="room-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                </tr>
                <tr>
                  <th class="py-1 w-100px">Dokter</th>
                  <th>:</th>
                  <td class="doctor-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                </tr>
                <tr>
                  <th class="py-1 w-100px">Tanggal Masuk</th>
                  <th>:</th>
                  <td class="date_in-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                </tr>
             
              </table>
              <input type="hidden" id="detail-patient-id" name="detail-patient-id">
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Status Pasien</label>
                {{-- <input class="form-control" name="edit-status-baru"  id="edit-status-baru"> --}}
                <select name="edit-status-baru" id="edit-status-baru"  class="form-select" aria-label="Default select example">
                  <option selected>Pilih Status</option>
                  <option value="Berkas belum lengkap">Berkas belum lengkap</option>
                  <option value="Berkas ada di GP">Berkas ada di GP</option>
                  <option value="Berkas ada di DPJP">Berkas ada di DPJP</option>
                  <option value="Rujuk internal">Rujuk internal</option>
                  <option value="Pasien tidak datang">Pasien tidak datang</option>
                </select>
              </div>
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Catatan Pasien</label>
                <input class="form-control" name="edit-note-patient"  id="edit-note-patient">
              </div>
             
            </div>
          </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary btn-pasien">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>
 <!-- Modal detail -->


        <!-- Modal edit document -->
<div class="modal fade" id="editDocument-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Document Pasien</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12" >
            <div class="table-responsive edit-modal">
              <form action="{{ url('/edit-document') }}" method="PUT" id="form-edit" enctype="multipart/form-data">
                <input type="hidden" name="_token" id="edit-doc-token" value="{{ csrf_token() }}">
                <input type="hidden" data-doc-id="" data-patient-id="" id="edit-doc-id">
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Document <span class="important">*</span></label>
                    <input type="text" id="edit_doc" name="edit_doc" class="form-control" id="exampleFormControlInput1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Upload Document <small id="doc-file-name" style="font-style: italic"></small></label>
                    <input type="file" name="file" class="form-control" id="upload-doc" >
                  </div>
                  {{-- <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Status Dokumen</label>
                   <p class="doc-status">-</p>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label doc-time-name"></label>
                   <p class="doc-time"></p>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Catatan Diajukan</label>
                    <textarea class="form-control" name="edit-doc_note_sub"  id="edit-doc_note_sub" style="height: 20px"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Catatan Verifikasi</label>
                    <textarea class="form-control" name="edit-doc_note_ver"  id="edit-doc_note_ver"  id="edit-note" style="height: 20px"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label label-revisi  d-none">Catatan Revisi</label>
                    <textarea class="form-control input-revisi  d-none" name="edit-doc_note_revisi"  id="edit-doc_note_revisi"  id="edit-note" style="height: 20px"></textarea>
                  </div> --}}
            </div>
          </div>
        </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-edit-revisi d-none">Ajukan Revisi</button>
        <button type="submit" class="btn btn-primary btn-edit-doc">Simpan Perubahan</button>
      </div>
    </form>
    </div>
  </div>
</div>
 <!-- Modal detail -->


        <!-- Modal edit document -->
<div class="modal fade" id="revisiDocument-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Document Pasien Revisi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12" >
            <div class="table-responsive edit-modal">
              <form action="{{ url('/revisi-document') }}" method="PUT" id="form-revisi" enctype="multipart/form-data">
      
                <input type="hidden" data-revisi-doc-id="" data-revisi-patient-id="" id="revisi-doc-id">
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Document <span class="important">*</span></label>
                    <input type="text" id="revisi_doc" name="revisi_doc" class="form-control" id="exampleFormControlInput1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Upload Document <small id="doc-file-name" style="font-style: italic"></small></label>
                    <input type="file" name="revisi-file" class="form-control" id="upload-doc" >
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Status Dokumen</label>
                   <p class="doc-status">-</p>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label doc-time-name"></label>
                   <p class="doc-time"></p>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Catatan Diajukan</label>
                    <textarea class="form-control" name="revisi_doc_note_sub"  id="revisi_doc_note_sub" style="height: 20px"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Catatan Verifikasi</label>
                    <textarea class="form-control" name="revisi_doc_note_ver"  id="revisi_doc_note_ver"   style="height: 20px"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label label-revisi  d-none">Catatan Revisi</label>
                    <textarea class="form-control input-revisi  d-none" name="revisi_doc_note_revisi"  id="revisi_doc_note_revisi"   style="height: 20px"></textarea>
                  </div>
            </div>
          </div>
        </div>
         
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success btn-revisi">Ajukan Revisi</button>

      </div>
    </form>
    </div>
  </div>
</div>
 <!-- Modal detail -->

 
        <!-- Modal edit document -->
<div class="modal fade" id="pindahkan-patient-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Pindahkan Ruangan Pasien</strong></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12" >
            <div class="table-responsive edit-modal">
              <form action="{{ url('/edit-patient') }}" method="PUT" id="form-pindahkan-pasien">
                <input type="hidden" name="pindah-pasien-id" id="pindah-pasien-id" value="">
                <input type="hidden" name="_token" id="edit-doc-token" value="{{ csrf_token() }}">
                <input type="hidden" data-doc-id="" data-patient-id="" id="edit-doc-id">
                <div class="mb-3">
                  <label class="form-label">Nama Pasien: <span id="nama-pasien-pindah"></span></label>
                </div>
                <div class="mb-3">
                  <label class="form-label">Med Rec: <span id="medrec-pasien-pindah"></span></label>
                </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><strong>Pilih Ruangan</strong></label>
                    <select type="text" id="pindah-pasien-room" name="room" class="form-control" id="exampleFormControlInput1">
                      @foreach($rooms as $key => $value)
                      <option value="{{$value}}">{{$value}}</option>
                      @endforeach
                    </select>
                  </div>
                  
            </div>
          </div>
        </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-edit-revisi d-none">Ajukan Revisi</button>
        <button type="submit" class="btn btn-primary btn-edit-doc">Pindahkan Pasien</button>
      </div>
    </form>
    </div>
  </div>
</div>
 <!-- Modal detail -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

          <div class="col-12">
                <div class="card recent-sales ">
  
                  <div class="card-body">
                    <h5 class="card-title">Sinkronisasi Data Dengan SIMRS</span></h5>
                    <form action="/dashboard" method="GET">
                        <div class="row">
                      <div class="col-md-2">
                        <label>Dari</label>
                        <input type="date" class="form-control" name="date_from" id="sync-date-from">
                      </div>
                      <div class="col-md-2">
                        <label>Sampai</label>
                        <input type="date" class="form-control" name="date_to" id="sync-date-to">
                      </div>
                      <div class="col-md-2">
                      <button class="btn btn-success mt-4" id="sync-data-btn" type="button">Ambil Data</button>
                  <button class="btn btn-primary" type="button" disabled id="sync-data-loading" hidden>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                  </button>
                      </div>
                    </div>
                      </form>
                  </div>
                </div>
                
              </div><!-- End Recent Sales -->
          </div>
        </div><!-- End Left side columns -->

        <div class="row">
           <!-- Data Pasien -->
           <div class="col-8">
              <div class="card recent-sales ">

                <div class="card-body">
                  <h5 class="card-title">Data Pasien <span> | {{ Auth::user()->room }} </span> </h5>
                  <form action="/dashboard" method="GET">
                        <div class="row">
                      <div class="col-md-3">
                        <label>Filter Tanggal</label>
                        <center>
                          <input type="text" id="config-demo" class="form-control">
                        </center>
                      </div>
                   
                      <div class="col-md-2">
                        <button id="clear-date-range" class="btn btn-secondary mt-4">Hapus Tanggal</button>
                      </div>
                    </div>
                      </form>
               
                   <br> <br>
                      
                   <div class="button-container">
                   <button type="button" class="btn btn-outline-warning btn-ajukan mb-2 " id="filter-submission-btn">
                      Diajukan <span class="badge bg-white text-warning">{{$jml_submission}}</span>
                    </button>
                    <button type="button" class="btn btn-outline-info  mb-2 ml-1" id="filter-verifikasi-btn">
                      Verifikasi <span class="badge bg-white text-info">{{$jml_ver}}</span>
                    </button>
                    <button type="button" class="btn btn-outline-danger  mb-2" id="filter-revisi-btn">
                      Revisi <span class="badge bg-white text-danger">{{$jml_revisi}}</span>
                     </button> 
                    <button type="button" class="btn btn-outline-success mb-2" id="filter-grouping-btn">
                      Grouping <span class="badge bg-white text-success">{{$jml_grouping}}</span>
                    </button> 
                    <button type="button" class="btn btn-outline-success mb-2" id="filter-selesai-btn">
                      Selesai <span class="badge bg-white text-success">{{$jml_selesai}}</span>
                    </button> 
                    {{-- <button type="button" class="btn btn-outline-danger mb-2" id="filter-ajukan-btn">
                      Ajukan Dokumen <span class="badge bg-white text-danger">{{$jml_ajukan_dokumen}}</span>
                     </button>  --}}
                  </div>


                       <!--begin::Datatable-->
                       <table class="table gy-1 align-middle table-striped px-0 datatable-ajax">
                        <thead>
                          <tr class="text-gray-600 fw-bolder fs-7 text-uppercase gs-0">
                          
                            <th class="text-start" width="15%">No. SEP</th>
                            <th class="text-start" width="25%">Nama Pasien</th>
                            <th class="text-start" width="20%">Medrec</th>
                            <th class="text-start" width="20%">Tanggal Masuk</th>
                            <th class="text-start" width="20%">Tanggal Keluar</th>
                            <th class="text-start" width="20%">Penjamin</th>
                            <th class="text-start" width="20%">Status</th>
                            <th class="text-start" width="20%">Action</th>
                          </tr>
                        </thead>
                        <tbody ></tbody>
                      </table>
                      <!--end::Datatable-->

                </div>

              </div>
            </div><!-- End Data Pasien -->
<!-- End side Left -->


               <!-- Right side columns -->
        <div class="col-4">

<!-- Budget Report -->
<div class="card">      
  <div class="card-body pb-0">
    <h5 class="card-title">Ajukan Dokumen</h5>
   
{{-- Detail Patient --}}
<div class="row">
  <div class="col-lg-12">
    <div class="table-responsive">
                     <table>
                        <tr>
                          <th class="py-1 w-100px">No. SEP</th>
                          <th>:</th>
                          <td class="sep-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                        </tr>
                        <tr>
                          <th class="py-1 w-100px">Nama Pasien </th>
                          <th>:</th>
                          <td class="name-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                        </tr>
                        <tr>
                          <th class="py-1 w-100px">Medrec</th>
                          <th>:</th>
                          <td class="medrec-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                        </tr>
                        <tr>
                          <th class="py-1 w-100px">Jenis Kelamin</th>
                          <th>:</th>
                          <td class="gender-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                        </tr>
                        <tr>
                          <th class="py-1 w-100px">Tanggal Lahir</th>
                          <th>:</th>
                          <td class="birthdate-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                        </tr>
                        <tr>
                          <th class="py-1 w-100px">Catatan Revisi</th>
                          <th>:</th>
                          <td class="revisi-detail py-1 text-gray-600 w-auto detail-pasien">-</th>
                        </tr>
                      </table>
    </div>
  </div>
 </div>
  {{-- End Detail Patient --}}
  <br>

   {{-- Start Form --}}
   <form action="{{ url('/create-data') }}" method="POST" id="form-create" enctype="multipart/form-data">
   
    <input type="hidden" id="patient-id" name="patient_id">
      <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Dokumen <span class="important">*</span></label>
        <input type="text" id="document" name="document[]" class="form-control" id="exampleFormControlInput1"  >
      </div>
    
    </div>
    <div class="col-lg-6">
      <div class="mb-3">
        <label for="formFileMultiple" class="form-label">Upload File</label>
        <input class="form-control" id="file" name="file[]"  type="file" id="formFileMultiple" multiple>
      </div>
    
    </div>
  </div>

    <div class="add-information">
      <button type="button" class="btn btn-info mb-4 addInput" id="addInput"><i class="bi bi-plus"></i> Add</button>
    </div>

    {{-- <div class="row">
      <div class="col-lg-12">
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Catatan Pasien</label>
          <textarea class="form-control" name="note_patient"  id="note_patient" style="height: 20px"></textarea>
        </div>
      </div>
    </div> --}}

    <div class="tombol-information">
    <button type="submit" class="btn btn-primary mb-4 submit-information " id="submitButton">Upload</button>
  </div>
</form>
{{-- End Form --}}

  </div>
</div><!-- End Budget Report -->



<!-- Recent Activity -->
<div class="card">

<div class="card-body">
<h5 class="card-title">Status Dokumen Diajukan</span></h5>

<table class="table gy-1 align-middle table-striped px-0 history-patient">
<thead>
<tr class="text-gray-600 fw-bolder fs-7 text-uppercase gs-0">
<th class="text-start" width="25%">Document Name</th>
<th class="text-start" width="20%">Status</th>
<th class="text-start" width="20%">Action</th>
</tr>
</thead>
<tbody ></tbody>
</table>
</div>
</div><!-- End Recent Activity -->


</div><!-- End Right side columns -->
        </div>
     

      </div>
    </section>



  </main><!-- End #main -->

@endsection
@extends('layouts.footer')
