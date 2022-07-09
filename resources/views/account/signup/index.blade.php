<div class="">
	@include('argon.header')
	<!-- End Navbar -->
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-5 col-lg-7 col-md-9 mx-auto">
            <h1 class="text-white mb-2 mt-5">Geoprecise Group</h1>
            <p class="text-lead text-white">Welcome to our platform. get started with our services immediately</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-5 col-lg-7 col-md-9 mx-auto">
          <div class="card z-index-0">
            <div class="card-header pt-4">
              <h5 class="mb-3">Signup now.</h5>
              <p class="m-0">Enter your phone number and password to create an account with us.</p>
            </div>
            <div class="card-body pt-0">
              <form role="form">
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                      <label class="text-muted">Firstname</label>
                      <input type="text" class="form-control firstname" placeholder="Firstname" aria-label="Name">
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                      <label class="text-muted">Surname</label>
                      <input type="text" class="form-control surname" placeholder="Surname" aria-label="Name">
                    </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label class="text-muted">Phone number</label>
                    <input type="text" class="form-control phone" placeholder="Phone" aria-label="Phone">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label class="text-muted">Password</label>
                    <input type="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" aria-label="Password">
                  </div>
                  <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label class="text-muted">Retype password</label>
                    <input type="password" class="form-control retype" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" aria-label="Password">
                  </div>
                </div>
                <div class="form-check form-check-info text-start">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                  <label class="form-check-label mt-1" for="flexCheckDefault">
                    I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                  </label>
                </div>
                <div class="">
                  <button type="button" class="btn bg-gradient-dark w-100 my-3 mb-2">Sign up</button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Login</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('argon.footer')
</div>