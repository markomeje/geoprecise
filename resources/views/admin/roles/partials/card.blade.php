<div class="card border-0">
	<div class="card-body">
		<a href="{{ route('admin.role', ['id' => $role->id]) }}">
			{{ ucwords($role->name) }}
		</a>
	</div>
	<div class="card-footer bg-primary">
		<small class="text-white">
			{{ $role->created_at->diffForHumans() }}
		</small>
	</div>
</div>