<?php echo message_box('success'); ?>
<div class="wrap-fpanel">
    <div class="panel panel-default" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>Set <?php echo $language ?> Phrase For Menu</strong>
            </div>
        </div>
        <div class="panel-body">

            <form id="form" action="<?php echo base_url() ?>admin/settings/add_menu_language/<?php echo $language?>" method="post" class="form-groups-bordered">
                <?php foreach ($all_menu_language as $key => $v_menu_language) : ?>                
                    <div class="col-sm-2" style="margin-bottom: 20px;">
                        <label for="field-1"><?php echo $v_menu_language->English; ?> </label>                                     
                        <input type="text" name="<?php echo $language?>[]" value="<?php echo $v_menu_language->$language?>" class="form-control" placeholder="" />
                        <input type="hidden" name="menu_id[]" value="<?php echo $v_menu_language->menu_id?>" class="form-control" placeholder="" />
                    </div>                                
                <?php endforeach; ?>                
                <div class="col-md-4 col-sm-12 pull-right" >                    
                    <button type="submit" id="sbtn" class="btn btn-primary btn-block">Update</button>
                </div> 
            </form>
        </div>                 
    </div>                 
</div> 
<div class="wrap-fpanel">
    <div class="panel panel-default" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>Set <?php echo $language ?> Phrase For Heading</strong>
            </div>
        </div>
        <div class="panel-body">

            <form id="form" action="<?php echo base_url() ?>admin/settings/add_form_language/<?php echo $language?>" method="post" class="form-groups-bordered">
                <?php foreach ($all_form_language as $key => $v_form_language) :?>                
                    <div class="<?php if($v_form_language->English == 'List of All Time Change Request' || $v_form_language->English == 'Compose New Message'|| $v_form_language->English == 'Time Change Request Details') { echo 'col-sm-4';}else{ echo 'col-sm-2';}?>" style="margin-bottom: 20px;">
                        <label for="field-1"><?php echo $v_form_language->English; ?> </label>                                     
                        <input type="text" name="<?php echo $language?>[]" value="<?php echo $v_form_language->$language?>" class="form-control" />
                        <input type="hidden" name="form_id[]" value="<?php echo $v_form_language->form_id?>"  />
                    </div>                                
                <?php endforeach; ?>                
                <div class="col-md-4 col-sm-12 pull-right" >                    
                    <button type="submit" id="sbtn" class="btn btn-primary btn-block">Update</button>
                </div> 
            </form>
        </div>                 
    </div>                 
</div> 