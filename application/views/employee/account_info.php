<div class="container-fluid">
    <div class="row col-xs-offset-1 col-xs-10" style="margin-top:5%;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><strong>账户信息</strong></strong>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form class="form-horizontal" style="margin-left: 15%;">
                        <div class="form-group ">
                            <label class="col-sm-2 ">商户名:</label>
                            <div class="col-sm-1 ">
                                <?php echo $employee_details->usr_law_name; ?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-2 ">商户ID:</label>
                            <div class="col-sm-1 "> 
                                <?php echo "$employee_details->employee_id"; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 " for="state-danger">联系电话:</label>
                            <div class="col-sm-1 ">
                                <?php
                                            $email = $employee_details->usr_mobile;
                                            $pre_frex = substr($email, 0, 3);    
                                            $end_frex = substr($email, -5, 5);                                       
                                            echo $pre_frex. str_repeat('*',5).$end_frex;
                                        ?>
                            </div>
                        </div>                      
                        <div class="form-group">
                            <label class="col-sm-2 ">公司名称:</label>
                            <div class="col-sm-1 ">
                                <?php if (!empty($employee_details->usr_company_name)): ?>
                                <p class="">
                                    <?php echo "$employee_details->usr_company_name"; ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label class="col-sm-2 " >开户银行:</label>
                            <div class="col-sm-1 ">
                                <?php echo "$employee_details->usr_bank_name"; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 " for="example-input-large">法人身份证:</label>
                            <div class="col-sm-1 ">
                                <?php
                                            $email = $employee_details->usr_idcard_num;
                                            $pre_frex = substr($email, 0, 5);    
                                            $end_frex = substr($email, -5, 5);                                       
                                            echo $pre_frex. str_repeat('*',5).$end_frex;
                                        ?>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label class="col-sm-2 " >您的秘钥:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" readonly id="pay_code" style="width: 100%;" value = "<?php echo $employee_details->usr_pay_check_code; ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="button" class="btn btn-info" onclick="update_code()" value="更换">
                                <input type="button" class="btn btn-info" id="copyButton" value="复制秘钥">
                            </div>

                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function update_code() {
        var val = 0;
        var base_url = '<?= base_url() ?>';
        var strURL = base_url + "employee/dashboard/radom_update_code";
        $.post(strURL, {
                pay_code: val
            })
            .done(function (data) {
                $('#pay_code').val(data);
            });

    };
    document.getElementById("copyButton").addEventListener("click", function () {
        copyToClipboard(document.getElementById("pay_code"));
    });

    function copyToClipboard(elem) {
        // create hidden text element, if it doesn't already exist
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;
        if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        // copy the selection
        var succeed;
        try {
            succeed = document.execCommand("copy");
        } catch (e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            // clear temporary content
            target.textContent = "";
        }
        return succeed;
    }
</script>