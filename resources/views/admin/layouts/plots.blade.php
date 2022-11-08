<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($plots->count()))
          <div class="alert alert-info mt-4 border-0 text-white">No plots available for the layout</div>
        @else
          <div class="alert alert-dark border-0 text-white">
              <a class=" text-white me-3" href="javascript:;">
                {{ isset($plots[0]) ? ucwords($plots[0]->layout->name) : '' }} ({{ $plots->count() }}) Plots
              </a>
              <a class="text-white" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add-plot">Add Plot</a>
          </div>
            @include('admin.plots.partials.add')
          <div class="row mt-4">
            @foreach($plots as $plot)
              <div class="col-12 col-md-4 col-lg-3 mb-4">
                @include('admin.plots.partials.card')
              </div>
              @include('admin.plots.partials.edit')
            @endforeach
          </div>
        @endif
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>