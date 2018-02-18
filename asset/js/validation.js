//$(document).ready(function() {
var namepattern = /^[A-Za-z][A-Za-z ]+$/;
var currpattern = /^[A-Z][A-Z]+$/;
var weightpattern = /^[0-9]+\.[0-9]*$/;
var usernamepattern = /^[A-Za-z][A-za-z _\.0-9]+$/;
var monopattern = /^[\d{10}]+$/;
var compattern = /^(?:100(?:.0(?:0)?)?|\d{1,2}(?:.\d{1,2})?)$/;
var emailpattern = /^[a-zA-Z0-9-]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,3})$/;
var numpattern = /^[\d]+$/;
var passpattern = /^[@#$%&?_]*[\w]+[@#$%&?_]*$/;

function test_name(id, msgId) {
    var name = $(id).val();
    if (name != "") {
        if (!namepattern.test(name)) {
            $(msgId).html('* Name Contains Only Letters.');
            $(id).css({
                "border": "1px solid #B94A48",
                //"background": "#B94A48"
            });
            return false;
        } else {
            $(msgId).html('');
            $(id).css({
                "border": "",
                "background": ""
            });
            return true;
        }
    } else {
        $(msgId).html('* 这是必填栏.');
        $(id).css({
            "border": "1px solid #B94A48"
                //"background": "#FFCECE"
        });
        return false;
    }
}

function test_mono(id, msgId) {
    var no = $(id).val();

    if (no != "") {
        if (no.length != 10) {
            $(msgId).html('* Mobile Number must be 10 digit.');
            $(id).css({
                "border": "1px solid #B94A48",
                //"background": "#FFCECE"
            });
            return false;
        }
        if (!monopattern.test(no)) {
            $(msgId).html('* Invalid Mobile Number.');
            $(id).css({
                "border": "1px solid #B94A48",
                //"background": "#FFCECE"
            });
            return false;
        } else {
            $(msgId).html('');
            $(id).css({
                "border": "",
                "background": ""
            });
            return true;
        }
    } else {
        $(msgId).html('* 这是必填栏.');
        $(id).css({
            "border": "1px solid #B94A48",
            //"background": "#FFCECE"
        });
        return false;
    }
}

function test_email(id, msgId) {
    var email = $(id).val();
    if (email != "") {
        if (!emailpattern.test(email)) {

            $(msgId).html('* Enter Valid Email.');
            $(id).css({
                "border": "1px solid #B94A48",
                //"background": "#FFCECE"
            });
            return false;
        } else {
            $(msgId).html('');
            $(id).css({
                "border": "",
                "background": ""
            });
            return true;
        }
    } else {
        $(msgId).html('* 这是必填栏.');
        $(id).css({
            "border": "1px solid #B94A48",
            //"background": "#FFCECE"
        });
        return false;
    }
}

function test_weight(id, msgId) {
    var name = $(id).val();
    if (name != "") {
        if (!weightpattern.test(name)) {
            $(msgId).html('* Weight Contains Only Digit and Dot.');
            $(id).css({
                "border": "1px solid #B94A48",
                //"background": "#B94A48"
            });
            return false;
        } else {
            $(msgId).html('');
            $(id).css({
                "border": "",
                "background": ""
            });
            return true;
        }
    } else {
        $(msgId).html('* 这是必填栏.');
        $(id).css({
            "border": "1px solid #B94A48"
                //"background": "#FFCECE"
        });
        return false;
    }
}

function test_sub(id, msgId) {
    var add = $(id).val();
    var len = add.length;
    if (add != "") {
        if (len >= 6) {
            $(msgId).html('');
            $(id).css({
                "border": "",
                "background": ""
            });
            return true;
        } else {
            $(msgId).html('* Please enter at least 6 characters.');
            $(id).css({
                "border": "1px solid #B94A48",
                //"background": "#FFCECE"
            });
            return false;
        }
    } else {
        $(msgId).html('* 这是必填栏.');
        $(id).css({
            "border": "1px solid #B94A48",
            //"background": "#FFCECE"
        });
        return false;
    }
}

function test_msg(id, msgId) {
    var add = $(id).val();
    var len = add.length;
    if (add != "") {
        if (len >= 20) {
            $(msgId).html('');
            $(id).css({
                "border": "",
                "background": ""
            });
            return true;
        } else {
            $(msgId).html('* Message must be 20 charactor.');
            $(id).css({
                "border": "1px solid #B94A48",
                //"background": "#FFCECE"
            });
            return false;
        }
    } else {
        $(msgId).html('* 这是必填栏.');
        $(id).css({
            "border": "1px solid #B94A48",
            //"background": "#FFCECE"
        });
        return false;
    }
}

function test_desc(id, msgId) {
    var add = $(id).val();
    var len = add.length;
    if (add != "") {
        if (len >= 20) {
            $(msgId).html('');
            $(id).css({
                "border": "",
                "background": ""
            });
            return true;
        } else {
            $(msgId).html('* Description must be 20 charactor.');
            $(id).css({
                "border": "1px solid #B94A48",
                //"background": "#FFCECE"
            });
            return false;
        }
    } else {
        $(msgId).html('* 这是必填栏.');
        $(id).css({
            "border": "1px solid #B94A48",
            //"background": "#FFCECE"
        });
        return false;
    }
}

function test_drop(id, msgId) {
    var dropval = $(id).val();
    if (dropval == "") {

        $(msgId).html('&nbsp;* 这是必填栏. ');
        $(id).css({
            "border": "1px solid #B94A48"
        });
        return false;
    } else {
        $(msgId).html('');
        $(id).css({
            "border": "",
            "background": ""
        });
        return true;
    }
}



function test_num_limit(id, msgId) {
    var num = $(id).val();
    if (num <= 247) {
        $(msgId).html('');
        $(id).css({
            "border": "",
            "background": ""
        });
        return true;
    } else {
        $(msgId).html('Maximum charge will be 247.');
        $(id).css({
            "border": "1px solid #B94A48",
            //"background": "#FFCECE"
        });
        return false;
    }
}

function test_num(id, msgId) {
    var num = $(id).val();
    if (num != "") {
        if (!numpattern.test(num)) {
            $(msgId).html('* This Field contains Only Digit.');
            $(id).css({
                "border": "1px solid #B94A48",
                //"background": "#FFCECE"
            });
            return false;
        } else {
            $(msgId).html('');
            $(id).css({
                "border": "",
                "background": ""
            });
            return true;
        }
    } else {
        $(msgId).html('* 这是必填栏.');
        $(id).css({
            "border": "1px solid #B94A48",
            //"background": "#FFCECE"
        });
        return false;
    }
}