<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="alert alert-dark border-0 text-white">
            <a class=" text-white me-3" href="javascript:;">
            {{ !empty($layout->name) ? ucwords($layout->name) : '' }} ({{ empty($plots->count()) ? 0 : $plots->total() }}) Plots
            </a>
            <a class="text-white" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add-plot">Add Plot</a>
        </div>
        @include('admin.plots.partials.add')
        @if(empty($plots->count()))
          <div class="alert alert-danger mt-4 border-0 text-white">No Plots Available for this Layout</div>
        @else
          <div class="row mt-4">
            @foreach($plots as $plot)
              <div class="col-12 col-md-4 col-lg-3 mb-4">
                @include('admin.plots.partials.card')
              </div>
              @include('admin.plots.partials.edit')
            @endforeach
          </div>
          {{ $plots->links('vendor.pagination.default') }}
        @endif
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>