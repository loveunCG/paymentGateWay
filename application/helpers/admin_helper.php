<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function btn_edit($uri) {
    return anchor($uri, '<i class="fa fa-pencil-square-o"></i> 编辑', array('class' => "btn btn-primary btn-xs", 'title'=>'编辑', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}
function btn_action($uri) {
    return anchor($uri, '<i class="fa fa-reply" aria-hidden="true"></i> 冻结', array('class' => "btn btn-warning btn-xs", 'title'=>'冻结', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}
function btn_edit_disable($uri) {
    return anchor($uri, '<span class="glyphicon glyphicon-pencil"></span>', array('class' => "btn btn-primary btn-xs disabled", 'title'=>'Edit', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}

function btn_edit_modal($uri) {
    return anchor($uri, '<span class="glyphicon glyphicon-pencil"></span>', array('class' => "btn btn-primary btn-xs", 'title'=>'Edit', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'data-toggle'=>'modal', 'data-target'=>'#set_action'));
}

function btn_delete($uri) {
    return anchor($uri, '<i class="fa fa-trash-o"></i> 删除', array(
        'class' => "btn btn-danger btn-xs", 'title'=>'删除', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'onclick' => "return confirm('您确定删除这个订单吗?');"
    ));
}

function btn_passive_pro($uri) {
    return anchor($uri, '<i class="fa fa-reply" ></i> 手动补单处理', array(
        'class' => "btn btn-primary btn-xs", 'title'=>'手动补单处理', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'onclick' => "return confirm('您确定手动处理该订单吗?');"
    ));
}
function btn_freeze($uri) {
    return anchor($uri, '<i class="fa fa-trash-o"></i> 冻结', array(
        'class' => "btn btn-danger btn-xs", 'title'=>'冻结', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'onclick' => "return confirm('您确定要冻结该订单吗?');"
    ));
}

function btn_reject($uri) {
   return anchor($uri, '<i class="fa fa-reply" aria-hidden="true"></i> 拒绝', array('class' => "btn btn-warning btn-xs", 'title'=>'拒绝', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}

function btn_reject_em($uri) {
   return anchor($uri, '<i class="fa fa-reply" aria-hidden="true"></i> 拒绝', array('class' => "btn btn-warning btn-xs", 'title'=>'拒绝', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}

function btn_passive($uri) {
    return anchor($uri, '<i class="fa fa-mail-reply">手动补单</i>', array(
        'class' => "btn btn-info btn-xs", 'title'=>'手动补单', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'onclick' => "return confirm('您确定处理补单？');"
    ));
}

function btn_delete_disable($uri) {
    return anchor($uri, '<i class="fa fa-trash-o"></i>', array(
        'class' => "btn btn-danger btn-xs disabled", 'title'=>'Delete', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
    ));
}
function btn_active($uri) {
    return anchor($uri, '<i class="fa fa-check"></i>', array(
        'class' => "btn btn-success btn-xs", 'title'=>'Active', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'onclick' => "return confirm('You are about to active new sesion . This cannot be undone. Are you sure?');"
    ));
}

function btn_print() {
    return anchor('','<span class="glyphicon glyphicon-print"></i></span>', array('class' => "btn btn-primary btn-xs", 'title'=>'Print','data-toggle'=>'tooltip', 'data-placement'=>'top', 'onclick'=>'printDiv("printableArea")'));
}

function btn_pdf($uri) {
    return anchor($uri, '<span <i class="fa fa-file-pdf-o"></i></span>', array('class' => "btn btn-primary btn-xs",'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'PDF'));
}
function btn_make_pdf($uri) {
    return anchor($uri, '<span <i class="fa fa-file-pdf-o""></i></span>', array('class' => "btn btn-primary btn-xs",'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Generate&nbsp;PDF'));
}
function btn_excel($uri) {
    return anchor($uri, '<span <i class="fa fa-file-excel-o"></i></span>', array('class' => "btn btn-primary btn-xs",'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Excel'));
}

function btn_csv($uri) {
    return anchor($uri, '<span <i class="fa fa-file-excel-o"></i></span>', array('class' => "btn btn-primary btn-xs",'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'CSV'));
}

function btn_view($uri) {
    return anchor($uri, '<span class="fa fa-reply" style="color: white;">退款 </span>', array('class' => "btn btn-info btn-xs",'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'退款', 'onclick' => "return confirm('确定退款操作吗？');"));
}

function btn_view_account($uri) {
    return anchor($uri, '<span class="fa fa-list-alt">查看账户 </span>', array('class' => "btn btn-info btn-xs",'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'查看账户'));
}

function btn_view1($uri) {
    return anchor($uri, '<span class="fa fa-list-alt">详细查看 </span>', array('class' => "btn btn-info btn-xs",'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'详细查看'));
}

function btn_view4($uri) {
    return anchor($uri, '<span class="fa fa-reply" style="color: white;">解放冻结</span>', array(
        'class' => "btn btn-danger btn-xs", 'title'=>'解放冻结', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'onclick' => "return confirm('确定退款操作码？');"
    ));

    return anchor($uri, '<span class="fa fa-reply" style="color: white;">解放冻结 </span>', array('class' => "btn btn-info btn-xs",'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'解放冻结', ));
}

function btn_view2($uri) {
    return anchor($uri, '<span class="fa fa-list-alt">拒绝信息 </span>', array('class' => "btn btn-info btn-xs",'data-toggle'=>'tooltip', 'style'=>"color: antiquewhite", 'data-placement'=>'top', 'title'=>'详细查看'));
}

function btn_view_oreder($uri) {
    return anchor($uri, '<span class="fa fa-list-alt" style="color: white;">订单 </span>', array('class' => "btn btn-info btn-xs",'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'订单'));
}
function btn_view_qr($uri) {
    return anchor($uri, '<span class="fa fa-list-alt"> Print QR</span>', array('class' => "btn btn-info btn-xs",'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'View'));
}
function btn_save($uri) {
    return anchor($uri, '<span <i class="fa fa-plus-circle"></i>完成</span>', array('class' => "btn btn-success btn-xs", 'title'=>'完成', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}

function btn_submit($uri) {
    return anchor($uri, '<span <i class="fa fa-plus-circle"></i>接受</span>', array('class' => "btn btn-success btn-xs", 'title'=>'接受', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}

function btn_submit_view($uri) {
    return anchor($uri, '<span <i class="fa fa-plus-circle"></i>详细信息</span>', array('class' => "btn btn-success btn-xs", 'title'=>'详细信息', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}

function btn_submit_duplicate($uri) {
    return anchor($uri, '<span <i class="fa fa-plus-circle"></i>订单重发</span>', array('class' => "btn btn-success btn-xs", 'title'=>'接受', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}

function btn_add($uri) {
    return anchor($uri, '<span <i class="fa fa-plus-square"></i></span>', array('class' => "btn btn-success btn-xs", 'title'=>'Add Routine', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}

function btn_add_new($uri,$param2) {
    return anchor($uri, '<span <i class="fa fa-plus-square"></i> Add Ehitnic Fund</span>', array('class' => "btn btn-success btn-xs", 'title'=>'Add Ehitnic Fund', 'data-toggle'=>'tooltip', 'data-placement'=>'top','disable' => $ed));
}

function btn_add_wages($uri,$param2) {
    return anchor($uri, '<span <i class="fa fa-plus-square"></i> Add</span>', array('class' => "btn btn-success btn-xs", 'title'=>'Add SPR Wages', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}

function btn_view_wages($uri,$param2) {
    return anchor($uri, '<span <i class="fa fa-list"></i> View</span>', array('class' => "btn btn-info btn-xs", 'title'=>'View SPR Wages', 'data-toggle'=>'tooltip', 'data-placement'=>'top'));
}

function btn_publish($uri) {
return anchor($uri, '<i class="fa fa-check"></i>', array(
        'class' => "btn btn-success btn-xs", 'title'=>'Click to Unpublish', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'onclick' => "return confirm('You are about to unpublish an exam. Are you sure?');"
    ));
}

function btn_unpublish($uri) {
    return anchor($uri, '<i class="fa fa-times"></i>', array(
        'class' => "btn btn-danger btn-xs", 'title'=>'Click to PUblish', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'onclick' => "return confirm('You are about to publish an exam. Are you sure?');"
    ));
}
function btn_set_phrase($uri) {
    return anchor($uri, '<i class="fa fa-check"></i> Set Menu & Heading Phrase', array(
        'class' => "btn btn-success btn-xs", 'title'=>'Menu & Heading Phrase', 'data-toggle'=>'tooltip', 'data-placement'=>'top'
    ));
}
function btn_set_formbody($uri) {
    return anchor($uri, '<i class="fa fa-check"></i> From Body Phrase', array(
        'class' => "btn btn-primary btn-xs", 'title'=>'From Body Phrase', 'data-toggle'=>'tooltip', 'data-placement'=>'top'
    ));
}
