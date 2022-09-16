<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
          @if(empty($surveys->count()))
            <div class="alert alert-danger border-0 text-white">No surveys yet</div>
          @else
            <div class="alert alert-info border-0 mb-4 text-white">{{ $surveys->total() }} Surveys and Lifting</div>
            <div class="row">
              @foreach($surveys as $survey)
                <div class="col-xl-3 col-md-4 col-12 mb-4">
                  @include('admin.surveys.partials.card')
                </div>
              @endforeach
            </div>
            {{ $surveys->links('vendor.pagination.default') }}
          @endif
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>