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
          <?php $layout = $sib->layout; $plan = $sib->plan; $client_name = $sib->client->fullname; $model_id = $sib->id; $model = 'sib'; $plot_numbers = $sib->plot_numbers; $client_id = $sib->client_id ?? 0; $approved = (boolean)$sib->approved === true; $payment = $sib->payment; ?>
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
                @if(empty($layout) || empty($layout->plots))
                    <?php $total_plots = 1; ?>
                @else
                    <div class="card mb-4">
                        <div class="card-header border-bottom bg-transparent">
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
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                                        <div class="">{{ $plot_numbers }}</div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <div class="text-dark">Payment Details</div>
                        <div class="text-success">
                            {{ ucfirst($payment->status) }}
                        </div>
                    </div>
                    <div class="card-body">
                            @if(empty($payment))
                                <div class="alert alert-danger text-white mb-0">No Payment yet.</div>
                            @else
                                <div class="alert alert-info  text-white mb-0">
                                    NGN{{ number_format($payment->amount) }} {{ ucfirst($payment->status) }}
                                </div>
                            @endif
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header border-bottom">Site Inspection Booking Details</div>
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
                                <input id="" class="form-control address" type="text" name="address" placeholder="Enter address" value="{{ $sib->address ?? 'Nill' }}" readonly>
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