<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($survey) || empty($survey->client))
          <div class="alert alert-danger text-white mt-4 border-0">Surveying details not available</div>
        @else
          <?php $model_id = $survey->id; $model = 'survey'; $layout = $survey->layout; $plot_numbers = $survey->plot_numbers; $client_id = $survey->client_id ?? 0; $approved = (boolean)$survey->approved === true; $completed = true === (boolean)$survey->completed; ?>
          <div class="row">
            <div class="col-12 col-lg-8 mb-4">
              <div class="alert alert-dark border-0 text-white cursor-pointer btn-lg mb-4" data-bs-toggle="modal" data-bs-target="#add-client-plot">Add Plot(s) for your application (+)</div>
              <?php $route = route('client.plot.add', ['model_id' => $model_id, 'model' => $model]); ?>
              @include('client.plots.partials.add')
              <div class="mb-4 p-4 bg-white shadow">
                <?php $plots = \App\Models\Plot::all(); ?>
                  @if(empty($survey->plot_numbers))
                    <div class="alert alert-info m-0 border-0 text-white">No plot(s) added for your application.</div>
                  @else
                    <div class="row d-flex flex-wrap g-0">
                    <?php $plot_numbers = str_contains($survey->plot_numbers, '-') ? explode('-', $survey->plot_numbers) : $survey->plot_numbers; ?>
                    @if(is_array($plot_numbers))
                      <?php $count = 1; ?>
                      @foreach($plot_numbers as $number)
                        @if(!empty($number))
                          <div class="col-6 col-md-4 col-lg-3">
                            <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                              <small class="tiny-font">
                                ({{ $count++ }}) {{ $number }}
                              </small>
                              <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $number, 'model_id' => $survey->id, 'model' => 'survey']) }}" data-message="Are you sure to delete?">
                                <i class="icofont-trash"></i>
                              </small>
                            </div>
                          </div>
                        @endif
                      @endforeach
                    @else
                      <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                        <small class="">{{ $plot_numbers }}</small>
                        <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $plot_numbers, 'model_id' => $survey->id, 'model' => 'survey']) }}" data-message="Are you sure to delete?">
                          <i class="icofont-trash"></i>
                        </small>
                      </div>
                    @endif
                    @if(empty($survey->payment))
                      @if(!empty($survey->form))
                        @if(!empty($survey->form->amount))
                          <?php $total_plots = is_array($plot_numbers) ? count($plot_numbers) : 1; $amount = $total_plots * (int)$survey->form->amount; ?>
                          <div class="mt-4 make-payment" data-url="{{ route('payment.process', ['form_id' => $survey->form->id, 'type' => 'form', 'model_id' => $survey->id, 'model' => 'survey', 'amount' => $amount]) }}">
                            <button class="btn btn-primary make-payment-button">
                              <img src="/images/spinner.svg" class="me-2 d-none make-payment-spinner mb-1"> Pay NGN{{ number_format($amount) }}
                            </button>
                          </div>
                        @endif
                      @endif
                    @elseif($survey->payment->status !== 'paid')
                      @if(!empty($survey->form))
                        @if(!empty($survey->form->amount))
                          <?php $total_plots = is_array($plot_numbers) ? count($plot_numbers) : 1; $amount = $total_plots * (int)$survey->form->amount; ?>
                          <div class="mt-4 make-payment" data-url="{{ route('payment.process', ['form_id' => $survey->form->id, 'type' => 'form', 'model_id' => $survey->id, 'model' => 'survey', 'amount' => $amount]) }}">
                            <button class="btn btn-primary make-payment-button">
                              <img src="/images/spinner.svg" class="me-2 d-none make-payment-spinner mb-1"> Pay NGN{{ number_format($amount) }}
                            </button>
                          </div>
                        @endif
                      @endif
                    @else
                      <div class="alert alert-info mt-3 text-white">
                        Payment successfull. {{ (boolean)$survey->payment->verified == false ? 'Pending office verificaion' : 'Payment verified' }}
                      </div>
                    @endif
                </div>
                  @endif
              </div>
                <div class="card mb-4 shadow-sm border-0">
                  <div class="card-header border-bottom">
                    <?php $types = \App\Models\Document::TYPES; ?>
                    Upload necessary document(s) like {{ implode(', ', $types) }}
                  </div>
                  <div class="card-body">
                    <?php $model_id = $survey->id; $model = 'survey'; ?>
                    @include('client.documents.partials.add')
                  </div>
                </div>
              <div class="">
                <?php $documents = $survey->documents; ?>
                @if(empty($documents->count()))
                  <div class="alert alert-danger text-white mb-4">No documents uploaded yet.</div>
                @else
                  <div class="row">
                    @foreach($documents as $document)
                      <div class="col-12 col-md-4 mb-4">
                        @include('client.documents.partials.card')
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>
              <div class="">
                <div class="alert alert-info mb-4 border-0 text-white">Edit submitted Survey or Lifting Application</div>
                <form class="survey-form" method="post" action="javascript:;" data-action="{{ route('client.survey.update', ['id' => $survey->id]) }}">
                  <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header border-bottom">Purchaser or Allottee Details</div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6 input-group-lg">
                          <label class="text-muted">Purchaser or Allottee Name</label>
                          <input type="text" class="form-control purchaser_name" name="purchaser_name" placeholder="Enter purchaser or allottee name" name="purchaser_name" value="{{ $survey->purchaser_name }}">
                          <small class="purchaser_name-error text-danger"></small>
                        </div>
                        <div class="form-group col-md-6 input-group-lg">
                          <label class="text-muted">Purchaser or Allottee Phone</label>
                          <input type="text" class="form-control purchaser_phone" name="purchaser_phone" placeholder="Enter purchaser or allottee name" name="purchaser_phone" value="{{ $survey->purchaser_phone }}">
                          <small class="purchaser_phone-error text-danger"></small>
                        </div>
                      </div>
                      <div class="form-group input-group-lg">
                        <label class="text-muted">Purchaser or Allottee Address</label>
                        <textarea class="form-control purchaser_address" name="purchaser_address" placeholder="Enter purchaser or allottee address">{{ $survey->purchaser_address }}</textarea>
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
                          <input type="text" class="form-control seller_name" name="seller_name" placeholder="Enter seller or donor name" name="seller_name" value="{{ $survey->seller_name }}">
                          <small class="seller_name-error text-danger"></small>
                        </div>
                        <div class="form-group input-group-lg col-md-6">
                        <label class="text-muted">Land Seller or Donor Phone number</label>
                        <input type="text" class="form-control seller_phone" name="seller_phone" placeholder="Enter seller or donor number" name="seller_phone" value="{{ $survey->seller_phone }}">
                        <small class="seller_phone-error text-danger"></small>
                      </div>
                      </div>
                      <div class="form-group input-group-lg">
                        <label class="text-muted">Land Seller or Donor Address</label>
                        <textarea class="form-control seller_address" name="seller_address" placeholder="Enter seller or donor address">{{ $survey->seller_address }}</textarea>
                        <small class="seller_address-error text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header border-bottom">Approval by Community Lands Committe or Land Owner</div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group input-group-lg col-md-6 mb-4">
                          <label class="text-muted">Approval Name</label>
                          <input type="text" name="approval_name" class="form-control approval_name" placeholder="Enter name" value="{{ $survey->approval_name }}">
                          <small class="approval_name-error text-danger"></small>
                        </div>
                        <div class="form-group input-group-lg col-md-6 mb-4">
                          <label class="text-muted">Approval Address</label>
                          <input type="text" name="approval_address" class="form-control approval_address" placeholder="Enter address" value="{{ $survey->approval_address }}">
                          <small class="approval_address-error text-danger"></small>
                        </div>
                        <div class="form-group input-group-lg col-12 mb-4">
                          <label class="text-muted">Approval Comment(s)</label>
                          <textarea class="form-control approval_comments" rows="3" name="approval_comments" placeholder="Enter comments">{{ $survey->approval_comments }}</textarea>
                          <small class="approval_comments-error text-danger"></small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="alert d-none survey-message mb-4 text-white"></div>
                  <div class="card border-0 mb-4 shadow-sm">
                    <div class="card-header border-bottom">Click the switch below only after you're sure that all information provided are acurate and that you agree to <a href="" class="text-primary">our terms and conditions</a>. Note that you cannot modify any parts of your application afterwards.</div>
                    <div class="card-body">
                      <div class="form-check form-switch">
                        <input class="form-check-input" name="completed" type="checkbox" id="completed" value="yes" {{ $completed === true ? 'checked' : '' }}>
                        <label class="form-check-label" for="completed">Final submission</label>
                      </div>
                      <small class="completed-error text-danger"></small>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-lg survey-button mb-0">
                      <img src="/images/spinner.svg" class="me-2 d-none survey-spinner mb-1">Save
                  </button>
                </form>
              </div>
            </div>
            <div class="col-12 col-lg-4 mb-4">
                <?php $surveys = \App\Models\Survey::where(['client_id' => $client_id])->get(); ?>
                @if(empty($surveys->count()))
                  <div class="alert alert-info mb-4 border-0 text-white">Other related applications appears here</div>
                @else
                  <div class="alert alert-info mb-4 border-0 text-white">Submitted Survey or Lifting Applications</div>
                  <div class="row">
                    @foreach($surveys as $survey)
                      @if($survey->id !== (int)$model_id)
                        <div class="col-12 col-md-6 col-lg-12 mb-4">
                          @include('client.survey.partials.card')
                        </div>
                      @endif
                    @endforeach
                  </div>
                @endif
              </div>
          </div>   
        @endif
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>