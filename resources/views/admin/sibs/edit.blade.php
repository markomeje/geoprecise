<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($sib) || empty($sib->client) || empty($sib->plan))
          <div class="alert alert-danger text-white mt-4 border-0">Unkown error. Details may have been deleted.</div>
        @else
          <?php $plan = $sib->plan; $client_name = $sib->client->fullname; $model_id = $sib->id; $model = 'sib'; $layout = $plan->layout; $plot_numbers = $plan->plot_numbers; $client_id = $sib->client_id ?? 0; $approved = (boolean)$sib->approved === true; ?>
          <div class="row">
            <div class="col-12 col-lg-7">
                <div class="alert alert-dark mb-4 text-white border-0 d-flex justify-content-between align-items-center">
                <span>Site Inspection for {{ ucwords($client_name) }}</span>
                @if($approved)
                    <div class="text-success">Approved</div>
                @else
                  <span class="text-danger">Unapproved</span>
                @endif
              </div>
              <?php $plot_numbers = str_contains($plot_numbers, '-') ? explode('-', $plot_numbers) : $plot_numbers; ?>
              <div class="card mb-4">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                  <div class="text-dark">Plots Lifted</div>
                </div>
                <div class="card-body">
                  
                    @if(is_array($plot_numbers))
                        <div class="row">
                            @foreach($plot_numbers as $number)
                                @if(!empty($number))
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                                        {{ $number }}
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                            {{ $plot_numbers }}
                        </div>
                    @endif
                </div>
              </div>
              @if(!empty($plot_numbers))
                <?php $payment = $sib->payment; $amount = $sib->form ? ($sib->form->amount ?? 0) : 0; $plots = is_array($plot_numbers) ? count($plot_numbers) : 1; $total_amount = $plots * (int)$amount; ?>
                @include('admin.payments.partials.record')
                @if(empty($payment))
                    <a href="javascript:;" class="alert alert-danger">No Payment Yet</a>
                @else
                  <?php $paid = 'paid' === strtolower($payment->status ?? ''); $payment_approved = true === (boolean)$payment->approved ?>
                  <div class="card mb-4">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                      <div class="text-dark">
                        <span class="text-{{ $paid ? 'success' : 'danger' }}">{{ $paid ? 'Paid' : 'Unpaid' }}</span> NGN{{ number_format($total_amount) }}
                      </div>
                      <div class="text-{{ $payment_approved ? 'success' : 'danger' }}">
                        ({{ $payment_approved ? 'Approved' : 'Unapproved' }})
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        @if($paid)
                          @if($payment_approved)
                            <div class="alert alert-success w-100 m-0 text-white">Payment Approved on {{ date("F j, Y, g:i a", strtotime($payment->approved_at)) }}</div>
                          @else
                            <div class="approve-payment w-100" data-url="{{ route('admin.payment.approve', ['model' => $model, 'model_id' => $model_id, 'client_id' => $client_id, 'reference' => $payment->reference]) }}">
                              <a href="javascript:;" class="btn btn-primary approve-payment-button mb-0 w-100">
                                <img src="/images/spinner.svg" class="me-2 d-none approve-payment-spinner mb-1">Approve payment
                              </a>
                            </div>
                          @endif
                        @else
                          <a href="javascript:;" class="alert alert-danger">No Payment Yet</a>
                        @endif
                      </div>
                    </div>
                  </div>
                @endif
                @endif
                <div class="card mb-4">
                    <div class="card-header border-bottom">Edit Site Inspection Booking Details</div>
                    <div class="card-body">
                    <form class="save-sib-form" action="javascript:;" method="post" data-action="{{ route('admin.sib.save', ['id' => $sib->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Phone</label>
                                <input id="" class="form-control phone" type="text" name="phone" placeholder="Enter phone" value="{{ $sib->phone }}" readonly>
                                <small class="phone-error text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Address</label>
                                <input id="" class="form-control address" type="text" name="address" placeholder="Enter address" value="{{ $sib->address }}" readonly>
                                <small class="address-error text-danger"></small>
                            </div>
                        </div>
                        <div class="'form-group mb-3">
                        <label class="text-muted">Comments</label>
                        <textarea class="form-control comments" rows="4" name="comments" placeholder="Enter any comments" readonly>{{ $sib->comments }}</textarea>
                        <small class="comments-error text-danger"></small>
                        </div>
                        <div class="alert d-none save-sib-message text-white"></div>
                        @if($approved)
                        <div class="alert alert-success text-white my-4">Approved on {{ date("F j, Y, g:i a", strtotime($sib->approved_at)) }}</div>
                        @else
                        <label class="text-muted">Approve?</label>
                        <div class="form-group p-3 border mb-4 rounded">
                            <div class="form-check form-switch m-0">
                            <input class="form-check-input" name="approved" type="checkbox" id="approved" value="1" {{ $approved ? 'checked' : '' }}>
                            <label class="form-check-label" for="approved">{{ $approved ? 'Approved' : 'Approve Site Inspection' }}</label>
                            </div>
                            <small class="approved-error text-danger"></small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 save-sib-button mb-0">
                            <img src="/images/spinner.svg" class="me-2 d-none save-sib-spinner mb-1">Save
                        </button>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="alert alert-dark text-white mb-4 border-0">Other Request by {{ ucwords($client_name) }}</div>
                <?php $sibs = \App\Models\sib::where(['client_id' => $client_id])->take(6)->get(); ?>
                @if(empty($sibs->count()))
                  <div class="alert alert-danger text-white mb-4 border-0">No other Request available</div>
                @else
                    <div class="row">
                        @foreach($sibs as $sib)
                            @if($sib->id !== $model_id)
                                <div class="col-lg-12 col-md-4 col-12 mb-4">
                                @include('admin.sibs.partials.card')
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
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>