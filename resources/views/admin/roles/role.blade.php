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
            <div class="col-12 col-xl-9 mb-4">
              <div class="">
                <div class="alert alert-dark mb-4 border-0 text-white">
                  {{ ucwords($role->name) }} Role
                </div>
                <form action="javascript:;" class="permission-form" method="post" data-action={{ route('admin.permission.set', ['role_id' => $role->id]) }}>
                  <?php $resources = \App\Models\Permission::$resources; $permissions = $role->permissions; ?>
                  @if(!empty($resources))
                    @foreach($resources as $resource => $value)
                      <div class="mb-4 px-4 pt-4 pb-1 border bg-white">
                        <div class="bg-dark text-white p-4 mb-4">
                          {{ $value['description'] }}
                        </div>
                        <?php $actions = $value['actions']; ?>
                        @if(is_array($actions))
                          <div class="row">
                            @foreach($actions as $action => $value)
                              <?php $function = $resource.'|'.$action; $permission = \App\Models\Permission::where(['resource' => $resource, 'action' => $action, 'role_id' => $role->id])->first(); ?>
                              <div class="col-12 col-md-6 col-lg-4">
                                <div class="p-4 border rounded bg-white text-dark mb-4">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input me-2" type="checkbox" id="{{ $function }}" name="permission[]" value="{{ $function }}" {{ empty($permission) ? '' : 'checked' }}>
                                    <label class="form-check-label" for="{{ $function }}">
                                      <small class="text-dark">
                                        {{ ucwords($value) }}
                                      </small>
                                    </label>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          </div>
                        @endif
                      </div>
                    @endforeach
                  @endif
                  <div class="alert d-none permission-message mb-4 text-white"></div>
                  <button type="submit" class="btn btn-lg w-100 btn-primary permission-button">
                    <img src="/images/spinner.svg" class="me-2 d-none permission-spinner mb-1">Save
                  </button>
                </form>
              </div>
            </div>
          </div>
        @endif
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>