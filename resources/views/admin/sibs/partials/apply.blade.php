<div class="modal fade" id="apply-sib" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="plot">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apply for Site Inspection</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="apply-sib-form" action="javascript:;" method="post" data-action="{{ route('admin.sib.apply') }}">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Layout Name</label>
              <select class="form-control layout" name="layout">
                <option value="">Select layout</option>
                <?php $layouts = \App\Models\Layout::all(); ?>
                @if(empty($layouts))
                  <option value="">No layouts listed</option>
                @else
                  @foreach($layouts as $area)
                    <option value="{{ $area->id }}" {{ isset($layout) && $layout->id == $area->id ? 'selected' : '' }}>
                      {{ ucwords($area->name) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="layout-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Client</label>
              <select class="form-control client" name="client">
                <option value="">Select client</option>
                <?php $clients = \App\Models\Client::all(); ?>
                @if(empty($clients->count()))
                  <option value="">No clients listed</option>
                @else
                  @foreach($clients as $client)
                    <option value="{{ $client->id }}">
                      {{ ucwords($client->fullname) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="client-error text-danger"></small>
            </div>
          </div>
          <div class="alert d-none apply-sib-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary apply-sib-button">
            <img src="/images/spinner.svg" class="me-2 d-none apply-sib-spinner mb-1">Continue
          </button>
        </div>
      </form>
    </div>
  </div>
</div>