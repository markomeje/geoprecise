<div class="card shadow border-0">
	<div class="card-body" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
    url('/argon/images/3.jpg'); object-fit: cover;">
    <div class="d-flex justify-content-between align-items-center border-bottom mb-3 pb-3">
			<a href="{{ route('client.reprinting.edit', ['id' => $reprint->id]) }}" class="text-white">
				Plan Number ({{ $reprint->plot_number }})
			</a>
			<div class="text-white">
				{{ $reprint->total_copies }} {{ $reprint->total_copies > 1 ? 'Copies' : 'Copy' }}
			</div>
		</div>
    	<?php $approved = true === ((boolean)$reprint->approved ?? 0); $paid = 'paid' === ($reprint->payment->status ?? null); ?>
		<div class="d-flex justify-content-between align-items-center">
			<a href="{{ route('client.reprinting.edit', ['id' => $reprint->id]) }}" class="text-{{ $approved ? 'success' : 'danger' }}">
				{{ $approved ? 'Approved' : 'Unapproved' }}
			</a>
			<div class="text-white">
				{{ empty($reprint->payment) ? 'Not Paid' : ucfirst($reprint->payment->status) }}
			</div>
		</div>
	</div>
	<div class="card-footer bg-primary d-flex justify-content-between">
		<small class="text-white">
			{{ $reprint->created_at->diffForHumans() }}
		</small>
		<a href="{{ route('client.reprinting.edit', ['id' => $reprint->id]) }}">
	        <small class="text-white cursor-pointer">
	          <i class="icofont-edit"></i>
	        </small>
	      </a>
	</div>
</div>