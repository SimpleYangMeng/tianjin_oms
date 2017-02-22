<?php /* Smarty version Smarty-3.1.13, created on 2015-11-16 09:38:06
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\personitem\person-item-add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1254756458d3b069473-40469918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4afbe86a0ec0105f29a3d390ecf9405172e831ea' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\personitem\\person-item-add.tpl',
      1 => 1447406231,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1254756458d3b069473-40469918',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56458d3b278353_45771502',
  'variables' => 
  array (
    'orderInfo' => 0,
    'product' => 0,
    'priv_customer_code_arr' => 0,
    'w' => 0,
    'warehouse' => 0,
    'status' => 0,
    'key' => 0,
    'item' => 0,
    'iePorts' => 0,
    'traf' => 0,
    'c' => 0,
    'data' => 0,
    'country' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56458d3b278353_45771502')) {function content_56458d3b278353_45771502($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><style>
.width180 {
	width: 180;
}

form span {
	color: red;
}

.topButDiv #dialog_link {
	float: left;
	display: block;
	padding: 10px;
	margin-bottom: 5px;
}
</style>
<div class="topButDiv cl">
	<a href="javascript:;" disabled='ture' title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"
		id="dialog_link" class="ui-state-default  ui-corner-all nowarp"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	<span class="jiahuowarehouse1"
		style="margin-left: 5px; margin-top: 12px; display: block; float: left; color: red; font-size: 1.1em">*</span>
	<!-- <a href="javascrip:;" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductImport<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" id="xls_input_link" class="ui-state-default  ui-corner-all nowarp" style="float:left;display:block;padding:10px; margin-left:5px;margin-bottom:5px;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductImport<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> -->
</div>
<form action="/merchant/personal-items/add-save" method='POST' id='orderForm' class="pageForm required-validate">
	<fieldset>
		<div style="margin:0 0 10px 0" class="nbox_c marB10">
			<table cellspacing="0" cellpadding="0" class="formtable tableborder">
				<thead>
					<tr>
						<td width='100'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
						<td width='300'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
						<td width='80'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
						<td width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
total<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(KG)</td>
						<td width='100'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
transaction_price<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
						<td width='100'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
total_turnover<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
						<td width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
					</tr>
					<!--
						<tr>
							<td colspan="10"   style="text-align:center"><span  style="color:red">请选择产品</span></td>
						</tr>
					-->
				</thead>
				<tbody id='orderproducts'>
					<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['order_product']){?> <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['orderInfo']->value['order_product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
					<tr id="orderproduct<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
">
						<td><a
							onclick="window.parent.openMenuTab('merchant/product/detail/productId/<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
','产品详情','product-detail');return false;"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_sku'];?>
</a></td>
						<td><?php echo $_smarty_tpl->tpl_vars['product']->value['product_title'];?>
</td>
						<td><input type="text" size="3"
							value="<?php echo $_smarty_tpl->tpl_vars['product']->value['op_quantity'];?>
"
							onkeyup="changeWeight(<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
,<?php echo $_smarty_tpl->tpl_vars['product']->value['product_weight'];?>
,this.value)"
							name="sku[<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
]"><span class="red">*</span></td>
						<td id="sku<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_weight']*$_smarty_tpl->tpl_vars['product']->value['op_quantity'];?>
</td>
						<td><input type="text" class="inputbox inputMinbox price"
							name="price[<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
]"
							value="<?php echo $_smarty_tpl->tpl_vars['product']->value['op_price'];?>
" size="6"><span class="red">*</span></td>
						<td><input type="text"
							class="inputbox inputMinbox total_price"
							name="total_price[<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
]"
							value="<?php echo $_smarty_tpl->tpl_vars['product']->value['op_total_price'];?>
" size="6" disabled="disabled"><span
							class="red"></span></td>
						<td><a title="delete" href="javascript:;" class="productDel"><img
								src="/images/icon_del.gif"></a></td>
					</tr>
					<?php } ?> <?php }?>
					<tr class="norowdata">
						<td colspan="7" style="text-align: center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
not_select_product_yet<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</b></td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td colspan="3" style="text-align: right;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weigth_total<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</b></td>
						<td colspan="4" id="total_weight"></td>
						<!--
						<td>总成交总价</td>
						<td id="count_total_weight"></td>
						-->
					</tr>
				</tbody>
			</table>
			<div class="clear"></div>
		</div>
		<table class="pageFormContent">
			<tbody>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="order_code" id='order_code'
						class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="reference_no" id='reference_no'
						class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
				</tr>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorCustomerCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'>
						<!-- <input name="customer_code" id='customer_code' class="text-input width140" value="" /> -->
						<select name="customer_code" id='customer_code'
						class="text-input width155">
							<option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
select_cus_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option> <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['priv_customer_code_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
							<option value='<?php echo $_smarty_tpl->tpl_vars['w']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['w']->value;?>
</option> <?php } ?>
					</select> <span><strong>*</strong></span>
					</td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
wb_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="wb_code" id='wb_code'
						class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
				</tr>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
po_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="po_code" id='po_code'
						class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
warehousing_logistics_enterprises<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><select name="warehouse_id" id='warehouse_id'
						class="text-input width155">
							<option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
							<option isfirst="<?php echo $_smarty_tpl->tpl_vars['w']->value['is_first'];?>
" value='<?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['warehouse_id']==$_smarty_tpl->tpl_vars['w']->value['warehouse_id']){?>
								selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_name'];?>
</option> <?php } ?>
					</select> <span><strong>*</strong></span></td>
				</tr>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><select name="status" id='status'
						class="text-input width155">
							<option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['status']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
							<option value='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option> <?php } ?>
					</select> <span><strong>*</strong></span></td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
exit_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input type="text"
						class="datepicker text-input width140" value="" name="exit_time"
						id="exit_time" readonly="readonly" /> <span><strong>*</strong></span>
					</td>
				</tr>

				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
declare_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input type="text"
						class="datepicker text-input width140" value=""
						name="declare_time" id="declare_time" readonly="readonly" /> <span><strong>*</strong></span>
					</td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ImportexportPorts<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><select name="ie_port" id='ie_port'
						class="text-input width140">
							<option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
							<option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['iep_id'];?>
'><?php echo $_smarty_tpl->tpl_vars['w']->value['ie_port_name'];?>
</option>
							<?php } ?>
					</select> <span><strong>*</strong></span></td>
				</tr>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
declare_ie_port<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><select name="declare_ie_port"
						id='declare_ie_port' class="text-input width140">
							<option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
							<option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['iep_id'];?>
'><?php echo $_smarty_tpl->tpl_vars['w']->value['ie_port_name'];?>
</option>
							<?php } ?>
					</select> <span><strong>*</strong></span></td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AccessPortTransport<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><select class="text-input width140"
						id="traf_mode" name="traf_mode"> <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['traf']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
							<option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['tfm_id'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['traf']==$_smarty_tpl->tpl_vars['c']->value['tfm_id']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['c']->value['traf_mode_name']=='公路运输'){?>
								selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['traf_mode_name'];?>
</option> <?php } ?>
					</select> <span><strong>*</strong></span></td>
				</tr>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
wrap_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="wrap_type" id='wrap_type'
						class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ship_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="ship_name" id='ship_name'
						class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
				</tr>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ship_trade_country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="ship_trade_country"
						id='ship_trade_country' class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
aim_country_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><select name="aim_country_name"
						id='aim_country_name' class="text-input width140">
							<option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
							<option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['oab_country_id']==$_smarty_tpl->tpl_vars['c']->value['country_id']){?>
								selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
							<?php } ?>
					</select> <span><strong>*</strong></span></td>
				</tr>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The_recipient_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="receive_name" id='receive_name'
						class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tel_of_consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="receive_telphone"
						id='receive_telphone' class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
				</tr>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReciveCountry<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><select name="receive_country_name"
						id='receive_country_name' class="text-input width155">
							<option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
							<option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['oab_country_id']==$_smarty_tpl->tpl_vars['c']->value['country_id']){?>
								selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
							<?php } ?>
					</select> <span><strong>*</strong></span></td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
province<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Area<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="receive_state" id='receive_state'
						class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
				</tr>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
city<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="receive_city" id='receive_city'
						class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
receive_id_number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td width='245'><input name="receive_id_number"
						id='receive_id_number' class="text-input width140" value="" /> <span><strong>*</strong></span>
					</td>
				</tr>
				<tr>
					<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
note<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td colspan="3"><textarea style="width: 580px; height: 70px;"
							name="note"></textarea></td>
				</tr>
				<tr>
					<td style="text-align: right">&nbsp;</td>
					<td colspan='3'><a href="javascript:;" class="button tijiao"
						id="orderbutton" onclick="addSubmit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a><?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><input type="hidden" name='ordersCode'
						value="<?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['order_code'];?>
"><?php }?></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
</form>

<!-- 选择产品dialog begin -->
<div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
选择产品<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"></div>
<!-- 选择产品 dialog end -->

<script type="text/javascript">
//省份
$("#receive_state").autocomplete({
	minLength: 0,
	source: function(request, response) {
	        var term = request.term;
	        if(term) {
	            term = term.toUpperCase();
	            $("#receive_state").val(term);
	        }
	        $.post('/merchant/order/province', {'country_id':$('#receive_country_name').val(),'term':term},function(data){
	            response(data);
	    }, 'json');
	}
}).focus(function() {
    $('#receive_state').autocomplete("search", "");
});

//城市
$("#receive_city").autocomplete({
    minLength: 0,
    source: function(request, response) {
	        var term = request.term;
	        if(term) {
	            term = term.toUpperCase();
	            $("#receive_city").val(term);
	        }
	        $.post('/merchant/order/city', {'country_id':$('#receive_country_name').val(),'province_id':$("#receive_state").val(),'term':term},function(data){
	            response(data);
	    }, 'json');
	}
}).focus(function() {
    $('#receive_city').autocomplete("search", "");
});

/*改变重量*/
function changeWeight(product_id, productWeight, val) {

	if(/^\d+$/.test(val)) {
		var sku = $('#sku'+product_id),
			weight = Number(productWeight),
			val = parseInt(val);
		sku.text(Math.round(weight*val*1000)/1000);
		countWeight();
    }    	
}

