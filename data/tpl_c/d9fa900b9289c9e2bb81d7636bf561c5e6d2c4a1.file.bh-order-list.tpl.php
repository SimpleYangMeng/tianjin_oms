<?php /* Smarty version Smarty-3.1.13, created on 2015-11-16 09:22:26
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\order\bh-order-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:527556492fd2b52de5-57588766%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9fa900b9289c9e2bb81d7636bf561c5e6d2c4a1' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\order\\bh-order-list.tpl',
      1 => 1447406231,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '527556492fd2b52de5-57588766',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'orders_status' => 0,
    'params' => 0,
    'customerLogin' => 0,
    'customerList' => 0,
    'customer' => 0,
    'shipType' => 0,
    'st' => 0,
    'warehouse' => 0,
    'w' => 0,
    'orderStatusArr' => 0,
    'k' => 0,
    'v' => 0,
    'result' => 0,
    'item' => 0,
    'row' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56492fd30688c6_29529315',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56492fd30688c6_29529315')) {function content_56492fd30688c6_29529315($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
.btn:hover, .btn:focus, .btn-active, .btn-sub {
	background: #5998D7;
	color: #333;
}
</style>

<div
	class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
	<div class="content-box-header">
		<h3 class="clearborder" style="margin-left: 5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
StockingOrderList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
	</div>
	<form name="searchASNForm" method="post"
		action="/merchant/order/listbh" id="pagerForm">
		<input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" /> <input
			type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
		<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['orders_status']->value;?>
" name="orders_status"
			class='status'> <input type="hidden" value="0"
			name="order_mode_type" id="order_mode_type"> <input
			type="hidden" value="xls" name="dateformate" class='dateformate'>
		<div class="searchBar">
			<table id="searchbartable" class="left searchbartable">
				<tbody>
					<tr>
						<td nowrap="nowrap" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
TradingOrderNo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td style="text-align: left;" class="nowrap"><input
							type="text" class="text-input width120 leftloat"
							name="orders_code" id='orders_code'
							value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&!empty($_smarty_tpl->tpl_vars['params']->value['order_code'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['order_code'];?>
<?php }?>"></td>
						<td>
							<div class="simplesearchsubmit nowrap"
								style="float: left; margin-top: 4px;">

								<a onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
								<a type="button" class="button foldToggle" value="0"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Expand<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Collapse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
								<a type="button" class="button export"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
								<a class="switch_search_model"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>

							</div>
						</td>


					</tr>

					<tr class="advanced_element">
						<td class="nowrap text_right">客户代码：</td>
						<td><select class="text-input width135" name='customer_code'>
								<?php if ($_smarty_tpl->tpl_vars['customerLogin']->value['customer_type']!='1'){?>
								<option value=''>全部</option> <?php }?> <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customerList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
								<option value='<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
'<?php if ($_smarty_tpl->tpl_vars['customer']->value==$_smarty_tpl->tpl_vars['params']->value['customer_code']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
</option>
								<?php } ?>
						</select></td>
						<td colspan="2">&nbsp;</td>
					</tr>

					<tr class="advanced_element">
						<td nowrap="nowrap" class="nowrap text_right">
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td><select name="shipping_method"
							class="text-input width135" style="width: 135px;">
								<option value="">-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
-</option> <?php  $_smarty_tpl->tpl_vars['st'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['st']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['shipType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['st']->key => $_smarty_tpl->tpl_vars['st']->value){
$_smarty_tpl->tpl_vars['st']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['st']->key;
?>
								<option value='<?php echo $_smarty_tpl->tpl_vars['st']->value['sm_code'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&$_smarty_tpl->tpl_vars['params']->value['sm_code']==$_smarty_tpl->tpl_vars['st']->value['sm_code']){?> selected<?php }?>
									><?php echo $_smarty_tpl->tpl_vars['st']->value['sm_code'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['st']->value['sm_name_cn'];?>
</option> <?php } ?>
						</select></td>
						<td nowrap="nowrap" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td style="text-align: left"><input type="text"
							class="datepicker text-input width120"
							value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&!empty($_smarty_tpl->tpl_vars['params']->value['add_time_starte'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['reference_no_like'];?>
<?php }?>" name="add_time_start"
							readonly="true">&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp; <input
							type="text" class="datepicker text-input width120"
							value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&!empty($_smarty_tpl->tpl_vars['params']->value['add_time_end'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['add_time_end'];?>
<?php }?>" name="add_time_end"
							readonly="true"> <input type="hidden"
							value="<?php echo $_smarty_tpl->tpl_vars['orders_status']->value;?>
" name="orders_status" class="status">
						</td>
					</tr>

					<tr class="advanced_element">
						<td nowrap="nowrap" class="nowrap text_right">物流仓储企业：</td>
						<td><select name="warehouse_id" class="text-input width135"
							style="width: 135px;">
								<option value="">-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
-</option> <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
								<option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&$_smarty_tpl->tpl_vars['params']->value['warehouse_id']==$_smarty_tpl->tpl_vars['w']->value['warehouse_id']){?>
									selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_code'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_name'];?>
</option>
								<?php } ?>
						</select></td>
						<td class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ShippingTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td><input type="text"
							class="datepicker text-input width120"
							value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&!empty($_smarty_tpl->tpl_vars['params']->value['shipDateFor'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['shipDateFor'];?>
<?php }?>" name="shipDateFor"
							readonly="true">&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp; <input
							type="text" class="datepicker text-input width120"
							value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&!empty($_smarty_tpl->tpl_vars['params']->value['shipDateTo'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['shipDateTo'];?>
<?php }?>" name="shipDateTo" readonly="true">

						</td>

					</tr>
					<tr class="advanced_element">
						<td class="form_title">交易订单号模糊搜索：</td>
						<td style="text-align: left"><input type="text"
							id="reference_no_like" name="reference_no_like"
							class="text-input width120 leftloat"
							value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&!empty($_smarty_tpl->tpl_vars['params']->value['reference_no_like'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['reference_no_like'];?>
<?php }?>"></td>
						<td></td>
						<td></td>
					</tr>

					<tr class="advanced_element">
						<td colspan="6" style="text-align: left">

							<div class="advancedsearchsubmit">

								<a onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
								<a type="button" class="button foldToggle" value="0"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Expand<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Collapse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
								<a type="button" class="button export"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
								<a class="switch_search_model"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
							</div>

						</td>
					</tr>

				</tbody>
			</table>

		</div>
	</form>

</div>


<div class="btn_wrap">
	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orderStatusArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?> <input
		class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['orders_status']->value==$_smarty_tpl->tpl_vars['k']->value){?> btn-active<?php }?>"
		value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
'
		id='statusBtn<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
'> <?php } ?>
</div>

<div class="bulk-actions align-left"
	style="margin-top: 10px; margin-bottom: 10px; border-radius: 4px 4px 4px 4px;">
	<?php if ($_smarty_tpl->tpl_vars['orders_status']->value=="0"){?>
	<!--<select name="dropdown" class="text-input width180" id="batchSelect">
        <option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
        <option value='deleteToDraft'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDraft<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>-->
	<!--<option value='bacthDelete'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchDelete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>-->
	<!--</select>-->
	<a class="button" href="#" onclick="movedraft()"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDraft<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	<!--<a class="button" href="#" id="batchSubmit"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
	<?php }elseif($_smarty_tpl->tpl_vars['orders_status']->value=='1'){?>
	<!--<select name="dropdown" class="text-input width180" id="batchSelect">
        <option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
        <option value='bacthConfirm'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchConfirm<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
        <option value='bacthDelete'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchDelete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
      </select>-->
	<a class="button" href="#" onclick="bacthConfirm();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchConfirm<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	<a class="button" href="#" onclick="bacthDelete();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchDelete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	<!--<a class="button" href="#" id="batchSubmit"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->

	<?php }elseif($_smarty_tpl->tpl_vars['orders_status']->value=='2'){?>
	<!--<select name="dropdown" class="text-input width180" id="batchSelect">
        <option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
        <option value='submitOrder'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SubmitOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
        <option value='movedraft'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDraft<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
      </select>-->
	<a class="button" href="#" onclick="submitOrder();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SubmitOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	<a class="button" href="#" onclick="movedraft();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDraft<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	<!--<a class="button" href="#" id="batchSubmit"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
	<!--</div>-->
	<?php }elseif($_smarty_tpl->tpl_vars['orders_status']->value=='3'){?>

	<!--<select name="dropdown" class="text-input width180" id="batchSelect">
        <option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
        <option value='submitOrder'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SubmitOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
    </select>
    <a class="button" href="#" id="batchSubmit"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
	<a class="button" href="#" onclick="submitOrder();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SubmitOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	<a class="button" href="#" onclick="movedraft();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDraft<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	<a class="button" href="#" onclick="bacthDelete();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDelete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	<a class="button" id="ExceptionOrder" href="#"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ExceptionOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	<!--</div>-->
	<?php }?>
</div>
<div class="clear"></div>



<form method="post" id='orderDataForm'>
	<table id="loadData" class="table" width="100%" layoutH="138">
		<thead class="caption">
			<tr>
				<th style="text-align: center; width: 30px;"><input
					type="hidden" value="xls" name="dateformate" class='dateformate'>
					<input type="checkbox" class="ordercheckAll"></th>
				<th style="text-align: center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th style="text-align: center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>

				<?php if (isset($_smarty_tpl->tpl_vars['params']->value['order_status_from'])&&($_smarty_tpl->tpl_vars['params']->value['order_status_from']=='8,9,10,11,12'||$_smarty_tpl->tpl_vars['params']->value['order_status_from']=='13')){?>
				<th style="text-align: center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ServiceTrackingNumber<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<?php }?>

				<th style="text-align: center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th style="text-align: center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th style="text-align: center;">物流仓储企业</th>
				<th style="text-align: center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BuyerIdNumber<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>

				<th style="text-align: center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th> <?php if ($_smarty_tpl->tpl_vars['orders_status']->value=='18'){?>
				<th style="text-align: center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th> <?php }else{ ?>
				<th style="text-align: center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th> <?php }?>
			</tr>
		</thead>
		<tbody>
			<?php if ($_smarty_tpl->tpl_vars['result']->value!=''){?> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
			<tr target="pid" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_id'];?>
">
				<td width="30" style="text-align: center;"><input
					type="checkbox" name="orderArr[]" ref="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
"
					class="orderArr" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" /></td>
				<td style="width: 30px; text-align: center" nowrap="nowrap"><a
					href="javascript:void(0);"
					onclick="showProduct('<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
')"><?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
</a></td>
				<td style="width: 30px; text-align: center" nowrap="nowrap"><a
					href="javascript:void(0);"
					onclick="showProduct('<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
')"><?php echo $_smarty_tpl->tpl_vars['item']->value['reference_no'];?>
</a></td>

				<?php if ($_smarty_tpl->tpl_vars['params']->value['order_status_from']=='8,9,10,11,12'||$_smarty_tpl->tpl_vars['params']->value['order_status_from']=='13'){?>
				<td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['item']->value['tracking_number'];?>
</td>
				<?php }?>

				<td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['item']->value['sm_code'];?>
</td>
				<td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['item']->value['province_name'];?>
</td>
				<td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['item']->value['warehouse_name'];?>
</td>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['item']->value['idNumber'];?>
</td>

				<td style="text-align: center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['add_time'];?>
</td>
				<td style="text-align: center"><?php if ($_smarty_tpl->tpl_vars['orders_status']->value=='18'){?>

					<?php if ($_smarty_tpl->tpl_vars['item']->value['order_status']=='0'){?> 删除 <?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='1'){?> 草稿 <?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='3'){?> 异常 <?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='4'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='5'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='6'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='7'){?> 已提交
					<?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='8'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='9'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='10'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='11'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='12'){?> 仓库出货 <?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='13'){?> 已签收 <?php }else{ ?> 未知 <?php }?> <?php }else{ ?>
					<?php if ($_smarty_tpl->tpl_vars['orders_status']->value=='4,5,6,7'){?> <?php if ($_smarty_tpl->tpl_vars['item']->value['intercept_status']=='0'){?> <a
					onclick="lanjie('<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
')">拦截</a> <?php }?> <?php }?> <!--<a class="button" href="/merchant/order/create?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" target="dialog" rel="dlg_page9" max="true" minable='false' resizable='false'><span>修改</span></a>-->
					<!--<a class="edit" href="/merchant/order/create?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" target="navTab" rel=''  title="修改订单" ><span>修改</span></a>-->
					<a class="edit"
					href="/merchant/order/detail?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
"
					onclick="parent.openMenuTab('/merchant/order/detail?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
)','orderdetail<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
');return false;"
					title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
view<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a> <!--<a class="delete" href="/merchant/order/del?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a>-->
					<?php if ($_smarty_tpl->tpl_vars['item']->value['order_status']=='1'){?> <a class="edit"
					href="/merchant/order/create?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
"
					onclick="parent.openMenuTab('/merchant/order/create?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
EditOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
)','orderedit<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
');return false;"
					title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
EditOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>

					<?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='2'){?> <?php }?> <?php }?>
				</td>
			</tr>
			<tr class="order_product son" id="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" status="0">
				<td colspan="10">
					<table
						style="float: left; width: 100%; margin: 0; padding: 0; border: 1px solid #CCCCCC; border-collapse: collapse;">
						<tr>
							<td style="text-align: center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
							<td style="text-align: center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
							<td style="text-align: center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
totalweight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(KG)</td>
							<td style="text-align: center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
declaredValue<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
						</tr>
						<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['order_product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
						<tr>
							<td style="text-align: center" nowrap="nowrap"><a
								class="edit" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"
								onclick="parent.openMenuTab('/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
','产品详细(<?php echo $_smarty_tpl->tpl_vars['row']->value['product_sku'];?>
)','productdetail<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
');return false;">
									<span><?php echo $_smarty_tpl->tpl_vars['row']->value['product_sku'];?>
</span>
							</a></td>
							<td style="text-align: center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['row']->value['op_quantity'];?>
</td>
							<td style="text-align: center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['row']->value['totalWeight'];?>
</td>
							<td style="text-align: center" nowrap="nowrap">
								<!--<?php echo $_smarty_tpl->tpl_vars['row']->value['totalValue'];?>
!-->&nbsp;
							</td>
						</tr>
						<?php } ?>
					</table>
				</td>
			</tr>
			<?php } ?> <?php }else{ ?>
			<tr>
				<td colspan="10" style="text-align: center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
			</tr>
			<?php }?>

		</tbody>
	</table>
</form>

<!--<div class="panelBar">
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="10" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==10){?>selected<?php }?>>10</option>
                <option value="20" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==20){?>selected<?php }?>>20</option>
                <option value="50" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==50){?>selected<?php }?>>50</option>
                <option value="100" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==100){?>selected<?php }?>>100</option>
            </select>
            <span>条，共<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
条数据</span>
        </div>
      </div>-->
<div class="clear"></div>
<div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
"
	numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"></div>

<div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display: none">
	<input type="radio" name="exportType" value="1" checked="checked"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
selected_orders<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<input
		type="radio" name="exportType" value="0"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<!--<input type="radio" name="exportformat" value="csv">csv
 <input type="radio" name="exportformat" value="xls" checked="checked">xls-->
</div>

<div id="ExceptionOrderDialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"
	style="display: none">
	<input type="radio" name="exportType" value="1" checked="checked"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
selected_orders<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<input
		type="radio" name="exportType" value="0"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</div>


<div id="lanjieContent">
	<p>
		&nbsp;&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:<span id="order_codespan"></span><input
			type="hidden" value="" name="lanjie_order_code"
			id="lanjie_order_code">
	</p>
	<p>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Interception_reason<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:
		<textarea name="lanjieyuanyin" id="lanjieyuanyin"></textarea>
	</p>
</div>

<script>
$(function(){
  $("#loadData").alterBgColor();
  $("#searchbartable").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"bhlist_search_mode"});

  $('#ExceptionOrderDialog').dialog({
    autoOpen: false,
    modal: false,
    bgiframe:true,
    width: 850,
    resizable: true,
    close:function(){
            //alert('close');
          },
          buttons:{
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
              $('#ExceptionOrderDialog').dialog('close');
            },'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
              var exportType  = $('#ExceptionOrderDialog [name=exportType]:checked').val();

              if(exportType=='1'){
                var checkedSizesize = $('.orderArr:checked').size();
                if(checkedSizesize == 0){
                  alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
                  return;
                }
                $('#orderDataForm').attr('action','/merchant/order/export_execption');
                $('#orderDataForm').submit(); 
                $('#orderDataForm').attr('action','/merchant/order/listbh');  
              }else{
                $('#pagerForm').attr('action','/merchant/order/export_execption');
                $('#pagerForm').submit(); 
                $('#pagerForm').attr('action','/merchant/order/listbh');  
              }
              return false;


            }
          }
        });

$('#dialog').dialog({
  autoOpen: false,
  modal: false,
  bgiframe:true,
  width: 850,
  resizable: true,
  close:function(){
            //alert('close');
          },buttons:{
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
              $('#dialog').dialog('close');
            },'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {

              var exportType = $('#dialog [name=exportType]:checked').val();
              var exportformat = $('[name=exportformat]:checked').val();
              $('.dateformate').val(exportformat);
              if(exportType=='1'){
                    //选择的订单
                   /* var exportformat = $('[name=exportformat]').val();
                    param+="&exportType="+exportType;
                    param+="&exportformat="+exportformat;

                    alert(exportType);*/

                    var param = $("#orderDataForm").serialize();
                    var checkedSizesize = $('.orderArr:checked').size();
                    if(checkedSizesize<=0){
                      alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
                      return;
                    }
                    //alert($('#pagerForm').attr('action'));

                    $('#orderDataForm').attr('action','/merchant/order/export');
                    $('#orderDataForm').attr('method','POST');
                    $('#orderDataForm').submit();

                    $('#orderDataForm').removeAttr('action');
                    $('#orderDataForm').removeAttr('method');

                  }else if(exportType=='0'){
                    //全部的订单
                    $('#pagerForm').attr('action','/merchant/order/export');
                    $('#pagerForm').attr('method','POST');
                    $('#pagerForm').submit();

                    $('#pagerForm').attr('action','/merchant/order/listbh');
                    //$('#orderDataForm').removeAttr('method');

                  }
                  return;
                }
              }
            });

