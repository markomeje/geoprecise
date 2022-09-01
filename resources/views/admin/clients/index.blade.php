<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="bg-white p-4 border-radius-xl">
          <div class="row">
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-3">
              <a href="javascript:;" class="btn d-flex m-0 align-items-center justify-content-center btn-dark" data-bs-toggle="modal" data-bs-target="#add-client">
                <small class="me-2">
                  <i class="ni ni-add text-primary text-sm opacity-10"></i>
                </small>
                <small class="text-white">Add Client</small>
              </a>
              @include('admin.clients.partials.add')
            </div>
          </div>
          <h5 class="mb-4">All Clients</h5>
          @if(empty($clients->count()))
            <div class="alert alert-info">No clients yet</div>
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