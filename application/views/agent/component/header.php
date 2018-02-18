<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url(); ?>asset/img/intro/favicon.png" rel="icon" type="image/x-icon">
        <link href="<?php echo base_url(); ?>asset/css/agent/main.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>asset/css/agent/guardian.css" rel="stylesheet">
        <!-- Date and Time Picker CSS -->
        <link href="<?php echo base_url(); ?>asset/css/datepicker.css" rel="stylesheet" type="text/css" />
        <!-- All Icon  CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/font-icons/entypo/css/entypo.css" >
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/font-icons/font-awesome/css/font-awesome.min.css" >
            <!--<link href="<?php echo base_url(); ?>asset/employee/html/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">-->
            <script src="<?php echo base_url(); ?>asset/js/jquery-1.10.2.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js" charset="UTF-8" ></script>

        <!-- Data Table  CSS -->
        <link href="<?php echo base_url(); ?>asset/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>asset/css/select2.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/datatables/dataTables.bootstrap.css">
          <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/_all-skins.min.css">
         <link href="<?php echo base_url(); ?>asset/home/assets/css/font-awesome.min.css" rel="stylesheet" />
                  <link href="<?php echo base_url(); ?>asset/employee/bootstrap-datetimepicker.css" rel="stylesheet" />


        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/datepicker/datepicker3.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/iCheck/all.css">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/timepicker/bootstrap-timepicker.min.css">        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/select2/select2.min.css">        <!-- Theme style -->
        <link href="<?php echo base_url(); ?>asset/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>asset/employee/moment.min.js" charset="UTF-8"></script>
         <script src="<?php echo base_url(); ?>asset/employee/datetimepicker.min.js" charset="UTF-8"></script>
        <link href="<?php echo base_url(); ?>asset/css/plugins/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js" ></script>

        <script src="<?php echo base_url(); ?>asset/js/select2.js"></script>
        <script src="<?php echo base_url(); ?>asset/js/custom.js"></script>
        <script>
            $(document).ready(function () {
                $(window).resize(function () {
                    ellipses1 = $("#bc1 :nth-child(2)")
                    if ($("#bc1 a:hidden").length > 0) {
                        ellipses1.show()
                    } else {
                        ellipses1.hide()
                    }
                    ellipses2 = $("#bc2 :nth-child(2)")
                    if ($("#bc2 a:hidden").length > 0) {
                        ellipses2.show()
                    } else {
                        ellipses2.hide()
                    }
                })
            });
        </script>
        <title>九优付网站</title>
    </head>
