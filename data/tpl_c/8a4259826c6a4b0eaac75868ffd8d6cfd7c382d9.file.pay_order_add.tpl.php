<?php /* Smarty version Smarty-3.1.13, created on 2015-11-16 09:22:50
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\pay\views\payOrder\pay_order_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1300656492feaf00d88-56987647%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a4259826c6a4b0eaac75868ffd8d6cfd7c382d9' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\pay\\views\\payOrder\\pay_order_add.tpl',
      1 => 1447406231,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1300656492feaf00d88-56987647',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'payOrderData' => 0,
    'payOrderStatus' => 0,
    'item' => 0,
    'key' => 0,
    'currencyAll' => 0,
    'currency' => 0,
    'country' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56492feb29e8e1_42688846',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56492feb29e8e1_42688846')) {function content_56492feb29e8e1_42688846($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
	#distributor-pagination{display: block;padding: 5px 0;clear: both;}
	#distributor-pagination span{padding: 5px 8px;border: 1px solid #cccccc;margin-right: 5px;cursor: pointer;}
	#distributor-pagination span.current{color: #cccccc;cursor: text;}
</style>
<link href="/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><?php if (empty($_smarty_tpl->tpl_vars['payOrderData']->value)){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
add_pay_order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }else{ ?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit_pay_order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?></h3>
        <div class="clear"></div>
    </div>
	<form method="post" id="payOrderForm"  action="/merchant/product/<?php if ($_smarty_tpl->tpl_vars['payOrderData']->value==''){?>add-save<?php }else{ ?>edit-save<?php }?>" class="pageForm required-validate">
		<fieldset>
	        <table>
				<tbody>
					<tr>
					<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" size="45" name="order_code" id="order_code" class="fix-medium1-input required text-input" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['order_code']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['order_code'];?>
<?php }?>" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
input_order_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Trading_Order_No_maximum_length_of_18<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customerCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input name="customer_code" id="customer_code" class="fix-medium1-input text-input" type="text" size="45" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_customer_encoding<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['customer_code']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['customer_code'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_input_the_sales_site_Trading_Order_No<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input"><input name="reference_no" id="reference_no" type="text" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_customer_reference_number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" class="text-input fix-medium1-input" size="45" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['reference_no']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['reference_no'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_customer_reference_number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay_order_status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<select name="status" id="status" class="fix-medium2-input"  >
								<option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
								<?php if ($_smarty_tpl->tpl_vars['payOrderStatus']->value!=''){?> 
									<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['payOrderStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
										<?php echo $_smarty_tpl->tpl_vars['item']->value;?>

										<option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&($_smarty_tpl->tpl_vars['payOrderData']->value['status']==$_smarty_tpl->tpl_vars['key']->value)){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
									<?php } ?>
								<?php }?>
							</select>
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_choose_to_pay_a_single_state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
goods_purchase_price<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="goods_value" id="goods_value" value='<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['goods_value']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['goods_value'];?>
<?php }?>' class="required text-input fix-medium1-input"  placeholder="0.00"/>
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weight_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_goods_freight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="freight_fee" id="freight_fee" size="10" class="fix-medium1-input text-input" placeholder="0.00" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['freight_fee']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['freight_fee'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Declared_Value_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Currency<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<select name='pay_currency_code' class="fix-medium2-input">
								<option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
			                    <?php  $_smarty_tpl->tpl_vars['currency'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency']->_loop = false;
 $_smarty_tpl->tpl_vars['curId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['currencyAll']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency']->key => $_smarty_tpl->tpl_vars['currency']->value){
$_smarty_tpl->tpl_vars['currency']->_loop = true;
 $_smarty_tpl->tpl_vars['curId']->value = $_smarty_tpl->tpl_vars['currency']->key;
?>
			                        <option value='<?php echo $_smarty_tpl->tpl_vars['currency']->value['currency_code'];?>
' <?php if (!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&($_smarty_tpl->tpl_vars['currency']->value['currency_code']==$_smarty_tpl->tpl_vars['payOrderData']->value['pay_currency_code'])){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['currency']->value['currency_code'];?>
</option>
			                    <?php } ?>
			                </select>
			                <strong>*</strong>
							<a href="#" class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Declared_Value_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<select name="cosignee_country_id" id='cosignee_country_id' class="text-input fix-medium2-input">
				                <option value="49">CN 中国</option>
				                <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
				                	<option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
' <?php if (!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&($_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_country_id']==$_smarty_tpl->tpl_vars['c']->value['country_id'])){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
								<?php } ?>
							</select>
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_consignee_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="cosignee_name" id="cosignee_name" size="10" class="fix-medium1-input text-input" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_consignee_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_name']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_name'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_consignee_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="cosignee_address" id="cosignee_address" size="10" class="fix-medium1-input text-input" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_cosignee_address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_address']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_address'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_cosignee_address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_telephone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="cosignee_telephone" id="cosignee_telephone" value='<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_telephone']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_telephone'];?>
<?php }?>' class="required text-input fix-medium1-input"  placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_cosignee_telephone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"/>
							<span style='text-align:left;'><strong>*</strong></span>  
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_cosignee_telephone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pro_amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="pro_amount" id="pro_amount" value='<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['pro_amount']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['pro_amount'];?>
<?php }?>' class="required text-input fix-medium1-input"  placeholder="0.00"/>
							<span style='text-align:left;'><strong>*</strong></span>  
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pro_amount_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pro_remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td colspan="3" class="form_input">
							<input type="text" name="pro_remark" style="width: 592px;" id="pro_remark" value='<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['pro_remark']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['pro_remark'];?>
<?php }?>' class="required text-input fix-medium1-input"/>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pro_remark_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
                       <tr>
                       	<td  class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
note<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                       	<td colspan="3">
                       		<textarea cols="82" rows="3" name="note"><?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['note']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['note'];?>
<?php }?></textarea>
                       	</td>
                       </tr>
               		<tr>
						<td class="form_title"></td>
						<td colspan="3" class="form_input">
							<?php if (empty($_smarty_tpl->tpl_vars['payOrderData']->value)){?>
								<a href="javascript:void(0)" class="button tijiao" onclick="addSubmit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
							<?php }else{ ?>
								<input type="hidden" name="poId" value="<?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['po_id'];?>
" />
								<a href="javascript:void(0)" class="button tijiao" onclick="editSubmit(<?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['po_id'];?>
);return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorOperationSave<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
							<?php }?>
						</td>
					</tr> 
				</tbody>
	        </table>
        </fieldset>
        <div class="clear"></div>
        <div class="infoTips" id="commonPayTip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"></div>
	</form>
</div>
<script type="text/javascript">
$(function(){
	//公用提示信息
	$('#commonPayTip').dialog({
		autoOpen: false,
		modal: true,
		position:['center', 100],
		bgiframe:true,
		width: 400,		
		resizable: true,
		title: '提示信息(按ESC关闭)',
		buttons: {
	            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
	                $(this).dialog('close');
	            }
		},
		close: function() {
			
		}
	});
});

/*是否为合格的URL*/
function isurl(str_url){
    // var strregex = "(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])?";
    //var re=new RegExp(strregex);
    var regexp = new RegExp("(http[s]{0,1})://[a-zA-Z0-9\\.\\-]+\\.([a-zA-Z]{2,4})(:\\d+)?(/[a-zA-Z0-9\\.\\-~!@#$%^&amp;*+?:_/=<>]*)?", "gi");
    if (regexp.test(str_url)){
        return (true);
    }else{
        return (false);
    }
}

