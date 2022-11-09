<div class="modal fade" id="edit-layout-{{ $layout->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="layout">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Layout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="edit-layout-form" action="javascript:;" method="post" data-action="{{ route('admin.layout.edit', ['id' => $layout->id]) }}">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Layout Name</label>
              <input type="text" name="name" class="form-control name" placeholder="Enter layout name" value="{{ $layout->name }}">
              <small class="name-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <?php $status = \App\Models\Layout::$status; ?>
              <label class="text-muted">Layout Status</label>
              <select class="form-control status" name="status">
                <option>Select Status</option>
                @if(!empty($status))
                  @foreach($status as $key => $value)
                    <option value="{{ (boolean)$value }}" {{ $value === (boolean)$layout->active ? 'selected' : '' }}>
                      {{ ucwords($key) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="status-error text-danger"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="text-muted">Address</label>
              <textarea class="form-control address" name="address" rows="4" placeholder="Layout address">{{ $layout->address }}</textarea>
              <small class="address-error text-danger"></small>
            </div>
          </div>
        <div class="alert d-none edit-layout-message m-0 text-white"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-dark text-white me-3" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary edit-layout-button">
            <img src="/images/spinner.svg" class="me-2 d-none edit-layout-spinner mb-1">Save
          </button>
        </div>
      </form>
    </div>
  </div>
</div>