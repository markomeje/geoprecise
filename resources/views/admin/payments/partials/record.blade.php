<div class="modal fade" id="admin-record-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="plot">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Record payment</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
      </div>
      <form class="admin-record-payment-form" action="javascript:;" method="post" data-action="{{ route('admin.payment.record', ['model_id' => $model_id, 'model' => $model, 'reference' => $payment->reference ?? '', 'client_id' => $client_id]) }}">
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-12">
              <label class="text-muted">Total Amount</label>
              <select class="form-control amount" name="amount">
                <option value="{{ $total_amount }}">
                  NGN{{ number_format($total_amount) }}
                </option>
              </select>
              <small class="amount-error text-danger"></small>
            </div>
            <div class="form-group col-12">
              <label class="text-muted">Payment type</label>
              <?php $types = \App\Models\Payment::$types; ?>
              <select class="form-control type" name="type">
                <option value="">Select type</option>
                @if(empty($types))
                  <option value="">No types listed</option>
                @else
                  @foreach($types as $type)
                    <option value="{{ $type }}" {{ ($payment->type ?? '') === $type ? 'selected' : '' }}>
                      {{ ucfirst($type) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="type-error text-danger"></small>
            </div>
          </div>
          <div class="alert d-none admin-record-payment-message mb-2 text-white"></div>
        </div>
        <div class="modal-footer pb-0">
          <button type="submit" class="btn btn-primary w-100 admin-record-payment-button">
            <img src="/images/spinner.svg" class="me-2 d-none admin-record-payment-spinner mb-1">Save
          </button>
        </div>
      </form>
    </div>
  </div>
</div>