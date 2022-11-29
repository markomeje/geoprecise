<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="alert alert-primary border-0 mb-4 d-flex align-content-center">
          <div class="me-3 text-white">
            {{ $roles->count() }} Roles
          </div>
          <a href="javascript:;" class="text-white">Add Role</a>
        </div>
        <div class="">
          @if(empty($roles->count()))
            <div class="alert alert-danger border-0 text-white">No roles yet</div>
          @else
            <div class="row">
              @foreach($roles as $role)
                <div class="col-xl-3 col-md-4 col-12 mb-4">
                  @include('admin.roles.partials.card')
                </div>
              @endforeach
            </div>
          @endif
        </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>