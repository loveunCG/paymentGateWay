<?php $this->load->view('employee/component/header'); ?>

 <body class="fix-header" style = "font-family: 'Open Sans', sans-serif;">
    <?php $this->load->view('employee/component/navigations'); ?>
        <div id="page-wrapper">
            <?php echo $subview ?>
        </div>
    <?php $this->load->view('employee/component/footer'); ?>