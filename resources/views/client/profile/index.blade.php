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
          <div class="">
            <h4 class="m-0 text-white">Welcome {{ ucfirst(auth()->user()->client->title ?? '') }} {{ ucwords(auth()->user()->client->fullname ?? '') }}</h4>
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
                    @include('client.profile.partials.edit')
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