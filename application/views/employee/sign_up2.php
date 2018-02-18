
    <h1 class="well">警告通知</h1>
    <div class="col-sm-12 well " style="margin-top: 5%;">
        <div class="row">
            <form id="contact_form" action="<?php echo base_url() ?>employee/dashboard/save_employee" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>您的帐户尚未获得批准。</label>
                            </div>
                        </div>
                        <!--<i class="fa fa-sign-in" aria-hidden="true"></i>-->
                    </div>
                </fieldset>
            </form>
        </div>
    </div>


<style>
    #success_message {
        display: none;
    }
    #contact_form .has-feedback .form-control-feedback {
    top: 26px;
    right: 4%
}

</style>


