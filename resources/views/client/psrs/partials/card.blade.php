<div class="card bg-white shadow-sm border-radius-lg">
  <?php $approved = (boolean)($psr->approved ?? false) === true; ?>
  <div class="card-body">
    <div class="d-flex align-items-center mb-3 pb-3 border-bottom justify-content-between">
      <a href="{{ route('client.psr.edit', ['id' => $psr->id]) }}" class="text-{{ $approved ? 'success' : 'danger' }}">
          {{ $approved ? 'Approved' : 'Unapproved' }}
      </a>
      <a href="{{ route('client.psr.edit', ['id' => $psr->id]) }}" class="text-dark">
        ({{ ucfirst($psr->status) }})
      </a>
    </div>
    <div class="d-flex align-items-center justify-content-between">
      <a href="" class="text-dark">
        <?php $plot_numbers = $psr->plot_numbers; ?>
        {{ empty($plot_numbers) ? 0 : (str_contains($plot_numbers, '-') ? count(explode('-', $plot_numbers)) : 1) }} Plot(s)
      </a>
      <a href="{{ route('client.psr.edit', ['id' => $psr->id]) }}">
        @if(empty($psr->payment))
          <div class="text-danger">Not Payment</div>
        @elseif($psr->payment->status !== 'paid')
          <div class="text-danger">No Payment</div>
        @else
          <div class="text-success">Paid</div>
        @endif
      </a>
    </div>
  </div>
  <div class="card-footer bg-dark d-flex align-items-center justify-content-between">
    <small class="text-white">
      {{ $psr->created_at->diffForHumans() }}
    </small>
    <div class="d-flex align-items-center">
      <a href="{{ route('client.psr.edit', ['id' => $psr->id]) }}">
        <small class="text-white cursor-pointer">
          <i class="icofont-edit"></i>
        </small>
      </a>
      {{-- <small class="text-danger delete-psr cursor-pointer" data-url="{{ route('client.psr.delete', ['id' => $psr->id]) }}" data-message="Are you sure to delete?">
        <i class="icofont-trash"></i>
      </small> --}}
    </div>
  </div>
</div>