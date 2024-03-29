<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="bg-white rounded mb-4 px-4 pt-4">
          <form class="d-block w-100" method="get" action="javascript:;">
            <div class="row">
              <div class="form-group input-group-lg col-12 col-md-10 mb-4">
                <input type="text" name="search" class="form-control" placeholder="Search Reprinting . . ." value="{{ request()->get('search') }}">
              </div>
              <div class="col-12 col-md-2 mb-4">
                <button class="btn w-100 btn-lg btn-primary m-0">
                  <i class="icofont-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="bg-white p-4 border-radius-xl">
          <div class="alert alert-danger border-0 text-white">No reprinting yet</div>
          {{-- @if(empty($reprinting->count()))
            <div class="alert alert-danger border-0 text-white">No reprinting yet</div>
          @else
            <div class="alert alert-info border-0 mb-4 text-white">{{ $reprinting->total() }} Reprintings</div>
            <div class="row">
              @foreach($reprinting as $reprint)
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                  @include('client.reprinting.partials.card')
                </div>
              @endforeach
            </div>
            {{ $reprinting->links('vendor.pagination.default') }}
          @endif --}}
        </div>
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>