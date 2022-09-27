<div class="card bg-white shadow-sm border-radius-lg">
  <?php $approved = (boolean)($psr->approved ?? false) === true; ?>
  <div class="card-body">
    <div class="d-flex align-items-center mb-3 pb-3 border-bottom justify-content-between">
      <a href="{{ route('admin.psr.edit', ['id' => $psr->id]) }}" class="text-{{ $approved ? 'success' : 'danger' }}">
          {{ $approved ? 'Approved' : 'Unapproved' }}
      </a>
      <a href="{{ route('admin.psr.edit', ['id' => $psr->id]) }}" class="text-dark">
        {{ ucfirst($psr->status) }}
      </a>
    </div>
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('admin.clients.profile', ['id' => $psr->client_id]) }}" class="text-dark">
        {{ empty($psr->client) ? 'Nill' : 'By '.\Str::limit(ucwords($psr->client->fullname), 12) }}
      </a>
      @if(empty($psr->payment))
        <div class="text-danger">Unpaid</div>
      @elseif($psr->payment->status !== 'paid')
        <div class="text-danger">Unpaid</div>
      @else
        <div class="text-success">Paid</div>
      @endif
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