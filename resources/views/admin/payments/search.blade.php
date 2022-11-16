<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="bg-white rounded mb-4 px-4 py-4">
          <form class="d-block w-100" method="get" action="{{ route('admin.payments.search') }}">
            <div class="row">
              <div class="form-group input-group-lg col-12 col-md-10">
                <input type="text" name="query" class="form-control" placeholder="Search payments . . ." value="{{ request()->get('query') }}">
              </div>
              <div class="col-12 col-md-2">
                <button class="btn w-100 btn-lg btn-primary m-0">
                  <i class="icofont-search"></i> Search
                </button>
              </div>
            </div>
          </form>
          <div class="">
            @if(empty($payments->count()))
              <div class="alert alert-danger border-0 text-white">No payments found</div>
            @else
              <div class="alert alert-info border-0 text-white">{{ $payments->total() }} Payments Found</div>
              <div class="row">
                @foreach($payments as $payment)
                  <div class="col-xl-3 col-md-4 col-12 mb-4">
                    @include('admin.payments.partials.card')
                  </div>
                @endforeach
              </div>
              {{ $payments->links('vendor.pagination.default') }}
            @endif
          </div>
        </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>