<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 14:08:41
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/product/batch-product-import.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203244398553b3a1e9dfc489-25689857%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e8d1703b618e7bc508f198db9920a61584bdfe4' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/product/batch-product-import.tpl',
      1 => 1396509541,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203244398553b3a1e9dfc489-25689857',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'result' => 0,
    'row' => 0,
    'error' => 0,
    'uploadinfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3a1e9e8bd48_02836508',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3a1e9e8bd48_02836508')) {function content_53b3a1e9e8bd48_02836508($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style type="text/css">
    .tableborder th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;
        width: 30%;
    }
    .tableborder td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    .message-warning
    {
        color: #5f5200;
		padding:5px;
		min-height:300px;
		
    }
    .error
    {
        margin: 0;
        padding: 8px 0 0 0;
        height: 1%;
        display: block;
        clear: both;
        overflow: hidden;
        color: #FF0000;
        padding-left: 20px;
    }
</style>
<div class="content-box  ui-tabs  ui-corner-all" style="height:800px">

    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchProductExport<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3> 
		<div class="clear"></div>       
    </div>
	
	
 	

	

	
	<!--<form action="/merchant/product/batch-product-insert" method="post" id="XLSInputForm">	-->
	<form action="/merchant/product-batch-upload/batch-product-import-preview" method="post" id="XLSInputForm"  enctype="multipart/form-data" onsubmit="return checkform()">	
		<table cellspacing="0" cellpadding="0" class="tableborder">
			<tr>
			<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_upload_file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
			<td><input type="file" name="XMLForInput" id="XMLForInput" /></td>
			</tr>


			<tr>
			<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
sample_file_download<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
			<td>
			<img src="/images/download.png" style="width:25px;"><span style="color:#999"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
download_templete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</span><a  style="color:#666666;text-decoration:underline;" href="/merchant/product-batch-upload/product-batch-import-templete"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_template<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
			</td>
			</tr>	
			
			<tr>
			<td colspan="2" style="padding-left:35%;">
			<input  type="submit"  class="button buttonheight" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
batch_upload<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" />		
			</td></tr>			
			
		</table>
		
	</form>	
<?php if ($_smarty_tpl->tpl_vars['result']->value&&$_smarty_tpl->tpl_vars['result']->value['ask']==1){?>

	<table cellspacing="0" cellpadding="0" class="formtable tableborder"  style="margin-top:10px">
            <thead>
            <tr>
                <th style=" text-align:center" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>             
                <th style=" text-align:center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
notice<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            </tr>
			<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['row']->key;
?>
			
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_sku'];?>
</td><td>
				
				<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
    			<?php echo $_smarty_tpl->tpl_vars['error']->value;?>

    			<?php } ?>
				
				
				</td>
			</tr>
			
			<?php } ?>
            </thead>
            <tbody id='orderproducts'>          

            </tbody>
        </table>
	

<?php }?>

<br/>
<?php if (isset($_smarty_tpl->tpl_vars['uploadinfo']->value)&&($_smarty_tpl->tpl_vars['uploadinfo']->value['ask']=='0')){?>
<div class="message-warning">
   <div><?php echo $_smarty_tpl->tpl_vars['uploadinfo']->value['message'];?>
</div>
    <?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['uploadinfo']->value['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
    <div class="error"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
    <?php } ?>
</div>
<?php }?>

	
</div>



<script type="text/javascript">
    function checkform(){
        if(!$('#XMLForInput').val()){
            alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
make_sure_that_you_have_selected_a_file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
            return false;
        }
        return true;
    }
</script>

<script>
function resetbox(){         
             $("#orderproducts").html('');          

}
</script><?php }} ?>