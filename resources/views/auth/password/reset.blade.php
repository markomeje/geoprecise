<div class="">
	@include('auth.includes.header')
	<!-- End Navbar -->
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card card-plain">
                <div class="card-header bg-transparent pb-0 text-start">
	                <a href="{{ route('home') }}" class="mb-3 d-block" style="max-width: 240px;">
	                	<img src="/images/logo.png" class="img-fluid w-100 object-fit">
	                </a>
                 <h4 class="font-weight-bolder">Reset your password</h4>
                </div>
                <div class="card-body">
                  <form class="password-reset-form" action="javascript:;" method="post" data-action="{{ route('password.reset.update') }}">
                    @csrf
                    <div class="form-group">
                    	<label class="text-muted">OTP Code</label>
                      	<input type="text" class="form-control form-control-lg otp_code" placeholder="Enter the code sent to your phone" name="otp_code">
                        <small class="otp_code-error text-danger"></small>
                    </div>
                    <div class="form-group">
                    	<label class="text-muted">Password</label>
                      	<input type="password" class="form-control form-control-lg password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" name="password">
                        <small class="password-error text-danger"></small>
                    </div>
                    <div class="form-group">
                    	<label class="text-muted">Confirm Password </label>
                      <input type="password" class="form-control form-control-lg password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" aria-label="Password" name="confirm_password">
                      <small class="confirm_password-error text-danger"></small>
                    </div>
                    <div class="alert d-none password-reset-message m-0 text-white"></div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary password-reset-button btn-lg w-100 mt-4 mb-0">
                        <img src="/images/spinner.svg" class="me-2 d-none password-reset-spinner mb-1">Reset
                      </button>
                    </div>
                  </form>
                  <p class="mb-4 text-sm">
                    Don't have an account? <a href="{{ route('signup') }}" class="text-primary text-gradient font-weight-bold">Signup</a> or <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Login</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  @include('auth.includes.footer')
</div>