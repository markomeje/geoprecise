<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        @if(empty($plan) || empty($plan->layout))
          <div class="alert alert-danger text-white mt-4 border-0">Unkown error. Try again.</div>
        @else
            <div class="p-4 bg-white">
                <?php $model_id = $plan->id; $model = 'plan'; $layout = $plan->layout; $plot_numbers = $plan->plot_numbers;?>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="alert alert-dark mb-4 text-white border-0 d-flex justify-content-between align-items-center">
                            <div class="text-white">Plan Details in {{ ucwords($layout->name) }}</div>
                        </div>
                        <div class="card-header pb-0 border-bottom bg-transparent">
                            <div class="row">
                            <div class="col-12 mb-4">
                                <div class="cursor-pointer w-100 text-center text-white d-block bg-primary border border-primary p-4" data-bs-toggle="modal" data-bs-target="#add-client-plot">Add Plot Number(s)</div>
                            </div>
                            </div>
                        </div>
                        <?php $route = route('admin.plan.plot.add', ['model_id' => $model_id, 'model' => $model]); ?>
                        @include('client.plots.partials.add')
                        @if(empty($plot_numbers))
                            <div class="alert alert-danger text-white mb-4" role="alert">No plots added yet</div>
                        @else
                            <?php $plot_numbers = str_contains($plot_numbers, '-') ? explode('-', $plot_numbers) : $plot_numbers; ?>
                            <div class="card border mb-4">
                                <div class="card-header border-bottom">
                                    <div class="text-dark">Plots Lifted</div>
                                </div>
                                <div class="card-body pb-2">
                                @if(is_array($plot_numbers))
                                    <div class="row">
                                        @foreach($plot_numbers as $number)
                                            @if(!empty($number))
                                                <div class="col-12 col-md-6 mb-4">
                                                    <div class="bg-dark rounded-0 border d-flex align-items-center justify-content-between p-3 text-white">
                                                        ({{ $number }})
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-dark rounded-0 border mb-4 d-flex align-items-center justify-content-between p-3 text-white">
                                        ({{ $plot_numbers }})
                                    </div>
                                @endif
                                </div>
                            </div>
                        @endif
                    <div class="card border mb-4">
                        <div class="card-header border-bottom">Edit Plan Details</div>
                        <div class="card-body">
                        <form class="save-plan-form" action="javascript:;" method="post" data-action="{{ route('admin.plan.save', ['id' => $model_id]) }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                <label class="text-muted">Client Name</label>
                                <input type="text" name="client_name" class="form-control client_name" placeholder="Enter client name" value="{{ $plan->client_name }}">
                                <small class="client_name-error text-danger"></small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                <label class="text-muted">Plan Number</label>
                                <input type="text" name="plan_number" class="form-control plan_number" placeholder="Enter plan numbers" value="{{ $plan->plan_number }}">
                                <small class="plan_number-error text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-muted">Layout Name</label>
                                    <select class="form-control layout" name="layout">
                                        <option value="">Select layout</option>
                                        <?php $layouts = \App\Models\Layout::all(); ?>
                                        @if(empty($layouts->count()))
                                        <option value="">No layouts listed</option>
                                        @else
                                        @foreach($layouts as $area)
                                            <option value="{{ $area->id }}" {{ $layout->id == $area->id ? 'selected' : '' }}>
                                            {{ ucwords($area->name) }}
                                            </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small class="layout-error text-danger"></small>
                                </div>
                            </div>
                            <div class="alert d-none add-plan-message mb-2 text-white"></div>
                            <button type="submit" class="btn btn-primary mt-2 btn-lg w-100 save-plan-button mb-0">
                                <img src="/images/spinner.svg" class="me-2 d-none save-plan-spinner mb-1">Save
                            </button>
                        </form>
                        </div>
                    </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="alert alert-dark text-white mb-4 border-0">Other Plans</div>
                        <?php $plans = \App\Models\Plan::where('id', '!=', $model_id)->take(6)->get(); ?>
                        @if(empty($plans->count()))
                        <div class="alert alert-danger text-white mb-4 border-0">No other plans</div>
                        @else
                            <div class="row">
                                @foreach($plans as $plan)
                                    <div class="col-lg-12 col-md-4 col-12 mb-4">
                                        @include('admin.plans.partials.card')
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
          </div>
        @endif
      </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>