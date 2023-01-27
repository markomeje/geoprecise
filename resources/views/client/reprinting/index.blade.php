<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="">
          <h4 class="mb-3 text-white">All Additional Survey Plan Reprinting {{ $reprinting; }}</h4>
          <div class="alert alert-info border-0 mb-4 d-flex align-items-center">
            <div class="text-white me-2">
              {{ $reprinting ?? 0 }} Reprintings
            </div>
            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#reprinting-apply" class="text-white">Apply</a>
          </div>
          @include('client.reprinting.partials.apply')
        </div>
        <div class="p-4 bg-white">
          @if(empty($reprinting))
            <div class="alert alert-danger border-0 mb-0 text-white">You have no reprinting records yet</div>
          @else
            <div class="row">
              @foreach($payments as $payment)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                  @include('client.payments.partials.card')
                </div>
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>