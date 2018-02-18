<?php echo message_box('success'); ?>
<style type="text/css">
    .datepicker{z-index:1151 !important;}
</style>
<?php if (!empty($event_info) || !empty($add_event)): ?>
    <div class="row">
        <div class="col-sm-12" data-spy="scroll" data-offset="0">                            
            <div class="wrap-fpanel" >                            
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><?php echo $this->language->from_body()[6][0] ?></strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="form" action="<?php echo base_url(); ?>admin/settings/save_event/<?php if (!empty($event_info)) echo $event_info->event_id; ?> " method="post" class="form-horizontal form-groups-bordered">

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[6][1] ?><span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" name="event_name"  class="form-control" id="field-1" value="<?php if (!empty($event_info)) echo $event_info->event_name; ?>"/>                
                                    <input type="hidden" name="event_id"  class="form-control" id="field-1" value="<?php if (!empty($event_info)) echo $event_info->event_id; ?>"/>                
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[6][2] ?><span class="required">*</span></label>
                                <div class="input-group col-sm-5">
                                    <input type="text"  class="form-control datepicker" name="start_date" value="<?php
                                    if (!empty($event_info)): echo $event_info->start_date;
                                    else:echo date('Y/m/d');
                                    endif;
                                    ?>" data-format="yyyy/mm/dd">

                                    <div class="input-group-addon">
                                        <a href="#"><i class="entypo-calendar"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[6][3] ?><span class="required">*</span></label>
                                <div class="input-group col-sm-5">
                                    <input type="text" class="form-control datepicker" id="" name="end_date" value="<?php
                                    if (!empty($event_info)): echo $event_info->end_date;
                                    else:echo date('Y/m/d');
                                    endif;
                                    ?>"  data-format="yyyy/mm/dd">

                                    <div class="input-group-addon">
                                        <a href="#"><i class="entypo-calendar"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5 pull-right">
                                    <button type="submit" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>        
        </div>        
    </div> 
<?php endif; ?>
<form method="post" action="<?php echo base_url() ?>admin/settings/view_event">
    <h4><i style="color:#428BCA;" class="fa fa-plus"></i><input style="color:#428BCA;background: none;;border: none" type="submit" name="add_event" value="Add Personal Event "/></h4>    
</form>
<div class="row">
    <div class="col-sm-12 scroll-box" data-spy="scroll" data-offset="0">                            
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $this->language->from_body()[6][0] ?></strong>
                </div>
            </div>
            <!-- Table -->
            <table class="table table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="col-sm-1">SL</th>
                        <th>Event Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>

                        <th class="col-sm-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($event_details)): $sl = 1;
                        foreach ($event_details as $v_event) :
                            ?>                            
                            <tr>
                                <td><?php echo $sl ?></td>
                                <td>
                                    <?php echo $v_event->event_name; ?>
                                </td>
                                <td><?php echo $v_event->start_date; ?></td>
                                <td><?php echo $v_event->end_date; ?></td>                                                               
                                <td>   
                                    <div class="btn-group" role="group" aria-label="...">
                                        <?php echo btn_edit('admin/settings/view_event/' . $v_event->event_id); ?>  
                                        <?php echo btn_delete('admin/settings/delete_personal_event/' . $v_event->event_id); ?>        
                                    </div>
                                </td>                            
                            </tr>
                            <?php $sl++ ?>
                        <?php endforeach; ?> 
                    <?php else: ?> 
                    <td colspan="4">
                    <tr>
                    <strong>There is no data for display</strong>
                    </tr>
                    </td>
                <?php endif; ?>   


                </tbody>
            </table>          
        </div>
    </div>
</div>



