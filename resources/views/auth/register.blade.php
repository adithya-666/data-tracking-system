@extends('layouts.app')
@section('content')
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/11zon_cropped.png" alt="">
                  <span class="d-none d-lg-block">Data Tracking System Digital</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>
                  
                  <form method="post"  action="{{ url('register/create-register') }}" id="registration-form"  class="row g-3 needs-validation">
              
                  @csrf
                    <div class="col-12">
                      <label for="yourUsername" class="form-label"><i class="bi bi-person-circle"></i> Nama</label>
                      <div class="input-group has-validation">
                
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                 
                    
                    <div class="col-12">
                      <label for="yourUsername" class="form-label"><i class="bi bi-people-fill"></i> Jabatan</label>
                      <div class="input-group has-validation">
                        <select class="form-select @error('role') is-invalid @enderror" name="role" id="role" aria-label="Default select example" value="{{ old('room_id') }}">
                          <option selected>Pilih Jabatan</option>
                          <option value="admin" >Admin</option>
                          <option value="kepala ruangan">Kepala Ruangan</option>
                          <option value="JKN" >JKN</option>
                        </select>
                     
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>


                    <div class="col-12">
                      <label for="yourUsername" class="form-label"><i class="bi bi-house-door"></i> Ruangan</label>
                      <div class="input-group has-validation">
                        <select class="form-select @error('room') is-invalid @enderror room" name="room" id="room" aria-label="Default select example" value="{{ old('room_id') }}">
                          @foreach($room as $data)
                          <option value="{{ $data->room }}" >{{ $data->room }}</option>
                          @endforeach
                        </select>
                        @error('room')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    

                    <div class="col-12">
                      <label for="yourUsername" class="form-label"><i class="bi bi-person-fill"></i> Nama Pengguna</label>
                      <div class="input-group has-validation">
                       
                        <input type="text" name="user_name" id="user_name" class="form-control @error('user_name') is-invalid @enderror" value="{{ old('user_name') }}" />
                        @error('user_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label"> <i class="bi bi-lock-fill"></i>Password</label>
                      <div class="input-group has-validation">
      
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                       @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label"><i class="bi bi-lock-fill"></i> Confirm Password</label>
                      <div class="input-group has-validation">
                      <input type="password" name="password_confirmation" class="form-control" id="password" required>
                    
                      </div>
                    </div>

                 
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="{{ url('/') }}">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

          

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->


  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
 
  <script src="{{ asset('assets/js/main.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/scripts/jquery.js') }}"></script>
   --}}
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   
   <script src="{{ asset('assets/js/scripts/select2.min.js') }}"></script>
   
   <script src="{{ asset('assets/js/auth/register.js') }}"></script>
  @endsection