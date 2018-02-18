<?php $this->load->view('intro/component/header'); ?>
   <body class="fix-header">
  <?php $this->load->view('intro/component/menu_temp'); ?>
        <div id="page-wrapper">
        <?php echo $subview ?>              
        </div>
     <?php  if (empty ($categorys)){ ?>               
<?php $this->load->view('intro/component/footer'); ?>
 <?php  } ?>   