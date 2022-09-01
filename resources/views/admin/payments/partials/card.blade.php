<?php $verified = true === (boolean)$payment->verified; ?>
<div class="card shadow-lg">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between pb-3">
      <div>
        NGN{{ number_format($payment->amount) }}
      </div>
      <div class="text-primary">
        {{ ucfirst($payment->status) }}
      </div>
    </div>
    <div class="d-flex align-items-center justify-content-between">
      @if($verified)
        <a class="btn btn-success w-100 veirfy-payment m-0" data-url="{{ $payment->id }}">
            Verified - Undo?
        </a>
      @else
        <a class="btn btn-danger w-100 veirfy-payment m-0" data-url="{{ $payment->id }}">
            Not verified - Verify
        </a>
      @endif
    </div>
  </div>
  <div class="card-footer bg-primary">
    <div class="d-flex align-items-center justify-content-between">
      <small class="text-white">
        {{ $payment->updated_at->diffForHumans() }}
      </small>
      @if(true === (boolean)$payment->verified)
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