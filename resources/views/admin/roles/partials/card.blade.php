<div class="card border-0">
	<div class="card-body d-flex justify-content-between align-items-center">
		<a href="{{ route('admin.role', ['id' => $role->id]) }}">
			{{ ucwords($role->name) }}
		</a>
		<div class="rounded-circle bg-{{ $role->permissions->count() > 0 ? 'success' : 'danger' }} text-center" style="height: 24px; width: 24px; line-height: 24px;">
			<small class="text-white">
				{{ $role->permissions->count() }}
			</small>
		</div>
	</div>
	<div class="card-footer bg-primary">
		<small class="text-white">
			{{ $role->created_at->diffForHumans() }}
		</small>
	</div>
</div>