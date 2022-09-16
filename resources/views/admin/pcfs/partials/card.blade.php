<div class="card border-0 shadow">
	<div class="card-body" style="background-image: url('/images/title-bg.jpg'); background-size: cover;">
		<div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
			<div class="text-white" data-bs-toggle="modal" data-bs-target="#edit-pcf-{{ $pcf->id }}">
				Plan No({{ ucwords($pcf->plan_number) }})
			</div>
			<a href="{{ route('admin.clients.profile', ['id' => $pcf->client->id]) }}" class="text-white">
				Collected by ({{ \Str::limit(ucwords($pcf->plan_title), 8) }})
			</a>
		</div>
		<div class="d-flex align-items-center justify-content-between">
			<a href="{{ route('admin.staff.profile', ['id' => $pcf->staff->id]) }}" class="text-white">
				Issued by ({{ \Str::limit(ucwords($pcf->staff->fullname), 10) }})
			</a>
			<div class="text-white">
				{{ ucfirst($pcf->status) }}
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