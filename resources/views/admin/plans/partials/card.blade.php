<div class="card border-0 shadow">
	<div class="card-body" style="background-image:url('/images/title-bg.jpg'); background-size: cover;">
		<div class="d-flex align-items-center justify-content-between">
			<div class="text-white cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-plan-{{ $plan->id }}">
				P{{ $plan->plan_number }}
			</div>
            <div class="text-white">{{ $plan->year }}</div>
		</div>	
	</div>
	<div class="card-footer d-flex align-items-center justify-content-between">
      <div>
        <small>{{ $plan->created_at->diffForHumans() }}</small>
      </div>
      <div class="d-flex align-items-center">
        <small class="text-primary cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-plan-{{ $plan->id }}">
          <i class="icofont-edit"></i>
        </small>
      </div>
    </div>
</div>