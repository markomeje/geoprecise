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
          <?php $client_id = $survey->client->id; $model_id = $survey->id; $model = 'survey'; $completed = (boolean)$survey->completed; $plot_numbers = $survey->plot_numbers; $client_name = $survey->client->fullname; $approved = (true === (boolean)$survey->approved); ?>
          <div class="">
            <div class="row">
              <div class="col-12 col-lg-8 mb-4">
                <div class="alert alert-dark mb-4 text-white border-0 d-flex justify-content-between align-items-center">
                  <span>Survey or Lifting for {{ ucwords($client_name) }}</span>
                  <span>Survey {{ $approved ? 'Approved' : 'Unapproved' }}</span>
                </div>
                <div class="card shadow mb-4">
                  <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <div class="text-dark">
                      {{ empty($plot_numbers) ? 0 : (str_contains($plot_numbers, '-') ? count(explode('-', $plot_numbers)) : 1) }} Plot(s)
                    </div>
                    <span class="cursor-pointer text-dark" data-bs-toggle="modal" data-bs-target="#add-client-plot">Add Plot</span>
                  </div>
                  <?php $route = route('admin.client.plot.add', ['model_id' => $model_id, 'model' => $model]); $layout = $survey->layout; ?>
                  @include('client.plots.partials.add')
                    <div class="card-body">
                      @if(empty($plot_numbers))
                        <div class="alert alert-danger m-0 border-0 text-white">No plot(s) added for this application.</div>
                      @else
                        <div class="row d-flex flex-wrap g-0">
                          <?php $plot_numbers = str_contains($plot_numbers, '-') ? explode('-', $plot_numbers) : $plot_numbers; ?>
                          @if(is_array($plot_numbers))
                            <?php $count = 1; ?>
                            @foreach($plot_numbers as $number)
                              @if(!empty($number))
                                <div class="col-6 col-md-4 col-lg-3">
                                  <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                                    <small class="tiny-font">
                                      ({{ $count++ }}) {{ $number }}
                                    </small>
                                    <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('admin.client.plot.delete', ['plot_number' => $number, 'model_id' => $survey->id, 'model' => 'survey']) }}" data-message="Are you sure to delete?">
                                      <i class="icofont-trash"></i>
                                    </small>
                                  </div>
                                </div>
                              @endif
                            @endforeach
                          @else
                            <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                              <small class="">{{ $plot_numbers }}</small>
                              <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('admin.client.plot.delete', ['plot_number' => $plot_numbers, 'model_id' => $survey->id, 'model' => 'survey']) }}" data-message="Are you sure to delete?">
                                <i class="icofont-trash"></i>
                              </small>
                            </div>
                          @endif
                        </div>
                      @endif
                    </div>
                </div>
                @if(!empty($plot_numbers))
                  <?php $payment = \App\Models\Payment::where(['model' => $model, 'model_id' => $model_id])->first(); ?>
                  <?php $amount = $survey->form ? ($survey->form->amount ?? 0) : 0; $total_plots = is_array($plot_numbers) ? count($plot_numbers) : 1; $total_amount = $total_plots * (int)$amount; ?>
                  @include('admin.payments.partials.record')
                  @if(empty($payment))
                    <div class="alert alert-dark mb-4 text-white d-flex justify-content-between">
                      <span class="text-white">Total: NGN{{ number_format($total_amount) }} Unpaid</span>
                      <a href="javascript:;" class="m-0 text-white" data-bs-toggle="modal" data-bs-target="#admin-record-payment">Record Payment</a>
                    </div>
                  @else
                    <?php $payment_status = $payment->status ?? 'Unpaid'; $payment_approved = true === (boolean)$payment->approved ?>
                    <div class="card mb-4">
                      <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <div class="text-dark">
                          Total: NGN{{ number_format($total_amount) }}
                        </div>
                        <div class="text-dark">
                          {{ ucwords($payment_status) }} ({{ $payment_approved ? 'Approved' : 'Unapproved' }})
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          @if($payment_status == 'paid')
                            @if($payment_approved)
                              <div class="alert alert-success w-100 m-0 text-white">Payment Approved By {{ $payment->approver ? $payment->approver->staff->fullname : '' }} on {{ date("F j, Y, g:i a", strtotime($payment->approved_at)) }}</div>
                            @else
                              <div class="approve-payment" data-url="{{ route('admin.payment.approve', ['model' => $model, 'model_id' => $model_id, 'client_id' => $client_id, 'reference' => $payment->reference]) }}">
                                <a href="javascript:;" class="btn btn-primary approve-payment-button mb-0">
                                  <img src="/images/spinner.svg" class="me-2 d-none approve-payment-spinner mb-1">Approve payment
                                </a>
                              </div>
                            @endif
                          @else
                            <a href="javascript:;" class="m-0 btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-record-payment">Record Payment</a>
                          @endif
                        </div>
                      </div>
                    </div>
                  @endif
                @endif
                <?php $documents = $survey->documents; ?>
                @if(!$approved)
                  <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                      <span>Upload Document(s)</span>
                      <span>{{ $documents->count() }} Uploaded</span>
                    </div>
                    <div class="card-body pb-0">
                      @include('admin.documents.partials.add')
                    </div>
                  </div>
                @endif
                <div class="">
                  @if(empty($documents->count()))
                    <div class="alert alert-danger text-white mb-4">No documents uploaded yet.</div>
                  @else
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
                  <div class="alert alert-info mb-4 border-0 text-white">Edit submitted Survey or Lifting Application</div>
                  <form class="survey-form" method="post" action="javascript:;" data-action="{{ route('admin.survey.save', ['id' => $survey->id]) }}">
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
                          <input type="text" class="form-control purchaser_address" name="purchaser_address" placeholder="Enter purchaser or allottee address" value="{{ $survey->purchaser_address }}" />
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
                          <input type="text" class="form-control seller_address" name="seller_address" placeholder="Enter seller or donor address" value="{{ $survey->seller_address }}" />
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
                    @if($approved)
                      <div class="alert alert-success text-white mb-4">Approved by {{ $survey->approver ? $survey->approver->staff->fullname : '' }} on {{ date("F j, Y, g:i a", strtotime($survey->approved_at)) }}</div>
                    @else
                      <div class="card border-0 mb-4 shadow-sm">
                        <div class="card-body">
                          <div class="form-check form-switch">
                            <input class="form-check-input" name="approved" type="checkbox" id="approved" value="1">
                            <label class="form-check-label" for="approved">Approve Survey</label>
                          </div>
                          <small class="approved-error text-danger"></small>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary btn-lg w-100 survey-button mb-0">
                          <img src="/images/spinner.svg" class="me-2 d-none survey-spinner mb-1">Save
                      </button>
                    @endif
                  </form>
                </div>
              </div>
              <div class="col-12 col-lg-4 col-xl-5"></div>
            </div>
          </div>
        @endif
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>