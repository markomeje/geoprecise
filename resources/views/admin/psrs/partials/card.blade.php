<?php $plot_numbers = $psr->plot_numbers; $numbers = empty($plot_numbers) ? 'No plot(s)' : (str_contains($plot_numbers, '-') ? explode('-', $plot_numbers) : $plot_numbers); ?>
<div class="card bg-white shadow-sm border-radius-lg">
  <div class="card-body">
    <div class="d-flex align-items-center mb-3 justify-content-between">
      <a href="{{ route('admin.psr.edit', ['id' => $psr->id]) }}" class="text-dark text-underline">
        {{ is_array($numbers) ? $numbers[0].' +('.count($numbers).')' : $numbers }}
      </a>
      <a href="{{ route('admin.psr.edit', ['id' => $psr->id]) }}" class="text-dark">Status ({{ ucfirst($psr->status) }})</a>
    </div>
    <div class="">
      {{-- @if($psr->payment)
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
      @endif --}}
    </div>
  </div>
  <div class="card-footer bg-primary d-flex align-items-center justify-content-between">
    <small class="text-white">
      {{ $psr->created_at->diffForHumans() }}
    </small>
    <div class="d-flex align-items-center">
      <a href="{{ route('admin.psr.edit', ['id' => $psr->id]) }}">
        <small class="text-white cursor-pointer me-2">
          <i class="icofont-edit"></i>
        </small>
      </a>
      <small class="text-danger cursor-pointer">
        <i class="icofont-trash"></i>
      </small>
    </div>
  </div>
</div>