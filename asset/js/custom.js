
/* 
 * Tooltips icon
 */
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})
/* 
 * Time and Date Pickers
 */
$(function() {
    $('.timepicker').timepicker();
});
$(function() {
    $('.datepicker').datepicker({
        autoclose: true,
        todayBtn: "linked",
    });
});
$(function() {
    $('.monthyear').datepicker({
        autoclose: true,
        startView: 1,
        format: 'yyyy-mm',
        minViewMode: 1,
    });
});
$(function() {
    $('.years').datepicker({
        startView: 2,
        format: 'yyyy',
        minViewMode: 2,
        autoclose: true,
    });
});
$(function() {
    $('button[id="checkit"]').click(function() {
        $('#month').css("display", "block").css("margin-top", "20" + "px");
    });
});
/* 
 * Session Academic Calender 
 */
$(function() {
    $('div.other').show();
    $('input[id="checkit"]').click(function() {
        $('#show').css("display", "").css("margin-top", "20" + "px");
        if (this.checked) {
            $('div.other').hide();
        } else {
            $('div.other').show();
        }
    });
});
$(document).ready(function() {
    $('input.select_one').on('change', function() {
        $('input.select_one').not(this).prop('checked', false);
    });
});

/* 
 * Session Create Class Select One class One Shift And save Data
 */

$(document).ready(function() {
    $('input.select_class').on('change', function() {
        $('input.select_class').not(this).prop('checked', false);
    });
});


$(document).ready(function() {
    $('input.select_shift').on('change', function() {
        $('input.select_shift').not(this).prop('checked', false);
    });
});
/* 
 * Show all alert
 */
$(document).ready(function() {
    setTimeout(function() {
        $(".alert").fadeOut("slow", function() {
            $(".alert").remove();
        });

    }, 3000);
});

/* 
 * Teacher Management Add Marks check and show input
 */
$(function() {
    $('div.term').hide();
    $('input[id="checkit"]').click(function() {
        if (this.checked) {
            $('div.term').hide();
        } else {
            $('div.term').show();
        }
    });
});
$(function() {
    $('div.assessment').hide();
    $('input[id="checked"]').click(function() {
        if (this.checked) {
            $('div.assessment').show();
        } else {
            $('div.assessment').hide();
        }
    });
    /*
     * Multiple drop down select
     */

    $(document).ready(function() {
        $(".select_box").select2({
            allowClear: true,
        });
        $(".select_2_to").select2({
            placeholder: "To:",
            tags: true,
            allowClear: true,
            tokenSeparators: [',', ' ']
        });
    });
});

/*
 * Select All select
 */
$(function() {
    $('#parent_present').on('change', function() {
        $('.child_present').prop('checked', $(this).prop('checked'));
    });
    $('.child_present').on('change', function() {
        $('.child_present').prop($('.child_present:checked').length ? true : false);
    });
    $('#parent_absent').on('change', function() {
        $('.child_absent').prop('checked', $(this).prop('checked'));
    });
    $('.child_absent').on('change', function() {
        $('.child_absent').prop($('.child_absent:checked').length ? true : false);
    });
});
/*
 * Click to show 
 */

$(function() {
    $('div.a_category').hide();
    $('input[id="parent_absent"]').click(function() {
        if (this.checked) {
            $('div.a_category').show();
        } else {
            $('div.a_category').hide();
        }
    });
});

$(document).ready(function() {
    $('input.select_one').on('change', function() {
        $('input.select_one').not(this).prop('checked', false);
    });
});
$(function() {
    $('#parent').on('change', function() {
        $('.child').prop('checked', $(this).prop('checked'));
    });
    $('.child').on('change', function() {
        $('#parent').prop($('.child:checked').length ? true : false);
    });
});

// Attendance With Leave Category Select One 

$(document).ready(function() {
    //var id = $('input[class^="child_present"]').length;

//    var i;
//    for (i = 1; i <= id; i++)
////    {
////        alert(i);
////        $('input.child_present_'+i).on('change', function() {
////            $('input.child_present_'+i).not(this).prop('checked', false);
////        });
////    }
    var parent_absent = $('input[id="parent_absent"]');
    var parent_present = $('input[id="parent_present"]');
    var child_present = $('input[class="child_present"]');

    var child_absent = $('input[class="child_absent"]');

    $('select[id="disable"]').prop('disabled', true);
    child_absent.click(function() {
        if (this.checked) {
            $('select[id="disable"]').prop('disabled', false);
        }
    });
    parent_absent.change(function() {
        if (this.checked) {
            child_present.prop('checked', false);
        }
    });
    parent_present.change(function() {
        if (this.checked) {
            child_absent.prop('checked', false);
        }
    });
    child_present.change(function() {
        parent_absent.prop($('input[class="child_present"]').length === 0);
    }).change();
    child_absent.change(function() {
        parent_present.prop($('input[class="child_absent"]').length === 0);
    }).change();
});



/* Exam Management - Promotion Page JS Start*/

$(document).ready(function() {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');



    navListItems.click(function(e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');

            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});



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

