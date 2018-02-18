<?php $this->load->view('test/component/header'); ?>
   <body class="fix-header">
  <?php $this->load->view('test/component/menu_temp'); ?>
        <div id="page-wrapper">
        <?php echo $subview ?>              
        </div>                   
<?php $this->load->view('test/component/footer'); ?>