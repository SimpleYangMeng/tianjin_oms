<?php /* Smarty version Smarty-3.1.13, created on 2014-07-10 10:22:24
         compiled from "/home/apache/www/import/oms/application/modules/default/views/js/purchaseorderTracking.tpl" */ ?>
<?php /*%%SmartyHeaderCode:113097843353bdf8e0137052-74191478%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e57080366685280794840e0bb8fed105c939205a' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/default/views/js/purchaseorderTracking.tpl',
      1 => 1404955177,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113097843353bdf8e0137052-74191478',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53bdf8e0177b90_62251372',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bdf8e0177b90_62251372')) {function content_53bdf8e0177b90_62251372($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?>$(function(){

	$('.ordercheckAll').die('click').live('click',function(){
		if($(this).is(':checked')) {
			$(".orderArr").attr('checked', true);
		} else {
			$(".orderArr").attr('checked', false);
		}
		 changeTrColor();
	});
	
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
		
e		
	}		

function closePurchaseOrderTrackingBody(po_tb_id,is_force){
    po_tb_id = po_tb_id||'';
	is_force = is_force||'0';
    if(po_tb_id==''){
        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseOne<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        return;
    }
	closePurchaseOrderTrackingBodyAction(po_tb_id,is_force);	
}

function closePurchaseOrderTrackingBodyAction(po_tb_id,is_force){
	po_tb_id = po_tb_id||'';	
	is_force = is_force||'0';	
	
	
    if(po_tb_id==''){
		if(is_force=='1'){
			alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseOne<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
		}else{
			alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseOne<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','0');
			
		}
        
        return;
    }
	if(is_force=='1'){
		$(global_alertTip).dialog('close');	
			
	}
	
	
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/purchase-order/close-purchase-order-tracking-body",
        data:{po_tb_id:po_tb_id,is_force:is_force},
        success:function (json) {
            var html = "<strong>"+json.message+"</strong>";			 	
            if(json.ask=='1'){
                alertTipclose(html);
            }else{  
			
			    if(json.is_overpass_error=='1'){
					html+= '<br/><br/><a  class=\"button\" href=\"\" onclick=\"closePurchaseOrderTrackingBody('+po_tb_id+',\'1\');return false;\">强制转为已审核</a>';
				}             
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