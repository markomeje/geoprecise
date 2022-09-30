<div class="card border">
	<form action="javascript:;">
    	<input type="file" name="document" class="document-input-{{ $document->id }}" data-url="{{ route('client.document.change', ['model_id' => $document->model_id, 'type' => $document->type, 'model' => $document->model]) }}" style="display: none;">
  	</form>
	<div class="card-body">
		<a href="{{ $document->url }}" class="d-block position-relative mb-4">
	      <div class="d-flex justify-content-between rounded bg-dark p-3 align-items-center">
        	<small class="text-white">
        		{{ $document->type }}
        	</small>
        	<small class="text-white">
        		<i class="icofont-eye"></i>
        	</small>
	      </div>
	    </a>
	    <div class="row">
	    	@if(!$completed)
		    	<div class="col-12">
		    		<div class="cursor-pointer delete-document-{{ $document->id }}" data-url="{{ route('client.document.delete', ['id' => $document->id]) }}" data-message="Are you sure to delete this document?">
			          <button class="text-white btn btn-danger w-100 delete-document-button-{{ $document->id }}">
			            <img src="/images/spinner.svg" class="delete-document-loader-{{ $document->id }} d-none me-2 text-center position-relative rounded-circle border" data-id="{{ $document->id}}">
			            <small>Delete</small>
			          </button>
			        </div>
		    	</div>
	    	@endif
	    </div>
	</div>                                  
</div>