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
          <h4 class="m-0 text-white">Welcome {{ ucfirst(auth()->user()->client->title ?? '') }} {{ ucwords(auth()->user()->client->fullname ?? '') }}</h4>
        </div>
        @if(empty($forms))
          <div class="alert alert-info mt-4 border-0">No froms available</div>
        @else
          <div class="row mt-4">
            @foreach($forms as $key => $form)
              <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                @include('client.forms.partials.card')
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>