<div class="dashboard">
  @include('client.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('client.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('client.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <?php $reference = request()->get('reference'); ?>
        <div class="">
          <h4 class="mb-3 text-white">Your Payments
            @if(!empty($reference))
              <a href="{{ route('client.payments') }}" class="text-white">
                <small><i class="icofont-refresh"></i></small>
              </a>
            @endif
          </h4>
          <p class="text-white mb-4">Note that some payments might be awaiting approval after automatic verification.</p>
        </div>
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
          @if(empty($payments))
            <div class="alert alert-danger border-0 text-white">You have no payments yet</div>
          @else
            @foreach($payments as $payment)
              <div class="col-12 col-md-6 col-lg-4 mb-4">
                @include('client.payments.partials.card')
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </main>
    @include('client.includes.rightbar')
  @include('client.includes.footer')
</div>