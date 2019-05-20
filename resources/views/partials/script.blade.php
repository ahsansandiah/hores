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
<script src='{{ url('adminLTE/bower_components/moment/min/moment.min.js') }}'></script>
<script src='{{ url('adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}'></script>
<!-- bootstrap datepicker -->
<script src='{{ url('adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}'></script>
<!-- bootstrap time picker -->
<script src='{{ url('adminLTE/plugins/timepicker/bootstrap-timepicker.min.js') }}'></script>
<script>
    $(function () {
      
      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      
      //Date picker
      $('#checkout_date').datepicker({
          autoclose: true
      })

      $('#payment_date').datepicker({
          autoclose: true
      })

      $('#checkin_date').datepicker({
          autoclose: true
      })
      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })
    })
</script>
<script src='{{url('adminLTE/src/bootstrap-input-spinner.js')}}'></script>
<script>
    $("input[type='number']").inputSpinner()
</script>