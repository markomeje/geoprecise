<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($role))
          <div class="alert alert-danger border-0 text-white">Unkown Error. Role Not Found.</div>
        @else
          <div class="row">
            <div class="col-12 col-md-6 mb-4">
              <div class="card border-0">
                <div class="card-header border-bottom">
                  {{ ucwords($role->name) }} Role
                </div>
                <div class="card-body">
                  <?php $resources = \App\Models\Permission::$resources; ?>
                  @if(!empty($resources))
                    @foreach($resources as $resource)
                      <div class="mb-4">
                        <div class="bg-primary text-white p-4">
                          {{ $resource['description'] }}
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endif
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>