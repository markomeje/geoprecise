<div class="modal fade" id="reprinting-apply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="plot">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apply for Survey Plan Reprinting</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="reprinting-apply-form" action="javascript:;" method="post" data-action="{{ route('client.reprinting.apply') }}">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-6">
              <label class="text-muted">Plan Number (e.g., 009)</label>
              <input type="text" class="form-control plan_number" name="plan_number" placeholder="Enter plan number" />
              <small class="plan_number-error text-danger"></small>
            </div>
            <div class="form-group col-6">
              <label class="text-muted">Year</label>
              <input type="text" class="form-control year" name="year" placeholder="Enter plan number" />
              <small class="year-error text-danger"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-12">
              <label class="text-muted">Select Layout</label>
              <select class="form-control layout" name="layout">
                <option value="">Select Layout</option>
                <?php $layouts = \App\Models\Layout::all(); ?>
                @if(empty($layouts->count()))
                  <option value="">No Layouts listed</option>
                @else
                  @foreach($layouts as $layout)
                    <option value="{{ $layout->id }}">
                      {{ ucwords($layout->name) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="layout-error text-danger"></small>
            </div>
          </div>
          <div class="alert d-none reprinting-apply-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary w-100 reprinting-apply-button">
            <img src="/images/spinner.svg" class="me-2 d-none reprinting-apply-spinner mb-1">Continue
          </button>
        </div>
      </form>
    </div>
  </div>
</div>