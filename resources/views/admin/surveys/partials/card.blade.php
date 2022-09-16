<div class="card shadow border-0">
	<div class="card-body" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
    url('/argon/images/3.jpg'); object-fit: cover;">
		<div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
			<a href="{{ route('admin.survey.edit', ['id' => $survey->id]) }}" class="text-white">
				{{ (boolean)($survey->approved) === true ? 'Approved' : 'Unapproved' }} <i class="icofont-long-arrow-right"></i>
			</a>
			@if(empty($survey->payment))
				<small class="text-danger">Unpaid</small>
			@elseif($survey->payment->status !== 'paid')
				<small class="text-danger">Unpaid</small>
			@else
				<small class="text-success">Paid</small>
			@endif
		</div>
		<div class="d-flex justify-content-between align-items-center">
			<?php $plot_numbers = str_contains($survey->plot_numbers, '-') ? explode('-', $survey->plot_numbers) : $survey->plot_numbers; ?>
			@if(empty($plot_numbers))
				<a href="{{ route('admin.survey.edit', ['id' => $survey->id]) }}" class="text-white">No Plot(s)</a>
			@else
				<a href="javascript:;" class="text-white">
					{{ is_array($plot_numbers) ? count($plot_numbers).' Plots' : 'One Plot' }}
				</a>
			@endif
			<a href="{{ route('admin.clients.profile', ['id' => $survey->client_id]) }}" class="text-white">
				Client ({{ ucfirst($survey->client ? \Str::limit($survey->client->fullname, 12) : 'Nill') }})
			</a>
		</div>
	</div>
	<div class="card-footer bg-primary d-flex justify-content-between">
		<small class="text-white">
			{{ $survey->created_at->diffForHumans() }}
		</small>
		<div class="d-flex align-items-center">
			<a href="{{ route('admin.survey.edit', ['id' => $survey->id]) }}" class="text-white cursor-pointer me-2">
				<i class="icofont-edit"></i>
			</a>
			<small class="text-danger cursor-pointer">
				<i class="icofont-trash"></i>
			</small>
		</div>
	</div>
</div>