<div class="card shadow-lg z-index-2 bg-transparent">
  <div class="card-body d-flex justify-content-center flex-column border-radius-lg h-100" style="background-image: url('/argon/images/3.jpg'); background-size: cover; background-position: center; height: 280px !important; object-fit: cover;">
    <a href="{{ route("admin.$form->category") }}" class="text-white mb-4 d-block">
      {{ ucwords($form->name) }}
    </a>
    <div class="d-flex align-items-center">
      <div class="d-flex align-items-center">
        <div class="bg-warning text-center me-3 rounded-circle" style="width: 42px; height: 42px; line-height: 42px !important; font-size: 12px;">
          <div class="text-white mt-3">
            <i class="icofont-ui-edit"></i>
          </div>
        </div>
      </div>
       <a href="{{ route("admin.$form->category") }}" class="d-flex align-items-center">
         <div class="bg-success px-4 text-center rounded-pill" style="height: 42px; font-size: 14px;">
          <div class="text-white mt-3">
            <i class="icofont-long-arrow-right"></i>
          </div>
        </div>
       </a> 
    </div>
  </div>
</div>