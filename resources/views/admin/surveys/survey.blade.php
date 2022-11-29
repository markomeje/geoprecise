<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($survey) || empty($survey->client))
          <div class="alert alert-danger d-block mb-4 text-white border-0">Unkwon error. Application details not found.</div>
        @else
          <?php $client_id = $survey->client->id; $model_id = $survey->id; $model = 'survey'; $plot_numbers = $survey->plot_numbers; $client_name = $survey->client->fullname; $approved = (true === (boolean)$survey->approved); $payment = $survey->payment; $paid = empty($payment) ? false : ($payment->status === 'paid' ? true : false); ?>
          <div class="min-vh-100">
            <div class="row">
              <div class="col-12 col-lg-8 mb-4">
                <div class="alert alert-dark mb-4 text-white border-0">
                  <span class="text-white">{{ ucwords($client_name) }} {{ ucwords($survey->form->name) }}</span> - <span class="text-{{ $approved ? 'success' : 'danger' }}">{{ $approved ? 'Approved' : 'Unapproved' }}</span>
                </div>
                @if(empty($plot_numbers))
                  <div class="alert alert-danger mb-4 border-0 text-white">No plot(s) added for this application.</div>
                @else
                  <div class="card border mb-4">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                      <div class="text-dark">
                        {{ empty($plot_numbers) ? 0 : (str_contains($plot_numbers, '-') ? count(explode('-', $plot_numbers)) : 1) }} Plot Number(s) in {{ ucwords($survey->layout->name) }}
                      </div>
                    </div>
                    <div class="card-body pb-2">
                      <div class="row d-flex flex-wrap">
                        <?php $plot_numbers = str_contains($plot_numbers, '-') ? explode('-', $plot_numbers) : $plot_numbers; ?>
                        @if(is_array($plot_numbers))
                          @foreach($plot_numbers as $number)
                            @if(!empty($number))
                              <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                                  {{ $number }}
                                </div>
                              </div>
                            @endif
                          @endforeach
                        @else
                          <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                            {{ $plot_numbers }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                @endif
                @if(empty($payment))
                  <div class="alert alert-danger mb-4 text-white d-flex justify-content-between">No Payment made for this application.</div>
                @else
                  <?php $payment_approved = true === (boolean)$payment->approved; ?>
                  <div class="card border mb-4">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                      <div class="text-dark">
                        Total Amount: NGN{{ number_format($payment->amount) }}
                      </div>
                      <div class="text-dark">
                        <span class="text-success">{{ $paid ? 'Paid' : 'Unpaid' }}</span> ({{ $payment_approved ? 'Approved' : 'Unapproved' }})
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        @if($payment_approved)
                          <div class="alert alert-success w-100 m-0 text-white">Payment Approved By {{ $payment->approver ? $payment->approver->staff->fullname : '' }} on {{ date("F j, Y, g:i a", strtotime($payment->approved_at)) }}</div>
                        @else
                          <div class="approve-payment" data-url="{{ route('admin.payment.approve', ['model' => $model, 'model_id' => $model_id, 'client_id' => $client_id, 'reference' => $payment->reference]) }}">
                            <a href="javascript:;" class="btn btn-primary approve-payment-button btn-block mb-0 w-100">
                              <img src="/images/spinner.svg" class="me-2 d-none approve-payment-spinner mb-1">Approve payment
                            </a>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                @endif
                <?php $documents = $survey->documents; ?>
                <div class="">
                  @if(empty($documents->count()))
                    <div class="alert alert-danger text-white mb-4">No documents uploaded yet.</div>
                  @else
                    <div class="alert alert-dark d-flex align-items-center justify-content-between mb-4">
                      <span class="text-white">Uploaded Document(s)</span>
                    </div>
                    <div class="row">
                      @foreach($documents as $document)
                        <div class="col-12 col-md-4 mb-4">
                          @include('admin.documents.partials.card')
                        </div>
                      @endforeach
                    </div>
                  @endif
                </div>
                <div class="">
                  <div class="survey-form">
                    <div class="card border mb-4">
                      <div class="card-header border-bottom">Client or Allottee Details</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-6 input-group-lg">
                            <label class="text-muted">Client or Allottee Name</label>
                            <input readonly type="text" class="form-control client_name" name="client_name" placeholder="Enter client or allottee name" name="client_name" value="{{ $survey->client_name }}">
                            <small class="client_name-error text-danger"></small>
                          </div>
                          <div class="form-group col-md-6 input-group-lg">
                            <label class="text-muted">Client or Allottee Phone</label>
                            <input readonly type="text" class="form-control client_phone" name="client_phone" placeholder="Enter client or allottee name" name="client_phone" value="{{ $survey->client_phone }}">
                            <small class="client_phone-error text-danger"></small>
                          </div>
                        </div>
                        <div class="form-group input-group-lg">
                          <label class="text-muted">Client or Allottee Address</label>
                          <input readonly type="text" class="form-control client_address" name="client_address" placeholder="Enter client or allottee address" value="{{ $survey->client_address }}" />
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
                            <input readonly type="text" class="form-control seller_name" name="seller_name" placeholder="Enter seller or donor name" name="seller_name" value="{{ $survey->seller_name }}">
                            <small class="seller_name-error text-danger"></small>
                          </div>
                          <div class="form-group input-group-lg col-md-6">
                          <label class="text-muted">Land Seller or Donor Phone number</label>
                          <input readonly type="text" class="form-control seller_phone" name="seller_phone" placeholder="Enter seller or donor number" name="seller_phone" value="{{ $survey->seller_phone }}">
                          <small class="seller_phone-error text-danger"></small>
                        </div>
                        </div>
                        <div class="form-group input-group-lg">
                          <label class="text-muted">Land Seller or Donor Address</label>
                          <input readonly type="text" class="form-control seller_address" name="seller_address" placeholder="Enter seller or donor address" value="{{ $survey->seller_address }}" />
                          <small class="seller_address-error text-danger"></small>
                        </div>
                      </div>
                    </div>
                    <div class="alert d-none survey-message mb-4 text-white"></div>
                    @if($approved)
                      <div class="alert alert-success text-white mb-4">Approved by {{ $survey->approver ? $survey->approver->staff->fullname : '' }} on {{ date("F j, Y, g:i a", strtotime($survey->approved_at)) }}</div>
                      <a href="{{ route('admin.survey.pdf', ['id' => $model_id]) }}" class="btn btn-dark btn-block btn-lg w-100">Generate As Pdf</a>
                    @else
                      @if($paid)
                        <div class="approve-survey" data-url="{{ route('admin.survey.approve', ['id' => $model_id]) }}">
                          <button class="btn btn-primary btn-lg w-100 approve-survey-button mb-0">
                            <img src="/images/spinner.svg" class="me-2 d-none approve-survey-spinner mb-1">Approve Survey
                          </button>
                        </div>
                      @endif
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                @if($approved)
                  <?php $pcf = $survey->pcf; ?>
                  @if(empty($pcf))
                    <div class="alert alert-dark d-flex align-items-center justify-content-between text-white border-0 mb-4">
                      <span class="text-white">Plan Collection.</span>
                      <a href="javascript:;" class="text-white" data-bs-toggle="modal" data-bs-target="#record-plan">Record Plan</a>
                    </div>
                    @include('admin.pcfs.partials.add')
                    <div class="alert alert-danger text-white border-0">Plan not collected yet.</div>
                  @else
                    <?php $issued = true === (boolean)$pcf->issued; ?>
                    <div class="alert alert-dark text-white d-flex align-items-center justify-content-between border-0 mb-4">
                      <span class="text-white">Plan Collection</span>
                      <span class="text-{{ $issued ? 'success' : 'danger' }}">{{ $issued ? 'Collected' : 'Not Collected' }}</span>
                    </div>
                    @include('admin.pcfs.partials.card')
                  @endif
                @endif
              </div>
            </div>
          </div>
        @endif
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>