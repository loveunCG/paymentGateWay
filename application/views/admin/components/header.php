<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>                    <?php
                    $genaral_info = $this->session->userdata('genaral_info');
                    if (!empty($genaral_info)) {
                        foreach ($genaral_info as $info)
                        {
                            if($info->id_gsettings == $this->session->userdata('id_gsettings'))
                            {
                            ?>
                                <?php echo $info->name ?>
                            <?php
                            }
                        }
                    }
                        ?></title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="<?php echo base_url(); ?>asset/img/intro/favicon.png" rel="icon" type="image/x-icon">
        <link href="<?php echo base_url(); ?>asset/employee/html/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>asset/css/normalize.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>asset/js/css3-mediaqueries.js" type="text/javascript"></script>
        <!-- Theme style -->
        <link href="<?php echo base_url(); ?>asset/css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>asset/css/admin.css" rel="stylesheet" type="text/css" />
        <!-- Date and Time Picker CSS -->
        <link href="<?php echo base_url(); ?>asset/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>asset/css/timepicker.css" rel="stylesheet" type="text/css" />
        <!-- All Icon  CSS -->
        <link href="<?php echo base_url(); ?>asset/css/font-icons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/font-icons/entypo/css/entypo.css" >
        <!-- Data Table  CSS -->
        <link href="<?php echo base_url(); ?>asset/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>asset/css/plugins/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!--Parents Css -->
         <meta name="renderer" content="webkit">
         <meta name="renderer" content="ie-comp">
         <meta name="renderer" content="ie-stand">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="asset/js/html5shiv.js" type="text/javascript"></script>
        <script src="asset/js/respond.min.js" type="text/javascript"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>asset/js/jquery-1.10.2.min.js"></script>
        <!-- ALl Custom Scripts -->
         <script src="<?php echo base_url(); ?>asset/js/select2.js"></script>
        <script src="<?php echo base_url(); ?>asset/js/custom.js"></script>
              <script src="<?php echo base_url(); ?>asset/employee/moment.min.js" charset="UTF-8"></script>
         <script src="<?php echo base_url(); ?>asset/employee/datetimepicker.min.js" charset="UTF-8"></script>
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
    </head>
