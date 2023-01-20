<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
          <div class="p-4 bg-white border-radius-lg">
            <div class="alert alert-info border-0 mb-4 text-white d-flex align-items-center">
              <span class="text-white me-2">All Staff ({{ $staffs->total() }})</span>
              <span class="text-white cursor-pointer" data-bs-toggle="modal" data-bs-target="#add-staff">Add Staff</span>
            </div>
            @include('admin.staff.partials.add')
            @if(empty($staffs->count()))
              <div class="alert alert-danger border-0 text-white">No staff yet</div>
            @else
              <div class="row">
                @foreach($staffs as $staff)
                    @if(!empty($staff->role) && auth()->id() !== $staff->user_id)
                        <div class="col-xl-4 col-md-4 col-lg-6 col-12 mb-4">
                            @include('admin.staff.partials.card')
                        </div>
                    @endif
                @endforeach
              </div>
              {{ $staffs->links('vendor.pagination.default') }}
            @endif
          </div>
            
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>