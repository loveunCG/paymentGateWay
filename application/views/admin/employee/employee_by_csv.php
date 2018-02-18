<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<script type="text/javascript">
function checkfile(sender) {
    var validExts = new Array(".csv");
    var fileExt = sender.value;
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
      alert("<?php echo $this->language->from_body()[27][1] ?>");
      sender.value = '';
      return false;
    }
    else return true;
}	
</script>
<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[26] ?></strong>
                    </div>
                </div>
                <div class="panel-body">
                	<div class="row">
                		<div class="well well-small">
    <a href="<?php echo base_url();?>asset/csv/employment.csv" class="btn btn-info pull-right"><i class="fa fa-download fa-white"></i> <?php echo $this->language->from_body()[27][2] ?></a>
    <span class="text-warning"><?php echo $this->language->from_body()[27][3] ?></span><br><?php echo $this->language->from_body()[27][4] ?> <span class="text-info">(<?php echo $this->language->from_body()[12][31] ?>, <?php echo $this->language->from_body()[12][1] ?>, <?php echo $this->language->from_body()[12][2] ?>, <?php echo $this->language->from_body()[12][3] ?>, <?php echo $this->language->from_body()[12][4] ?>, <?php echo $this->language->from_body()[12][5] ?>, <?php echo $this->language->from_body()[12][6] ?>, <?php echo $this->language->from_body()[12][7] ?>, <?php //echo $this->language->from_body()[12][10]."," ?> <?php echo $this->language->from_body()[12][8] ?>, <?php echo $this->language->from_body()[12][17] ?>, <?php echo $this->language->from_body()[1][4] ?>, <?php echo $this->language->from_body()[1][5] ?>, <?php echo $this->language->from_body()[1][8] ?>, <?php echo $this->language->from_body()[1][7] ?>, <?php echo $this->language->from_body()[5][0] ?>, <?php echo $this->language->from_body()[12][33] ?>)</span> <?php echo $this->language->from_body()[27][5] ?>   
    </div></div>
                    <form id="form" action="<?php echo base_url() ?>admin/employee/upload_csv" method="post"  enctype="multipart/form-data" class="form-horizontal">
                        <div class="panel_controls">
                          
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[27][0] ?> <span class="required">*</span></label>

                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="file" name="userfile" onchange="checkfile(this);" required="required"   class="form-control"  >
                                        <div class="input-group-addon">
                                            <?php echo $this->language->from_body()[27][1] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" id="sbtn" name="sbtn" value="1" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>