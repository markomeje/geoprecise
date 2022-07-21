<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($client))
          <div class="alert alert-danger border-0 text-white">Unknown error. Try again later</div>
        @else
          <div class="row">
            <div class="col-12">
              {{-- <div class="card bg-transparent"> --}}
                {{-- <div class="card-body mx-0"> --}}
                  <p class="m-0 text-white">Welcome {{ ucfirst(auth()->user()->client->title ?? '') }} {{ ucwords(auth()->user()->client->fullname ?? '') }}</p>
                {{-- </div> --}}
              {{-- </div> --}}
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header pb-0">
                  <div class="d-flex align-items-center">
                    <h5 class="mb-0">Edit Profile</h5>
                  </div>
                </div>
                <div class="card-body">
                  @if(empty($client->status) || strtolower($client->status) === 'incomplete')
                    <form class="client-profile-form" action="javascript:;" method="post" data-action="{{ route('client.profile.edit', ['id' => $client->id]) }}"></form>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="text-muted">Fullname</label>
                            <input class="form-control fullname" type="text" placeholder="Fullname">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="text-muted">Email <small>(Requires verification if changed)</small></label>
                            <input class="form-control" type="email" value="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="text-muted">First name</label>
                            <input class="form-control" type="text" value="Jesse">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="text-muted">Last name</label>
                            <input class="form-control" type="text" value="Lucky">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="text-muted">Address</label>
                            <input class="form-control" type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="text-muted">City</label>
                            <input class="form-control" type="text" value="New York">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="text-muted">Country</label>
                            <input class="form-control" type="text" value="United States">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="text-muted">Postal code</label>
                            <input class="form-control" type="text" value="437300">
                          </div>
                        </div>
                      </div>
                    </form>
                  @else
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <img src="../assets/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                  <div class="col-4 col-lg-4 order-lg-2">
                    <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                      <a href="javascript:;">
                        <img src="../assets/img/team-2.jpg" class="rounded-circle img-fluid border border-2 border-white">
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                  <div class="d-flex justify-content-between">
                    <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Connect</a>
                    <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i class="ni ni-collection"></i></a>
                    <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Message</a>
                    <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i class="ni ni-email-83"></i></a>
                  </div>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col">
                      <div class="d-flex justify-content-center">
                        <div class="d-grid text-center">
                          <span class="text-lg font-weight-bolder">22</span>
                          <span class="text-sm opacity-8">Friends</span>
                        </div>
                        <div class="d-grid text-center mx-4">
                          <span class="text-lg font-weight-bolder">10</span>
                          <span class="text-sm opacity-8">Photos</span>
                        </div>
                        <div class="d-grid text-center">
                          <span class="text-lg font-weight-bolder">89</span>
                          <span class="text-sm opacity-8">Comments</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center mt-4">
                    <h5>
                      Mark Davis<span class="font-weight-light">, 35</span>
                    </h5>
                    <div class="h6 font-weight-300">
                      <i class="ni location_pin mr-2"></i>Bucharest, Romania
                    </div>
                    <div class="h6 mt-4">
                      <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                    </div>
                    <div>
                      <i class="ni education_hat mr-2"></i>University of Computer Science
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif
    </div>
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>