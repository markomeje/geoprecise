<div class="dashboard bg-white min-vh-100">
  @include('client.includes.header')
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <main class="main-content position-relative border-radius-lg ">
      <div class="container py-4">
          @if(empty($client))
            <div class="alert alert-danger border-0 text-white">Unknown error. Try again later</div>
          @else
            <div class="">
              <h4 class="m-0 text-white">Welcome {{ ucwords(auth()->user()->client->fullname ?? '') }}</h4>
            </div>
            <div class="row mt-4">
              <div class="col-12">
                <div class="card border" style="box-shadow: none !important;">
                  <div class="card-body">
                    <h5 class="mb-0">Setup your Profile</h5>
                    @include('client.profile.partials.edit')
                  </div>
                </div>
              </div>
            </div>
          @endif
      </div>
    </main>
  @include('client.includes.footer')
</div>