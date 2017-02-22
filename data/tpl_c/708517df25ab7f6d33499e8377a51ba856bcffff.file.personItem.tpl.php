<?php /* Smarty version Smarty-3.1.13, created on 2015-11-13 15:23:48
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\default\views\js\personItem.tpl" */ ?>
<?php /*%%SmartyHeaderCode:42345645900400fcb8-25588196%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '708517df25ab7f6d33499e8377a51ba856bcffff' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\default\\views\\js\\personItem.tpl',
      1 => 1446259375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '42345645900400fcb8-25588196',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_564590040d2406_75699337',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_564590040d2406_75699337')) {function content_564590040d2406_75699337($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?>$(function(){
    $('.statusBtn').bind('click',function(){
        var status = $(this).attr('ref');
        $('.status').val(status);
        $('.statusBtn').removeClass('btn-active');
        $(this).addClass('btn-active');
		$('#pagerForm #page').val(1);
        $('#pagerForm').submit();
    });
    $(".order_product").hide();
    $(".foldToggle").click(function(){
        var v = $(this).attr("value");
        if(v=="1"){
            $(".order_product").hide();
            $(this).attr("value","0");
            $(".order_product").each(function(){
               $(this).attr("status","0");
            });
        }else{
            $(".order_product").show();
            $(this).attr("value","1");
            $(".order_product").each(function(){
                $(this).attr("status","1");
            });
        }
    })
    //处理订单
    $('.ordercheckAll').die('click').live('click',function(){
        if ($(this).is(':checked')) {
            $(".orderArr").attr('checked', true);
			
        } else {
            $(".orderArr").attr('checked', false);
        }
		changeTrColor();
    });
	
	/*伴随全选按钮是否选中而变色*/
	function changeTrColor(){
	
		$(".orderArr").each(function(){
				_this = $(this);
				if($('.ordercheckAll').is(':checked')){			
					set_tr_class(_this.parent().parent(), true);			
				}else{			
					set_tr_class(_this.parent().parent(), false);		
				}					
						
		});		
	}

    $('#batchSubmit').die().bind('click',function(){
        if($('#batchSelect').val()==''){
            alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
','500','auto','1');
        }else{
            switch($('#batchSelect').val()){
                case "submitOrder":
                    submitOrder();
                    break;
                case "bacthConfirm":
                    bacthConfirm();
                    break;
                case "bacthDelete":
                    bacthDelete();
                    break;
                case 'movedraft':
                    movedraft();
                    break;
                case 'deleteToDraft':
                    deleteToDraft();
                    break;
                default:
                    alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InvalidParameter<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
','500','auto','1');
            }
        }
    })

});
function showProduct(ordersCode){
    var status = $("#"+ordersCode).attr("status");
    if(status=="1"){
        $("#"+ordersCode).attr("status","0");
        $("#"+ordersCode).hide();
    }else{
        $("#"+ordersCode).attr("status","1");
        $("#"+ordersCode).show();
    }
}

//set_tr_class($(this).parent().parent(), true);

/*批量确认*/
function bacthConfirm(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }
    var param = $("#orderDataForm").serialize();
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/order/confirm",
        data:param,
        success:function (json) {
            var html = ""+json.message+"";
            if(json.ask=='1'){
                alertTipclose(html);
            }else{
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTip(html);
            }
            $('#searchorderForm').submit();
        }
    });
}
function submitOrder(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }
    var param = $("#orderDataForm").serialize();
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/order/submit",
        data:param,
        success:function (json) {
            var html = ""+json.message+"";
            if(json.ask=='1'){
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTipclose(html);
            }else{
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTip(html);
            }
            $('#searchorderForm').submit();
        }
    });
}
/*删除*/
function movedraft(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }
    var param = $("#orderDataForm").serialize();
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/order/draft",
        data:param,
        success:function (json) {
            var html = ""+json.message+"";
            if(json.ask=='1'){
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTipclose(html);
            }else{
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTip(html);
            }
            $('#searchorderForm').submit();
        }
    });
}
function bacthDelete(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }
    var param = $("#orderDataForm").serialize();
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/order/delete",
        data:param,
        success:function (json) {
            var html = ""+json.message+"";
            if(json.ask=='1'){
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTipclose(html);
            }else{
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTip(html);
            }
            $('#searchorderForm').submit();
        }
    });
}
function alertTip(tip,width,height,notflash) {
  
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tip_esc_escape<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
        height: height,
        modal: true,
        show:"slide",
        buttons: {
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                $(this).dialog('close');
                if(!(typeof(notflash)!="undefined" && notflash=='1')){
                    $('#pagerForm').submit();
                }
            }
        },
        close: function() {

        }
    });
}
function alertTipclose(tip,width,height,notflash){
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tip_esc_escape<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
        height: height,
        modal: true,
        show:"slide",
        buttons: {
        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
        $(this).dialog('close');
        if(!(typeof(notflash)!="undefined" && notflash=='1')){
            $('#pagerForm').submit();
        }
        }
        },
        close: function() {
            //$('#searchorderForm').submit();
            $('#pagerForm').submit();
        }
    });
}
function deleteToDraft(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }
    var param = $("#orderDataForm").serialize();
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/order/delete-to-draft",
        data:param,
        success:function (json) {
            var html = ""+json.message+"";
            if(json.ask=='1'){
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTipclose(html);
            }else{
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTip(html);
            }
            $('#searchorderForm').submit();
        }
    });
}

function batchPrintCode(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }
    $("#orderDataForm").attr("action","/merchant/order/batch-print-label");
    $("#orderDataForm").attr("target","_blank");
    $("#orderDataForm").submit();
    $("#orderDataForm").attr("action","");
}<?php }} ?>