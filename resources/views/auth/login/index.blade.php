<div class="">
	@include('auth.includes.header')
    @include('auth.password.partials.process')
	<!-- End Navbar -->
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header bg-transparent pb-0 text-start">
	                <a href="{{ route('home') }}" class="mb-3 d-block" style="max-width: 240px;">
	                	<img src="/images/logo.png" class="img-fluid w-100 object-fit">
	                </a>
                 <h4 class="font-weight-bolder">Login Here</h4>
                 <p class="mb-0">Please enter your phone number and password below to login.</p>
                </div>
                <div class="card-body">
                  <form class="login-form" action="javascript:;" method="post" data-action="{{ route('auth.login') }}">
                    @csrf
                    <div class="form-group">
                    	<label class="text-muted">Phone number or Email</label>
                      	<input type="text" class="form-control form-control-lg login" placeholder="Your phone number or email" aria-label="login" name="login">
                        <small class="login-error text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label class="text-muted d-flex justify-content-between">
                            <span>Password</span>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#process-reset">Forgot Password?</a>
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-lg password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" aria-label="Password" name="password" id="password">
                            <span class="input-group-text" onclick="password_show_hide();">
                            <i class="fas fa-eye" id="show_eye"></i>
                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                        <small class="password-error d-block text-danger"></small>
                    </div>
                    
                    <div class="form-check form-switch mb-3">
                      <input class="form-check-input" type="checkbox" id="rememberme">
                      <label class="form-check-label" for="rememberme">Remember me</label>
                    </div>
                    <div class="alert d-none login-message m-0 text-white"></div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary login-button btn-lg w-100 mt-4 mb-0">
                        <img src="/images/spinner.svg" class="me-2 d-none login-spinner mb-1">Login
                      </button>
                    </div>
                  </form>
                  <p class="mb-4 text-sm">
                    Don't have an account? <a href="{{ route('signup') }}" class="text-primary text-gradient font-weight-bold">Signup</a>
                  </p>
                  <div class="border cursor-pointer border-primary p-4 text-primary rounded" data-bs-toggle="modal" data-bs-target="#resend-phone-otp">Resend phone verification code?</div>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 justify-content-center flex-column">
              <div class="position-relative bg-gradient-dark h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('./../../content/uploads/2020/04/Remote-Sensing.jpg'); background-size: cover;">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">{{ config('app.name') }}</h4>
                <div class="text-white position-relative">Since 1973, Geoprecise Services Limited has been the premier Boundary Surveyor in South-East Nigeria. Therefore, we will deliver a fast turnaround, in comparison to our competitors, that will help you meet your critical project deadlines.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="resend-phone-otp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="plot">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Resend Verification Code</h5>
              <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                <i class="icofont-close"></i>
              </button>
            </div>
            <form class="resend-phone-otp-form" action="javascript:;" method="post" data-action="{{ route('phone.verification.resend') }}">
              @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="form-group col-12">
                    <label class="text-muted">Phone</label>
                    <input type="number" name="phone_number" class="form-control phone_number" placeholder="Enter your phone">
                    <small class="phone_number-error text-danger"></small>
                  </div>
                </div>
                <div class="alert d-none resend-phone-otp-message mb-2 text-white"></div>
              </div>
              <div class="px-3 border-top pt-4 pb-0">
                <button type="submit" class="btn w-100 btn-primary resend-phone-otp-button">
                  <img src="/images/spinner.svg" class="me-2 d-none resend-phone-otp-spinner mb-1">Resend
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
  @include('auth.includes.footer')
</div>