function changeNum(product_id, product_number, val) {
    if(typeof(countWeight)!='undefined'){countWeight();}   
}

//计算重量
function countWeight() {
	var total = 0;
	$("#orderproducts td[id^='sku']").each(function(){
		total += Number($(this).text());		
	});
	$('#total_weight').text(Math.round(total*1000)/1000 + ' KG');
}

//保存
function addSubmit(){
	// alertTip('保存成功~');
    var id = $('#id').val();
    $.ajax({
        type:"post",
        dataType:"json",
        async:false,
        url:'/merchant/personal-items/add-save',
        data:$('#orderForm').serialize(),
        success:function(json){
            // if(json.ask==1){
            //     alertTip('保存成功~');
            //     // if(id==''){
            //     //     orderForm.reset();
            //     // }
            // }
            var msg = '';
            if(json.ask==0){
                $.each(json.msg,function(k,v){
                    msg += v+'<br />';
                });
            }else{
                msg = json.msg;
            }
            alertTip(msg);
        }
    });
}

//得到订单信息 -- 暂未用
function getOrderList(){
    var orderData = $("#pagerForm").serialize();
    // alert(orderData);
    //orderData+="&warehouse_id=" + $('#warehouseId').val();
    if($('.aimwarehouses').size()>0){
        orderData += "&to_warehouse=" + $('[name=to_warehouse]').val();
    }
    orderData += "&from=asn";
    $.ajax({
        type:'post',
        url:'/merchant/product/repository?customer=true',
        data:orderData,
        dataType:'html',
        success:function(html){
            $("#dialog").html(html);
        }
    });
    $('#dialog').dialog('open');
}
//未选择产品
function getRipOfNodataRow(){
	 var dataRows = $("#orderproducts tr:not(.norowdata)").size();
	 
	 if(dataRows>0){
	   $('.norowdata').remove();
	 }else{	 	 	
	 	var html='<tr class="norowdata">\n';
           html+='<td colspan="6" style="text-align:center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
not_select_product_yet<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</b></td></tr>';
			$("#orderproducts").append(html);		
	 }
}

