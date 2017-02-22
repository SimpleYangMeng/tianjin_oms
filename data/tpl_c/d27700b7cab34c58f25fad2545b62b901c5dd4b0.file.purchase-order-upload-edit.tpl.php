<?php /* Smarty version Smarty-3.1.13, created on 2014-07-10 10:18:48
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/purchaseOrder/purchase-order-upload-edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:195176671753bdf8088800e1-33210071%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd27700b7cab34c58f25fad2545b62b901c5dd4b0' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/purchaseOrder/purchase-order-upload-edit.tpl',
      1 => 1404895720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195176671753bdf8088800e1-33210071',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'uploadData' => 0,
    'order' => 0,
    'index' => 0,
    'product_sku' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53bdf8088e2af0_34090579',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bdf8088e2af0_34090579')) {function content_53bdf8088e2af0_34090579($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
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
   	 	alertTip('请选择需要操作的采购订单');
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
purchase-order-batch-upload<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
     </div>

 
<form id="datafrom" action="/merchant/purchase-order-batch-upload/import" method="post">

<table cellpadding="0"   cellspacing="0" width="100%">
  <tbody>
  <tr style="background-color: rgb(170, 255, 255);">
    <th  align="center" bgcolor="#AAFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="checkAll" checked="checked" onclick="checkAll1();" type="checkbox"> 序号</th>
    <th  align="center" bgcolor="#AAFFFF">采购订单</th>
    <th  align="center" bgcolor="#AAFFFF">供应商代码</th>

    <th align="center" bgcolor="#AAFFFF">产品SKU</th> 
	<th align="center" bgcolor="#AAFFFF">采购数量</th> 
    <th  align="center" bgcolor="#AAFFFF">备注</th>
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
      <td style="text-align:center">
      <?php if ($_smarty_tpl->tpl_vars['order']->value['is_valid']=='1'){?>
          <input class="checked" type="checkbox"  checked="true" value="<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name="select[]">
      <?php }?>
      </td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['po_code'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['order']->value['supply_code'];?>
</td>
      
   

      <td>
	     <?php  $_smarty_tpl->tpl_vars['product_sku'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product_sku']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['order']->value['product_sku']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product_sku']->key => $_smarty_tpl->tpl_vars['product_sku']->value){
$_smarty_tpl->tpl_vars['product_sku']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['product_sku']->key;
?>
     		<?php echo $_smarty_tpl->tpl_vars['product_sku']->value;?>
<br/>			
			
 		 <?php } ?>
	  
	  </td>
 
       <td style="text-align:center">
	     <?php  $_smarty_tpl->tpl_vars['product_sku'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product_sku']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['order']->value['product_sku']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product_sku']->key => $_smarty_tpl->tpl_vars['product_sku']->value){
$_smarty_tpl->tpl_vars['product_sku']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['product_sku']->key;
?>
     		<?php echo $_smarty_tpl->tpl_vars['order']->value['sku'][$_smarty_tpl->tpl_vars['index']->value];?>
<br/>		
 		 <?php } ?>
	  
	  </td>
	  
	   <td><?php echo $_smarty_tpl->tpl_vars['order']->value['po_description'];?>
</td>
      
    </tr>
    <?php if ($_smarty_tpl->tpl_vars['order']->value['is_valid']=='0'){?>
    <tr>
       <td colspan="12" style="border-bottom:1px solid #0000ff;">
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
  <INPUT id="checkbuttom" onclick="submitBatch();" class='button' type="button" value="导入采购单"/>
</DIV>
</form>
</div>
<?php }} ?>