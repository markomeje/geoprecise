<div class="pb-4">
	@include('auth.includes.header')
	<!-- End Navbar -->
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('./../../content/uploads/2020/03/Cadastral-Land-Survey-1024x853.jpg'); background-position: center;">
      <span class="mask bg-gradient-dark opacity-6"></span>
    </div>
    <div class="container">
      <div class="row justify-content-center" style="margin-top: -24rem !important;">
        <div class="col-xl-6 col-lg-7 col-md-9 mx-auto">
          <div class="card py-3 z-index-0 mb-5">
            <div class="card-header pt-4">
              <a href="{{ route('home') }}" class="mb-3 d-block" style="max-width: 240px;">
                  <img src="/images/logo.png" class="img-fluid w-100 object-fit">
                </a>
            </div>
            <div class="card-body pt-0">
              @if(empty($verification))
                <div class="">
                  <div class="alert alert-danger mb-4 text-white">Unknown Error. Try again Later.</div>
                    <p class="m-0 mb-4">Having issues with verification? Click the button below to resend the verification link.</p>
                    <div class="row">
                      <div class="col-12 col-md-6 mb-3">
                        <a href="javascript:;" class="btn btn-lg btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#resend-verification">Resend</a>
                      </div>
                      <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-lg w-100">Login</a>
                      </div>
                    </div>
                  </div>
              @else
                <div>
                  @if(request()->get('resend'))
                    <div class="alert alert-success mb-4 text-white">A new verification link have been sent to your email. It is valid for 60minutes.</div>
                    <div class="row">
                      <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-lg w-100">Login Here</a>
                      </div>
                      <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-lg w-100">Contact Us</a>
                      </div>
                    </div>
                  @elseif($verification['status'] == 1)
                    <div class="alert alert-success mb-4 text-white">
                      {{ $verification['info'] }}
                    </div>
                    <div class="row">
                      <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-lg w-100">Login Here</a>
                      </div>
                      <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-lg w-100">Contact Us</a>
                      </div>
                    </div>
                  @else
                    <div class="alert alert-danger mb-4 text-white">
                      {{ $verification['info'] }}
                    </div>
                    <p class="m-0 mb-4">Having issues with verification? Click the button below to resend the verification link.</p>
                      <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                          <a href="javascript:;" class="btn btn-lg btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#resend-verification">Resend</a>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                          <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-lg w-100">Login</a>
                        </div>
                      </div>
                  @endif
                </div>
              @endif
              <p>
                &copy; {{ date('Y') }} All rights reserved {{ config('app.name') }}.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('auth.signup.partials.resend')
  @include('auth.includes.footer')
</div>