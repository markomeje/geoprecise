<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="alert alert-info border-0 text-white">{{ $psrs->total() }} Property Search Requests</div>
        <div class="">
          <h5 class="mb-4"></h5>
          @if(empty($psrs->count()))
            <div class="alert alert-info">No psrs yet</div>
          @else
            <div class="row">
              @foreach($psrs as $psr)
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                  @include('client.psrs.partials.card')
                </div>
              @endforeach
            </div>
            {{ $psrs->links('vendor.pagination.default') }}
          @endif
        </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>