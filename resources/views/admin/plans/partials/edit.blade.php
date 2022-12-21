<div class="modal fade" id="edit-plan-{{ $plan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="plan">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Plan Info</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="edit-plan-form" action="javascript:;" method="post" data-action="{{ route('admin.plan.add') }}">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Client Name</label>
              <input type="text" name="client_name" class="form-control client_name" placeholder="Enter client name" value="{{ $plan->client_name }}">
              <small class="client_name-error text-danger"></small>
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
                    <option value="{{ $area->id }}" {{ $area->id == $plan->layout_id ? 'selected' : '' }}>
                      {{ ucwords($area->name) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="layout-error text-danger"></small>
            </div>
          </div>
          <div class="row">
            {{-- <div class="form-group col-md-6">
              <label class="text-muted">plan Numbers</label>
              <select class="form-control plan_numbers filter-select" multiple name="plan_numbers">
                <option value="">Select layout</option>
                <?php $plans = \App\Models\plan::all(); ?>
                @if(empty($plans->count()))
                  <option value="">No plans listed</option>
                @else
                  @foreach($plans as $plan)
                    <option value="{{ $plan->id }}">
                      {{ ucwords($plan->number) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="plan_numbers-error text-danger"></small>
            </div> --}}
            <div class="form-group col-md-6">
              <label class="text-muted">Plan Number</label>
              <input type="text" name="plan_number" class="form-control plan_number" placeholder="Enter plan numbers" value="{{ $plan->plan_number }}">
              <small class="plan_number-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Phone Number</label>
              <input type="text" name="phone" class="form-control phone" placeholder="Enter phone number" value="{{ $plan->phone }}">
              <small class="phone-error text-danger"></small>
            </div>
          </div>
          <div class="form-group mb-3">
            <label class="text-muted">Address</label>
            <textarea class="form-control address" name="address" placeholder="Enter address">{{ $plan->address }}</textarea>
            <small class="address-error text-danger"></small>
          </div>
          <div class="alert d-none edit-plan-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary edit-plan-button">
            <img src="/images/spinner.svg" class="me-2 d-none edit-plan-spinner mb-1">Add
          </button>
        </div>
      </form>
    </div>
  </div>
</div>