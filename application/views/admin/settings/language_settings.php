<?php echo message_box('success'); ?>
<div class="wrap-fpanel">
    <div class="panel panel-default" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <strong><?php
                        echo $this->language->form_heading()[6]
                        ?></strong>
            </div>
        </div>
        <div class="panel-body">

            <form id="form" action="<?php echo base_url() ?>admin/settings/add_language" method="post" class="form-horizontal form-groups-bordered">

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[7][0] ?> <span class="required"> *</span></label>
                    <div class="col-sm-5">                            
                        <input type="text" name="language" value="" class="form-control" placeholder="Enter Your Language" />
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" id="sbtn" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>                            
                    </div>
                </div>
            </form>
        </div>                 
    </div>                 
</div> 
<div class="row">
    <div class="col-sm-12" data-offset="0">                            
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $this->language->from_body()[7][1] ?></strong>
                </div>
            </div>

            <!-- Table -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-sm-1">SL</th>
                        <th>Language</th>
                        <th class="col-sm-4">Phrase</th>
                        <th class="col-sm-1"><?php echo $this->language->from_body()[14][4] ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $key = 1;
                    ?>
                    <?php
                    $fields = $this->db->list_fields('tbl_menu');
                    if (!empty($fields)):
                        foreach ($fields as $v_fields) :                            
                            if ($v_fields != 'menu_id' && $v_fields != 'link' && $v_fields != 'icon' && $v_fields != 'parent' && $v_fields != 'sort') {
                                if ($v_fields != 'English') {
                                    ?>
                                    <tr>
                                        <td><?php echo $key ?></td>
                                        <td><?php
                                            echo $v_fields;
                                            ?></td>
                                        <td><?php                                            
                                            echo btn_set_phrase('admin/settings/set_phrase/' . $v_fields);
                                            ?>
                                        <?php                                            
                                            echo btn_set_formbody('admin/settings/set_formbody/' . $v_fields);
                                            ?></td>
                                        <td>                                        
                                            
                                            <?php                                            
                                            echo btn_delete('admin/settings/delete_language/' . $v_fields);
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $key++;
                                }
                            }
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