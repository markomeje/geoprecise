<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($psr) || empty($psr->client))
          <div class="alert alert-danger text-white mt-4 border-0">Unkown error. Details may have been deleted.</div>
        @else
          {{-- {{ dd($psr) }} --}}
          <?php $client_name = $psr->client->fullname; $model_id = $psr->id; $model = 'psr'; $layout = $psr->layout; $plot_numbers = $psr->plot_numbers; $client_id = $psr->client_id ?? 0; $approved = (boolean)$psr->approved === true; ?>
          <div class="row">
            <div class="col-12 col-lg-7 col-xl-6">
              <div class="alert alert-dark mb-4 text-white border-0 d-flex justify-content-between align-items-center">
                <span>Property Search Request for {{ ucwords($client_name) }}</span>
                <span>{{ $approved ? 'Approved' : 'Unapproved' }}</span>
              </div>
              <div class="card mb-4">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                  <div class="text-dark">
                    {{ empty($plot_numbers) ? 0 : (str_contains($plot_numbers, '-') ? count(explode('-', $plot_numbers)) : 1) }} Plot(s)
                  </div>
                  <span class="cursor-pointer text-dark" data-bs-toggle="modal" data-bs-target="#add-client-plot">Add Plot(s)</span>
                </div>
                <?php $route = route('admin.client.plot.add', ['model_id' => $model_id, 'model' => $model]); ?>
                @include('client.plots.partials.add')
                <div class="card-body">
                    <?php $plots = \App\Models\Plot::all(); ?>
                    @if(empty($psr->plot_numbers))
                      <div class="alert alert-info m-0 border-0 text-white">No plot(s) added for this application.</div>
                    @else
                      <div class="row d-flex flex-wrap g-0">
                      <?php $plot_numbers = str_contains($psr->plot_numbers, '-') ? explode('-', $psr->plot_numbers) : $psr->plot_numbers; ?>
                      @if(is_array($plot_numbers))
                        <?php $count = 1; ?>
                        @foreach($plot_numbers as $number)
                          @if(!empty($number))
                            <div class="col-6 col-md-4 col-lg-3">
                              <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                                <small class="tiny-font">
                                  ({{ $count++ }}) {{ $number }}
                                </small>
                                <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('admin.client.plot.delete', ['plot_number' => $number, 'model_id' => $model_id, 'model' => $model]) }}" data-message="Are you sure to delete?">
                                  <i class="icofont-trash"></i>
                                </small>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      @else
                        <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                          <small class="">{{ $plot_numbers }}</small>
                          <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('admin.client.plot.delete', ['plot_number' => $plot_numbers, 'model_id' => $model_id, 'model' => $model]) }}" data-message="Are you sure to delete?">
                            <i class="icofont-trash"></i>
                          </small>
                        </div>
                      @endif
                  </div>
                    @endif
                </div>
              </div>
              @if(!empty($plot_numbers))
                <?php $amount = $psr->form ? ($psr->form->amount ?? 0) : 0; $total_plots = is_array($plot_numbers) ? count($plot_numbers) : 1; $total_amount = $total_plots * (int)$amount; ?>
                @include('admin.payments.partials.record')
                @if(empty($psr->payment))
                  <div class="alert alert-dark mb-4 text-white d-flex justify-content-between">
                    <span class="text-white">Total: NGN{{ number_format($total_amount) }} Unpaid</span>
                    <a href="javascript:;" class="m-0 text-white" data-bs-toggle="modal" data-bs-target="#admin-record-payment">Record Payment</a>
                  </div>
                @else
                  <?php $payment = $psr->payment; $payment_status = $payment->status ?? 'Unpaid'; $payment_approved = true === (boolean)$payment->approved ?>
                  <div class="card mb-4">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                      <div class="text-dark">
                        Total: NGN{{ number_format($total_amount) }}
                      </div>
                      <div class="text-dark">
                        <span class="text-success">{{ ucwords($payment_status) }}</span> ({{ $payment_approved ? 'Approved' : 'Unapproved' }})
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        @if($payment_approved)
                          <div class="alert alert-success w-100 m-0 text-white">Payment Approved By {{ $payment->approver ? $payment->approver->staff->fullname : '' }} on {{ date("F j, Y, g:i a", strtotime($payment->approved_at)) }}</div>
                        @else
                          <div class="approve-payment" data-url="{{ route('admin.payment.approve', ['model' => $model, 'model_id' => $model_id, 'client_id' => $client_id, 'reference' => $payment->reference]) }}">
                            <a href="javascript:;" class="btn btn-primary approve-payment-button mb-0">
                              <img src="/images/spinner.svg" class="me-2 d-none approve-payment-spinner mb-1">Approve payment
                            </a>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                @endif
              @endif
              <div class="card mb-4">
                <div class="card-header border-bottom">Edit Property Search Request Details</div>
                <div class="card-body">
                  <form class="psr-form" action="javascript:;" method="post" data-action="{{ route('admin.psr.save', ['id' => $psr->id]) }}">
                    @csrf
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label class="text-muted">Status</label>
                        <select class="form-control status" name="status">
                          <option value="">Select status</option>
                          <?php $status = \App\Models\Psr::STATUS; ?>
                          @if(empty($status))
                            <option value="">No status listed</option>
                          @else
                            @foreach($status as $value)
                              <option value="{{ $value }}" {{ $value == $psr->status ? 'selected' : '' }}>
                                {{ ucwords($value) }}
                              </option>
                            @endforeach
                          @endif
                        </select>
                        <small class="status-error text-danger"></small>
                      </div>
                      <div class="form-group col-md-6">
                        <label class="text-muted">Layout</label>
                        <select class="form-control layout" name="layout">
                          <option value="">Select layout</option>
                          <?php $layouts = \App\Models\Layout::all(); ?>
                          @if(empty($layouts->count()))
                            <option value="">No layout listed</option>
                          @else
                            @foreach($layouts as $layout)
                              <option value="{{ $layout->id }}" {{ $psr->layout_id == $layout->id ? 'selected' : '' }}>
                                {{ ucwords($layout->name) }}
                              </option>
                            @endforeach
                          @endif
                        </select>
                        <small class="layout-error text-danger"></small>
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <label class="text-muted">Sold by?</label>
                      <input type="text" class="form-control sold_by" name="sold_by" rows="4" placeholder="Enter seller name" value="{{ $psr->sold_by }}">
                      <small class="sold_by-error text-danger"></small>
                    </div>
                    <div class="form-group">
                      <label class="text-muted">Comments</label>
                      <textarea class="form-control comments" rows="4" name="comments" placeholder="Enter comments">{{ $psr->comments }}</textarea>
                      <small class="comments-error text-danger"></small>
                    </div>
                    <div class="alert d-none psr-message text-white"></div>
                    @if(true === (boolean)$psr->completed && !$approved)
                      <div class="alert alert-success text-white my-4">Request Completed. Awaiting Approval.</div>
                    @endif
                    @if($approved)
                      <div class="alert alert-success text-white my-4">Approved by {{ $psr->approver ? $psr->approver->staff->fullname : '' }} on {{ date("F j, Y, g:i a", strtotime($psr->approved_at)) }}</div>
                    @else
                      <label class="text-muted">Approve?</label>
                      <div class="form-group p-3 border mb-4 rounded">
                        <div class="form-check form-switch m-0">
                          <input class="form-check-input" name="approved" type="checkbox" id="approved" value="1">
                          <label class="form-check-label" for="approved">Approve Property Search Request</label>
                        </div>
                        <small class="approved-error text-danger"></small>
                      </div>
                      <button type="submit" class="btn btn-primary btn-lg w-100 psr-button mb-0">
                        <img src="/images/spinner.svg" class="me-2 d-none psr-spinner mb-1">Save
                      </button>
                    @endif
                  </form>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-6">
                <div class="alert alert-dark text-white mb-4 border-0">Other Request by {{ ucwords($client_name) }}</div>
                <?php $other_psrs = \App\Models\Psr::where(['client_id' => $client_id])->take(6)->get(); ?>
                @if(empty($other_psrs->count()))
                  <div class="alert alert-danger text-white mb-4 border-0">No other Request available</div>
                @else
                  <div class="row">
                    @foreach($other_psrs as $psr)
                      @if($psr->id !== $model_id)
                        <div class="col-xl-6 col-md-4 col-12 mb-4">
                          @include('admin.psrs.partials.card')
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