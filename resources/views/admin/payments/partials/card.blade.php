<?php $approved = true === (boolean)$payment->approved; ?>
<div class="card shadow-lg">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
      <div>
        NGN{{ number_format($payment->amount) }}
      </div>
      <div class="text-success">
        By <a href="{{ route('admin.clients.profile', ['id' => $payment->client->id]) }}">{{ \Str::limit(ucwords($payment->client->fullname), 8) }}</a>
      </div>
    </div>
    <div class="d-flex align-items-center justify-content-between">
      <div class="text-dark">
        {{ $approved ? 'Approved' : 'Unapproved' }}
      </div>
      <div class="text-dark">
        {{ ucwords(empty($payment->type) ? 'Card' : $payment->type) }}
      </div>
    </div>
  </div>
  <div class="card-footer bg-primary">
    <div class="d-flex align-items-center justify-content-between">
      <small class="text-white">
        {{ $payment->updated_at->diffForHumans() }}
      </small>
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