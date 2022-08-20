<div class="modal fade" id="edit-document-{{ $document->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="edit-document-form" action="javascript:;" method="post" data-action="{{ route('document.edit', ['id' => $document->id]) }}">
          @csrf
        <div class="modal-body">
          <div class="">
            <div class="form-group">
              <label class="text-muted">Document type</label>
              <select class="form-control custom-select type" name="type">
                <option value="" class="text-muted">Select Type</option>
                <?php $types = \App\Models\Document::TYPES; ?>
                @if(empty($types))
                  <option value="" class="text-muted">No document types listed</option>
                @else
                  @foreach($types as $code => $type)
                    <option value="{{ strtoupper($code) }}" {{ $document->type == $code  ? 'selected' : '' }}>
                      {{ ucfirst($type) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="type-error text-danger"></small>
            </div>
          <div class="form-group">
            <label class="text-muted">Description</label>
            <textarea class="form-control description" name="description" rows="4" placeholder="Your description">{{ $document->description }}</textarea>
            <small class="description-error text-danger"></small>
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-dark text-white me-3" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary edit-document-button">
            <img src="/images/spinner.svg" class="me-2 d-none edit-document-spinner mb-1">Continue
          </button>
        </div>
      </form>
    </div>
  </div>
</div>