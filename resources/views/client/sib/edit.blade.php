<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($sib) || empty($sib->client) || empty($sib->plan))
            <div class="alert alert-danger text-white mt-4 border-0">Unkown error. Try again.</div>
        @else
            <?php $plan = $sib->plan; $model_id = $sib->id; $model = 'sib'; $layout = $sib->layout; $approved = true === (boolean)($sib->approved ?? false); $completed = true === (boolean)($sib->completed ?? false); $plot_numbers = $sib->plot_numbers; $payment = $sib->payment; $paid = empty($payment) ? false : (strtolower($payment->status) === 'paid' ? true : false); $reference = request()->get('reference'); ?>
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
            <div class="col-12 col-lg-7 col-xl-6">
                <div class="alert alert-dark mb-4 text-white border-0 d-flex justify-content-between align-items-center">
                    <span class="">Inspection (P{{ $plan->plan_number  }}/{{ $plan->year }})</span>
                    @if($approved)
                        <div class="text-success">Approved</div>
                    @else
                        <span class="text-danger">Unapproved</span>
                    @endif
                </div>
                @if(empty($layout) || empty($layout->plots))
                    <?php $total_plots = 1; ?>
                @else
                    <div class="card mb-4">
                        <div class="card-header border-bottom bg-transparent">
                            @if($paid)
                                <div class="text-dark">Plot(s) for Inspection</div>
                            @else
                                <div class="row">
                                    <div class="col-12">
                                        <div class="cursor-pointer w-100 text-center text-white d-block bg-primary border border-primary p-4" data-bs-toggle="modal" data-bs-target="#add-client-plot">Select Plot(s) Numbers</div>
                                    </div>
                                </div>
                                <?php $route = route('client.plot.add', ['model_id' => $model_id, 'model' => $model]); ?>
                                @include('client.plots.partials.add')
                            @endif
                        </div>
                        <div class="card-body">
                            @if(empty($plot_numbers))
                                <?php $total_plots = 0; ?>
                                <div class="alert alert-danger border-0 text-white mb-0" role="alert">
                                    No Plot Numbers Selected
                                </div>
                            @else
                                <?php $plot_numbers = str_contains($plot_numbers, '-') ? explode('-', $plot_numbers) : $plot_numbers; $total_plots = is_array($plot_numbers) ? count($plot_numbers) : 1; ?>
                                @if(is_array($plot_numbers))
                                    <div class="row">
                                        @foreach($plot_numbers as $number)
                                            @if(!empty($number))
                                                <div class="col-12 col-md-6 mb-4">
                                                    <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                                                        <div class="">{{ $number }}</div>
                                                        @if(!$paid)
                                                            <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $number, 'model_id' => $model_id, 'model' => $model]) }}" data-message="Are you sure to delete?">
                                                                <i class="icofont-trash"></i>
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                                        <div class="">{{ $plot_numbers }}</div>
                                        @if(!$paid)
                                            <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $plot_numbers, 'model_id' => $model_id, 'model' => $model]) }}" data-message="Are you sure to delete?">
                                                <i class="icofont-trash"></i>
                                            </small>
                                        @endif
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
                @if(!empty($total_plots))
                    <?php $amount = $sib->form ? ($sib->form->amount ?? 0) : 0; $total_amount = $total_plots * (int)$amount; ?>
                    @if(empty($payment))
                        <div class="card border-0 mb-4">
                            <div class="card-header border-bottom">
                                Site Inspection of {{ $total_plots }}Plot(s) X NGN{{ number_format($amount) }} each. Total = NGN{{ number_format($total_amount) }}
                            </div>
                            <div class="card-body">
                                <form class="make-payment-form" action="javascript:;" method="post" data-action="{{ route('client.payment.process') }}">
                                    @csrf
                                    <input class="form-control" type="hidden" name="model" value="{{ $model }}">
                                    <input class="form-control" type="hidden" name="model_id" value="{{ $model_id }}">
                                    <input class="form-control" type="hidden" name="callback_url" value="{{ route('client.sib.edit', ['id' => $model_id])}}">
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
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="p-4 bg-white mb-4 border">
                            <?php $payment_approved = true === (boolean)$payment->approved ?>
                            @if($payment_approved)
                                <div class="alert alert-success w-100 m-0 text-white mb-0">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Approved on {{ date("F j, Y, g:i a", strtotime($payment->approved_at)) }}</div>
                            @else
                                <div class="alert alert-info mb-0 text-white">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Recieved. Awaiting Approval.</div>
                            @endif
                        </div>
                    @endif
                @endif
                <div class="card mb-4">
                    <div class="card-header border-bottom">Site Inspection Booking Details</div>
                    <div class="card-body">
                    <form class="save-sib-form" action="javascript:;" method="post" data-action="{{ route('client.sib.save', ['id' => $sib->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Phone</label>
                                <input id="" class="form-control phone" type="text" name="phone" placeholder="Enter phone" value="{{ $sib->phone }}" {{ $completed ? 'readonly' : '' }}>
                                <small class="phone-error text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Location</label>
                                <input id="" class="form-control location" type="text" name="location" placeholder="Enter location" value="{{ $sib->location }}" {{ $completed ? 'readonly' : '' }}>
                                <small class="location-error text-danger"></small>
                            </div>
                        </div>
                        <div class="'form-group mb-3">
                            <label class="text-muted">Comments</label>
                            <textarea class="form-control comments" rows="4" name="comments" placeholder="Enter any comments" {{ $completed ? 'readonly' : '' }}>{{ $sib->comments }}</textarea>
                            <small class="comments-error text-danger"></small>
                        </div>
                        <div class="alert d-none save-sib-message text-white"></div>
                        @if($completed)
                            @if($approved)
                                <div class="alert alert-success text-white my-4">Approved on {{ date("F j, Y, g:i a", strtotime($sib->approved_at)) }}</div>
                            @else
                                <div class="alert alert-success text-white my-4">Awaiting Inspection Approval</div>
                            @endif
                        @else
                            <label class="text-muted">Completed?</label>
                            <div class="form-group bg-warning p-3 border mb-4 rounded">
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" name="completed" type="checkbox" id="completed" value="1" {{ $approved ? 'checked' : '' }}>
                                    <label class="form-check-label text-white" for="completed">Final Submission?</label>
                                </div>
                                <small class="completed-error text-danger"></small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 save-sib-button mb-0">
                                <img src="/images/spinner.svg" class="me-2 d-none save-sib-spinner mb-1">Save
                            </button>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-6">
                <div class="alert alert-dark text-white mb-4 border-0">Other Inspections</div>
                <?php $sibs = \App\Models\Sib::where('id', '!=', $model_id)->where(['client_id' => $sib->client_id])->take(6)->get(); ?>
                @if(empty($sibs->count()))
                  <div class="alert alert-danger text-white mb-4 border-0">No Other Inspections available</div>
                @else
                  <div class="row">
                    @foreach($sibs as $sib)
                        <div class="col-md-6 col-12 mb-4">
                          @include('client.sib.partials.card')
                        </div>
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