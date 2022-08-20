<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($form))
          <div class="alert alert-danger text-white mt-4 border-0">Form not available</div>
        @else
          <?php $name = $form->name ?? ''; $code = strtoupper($form->code ?? ''); ?>
          <div class="row">
            @if(in_array($code, ['LIS', 'CTS', 'CNS', 'LES']))
              <div class="col-12 col-md-6 mb-4">
                <div class="alert alert-info mb-4 border-0 text-white">
                  {{ $name }} or Change of Title of a Survey Plan
                </div>
                <div class="">
                    @include('client.forms.partials.survey')
                </div>
              </div>
              <div class="col-12 col-md-6 mb-4">
                <div class="alert alert-info mb-4 border-0 text-white">Submitted Survey or Lifting Applications</div>
                <?php $surveys = \App\Models\Survey::where(['user_id' => auth()->id()])->get(); ?>
                @if(empty($surveys))
                  <div class="alert alert-info">You have no requests yet</div>
                @else
                  <div class="row">
                    @foreach($surveys as $survey)
                      <div class="col-12 col-md-6 mb-4">
                        @include('client.survey.partials.card')
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>
            @endif

            @if($code == 'PSR')
              <div class="col-12 col-md-5 mb-4">
                <div class="alert alert-info mb-4 border-0 text-white">
                  {{ $name }}
                </div>
                <div class="bg-white p-4 shadow border-radius-lg">
                    @include('client.forms.partials.psr')
                </div>
              </div>
              <div class="col-12 col-md-7 mb-4">
                <div class="alert alert-info mb-4 border-0 text-white">Property Search Requests</div>
                <?php $psrs = \App\Models\Psr::where(['user_id' => auth()->id()])->get(); ?>
                @if(empty($psrs))
                  <div class="alert alert-info">You have no requests yet</div>
                @else
                  <div class="row">
                    @foreach($psrs as $psr)
                      <div class="col-12 col-md-6 col-lg-4 mb-4">
                        @include('client.psr.partials.card')
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>
            @endif

            @if($code == 'SIB')
              <div class="col-12 col-md-4 col-lg-3 mb-4">
                <div class="alert alert-info mb-4 border-0 text-white">
                  {{ $name }}
                </div>
                <div class="card shadow-sm border-radius-lg">
                    <div class="card-header border-bottom">Start your Application Here</div>
                    <div class="card-body">
                      <form class="add-client-sib-form" action="javascript:;" method="post" data-action="{{ route('client.sib.add', ['form_id' => $form->id]) }}">
                        <div class="form-group input-group-lg col-12 mb-4">
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
                        <div class="alert d-none add-client-sib-message mb-4 text-white"></div>
                        <button type="submit" class="btn btn-primary w-100 btn-lg add-client-sib-button mb-0">
                          <img src="/images/spinner.svg" class="me-2 d-none add-client-sib-spinner mb-1">Save
                        </button>
                      </form>
                    </div>
                </div>
              </div>
              <div class="col-12 col-md-8 col-lg-9 mb-4">
                <?php $sibs = \App\Models\Sib::where(['user_id' => auth()->id()])->get(); ?>
                @if(empty($sibs->count()))
                  <div class="alert alert-info">You have no requests yet</div>
                @else
                  <div class="alert alert-info mb-4 border-0 text-white">Site Inspections</div>
                  <div class="row">
                    @foreach($sibs as $sib)
                      <div class="col-12 col-md-6 col-lg-4 mb-4">
                        @include('client.sib.partials.card')
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>
            @endif
          </div>   
        @endif
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>