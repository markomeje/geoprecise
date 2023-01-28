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
          <?php $form = $reprinting->form; $model_id = $reprinting->id; $model = 'reprinting'; $layout = $reprinting->layout; $plot_number = $reprinting->plot_number; $client_id = $reprinting->client_id ?? 0; $approved = (boolean)$reprinting->approved === true; $payment = $reprinting->payment; $paid = empty($payment) ? false : (strtolower($payment->status) === 'paid' ? true : false); ?>
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
              @if(!$paid)
                <div class="card mb-4 shadow-sm border ">
                  <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                    <span class="text-dark">Upload Land Document(s). Note that submission of fraudulent documents are at owners risk.</span>
                  </div>
                  <div class="card-body pb-0">
                    @include('client.documents.partials.add')
                  </div>
                </div>
              @endif
              <div class="">
                @if(empty($documents->count()))
                  @if(!$paid)
                    <div class="alert alert-danger text-white mb-4">No documents uploaded.</div>
                  @endif
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
                <form class="edit-reprinting-form" method="post" action="javascript:;" data-action="{{ route('client.reprinting.save', ['id' => $reprinting->id, 'code' => $reprinting->code]) }}">
                  @if($approved)
                    <div class="alert alert-success border-0 text-white mb-4">Approved on {{ date("F j, Y, g:i a", strtotime($reprinting->approved_at)) }}</div>
                  @else
                    <div class="alert alert-success border-0 text-white mb-4">Awaiting Approval of Reprinting Application.</div>
                  @endif
                <div class="card border-0 mb-4 shadow-sm">
                  <div class="card-header border-bottom"></div>
                  <div class="card-body">
                    <div class="row mb-2">
                      <div class="form-group col-12 col-md-6">
                        <label>Plot Number</label>
                        <select class="custom-select form-control plot_number" name="plot_number">
                          @if($paid)
                            <option value="{{ $reprinting->plot_number }}" readonly>
                              {{ $reprinting->plot_number }}
                            </option>
                          @else
                            <option value="">Select Plot Number</option>
                            <?php $plots = $layout->plots()->exists() ? $layout->plots : 0; ?>
                            @foreach($plots as $plot)
                              <option value="{{ $plot->number }}" {{ $reprinting->plot_number == $plot->number ? 'selected' : '' }}>
                                {{ $plot->number }}
                              </option>
                            @endforeach
                          @endif
                        </select>
                        <small class="plot_number-error text-danger"></small>
                      </div>
                      <div class="form-group col-12 col-md-6">
                        <label>Total Copies</label>
                        <input type="number" min="1" max="6" name="total_copies" value="{{ $reprinting->total_copies }}" {{ $paid ? 'readonly' : '' }} class="form-control total_copies" placeholder="Total copies">
                        <small class="total_copies-error text-danger"></small>
                      </div>
                    </div>
                    @if(!$paid)
                      <div class="form-check form-switch">
                        <input class="form-check-input me-2" name="agree" type="checkbox" id="agree" value="1" {{ $reprinting->agree ? 'checked' : '' }}>
                        <label class="form-check-label" for="agree">I here by accept the <a href="">Terms and Conditions</a></label>
                      </div>
                      <small class="agree-error text-danger"></small>
                    @endif
                  </div>
                  <div class="card-footer border-top">
                    @if($paid)
                      <div class="alert alert-info text-white mb-0">Application is Under review</div>
                    @else
                      <div class="alert d-none edit-reprinting-message mb-4 text-white"></div>
                      <button type="submit" class="btn btn-primary w-100 btn-lg edit-reprinting-button mb-0">
                        <img src="/images/spinner.svg" class="me-2 d-none edit-reprinting-spinner mb-1">
                        Next
                      </button>
                    @endif
                  </div>
                </div>
                </form>
              </div>
            </div>  
        @endif
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>