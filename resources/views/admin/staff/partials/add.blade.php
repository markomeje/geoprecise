<div class="modal fade" id="add-staff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="staff">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="add-staff-form" action="javascript:;" method="post" data-action="{{ route('admin.staff.add') }}">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Fullname</label>
              <input type="text" name="fullname" class="form-control fullname" placeholder="Enter fullname">
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
                    <option value="{{ $title }}">
                      {{ ucwords($title) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="title-error text-danger"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Email</label>
              <input type="email" name="email" class="form-control email" placeholder="Enter email">
              <small class="email-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">phone</label>
              <input type="text" name="phone" class="form-control phone" placeholder="Enter phone">
              <small class="phone-error text-danger"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Role</label>
              <select class="form-control role" name="role">
                <option value="">Select role</option>
                <?php $roles = \App\Models\Staff::$roles; ?>
                @if(empty($roles))
                  <option value="">No roles listed</option>
                @else
                  @foreach($roles as $role)
                    <option value="{{ $role }}">
                      {{ ucwords($role) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="role-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Address</label>
              <input type="text" name="address" class="form-control address" placeholder="Enter address">
              <small class="address-error text-danger"></small>
            </div>
          </div>
          <div class="alert d-none add-staff-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary add-staff-button">
            <img src="/images/spinner.svg" class="me-2 d-none add-staff-spinner mb-1">Add
          </button>
        </div>
      </form>
    </div>
  </div>
</div>