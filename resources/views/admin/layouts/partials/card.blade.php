<div class="card shadow-lg">
    <div class="card-body p-0">
      <div class="image-overlay p-4 border-radius-lg" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url('/images/tar.jpg');">
          <?php $name = empty($layout->name) ? '' : strtolower($layout->name); ?>
          <div class="d-flex align-items-center mb-3 pb-3 border-bottom justify-content-between">
            <a href="{{ route('admin.layout.plots', ['id' => $layout->id, 'name' => \Str::slug($name)]) }}" class="text-white">
              {{ ucwords(\Str::limit($name, 16)) }}
            </a>
            <a href="{{ route('admin.layout.plots', ['id' => $layout->id, 'name' => \Str::slug($name)]) }}" class="text-white">
              <i class="icofont-long-arrow-right"></i>
            </a>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div class="text-white">
              {{ $layout->plots->count() > 0 ? $layout->plots->count() : 'No' }} Plots
            </div>
            <div class="form-check form-switch mb-3">
              <input class="form-check-input" type="checkbox" id="rememberme" {{ true === (boolean)$layout->active ? 'checked' : '' }}>
              <label class="form-check-label" for="rememberme"></label>
            </div>
          </div>
      </div>
    </div>
    <div class="card-footer d-flex align-items-center justify-content-between">
      <div>
        <small>{{ $layout->created_at->diffForHumans() }}</small>
      </div>
      <div class="d-flex align-items-center">
        <small class="text-primary cursor-pointer me-2" data-toggle="modal" data-target="#edit-layout-{{ $layout->id }}">
          <i class="icofont-edit"></i>
        </small>
        <small class="text-danger cursor-pointer">
          <i class="icofont-trash"></i>
        </small>
      </div>
    </div>
  </div>