<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="alert alert-info border-0 mb-4 text-white d-flex align-items-center justify-content-between">
          <span>{{ $sibs->total() }} Site Inspection Bookings</span>
        </div>
        <div class="">
          <h5 class="mb-4"></h5>
          @if(empty($sibs->count()))
            <div class="alert alert-info">No surveys yet</div>
          @else
            <div class="row">
              @foreach($sibs as $sib)
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                  @include('client.sib.partials.card')
                </div>
              @endforeach
            </div>
            {{ $sibs->links('vendor.pagination.default') }}
          @endif
        </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>