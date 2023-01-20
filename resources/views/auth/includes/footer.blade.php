<!--   Core JS Files   -->
  <script src="{{ config('app.url') }}/argon/js/core/popper.min.js"></script>
  <script src="{{ config('app.url') }}/argon/js/core/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  {{-- Custom Js --}}
  <script src="{{ config('app.url') }}/custom/js/index.js"></script>
  <script src="{{ config('app.url') }}/custom/js/ajax.js"></script>
  <script src="{{ config('app.url') }}/custom/js/forms.js"></script>
  <script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "inline";
        } else {
            x.type = "password";
            show_eye.style.display = "inline";
            hide_eye.style.display = "none";
        }
    }
</script>
</body>

</html>