//处理表单数据
function addSubmit(){
 	var formdata =  $("#payOrderForm").serialize();
 	var order_code = $("[name='order_code']").val();
    var customer_code = $('[name="customer_code"]').val();
    var reference_no = $('[name="reference_no"]').val();
    var status = $('[name="status"]').val();
    var goods_value = $('[name="goods_value"]').val();
    var freight_fee = $('[name="freight_fee"]').val();
    var pay_currency_code = $('[name="pay_currency_code"]').val();
    var cosignee_name = $('[name="cosignee_name"]').val();
    var cosignee_address = $('[name="cosignee_address"]').val();
    var cosignee_telephone = $('[name="cosignee_telephone"]').val();
    var cosignee_country_id = $('[name="cosignee_country_id"]').val();
    var pro_amount = $('[name="pro_amount"]').val();

    var pro_remark = $('[name="pro_remark"]').val();
    var note = $('[name="note"]').val();
    
    var errorHtml = "";
    if(order_code==""){
        errorHtml += '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_order_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>';
    }
    if(customer_code==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_customer_encoding<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(reference_no==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_customer_reference_number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(status==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_choose_to_pay_a_single_state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(goods_value==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入订单商品货款<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(freight_fee==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入订单商品运费<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(pay_currency_code==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请选择币种<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(cosignee_country_id==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请选择收货人所在国家<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(cosignee_name==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入收货人姓名<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(cosignee_address==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入收货人地址<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(cosignee_telephone==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入收货人电话<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(pro_amount==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入优惠金额<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    
    if(errorHtml!=""){
		$("#commonPayTip").html(errorHtml);
		$('#commonPayTip').dialog('open');
        return false;
    }
    var poId = $('#poId').val();
	var myoptions = {
		url:'/pay/pay-order/add-save', //提交给哪个执行
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:formdata,
		//dataType:'html',
		success: function(json){
			if(json.ask==1){
				if(poId==''){
					payOrderForm.reset();
				}
			}
			var msgs = '';
			if(typeof json.msg=='object'){
				$.each(json.msg,function(k,v){
					msgs += v+'<br />';
				});
			}else{
				msgs = json.msg;
			}
			$("#commonPayTip").html(msgs);
			$('#commonPayTip').dialog('open');
		}, error:function(a,b,c){
			$("#commonPayTip").html("system error");
			$('#commonPayTip').dialog('open');
		}
	}; 
	//显示操作提示
	$.ajax(myoptions); 
	return false;
}

//编辑
function editSubmit(poId){
	var formdata =  $("#payOrderForm").serialize();
	var poId = $('#poId').val();
	var myoptions = {		
		url:'/pay/pay-order/edit-save', //提交给哪个执行
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:formdata,
		//dataType:'html',
		success: function(json){
			if(json.ask==1){
				if(poId==''){
					payOrderForm.reset();
				}
			}
			var msgs = '';
			if(typeof json.msg=='object'){
				$.each(json.msg,function(k,v){
					msgs += v+'<br />';
				});
			}else{
				msgs = json.msg;
			}
			$("#commonPayTip").html(msgs);
			$('#commonPayTip').dialog('open');
		}, error:function(a,b,c){
			$("#commonPayTip").html("system error");
			$('#commonPayTip').dialog('open');
		}
	}; 
	//显示操作提示
	$.ajax(myoptions); 
	return false;
}

function alertTip2(tip,width,height,notflash) {
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
		position:['center', 'top'],
        height: height,
        modal: false,
        show:"slide",
        buttons: {
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                $(this).dialog('close');
                if(!(typeof(notflash)!="undefined" && notflash=='1')){
                    //$('#pagerForm').submit();
                    parent.openMenuTab('/merchant/product','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
','ProductList','1');
                }
            }
        },
        close: function() {
            //window.location.href='/merchant/product';			
			parent.openMenuTab('/merchant/product','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
','ProductList','1');
        }
    });
}
</script><?php }} ?>