<div class="modal fade" id="record-plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="plot">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Record Plan Collection</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="record-plan-form" action="javascript:;" method="post" data-action="{{ route('admin.pcf.record', ['survey_id' => $survey->id]) }}">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Plan Title</label>
              <input type="text" name="plan_title" class="form-control plan_title" placeholder="Enter plan name" value="{{ $client_name }}">
              <small class="plan_title-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Plan Number</label>
              <input type="text" name="plan_number" class="form-control plan_number" placeholder="Enter plan name">
              <small class="plan_number-error text-danger"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Location</label>
              <input type="text" name="location" class="form-control location" placeholder="Enter plan name">
              <small class="location-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Collected by?</label>
              <select class="form-control client custom-select" name="client">
                <option value="{{ $client_id }}" selected>
                  {{ $client_name }}
                </option>
              </select>
              <small class="client-error text-danger"></small>
            </div>
          </div>
          <div class="alert d-none record-plan-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary record-plan-button">
            <img src="/images/spinner.svg" class="me-2 d-none record-plan-spinner mb-1">Record
          </button>
        </div>
      </form>
    </div>
  </div>
</div>