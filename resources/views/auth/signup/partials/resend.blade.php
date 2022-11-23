<div class="modal fade" id="resend-verification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="plot">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resend Verification Email</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="resend-verification-form" action="javascript:;" method="post" data-action="{{ route('email.verification.resend') }}">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-12">
              <label class="text-muted">Email</label>
              <input type="email" name="email" class="form-control email" placeholder="Enter your email">
              <small class="email-error text-danger"></small>
            </div>
          </div>
          <div class="alert d-none resend-verification-message mb-2 text-white"></div>
        </div>
        <div class="px-3 border-top pt-4 pb-0">
          <button type="submit" class="btn w-100 btn-primary resend-verification-button">
            <img src="/images/spinner.svg" class="me-2 d-none resend-verification-spinner mb-1">Resend
          </button>
        </div>
      </form>
    </div>
  </div>
</div>