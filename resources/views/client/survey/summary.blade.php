<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($survey) || empty($survey->client) || empty($survey->form))
          <div class="alert alert-danger text-white mt-4 border-0">Surveying details not available</div>
        @else
          <?php $form = $survey->form; $model_id = $survey->id; $model = 'survey'; $layout = $survey->layout; $plot_numbers = $survey->plot_numbers; $client_id = $survey->client_id ?? 0; $approved = (boolean)$survey->approved === true; $completed = true === (boolean)$survey->completed; $payment = $survey->payment; $amount = $form->amount; $payment_approved = empty($payment) ? false : (true === (boolean)($payment->approved) ? true : false); $paid = empty($payment) ? false : ($payment->status === 'paid' ? true : false); $reference = request()->get('reference'); ?>
            @if(!empty($reference))
                <?php $payment_verification = \App\Payment::verify($reference); ?>
                @if($payment_verification['status'] === 1)
                    <div class="alert alert-success border-0 text-white mb-4">
                    {{ $payment_verification['info'] }}
                    </div>
                @else
                    <div class="alert alert-danger border-0 text-white mb-4">
                    {{ $payment_verification['info'] }}
                    </div>
                @endif
            @endif
          <div class="row">
            <div class="col-12 col-xl-8 mb-4">
              <div class="alert alert-dark mb-4 text-white border-0 d-flex justify-content-between align-items-center">
                <div class="text-white">{{ ucwords($form->name) }} (<span class="text-{{ $approved ? 'success' : 'danger' }}">{{ $approved ? 'Approved' : 'Unapproved' }}</span>)</div>
              </div>
                <div class="">
                    @if(!empty($payment))
                        @if($payment_approved)
                            <div class="alert alert-success border-0 w-100 m-0 text-white mb-4">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Approved on {{ date("F j, Y, g:i a", strtotime($payment->approved_at)) }}</div>
                        @else
                            <div class="alert alert-success border-0 mb-4 text-white">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }} </span> Recieved. Awaiting Approval</div>
                        @endif
                    @endif
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
              <div class="">
                @if(empty($documents->count()))
                  <div class="alert alert-danger text-white mb-4">No documents uploaded yet.</div>
                @else
                  <div class="alert alert-info d-flex align-items-center justify-content-between mb-4">
                    <span class="text-white">Uploaded Land Document(s)</span>
                  </div>
                  <div class="row">
                    @foreach($documents as $document)
                      <div class="col-12 col-md-6 mb-4">
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
                      <div id="collapse-one" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
                              <div class="alert alert-success text-white mb-4">Application Approved on {{ date("F j, Y, g:i a", strtotime($survey->approved_at)) }}</div>
                            @else
                              <div class="alert alert-success text-white mb-4">Awaiting Approval of Survey Application.</div>
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
                <?php $code = strtoupper((string)$form->code); $noInspection = ($code === 'CNS' || $code === 'APP'); $sib = $survey->sib; $total_plots = is_array($plot_numbers) ? count($plot_numbers) : 1; $sib_amount = $sib->form->amount; $total_amount = ($total_plots * (int)$amount) + ($noInspection ? 0 : ($total_plots *  $sib_amount)); ?>
                @if(empty($payment))
                  <div class="card border  shadow-sm mb-4">
                    <div class="card-header border-bottom ">
                      <div class="alert alert-dark mb-{{ $noInspection ? '0' : '4' }}">
                          <span class="text-white">{{ ucwords($form->name) }}: One Plot NGN{{ number_format($amount) }} x {{ $total_plots }}Plot(s) = NGN{{ number_format($total_plots * $amount) }}</span>
                      </div>
                      @if(!$noInspection)
                        <div class="alert alert-dark mb-4">
                            <span class="text-white">Site Inspection Booking: NGN{{ number_format($sib_amount) }} x {{ $total_plots }}Plot(s) = NGN{{ number_format($total_plots * $sib_amount) }}</span>
                        </div>
                        <div class="alert alert-primary text-white" role="alert">
                          Site Inspection & Survey Total: NGN{{ number_format($total_amount) }}
                        </div>
                      @endif
                    </div>
                    <div class="card-body">
                        <form class="make-payment-form" action="javascript:;" method="post" data-action="{{ route('client.payment.process') }}">
                            @csrf
                            <input class="form-control" type="hidden" name="model" value="{{ $model }}">
                            <input class="form-control" type="hidden" name="model_id" value="{{ $model_id }}">
                            <input class="form-control" type="hidden" name="callback_url" value="{{ route('client.survey.summary', ['id' => $model_id])}}">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Total Amount (NGN)</label>
                                    <select id="" class="form-control amount" name="amount">
                                        <option value="{{ $total_amount }}">
                                            NGN{{ number_format($total_amount ) }}
                                        </option>
                                    </select>
                                    <small class="amount-error text-danger"></small>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input agree" type="checkbox" value="1" id="CheckPayment" name="agree">
                                    <label class="form-check-label" for="CheckPayment">I hereby affirm that my submissions and uploaded documents are genuine. I agree to forfiet the money i'm paying now if the document i have submitted are found to be forged or fraudulent.</label>
                                </div>
                                <small class="agree-error text-danger"></small>
                            </div>
                            <div class="alert d-none make-payment-message mb-4 text-white"></div>
                            <button type="submit" class="btn btn-primary w-100 make-payment-button">
                                <img src="/images/spinner.svg" class="me-2 d-none make-payment-spinner mb-1">Pay NGN{{ number_format($total_amount) }}
                            </button>
                        </form>
                    </div>
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