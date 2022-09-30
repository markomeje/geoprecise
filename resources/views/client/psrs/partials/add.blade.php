<div class="modal fade" id="add-psr" tabindex="-1" role="dialog" aria-labelledby="psr-form" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="plot">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="psr-form">Property Search Request (PSR) form</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="psr-form" action="javascript:;" method="post" data-action="{{ route('client.psr.add') }}">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Status</label>
              <select class="form-control status" name="status">
                <option value="">Select status</option>
                <?php $status = \App\Models\Psr::STATUS; ?>
                @if(empty($status))
                  <option value="">No status listed</option>
                @else
                  @foreach($status as $value)
                    <option value="{{ $value }}">
                      {{ ucwords($value) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="status-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Layout</label>
              <select class="form-control layout" name="layout">
                <option value="">Select layout</option>
                <?php $layouts = \App\Models\Layout::all(); ?>
                @if(empty($layouts->count()))
                  <option value="">No layout listed</option>
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
          <div class="form-group mb-3">
            <label class="text-muted">Sold by?</label>
            <input type="text" class="form-control sold_by" name="sold_by" rows="4" placeholder="Enter seller name">
            <small class="sold_by-error text-danger"></small>
          </div>
          <div class="form-group">
            <label class="text-muted">Comments</label>
            <textarea class="form-control comments" rows="4" name="comments" placeholder="Enter comments"></textarea>
            <small class="comments-error text-danger"></small>
          </div>
          <div class="alert d-none psr-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary psr-button">
            <img src="/images/spinner.svg" class="me-2 d-none psr-spinner mb-1">Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>