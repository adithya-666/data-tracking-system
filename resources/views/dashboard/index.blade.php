@extends('layouts.dashboard')
@extends('layouts.sidebar')
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
<div class="modal fade" id="editDocument-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Document Pasien</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive edit-modal">
             
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

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales ">

                <div class="card-body">
                  <h5 class="card-title">Recent Sales <span>| Today</span></h5>
                  <button class="btn btn-success" >Sync</button>
                       <!--begin::Datatable-->
                       <table class="table gy-1 align-middle table-striped px-0 datatable-ajax">
                        <thead>
                          <tr class="text-gray-600 fw-bolder fs-7 text-uppercase gs-0">
                          
                            <th class="text-start" width="15%">No. SEP</th>
                            <th class="text-start" width="25%">Patient Name</th>
                            <th class="text-start" width="20%">No. Order</th>
                            <th class="text-start" width="20%">Date In</th>
                            <th class="text-start" width="20%">Date Out</th>
                            <th class="text-start" width="20%">Status</th>
                            <th class="text-start" width="20%">Action</th>
                          </tr>
                        </thead>
                        <tbody ></tbody>
                      </table>
                      <!--end::Datatable-->

                </div>

              </div>
            </div><!-- End Recent Sales -->

    

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">


                    <!-- Budget Report -->
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
          
                      <div class="card-body pb-0">
                        <h5 class="card-title">Add information Document </h5>
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
                                <th class="py-1 w-100px">Name </th>
                                <th>:</th>
                                <td class="name-detail py-1 text-gray-600 w-auto">-</th>
                              </tr>
                            </table>
                          </div>
                        </div>
                       </div>
                        {{-- End Detail Patient --}}
                       <br>
                       {{-- Start Form --}}
                       <form action="{{ url('/create-data') }}" method="POST" id="form-create">
                        <input type="hidden" id="patient-id" name="patient_id">
                          <div class="row">
                        <div class="col-lg-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Document <span class="important">*</span></label>
                            <input type="text" id="document" name="document[]" class="form-control" id="exampleFormControlInput1" required >
                          </div>
                          
                        </div>
                        <div class="col-lg-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Note <span class="important">*</span></label>
                            <textarea class="form-control" name="note[]"  id="note" style="height: 20px"></textarea>
                          </div>
                        </div>

                        {{-- <div class="col-lg-3">
                          <label class="form-check-label" for="flexCheckDefault">
                            Ver
                           </label>
                            <div class="form-check mt-3">
                              <input class="form-check-input verifikasi-checkbox" name="verifikasi[]" type="checkbox" value="" id="verifikasi" >  
                            </div>
                        </div>
                        <div class="col-lg-3">
                          <label class="form-check-label" for="flexCheckDefault">
                            Val
                           </label>
                            <div class="form-check mt-3">
                              <input class="form-check-input validasi-checkbox" name="validasi[]" type="checkbox" value="" id="validasi" >
                            </div>
                        </div> --}}

                      </div>
 
                        <div class="add-information">
                          <button type="button" class="btn btn-info mb-4 addInput" id="addInput"><i class="bi bi-plus"></i> Add</button>
                        </div>
          
                        <div class="tombol-information">
                        <button type="submit" class="btn btn-success mb-4 submit-information" id="submitButton">Submit</button>
                      </div>
                    </form>
             {{-- End Form --}}
               
                      </div>
                    </div><!-- End Budget Report -->



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
              <h5 class="card-title">Recent Activity <span>| Today</span></h5>

              {{-- <form action="" id="form-detail">
                <div class="document-container d-none">
                 <div class="row show-edit">

                 </div>
                  <!-- Elemen input dan textarea akan ditambahkan di sini -->
                </div>
           
            </form> --}}

            <table class="table gy-1 align-middle table-striped px-0 history-patient">
              <thead>
                <tr class="text-gray-600 fw-bolder fs-7 text-uppercase gs-0">
                  <th class="text-start" width="25%">Document Name</th>
                  <th class="text-start" width="20%">Note</th>
                  <th class="text-start" width="20%">Status</th>
                  <th class="text-start" width="20%">Action</th>
                </tr>
              </thead>
              <tbody ></tbody>
            </table>
            </div>
          </div><!-- End Recent Activity -->



          <!-- Website Traffic -->
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

            <div class="card-body pb-0">
              <h5 class="card-title">Website Traffic <span>| Today</span></h5>

              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Access From',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: [{
                          value: 1048,
                          name: 'Search Engine'
                        },
                        {
                          value: 735,
                          name: 'Direct'
                        },
                        {
                          value: 580,
                          name: 'Email'
                        },
                        {
                          value: 484,
                          name: 'Union Ads'
                        },
                        {
                          value: 300,
                          name: 'Video Ads'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Website Traffic -->

          <!-- News & Updates Traffic -->
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

            <div class="card-body pb-0">
              <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

              <div class="news">
                <div class="post-item clearfix">
                  <img src="assets/img/news-1.jpg" alt="">
                  <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                  <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-2.jpg" alt="">
                  <h4><a href="#">Quidem autem et impedit</a></h4>
                  <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-3.jpg" alt="">
                  <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-4.jpg" alt="">
                  <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                  <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-5.jpg" alt="">
                  <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                  <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                </div>

              </div><!-- End sidebar recent posts-->

            </div>
          </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

      </div>
    </section>



  </main><!-- End #main -->

@endsection
@extends('layouts.footer')