$(function(){
	//时间控件
	$(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});
	
	//产品浏览
	$('#dialog_link').click(function(){
		//获取产品信息
		var cusCode = $('#customer_code').val();
		if(cusCode == '' ){
			alertTip('请填选择客户代码!');
			return false;
		}
		//获取数据
		getProductListBoxData('order', null, 10, null, null, null, null, cusCode);
	    $('#dialog').dialog('open');
	    return false;
	});
	
	//选择产品
	$(".orderactionSku").live("click", function () {
        var productId = $(this).attr("productId");
        var productSku = $(this).attr("productSku");
        var productName = $(this).attr("productName");
        var category = $(this).attr("category");
        var productWeight = $(this).attr("productWeight");
        var warehouse_id = $("[name='warehouse_id']").val();
        var to_warehouse_id = $("[name='to_warehouse_id']").val();
        if ($(this).is(':checked')){
            if($("#orderproduct"+productId).size()==0){
                if ($("#orderproduct" + productId).size() == 0) {
                    var html = '';
                    html += '<tr id="orderproduct' + productId + '" class="product_sku">';
                    html += '<td><a onclick="window.parent.openMenuTab(\'merchant/product/detail/productId/' + productId + '\',\'产品详情\',\'product-detail\');return false;">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                    html += '<td title="'+productName+'">' + productName + '</td>';
                    html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" onkeyup="changeWeight('+productId+','+productWeight+',this.value)" value="1" size="6">&nbsp;<strong>*</strong></td>';
                    html += '<td id="sku'+productId+'">'+productWeight+'</td>';
                    /*if(warehouse_id==3||to_warehouse_id==3||warehouse_id==6||to_warehouse_id==6||warehouse_id==2||to_warehouse_id==2){
                        html += '<td><input type="text" class="inputbox inputMinbox price" name="price['+productId+']" size="6"><span class="red">*</span> </td>';
                        html += '<td><input type="text" class="inputbox inputMinbox total_price" name="total_price['+productId+']" size="6"><span class="red">*</span> </td>';
                    }else{
                        html += '<td><input type="text" class="inputbox inputMinbox price" name="price['+productId+']" size="6"><span class="red"></span> </td>';
                        html += '<td><input type="text" class="inputbox inputMinbox total_price" name="total_price['+productId+']" size="6"><span class="red"></span> </td>';
                    }*/
                    // 不分仓库了，所有的交易价格、成交单价都必填
                    html += '<td><input type="text" class="inputbox inputMinbox price" name="price['+productId+']" size="6"><span class="red">*</span> </td>';
                    html += '<td><input type="text" class="inputbox inputMinbox total_price" name="total_price['+productId+']" size="6" disabled="disabled"><span class="red">*</span> </td>';
                    html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                    html += '</tr>';
                    $("#orderproducts").append(html);
                }
            }
        }else{
            if($("#orderproduct"+productId).size()>0){
                $("#orderproduct"+productId).remove();
            }
        }
        if(typeof(countWeight)!='undefined'){countWeight();}
		if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
    });
	
	//导入XML
    $('#xls_input_link').click(function(){
        $('#XLSInputBox').dialog('open');
    });
	
    $('#XLSInputBox').dialog({
        autoOpen: false,
        modal: false,
        bgiframe:true,
        width: 900,
		height:500,
        resizable: true,
		close:function(){
		//	reseterrorrow();
		},buttons:{
			'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
					$('#XLSInputBox').dialog('close');
			},'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
			//	do_import_action();
			}		
		}
    });
    
    //产品dialog 由 noleftlayout 模板里面 getProductListBoxData(…) 方法导入数据
	$('#dialog').dialog({
      		autoOpen: false,
			position: ['center','top'],
      		modal: true,
      		bgiframe:true,
      		width: 850,
			minHeight:100,
      		resizable: false
	});
    
	//根据国家加载运输方式
	$("#country_id").change(function (e) {
		getShipments();
	});
	

	//删除产品
	$(".productDel").live("click",function(){
	    $(this).parent().parent().remove();		
		if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
		if(typeof(countWeight)!='undefined'){countWeight();}
		if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
	});
	
	//计算总价
	$('[name^="sku["],[name^="price["]').live('keyup', function () {
		var attrName = $(this).attr('name');
		var pattern  = /\[(\d+)\]/;
		var matches  = attrName.match(pattern);
	    var pid      = matches[1];
	    var quantity = $('[name="sku[' + pid + ']"]').val();
	    var price    = $('[name="price[' + pid + ']"]').val();
	    var total    = quantity * price;

	    if (!isNaN(total)) {
	      total = total.toFixed(2);
	    }

	    $('[name="total_price[' + pid + ']"]').val(total);
	});
	countWeight();
});

</script><?php }} ?>