<div class="card shadow-lg z-index-2 bg-transparent" style="height: 280px !important;">
  <div class="card-body d-flex justify-content-center align-items-start flex-column border-radius-lg h-100 image-overlay" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
    url('/argon/images/3.jpg'); object-fit: cover;">
    <div class="d-flex">
      <a href="javascript:;" class="text-white shadow-sm mb-3">
        <small class="">
          {{ $form->name }}
        </small>
      </a>
    </div>
    <a href="{{ route("client.$form->category") }}" class="mb-3 w-100 px-0 btn btn-lg btn-block bg-primary text-white">
      <small>
        {{ 'NGN'.number_format($form->amount) }} {{ empty($form->per) ? '' : '('.ucwords($form->per).')' }}
      </small>
    </a>
  </div>
</div>