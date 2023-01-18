<div class="card bg-white shadow-sm border-radius-lg">
  <?php $approved = (boolean)($sib->approved ?? false) === true; ?>
  <div class="card-body">
    <div class="d-flex align-items-center mb-3 pb-3 border-bottom justify-content-between">
        @if(empty($sib->plan))
            <a href="{{ route('admin.sib.edit', ['id' => $sib->id]) }}" class="text-dark">Nill</a>
        @else
            <a href="{{ route('admin.sib.edit', ['id' => $sib->id]) }}" class="text-dark">
                P{{ $sib->plan->plan_number}}/{{ $sib->plan->year}}
            </a>
        @endif
        <a href="{{ route('admin.sib.edit', ['id' => $sib->id]) }}" class="text-{{ $approved ? 'success' : 'danger' }}">
            {{ $approved ? 'Approved' : 'Unapproved' }}
        </a>
    </div>
    <div class="d-flex align-items-center justify-content-between">
      @if(empty($sib->payment))
        <div class="text-danger">Unpaid</div>
      @elseif($sib->payment->status !== 'paid')
        <div class="text-danger">Unpaid</div>
      @else
        <div>
          <span class="text-success">
            Paid
          </span>
          <span class="text-dark">
            (NGN{{ number_format($sib->payment->amount) }})
          </span>
        </div>
      @endif
      <?php $completed = true === (boolean)$sib->completed; ?>
      <a href="{{ route('admin.sib.edit', ['id' => $sib->id]) }}" class="text-{{ $completed ? 'success' : 'danger' }}">
        {{ $completed ? 'Completed' : 'Incomplete' }}
      </a>
    </div>
  </div>
  <div class="card-footer bg-dark d-flex align-items-center justify-content-between">
    <small class="text-white">
      {{ $sib->created_at->diffForHumans() }}
    </small>
    <div class="d-flex align-items-center">
      <a href="{{ route('admin.sib.edit', ['id' => $sib->id]) }}">
        <small class="text-white cursor-pointer me-2">
          <i class="icofont-edit"></i>
        </small>
      </a>
      <small class="text-danger delete-sib cursor-pointer" data-url="{{ route('admin.sib.delete', ['id' => $sib->id]) }}" data-message="Are you sure to delete?">
        <i class="icofont-trash"></i>
      </small>
    </div>
  </div>
</div>