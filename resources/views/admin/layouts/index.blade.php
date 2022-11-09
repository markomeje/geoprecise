<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="alert alert-dark border-0 d-flex align-items-center">
          <a class="text-white me-2" href="javascript:;">
              {{ \App\Models\Layout::count() }} Layouts</a>
          <a class="text-white" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add-layout">Add Layout</a>
        </div>
        @include('admin.layouts.partials.add')
        @if(empty($layouts))
          <div class="alert alert-info mt-4 border-0 text-white">No layouts available</div>
        @else
          <div class="row mt-4">
            @foreach($layouts as $layout)
              <div class="col-12 col-md-4 col-lg-3 mb-4">
                @include('admin.layouts.partials.card')
              </div>
              @include('admin.layouts.partials.edit')
            @endforeach
          </div>
          {{ $layouts->links('vendor.pagination.default') }}
        @endif
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>