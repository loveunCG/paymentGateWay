
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="wrap-fpanel">

    <div class="row">
        <div class="col-sm-12" data-offset="0">                            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[23] ?></strong>
                    </div>
                </div>
                <!-- Table -->

                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th><?php echo $this->language->from_body()[57][25];?></th>

                            <th><?php echo $this->language->from_body()[57][39];?></th>
                            <th class="col-sm-5"><?php echo $this->language->from_body()[57][40];?></th>
                            <th><?php echo $this->language->from_body()[57][41];?></th>
                            <th class="col-sm-1"><?php echo $this->language->from_body()[57][38];?></th>                            
                            <th class="col-sm-2"><?php echo $this->language->from_body()[57][30];?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $key = 1; ?>
                        <?php if (!empty($notice)): foreach ($notice as $v_notice): ?>
                                <tr>
                                    <td><?php echo $key; ?></td>                        

                                    <td><?php echo $v_notice->title; ?></td>
                                    <td><?php 
                                        $str = strlen($v_notice->short_description);
                                        if ($str > 80) {
                                            $ss = '<strong> ......</strong>';
                                        } else {
                                            $ss = '&nbsp';
                                        } echo substr($v_notice->short_description, 0, 80) . $ss;
                                        ?></td>
                                    <td>
                                        <?php if ($v_notice->flag == 0) : ?> 
                                            <span class="label label-danger">未公开</span>
                                        <?php else : ?>                                        
                                            <span class="label label-success">发表</span>                                                                             
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $v_notice->created_date; ?></td>                                    
                                    <td>                                                                
                                        <?php echo btn_edit('admin/notice/add_notice/' . $v_notice->notice_id); ?>                                                                
                                        <?php echo btn_delete('admin/notice/delete_notice/' . $v_notice->notice_id); ?>                                                                
                                    </td>
                                </tr>
                                <?php
                                $key++;
                            endforeach;
                            ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div> 
