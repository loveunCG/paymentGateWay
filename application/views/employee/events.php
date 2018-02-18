<div class="col-md-12">
    <div class="row">
        <div class="col-sm-12" data-offset="0">                            
            <div class="panel panel-info">
                <!-- Default panel contents -->

                <div class="panel-heading">
                    <div class="panel-title">                 
                        <strong>List of All Events</strong>
                    </div>
                </div>
                <!-- Table -->
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>                                                                               
                            <th class="col-sm-3">Event Name</th>                                                                
                            <th class="col-sm-1">Start Date</th>                                                                
                            <th class="col-sm-1">End Date</th>                                                                
                            <th>Description</th>                                                                
                            <th class="col-sm-1">Action</th>                                                                
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($event_info)): foreach ($event_info as $v_events) : ?>
                                <tr>                                    
                                    <td><?php echo $v_events->event_name ?></td>                                                                                                                                        
                                    <td><?php echo date('d M Y', strtotime($v_events->start_date)); ?></td>                                                                                                                                        
                                    <td><?php echo date('d M Y', strtotime($v_events->end_date)); ?></td>                                                                                                                                        
                                    <td class="text-justify"><?php echo $v_events->description ?></td>                                                                                                                                        
                                    <td><?php echo btn_view('employee/dashboard/event_detail/' . $v_events->holiday_id); ?></td>                                                                                                                                        
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        <?php else : ?>
                        <td colspan="3">
                            <strong>There is no data to display</strong>
                        </td>
                    <?php endif; ?>
                    </tbody>
                </table>          
            </div>
        </div>
    </div>        


</div>
