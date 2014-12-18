<?php
echo $require_footer;
	if(file_exists($require_footer)){
		require($require_footer);
	}
?>
    <script type="text/javascript">
        jQuery(function($) {
        var container = $('body'),
          west = $('body > .west'),
          east = $('body > .east'),
          center = $('body > .center');


        function layout() {
          container.layout({
            resizable:  false
          });
        }

        // Lay out the west panel first
        west.layout();

        // Then do the main layout.
        layout();

         var h  = $('.west').height();
         h = h - 30;
         $('.slim').slimscroll({
          height: h
         });

         setInterval(function(){
            $('.alert.alert-success').fadeOut();
         },3000);

        // Hook up the re-layout to the window resize event.
        $(window).resize(layout);
      });
    </script>

      <?php
      $base_path = base_url('assets/xhrs/');
        echo require_js(array(
              /*JQUERY VALIDATE*/
              $base_path."jquery.validate/jquery.validate.js",
              //$base_path."jquery.validate/jquery.maskedinput.min.js",
              $base_path."jquery.validate/jquery.form.js",
              $base_path."jquery.validate/jquery.alphanumeric.js",

              /*DATATABLES*/
              $base_path."datatables/js/datatables.js",
              $base_path."datatables/js/dataTables.bootstrap.js",
              $base_path."datatables/js/dataTables.xhrs.js",
              $base_path."datatables/js/dataTables.fixedColumns.js",
              $base_path."datatables/js/TableTools.js",
              $base_path."datatables/js/jquery.dataTables.columnFilter.js",
              $base_path."datatables/js/ZeroClipboard.js",
              $base_path."bootstrap-select/bootstrap-select.min.js",

             $base_path."js/tooltip.js",
              $base_path."js/jquery.functions.js",

          ));

    ?>
    <script type="text/javascript">
    $(document).ready(function (argument) {
        if ( $( "#calendar" ).length ) {
             $('#calendar').fullCalendar({
              header: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
              },
              events: "<?=base_url('xhrs/calendar-guest/reserve')?>", cache: true   
            })
         
        }

     
    });
    </script>
      </body>
</html>