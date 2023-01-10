<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="">
          @if(empty($surveys))
            <div class="alert alert-dark border-0 mb-4 text-white d-flex align-items-center">
              <span class="me-3">No surveys yet</span>
              <a href="{{ route('client.survey.apply') }}" class="text-white">Apply</a>
            </div>
          @else
            <?php $code = request()->get('code'); ?>
            <div class="alert alert-dark border-0 mb-4 text-white d-flex align-items-center">
              <span class="me-3">{{ $surveys->total() }} Surveys and Lifting</span>
              <a href="{{ route('client.survey.apply', ['code' => $code]) }}" class="text-white">Apply</a>
            </div>
            <div class="row">
              @foreach($surveys as $survey)
                <div class="col-md-6 col-12 col-lg-4 mb-4">
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