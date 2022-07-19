<div class="">
	@include('auth.includes.header')
	<!-- End Navbar -->
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
    </div>
    <div class="container">
      <div class="row mt-md-n11 mt-n10 justify-content-center" style="margin-top: -24rem !important;">
        <div class="col-xl-5 col-lg-7 col-md-9 mx-auto">
          <div class="card py-3 z-index-0 mb-5">
            <div class="card-header pt-4">
              <a href="{{ route('home') }}" class="mb-3 d-block" style="max-width: 240px;">
                    <img src="/images/logo.png" class="img-fluid w-100 object-fit">
                  </a>
              <h5 class="mb-3">Signup Here</h5>
              <p class="m-0">Please fill in all fields below to create an account with us.</p>
            </div>
            <div class="card-body pt-0">
              <form class="signup-form" action="javascript:;" method="post" data-action="{{ route('auth.signup') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                      <label class="text-muted">Title</label>
                      <select class="form-control custom-select title" name="title">
                        <option value="" class="text-muted">Select title</option>
                        <?php $titles = \App\Models\User::NAME_TITLES; ?>
                        @if(empty($titles))
                          <option value="" class="text-muted">No titles listed</option>
                        @else
                          @foreach($titles as $title)
                            <option value="{{ strtolower($title) }}">
                              {{ ucfirst($title) }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                      <small class="firstname-error text-danger"></small>
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                      <label class="text-muted">Fullname</label>
                      <input type="text" class="form-control fullname" placeholder="Enter your fullname" aria-label="Fullname" name="fullname">
                      <small class="fullname-error text-danger"></small>
                    </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label class="text-muted">Phone number</label>
                    <input type="text" class="form-control phone" placeholder="Enter your phone number" aria-label="Phone" name="phone">
                    <small class="phone-error text-danger"></small>
                  </div>
                  <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label class="text-muted">Email</label>
                    <input type="email" class="form-control email" placeholder="Enter your email" aria-label="Email" name="email">
                    <small class="email-error text-danger"></small>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label class="text-muted">Password</label>
                    <input type="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" aria-label="Password" name="password">
                    <small class="password-error text-danger"></small>
                  </div>
                  <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label class="text-muted">Retype password</label>
                    <input type="password" class="form-control retype" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" aria-label="Password" name="retype">
                    <small class="retype-error text-danger"></small>
                  </div>
                </div>
                <div>
                  <div class="form-check form-check-info text-start">
                    <input class="form-check-input agree" type="checkbox" id="flexCheckDefault" name="agree">
                    <label class="form-check-label mt-1 d-block" for="flexCheckDefault">
                      I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                    </label>
                  </div>
                  <small class="agree-error text-danger"></small>
                </div>
          
                <div class="alert d-none signup-message mb-0 mt-3 text-white"></div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">
                      <img src="/images/spinner.svg" class="me-2 d-none signup-spinner mb-1">Signup
                    </button>
                  </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Login</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('auth.includes.footer')
</div>