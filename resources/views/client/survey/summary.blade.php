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
          <?php $model_id = $survey->id; $model = 'survey'; $layout = $survey->layout; $plot_numbers = $survey->plot_numbers; $client_id = $survey->client_id ?? 0; $approved = (boolean)$survey->approved === true; $completed = true === (boolean)$survey->completed; $payment = $survey->payment; $amount = $survey->form ? ($survey->form->amount ?? 0) : 0; $payment_approved = empty($payment) ? false : (true === (boolean)($payment->approved) ? true : false); $paid = empty($payment) ? false : ($payment->status === 'paid' ? true : false); ?>
          <div class="row">
            <div class="col-12 col-xl-8 mb-4">
              <div class="alert alert-dark mb-4 text-white border-0 d-flex justify-content-between align-items-center">
                <div class="text-white">Survey or Lifting Application (<span class="text-{{ $approved ? 'success' : 'danger' }}">{{ $approved ? 'Approved' : 'Unapproved' }}</span>)</div>
              </div>
              <div class="card mb-4">
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
                                @if(!$paid)
                                  <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $number, 'model_id' => $model_id, 'model' => $model]) }}" data-message="Are you sure to delete?">
                                    <i class="icofont-trash"></i>
                                  </small>
                                @endif
                              </div>
                            </div>
                          @endif
                        @endforeach
                      @else
                        <div class="col-12 col-md-6 col-xl-4 mb-4">
                          <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                            <small class="">{{ $plot_numbers }}</small>
                            @if(!$paid)
                              <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $plot_numbers, 'model_id' => $model_id, 'model' => $model]) }}" data-message="Are you sure to delete?">
                                <i class="icofont-trash"></i>
                              </small>
                            @endif
                          </div>
                        </div>
                      @endif
                    </div>
                  @endif
                </div>
              </div>
              <?php $documents = $survey->documents; ?>
              <div class="px-4 pt-4 pb-1 bg-white shadow-sm border-radius-lg border  mb-4">
                @if(empty($documents->count()))
                  <div class="alert alert-danger text-white mb-4">No documents uploaded yet.</div>
                @else
                  <div class="alert alert-info d-flex align-items-center justify-content-between mb-4">
                    <span class="text-white">Uploaded Land Document(s)</span>
                  </div>
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
                <form class="survey-form" method="post" action="javascript:;" data-action="{{ route('client.survey.save', ['id' => $survey->id]) }}">
                  <div class="accordion mb-4" id="accordionExample">
                    <div class="accordion-item">
                      <div class="accordion-header d-flex justify-content-between align-items-center cursor-pointer mb-4 alert alert-info border-0" data-bs-toggle="collapse" id="headingOne" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                        <span class="text-white">{{ $paid ? 'View' : 'Edit' }} Application Details</span>
                        <span class="text-white">
                          <i class="icofont-caret-down"></i>
                        </span>
                      </div>
                      <div id="collapse-one" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0 m-0">
                          <div class="card border  shadow-sm mb-4">
                              <div class="card-header border-bottom  text-dark">Client or Allottee Details</div>
                              <div class="card-body">
                                <div class="row">
                                  <div class="form-group col-md-6 input-group-lg">
                                    <label class="text-muted">Client or Allottee Name</label>
                                    <input {{ $paid ? 'readonly' : '' }} type="text" class="form-control client_name" name="client_name" placeholder="Enter Client or allottee name" name="client_name" value="{{ $survey->client_name }}">
                                    <small class="client_name-error text-danger"></small>
                                    <small class="form-text text-muted">Client name should be written the way it should appear on survey plan</small>
                                  </div>
                                  <div class="form-group col-md-6 input-group-lg">
                                    <label class="text-muted">Client or Allottee Phone</label>
                                    <input {{ $paid ? 'readonly' : '' }} type="text" class="form-control client_phone" name="client_phone" placeholder="Enter Client or allottee name" name="client_phone" value="{{ $survey->client_phone }}">
                                    <small class="client_phone-error text-danger"></small>
                                  </div>
                                </div>
                                <div class="form-group input-group-lg">
                                  <label class="text-muted">Client or Allottee Address</label>
                                  <input {{ $paid ? 'readonly' : '' }} class="form-control client_address" name="client_address" placeholder="Enter Client or allottee address" value="{{ $survey->client_address }}">
                                  <small class="client_address-error text-danger"></small>
                                </div>
                              </div>
                          </div>
                          <div class="card border  shadow-sm mb-4">
                            <div class="card-header border-bottom  text-dark">Land Seller or Donor Details</div>
                            <div class="card-body">
                              <div class="row">
                                <div class="form-group col-md-6 input-group-lg">
                                  <label class="text-muted">Land Seller or Donor Name</label>
                                  <input {{ $paid ? 'readonly' : '' }} type="text" class="form-control seller_name" name="seller_name" placeholder="Enter seller or donor name" name="seller_name" value="{{ $survey->seller_name }}">
                                  <small class="seller_name-error text-danger"></small>
                                </div>
                                <div class="form-group input-group-lg col-md-6">
                                <label class="text-muted">Land Seller or Donor Phone number</label>
                                <input {{ $paid ? 'readonly' : '' }} type="text" class="form-control seller_phone" name="seller_phone" placeholder="Enter seller or donor number" name="seller_phone" value="{{ $survey->seller_phone }}">
                                <small class="seller_phone-error text-danger"></small>
                              </div>
                              </div>
                              <div class="form-group input-group-lg">
                                <label class="text-muted">Land Seller or Donor Address</label>
                                <input {{ $paid ? 'readonly' : '' }} class="form-control seller_address" name="seller_address" placeholder="Enter seller or donor address" value="{{ $survey->seller_address }}">
                                <small class="seller_address-error text-danger"></small>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert d-none survey-message mb-4 text-white"></div>
                        @if($paid)
                            @if($approved)
                              <div class="alert alert-success text-white my-4">Application Approved on {{ date("F j, Y, g:i a", strtotime($survey->approved_at)) }}</div>
                            @else
                              <div class="alert alert-success text-white my-4">Awaiting Approval of Survey Application.</div>
                            @endif
                        @else
                          <button type="submit" class="btn btn-primary w-100 btn-lg survey-button mb-0">
                              <img src="/images/spinner.svg" class="me-2 d-none survey-spinner mb-1">Save</button>
                        @endif
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              @if(!empty($plot_numbers))
                <?php $sib = $survey->sib; $total_plots = is_array($plot_numbers) ? count($plot_numbers) : 1; $sib_amount = $sib->form->amount; $total_amount = ($total_plots * (int)$amount) + $sib_amount; ?>
                @if(empty($payment))
                  <div class="card border  shadow-sm mb-4">
                    <div class="card-header border-bottom ">
                      <div class="alert alert-dark m-0">
                          <span class="text-white">One Plot NGN{{ number_format($amount) }} x {{ $total_plots }}Plot(s) = NGN{{ number_format($total_plots * $amount) }}. Site Inspection Booking: NGN{{ number_format($sib_amount) }} Total: NGN{{ number_format($total_amount) }}</span>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="alert alert-info text-white mb-4">Submission of Fraudulent documents are at Owners risk. No Refund of Money after Payment</div>
                      <a href="javascript:;" class="m-0 btn btn-lg btn-primary text-white make-payment" data-message="Are you sure to make payment now?" data-url="{{ route('client.payment.process', ['type' => 'paystack', 'model_id' => $survey->id, 'model' => $model, 'amount' => $total_amount]) }}">
                        <img src="/images/spinner.svg" class="me-2 d-none make-payment-spinner mb-1">Pay NGN{{ number_format($total_amount) }}</a>
                    </div>
                  </div>
                @endif
                @if(!empty($payment))
                  <div class="">
                    @if($payment_approved)
                      <div class="alert alert-success w-100 m-0 text-white mb-4">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Approved on {{ date("F j, Y, g:i a", strtotime($payment->approved_at)) }}</div>
                    @else
                      <div class="alert alert-dark mb-4 text-white">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Awaiting Approval</div>
                    @endif
                  </div>
                @endif
              @endif
            </div>
            <div class="col-12 col-xl-4 mb-4">
                <?php $surveys = \App\Models\Survey::latest('created_at')->where(['client_id' => $client_id])->get(); ?>
                @if(empty($surveys->count()))
                  <div class="alert alert-info mb-4 border-0 text-white">Other applications appears here</div>
                @else
                  <div class="alert alert-info mb-4 border-0 text-white">Previous Applications</div>
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