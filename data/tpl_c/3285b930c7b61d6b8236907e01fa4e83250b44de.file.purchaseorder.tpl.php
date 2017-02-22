<?php /* Smarty version Smarty-3.1.13, created on 2014-07-10 10:17:32
         compiled from "/home/apache/www/import/oms/application/modules/default/views/js/purchaseorder.tpl" */ ?>
<?php /*%%SmartyHeaderCode:75447566853bde543702d15-20460481%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3285b930c7b61d6b8236907e01fa4e83250b44de' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/default/views/js/purchaseorder.tpl',
      1 => 1404955180,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75447566853bde543702d15-20460481',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53bde54375c657_97376741',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bde54375c657_97376741')) {function content_53bde54375c657_97376741($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?>$(function(){
    $('.statusBtn').bind('click',function(){
        var status = $(this).attr('ref');
		$('.status').size();	
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
        if($(this).is(':checked')) {
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


function closePurchaseOrderBody(pobd_id){
    pobd_id = pobd_id||'';
	
    if(pobd_id==''){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseOne<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }

	$('<div title="信息提示(Tips)"><p align=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AreYouSureToDeleteSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p></div>').dialog({
			autoOpen: true,
			width: 300,
			height: 'auto',
			modal: true,
			show:"slide",
			position:[200,'middle'],
			buttons: {
				'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
':function(){
					$(this).dialog("close");
					return;
				},
				'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
					$(this).dialog("close");
					closePurchaseOrderBodyAction(pobd_id);
				}
			},
			close: function() {
					return;
			}
		});
}

function closePurchaseOrderBodyAction(pobd_id){
	pobd_id = pobd_id||'';	
    if(pobd_id==''){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseOne<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }
   
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/purchase-order/close-purchase-orderbody",
        data:{pobd_id:pobd_id},
        success:function (json) {
            var html = "<strong>"+json.message+"</strong>";			 	
            if(json.ask=='1'){
                alertTipclose(html);
            }else{               
                alertTip(html);
            }
            
        }
    });
}





function closePurchaseOrder(po_id){
    po_id = po_id||'';
	
    if(po_id==''){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseOne<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }

	$('<div title="信息提示(Tips)"><p align=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AreYouSureToDeleteSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p></div>').dialog({
			autoOpen: true,
			width: 300,
			height: 'auto',
			modal: true,
			show:"slide",
			position:[200,'middle'],
			buttons: {
				'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
':function(){
					$(this).dialog("close");
					return;
				},
				'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
					$(this).dialog("close");
					closePurchaseOrderAction(po_id);
				}
			},
			close: function() {
					return;
			}
		});
}

function closePurchaseOrderAction(po_id){
    
	po_id = po_id||'';	
    if(po_id==''){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseOne<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }
   
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/purchase-order/close-purchase-order",
        data:{po_id:po_id},
        success:function (json) {
            var html = "<strong>"+json.message+"</strong>";			 	
            if(json.ask=='1'){
                alertTipclose(html);
            }else{               
                alertTip(html);
            }
            
        }
    });
}




function alertTipclose(tip,width,height,notflash){
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="信息提示(Tips)"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
        height: height,
        modal: true,
        show:"slide",
        buttons: {
        '关闭(Close)': function() {
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
}<?php }} ?>