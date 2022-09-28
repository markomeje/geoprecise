<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          @include('admin.dashboard.partials.panels')
        </div>
        <div class="row mt-4">
          @if(empty($forms))
            <div class="alert alert-info">No froms available</div>
          @else
            @foreach($forms as $key => $form)
              @if(!empty($form->amount))
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                  @include('client.forms.partials.card')
                </div>
              @endif
            @endforeach
          @endif
        </div>
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>