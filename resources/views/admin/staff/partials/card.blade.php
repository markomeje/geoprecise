<div class="card shadow border-0">
	<div class="card-body d-flex align-items-center" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
    url('/argon/images/3.jpg'); object-fit: cover;">
    	<div class="me-3">
    		<div class="rounded-circle position-relative bg-dark text-center d-flex justify-content-center" style="height: 60px; width: 60px; line-height: 60px !important;">
    			<div class="text-primary position-relative" style="top: 20px;">
    				<i class="icofont-user"></i>
    			</div>
    		</div>
    	</div>
    	<div class="w-100">
    		<div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-dark border-bottom w-100">
				<a href="{{ route('admin.staff.profile', ['id' => $staff->id]) }}" class="text-white">
					{{ \Str::limit(ucwords($staff->fullname), 12) }}
				</a>
				<small class="text-{{ $staff->status === 'active' ? 'success' : 'danger' }}">
					{{ ucwords($staff->status) }}
				</small>
			</div>
			<div class="d-flex justify-content-between">
				<div class="text-white">
					{{ strtoupper($staff->code ?? 'Nill') }}
				</div>
	            <div class="text-white">
	            	{{ \Str::limit(ucwords($staff->address), 12) }}
	            </div>
	        </div>
    	</div>
	</div>
	<div class="card-footer bg-primary d-flex justify-content-between">
		<small class="text-white">
			{{ $staff->created_at->diffForHumans() }}
		</small>
		<div class="d-flex align-items-center">
			<a href="{{ route('admin.staff.profile', ['id' => $staff->id]) }}" class="text-white cursor-pointer me-2">
				<i class="icofont-edit"></i>
			</a>
			<small class="text-danger cursor-pointer">
				<i class="icofont-trash"></i>
			</small>
		</div>
	</div>
</div>