<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($reprinting) || empty($reprinting->client) || empty($reprinting->form))
          <div class="alert alert-danger text-white mt-4 border-0">Reprinting details not available</div>
        @else
          <?php $form = $reprinting->form; $model_id = $reprinting->id; $model = 'reprinting'; $layout = $reprinting->layout; $plot_number = $reprinting->plot_number; $client_id = $reprinting->client_id ?? 0; $approved = (boolean)$reprinting->approved === true; $payment = $reprinting->payment; $paid = empty($payment) ? false : (strtolower($payment->status) === 'paid' ? true : false); $reference = request()->get('reference'); ?>
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
            <div class="col-12 col-lg-8">
              <div class="alert alert-dark mb-4 text-white border-0">
                <span class="text-white">{{ ucwords($form->name) }}</span>
                <span class="text-{{ $approved ? 'success' : 'danger' }}">({{ $approved ? 'Approved' : 'Unapproved' }})</span>
              </div>
              @if(!empty($payment))
                <div class="">
                  <?php $payment_approved = true === (boolean)($payment->approved ?? false) ?>
                  @if($payment_approved)
                    <div class="alert alert-success border-0 w-100 m-0 text-white mb-4">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Approved on {{ date("F j, Y, g:i a", strtotime($payment->approved_at)) }}</div>
                  @else
                    <div class="alert alert-info border-0 mb-4 text-white">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Awaiting Approval</div>
                  @endif
                </div>
              @endif
              <?php $documents = $reprinting->documents; ?>
              <div class="">
                @if(!empty($documents->count()))
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
                <form class="edit-reprinting-form" method="post" action="javascript:;" data-action="{{ route('client.reprinting.save', ['id' => $reprinting->id, 'code' => $reprinting->code]) }}">
                  @if($approved)
                    <div class="alert alert-success text-white mb-4">Approved on {{ date("F j, Y, g:i a", strtotime($reprinting->approved_at)) }}</div>
                  @else
                    <div class="alert alert-success border-0 text-white mb-4">Awaiting Approval of Reprinting Application.</div>
                  @endif
                  <div class="card border-0 mb-4">
                    <div class="card-header border-bottom">Reprinting Details</div>
                    <div class="card-body">
                      <div class="row mb-2">
                        <div class="form-group col-12 col-md-6">
                          <label>Plot Number</label>
                          <select class="custom-select form-control plot_number" name="plot_number" readonly>
                            <option value="{{ $reprinting->plot_number }}">
                              {{ $reprinting->plot_number }}
                            </option>
                          </select>
                          <small class="plot_number-error text-danger"></small>
                        </div>
                        <div class="form-group col-12 col-md-6">
                          <label>Total Copies</label>
                          <input type="number" readonly min="1" max="6" name="total_copies" value="{{ $reprinting->total_copies }}" class="form-control total_copies" placeholder="Total copies">
                          <small class="total_copies-error text-danger"></small>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <?php $total_amount = $reprinting->total_copies * $form->amount; ?>
                <div class="card">
                  <div class="card-body">
                    <form class="make-payment-form" action="javascript:;" method="post" data-action="{{ route('client.payment.process') }}">
                      @csrf
                      <input class="form-control" type="hidden" name="model" value="{{ $model }}">
                      <input class="form-control" type="hidden" name="model_id" value="{{ $model_id }}">
                      <input class="form-control" type="hidden" name="callback_url" value="{{ route('client.reprinting.checkout', ['id' => $model_id])}}">
                      <div class="form-group">
                        <div class="form-group">
                          <label for="">Total Amount (NGN)</label>
                          <select id="" class="form-control amount" name="amount">
                              <option value="{{ $total_amount }}">
                                  NGN{{ number_format($total_amount) }}
                              </option>
                          </select>
                          <small class="amount-error text-danger"></small>
                        </div>
                      </div>
                      @if($paid)
                        <div class="alert alert-success mt-4 text-white">Payment Recieved.</div>
                      @else
                        <div class="mb-4">
                          <div class="form-check">
                            <input class="form-check-input agree" type="checkbox" value="1" id="CheckPayment" name="agree">
                            <label class="form-check-label" for="CheckPayment">I hereby agree to the terms and conditions.</label>
                          </div>
                          <small class="agree-error text-danger"></small>
                        </div>
                        <div class="alert d-none make-payment-message mb-4 text-white"></div>
                        <button type="submit" class="btn btn-primary w-100 make-payment-button">
                          <img src="/images/spinner.svg" class="me-2 d-none make-payment-spinner mb-1">Pay NGN{{ number_format($total_amount) }}
                        </button>
                      @endif
                    </form>
                  </div>
                </div>
              </div>
            </div>  
        @endif
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>