<div class="wrap-fpanel">
    <div class="panel panel-default" data-collapsed="0">

        <div class="panel-heading">
            <div class="panel-title">
                <strong>Search Session</strong>
            </div>

        </div>
        <div class="panel-body">
            <form role="form" id="form" action="<?php echo base_url(); ?>admin/routine/event_list" method="post" class="form-horizontal form-groups-bordered">

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Select Session <span class="required">*</span></label>
                    <div class="col-sm-5">
                        <select name="session_id" class="form-control"  required >
                            <option value="">Select Session</option>
                            <?php if ($session_year):foreach ($session_year as $show_year) : ?>                                    
                                    <option value="<?php echo $show_year->session_id ?>"
                                    <?php if (!empty($year)): ?> 
                                        <?php echo $show_year->session_id == $year ? 'selected' : '' ?>        
                                            <?php endif; ?>>
                                        <?php echo $show_year->year ?></option>                                                                                                                               
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </select> 
                    </div>
                    <div class="col-sm-offset-3">
                        <button type="submit" id="sbtn" name="sbtn" value="1" class="btn btn-primary">Search</button>                            
                    </div>
                </div>    

            </form>
        </div>                 
    </div>                 

</div>  
<br/>
<div class="row">
    <div class="col-sm-12" data-offset="0">         
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>Event List</strong>
                </div>
            </div>

            <!-- Table -->
            <table class="table table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>SL</th>                                
                        <th>Event Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Holiday</th>                                
                        <th>Common For</th>                                                                                         
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $key = 1; ?>                 
                    <?php if (!empty($academic_calendar_info)): foreach ($academic_calendar_info as $v_a_calendar) : ?>
                            <tr>
                                <td><?php echo $key ?></td>                                        
                                <td><?php echo $v_a_calendar->event_name ?></td>                                        
                                <td><?php echo $v_a_calendar->start_date ?></td>
                                <td><?php echo $v_a_calendar->end_date ?></td>
                                <td><?php
                                    if ($v_a_calendar->holiday == 0) {
                                        echo 'No ! <span class="label label-danger"> Holiday</span>';
                                    } else {
                                        echo 'Yes! <span class="label label-success">Holiday</span>';
                                    }
                                    ?></td>
                                <td><?php
                                    if ($v_a_calendar->common_to_all == 0) {
                                        echo '<span style="font-size:10px;font-weight:bold">' . $v_a_calendar->course . '-&succ;' . $v_a_calendar->shift . '-&succ;' . $v_a_calendar->section;
                                        '</span>';
                                        ?>                                                                                        
                                        <?php
                                    } else {
                                        echo '<span class="label label-primary" style="font-size:10px;">All !</span>';
                                    }
                                    ?></td>                                       
                                <td>
                                    <?php echo btn_edit('admin/routine/academic_calendar/' . $v_a_calendar->a_calender_id); ?>  
                                    <?php echo btn_delete('admin/user/delete/' . $v_a_calendar->a_calender_id); ?>
                                </td>

                            </tr>
                            <?php
                            $key++;
                        endforeach;
                        ?>
                    <?php else : ?>
                    <td colspan="3">
                        <strong>Please Select Session to display Event</strong>
                    </td>
                <?php endif; ?>
                </tbody>
            </table>          
        </div>
    </div>
</div>