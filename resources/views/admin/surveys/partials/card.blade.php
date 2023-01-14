<div class="card shadow border-0">
	<div class="card-body" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
    url('/argon/images/3.jpg'); object-fit: cover;">
        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                <a href="{{ route('admin.survey', ['id' => $survey->id]) }}" class="text-white">
                    By {{ \Str::limit($survey->client_name, 12) }}
                </a>
                <a href="{{ route('admin.survey', ['id' => $survey->id]) }}" class="text-white">
                    ({{ empty($survey->documents) ? 0 : $survey->documents->count() }}) Documents
                </a>
            </div>
		<div class="d-flex justify-content-between align-items-center">
			<a href="{{ route('admin.survey', ['id' => $survey->id]) }}" class="text-{{ (boolean)($survey->approved) === true ? 'success' : 'danger' }}">
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
	</div>
	<div class="card-footer bg-primary d-flex justify-content-between">
		<small class="text-white">
			{{ $survey->created_at->diffForHumans() }}
		</small>
		<div class="d-flex align-items-center">
			<a href="{{ route('admin.survey', ['id' => $survey->id]) }}" class="text-warning cursor-pointer">
				<i class="icofont-edit"></i>
			</a>
		</div>
	</div>
</div>