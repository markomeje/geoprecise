<div class="modal fade" id="add-client-plot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="plot">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Plot Numbers</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="add-client-plot-form" action="javascript:;" method="post" data-action="{{ $route }}">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-12">
              <label class="text-muted">{{ $layout ? ucfirst($layout->name) : 'Nill' }} Plots</label>
              <select class="form-control plot_number filter-select" name="plot_number">
                <option value="">Select plot number</option>
                @if(empty($layout->plots->count()))
                  <option value="">No plots listed</option>
                @else
                  @foreach($layout->plots as $plot)
                    <option value="{{ $plot->number }}">
                      {{ $plot->number }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="plot_number-error text-danger"></small>
            </div>
          </div>
          <div class="alert d-none add-client-plot-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary w-100 add-client-plot-button">
            <img src="/images/spinner.svg" class="me-2 d-none add-client-plot-spinner mb-1">Add
          </button>
        </div>
      </form>
    </div>
  </div>
</div>