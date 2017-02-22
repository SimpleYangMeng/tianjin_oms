<?php /* Smarty version Smarty-3.1.13, created on 2016-03-04 10:24:38
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\pay\views\payOrder\pay_order_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1003256d8f1e6282f70-20633725%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05f330a3afbefea7e59f57d61b09b333d72b80ec' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\pay\\views\\payOrder\\pay_order_add.tpl',
      1 => 1455677486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1003256d8f1e6282f70-20633725',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'payOrderData' => 0,
    'customer' => 0,
    'companyInfo' => 0,
    'currencyAll' => 0,
    'currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d8f1e6556652_39879237',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d8f1e6556652_39879237')) {function content_56d8f1e6556652_39879237($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
	#distributor-pagination{display: block;padding: 5px 0;clear: both;}
	#distributor-pagination span{padding: 5px 8px;border: 1px solid #cccccc;margin-right: 5px;cursor: pointer;}
	#distributor-pagination span.current{color: #cccccc;cursor: text;}
</style>
<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><?php if (empty($_smarty_tpl->tpl_vars['payOrderData']->value)){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
add_pay_order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }else{ ?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit_pay_order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?></h3>
        <div class="clear"></div>
    </div>
	<form method="post" id="payOrderForm" class="pageForm required-validate">
		<fieldset>
	        <table>
				<tbody>
					<?php if (empty($_smarty_tpl->tpl_vars['payOrderData']->value)){?>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
支付企业<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td>
								<span class="blue"><?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
-<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
</span>
								<input type="hidden" name="pay_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
" />
								<input type="hidden" name="pay_account_code" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['account_code'];?>
" />
								<input type="hidden" name="pay_enp_name" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
">
							</td>
						</tr>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
app_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">
								<span class="blue">新增</span>
								<input type="hidden" name="app_type" id="app_type" value="1"/>
							</td>
						</tr>
					<?php }else{ ?>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
支付企业<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td>
								<span class="blue"><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['pay_customer_code'];?>
-<?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['pay_enp_name'];?>
</span>
								<input type="hidden" name="pay_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['pay_customer_code'];?>
" />
								<input type="hidden" name="pay_account_code" value="<?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['pay_account_code'];?>
" />
								<input type="hidden" name="pay_enp_name" value="<?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['pay_enp_name'];?>
" />
							</td>
						</tr>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
app_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">
								<span class="blue">变更</span>
								<input type="hidden" name="app_type" id="app_type" value="2"/>
							</td>
						</tr>
					<?php }?>
					<!--
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="order_code" id="order_code" class="fix-medium1-input required text-input" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['order_code']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['order_code'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Trading_Order_No_maximum_length_of_18<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					-->
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input"><input name="reference_no" id="reference_no" type="text" class="orderInfo text-input fix-medium1-input" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['reference_no']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['reference_no'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入交易订单号<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right">电商平台代码：</td>
						<td class="form_input">
							<input type="text" name="ecommerce_platform_customer_code" id="ecommerce_platform_customer_code" class="orderInfo fix-medium1-input required text-input" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['ecommerce_platform_customer_code']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['ecommerce_platform_customer_code'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="请输入<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ecommerce_platform_customer_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ecommerce_platform_customer_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="ecommerce_platform_customer_name" id="ecommerce_platform_customer_name" class="orderInfo fix-medium1-input required text-input" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['ecommerce_platform_customer_name']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['ecommerce_platform_customer_name'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="请输入<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ecommerce_platform_customer_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
电商企业代码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input name="customer_code" id="customer_code" class="orderInfo fix-medium1-input text-input" type="text" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['customer_code']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['customer_code'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入电商企业代码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
enp_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input name="enp_name" id="enp_name" class="orderInfo fix-medium1-input text-input" type="text" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['enp_name']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['enp_name'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="请输入<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
enp_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					
					
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
payNo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="pay_no" id="pay_no" class="fix-medium1-input required text-input" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['pay_no']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['pay_no'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Trading_Order_No_maximum_length_of_18<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="cosignee_name" id="cosignee_name" size="10" class="fix-medium1-input text-input" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_name']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_name'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_consignee_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="cosignee_code" id="cosignee_code" size="10" class="fix-medium1-input text-input" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_code']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['cosignee_code'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入支付人证件号码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right">支付币制：</td>
						<td class="form_input">
							<select name='pay_currency_code' class="fix-medium2-input">
			                    <?php  $_smarty_tpl->tpl_vars['currency'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency']->_loop = false;
 $_smarty_tpl->tpl_vars['curId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['currencyAll']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency']->key => $_smarty_tpl->tpl_vars['currency']->value){
$_smarty_tpl->tpl_vars['currency']->_loop = true;
 $_smarty_tpl->tpl_vars['curId']->value = $_smarty_tpl->tpl_vars['currency']->key;
?>
			                        <option value='<?php echo $_smarty_tpl->tpl_vars['currency']->value['currency_code'];?>
' <?php if ((!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&($_smarty_tpl->tpl_vars['currency']->value['currency_code']==$_smarty_tpl->tpl_vars['payOrderData']->value['pay_currency_code']))||($_smarty_tpl->tpl_vars['currency']->value['currency_code']=='RMB')){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['currency']->value['currency_code'];?>
-<?php echo $_smarty_tpl->tpl_vars['currency']->value['currency_name'];?>
</option>
			                    <?php } ?>
			                </select>
			                <strong>*</strong>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay_amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="pay_amount" id="pay_amount" size="10" class="fix-medium1-input text-input" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
0.00<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['pay_amount']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['pay_amount'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入支付金额<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
					<tr>
                       	<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
note<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                       	<td>
                       		<textarea cols="50" rows="3" name="note"><?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['note']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['note'];?>
<?php }?></textarea>
                       	</td>
					</tr>
               		<tr>
						<td class="form_title"></td>
						<td class="form_input">
							<input type="hidden" name="po_id" value="<?php if (isset($_smarty_tpl->tpl_vars['payOrderData']->value)&&!empty($_smarty_tpl->tpl_vars['payOrderData']->value)&&$_smarty_tpl->tpl_vars['payOrderData']->value['po_id']){?><?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['po_id'];?>
<?php }?>" />
							<?php if (empty($_smarty_tpl->tpl_vars['payOrderData']->value)){?>
								<a href="javascript:void(0)" class="button tijiao" onclick="addSubmit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
							<?php }else{ ?>
								<input type="hidden" name="po_code" value="<?php echo $_smarty_tpl->tpl_vars['payOrderData']->value['po_code'];?>
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
		height: 'auto',	
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

	//获取订单相关信息
	/*
	$('#order_code').blur(function (){
	    var order_code = $(this).val();
	    var myoptions = {
	        url: '/pay/pay-order/get-order-info-by-order-code',
	        type: 'POST',
	        cache: false,       
	        dataType: 'json',
	        processData: true,
	        data: {'order_code': order_code},
	        success: function(json){
	            if(json.ask==1){
	                $('#order_code').css({'border-color':''});
	                $('#enp_name').val(json.data);
	                $.each( json.data, function(key, val) {
						$('#'+key).val(val);
					});
	            }else {
	                $("#commonPayTip").html(json.message);
	                $('#commonPayTip').dialog('open');
	                $('#order_code').css({'border-color':'#a94442'});
	                $('.orderInfo').val('');
				//	$('#order_code').focus();
	            }
	        }, error:function(a,b,c){
	            $("#commonPayTip").html("system error");
	            $('#commonPayTip').dialog('open');
	        }
	    }; 
	    //显示操作提示
	    $.ajax(myoptions);
	});
	*/
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
 	/*
 	// var order_code = $("[name='order_code']").val();
    var customer_code = $('[name="customer_code"]').val();
    var reference_no = $('[name="reference_no"]').val();
    var status = $('[name="status"]').val();
    var goods_value = $('[name="goods_value"]').val();
    var freight_fee = $('[name="freight_fee"]').val();
    var pay_currency_code = $('[name="pay_currency_code"]').val();
    var cosignee_name = $('[name="cosignee_name"]').val();
    var cosignee_code = $('[name="cosignee_code"]').val();
    var cosignee_address = $('[name="cosignee_address"]').val();
    var cosignee_telephone = $('[name="cosignee_telephone"]').val();
    var cosignee_country_id = $('[name="cosignee_country_id"]').val();
    var pro_amount = $('[name="pro_amount"]').val();
    var pro_remark = $('[name="pro_remark"]').val();
    var note = $('[name="note"]').val();
    var errorHtml = "";
    // if(order_code==""){
    //     errorHtml += '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_order_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>';
    // }
    if(customer_code==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_customer_encoding<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
;</br>";
    }
    if(reference_no==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_the_customer_reference_number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
;</br>";
    }
    if(status==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_choose_to_pay_a_single_state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
;</br>";
    }
    if(goods_value==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入订单商品货款;<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(freight_fee==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入订单商品运费;<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(pay_currency_code==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请选择币种;<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(cosignee_country_id==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请选择支付人所在国家;<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(cosignee_code == ''){
    	errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入支付人证件号码;<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(cosignee_name==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入支付人姓名;<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(cosignee_address==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入支付人地址;<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(cosignee_telephone==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入支付人电话;<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    if(pro_amount==""){
        errorHtml += "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入优惠金额;<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
    }
    
    if(errorHtml!=""){
		$("#commonPayTip").html(errorHtml);
		$('#commonPayTip').dialog('open');
        return false;
    }
    */
    var po_id = $('#po_id').val();
	var myoptions = {
		url:'/pay/pay-order/add-save', //提交给哪个执行
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:formdata,
		//dataType:'html',
		success: function(json){
			if(json.ask == 1){
				$('#payOrderForm')[0].reset();
				/*
				if(po_id==''){
					$('#payOrderForm')[0].reset();
				}
				*/
			}
			var messages = '';
			if(typeof json.message=='object'){
				$.each(json.message, function(k, v){
					messages += v + '<br />';
				});
			}else{
				messages = json.message;
			}
			$("#commonPayTip").html(messages);
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
			var messages = '';
			if(typeof json.message=='object'){
				$.each(json.message,function(k,v){
					messages += v+'<br />';
				});
			}else{
				messages = json.message;
			}
			$("#commonPayTip").html(messages);
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