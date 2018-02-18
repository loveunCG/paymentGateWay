
/* 
 * Show all alert
 */
$(document).ready(function() {
    setTimeout(function() {
        $(".alert").fadeOut("slow", function() {
            $(".alert").remove();
        });

    }, 5000);
});

/* 
 * Teacher Management Add Marks check and show input
 */


/*
 * Select All select
 */

/*
 * Click to show 
 */



// Attendance With Leave Category Select One 



/* Exam Management - Promotion Page JS Start*/






/* Exam Management - Promotion Page JS End*/

/* Fees Management Create sub category Fees type view Start*/

$(function() {
    $('#annual').hide();
    $('#bi_annual').hide();
    $('#quarterly').hide();
    $('#monthly').hide();
    var result = $('#existing_data').val();

    if (result == '1')
    {
        $('#expand_fees_type1').hide();
        $('#expand_fees_type2').hide();
        $('#expand_fees_type3').hide();
        $('#expand_fees_type4').hide();
    }
});

function view_fees_type(str) {
    var result = $('#existing_data').val();
    if (result == '1')
    {
        $('#existing_data').val(2);
    }
    $('#exsist_data').hide();
    if (str == '1') {
        $('#annual').show();
        $("#bi_annual :input").attr("disabled", true);
        $("#quarterly :input").attr("disabled", true);
        $("#monthly :input").attr("disabled", true);
        $("#annual :input").attr("disabled", false);
        $("#expand_fees_type1 :input").attr("disabled", false);
        $("#expand_fees_type2 :input").attr("disabled", true);
        $("#expand_fees_type3 :input").attr("disabled", true);
        $("#expand_fees_type4 :input").attr("disabled", true);
        $('#expand_fees_type1').show();
        $('#expand_fees_type2').hide();
        $('#expand_fees_type3').hide();
        $('#expand_fees_type4').hide();
    } else {
        $('#annual').hide();
    }
    if (str == '2') {
        $('#bi_annual').show();
        $("#annual :input").attr("disabled", true);
        $("#quarterly :input").attr("disabled", true);
        $("#monthly :input").attr("disabled", true);
        $("#expand_fees_type1 :input").attr("disabled", true);
        $("#bi_annual :input").attr("disabled", false);
        $("#expand_fees_type2 :input").attr("disabled", false);
        $("#expand_fees_type3 :input").attr("disabled", true);
        $("#expand_fees_type4 :input").attr("disabled", true);
        $('#expand_fees_type1').hide();
        $('#expand_fees_type2').show();
        $('#expand_fees_type3').hide();
        $('#expand_fees_type4').hide();
    } else {
        $('#bi_annual').hide();

    }
    if (str == '3') {
        $('#quarterly').show();
        $("#annual :input").attr("disabled", true);
        $("#bi_annual :input").attr("disabled", true);
        $("#monthly :input").attr("disabled", true);
        $("#expand_fees_type1 :input").attr("disabled", true);
        $("#expand_fees_type2 :input").attr("disabled", true);
        $("#expand_fees_type3 :input").attr("disabled", false);
        $("#quarterly :input").attr("disabled", false);
        $("#expand_fees_type4 :input").attr("disabled", true);

        $('#expand_fees_type1').hide();
        $('#expand_fees_type2').hide();
        $('#expand_fees_type3').show();
        $('#expand_fees_type4').hide();
    } else {
        $('#quarterly').hide();

    }
    if (str == '4') {
        $('#monthly').show();
        $("#annual :input").attr("disabled", true);
        $("#bi_annual :input").attr("disabled", true);
        $("#quarterly :input").attr("disabled", true);
        $("#expand_fees_type1 :input").attr("disabled", true);
        $("#expand_fees_type2 :input").attr("disabled", true);
        $("#expand_fees_type4 :input").attr("disabled", false);
        $("#monthly :input").attr("disabled", false);
        $("#expand_fees_type3 :input").attr("disabled", true);
        $('#expand_fees_type1').hide();
        $('#expand_fees_type2').hide();
        $('#expand_fees_type3').hide();
        $('#expand_fees_type4').show();
    } else {
        $('#monthly').hide();

    }
}
;/* Fees Management Create sub category Fees type view End*/

// fees management fees collecion make payment start
function changeval2() {
    $total = parseFloat($("#fees_amount").val()) + parseFloat($("#fine").val()) - parseFloat($("#discount").val());
    $("#total_amount").val($total);
    $("#total_amount1").val($total);
}
// fees management fees collecion make payment end

