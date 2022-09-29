<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="alert alert-info border-0 text-white">{{ $surveys->total() }} Surveys and Lifting Applications</div>
        <div class="">
          <h5 class="mb-4"></h5>
          @if(empty($surveys->count()))
            <div class="alert alert-info">No surveys yet</div>
          @else
            <div class="row">
              @foreach($surveys as $survey)
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                  @include('client.survey.partials.card')
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