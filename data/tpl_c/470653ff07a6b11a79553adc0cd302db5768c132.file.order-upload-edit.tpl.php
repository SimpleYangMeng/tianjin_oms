<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 15:33:48
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/order/order-upload-edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90073341753b3b5dc6d99a0-89888874%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '470653ff07a6b11a79553adc0cd302db5768c132' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/order/order-upload-edit.tpl',
      1 => 1396509525,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90073341753b3b5dc6d99a0-89888874',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'uploadData' => 0,
    'order' => 0,
    'index' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3b5dc79d342_68699712',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3b5dc79d342_68699712')) {function content_53b3b5dc79d342_68699712($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><script type="text/javascript">

function   checkAll1(){
 
    if($('#checkAll').is(':checked')){
        $('.checked').attr('checked',true)
    }else{
        $('.checked').attr('checked',false)
    }
}
function  submitBatch(){
    var checked = false;
    $('.checked').each(function(){
        if($(this).is(':checked')){
            checked = true;
        }
    })
    
    if(checked == false){
   	 	alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_select_the_operation_order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
       return false;
    }
    if($('#selectBatch').val() == ''){
    	alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Choose_the_operation_order_line<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
        return false;
    }
	$('#datafrom').submit();
}

</script> 
 <style>
<!--
#editUpload table,  #editUpload td,#editUpload th{
	border: solid 1px  #AAFFFF; 
 
	border-collapse:collapse;
	text-align:center;
}
 #editUpload th{
	-moz-background-clip:border;
	-moz-background-inline-policy:continuous;
	-moz-background-origin:padding;
	background:#F79732 none repeat scroll 0 0;
	color:#FFFFFF;
	
	line-height:30px;

}
.tablebiaoge{ border-collapse:collapse}
.tablebiaoge td{border:1px solid #AAFFFF}

.error{
    float: left;
    margin-right: 20px;
    border:1px solid red;
}


-->
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
batch-order-upload<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
     </div>

 
<form id="datafrom" action="/merchant/order-upload/import" method="post">

<table cellpadding="0" cellspacing="0" width="100%">
  <tbody>
  <tr style="background-color: rgb(170, 255, 255);">
    <th  align="center" bgcolor="#AAFFFF"><input id="checkAll" checked="checked" onclick="checkAll1();" type="checkbox"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
no<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
OrderMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Targetwarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The_recipient_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
address1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
phone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
transaction_currency<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
IdentificationNumbers<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
  </tr>
 </tbody>
  <?php  $_smarty_tpl->tpl_vars['order'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['order']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['uploadData']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['order']->key => $_smarty_tpl->tpl_vars['order']->value){
$_smarty_tpl->tpl_vars['order']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['order']->key;
?>
    <tr >
      <td>
      <?php if ($_smarty_tpl->tpl_vars['order']->value['is_valid']=='1'){?>
          <input class="checked" type="checkbox"  checked="true" value="<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name="select[]">
      <?php }?>
      </td>
      <td><?php if ($_smarty_tpl->tpl_vars['order']->value['order_mode_type']=='1'){?>集货模式<?php }else{ ?>备货模式<?php }?></td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['warehouse_name'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['to_warehouse_name'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['oab_state_name'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['sm_code'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['reference_no'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['oab_firstname'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['oab_street_address1'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['oab_phone'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['currency_code'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['idNumber'];?>
</td>
    </tr>
    <?php if ($_smarty_tpl->tpl_vars['order']->value['is_valid']=='0'){?>
    <tr>
       <td colspan="13" style="border-bottom:1px solid #0000ff;">
         <?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order']->value['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
         <div class="error">
            <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

         </div>
         <?php } ?>
       </td>
    </tr>
    <?php }?>
  <?php } ?>

 </table>
 
 
 <DIV align="center">
  <INPUT id="checkbuttom" onclick="submitBatch();" class='button' type="button" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
import_order_data<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
</DIV>
</form>
</div>
<?php }} ?>