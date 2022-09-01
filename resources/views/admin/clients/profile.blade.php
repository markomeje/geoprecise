<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($client))
          <div class="alert alert-danger d-block mb-4 text-white border-0">Unkwon error. Client details not found.</div>
          @if(!empty($clients))
            <div class="p-4 bg-white border-radius-lg">
              <h5 class="mb-4">Other Clients</h5>
              <div class="row">
                @foreach($clients as $client)
                  <div class="col-lg-3 col-md-4 col-12 mb-4">
                  @include('admin.clients.partials.card')
                </div>
                @endforeach
              </div>
            </div>
          @endif
        @else
          <?php $user_id = $client->user_id; ?>
          <div class="">
            <div class="mb-4 p-4 bg-white border-radius-lg">
              <div class="text-dark">
                {{ ucwords($client->fullname) }} Profile Details
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-7 col-lg-8 col-xl-9">
                <div class="">
                  <div class="alert alert-info text-white border-0 mb-4">Property Search Requests</div>
                  <?php $psrs = \App\Models\Psr::where(['user_id' => $user_id])->get(); ?>
                  @if(empty($psrs->count()))
                    <div class="alert alert-danger text-white border-0 mb-4">No Property Search Requests</div>
                  @else
                    <div class="row">
                        @foreach($psrs as $psr)
                          <div class="col-12 col-lg-6 col-xl-4 mb-4">
                              @include('admin.psrs.partials.card')
                          </div>
                        @endforeach
                    </div>
                  @endif
                </div>
                <div class="">
                    <div class="alert alert-info text-white border-0 mb-4 d-flex justify-content-between">
                      <span>Surveying applications</span>
                      <a href="{{ route('admin.survey.apply', ['user_id' => $user_id]) }}" class="text-white">Apply</a>
                    </div>
                  <?php $surveys = \App\Models\Survey::latest()->where(['user_id' => $user_id])->get(); ?>
                  @if(empty($surveys->count()))
                    <div class="alert alert-danger text-white border-0 mb-4">No Surveying applications.</div>
                  @else
                    <div class="row">
                        @foreach($surveys as $survey)
                          <div class="col-12 col-lg-6 col-xl-4 mb-4">
                              @include('admin.surveys.partials.card')
                          </div>
                        @endforeach
                    </div>
                  @endif
                </div>
              </div>
              <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                <div class="alert alert-info border-0 text-white mb-4">{{ ucwords($client->fullname) }} Payments</div>
                <?php $payments = \App\Models\Payment::latest()->paid()->where(['user_id' => $user_id])->get(); ?>
                @if(empty($payments->count()))
                  <div class="alert alert-danger border-0 text-white mb-4">{{ ucwords($client->fullname) }} Payments</div>
                @else
                  <div class="row">
                    @foreach($payments as $payment)
                      <div class="col-12 col-lg-12 mb-4">
                        @include('admin.payments.partials.card')
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>