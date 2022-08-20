<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($sib))
          <div class="alert alert-danger text-white mt-4 border-0">Details not available</div>
        @else
          <?php $completed = (boolean)$sib->completed; $id = $sib->id; ?>
          <div class="row">
            <div class="col-12 col-md-5 mb-4">
              @if(empty($sib->payment) || $sib->payment->status !== 'paid')
                <div class="alert alert-dark border-0 text-white cursor-pointer btn-lg mb-4" data-bs-toggle="modal" data-bs-target="#add-client-plot">Add Plot(s) for your application (+)</div>
              @else
                <div class="alert alert-dark border-0 text-white cursor-pointer btn-lg mb-4">Application in active</div>
              @endif
              <?php $model_id = $id; $model = 'sib'; ?> 
              @include('client.plots.partials.add')
              <div class="mb-4 p-4 bg-white shadow">
                <?php $plots = \App\Models\Plot::all(); ?>
                  @if(empty($sib->plot_numbers))
                    <div class="alert alert-danger m-0 border-0 text-white">No plot(s) added for your application.</div>
                  @else
                    <div class="row d-flex flex-wrap g-0">
                    <?php $plot_numbers = str_contains($sib->plot_numbers, '-') ? explode('-', $sib->plot_numbers) : $sib->plot_numbers; ?>
                    @if(is_array($plot_numbers))
                      <?php $count = 1; ?>
                      @foreach($plot_numbers as $number)
                        @if(!empty($number))
                          <div class="col-6 col-md-4 col-xl-3">
                            <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                              <small class="tiny-font">
                                ({{ $count++ }}) {{ $number }}
                              </small>
                              <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $number, 'model_id' => $sib->id, 'model' => 'sib']) }}" data-message="Are you sure to delete?">
                                <i class="icofont-trash"></i>
                              </small>
                            </div>
                          </div>
                        @endif
                      @endforeach
                    @else
                      <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                        <small class="">{{ $plot_numbers }}</small>
                        <small class="text-danger tiny-font cursor-pointer client-delete-plot" data-url="{{ route('client.plot.delete', ['plot_number' => $plot_numbers, 'model_id' => $sib->id, 'model' => 'sib']) }}" data-message="Are you sure to delete?">
                          <i class="icofont-trash"></i>
                        </small>
                      </div>
                    @endif
                    @if(empty($sib->payment))
                      @if(!empty($sib->form))
                        @if(!empty($sib->form->amount))
                          <?php $total_plots = is_array($plot_numbers) ? count($plot_numbers) : 1; $amount = $total_plots * (int)$sib->form->amount; ?>
                          <div class="mt-4 make-payment" data-url="{{ route('payment.process', ['form_id' => $sib->form->id, 'type' => 'form', 'model_id' => $sib->id, 'model' => 'sib', 'amount' => $amount]) }}">
                            <button class="btn btn-primary make-payment-button">
                              <img src="/images/spinner.svg" class="me-2 d-none make-payment-spinner mb-1"> Pay NGN{{ number_format($amount) }}
                            </button>
                          </div>
                        @endif
                      @endif
                    @elseif($sib->payment->status !== 'paid')
                      @if(!empty($sib->form))
                        @if(!empty($sib->form->amount))
                          <?php $total_plots = is_array($plot_numbers) ? count($plot_numbers) : 1; $amount = $total_plots * (int)$sib->form->amount; ?>
                          <div class="mt-4 make-payment" data-url="{{ route('payment.process', ['form_id' => $sib->form->id, 'type' => 'form', 'model_id' => $sib->id, 'model' => 'sib', 'amount' => $amount]) }}">
                            <button class="btn btn-primary make-payment-button">
                              <img src="/images/spinner.svg" class="me-2 d-none make-payment-spinner mb-1"> Pay NGN{{ number_format($amount) }}
                            </button>
                          </div>
                        @endif
                      @endif
                    @else
                      {{-- <div class=""> --}}
                        <div class="col-12 col-md-6">
                          <div class="alert alert-success mt-3 text-white">
                            <small>Paid NGN{{ number_format($sib->payment->amount) }}</small>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          @if(false === (boolean)$sib->payment->verified)
                            <div class="alert alert-warning mt-3 text-white">
                              <small>Awaiting verificaion</small>
                            </div>
                          @else
                            <div class="alert alert-success mt-3 text-white">
                              <small>Payment verified</small>
                            </div>
                          @endif
                        </div>
                      {{-- </div> --}}
                    @endif
                </div>
                  @endif
              </div>
            </div>
            <div class="col-12 col-md-7 mb-4">
              <?php $sibs = \App\Models\Sib::where(['user_id' => auth()->id()])->get(); ?>
                @if(empty($sibs->count()))
                  <div class="alert alert-info mb-4 border-0 text-white">Other related applications appears here</div>
                @else
                  <div class="alert alert-info mb-4 border-0 text-white">Submitted Site Inspection or Beacon Identifiation Applications</div>
                  <div class="row">
                    @foreach($sibs as $sib)
                      @if($sib->id !== $id)
                        <div class="col-12 col-md-6 col-xl-4 mb-4">
                          @include('client.sib.partials.card')
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