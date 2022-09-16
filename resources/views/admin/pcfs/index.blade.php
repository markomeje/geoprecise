<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center">
          <div class="">
            <a class="text-white" href="javascript:;">
              {{ \App\Models\Pcf::count() }} Plan Collections</a>
          </div>
          {{-- <div class="">
            <a class="btn w-100 bg-gradient-dark m-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add-plot">
              <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Plot
            </a>
              @include('admin.plots.partials.add')
          </div> --}}
        </div>
        @if(empty($pcfs->count()))
          <div class="alert alert-info mt-4 border-0 text-white">No plan collections available</div>
        @else
          <div class="row mt-4">
            @foreach($pcfs as $pcf)
              <div class="col-12 col-md-4 col-lg-3 mb-4">
                @include('admin.pcfs.partials.card')
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>