<div class="modal fade" id="add-layout" tabindex="-1" role="dialog" aria-labelledby="add-layout-model-sm" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="layout">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add-layout-model-sm">Add Layout</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="add-layout-form" action="javascript:;" method="post" data-action="{{ route('admin.layout.add') }}">
          @csrf
        <div class="modal-body">
            <div class="">
                <div class="row">
                    <div class="form-group col-12">
                        <label class="text-muted">Layout Name</label>
                        <input type="text" name="name" class="form-control name" placeholder="Enter layout name">
                        <small class="name-error text-danger"></small>
                    </div>
                    <div class="form-group col-12">
                        <label class="text-muted">Layout Address</label>
                        <input type="text" name="address" class="form-control address" placeholder="Enter layout address">
                        <small class="address-error text-danger"></small>
                    </div>
                </div>
            </div>
            <div class="alert d-none add-layout-message m-0 text-white"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-dark text-white me-3" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add-layout-button">
            <img src="/images/spinner.svg" class="me-2 d-none add-layout-spinner mb-1">Add
          </button>
        </div>
      </form>
    </div>
  </div>
</div>