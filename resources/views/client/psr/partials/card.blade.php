<?php $plots = $psr->plots; $plot = str_contains($plots, '-') ? explode('-', $plots)[0] : $plots ?>
<div class="card bg-white border-radius-lg">
  <div class="card-body">
    <div class="d-flex align-items-center mb-3 justify-content-between">
      <div class="text-dark">
        {{ $plot }} <i class="icofont-caret-down"></i>
      </div>
      <div class="text-muted">
        {{ ucfirst($psr->status) }}
      </div>
    </div>
    <div class="">
      @if($psr->payment)
        <button class="btn btn-success w-100 m-0">Paid NGN{{ number_format($psr->payment->amount) }}</button>
      @elseif($psr->form)
        <div class="make-payment-{{ $psr->id }}" data-url="{{ route('payment.process', ['form_id' => $psr->form->id, 'type' => 'form', 'model_id' => $psr->id, 'model' => 'psr']) }}" data-message="Are you sure to preceed with payment now?">
          <button class="btn btn-info w-100 m-0 make-payment-button-{{ $psr->id }}">
            <img src="/images/spinner.svg" class="me-2 d-none make-payment-spinner-{{ $psr->id }} mb-1">
            Pay NGN{{ number_format($psr->form->amount) }}
          </button>
        </div>
      @else
        <div class="" data-url="{{ '' }}">
          <button class="btn btn-info w-100 m-0">
            <img src="/images/spinner.svg" class="me-2 d-none mb-1">
            Nill
          </button>
        </div>
      @endif
    </div>
  </div>
  <div class="card-footer bg-primary">
    <div class="">
      <small class="text-white">
        {{ $psr->created_at->diffForHumans() }}
      </small>
    </div>
  </div>
</div>