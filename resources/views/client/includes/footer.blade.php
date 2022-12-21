<!--   Core JS Files   -->
  <script src="{{ config('app.url') }}/argon/js/core/popper.min.js"></script>
  <script src="{{ config('app.url') }}/argon/js/core/bootstrap.min.js"></script>
  <script src="{{ config('app.url') }}/argon/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="{{ config('app.url') }}/argon/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ config('app.url') }}/argon/js/argon-dashboard.min.js?v=2.0.4"></script>
  <!-- For Bootstrap 5 -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  {{-- <script src="{{ config('app.url') }}/js/BsMultiSelect.min.js"></script> --}}

  {{-- Custom Js --}}
  <script src="{{ config('app.url') }}/custom/js/index.js"></script>
  <script src="{{ config('app.url') }}/custom/js/ajax.js"></script>
  <script src="{{ config('app.url') }}/custom/js/forms.js"></script>

   <script src="{{ config('app.url') }}/custom/js/dselect.js"></script>

  {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(function(){

      var uploadImage = $('.upload-document');
      if(uploadImage) {
        $('.upload-document').click(function() {
            uploader({target: $(this), button: 'upload-document', input: 'document-input', loader: 'document-loader', preview: 'document-preview'});
        });  
      }

      @if(!empty($documents))
        @foreach($documents as $document)
          $('.upload-document-{{ $document->id }}').click(function() {
            uploader({target: $(this), button: 'upload-document-{{ $document->id }}', input: 'document-input-{{ $document->id }}', loader: 'document-loader-{{ $document->id }}', preview: 'document-preview-{{ $document->id }}'});
        }); 

          $('.delete-document-{{ $document->id }}').on('click', function() {
              handleAjax({that: $(this), button: 'delete-document-button-{{ $document->id }}', spinner: 'delete-document-spinner-{{ $document->id }}'});    
          });
        @endforeach
      @endif

      @if(!empty($psrs))
        @foreach($psrs as $psr)
          $('.make-payment-{{ $psr->id }}').on('click', function() {
              handleAjax({that: $(this), button: 'make-payment-button-{{ $psr->id }}', spinner: 'make-payment-spinner-{{ $psr->id }}'});    
          });
        @endforeach
      @endif

    var filterSelect = document.querySelector('.filter-select');
    if(filterSelect) {
        dselect(filterSelect, {
            search: true
        });
    }
    

    });

    var form = $('#upload-document-form');
    if (form) {
      $(form).submit(function(event){
        event.preventDefault();
        console.log(form.attr('data-action'));
        var button = $('.upload-document-button');
        var spinner = $('.upload-document-spinner');
        var message = $('.upload-document-message');

        button.attr('disabled', true);
        spinner.removeClass('d-none');
        message.hasClass('d-none') ? '' : message.fadeOut();
        var formData = new FormData(form[0]);
        formData.append('document', $('input[type=file]')[0].files[0]);

          $.ajax({
              type: "post",
              url: form.attr('data-action'),
              data: formData,
              //use contentType, processData for sure.
              contentType: false,
              processData: false,
              
              
              success: function(response) {
                  if (response.status === 0) {
                      if($.isEmptyObject(response.error)){
                          handleButton(button, spinner);
                          message.removeClass('d-none alert-success').addClass('alert-danger');
                          message.html(response.info).fadeIn();
                      }else{
                          handleErrors(response.error);
                          handleButton(button, spinner);
                      }
                  }else if(response.status === 1) {
                      message.removeClass('d-none alert-danger').addClass('alert-success');
                      message.html(response.info).fadeIn();
                      return window.location.href = response.redirect;

                  }else {
                      handleButton(button, spinner);
                      alert('Network error. Try again.');
                  }
              },

              error: function(error) {
                  handleButton(button, spinner);
                  alert('Unknown error. Try again.');
              },
          });
      });
    }

      @if(!empty($reference))
        @if(!empty($payment_verification))
            @if(1 === $payment_verification['status'] ?? '')
                window.location.replace('{{ route('client.payments') }}')
            @endif
        @endif
      @endif

  </script>
</body>
</html>