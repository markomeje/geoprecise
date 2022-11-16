<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12 col-lg-8 col-xl-7">
            <div class="alert alert-info border-0 text-white mb-4">Survey or Lifting Application</div>
            <form class="survey-form" method="post" action="javascript:;" data-action="{{ route('client.survey.add') }}">
              @csrf
              <div class="card border mb-4">
                <div class="card-header border-bottom">Select Survey Type</div>
                <div class="card-body">
                  <div class="row">
                    <div class="form-group input-group-lg col-12">
                      <label class="text-muted">Survey</label>
                      <?php $surveys = \App\Models\Form::where(['category' => 'surveys'])->get(); ?>
                      <select name="survey" class="form-control survey">
                        <option value="">Select survey</option>
                        @if(empty($surveys->count()))
                          <option value="">Nill</option>
                        @else
                          @foreach($surveys as $form)
                            <option value="{{ $form->id }}">
                              {{ ucwords($form->name) }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                      <small class="survey-error text-danger"></small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card border mb-4">
                <div class="card-header border-bottom">Client or Allottee Details</div>
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6 input-group-lg">
                      <label class="text-muted">Client or Allottee Name</label>
                      <input type="text" class="form-control client_name" name="client_name" placeholder="Enter Client or allottee name">
                      <small class="client_name-error text-danger"></small>
                      <small class="form-text text-muted">Client name should be written the way it should appear on survey plan</small>
                    </div>
                    <div class="form-group col-md-6 input-group-lg">
                      <label class="text-muted">Client or Allottee Phone Number</label>
                      <input type="text" class="form-control client_phone" name="client_phone" placeholder="Enter Client or allottee number">
                      <small class="client_phone-error text-danger"></small>
                    </div>
                  </div>
                  <div class="form-group input-group-lg">
                    <label class="text-muted">Client or Allottee Address</label>
                    <input type="text" class="form-control client_address" name="client_address" placeholder="Enter Client or allottee address" />
                    <small class="client_address-error text-danger"></small>
                  </div>
                </div>
              </div>
              <div class="card border mb-4">
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
              <div class="card border mb-4">
                <div class="card-header border-bottom">Select Layout. You will add plots on this layout later.</div>
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
                            @if($layout->plots()->exists())
                              <option value="{{ $layout->id }}">
                                {{ $layout->name }}
                              </option>
                            @endif
                          @endforeach
                        @endif
                      </select>
                      <small class="layout-error text-danger"></small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="alert d-none survey-message mb-4 text-white"></div>
              <button type="submit" class="btn btn-primary btn-lg w-100 survey-button mb-0">
                  <img src="/images/spinner.svg" class="me-2 d-none survey-spinner mb-1">Continue
              </button>
            </form>
          </div>
          <div class="col-12 col-lg-4 col-xl-5"></div>
        </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>