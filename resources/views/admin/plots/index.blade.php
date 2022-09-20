<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="alert alert-info d-flex border-0 align-items-center">
          <a class="text-white me-2" href="javascript:;">
              {{ \App\Models\Plot::count() }} Plots</a>
          <a class="m-0 text-white" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add-plot">Add Plot</a>
        </div>
        @include('admin.plots.partials.add')
        @if(empty($plots))
          <div class="alert alert-info mt-4 border-0 text-white">No plots available</div>
        @else
          <div class="row mt-4">
            @foreach($plots as $plot)
              <div class="col-12 col-md-4 col-lg-3 mb-4">
                @include('admin.plots.partials.card')
              </div>
              @include('admin.plots.partials.edit')
            @endforeach
            {{ $plots->links('vendor.pagination.default') }}
          </div>
        @endif
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>