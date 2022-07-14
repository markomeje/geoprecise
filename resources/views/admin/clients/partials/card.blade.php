<div class="card border border-light bg-gray-100 shadow-lg border-raduis-sm">
    <!-- <div class="card-img d-block" style="height: 200px;">
      <img src="/argon/images/bg-profile.jpg" class="img-fluid w-100 h-100">
    </div> -->
    <div class="card-body p-3">
      <div class="">
          <?php $name = empty($client->name) ? '' : strtolower($client->name); ?>
          <div class="mb-3 d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.clients.profile', ['id' => $client->id, 'name' => \Str::slug($name)]) }}">
              {{ ucwords($name) }}
            </a>
            <a href="{{ route('admin.clients.profile', ['id' => $client->id, 'name' => \Str::slug($name)]) }}" class="text-dark">
              <i class="icofont-long-arrow-right"></i>
            </a>
          </div>
          <div class="row">
            <div class="col-6 col-sm-12 col-lg-6">
              <a href="tel:{{ $client->user->phone }}" class="btn d-flex align-items-center justify-content-center btn-dark">
                <small class="me-2">
                  <i class="ni ni-headphones text-primary text-sm opacity-10"></i>
                </small>
                <small class="text-white">Phone</small>
              </a>
            </div>
            <div class="col-6 col-sm-12 col-lg-6">
              <a href="mailto:{{ $client->user->email }}" class="btn d-flex align-items-center justify-content-center bg-gradient-info">
                <small class="me-2">
                  <i class="ni ni-email-83 text-primary text-sm opacity-10"></i>
                </small>
                <small class="text-white">Email</small>
              </a>
            </div>
          </div>
        </div>
    </div>
  </div>