$("#lanjieContent").dialog({
  autoOpen: false,
  modal: false,
  bgiframe:true,
  width: 450,
  height:250,
  resizable: true,
  close:function(){
            //alert('close');
            $('#lanjie_order_code').val('');
            $('#order_codespan').html('');
          },buttons:{
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
              $('#lanjieContent').dialog('close');
            },'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Intercept<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
              $.ajax({
                type:'POST',
                url:"/merchant/order/intercept",
                dataType:'json',
                data: {
                  'order_code':$('#lanjie_order_code').val(),
                  'intercept_reason':$('#lanjieyuanyin').val()
                },
                success:function (json) {
                  if(json.ask=='1'){
                    alertTip(json.message);
                    $("#lanjieContent").dialog('close');
                  }else{
                    alertTip(json.message,500,'auto','1');
                  }
                }
              });
            }
          }
        });

$('.export').bind('click',function(){
 $('#dialog').dialog('open');
});

$("#ExceptionOrder").bind('click',function(){
  $('#ExceptionOrderDialog').dialog('open');
  return false;
});

})
//拦截操作
function lanjie(order_code){
  $('#lanjie_order_code').val(order_code);
  $('#order_codespan').html(order_code);
  $('#lanjieyuanyin').val('');
  $('#lanjieContent').dialog('open');
}

</script>
<!--<script type="text/javascript" src='/js/order.js'></script>-->
<script type="text/javascript" src='/loadjs/loadjs/name/order'></script>
<?php }} ?>