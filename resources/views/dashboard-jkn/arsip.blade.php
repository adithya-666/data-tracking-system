@extends('layouts.dashboard-jkn')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard JKN</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

        <!-- Modal datatable -->
<div class="modal fade" id="detailDocument-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pasien</h1>
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
         
                  <td class="sep-detail py-1 text-gray-600 w-auto">-</th>
                </tr>
                <tr>
                  <th class="py-1 w-100px">Name </th>
                  <th>:</th>
                  <td class="name-detail py-1 text-gray-600 w-auto">-</th>
                </tr>
                <tr>
                  <th class="py-1 w-100px">Medrec </th>
                  <th>:</th>
                  <td class="medrec-detail py-1 text-gray-600 w-auto">-</th>
                </tr>
                <tr>
                  <th class="py-1 w-100px">No. Order</th>
                  <th>:</th>
                  <td class="order-detail py-1 text-gray-600 w-auto">-</th>
                </tr>
              </table>
           
            </div>
          </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
 <!-- Modal detail -->


        <!-- Modal edit document -->
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
                      <form action="{{ url('/edit-document') }}" method="POST" id="form-edit">
                        <input type="hidden" data-doc-id="" data-patient-id="" id="edit-doc-id">
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Document <span class="important">*</span></label>
                            <input type="text" id="edit-document" name="edit-document" class="form-control" id="exampleFormControlInput1" required >
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Upload Dokumen <br> <small id="doc-file-name" style="font-style: italic"></small></label>
                            {{-- <input type="file" name="file" class="form-control" id="upload-doc" > --}}
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Status Dokumen</label>
                           <p class="doc-status">-</p>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Catatan Diajukan</label>
                            <textarea class="form-control" name="edit-doc_note_sub"  id="edit-doc_note_sub" style="height: 20px"></textarea>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label edit-doc_note_ver-label">Catatan Revisi</label>
                            <textarea class="form-control" name="edit-doc_note_ver"  id="edit-doc_note_ver"  id="edit-note" style="height: 20px"></textarea>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label label-revisi  d-none">Catatan Revisi</label>
                            <textarea class="form-control input-revisi  d-none" name="edit-doc_note_revisi"  id="edit-doc_note_revisi"  id="edit-note" style="height: 20px"></textarea>
                          </div>
                   
                    </div>
                  </div>
                </div>
                 
              </div>
              <div class="modal-footer">
             
                <button type="button" class="btn btn-danger btn-edit-revisi d-none" >Edit Revisi</button>
                {{-- <button type="submit" class="btn btn-primary btn-verifikasi verifikasiDocument" data-id="" data-patient-id="">Verifikasi</button> --}}
              </div>
            </form>
            </div>
          </div>
        </div>
         <!-- Modal detail -->
 <!-- Modal detail -->

         <!-- Modal revisi document -->
<div class="modal fade" id="revisi-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <form action="{{ url('/revisi-document') }}" method="POST" id="form-revisi">
                <input type="hidden" data-doc-id="" data-patient-id="" id="revisi-doc-id">
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"> Catatan Revisi</label>
                    <textarea class="form-control" name="note_revisi"  id="note_revisi" style="height: 20px"></textarea>
                  </div>
            </div>
          </div>
        </div>
         
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-revisi-doc">Revisi</button>
      </div>
    </form>
    </div>
  </div>
</div>
 <!-- Modal detail -->

    <section class="section dashboard">
      <div class="row">



        <div class="row">
           <!-- Data Pasien -->
           <div class="col-12">
              <div class="card recent-sales ">

                <div class="card-body">
                  <h5 class="card-title">Data Pasien  </h5>
                  <form action="/arsip" method="GET">
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
                      <div class="col-md-2">
                        <label>Jenis Ruangan</label>
                        <select name="jenis_room" class="form-control" placeholder="Pilih Jenis Ruangan" id="jenis_room">
                          <option value="">Pilih Jenis Ruangan</option>
                          <option value="rwi" {{$request->input('jenis_room') == 'rwi' ? 'selected' :''}}>Rawat Inap</option>
                          <option value="rwj" {{$request->input('jenis_room') == 'rwj' ? 'selected' :''}}>Rawat Jalan</option>
                        </select>
                      </div>
                        <div class="col-md-3">
                        <label>Ruangan</label>
                        <select name="kode_ruangan" class="form-control" placeholder="Pilih ruangan" id="room">
                          <option value="" selected>Pilih Ruangan</option>
                          @foreach($rooms as $room)
                            <option value="{{$room['kode_ruangan']}}" data-jenis="{{$room['jenis_ruangan']}}" {{$request->input('kode_ruangan') == $room['kode_ruangan'] ? 'selected' :''}}>{{$room['nama_ruangan']}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-sm mt-4">Lihat Data</button>
                      </div>
                    </div>
                    </form>
                      

               <br> <br> <br><br>
              
         

                       <!--begin::Datatable-->
                       <table class="table gy-1 align-middle table-striped px-0 datatable-arsip">
                        <thead>
                          <tr class="text-gray-600 fw-bolder fs-7 text-uppercase gs-0">  
                            <th class="text-start" width="15%">No. SEP</th>
                            <th class="text-start" width="25%">Nama Pasien</th>
                            <th class="text-start" width="20%">Medrec</th>
                            <th class="text-start" width="20%">Tanggal Masuk</th>
                            <th class="text-start" width="20%">Tanggal Keluar</th>
                            <th class="text-start" width="20%">Ruangan</th>
                            <th class="text-start" width="20%">Penjamin</th>
                            <th class="text-start" width="20%">Catatan Admin</th>
                            <th class="text-start" width="20%">Catatan JKN</th>
                            <th class="text-start" width="20%">Status</th>
                            <th class="text-start" width="20%">Aksi</th>
                          </tr>
                        </thead>
                        <tbody ></tbody>
                      </table>
                      <!--end::Datatable-->
                </div>

              </div>
            </div><!-- End Data Pasien -->
<!-- End side Left -->

    
</div><!-- End Right side columns -->

      </div>
    </section>



  </main><!-- End #main -->



@endsection

