<div class="">
	@include('auth.includes.header')
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
                    	<label class="text-muted">Phone number</label>
                      	<input type="email" class="form-control form-control-lg email" placeholder="Your phone number" aria-label="Phone" name="email">
                        <small class="email-error text-danger"></small>
                    </div>
                    <div class="form-group">
                    	<label class="text-muted">Password</label>
                      <input type="password" class="form-control form-control-lg password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" aria-label="Password" name="password">
                      <small class="password-error text-danger"></small>
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
                </div>
                <div class="card-footer pt-0">
                  <p class="mb-4 text-sm">
                    Don't have an account? <a href="{{ route('signup') }}" class="text-primary text-gradient font-weight-bold">Signup</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg'); background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">Attention is the new currency</h4>
                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  @include('auth.includes.footer')
</div>