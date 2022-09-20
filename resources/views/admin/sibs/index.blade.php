<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="alert alert-info border-0 text-white d-flex align-items-center">
          <span class="me-3">
            {{ $sibs->total() }} Site Inspection Bookings
          </span>
          <a class="m-0 text-white" href="javascript:;" data-bs-toggle="modal" data-bs-target="#apply-sib">Apply</a>
        </div>
        @include('admin.sibs.partials.apply')
        <div class="">
          @if(empty($sibs->count()))
            <div class="alert alert-danger border-0 text-white">No Site Inspection Bookings yet</div>
          @else
            <div class="row">
              @foreach($sibs as $sib)
                <div class="col-xl-3 col-md-4 col-12 mb-4">
                  @include('admin.sibs.partials.card')
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