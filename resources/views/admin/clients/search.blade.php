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
          <form class="d-block w-100" method="get" action="{{ route('admin.clients.search') }}">
            <div class="row">
              <div class="form-group input-group-lg col-12 col-md-10 mb-4">
                <input type="text" name="search" class="form-control" placeholder="Search Clients . . ." value="{{ request()->get('search') }}">
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
          <div class="alert alert-info d-flex align-items-center mb-4">
            <div class="me-3 text-white">({{ $clients->total() }}) Clients Found</div>
            <a href="javascript:;" class="text-white align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#add-client">Add Client</a>
          </div>
          @include('admin.clients.partials.add')
          @if(empty($clients->count()))
            <div class="alert alert-danger text-white">No results found</div>
          @else
            <div class="row">
              @foreach($clients as $client)
                <div class="col-xl-3 col-md-4 col-12 mb-4">
                @include('admin.clients.partials.card')
              </div>
              @endforeach
            </div>
            {{ $clients->links('vendor.pagination.default') }}
          @endif
        </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>