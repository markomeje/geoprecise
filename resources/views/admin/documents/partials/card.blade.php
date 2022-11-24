<div class="card border">
	<form action="javascript:;">
    	<input type="file" name="document" class="document-input-{{ $document->id }}" data-url="{{ route('admin.document.change', ['model_id' => $document->model_id, 'type' => $document->type, 'model' => $document->model]) }}" style="display: none;">
  	</form>
	<div class="card-body">
		<a href="{{ $document->url }}" class="d-block position-relative mb-4">
	      <div class="d-flex justify-content-between rounded bg-dark p-3 align-items-center">
        	<small class="text-white">
        		{{ $document->type }}
        	</small>
	      </div>
	    </a>
	</div>                                  
</div>