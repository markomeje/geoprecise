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
                    <div class="form-group col-md-6">
                        <label class="text-muted">Plan Number</label>
                        <input class="form-control plan_number" type="text" name="plan_number" placeholder="Enter plan number">
                        <small class="plan_number-error text-danger"></small>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-muted">Year</label>
                        <input class="form-control year" type="number" name="year" placeholder="Enter year">
                        <small class="year-error text-danger"></small>
                    </div>
                </div>
                <div class="bg-light px-3 pt-4 pb-3 border mb-4">
                    <div class="alert alert-warning text-white">Please if plot in a Layout, select below else ignore.</div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label class="text-muted">Layout Name (Optional)</label>
                            <select class="form-control layout" name="layout">
                                <option value="">Select layout</option>
                                <?php $layouts = \App\Models\Layout::all(); ?>
                                @if(empty($layouts->count()))
                                <option value="">No layouts listed</option>
                                @else
                                @foreach($layouts as $area)
                                    @if($area->plots->count() > 0)
                                        <option value="{{ $area->id }}">
                                            {{ ucwords($area->name) }}
                                        </option>
                                    @endif
                                @endforeach
                                @endif
                            </select>
                            <small class="layout-error text-danger"></small>
                        </div>
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