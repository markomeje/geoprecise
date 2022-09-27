<div class="card border-0 shadow">
	<div class="card-body" style="background-image: url('/images/title-bg.jpg'); background-size: cover;">
		<div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
			<div class="text-white" data-bs-toggle="modal" data-bs-target="#edit-pcf-{{ $pcf->id }}">
				Plan No({{ ucwords($pcf->plan_number) }})
			</div>
			@if($issued)
				<a href="{{ route('admin.clients.profile', ['id' => $pcf->client->id]) }}" class="text-white">
					Collected by ({{ \Str::limit(ucwords($pcf->plan_title), 8) }})
				</a>
			@else
			 <div class="text-danger">Not Collected</div>
			@endif
		</div>
		<div class="d-flex align-items-center justify-content-between">
			@if($issued)
				<a href="{{ route('admin.staff.profile', ['id' => $pcf->issuer->staff->id]) }}" class="text-white">
					Issued by ({{ \Str::limit(ucwords($pcf->issuer->staff->fullname), 10) }})
				</a>
			@else
				<a href="javascript:;" class="text-white issue-plan" data-url="{{ route('admin.pcf.issue', ['id' => $pcf->id]) }}" data-message="Are you sure to proceed"><img src="/images/spinner.svg" class="me-2 d-none issue-plan-spinner mb-1">Issue Now?</a>
			@endif
			<div class="text-white">
				<a href="{{ route('admin.staff.profile', ['id' => $pcf->recorder->staff->id]) }}" class="text-white">
					Recorded by ({{ \Str::limit(ucwords($pcf->recorder->staff->fullname), 10) }})
				</a>
			</div>
		</div>	
	</div>
	<div class="card-footer d-flex align-items-center justify-content-between">
      <div>
        <small>{{ $pcf->created_at->diffForHumans() }}</small>
      </div>
      <div class="d-flex align-items-center">
        <small class="text-primary cursor-pointer me-2" data-bs-toggle="modal" data-bs-target="#edit-pcf-{{ $pcf->id }}">
          <i class="icofont-edit"></i>
        </small>
        <small class="text-danger cursor-pointer">
          <i class="icofont-trash"></i>
        </small>
      </div>
    </div>
</div>