<?php /* Smarty version Smarty-3.1.13, created on 2015-11-16 09:34:49
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\pay\views\payOrder\pay_order_batch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:561556492feccb2a66-37962291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd638985e49b466aaf2ff2579688a79c6310af0f8' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\pay\\views\\payOrder\\pay_order_batch.tpl',
      1 => 1447637445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '561556492feccb2a66-37962291',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56492fecd56f60_31150893',
  'variables' => 
  array (
    'uploadinfo' => 0,
    'error' => 0,
    'uploadResult' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56492fecd56f60_31150893')) {function content_56492fecd56f60_31150893($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
.tableborder th{ text-align: right;height: 20px;line-height: 20px;padding:5px;width: 30%;}
.tableborder td{ text-align: left;height: 20px;line-height: 20px;padding:5px;}
.tableborder a { color: #4377ab; text-decoration: none;}
.tableborder a:hover { color: #FF7600;}
.message-warning { margin-top: 10px;}
.message-warning .message-title { text-align: center; padding: 10px 0; font-size: 14px; font-weight: 700; }
div.error { margin: 2px 0 0 0; height: 30px; line-height: 30px; padding: 0 0px 0 20px;}
.error{margin: 0;padding: 8px 0 0 0;height: 1%;display: block;clear: both;overflow: hidden;color: #FF0000;padding-left: 20px;}
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
<div class="content-box-header">
	<h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay-order-batch-upload<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
	<div class="clear"></div>
</div>
<form action="/pay/pay-order/batchcheck" enctype="multipart/form-data" method="post" id='batchUploadForm' onsubmit="return checkform()">
	<table cellspacing="0" cellpadding="0" class="tableborder">
		<tr>
			<th>请选择要上传的文件:</th>
			<td>
				<input type="file" size="25" id="PayOrderUpload" name="PayOrderUpload" class="text-input">
				<font style="color:red;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_xls_file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</font>
			</td>
		</tr>
		<tr>
			<th>样例文件下载:</th>
			<td>
				<img style="width:25px;" align="absmiddle" src="/images/download.png" />
				<a href="/pay/pay-order/down-templete/file/orderupload">批量上传模板</a>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<input class="button" type="submit" value="批量上传">
			</td>
		</tr>
	</table>
</form>
</div>

<!-- 上传文件错误信息 begin-->
<?php if (isset($_smarty_tpl->tpl_vars['uploadinfo']->value)&&($_smarty_tpl->tpl_vars['uploadinfo']->value['ask']=='0')){?>
<div class="message-warning content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
	<div class="content-box-header cl">
		<h3 style="margin-left:5px; color: red;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
错误信息<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
	</div>
	<div class="message-title"><?php echo $_smarty_tpl->tpl_vars['uploadinfo']->value['message'];?>
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
<!-- 上传文件错误信息 end-->

<!-- 导入结果 begin-->
<?php if (isset($_smarty_tpl->tpl_vars['uploadResult']->value)&&$_smarty_tpl->tpl_vars['uploadResult']->value!=''){?>
<div class="message-warning" style="display: none;">
	<?php echo $_smarty_tpl->tpl_vars['uploadResult']->value;?>

</div>
<?php }?>
<!-- 导入结果 end-->

<script type="text/javascript">

	//验证表单
    function checkform(){
        if(!$('#PayOrderUpload').val()){
            alertTip('请选择文件');
            return false;
        }
        return true;
    }
    
    $(function(){
    	
    	//导出结果 dialog
		<?php if (isset($_smarty_tpl->tpl_vars['uploadResult']->value)&&$_smarty_tpl->tpl_vars['uploadResult']->value!=''){?>
	        $('.message-warning').dialog({
	        	title: '导入结果(Import results)',
	            autoOpen: false,
	            modal: false,
	            bgiframe:true,
	            width: 800,
	            height:'auto',
	            resizable:false,
	            close: function() {
	                //window.location.href='/merchant/order/listjh';
	            }
	        });
			$('.message-warning').show().dialog('open');
        <?php }?>
        
    });
    
</script><?php }} ?>