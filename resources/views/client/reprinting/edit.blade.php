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
              {{-- <div class="card mb-4">
                @if(!$paid || empty($reprinting->plot_number))
                  <div class="card-header pb-0 border-bottom bg-transparent">
                    <div class="row">
                      <div class="col-12 mb-4">
                        <div class="cursor-pointer w-100 text-center text-white d-block bg-primary border border-primary p-4" data-bs-toggle="modal" data-bs-target="#add-client-plot">Select Plot Number to be Lifted.</div>
                      </div>
                    </div>
                  </div>
                @endif
                <?php $route = route('client.plot.add', ['model_id' => $model_id, 'model' => $model]); ?>
                @include('client.plots.partials.add')
                <div class="card-body pb-2">
                  @if(empty($reprinting->plot_number))
                    <div class="alert alert-danger mb-4 border-0 text-white">No plot(s) added for this application.</div>
                  @else
                    <div class="row d-flex flex-wrap">
                      <div class="col-12 col-md-6 col-xl-4 mb-4">
                        <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                          <div class="text-white">
                            {{ $plot_number }}
                          </div>
                          @if(!$paid)
                            <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $plot_number, 'model_id' => $model_id, 'model' => $model]) }}" data-message="Are you sure to delete?">
                              <i class="icofont-trash"></i>
                            </small>
                          @endif
                        </div>
                      </div>
                    </div>
                  @endif
                </div>
              </div> --}}
              @if(!empty($payment))
                <div class="">
                  <?php $payment_approved = true === (boolean)($payment->approved ?? false) ?>
                  @if($payment_approved)
                    <div class="alert alert-success w-100 m-0 text-white mb-4">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Approved on {{ date("F j, Y, g:i a", strtotime($payment->approved_at)) }}</div>
                  @else
                    <div class="alert alert-info mb-4 text-white">Payment of <span class="font-weight-bolder">NGN{{ number_format($payment->amount) }}</span> Awaiting Approval</div>
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
                <form class="reprinting-form" method="post" action="javascript:;" data-action="{{ route('client.reprinting.save', ['id' => $reprinting->id, 'code' => $reprinting->code]) }}">
                  <div class="alert d-none reprinting-message mb-4 text-white"></div>
                  @if($paid)
                      @if($approved)
                        <div class="alert alert-success text-white mb-4">Approved on {{ date("F j, Y, g:i a", strtotime($reprinting->approved_at)) }}</div>
                      @else
                        <div class="alert alert-success text-white mb-4">Awaiting Approval of reprinting Application.</div>
                      @endif
                  @else
                    <div class="row">
                      <div class="form-group col-6">
                        <input type="text" name="">
                        <small class="agree-error text-danger"></small>
                      </div>
                      <div class="form-group col-6">
                        <input type="text" name="">
                        <small class="agree-error text-danger"></small>
                      </div>
                    </div>
                    <div class="card border-0 mb-4 shadow-sm">
                      <div class="card-header border-bottom">By clicking the switch below, you agree to <a href="" class="text-primary">Our terms and conditions</a>.</div>
                      <div class="card-body">
                        <div class="form-check form-switch">
                          <input class="form-check-input me-2" name="agree" type="checkbox" id="agree" value="1" {{ $reprinting->agree ? 'checked' : '' }}>
                          <label class="form-check-label" for="agree">I here by accept the <a href="">Terms and Conditions</a></label>
                        </div>
                        <small class="agree-error text-danger"></small>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 btn-lg reprinting-button mb-0">
                        <img src="/images/spinner.svg" class="me-2 d-none reprinting-spinner mb-1">
                        Next
                    </button>
                  @endif
                </form>
              </div>
            </div>
            <div class="col-12 col-lg-4 mb-4">
                <?php $reprintings = \App\Models\Reprinting::latest('created_at')->where(['client_id' => $client_id])->where('id', '!=', $model_id)->get(); ?>
                @if(empty($reprintings->count()))
                  <div class="alert alert-info mb-4 border-0 text-white">Other applications appears here</div>
                @else
                  <div class="alert alert-info mb-4 border-0 text-white">Previous Reprinting Applications</div>
                  <div class="row">
                    @foreach($reprintings as $reprinting)
                      @if($reprinting->id !== (int)$model_id)
                        <div class="col-12 col-md-6 col-lg-12 mb-4">
                          @include('client.reprinting.partials.card')
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