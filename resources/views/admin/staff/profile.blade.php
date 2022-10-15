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
              <div class="alert alert-info border-0 mb-4 text-white d-flex justify-content-between align-items-center">
                <span class="text-white">{{ ucwords($staff->fullname) }} Profile</span>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 col-lg-7 mb-4">
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
                              <?php $roles = \App\Models\Staff::$roles; ?>
                              @if(empty($roles))
                                <option value="">No roles listed</option>
                              @else
                                @foreach($roles as $role)
                                  @if($role == $staff->role)
                                    <option value="{{ $role }}" {{ $staff->role == $role ? 'selected' : '' }}>
                                      {{ ucwords($role) }}
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
                  <div class="">
                    <div class="alert alert-info text-white mb-4">Update staff permissions</div>
                    <div class="">
                      <?php $functions = \App\Models\Permission::$resources; ?>
                      @if(!empty($functions))
                        @foreach($functions as $resource => $function)
                          <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header border-bottom bg-white">
                              {{ ucwords($function['description']) }}
                            </div>
                            <div class="card-body px-4 pt-4 pb-0">
                              @if(empty($function['actions']))
                                <div class="alert alert-info">No actions to assign</div>
                              @else
                                <div class="row">
                                  @foreach($function['actions'] as $action => $detail)
                                    <?php $permission = \App\Models\Permission::where(['resource' => $resource, 'permission' => $action, 'staff_id' => $staff->id])->first(); ?>
                                    <div class="col-12 col-md-4 mb-4">
                                      <div class="bg-dark rounded d-flex align-items-center justify-content-between p-4">
                                          <div class="dropdown">
                                              <a href="javascript:;" class="text-white cursor-pointer text-underline" id="{{ auth()->id() }}" data-toggle="dropdown">
                                                  {{ ucfirst($action) }}
                                              </a>
                                              <div class="dropdown-menu border-0 p-4 shadow dropdown-menu-left" aria-labelledby="{{ auth()->id() }}" style="width: 220px !important;">
                                                  <div class="text-muted">
                                                      {{ ucfirst($detail) }}
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="dropdown">
                                              <a href="javascript:;" class="text-white cursor-pointer text-decoration-none" id="{{ auth()->id() }}" data-toggle="dropdown">
                                                  @if(empty($permission))
                                                      <div class="bg-danger sm-circle rounded-circle text-center text-white">
                                                          <div class="tiny-font position-relative" style="top: 3.2px;">
                                                              <i class="icofont-exclamation-circle"></i>
                                                          </div>
                                                      </div>
                                                  @else
                                                      <div class="bg-success sm-circle rounded-circle text-center">
                                                          <div class="tiny-font position-relative" style="top: 3px;">
                                                              <i class="icofont-check-alt"></i>
                                                          </div>
                                                      </div>
                                                  @endif
                                              </a>
                                              <div class="dropdown-menu border-0 p-4 shadow dropdown-menu-right" aria-labelledby="{{ auth()->id() }}" style="width: 220px !important;">
                                                  @if(empty($permission))
                                                      <form method="post" class="assign-permission-form" action="javascript:;" data-action="{{ route('admin.permission.assign', ['resource' => $resource, 'permission' => $action, 'staff_id' => $staff->id]) }}">
                                                          <button type="submit" class="btn btn-success btn-block assign-permission-button">
                                                              <img src="/images/spinner.svg" class="mr-2 d-none assign-permission-spinner mb-1">Assign
                                                          </button>
                                                          <div class="alert d-none mt-4 tiny-font assign-permission-message"></div>
                                                      </form>
                                                  @else
                                                      <form method="post" class="remove-permission-form" action="javascript:;" data-action="{{ route('admin.permission.remove', ['id' => $permission->id]) }}">
                                                          <button type="submit" class="btn btn-danger btn-block remove-permission-button">
                                                              <img src="/images/spinner.svg" class="mr-2 d-none remove-permission-spinner mb-1">Remove
                                                          </button>
                                                          <div class="alert d-none mt-4 tiny-font remove-permission-message"></div>
                                                      </form>
                                                  @endif
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                  @endforeach
                                </div>
                              @endif
                            </div>
                          </div>
                        @endforeach
                      @endif
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