<div class="modal fade" id="add-plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="plan">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Plan Info</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="add-plan-form" action="javascript:;" method="post" data-action="{{ route('admin.plan.add') }}">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-12">
              <label class="text-muted">Client Name</label>
              <input type="text" name="client_name" class="form-control client_name" placeholder="Enter client name">
              <small class="client_name-error text-danger"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Plan Number</label>
              <input type="text" name="plan_number" class="form-control plan_number" placeholder="Enter plan numbers">
              <small class="plan_number-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Layout Name</label>
              <select class="form-control layout" name="layout">
                <option value="">Select layout</option>
                <?php $layouts = \App\Models\Layout::all(); ?>
                @if(empty($layouts->count()))
                  <option value="">No layouts listed</option>
                @else
                  @foreach($layouts as $area)
                    <option value="{{ $area->id }}">
                      {{ ucwords($area->name) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="layout-error text-danger"></small>
            </div>
          </div>
          <div class="alert d-none add-plan-message mb-3 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary add-plan-button">
            <img src="/images/spinner.svg" class="me-2 d-none add-plan-spinner mb-1">Add
          </button>
        </div>
      </form>
    </div>
  </div>
</div>