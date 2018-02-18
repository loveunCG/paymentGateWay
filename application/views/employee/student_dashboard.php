
<div class="row">
    <div class="col-sm-12">
        <div class="col-md-3">          
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $student_info->std_first_name . ' ' . $student_info->std_last_name ?></strong>
                    </div>                
                </div>

                <div class="panel-body"> 
                    <ul class="dashboard-menu">
                        <li class="active"><a href="<?php echo base_url() ?>guardian/dashboard/get_attendance/<?php echo $this->encryption->encrypt($student_info->student_session_id) ?>">Attendance</a></li>
                        <li><a href="<?php echo base_url() ?>guardian/dashboard/class_routine/<?php echo $this->encryption->encrypt($student_info->student_session_id) ?>" >Class Routine</a></li>
                        <li><a href="<?php echo base_url() ?>guardian/dashboard/exam_routine/<?php echo $this->encryption->encrypt($student_info->student_session_id) ?>" >Exam Routine</a></li>
                        <li><a href="<?php echo base_url() ?>guardian/dashboard/assessment/<?php echo $this->encryption->encrypt($student_info->student_session_id) ?>" >View Assessment</a></li>
                        <li><a href="<?php echo base_url() ?>guardian/dashboard/exam_result/<?php echo $this->encryption->encrypt($student_info->student_session_id) ?>" >Exam Result</a></li>
                        <li><a href="<?php echo base_url(); ?>guardian/dashboard/subject_taken/<?php echo $this->encryption->encrypt($student_info->student_session_id) ?>" >Subject Taken</a></li>                    
                        <li><a href="<?php echo base_url(); ?>guardian/dashboard/all_notice/<?php echo $this->encryption->encrypt($student_info->student_session_id) ?>" >All Notice</a></li>                                                          
                    </ul>
                </div>
            </div>
            <?php $this->load->view('guardian/component/notice', TRUE); ?>
        </div>        
        <div class="col-md-9">                    
            <?php echo $std_subview ?>
        </div>        
    </div>
</div>
