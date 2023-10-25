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
                      <label for="yourUsername" class="form-label">Your Name</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-circle"></i></span>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                 
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Role</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-people-fill"></i></span>
                        <select class="form-select @error('room_id') is-invalid @enderror" name="room_id" id="room_id" aria-label="Default select example" value="{{ old('room_id') }}">
                      
                          <option selected>Select Role</option>
                          <option value= 1 >Admin</option>
                          <option value= 2>Kepala Ruangan</option>
                          <option value= 3 >Analis</option>
                        </select>
                     
                        @error('room_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Room</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-house-door-fill"></i></i></span>
                        <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" aria-label="Default select example" value="{{ old('role_id') }}">
                          <option selected>select Room</option>
                          <option value=1>JKN</option>
                          <option value=2>APS</option>
                          <option value=3>POLIKLINIK</option>
                        </select>
                     
                        @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="user_name" id="user_name" class="form-control @error('user_name') is-invalid @enderror" value="{{ old('user_name') }}" />
                        @error('user_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock-fill"></i></span>
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                       @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Confirm Password</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock-fill"></i></span>
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

  {{-- <script src="{{ asset('assets/js/auth/register.js') }}"></script> --}}



  @endsection