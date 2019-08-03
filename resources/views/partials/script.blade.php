<!-- jQuery 3 -->
<script src="{{ url('adminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ url('adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('adminLTE/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('adminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('adminLTE/dist/js/demo.js') }}"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<!-- date-range-picker -->
<script src='{{ url("adminLTE/bower_components/moment/min/moment.min.js") }}'></script>
<!-- bootstrap datepicker -->
<script src='{{ url("bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js") }}'></script>
<script src='{{ url("adminLTE/dist/js/bootstrap-datetimepicker.js") }}'></script>
<script src='{{ url("adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js") }}'></script>
<script src='{{ url("adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js") }}'></script>

<!-- bootstrap time picker -->
<script src='{{ url("adminLTE/plugins/timepicker/bootstrap-timepicker.min.js") }}'></script>
<script src='{{ url("bower_components/formatCurrency/jquery.formatCurrency-1.4.0.js") }}'></script>
<script src='{{ url("bower_components/formatCurrency/i18n/jquery.formatCurrency.id-ID.js") }}'></script>

<script>
    $(function () {
      	//Date picker
      	$('#checkin_date').datetimepicker({
        	format: 'YYYY-MM-DD HH:mm:ss',
      	})

      	$('#checkout_date').datetimepicker({
        	format: 'YYYY-MM-DD HH:mm:ss',
			useCurrent: false //Important! See issue #1075
      	})

		$("#checkin_date").on("dp.change", function (e) {
			$('#checkout_date').data("DateTimePicker").minDate(e.date);
		});
		$("#checkout_date").on("dp.change", function (e) {
			$('#checkin_date').data("DateTimePicker").maxDate(e.date);
		});

	  	$('#datetimepicker1').datetimepicker({
        	format: 'YYYY-MM-DD HH:mm:ss'
      	})

      	// $('#payment_date').datepicker({
        // 	format: 'yyyy-mm-dd'
      	// })

      	//Timepicker
      	$('.timepicker').timepicker({
      	})
    })
</script>
{{-- <script src='{{ url('adminLTE/src/bootstrap-input-spinner.js') }}'></script> --}}
<script>
    // $("input[type='number']").inputSpinner()
</script>