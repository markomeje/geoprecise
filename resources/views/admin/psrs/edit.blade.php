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
          <?php $client_name = $psr->client->fullname; $model_id = $psr->id; $model = 'psr'; $layout = $psr->layout; $plot_numbers = $psr->plot_numbers; $client_id = $psr->client->id ?? 0; ?>
          <div class="row">
            <div class="col-12 col-lg-7 col-xl-6">
              <div class="alert alert-dark mb-4 text-white border-0">Property Search Request for {{ ucwords($client_name) }}</div>
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
                    <div class="alert d-none psr-message text-white"></div>
                    <button type="submit" class="btn mb-0 btn-primary psr-button">
                      <img src="/images/spinner.svg" class="me-2 d-none psr-spinner mb-1">Save
                    </button>
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
                      <div class="col-xl-6 col-md-4 col-12 mb-4">
                        @include('admin.psrs.partials.card')
                      </div>
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