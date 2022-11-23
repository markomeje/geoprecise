<div class="card shadow border-0">
	<div class="card-body" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
    url('/argon/images/3.jpg'); object-fit: cover;">
    	<?php $approved = true === ((boolean)$survey->approved ?? 0); $paid = 'paid' === ($survey->payment->status ?? null); ?>
		<div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
			<?php $plot_numbers = str_contains($survey->plot_numbers, '-') ? explode('-', $survey->plot_numbers) : $survey->plot_numbers; ?>
			@if(empty($plot_numbers))
				<a href="{{ route('client.survey.edit', ['id' => $survey->id]) }}" class="text-white">No Plot(s)</a>
			@else
				<a href="javascript:;" class="text-white">
					{{ is_array($plot_numbers) ? count($plot_numbers).' Plots' : 'One Plot' }}
				</a>
			@endif
			<a href="{{ route('client.survey.edit', ['id' => $survey->id]) }}" class="text-{{ $paid ? 'success' : 'danger' }}">
				{{ $paid ? 'Paid' : 'Not Paid' }}
			</a>
		</div>
		<div class="d-flex justify-content-between align-items-center">
			<a href="{{ route('client.survey.edit', ['id' => $survey->id]) }}" class="text-{{ $approved ? 'success' : 'danger' }}">
				{{ $approved ? 'Approved' : 'Unapproved' }}
			</a>
			<div class="text-white">
				{{ ucfirst($survey->status ?? 'Incomplete') }}
			</div>
		</div>
	</div>
	<div class="card-footer bg-primary d-flex justify-content-between">
		<small class="text-white">
			{{ $survey->created_at->diffForHumans() }}
		</small>
		<a href="{{ route('client.survey.edit', ['id' => $survey->id]) }}">
	        <small class="text-white cursor-pointer">
	          <i class="icofont-edit"></i>
	        </small>
	      </a>
	</div>
</div>