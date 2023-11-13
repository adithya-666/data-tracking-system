@extends('layouts.dashboard-manajemen')

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
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label label-revisi  d-none">Catatan Revisi</label>
                            <textarea class="form-control input-revisi  d-none" name="edit-doc_note_revisi"  id="edit-doc_note_revisi"  id="edit-note" style="height: 20px"></textarea>
                          </div>
                   
                    </div>
                  </div>
                </div>
                 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-revisi-doc" >Revisi</button>
                <button type="button" class="btn btn-danger btn-edit-revisi d-none" >Edit Revisi</button>
                <button type="submit" class="btn btn-primary btn-validasi">Validasi</button>
              </div>
            </form>
            </div>
          </div>
        </div>
         <!-- Modal detail -->
 <!-- Modal detail -->

    <section class="section dashboard">
      <div class="row">



        <div class="row">
          {{-- Radial Chart --}}
          <div class="col-lg-6" hidden>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Total Pasian berdasarkan Status</h5>
  
                <!-- Radial Bar Chart -->
                <div id="radialBarChart"></div>
  
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#radialBarChart"), {
                      series: [
                        {{$jml_submission}},
                        {{$jml_ver}},
                        {{$jml_val}},
                        {{$jml_grouping}},
                        {{$jml_revisi}}
                      ],
                      chart: {
                        height: 350,
                        type: 'radialBar',
                        toolbar: {
                          show: true
                        }
                      },
                      fill: {
                        colors: ['#ffc107', '#0dcaf0', '#0d6efd', '#198754', '#dc3545']
                      },
                      plotOptions: {
                        radialBar: {
                          dataLabels: {
                            enabled: true,
                            formatter: function(val, opt) {
                            },
                            name: {
                              fontSize: '22px',
                            },
                            value: {
                              fontSize: '22px',
                              formatter: function(val) {
                                return val;
                              }
                            },
                            total: {
                              show: true,
                              label: 'Total',
                              formatter: function(w) {
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return {{$jml_total}};
                              }
                            }
                          }
                        }
                      },
                      labels: ['Diajukan', 'Verifikasi', 'Validasi', 'Grouping', 'Revisi'],
                    }).render();
                  });
                </script>
                <!-- End Radial Bar Chart -->
  
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Total Pasian berdasarkan Status</h5>
  
                <!-- Radial Bar Chart -->
                <div id="radialBarChart2"></div>
  
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#radialBarChart2"), {
                      series: [
                        43,
                        21,
                        77,
                        24,
                        32
                      ],
                      chart: {
                        height: 350,
                        type: 'radialBar',
                        toolbar: {
                          show: true
                        }
                      },
                      fill: {
                        colors: ['#ffc107', '#0dcaf0', '#0d6efd', '#198754', '#dc3545']
                      },
                      plotOptions: {
                        radialBar: {
                          dataLabels: {
                            enabled: true,
                            formatter: function(val, opt) {
                            },
                            name: {
                              fontSize: '22px',
                            },
                            value: {
                              fontSize: '22px',
                              formatter: function(val) {
                                return val;
                              }
                            },
                            total: {
                              show: true,
                              label: 'Total',
                              formatter: function(w) {
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return {{$jml_total}};
                              }
                            }
                          }
                        }
                      },
                      labels: ['Diajukan', 'Verifikasi', 'Validasi', 'Grouping', 'Revisi'],
                    }).render();
                  });
                </script>
                <!-- End Radial Bar Chart -->
  
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data pasien per ruangan</h5>
  
                <!-- Column Chart -->
                <div id="columnChart"></div>
  
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#columnChart"), {
                      series: [{
                          name: 'Diajukan',
                          data: [44, 55, 57, 56, 61]
                        },
                        {
                          name: 'Verifikasi',
                          data: [76, 85, 101, 98, 87]
                        },
                        {
                          name: 'Validasi',
                          data: [35, 41, 36, 26, 45]
                        },
                        {
                          name: 'Grouping',
                          data: [35, 41, 36, 26, 45]
                        },
                        {
                          name: 'Revisi',
                          data: [17, 21, 16, 96, 55]
                        }
                      ],
                      chart: {
                        type: 'bar',
                        height: 350
                      },
                      plotOptions: {
                        bar: {
                          horizontal: false,
                          columnWidth: '55%',
                          endingShape: 'rounded'
                        },
                      },
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                      },
                      xaxis: {
                        categories: ['Kidang Kencana 1', 'Kidang Kencana 2', 'Kidang Kencana 3', 'Gedong Gincu 1', 'Gedong Gincu 2'],
                      },
                      yaxis: {
                        title: {
                          text: ' Patients'
                        }
                      },
                      fill: {
                        opacity: 1
                      },
                      tooltip: {
                        y: {
                          formatter: function(val) {
                            return val + " patients";
                          }
                        }
                      }
                    }).render();
                  });
                </script>
                <!-- End Column Chart -->
  
              </div>
            </div>
          </div>
  
           <!-- Data Pasien -->
           <div class="col-12">
              <div class="card recent-sales ">

                <div class="card-body">
                  <h5 class="card-title">Data Pasien  </h5>
                  <form action="/dashboard-manajemen" method="GET">
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
                     <button type="button" class="btn btn-outline-info mb-2 ml-1" id="filter-verified-btn">
                       Verifikasi <span class="badge bg-white text-info">{{$jml_ver}}</span>
                     </button>
                     <button type="button" class="btn btn-outline-success mb-2" id="filter-grouping-btn">
                       Grouping <span class="badge bg-white text-success">{{$jml_grouping}}</span>
                     </button> 
                     <button type="button" class="btn btn-outline-danger mb-2" id="filter-revisi-btn">
                      Revisi <span class="badge bg-white text-danger">{{$jml_revisi}}</span>
                     </button> 
                     <button type="button" class="btn btn-outline-danger mb-2" id="filter-ajukan-btn">
                      Ajukan Dokumen <span class="badge bg-white text-danger">{{$jml_revisi}}</span>
                     </button> 
                     <button type="button" class="btn btn-outline-success mb-2" id="filter-selesai-btn">
                      Selesai <span class="badge bg-white text-success">{{$jml_selesai}}</span>
                     </button> 
                     <button type="button" class="btn btn-outline-dark mb-2" id="filter-arsip-btn">
                      Arsip <span class="badge bg-white text-black">{{$jml_arsip}}</span>
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
                            <th class="text-start" width="20%">Ruangan</th>
                            <th class="text-start" width="20%">Penjamin</th>
                            <th class="text-start" width="20%">Status</th>
                  
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
        <div class="col-lg-4">
        </div><!-- End Right side columns -->

      </div>
    </section>



  </main><!-- End #main -->

@endsection

