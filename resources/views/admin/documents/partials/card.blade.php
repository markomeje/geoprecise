<div class="card border">
	<form action="javascript:;">
    	<input type="file" name="document" class="document-input-{{ $document->id }}" data-url="{{ route('admin.document.change', ['model_id' => $document->model_id, 'type' => $document->type, 'model' => $document->model]) }}" style="display: none;">
  	</form>
	<div class="card-body">
		<a href="{{ $document->url }}" class="d-block position-relative mb-3">
	      <div class="position-absolute text-white pe-3" style="top: 8px; left: 20px;">
	        <i class="icofont-eye"></i> View Document
	      </div>
	      <div class="progress rounded-pill" style="height: 40px;">
	        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
	      </div>
	    </a>
	    <div class="row">
	    	{{-- <div class="col-6">
	    		<div class="cursor-pointer upload-document-{{ $document->id }}">
		          <button class="text-white btn btn-primary w-100 document-button-{{ $document->id }}">
		            <img src="/images/spinner.svg" class="document-loader-{{ $document->id }} d-none me-2 text-center position-relative rounded-circle border" data-id="{{ $document->id}}" style="top: -2px;">
		            <small style="font-size: 8px;">Change Doc</small>
		          </button>
		        </div>
	    	</div> --}}
	    	<div class="col-12">
	    		<div class="cursor-pointer delete-document-{{ $document->id }}" data-url="{{ route('admin.document.delete', ['id' => $document->id]) }}">
		          <button class="text-white btn btn-danger w-100 delete-document-button-{{ $document->id }}">
		            <img src="/images/spinner.svg" class="delete-document-loader-{{ $document->id }} d-none me-2 text-center position-relative rounded-circle border" data-id="{{ $document->id}}" style="top: -2px;">
		            <span>Delete Doc</span>
		          </button>
		        </div>
	    	</div>
	    </div>  
		<small class="">
			{{ $document->type }}
		</small> 
	</div>
		                                  
</div>