
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<script src="<?php echo base_url(); ?>asset/js/kindeditor/kindeditor-min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/kindeditor/lang/zh-CN.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>asset/js/kindeditor/themes/default/default.css" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[22] ?></strong>
                    </div>
                </div>
                <div class="panel-body">

                    <form name="example" role="form" id="form" action="<?php echo base_url(); ?>admin/notice/save_notice/<?php echo $notice->notice_id; ?>" method="post" class="form-horizontal form-groups-bordered">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[23][0] ?> <span class="required">*</span></label>

                            <div class="col-sm-2"><input type="checkbox" class="select_one" name="flag" value="1"
                                <?php
                                if ($notice->flag == 1) {
                                    ?>
                                                             checked
                                                             <?php
                                                         }
                                                         ?>> <?php echo $this->language->from_body()[57][36];?></div>
                            <div class="col-sm-2"><input type="checkbox" class="select_one" name="flag" value="0"
                                <?php
                                if ($notice->flag == 0) {
                                    ?>
                                                             checked
                                                             <?php
                                                         }
                                                         ?>> <?php echo $this->language->from_body()[57][37];?></div>

                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[23][1] ?> <span class="required">*</span></label>

                            <div class="col-sm-8">
                                <input type="text" name="title" value="<?php echo $notice->title; ?>" class="form-control" requried placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[23][2] ?> <span class="required">*</span></label>

                            <div class="col-sm-8">
                                <textarea name="short_description" class="form-control" required placeholder=""><?php echo $notice->short_description; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[23][3] ?> <span class="required">*</span></label>
                            <div class="col-sm-8">
                                <textarea cols="100" rows="8" style="width:700px;height:200px;visibility:hidden;" name="long_description" id="content1" required><?php echo $notice->long_description; ?></textarea>
                                <!-- <?php echo display_ckeditor($editor['ckeditor']); ?> -->
                            </div>
                        </div>

                        <!--hidden input values -->

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" id="sbtn" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br/>
        </div>
    </div>
</div>
            <br/>   
        </div>   
    </div>   
</div>
    <script>
        KE.show({
            id : 'content1',
            imageUploadJson : '../../php/upload_json.php',
            fileManagerJson : '../../php/file_manager_json.php',
            allowFileManager : true,
            afterCreate : function(id) {
                KE.event.ctrl(document, 13, function() {
                    KE.util.setData(id);
                    document.forms['example'].submit();
                });
                KE.event.ctrl(KE.g[id].iframeDoc, 13, function() {
                    KE.util.setData(id);
                    document.forms['example'].submit();
                });
            }
        });
    </script>