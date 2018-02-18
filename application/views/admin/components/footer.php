
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>asset/js/menu.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>asset/js/custom-validation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>asset/js/bootbox.min.js" ></script>  
<!-- Jasny Bootstrap for NIce Image Change -->
<script src="<?php echo base_url() ?>asset/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>asset/js/bootstrap-datepicker.js" ></script>      
<script src="<?php echo base_url() ?>asset/js/timepicker.js" ></script>  

<!-- Data Table -->
<script src="<?php echo base_url(); ?>asset/js/plugins/metisMenu/metisMenu.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>asset/js/plugins/dataTables/jquery.dataTables.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>asset/js/plugins/dataTables/dataTables.bootstrap.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>asset/js/distpicker.data.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>asset/js/distpicker.js" type="text/javascript"></script>
    <script>
    $(document).ready(function() {
        $("[id^=dataTables-example]").dataTable(); 
		$("#timepicker").timepicker();
    });
    </script>

</body>
</html>