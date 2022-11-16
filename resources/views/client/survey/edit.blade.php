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
              <div class="alert alert-dark mb-4 text-white border-0 d-flex justify-content-between align-items-center">
                <span>Survey or Lifting Application</span>
                <span>{{ $approved ? 'Approved' : 'Unapproved' }}</span>
              </div>
              @if($approved)
                @if(empty($survey->sib))
                  <div class="alert alert-success mb-4 border-0 d-flex justify-content-between align-items-center">
                    <span class="text-white">Want to book for Site Inspection?</span>
                    <a href="javascript:;" class="text-white apply-sib" data-url="{{ route('client.sib.apply', ['survey_id' => $model_id]) }}" data-message="Are you sure to proceed"><img src="/images/spinner.svg" class="me-2 d-none apply-sib-spinner mb-1">Apply Here</a>
                  </div>
                @else
                  <?php $sib_id = $survey->sib->id; ?>
                  <div class="alert bg-dark mb-4 border-0 d-flex justify-content-between align-items-center">
                    <span class="text-white">
                      Site Inspection
                      @if(true === (boolean)($survey->sib->approved ?? 0))
                        <a href="{{ route('client.sib.edit', ['id' => $sib_id]) }}" class="text-success">(Approved)</a>
                      @else
                        <a href="{{ route('client.sib.edit', ['id' => $sib_id]) }}" class="text-danger apply-sib">(Unapproved)</a>
                      @endif
                    </span>
                    <a href="{{ route('client.sib.edit', ['id' => $sib_id]) }}" class="text-white">See details</a>
                  </div>
                @endif
              @endif
              <div class="card mb-4">
                <div class="card-header pb-0 border-bottom bg-transparent">
                  <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="p-4 w-100 d-block border border-primary">
                        <small class="text-primary">
                          {{ ucwords($survey->layout->name) }} Plots
                        </small>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="cursor-pointer w-100 d-block bg-primary border border-primary p-4" data-bs-toggle="modal" data-bs-target="#add-client-plot">
                        <small class="text-white">Add Plot(s)</small>
                      </div>
                    </div>
                  </div>
                </div>
                <?php $route = route('client.plot.add', ['model_id' => $model_id, 'model' => $model]); ?>
                @include('client.plots.partials.add')
                <div class="card-body pb-2">
                  @if(empty($survey->plot_numbers))
                    <div class="alert alert-danger m-0 border-0 text-white">No plot(s) added for this application.</div>
                  @else
                    <div class="row d-flex flex-wrap">
                      <?php $plot_numbers = str_contains($survey->plot_numbers, '-') ? explode('-', $survey->plot_numbers) : $survey->plot_numbers; ?>
                      @if(is_array($plot_numbers))
                        @foreach($plot_numbers as $number)
                          @if(!empty($number))
                            <div class="col-12 col-md-6 col-xl-4 mb-4">
                              <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                                <small class="">
                                  {{ $number }}
                                </small>
                                <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $number, 'model_id' => $model_id, 'model' => $model]) }}" data-message="Are you sure to delete?">
                                  <i class="icofont-trash"></i>
                                </small>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      @else
                        <div class="col-12 col-md-6 col-xl-4 mb-4">
                          <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                            <small class="">{{ $plot_numbers }}</small>
                            <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $plot_numbers, 'model_id' => $model_id, 'model' => $model]) }}" data-message="Are you sure to delete?">
                              <i class="icofont-trash"></i>
                            </small>
                          </div>
                        </div>
                      @endif
                    </div>
                  @endif
                </div>
              </div>
              @if(!empty($plot_numbers))
                <?php $payment = $survey->payment; $amount = $survey->form ? ($survey->form->amount ?? 0) : 0; $total_plots = is_array($plot_numbers) ? count($plot_numbers) : 1; $total_amount = $total_plots * (int)$amount; ?>
                @if(empty($payment))
                  <div class="card mb-4">
                    <div class="card-header border-bottom">
                      <span class="text-dark">One Plot NGN{{ number_format($amount) }} x {{ $total_plots }}Plot(s) Total: NGN{{ number_format($total_amount) }} Unpaid</span>
                    </div>
                    <div class="card-body">
                      <a href="javascript:;" class="m-0 btn btn-primary text-white make-payment" data-message="Are you sure to make payment now?" data-url="{{ route('client.payment.process', ['type' => 'paystack', 'model_id' => $survey->id, 'model' => $model, 'amount' => $total_amount]) }}">
                        <img src="/images/spinner.svg" class="me-2 d-none make-payment-spinner mb-1">Make Payment</a>
                    </div>
                  </div>
                @else
                  <?php $payment_approved = true === (boolean)$payment->approved ?>
                  @if($payment_approved)
                    <div class="alert alert-success w-100 m-0 text-white mb-4">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Approved on {{ date("F j, Y, g:i a", strtotime($payment->approved_at)) }}</div>
                  @else
                    <div class="alert alert-info mb-4 text-white">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Awaiting Approval</div>
                  @endif
                @endif
              @endif
              <?php $documents = $survey->documents; ?>
              @if(true !== $completed)
                <div class="card mb-4 shadow-sm border-0">
                  <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                    <span class="text-dark">Upload Document(s). Note that submission of fraudulent documents are at owners risk.</span>
                  </div>
                  <div class="card-body pb-0">
                    @include('client.documents.partials.add')
                  </div>
                </div>
              @endif
              <div class="">
                @if(empty($documents->count()))
                  <div class="alert alert-danger text-white mb-4">No documents uploaded yet.</div>
                @else
                  @if($completed)
                    <div class="alert alert-info d-flex align-items-center justify-content-between mb-4">
                      <span class="text-white">Uploaded Document(s)</span>
                    </div>
                  @endif
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
                <form class="survey-form" method="post" action="javascript:;" data-action="{{ route('client.survey.save', ['id' => $survey->id]) }}">
                  <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header border-bottom">Client or Allottee Details</div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6 input-group-lg">
                          <label class="text-muted">Client or Allottee Name</label>
                          <input type="text" class="form-control client_name" name="client_name" placeholder="Enter Client or allottee name" name="client_name" value="{{ $survey->client_name }}">
                          <small class="client_name-error text-danger"></small>
                        </div>
                        <div class="form-group col-md-6 input-group-lg">
                          <label class="text-muted">Client or Allottee Phone</label>
                          <input type="text" class="form-control client_phone" name="client_phone" placeholder="Enter Client or allottee name" name="client_phone" value="{{ $survey->client_phone }}">
                          <small class="client_phone-error text-danger"></small>
                        </div>
                      </div>
                      <div class="form-group input-group-lg">
                        <label class="text-muted">Client or Allottee Address</label>
                        <textarea class="form-control client_address" name="client_address" placeholder="Enter Client or allottee address">{{ $survey->client_address }}</textarea>
                        <small class="client_address-error text-danger"></small>
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
                  <div class="alert d-none survey-message mb-4 text-white"></div>
                  @if($completed)
                      @if($approved)
                        <div class="alert alert-success text-white my-4">Approved on {{ date("F j, Y, g:i a", strtotime($survey->approved_at)) }}</div>
                      @else
                        <div class="alert alert-success text-white my-4">Awaiting Approval</div>
                      @endif
                  @else
                    <div class="card border-0 mb-4 shadow-sm">
                      <div class="card-header border-bottom">Click the switch below only after you're sure that all information provided are acurate and that you agree to <a href="" class="text-primary">Our terms and conditions</a>. Note that you cannot modify any parts of your application afterwards.</div>
                      <div class="card-body">
                        <div class="form-check form-switch">
                          <input class="form-check-input" name="completed" type="checkbox" id="completed" value="1">
                          <label class="form-check-label" for="completed">Final submission</label>
                        </div>
                        <small class="completed-error text-danger"></small>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 btn-lg survey-button mb-0">
                        <img src="/images/spinner.svg" class="me-2 d-none survey-spinner mb-1">Next
                    </button>
                  @endif
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