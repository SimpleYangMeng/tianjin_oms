<?php /* Smarty version Smarty-3.1.13, created on 2016-02-22 10:26:33
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\storage\views\guarantee\add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1505156c6e059f02a66-19810918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ccc4f11e0f591ced885696a90f096a9ce309c749' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\storage\\views\\guarantee\\add.tpl',
      1 => 1456107668,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1505156c6e059f02a66-19810918',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c6e05a3150f9_36184820',
  'variables' => 
  array (
    'data' => 0,
    'cTypes' => 0,
    'k' => 0,
    'c' => 0,
    'companyInfo' => 0,
    'banks' => 0,
    'currency' => 0,
    'customsCodes' => 0,
    'customer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c6e05a3150f9_36184820')) {function content_56c6e05a3150f9_36184820($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><?php if (empty($_smarty_tpl->tpl_vars['data']->value)){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
add_taxation_guarantee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }else{ ?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit_taxation_guarantee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?></h3>
        <div class="clear"></div>
    </div>
	<form method="post" id="tgForm" class="pageForm required-validate">
	<input type="hidden" name="tg_id" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['tg_id'];?>
<?php }?>" />
		<fieldset>
	        <table>
				<tbody>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
g_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
                           <select class="text-input" style="width: 214px;"  id="g_type" name="g_type">
		                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
		                            <option <?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['g_type']==$_smarty_tpl->tpl_vars['k']->value){?>selected="selected"<?php }?> value='<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['c']->value;?>
</option>
		                        <?php } ?>
		                    </select>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customer_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input name="customer_code" id="customer_code" class="fix-medium1-input text-input" type="text" size="45" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customer_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['customer_code'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['customer_code'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customer_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customer_company_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input name="customer_company_name" id="customer_company_name" class="fix-medium1-input text-input" type="text" size="45" placeholder="无需填写，填写代码自动获取;" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['trade_name'];?>
<?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
<?php $_tmp1=ob_get_clean();?><?php echo $_tmp1;?>
<?php }?>"  readonly="readonly" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customer_company_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_bank_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input" id="bank-name">
							<input type="text" name="tg_bank_name" id="tg_bank_name" class="text-input fix-medium1-input" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入担保银行名称<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['tg_bank_name'];?>
<?php }?>" />
							<!--
							<select class="text-input" style="width: 214px;" id="tg_bank_name" name="tg_bank_name">
		                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
		                            <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['bank_name_cn'];?>
"<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['tg_bank_name']==$_smarty_tpl->tpl_vars['c']->value['bank_name_cn']){?> selected="selected"<?php }?>>
		                            	<?php echo $_smarty_tpl->tpl_vars['c']->value['bank_name_cn'];?>

		                            </option>
		                        <?php } ?>
		                    </select>
		                    -->
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_v_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="tg_v_time" id="tg_v_time" class="datepicker text-input fix-medium1-input" readonly="readonly" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
2015-12-31<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['tg_v_time'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_v_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_limit_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input type="text" name="tg_limit_time" id="tg_limit_time" class="datepicker text-input fix-medium1-input" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
2015-12-31<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['tg_limit_time'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_limit_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
currency_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
                           <select class="text-input" style="width: 214px;" id="currency_code" name="currency_code">
		                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['currency']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
		                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['code'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['currency_code']==$_smarty_tpl->tpl_vars['c']->value['code']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['c']->value['code']=='RMB'){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
</option>
		                        <?php } ?>
		                    </select>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_value<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input name="tg_value" id="tg_value" class="fix-medium1-input text-input" type="text" size="45" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
0.00<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['tg_value'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_value<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
guarantee_basis<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<input name="guarantee_basis" id="guarantee_basis" class="fix-medium1-input text-input" type="text" size="45" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
guarantee_basis_notice<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['guarantee_basis'];?>
<?php }?>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
guarantee_basis_notice<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customs_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
                           <select class="text-input" style="width: 214px;"  id="customs_code" name="customs_code">
		                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customsCodes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
		                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['ie_port'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['customs_code']==$_smarty_tpl->tpl_vars['c']->value['ie_port']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['ie_port_name'];?>
-<?php echo $_smarty_tpl->tpl_vars['c']->value['ie_port'];?>
</option>
		                        <?php } ?>
		                    </select>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
note<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<textarea name="note" id="note" cols="40" rows="4"><?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['note'];?>
<?php }?></textarea>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
storage_customer_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
						<?php if (empty($_smarty_tpl->tpl_vars['data']->value)){?>
							<input type="hidden" name="storage_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['customer_code'];?>
" />
							<span class="blue"><?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
</span>
						<?php }else{ ?>
							<input type="hidden" name="storage_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['storage_customer_code'];?>
" />
							<span class="blue"><?php echo $_smarty_tpl->tpl_vars['data']->value['storage_customer_code'];?>
</span>
						<?php }?>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
storage_customer_company_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
						<td class="form_input">
							<?php if (empty($_smarty_tpl->tpl_vars['data']->value)){?>
								<input type="hidden" name="storage_customer_company_name" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
" />
								<span class="blue"><?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
</span>
							<?php }else{ ?>
								<input type="hidden" name="storage_customer_company_name" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['storage_customer_company_name'];?>
" />
								<span class="blue"><?php echo $_smarty_tpl->tpl_vars['data']->value['storage_customer_company_name'];?>
</span>
							<?php }?>
						</td>
					</tr>
               		<tr>
						<td class="form_title"></td>
						<td colspan="2" class="form_input">
							<input type="hidden" name="add_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
">
							<?php if (empty($_smarty_tpl->tpl_vars['data']->value)){?>
								<a href="javascript:void(0)" class="button tijiao" onclick="addSubmit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
							<?php }else{ ?>
								<a href="javascript:void(0)" class="button tijiao" onclick="editSubmit(<?php echo $_smarty_tpl->tpl_vars['data']->value['tg_id'];?>
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
		width: 600,		
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
			// code here
		}
	});
	//根据code 获取公司名称
	$('#customer_code').blur(function (){
		var customer_code = $(this).val();
		var myoptions = {
			url: '/storage/taxation-guarantee/get-company-name-by-cus-code',
			type: 'POST',
			cache: false,		
			dataType: 'json',
			processData: true,
			data: {'customer_code': customer_code},
			success: function(json){
				if(json.ask==1){
					$('#customer_code').css({'border-color':''});
					$('#customer_company_name').val(json.data.trade_name);
				}else {
					$("#commonPayTip").html(json.message);
					$('#commonPayTip').dialog('open');
					$('#customer_company_name').val('');
					$('#customer_code').css({'border-color':'#a94442'});
				}
			}, error:function(a,b,c){
				$("#commonPayTip").html("system error");
				$('#commonPayTip').dialog('open');
			}
		}; 
		//显示操作提示
		$.ajax(myoptions);
	});

	//根据类型切换
	$('#g_type').change(function(){
		switch (this.value){
			case '1':
				$('#bank-name').html('<input type="text" name="tg_bank_name" id="tg_bank_name" class="text-input fix-medium1-input" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
请输入担保银行名称<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['tg_bank_name'];?>
<?php }?>" />');
				break;
			case '2':
				$('#bank-name').html('<select class="text-input" style="width: 214px;" id="tg_bank_name" name="tg_bank_name"><?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['bank_name_cn'];?>
"<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['tg_bank_name']==$_smarty_tpl->tpl_vars['c']->value['bank_name_cn']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['bank_name_cn'];?>
</option><?php } ?></select>');
				break;
			default: 
		}
	});
});

//处理表单数据
function addSubmit(){
 	var formdata =  $("#tgForm").serialize();
	var myoptions = {
		url: '/storage/taxation-guarantee/add',
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:formdata,
		//dataType:'html',
		success: function(json){
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
			if(json.ask==1){
				$('#tgForm')[0].reset();
			}
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
function editSubmit(tg_id){
	var formdata =  $("#tgForm").serialize();
	var poId = $('#poId').val();
	var myoptions = {		
		url:'/storage/taxation-guarantee/add', //提交给哪个执行
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:formdata,
		//dataType:'html',
		success: function(json){
			if(json.ask==1){
				if(poId==''){
					tgForm.reset();
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
</script><?php }} ?>