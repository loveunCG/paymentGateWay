<form role="form" id="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/mailbox/send_mail" method="post" class="form-horizontal form-groups-bordered">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="col-sm-12">
            <span >
                <b style="font-size: 25px;"><?php echo $this->language->form_heading()[25] ?></b> 
            </span>        
        </div>
    </section>           
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <section class="content">    
                    <div class="box box-primary">                        
                        <div class="box-body">
                            <div class="form-group">                                
                                <select multiple="multiple" placeholder="To" name="to[]" style="width: 100%" class="select_2_to" >  
                                    <option value=""></option>
                                    <?php if (!empty($get_employee_email)): foreach ($get_employee_email as $v_emp_email) : ?>
                                            <option value="<?php echo $v_emp_email->email ?>"><?php echo $v_emp_email->first_name . ' ' . $v_emp_email->last_name . '(<small>' . $v_emp_email->email . '</small>)' ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="subject" placeholder="Subject:"/>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control text-justify" id="ck_editor" name="message_body" style="height: 350px"></textarea>
                                <?php echo display_ckeditor($editor['ckeditor']); ?>
                            </div>
                            <div class="form-group">                                
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <?php if (!empty($employee_info->resume)): ?>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new" style="display: none" >Select file</span>
                                            <span class="fileinput-exists" style="display: block">Change</span>
                                            <input type="hidden" name="attach_file" value="<?php echo $employee_info->attach_file ?>">
                                            <input type="file" name="attach_file" >
                                        </span>                                    
                                        <span class="fileinput-filename"> <?php echo $employee_info->attach_filename ?></span>                                          
                                    <?php else: ?>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new" ><i class="fa fa-paperclip"></i> Attachment</span>
                                            <span class="fileinput-exists" >Change</span>                                            
                                            <input type="file" name="attach_file" >
                                        </span> 
                                        <span class="fileinput-filename"></span>                                        
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a>                                                                                                            
                                    <?php endif; ?>
                                    <p class="help-block">Max. 15 MB</p>
                                </div>  
                                <div id="msg_pdf" style="color: #e11221"></div>                                
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button class="btn btn-default" name="discard" value="2" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-times"></i> Discard</button>                                
                                <button type="submit" name="send" value="" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                            </div>

                        </div><!-- /.box-footer -->
                    </div><!-- /. box -->
                </section><!-- /.content -->
            </div><!-- /.col -->
        </div>
    </div>      
</form>
<link href="<?php echo base_url() ?>asset/css/select2.css" rel="stylesheet"/>
<script src="<?php echo base_url() ?>asset/js/select2.js"></script>