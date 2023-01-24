<div class="modal fade" id="add-plot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="plot">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Plot</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="add-plot-form" action="javascript:;" method="post" data-action="{{ route('admin.plot.add') }}">
          @csrf
        <div class="modal-body">
            <div class="alert alert-info mb-4 text-white">Enter minimum and maximum number of plot to generate</div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-muted">Minimum Plot number</label>
              <input type="number" name="minimum_plot_number" class="form-control minimum_plot_number" placeholder="Enter min plot number">
              <small class="minimum_plot_number-error text-danger"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Maximum Plot number</label>
              <input type="number" name="maximum_plot_number" class="form-control maximum_plot_number" placeholder="Enter max plot number">
              <small class="maximum_plot_number-error text-danger"></small>
            </div>
          </div>
          <div class="row">
          <div class="form-group col-md-6">
              <label class="text-muted">Category</label>
              <select class="form-control category" name="category">
                <option value="">Select category</option>
                <?php $categories = \App\Models\Plot::CATEGORIES; ?>
                @if(empty($categories))
                  <option value="">No category listed</option>
                @else
                  @foreach($categories as $category => $prefix)
                    <option value="{{ $category }}">
                      {{ ucwords($category) }} {{ empty($prefix) ? '' : '('.$prefix.')' }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="category-error text-danger"></small>
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
                    <option value="{{ $area->id }}" {{ !empty($layout->id)  && $layout->id == $area->id ? 'selected' : '' }}>
                      {{ ucwords($area->name) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="layout-error text-danger"></small>
            </div>
          </div>
          <div class="alert d-none add-plot-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary add-plot-button">
            <img src="/images/spinner.svg" class="me-2 d-none add-plot-spinner mb-1">Add
          </button>
        </div>
      </form>
    </div>
  </div>
</div>