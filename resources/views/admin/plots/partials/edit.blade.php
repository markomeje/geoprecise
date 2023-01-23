<div class="modal fade" id="edit-plot-{{ $plot->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="plot">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Plot</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="edit-plot-form" action="javascript:;" method="post" data-action="{{ route('admin.plot.edit', ['id' => $plot->id]) }}">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Plot number</label>
              <input type="text" name="number" class="form-control number" placeholder="Enter plot number" value="{{ $plot->number }}">
              <small class="number-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Layout Name</label>
              <select class="form-control layout" name="layout">
                <option value="">Select layout</option>
                <?php $layouts = \App\Models\Layout::all(); ?>
                @if(empty($layouts))
                  <option value="">No layouts listed</option>
                @else
                  @foreach($layouts as $area)
                    <option value="{{ $area->id }}" {{ $area->id == $plot->layout_id ? 'selected' : '' }}>
                      {{ ucwords($area->name) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="layout-error text-danger"></small>
            </div>
          </div>
          <div class="row">
            
            <div class="form-group col-12">
              <label class="text-muted">Category</label>
              <select class="form-control category" name="category">
                <option value="">Select category</option>
                <?php $categories = \App\Models\Plot::CATEGORIES; ?>
                @if(empty($categories))
                  <option value="">No category listed</option>
                @else
                  @foreach($categories as $category)
                    <?php $slug = \Str::slug(strtolower($category)); ?>
                    <option value="{{ $slug }}" {{ $slug == $plot->category ? 'selected' : '' }}>
                      {{ ucwords($category) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="category-error text-danger"></small>
            </div>
          </div>
          <div class="alert d-none edit-plot-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary edit-plot-button">
            <img src="/images/spinner.svg" class="me-2 d-none edit-plot-spinner mb-1">Save
          </button>
        </div>
      </form>
    </div>
  </div>
</div>