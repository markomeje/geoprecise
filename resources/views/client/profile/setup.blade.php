<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            {{-- <div class="card bg-transparent"> --}}
              {{-- <div class="card-body mx-0"> --}}
                <p class="m-0 text-white">Welcome {{ ucfirst(auth()->user()->client->title ?? '') }} {{ ucwords(auth()->user()->client->fullname ?? '') }}</p>
              {{-- </div> --}}
            {{-- </div> --}}
          </div>
        </div>
        <div class="row mt-4">
          @if(empty($forms))
            <div class="alert alert-info">No froms available</div>
          @else
            @foreach($forms as $key => $form)
              <div class="col-12 col-md-6 col-lg-3 mb-4">
                @include('client.forms.partials.card')
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>