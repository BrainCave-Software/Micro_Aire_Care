<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Micro Aire-Care 2022</span>
  </div>
</footer>
</div>
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{ asset('backend/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('backend/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('backend/vendors/flot/jquery.flot.js')}}"></script>
<script src="{{ asset('backend/vendors/flot/jquery.flot.resize.js')}}"></script>
<script src="{{ asset('backend/vendors/flot/jquery.flot.categories.js')}}"></script>
<script src="{{ asset('backend/vendors/flot/jquery.flot.fillbetween.js')}}"></script>
<script src="{{ asset('backend/vendors/flot/jquery.flot.stack.js')}}"></script>
<script src="{{ asset('backend/vendors/flot/jquery.flot.pie.js')}}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('backend/js/off-canvas.js')}}"></script>
<script src="{{ asset('backend/js/hoverable-collapse.js')}}"></script>
<script src="{{ asset('backend/js/misc.js')}}"></script>
<script src="{{ asset('backend/js/misc.js')}}"></script>
<script src="{{ asset('backend/js/bootbox.min.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('backend/js/dashboard.js')}}"></script>
<!-- End custom js for this page -->
<!-- Start Toastr -->
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('toastr/toastr.css') }}">
<!-- End Toastr-->
<!-- 
    <script src="{{ asset('backend/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{ asset('backend/vendors/select2/select2.min.js')}}"></script>
    <script src="{{ asset('backend/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
    <script src="{{ asset('backend/js/typeahead.js')}}"></script>
    <script src="{{ asset('backend/js/select2.js')}}"></script> -->

<!-- // backend js file -->

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

<script>
  $('.close').on('click', function() {
    $('label.error').hide();
    $('.alert').hide();
    $('input').removeClass('error');
  });

  $('.alert > .close').on('click', function() {
    $(this).parent().hide();
  });
  // toastr alert
  function errorMsg(msg) {
    toastr.error(msg);
  }

  function successMsg(msg) {
    toastr.success(msg);
  }
</script>

</html>