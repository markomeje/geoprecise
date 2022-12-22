<div class="card border-0 shadow">
	<div class="card-body" style="background-image:url('/images/title-bg.jpg'); background-size: cover;">
		<div class="d-flex align-items-center justify-content-between border-bottom mb-3 pb-3">
			<a class="text-white cursor-pointer" href="{{ route('admin.plan.edit', ['id' => $plan->id]) }}">
				Plan Number ({{ ucwords($plan->plan_number) }})
			</a>
            <?php $plot_numbers = str_contains($plan->plot_numbers, '-') ? explode('-', $plan->plot_numbers) : $plan->plot_numbers; ?>
            <a href="{{ route('admin.plan.edit', ['id' => $plan->id]) }}" class="text-{{ empty($plot_numbers)  ? 'danger' : 'success' }}">
                {{ empty($plot_numbers) ? 'No Plots' : (is_array($plot_numbers) ? count($plot_numbers).' Plots' : 'One Plot' ) }}
            </a>
		</div>
		<div class="d-flex align-items-center justify-content-between">
            <div class="text-white">
                <em>For</em> {{ \Str::limit(ucwords($plan->client_name), 20) }}
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