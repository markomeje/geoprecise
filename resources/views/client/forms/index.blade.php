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
          <h4 class="m-0 text-white">Welcome {{ ucwords(auth()->user()->client->fullname ?? '') }}</h4>
        </div>
        <?php $psrs = \App\Models\Psr::where(['user_id' => auth()->id()])->get(); ?>
        @if(!empty($psrs))
          <div class="bg-white px-4 py-3 text-dark my-4">Property Search Requests ({{ $psrs->count() }})</div>
          <div class="row">
            @foreach($psrs as $psr)
              <div class="col-12 col-md-4 col-lg-3 col-xl-2 mb-4">
                @include('client.psr.partials.card')
              </div>
            @endforeach
          </div>
        @endif 
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>