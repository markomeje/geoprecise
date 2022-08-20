<form class="edit-client-profile-form" action="javascript:;" method="post" data-action="{{ route('client.profile.edit', ['id' => $client->id]) }}">
    @csrf
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="text-muted">Fullname</label>
          <input class="form-control fullname" name="fullname" type="text" placeholder="Your fullname" value="{{ $client->fullname }}">
          <small class="fullname-error text-danger"></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="text-muted">Additional Phone <small class="text-italic">(Optional)</small></label>
          <input class="form-control phone" name="phone" type="phone" placeholder="Your phone" value="{{ $client->phone ?? '' }}">
          <small class="phone-error text-danger"></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="text-muted">Occupation</label>
          <input class="form-control occupation" name="occupation" type="text" value="{{ $client->occupation }}">
          <small class="occupation-error text-danger"></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="text-muted">Date of birth</label>
          <input class="form-control dob" type="date" name="dob" value="{{ $client->dob }}">
          <small class="dob-error text-danger"></small>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="text-muted">Address</label>
          <textarea class="form-control address" name="address" rows="4" placeholder="Your address">{{ $client->address }}</textarea>
          <small class="address-error text-danger"></small>
        </div>
      </div>
    </div>
    <div class="alert d-none edit-client-profile-message m-0 text-white"></div>
    <div class="row">
      <div class="col-12 col-md-4 col-lg-3">
        <button type="submit" class="btn btn-lg btn-primary w-100 mt-3 mb-2 edit-client-profile-button">
        <img src="/images/spinner.svg" class="me-2 d-none edit-client-profile-spinner mb-1">Save
      </button>
      </div>
    </div>
</form>