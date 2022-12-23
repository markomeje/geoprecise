<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      @include('client.sib.partials.apply')
      <div class="container-fluid py-4">
        <div class="alert alert-info border-0 mb-4 text-white d-flex align-items-center">
            <div class="text-white me-2">({{ $sibs->total() }}) Inspection(s)</div>
            <div class="text-white cursor-pointer" data-bs-toggle="modal" data-bs-target="#apply-sib">Apply for Inspection</div>
        </div>
        <div class="">
          @if(empty($sibs->count()))
            <div class="alert alert-danger border-0 text-white">No site inspections yet</div>
          @else
            <div class="row">
              @foreach($sibs as $sib)
                @if(!empty($sib->plan))
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        @include('client.sib.partials.card')
                    </div>
                @endif
              @endforeach
            </div>
            {{ $sibs->links('vendor.pagination.default') }}
          @endif
        </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>