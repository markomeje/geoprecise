  <div class="card shadow-lg z-index-2 bg-transparent">
<a href="{{ route("admin.$form->category") }}" class="d-flex align-items-center">
    <div class="card-body d-flex justify-content-center flex-column border-radius-lg h-100" style="background-image: url('/images/dark.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center; height: 280px !important; object-fit: cover;">
      <div class="text-white mb-4 d-block">
        {{ ucwords($form->name) }}
      </div>
      <div class="d-flex align-items-center">
        <div class="bg-primary px-4 text-center rounded-pill py-2">
          <div class="text-white">
            View <i class="icofont-long-arrow-right"></i>
          </div>
        </div>
      </div>
    </div>
</a>
  </div>