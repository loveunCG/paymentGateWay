<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12"> 
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php
                        echo $this->language->form_heading()[1]
                        ?></strong>                    
                    </div>                
                </div>
                <div class="panel-body">

                    <form id="set_working_days" action="<?php echo base_url(); ?>admin/settings/save_working_days" method="post"  class="form-horizontal form-groups-bordered">                                                           
                        <div class="form-group">
                            <!-- List  of days -->
                            <?php foreach ($days as $v_day): ?><!--Retrieve Days from Database -->
                                <div class="checkbox-inline">                                
                                    <label class="col-sm-1 ">
                                        <input  type="checkbox" name="day[]" value="<?php echo $v_day->day_id ?>" 

                                                <?php
                                                foreach ($working_days as $v_work) {
                                                    if ($v_work->flag == 1 && $v_work->day_id == $v_day->day_id) {
                                                        ?>
                                                        checked
                                                        <?php
                                                    }
                                                }
                                                ?>/>
                                        <span><input  type="hidden" name="day_id[]" value="<?php echo $v_day->day_id ?>"/><?php echo $v_day->day ?></span>
                                    </label>                                
                                </div>
                            <?php endforeach; ?>
                            <div class="col-sm-2 pull-right">
                                <button type="submit" id="sbtn" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>                            
                            </div>
                        </div> 
                    </form>
                </div>            
            </div>          
        </div>          

    </div>   
</div>