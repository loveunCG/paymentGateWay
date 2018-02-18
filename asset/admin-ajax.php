<script language="javascript" type="text/javascript">
    function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp = false;
        try {
            xmlhttp = new XMLHttpRequest();
        }
        catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e1) {
                    xmlhttp = false;
                }
            }
        }

        return xmlhttp;
    }

    function check_duplicate_emp_id(val) {
        var base_url = '<?= base_url() ?>';
        var strURL = base_url + "admin/global_controller/check_duplicate_emp_id/" + val;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        var result = req.responseText;
                        if (result) {
                            $("#id_error_msg").html(result);
                            document.getElementById('btn_emp').disabled = true;
                        } else {
                            document.getElementById('btn_emp').disabled = false;
                        }

                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("POST", strURL, true);
            req.send(null);
        }

    }
    ;
    function get_employee_by_designations_id(designation_id) {
        var base_url = '<?= base_url() ?>';
        var strURL = base_url + "admin/global_controller/get_employee_by_designations_id/" + designation_id;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        var result = req.responseText;

                        $("#employee").html("<option value='' >选择 商户...</option>");
                        $("#employee").append(result);

                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("POST", strURL, true);
            req.send(null);
        }

    }
    ;
    function check_current_password(val) {
        var base_url = '<?= base_url() ?>';
        var strURL = base_url + "admin/global_controller/check_current_password/" + val;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        var result = req.responseText;
                        if (result) {
                            $("#id_error_msg").css("display", "block");
                            document.getElementById('sbtn').disabled = true;
                        } else {
                            $("#id_error_msg").css("display", "none");
                            document.getElementById('sbtn').disabled = false;
                        }

                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("POST", strURL, true);
            req.send(null);
        }

    }
    

    function check_user_id(val) {
        var base_url = '<?= base_url() ?>';
        var strURL = base_url + "flogin/check_emp_id/" + val;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        var result = req.responseText;
                        if (result) {
                            $("#id_error_msg").css("display", "block");
                            $("#id_error_msg").html(result);
                            document.getElementById('form_submit').disabled = true;
                        } else {
                            $("#id_error_msg").css("display", "none");
                            document.getElementById('form_submit').disabled = false;
                        }

                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("POST", strURL, true);
            req.send(null);
        }

    }

     function check_user_password(val) {
        var base_url = '<?= base_url() ?>';
        var strURL = base_url + "flogin/check_current_password/" + val;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        var result = req.responseText;
                        if (result) {
                            $("#id_error_msg1").css("display", "block");
                            $("#id_error_msg1").html(result);
                            document.getElementById('form_submit').disabled = true;
                        } else {
                            $("#id_error_msg1").css("display", "none");
                            document.getElementById('form_submit').disabled = false;
                        }

                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("POST", strURL, true);
            req.send(null);
        }

    }
    ;
    function check_employee_password(val) {

        var base_url = '<?= base_url() ?>';
        var strURL = base_url + "employee/dashboard/check_employee_password/" + val;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        var result = req.responseText;
                        if (result) {
                            $("#id_error_msg").css("display", "block");
                            $("#id_error_msg").html(result);
                            document.getElementById('sbtn').disabled = true;
                        } else {
                            $("#id_error_msg").css("display", "none");
                            document.getElementById('sbtn').disabled = false;
                        }

                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("POST", strURL, true);
            req.send(null);
        }

    }
    ;
    function check_agent_password(val) {

        var base_url = '<?= base_url() ?>';
        var strURL = base_url + "agent/dashboard/check_agent_password/" + val;

        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        var result = req.responseText;
                        if (result) {
                            $("#id_error_msg").css("display", "block");
                            document.getElementById('sbtn').disabled = true;
                        } else {
                            $("#id_error_msg").css("display", "none");
                            document.getElementById('sbtn').disabled = false;
                        }

                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("POST", strURL, true);
            req.send(null);
        }

    }
    ;


</script>
