<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
          @if(empty($staff))
            <div class="alert alert-danger border-0 text-white">Profile not found. May have been deleted.</div>
          @else
            <div class="">
              <div class="row">
                <div class="col-12 col-md-6 col-lg-7 mb-4">
                  <div class="alert alert-info border-0 mb-4 text-white d-flex justify-content-between align-items-center">
                    <span class="text-white">{{ ucwords($staff->fullname) }} Profile</span>
                  </div>
                  <div class="card border-0 mb-4">
                    <div class="card-header border-bottom">Edit Profile</div>
                    <div class="card-body">
                      <form class="edit-staff-form" action="javascript:;" data-action="{{ route('admin.staff.edit', ['id' => $staff->id]) }}" method="post">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="text-muted">Fullname</label>
                            <input type="text" class="form-control fullname" name="fullname" placeholder="Enter fullname" value="{{ $staff->fullname }}">
                            <small class="fullname-error text-danger"></small>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="text-muted">Title</label>
                            <select class="form-control title" name="title">
                              <option value="">Select title</option>
                              <?php $titles = \App\Models\Staff::$titles; ?>
                              @if(empty($titles))
                                <option value="">No titles listed</option>
                              @else
                                @foreach($titles as $title)
                                  <option value="{{ $title }}" {{ $title == $staff->title ? 'selected' : '' }}>
                                    {{ ucwords($title) }}
                                  </option>
                                @endforeach
                              @endif
                            </select>
                            <small class="title-error text-danger"></small>
                          </div>
                        </div>
                        <div class="row mb-1">
                          <div class="form-group col-md-6">
                            <label class="text-muted">Address</label>
                            <input type="text" name="address" class="form-control address" placeholder="Enter address" value="{{ $staff->address }}">
                            <small class="address-error text-danger"></small>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="text-muted">Role</label>
                            <select class="form-control role" name="role">
                              <?php $roles = \App\Models\Role::all(); ?>
                              @if(empty($roles))
                                <option value="">No roles listed</option>
                              @else
                                @foreach($roles as $role)
                                  @if($role->id == $staff->role_id)
                                    <option value="{{ $role->id }}" {{ $staff->role == $role ? 'selected' : '' }}>
                                      {{ ucwords($role->name) }}
                                    </option>
                                  @endif
                                @endforeach
                              @endif
                            </select>
                            <small class="role-error text-danger"></small>
                          </div>
                        </div>
                        <div class="alert d-none edit-staff-message mb-3 text-white"></div>
                        <button type="submit" class="btn btn-primary edit-staff-button">
                          <img src="/images/spinner.svg" class="me-2 d-none edit-staff-spinner mb-1">Save
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-5"></div>
              </div>
            </div>
          @endif
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>