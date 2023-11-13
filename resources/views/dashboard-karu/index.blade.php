@extends('layouts.dashboard-karu')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard Kepala Ruangan</li>
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
                <input type="hidden" data-doc-id="" id="edit-doc-id">
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Document <span class="important">*</span></label>
                    <input type="text" id="edit-document" name="edit-document" class="form-control" id="exampleFormControlInput1" required >
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
                    <label for="exampleFormControlInput1" class="form-label">Catatan Verifikasi</label>
                    <textarea class="form-control" name="edit-doc_note_ver"  id="edit-doc_note_ver"  id="edit-note" style="height: 20px"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Catatan Validasi</label>
                    <textarea class="form-control" name="edit-doc_note_val"  id="edit-doc_note_val"  id="edit-note" style="height: 20px"></textarea>
                  </div>
           
            </div>
          </div>
        </div>
         
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Verifikasi</button>
      </div>
    </form>
    </div>
  </div>
</div>

 <!-- Modal detail -->


    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

          <div class="col-12">
              <div class="card recent-sales ">

                <div class="card-body">
                  <h5 class="card-title">Data Pasien {{ Auth::user()->room }} </h5>
                  <form action="/dashboard-karu" method="GET">
                        <div class="row">
                      <div class="col-md-3">
                        <label>Dari</label>
                        <input type="date" class="form-control" required name="date_from" value={{$request->input('date_from')}}>
                      </div>
                      <div class="col-md-3">
                        <label>Sampai</label>
                        <input type="date" class="form-control" required name="date_to" value={{$request->input('date_to')}}>
                      </div>
                      <div class="col-md-2">
                      <button type="submit" class="btn btn-success btn-sm mt-4">Lihat Data</button>
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
                    <button type="button" class="btn btn-outline-primary mb-2" id="filter-validasi-btn">
                      Validasi <span class="badge bg-white text-primary">{{$jml_val}}</span>
                    </button>
                    <button type="button" class="btn btn-outline-success  mb-2" id="filter-grouping-btn">
                      Grouping <span class="badge bg-white text-success">{{$jml_grouping}}</span>
                    </button> 
                    <button type="button" class="btn btn-outline-danger  mb-2" id="filter-revisi-btn">
                     Revisi <span class="badge bg-white text-danger">{{$jml_revisi}}</span>
                    </button>
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

    

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">information Document</h5>

                       {{-- Detail Patient --}}
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
                          <th class="py-1 w-100px">Nama Pasien </th>
                          <th>:</th>
                          <td class="name-detail py-1 text-gray-600 w-auto">-</th>
                        </tr>
                        <tr>
                          <th class="py-1 w-100px">Medrec</th>
                          <th>:</th>
                          <td class="medrec-detail py-1 text-gray-600 w-auto">-</th>
                        </tr>
                        <tr>
                          <th class="py-1 w-100px">Jenis Kelamin</th>
                          <th>:</th>
                          <td class="gender-detail py-1 text-gray-600 w-auto">-</th>
                        </tr>
                        <tr>
                          <th class="py-1 w-100px">Tanggal Lahir</th>
                          <th>:</th>
                          <td class="birthdate-detail py-1 text-gray-600 w-auto">-</th>
                        </tr>
                      </table>
                          </div>
                        </div>
                       </div> 
                        {{-- End Detail Patient --}}

                        {{-- Button Verify --}}

            <button type="button" class="btn" ><span class="badge bg-info btn-verify d-none"  data-patient-id="" data-status-ver="0">Verifikasi Semua</span></button>

            <button type="button" class="btn" ><span class="badge bg-warning btn-unverify  d-none"  data-patient-id="" data-status-ver="1">Tidak Verifikasi Semua</span></button>

             {{-- End Button Verify --}}
             <br>
          {{-- Datatable Document --}}
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
            {{-- end Datatable Document --}}
            </div>
          </div><!-- End Recent Activity -->



        </div><!-- End Right side columns -->

      </div>
    </section>



  </main><!-- End #main -->

@endsection

