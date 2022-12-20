<div class="modal fade" id="apply-sib" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="plot">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apply for Site Inspection</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="apply-sib-form" action="javascript:;" method="post" data-action="{{ route('client.sib.apply') }}">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-12">
                <?php $surveys = auth()->user()->client->surveys->where(['approved' => true]); ?>
                @if(empty($surveys->count()))
                    <div class="alert alert-info m-0">You Have No Surveys Yet.</div>
                @else
                    <label class="text-muted">Select Survey</label>
                    <select class="form-control survey" name="survey">
                        <option value="">Select Survey</option>
                        @foreach($surveys as $survey)
                            <option value="{{ $survey->id }}">
                                {{ $survey->plot_numbers }}
                            </option>
                        @endforeach
                    </select>
                    <small class="survey-error text-danger"></small>
                @endif
            </div>
          </div>
          <div class="alert d-none apply-sib-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary w-100 apply-sib-button">
            <img src="/images/spinner.svg" class="me-2 d-none apply-sib-spinner mb-1">Continue
          </button>
        </div>
      </form>
    </div>
  </div>
</div>