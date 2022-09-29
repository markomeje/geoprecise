<div class="card shadow-lg">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <div class="text-dark">NGN{{ number_format($payment->amount) }}</div>
      <div class="text-{{ $payment->status === 'paid' ? 'success' : 'danger' }}">
        {{ ucfirst($payment->status) }}
      </div>
    </div>
  </div>
  <div class="card-footer bg-dark">
    <?php $approved = true === (boolean)($payment->approved ?? 0); ?>
    <div class="d-flex align-items-center justify-content-between">
      <div class="text-{{ $approved ? 'success' : 'danger' }}">
        {{ $approved ? 'Approved' : 'Unapproved' }}
      </div>
      @if($approved)
        <div class="bg-success text-center small-circle rounded-circle text-white" style="">
          <div class="small-circle-icon">
            <i class="icofont-tick-mark"></i>
          </div>
        </div>
      @else
        <div class="bg-danger text-center small-circle rounded-circle text-white" style="">
          <div class="small-circle-icon">
            <i class="icofont-close"></i>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>