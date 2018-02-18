<?php echo message_box('success'); ?>
<div class="wrap-fpanel">
    <div class="panel panel-default" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>Set <?php echo $language ?> Phrase For Form Body</strong>
            </div>
        </div>
        <div class="panel-body">

            <form id="form" action="<?php echo base_url() ?>admin/settings/save_form_body_phrase/<?php echo $language ?>" method="post" class="form-groups-bordered">
                <?php //echo "<pre>";
		//print_r($formbodyPhrase);
		foreach ($formbodyPhrase as $key => $v_formbody_language) : ?>                
                <div class="<?php if($v_formbody_language->English == 'Total Unread Message') { echo 'col-sm-3';}elseif ($v_formbody_language->English == 'Total Unread Application') { echo 'col-sm-3';}elseif ($v_formbody_language->English == 'Compose New Message') { echo 'col-sm-4';}else{ echo 'col-sm-2';}?>" style="margin-bottom: 20px;">
                        <label for="field-1"><?php echo $v_formbody_language->english; ?> </label>                                     
                        <input type="text" name="<?php echo $language ?>[]" value="<?php echo $v_formbody_language->$language ?>" class="form-control" placeholder="" />
                        <input type="hidden" name="form_body_id[]" value="<?php echo $v_formbody_language->form_body_id ?>" class="form-control" placeholder="" />
                    </div>                                
                <?php endforeach; ?>                
                <div class="col-md-4 col-sm-12 pull-right" >                    
                    <button type="submit" id="sbtn" class="btn btn-primary btn-block">Update</button>
                </div> 
            </form>
        </div>                 
    </div>                 
</div> 