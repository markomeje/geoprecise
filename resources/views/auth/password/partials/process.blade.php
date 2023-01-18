<div class="modal fade" id="process-reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="plot">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Password Reset</h5>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                <i class="icofont-close"></i>
                </button>
            </div>
            <form class="process-reset-form" action="javascript:;" method="post" data-action="{{ route('reset.process') }}">
                @csrf
                <div class="modal-body">
                <div class="alert alert-primary text-white" role="alert">A reset code will be sent to your phone number</div>
                <div class="row">
                    <div class="form-group col-12">
                        <label class="text-muted">Phone Number</label>
                        <input class="form-control phone_number" type="text" name="phone_number" placeholder="Enter phone number">
                        <small class="phone_number-error text-danger"></small>
                    </div>
                </div>
                <div class="alert d-none process-reset-message mb-2 text-white"></div>
                </div>
                <div class="modal-footer pb-0">
                <button type="submit" class="btn btn-primary w-100 process-reset-button">
                    <img src="/images/spinner.svg" class="me-2 d-none process-reset-spinner mb-1">Continue
                </button>
                </div>
            </form>
        </div>
    </div>
</div>