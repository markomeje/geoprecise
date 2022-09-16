<div class="card shadow border-0">
	<div class="card-body d-flex align-items-center" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
    url('/argon/images/3.jpg'); object-fit: cover;">
    	<div class="me-3">
    		<div class="rounded-circle bg-dark text-center" style="height: 60px; width: 60px; line-height: 60px !important;">
    			<i class="icofont-user"></i>
    		</div>
    	</div>
		<div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom border-dark">
			<a href="{{ route('admin.staff.profile', ['id' => $staff->id]) }}" class="text-white">
				{{ (boolean)($staff->approved) === true ? 'Approved' : 'Unapproved' }} <i class="icofont-long-arrow-right"></i>
			</a>
			@if(empty($staff->payment))
				<small class="text-danger">Unpaid</small>
			@elseif($staff->payment->status !== 'paid')
				<small class="text-danger">Unpaid</small>
			@else
				<small class="text-success">Paid</small>
			@endif
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