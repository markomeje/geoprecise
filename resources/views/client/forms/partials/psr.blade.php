<form class="psr-form" method="post" action="javascript:;" data-action="{{ route('client.psr.save') }}">
	@csrf
	<div class="row">
		<div class="form-group input-group-lg col-md-6">
			<label class="text-muted">Status</label>
			<?php $statuses = \App\Models\Psr::STATUS; ?>
			<select name="status" class="form-control status">
				<option value="">Select layout</option>
				@if(empty($statuses))
					<option value="">Nill</option>
				@else
					@foreach($statuses as $status)
						<option value="{{ $status }}">
							{{ $status }}
						</option>
					@endforeach
				@endif
			</select>
			<small class="status-error text-danger"></small>
		</div>
		<div class="form-group input-group-lg col-md-6">
			<label class="text-muted">Layout</label>
			<?php $layouts = \App\Models\Layout::all(); ?>
			<select name="layout" class="form-control layout">
				<option value="">Select layout</option>
				@if(empty($layouts))
					<option value="">Nill</option>
				@else
					@foreach($layouts as $layout)
						<option value="{{ $layout->id }}">
							{{ $layout->name }}
						</option>
					@endforeach
				@endif
			</select>
			<small class="layout-error text-danger"></small>
		</div>
	</div>
	<div class="row">
		<div class="form-group input-group-lg col-md-6 mb-4">
			<label class="text-muted">Seller's Name</label>
			<input type="text" class="form-control soldby" name="soldby" rows="2" placeholder="Enter seller name">
			<small class="soldby-error text-danger"></small>
		</div>
		<div class="form-group input-group-lg col-md-6 mb-4">
			<label class="text-muted">Additional info (Optional)</label>
			<input type="text" class="form-control description" name="description" rows="4" placeholder="Enter any additional info">
			<small class="description-error text-danger"></small>
		</div>
	</div>
	<div class="mb-4">
		<label class="text-muted">Plot Number(s)</label>
		<div class="p-4 bg-light border-radius-lg border">
			<?php $plots = \App\Models\Plot::all(); ?>
			<select name="plots[]" class="form-control select-multiple plots"  multiple="multiple" placeholder="">
				@if(empty($plots))
					<option value="">No plots listed</option>
				@else
					<option value="">Select plot number(s)</option>
					@foreach($plots as $plot)
						<option value="{{ $plot->number }}">
							{{ $plot->name.' ('.$plot->number.')' }}
						</option>
					@endforeach
				@endif
			</select>
			<small class="plots-error text-danger"></small>
		</div>
	</div>
	<div class="alert d-none psr-message mb-4 text-white"></div>
	<button type="submit" class="btn btn-primary btn-lg psr-button mb-0">
	    <img src="/images/spinner.svg" class="me-2 d-none psr-spinner mb-1">Save
	  </button>
</form>