<div class="card shadow-lg z-index-2 bg-transparent">
  <div class="card-body d-flex justify-content-center align-items-start flex-column border-radius-lg h-100" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
    url('/argon/images/3.jpg'); background-size: cover; background-position: center; height: 280px !important; object-fit: cover;">
    <a href="javascript:;" class="text-white shadow-sm mb-3 d-block">
      {{ $form->name }} {{ empty($form->code) ? '' : '('.$form->code.')'; }}
    </a>
    @if(empty($form->fee))
      <a href="javascript:;" class="mb-3 w-100 btn btn-lg bg-primary text-white">Nill</a>
    @else
      <a href="" class="mb-3 w-100 btn btn-lg bg-primary text-white">
        NGN{{ number_format($form->fee->amount) }} {{ empty($form->fee->per) ? '' : '('.ucwords($form->fee->per).')' }}
      </a>
    @endif
  </div>
</div>