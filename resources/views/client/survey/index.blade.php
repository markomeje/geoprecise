<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="alert alert-info border-0 mb-4 text-white d-flex align-items-center">
          <span class="me-3">{{ $surveys->total() }} Surveys and Lifting</span>
          <a href="{{ route('client.survey.apply') }}" class="text-white">Apply</a>
        </div>
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
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>