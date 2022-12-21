<div class="card border-0 shadow">
	<div class="card-body" style="background-image:url('/images/title-bg.jpg'); background-size: cover;">
		<div class="d-flex align-items-center justify-content-between border-bottom mb-3 pb-3">
			<div class="text-white cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-plan-{{ $plan->id }}">
				Plan Number ({{ ucwords($plan->plan_number) }})
			</div>
            <?php $plot_numbers = str_contains($plan->plot_numbers, '-') ? explode('-', $plan->plot_numbers) : $plan->plot_numbers; ?>
			@if(empty($plot_numbers))
				<a href="javascript:;" class="text-white">No Plot(s)</a>
			@else
				<a href="javascript:;" class="text-white">
					{{ is_array($plot_numbers) ? count($plot_numbers).' Plots' : 'One Plot' }}
				</a>
			@endif
		</div>
		<div class="d-flex align-items-center justify-content-between">
			<div class="text-white">
				{{ empty($plan->layout) ? 'Nill' :  \Str::limit(ucwords($plan->layout->name), 18) }}
			</div>
            <div class="text-white">
                {{ \Str::limit(ucwords($plan->client_name), 18) }}
            </div>
		</div>	
	</div>
	<div class="card-footer d-flex align-items-center justify-content-between">
      <div>
        <small>{{ $plan->created_at->diffForHumans() }}</small>
      </div>
      <div class="d-flex align-items-center">
        <small class="text-primary cursor-pointer me-2" data-bs-toggle="modal" data-bs-target="#edit-plan-{{ $plan->id }}">
          <i class="icofont-edit"></i>
        </small>
        <small class="text-danger cursor-pointer">
          <i class="icofont-trash"></i>
        </small>
      </div>
    </div>
</div>