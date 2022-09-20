<div class="card bg-white shadow-sm border-radius-lg">
  <div class="card-body">
    <div class="d-flex align-items-center mb-3 pb-3 border-bottom justify-content-between">
      <a href="{{ route('admin.psr.edit', ['id' => $psr->id]) }}" class="text-dark">
        <small>
          Psr({{ (boolean)($psr->approved ?? false) === true ? 'Approved' : 'Unapproved' }})
        </small>
      </a>
      <a href="{{ route('admin.psr.edit', ['id' => $psr->id]) }}" class="text-dark">
        <small>{{ ucfirst($psr->status) }}</small>
      </a>
    </div>
    <div class="d-flex align-items-center justify-content-between">
      @if(empty($psr->payment))
        <small class="text-danger">Unpaid</small>
      @elseif($psr->payment->status !== 'paid')
        <small class="text-danger">Unpaid</small>
      @else
        <small class="text-success">Paid</small>
      @endif
      <small class="text-dark">
        {{ empty($psr->layout) ? 'Nill' : \Str::limit(ucwords($psr->layout->name), 12) }}
      </small>
    </div>
  </div>
  <div class="card-footer bg-dark d-flex align-items-center justify-content-between">
    <small class="text-white">
      {{ $psr->created_at->diffForHumans() }}
    </small>
    <div class="d-flex align-items-center">
      <a href="{{ route('admin.psr.edit', ['id' => $psr->id]) }}">
        <small class="text-white cursor-pointer me-2">
          <i class="icofont-edit"></i>
        </small>
      </a>
      <small class="text-danger delete-psr cursor-pointer" data-url="{{ route('admin.psr.delete', ['id' => $psr->id]) }}" data-message="Are you sure to delete?">
        <i class="icofont-trash"></i>
      </small>
    </div>
  </div>
</div>