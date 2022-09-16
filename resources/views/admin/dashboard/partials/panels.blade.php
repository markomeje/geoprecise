<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <div class="card">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-8">
          <div class="numbers">
            <a href="{{ route('admin.clients') }}">
              <p class="text-sm mb-0 font-weight-bold">All Clients</p>
            </a>
            <h5 class="font-weight-bolder">
              {{ \App\Models\Client::count() }}
            </h5>
          </div>
        </div>
        <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <div class="card">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-8">
          <div class="numbers">
            <a href="{{ route('admin.payments') }}">
              <p class="text-sm mb-0 font-weight-bold">All payments</p>
            </a>
            <h5 class="font-weight-bolder">
              NGN{{ number_format(\App\Models\Payment::paid()->pluck('amount')->sum()) }}
            </h5>
          </div>
        </div>
        <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <div class="card">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-8">
          <div class="numbers">
            <a href="{{ route('admin.staff') }}">
              <p class="text-sm mb-0 font-weight-bold">All Staff</p>
            </a>
            <h5 class="font-weight-bolder">
              {{ \App\Models\Staff::count() }}
            </h5>
          </div>
        </div>
        <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <div class="card">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-8">
          <div class="numbers">
            <a href="{{ route('admin.plots') }}">
              <p class="text-sm mb-0 font-weight-bold">All Plots</p>
            </a>
            <h5 class="font-weight-bolder">
              {{ \App\Models\Plot::count() }}
            </h5>
          </div>
        </div>
        <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      