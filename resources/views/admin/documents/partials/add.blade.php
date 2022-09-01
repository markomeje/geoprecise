<form class="upload-document-form" id="upload-document-form" action="javascript:;" method="post" data-action="{{ route('admin.document.upload', ['model_id' => $model_id, 'model' => $model]) }}" enctype="multipar/form-data">
    @csrf
    <div class="row">
      <div class="form-group col-md-6 mb-3">
        <label class="text-muted">Document type</label>
        <select class="form-control custom-select type" name="type">
          <option value="" class="text-muted">Select Type</option>
          <?php $types = \App\Models\Document::TYPES; ?>
          @if(empty($types))
            <option value="" class="text-muted">No document types listed</option>
          @else
            @foreach($types as $type)
              <option value="{{ $type }}">
                {{ ucfirst($type) }}
              </option>
            @endforeach
          @endif
        </select>
        <small class="type-error text-danger"></small>
      </div>
    <div class="form-group col-md-6 mb-3">
      <label class="text-muted">Document file</label>
      <input type="file" name="document" class="form-control document">
      <small class="document-error text-danger"></small>
    </div>
  </div>
  <div class="upload-document-message alert d-none text-white mb-3"></div>
    <button type="submit" class="btn btn-primary mt-1 upload-document-button">
      <img src="/images/spinner.svg" class="me-2 d-none upload-document-spinner mb-1">Upload
    </button>
</form>