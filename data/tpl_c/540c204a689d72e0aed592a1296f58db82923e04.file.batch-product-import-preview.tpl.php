<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 14:09:29
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/product/batch-product-import-preview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:61153591553b3a21954a557-27524441%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '540c204a689d72e0aed592a1296f58db82923e04' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/product/batch-product-import-preview.tpl',
      1 => 1396509541,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61153591553b3a21954a557-27524441',
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
  'unifunc' => 'content_53b3a2195fb785_14100379',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3a2195fb785_14100379')) {function content_53b3a2195fb785_14100379($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><script type="text/javascript">

function   checkAll1(){
 
    if($('#checkAll').is(':checked')){	
        $('.checked').attr('checked',true);		
    }else{
        $('.checked').attr('checked',false);
		
    }
}
function  submitBatch(){
    
    var selectedNumber = $('.checked').size();
   
	if(selectedNumber == 0){
    	alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_products_those_need_to_upload<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
table td
.error{
    float: left;
    margin-right: 20px;
    border:1px solid red;
}
table#previewbox td{  text-align:center; }

-->
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchProductExport<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
     </div>

 
<form id="datafrom" action="/merchant/product-batch-upload/do-batch-insert" method="post">

<table cellpadding="0" cellspacing="0" width="100%" id="previewbox">
  <tbody>
  <tr style="background-color: rgb(170, 255, 255);">
    <th  align="center" bgcolor="#AAFFFF"><input id="checkAll" checked="checked" onclick="checkAll1();" type="checkbox"> <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
no<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th  align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF" style="width:30em"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductCategory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
puCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    
    <th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReportingCurrency<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	<th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
declaredValue<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(KG)</th>  
	<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
country_code_of_origin<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th> 
	<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
brand<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
    <tr>
      <td>
      <?php if ($_smarty_tpl->tpl_vars['order']->value['is_valid']=='1'){?>
          <input  type="checkbox"  class="checked" checked="true" value="<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name="select[]" />
      <?php }?>
      </td>
      <td ><?php echo $_smarty_tpl->tpl_vars['order']->value['product_sku'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['product_title'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['pc_name'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['pu_name'];?>
</td>
      
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['currency_code'];?>
</td>
	  <td><?php echo $_smarty_tpl->tpl_vars['order']->value['product_declared_value'];?>
</td>	  
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['product_weight'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['country_title'];?>
</td>
	  <td><?php echo $_smarty_tpl->tpl_vars['order']->value['brand'];?>
</td>
    </tr>
    <?php if ($_smarty_tpl->tpl_vars['order']->value['is_valid']=='0'){?>
    <tr>
       <td colspan="13">
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
    <tr>
       <td colspan="13" style="border-top:1px solid #7766ee">&nbsp;        
       </td>
    </tr>	
  <?php } ?>

 </table>
 
 
 <DIV align="center">
  <INPUT id="checkbuttom" onclick="submitBatch();" class='button' type="button" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
confirm_to_upload_products_those_selected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
</DIV>
</form>
</div>
<script>
/*
$(function(){
   //隔行换色   
    $("#datafrom").alterBgColor();
    
})
*/
</script><?php }} ?>