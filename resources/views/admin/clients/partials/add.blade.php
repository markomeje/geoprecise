<div class="modal fade" id="add-client" tabindex="-1" role="dialog" aria-labelledby="add-client-modal-form" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="client">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add-client-modal-form">Add Client</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="add-client-form" action="javascript:;" method="post" data-action="{{ route('admin.client.add') }}">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Fullame</label>
              <input type="text" name="full_name" class="form-control full_name" placeholder="Enter client full name">
              <small class="full_name-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Phone Number</label>
              <input type="text" name="phone_number" class="form-control phone_number" placeholder="Enter client phone">
              <small class="phone_number-error text-danger"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Date of Birth</label>
              <input type="text" name="dob" class="form-control dob" placeholder="Enter client date of birth">
              <small class="dob-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Occupation</label>
              <input type="text" name="occupation" class="form-control occupation" placeholder="Enter client occupation">
              <small class="occupation-error text-danger"></small>
            </div>
          </div>
          <div class="form-group mb-3">
            <label class="text-muted">Address</label>
            <textarea class="form-control address" name="address" placeholder="Enter address"></textarea>
            <small class="address-error text-danger"></small>
          </div>
          <div class="alert d-none add-client-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary add-client-button">
            <img src="/images/spinner.svg" class="me-2 d-none add-client-spinner mb-1">Add
          </button>
        </div>
      </form>
    </div>
  </div>
</div>