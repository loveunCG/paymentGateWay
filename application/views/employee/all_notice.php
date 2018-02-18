<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" data-offset="0" style="margin-top:5%;">                            
            <div class="panel panel-info">
                <!-- Default panel contents -->

                <div class="panel-heading">
                    <div class="panel-title">                 
                        <strong>所有公告</strong>
                    </div>
                </div>
                 <div class="panel panel-default">
                        <div class="panel-heading">
                         <div class="panel-body">                         
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>      
                            <th class="col-sm-1">NO</th>                                             
                            <th class="col-sm-2">日期</th>
                            <th class="col-sm-2">节目</th>                                                                
                            <th>内容</th>
							<th class="col-sm-1">操作</th>                                                                
                        </tr>
                    </thead>
                    <tbody>

                        <?php  $ID =0;
                        
                        if (!empty($notice_info)): foreach ($notice_info as $v_notice) : ?>
                                <tr>
                                     <td><?php echo ++$ID; ?></td>
                                    <td><?php echo $v_notice->created_date; ?></td>
                                    <td><?php echo $v_notice->title ?></td>                                                                                                                                        
                                    <td class="text-justify"><?php echo $v_notice->short_description ?>
                                        <?php
                                        $str = strlen($v_notice->short_description);
                                        if ($str > 80) {
                                            $ss = '<strong> ......</strong>';
                                        } else {
                                            $ss = '&nbsp';
                                        } echo substr($v_notice->short_description, 0, 80) . $ss;
                                        ?>
                                    </td>                                                                                                                                                                                                                                                                                                                   
                                    <td><?php echo btn_view1('employee/dashboard/notice_detail/' . $v_notice->notice_id); ?></td>                                                                                                                                        
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        <?php else : ?>
                        <td colspan="3">
                            <strong>没有公告！</strong>
                        </td>
                    <?php endif; ?>
                    </tbody>
                </table>          
            </div>
        </div>
    </div>        
</div>
<script>
 $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>