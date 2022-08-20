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
          <a class="btn bg-gradient-dark mb-1" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add-document">
            <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Document</a>
            @include('client.documents.partials.add')
        </div>
        @if(empty($documents))
          <div class="alert alert-info mt-4 border-0 text-white">No documents available</div>
        @else
          <div class="row mt-4">
            @foreach($documents as $document)
              <div class="col-12 col-md-4 col-lg-3 mb-4">
                @include('client.documents.partials.card')
              </div>
              @include('client.documents.partials.edit')
            @endforeach
          </div>
        @endif
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>