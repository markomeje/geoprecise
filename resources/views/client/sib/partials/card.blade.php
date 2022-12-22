<div class="card shadow border-0">
	<div class="card-body" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
    url('/argon/images/3.jpg'); object-fit: cover;">
		<div class="d-flex justify-content-between align-items-center">
			<?php $plan = $sib->plan; $plot_numbers = str_contains($plan->plot_numbers, '-') ? explode('-', $plan->plot_numbers) : $plan->plot_numbers; ?>
			@if(empty($plot_numbers))
				<a href="{{ route('client.sib.edit', ['id' => $sib->id]) }}" class="text-white">No Plot(s)</a>
			@else
				<a href="{{ route('client.sib.edit', ['id' => $sib->id]) }}" class="text-white">
					{{ is_array($plot_numbers) ? count($plot_numbers).' Plots' : 'One Plot' }}
				</a>
			@endif
			<?php $paid = empty($sib->payment) ? false  : ('paid' === strtolower($sib->payment->status)); ?>
			<a href="{{ route('client.sib.edit', ['id' => $sib->id]) }}" class="text-{{ $paid ? 'success' : 'danger' }}">
				{{ $paid ? 'Paid' : 'Not paid' }}
			</a>
		</div>
	</div>
	<div class="card-footer bg-primary">
		<small class="text-white">
			{{ $sib->created_at->diffForHumans() }}
		</small>
	</div>
</div>