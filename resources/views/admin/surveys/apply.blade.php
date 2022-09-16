<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($client))
          <div class="alert alert-danger d-block mb-4 text-white border-0">Unkwon error. Client details not found.</div>
        @else
          <?php $client_id = $client->id; ?>
          <div class="">
            <div class="row">
              <div class="col-12 col-lg-8 col-xl-7">
                <div class="alert alert-info border-0 text-white mb-4">Survey Application for {{ ucwords($client->fullname) }}</div>
                <form class="survey-form" method="post" action="javascript:;" data-action="{{ route('admin.survey.add', ['client_id' => $client_id]) }}">
                  @csrf
                  <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header border-bottom">Purchaser or Allottee Details</div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6 input-group-lg">
                          <label class="text-muted">Purchaser or Allottee Name</label>
                          <input type="text" class="form-control purchaser_name" name="purchaser_name" placeholder="Enter purchaser or allottee name">
                          <small class="purchaser_name-error text-danger"></small>
                        </div>
                        <div class="form-group col-md-6 input-group-lg">
                          <label class="text-muted">Purchaser or Allottee Phone Number</label>
                          <input type="text" class="form-control purchaser_phone" name="purchaser_phone" placeholder="Enter purchaser or allottee number">
                          <small class="purchaser_phone-error text-danger"></small>
                        </div>
                      </div>
                      <div class="form-group input-group-lg">
                        <label class="text-muted">Purchaser or Allottee Address</label>
                        <input type="text" class="form-control purchaser_address" name="purchaser_address" placeholder="Enter purchaser or allottee address" />
                        <small class="purchaser_address-error text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header border-bottom">Land Seller or Donor Details</div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6 input-group-lg">
                          <label class="text-muted">Land Seller or Donor Name</label>
                          <input type="text" class="form-control seller_name" name="seller_name" placeholder="Enter seller or donor name">
                          <small class="seller_name-error text-danger"></small>
                        </div>
                        <div class="form-group col-md-6 input-group-lg">
                          <label class="text-muted">Land Seller or Donor Phone Number</label>
                          <input type="text" class="form-control seller_phone" name="seller_phone" placeholder="Enter seller or donor number">
                          <small class="seller_phone-error text-danger"></small>
                        </div>
                      </div>
                      <div class="form-group input-group-lg">
                        <label class="text-muted">Land Seller or Donor Address</label>
                        <input type="text" class="form-control seller_address" name="seller_address" placeholder="Enter seller or donor address" />
                        <small class="seller_address-error text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header border-bottom">Select Layout. You will add plots on this layout later.</div>{{-- Is it possible to survey multiple plots from multiple layouts? --}}
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group input-group-lg col-12">
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
                    </div>
                  </div>
                  <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header border-bottom">Approval by Community Lands Committe or Land Owner</div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6 mb-4">
                          <label class="text-muted">Approval Name</label>
                          <input type="text" name="approval_name" class="form-control approval_name" placeholder="Enter name">
                          <small class="approval_name-error text-danger"></small>
                        </div>
                        <div class="form-group col-md-6 mb-4">
                          <label class="text-muted">Approval Address</label>
                          <input type="text" name="approval_address" class="form-control approval_address" placeholder="Enter address">
                          <small class="approval_address-error text-danger"></small>
                        </div>
                        <div class="form-group col-12 mb-4">
                          <label class="text-muted">Approval Comment(s)</label>
                          <textarea class="form-control approval_comments" rows="3" name="approval_comments" placeholder="Enter comments"></textarea>
                          <small class="approval_comments-error text-danger"></small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="alert d-none survey-message mb-4 text-white"></div>
                  <button type="submit" class="btn btn-primary btn-lg w-100 survey-button mb-0">
                      <img src="/images/spinner.svg" class="me-2 d-none survey-spinner mb-1">Save
                  </button>
                </form>
              </div>
              <div class="col-12 col-lg-4 col-xl-5"></div>
            </div>
          </div>
        @endif
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>