<?php /* Smarty version Smarty-3.1.13, created on 2015-11-16 09:29:22
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\product\product-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3176356493172970483-34355809%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70cb4e0520976943d2d77eec8c5dd09b85d6b64c' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\product\\product-create.tpl',
      1 => 1447398269,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3176356493172970483-34355809',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'productInfo' => 0,
    'uom' => 0,
    'item' => 0,
    'currency' => 0,
    'row' => 0,
    'customer' => 0,
    'countryArr' => 0,
    'supervisionArr' => 0,
    'taxList' => 0,
    'tax' => 0,
    'sessionid' => 0,
    'att' => 0,
    'customerJson' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56493172edc755_68232727',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56493172edc755_68232727')) {function content_56493172edc755_68232727($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><form method="post" id="commonProductForm"  action="/merchant/product/add-save" class="pageForm required-validate">
        <fieldset>
        <table >
                <tbody>
                        <tr>
                                <td class="form_title nowrap text_right">客户代码：</td>
                                <td class="form_input"><input name="customer_code" id="title" class="fix-medium1-input text-input" type="text" size="45"  placeholder="客户代码" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['customer_code']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['customer_code'];?>
<?php }?>" />
                                        <strong>*</strong>                  
                                </td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_sku']){?>
                                        <input type="text"  size="45" value="<?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_sku'];?>
" readonly class='fix-medium1-input text-input  required mytip' name="product_sku" >
                                        <input type="hidden" size="45" value="<?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_id'];?>
"  name="product_id">
                                        <?php }else{ ?>
                                        <input type="text"  size="45" value="" name="product_sku" class="fix-medium1-input required text-input " placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_product_SKU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
                                        <?php }?> <strong>*</strong>  <a href="#"  class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_input_can_only_alphanumeric_and_rung_maximum_length_of_18<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a></td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><input name="title" id="title" class="fix-medium1-input text-input" type="text" size="45"  placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_enter_the_product_name_in_Chinese<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_title']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_title'];?>
<?php }?>" />
                                        <strong>*</strong>  <a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_name_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a><!--<span class="input-notification error png_bg">Error message</span>!-->                                </td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
p_en_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><input name="title_en" id="title_en" type="text"  placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_enter_the_product_name_in_English<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" class="text-input fix-medium1-input" size="45" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_title_en']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_title_en'];?>
<?php }?>"  /> <strong style=" visibility:hidden;">*</strong> <a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_enter_the_product_name_English_recommend<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>                              </td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right">申报单位：</td>
                                <td class="form_input">
								
										<select name="pu_code" class="fix-medium2-input" >
                                                <!--<option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>-->
                                                <?php if ($_smarty_tpl->tpl_vars['uom']->value!=''){?> 
												<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['uom']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?> 
												<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['code'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['pu_code']==$_smarty_tpl->tpl_vars['item']->value['code'])){?>selected<?php }elseif($_smarty_tpl->tpl_vars['item']->value['name']=="个"){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value["name"];?>

                                                </option>
                                                <?php } ?> 
												
												
												<?php }?>
                                        </select>              
										<strong>*</strong>  <a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
legal_measurement_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>										</td>
                        </tr>			
                        <tr>
                                <td class="form_title nowrap text_right">产品条码：</td>
                                <td class="form_input"><input name="barcode" id="specifications" type="text"   size="18" class="fix-medium1-input text-input "  value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_barcode']!=''){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_barcode'];?>
<?php }?>" /> 
&nbsp;&nbsp; <a href="#"  class="tip" title="" onclick="return false;"><img src="/images/help.png"/></a></td>
                        </tr>
                        <tr>
                            <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReportingCurrency<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                            <td class="form_input">
                                <select name="currency_code" class="fix-medium2-input" id="currency_code">
                                <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['currency']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                <?php if ($_smarty_tpl->tpl_vars['productInfo']->value['currency_code']==$_smarty_tpl->tpl_vars['row']->value['currency_code']){?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
</option>
                                <?php }elseif($_smarty_tpl->tpl_vars['row']->value['currency_code']=="RMB"){?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
</option>
                                <?php }else{ ?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
" ><?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
</option>
                                <?php }?>
                                <?php } ?>
                                </select>                            </td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
declaredValue<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input">                                     
                                   
                                        <input type="text" name="declared_value" id="declared_value" size="10" class="fix-medium1-input text-input" placeholder="0.00" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_declared_value']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_declared_value'];?>
<?php }?>" />
                                        <strong>*</strong> <!--(<span id="currency"><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_currency'];?>
</span>)-->
										<a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Declared_Value_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"/></a>										 </td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><input type="text" name="product_weight" id="product_weight" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_weight']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_weight'];?>
<?php }?>' class="required text-input fix-medium1-input" size='45'  placeholder="0.000"/>
                                        <span style='text-align:left;'><strong>*</strong> KG</span>  
										<a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weight_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"/></a>								</td>
                        </tr>
                        
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
生产企业名称<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">                                     
								<input type="text" name="enterprises_name" id="enterprises_name" size="10" class="fix-medium1-input text-input" placeholder="生产企业名称" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['enterprises_name']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['enterprises_name'];?>
<?php }?>" />&nbsp;<strong>*</strong>
							</td>
                        </tr>
                        <tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
country_code_of_origin<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">
								<select name="country_code_of_origin" class="fix-medium2-input" >
									<option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
									<?php if ($_smarty_tpl->tpl_vars['countryArr']->value!=''){?> 
									<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['n'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['n']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['name'] = 'n';
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['countryArr']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total']);
?>
									 <?php if ($_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['trade_country']!=''){?>
									 <option value="<?php echo $_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_code'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['country_code_of_origin']==$_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_code'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_code'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_name'];?>

									 <?php }?>
									</option>
									<?php endfor; endif; ?> 
									<?php }?>
								</select>
								<strong>*</strong></td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
brand<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input">                                     
                                   
                                        <input type="text" name="brand" id="brand" size="10" class="fix-medium1-input text-input" placeholder="品牌" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['brand']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['brand'];?>
<?php }?>" />&nbsp;<strong>*</strong>										 </td>
                        </tr>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
品牌原产国<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">
								<select name="brand_country" class="fix-medium2-input" >
									<option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
									<?php if ($_smarty_tpl->tpl_vars['countryArr']->value!=''){?> 
									<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['n'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['n']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['name'] = 'n';
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['countryArr']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total']);
?>
									 <?php if ($_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['trade_country']!=''){?>
									 <option value="<?php echo $_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_code'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['brand_country']==$_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_code'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_code'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_name'];?>

									 <?php }?>
									</option>
									<?php endfor; endif; ?> 
									<?php }?>
								</select>&nbsp;<strong>*</strong>
							</td>
                        </tr>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
主要成份<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">                                     
								<input type="text" name="element" id="element" size="10" class="fix-medium1-input text-input" placeholder="主要成份" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['element']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['element'];?>
<?php }?>" />&nbsp;<strong>*</strong>
							</td>
                        </tr>
						<!--
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
条形码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">                                     
								<input type="text" name="barcode" id="barcode" size="10" class="fix-medium1-input text-input" placeholder="条形码" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['barcode']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['barcode'];?>
<?php }?>" />
							</td>
                        </tr>
						-->
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
法检<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">                                     
								<select name="inspection_flag" class="fix-medium2-input" id="inspection_flag">
                                    <option value="1" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['inspection_flag']=="1"){?>selected <?php }?>>法检</option>
									<option value="0" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['inspection_flag']=="0"){?>selected <?php }?>>非法检</option>
								</select>
							</td>
                        </tr>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
赠品<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">                                     
								<select name="gift_flag" class="fix-medium2-input" id="gift_flag">
                                    <option value="1" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['gift_flag']=="1"){?>selected <?php }?>>是</option>
									<option value="0" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['gift_flag']=="0"){?>selected <?php }?>>否</option>
								</select>
							</td>
                        </tr>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
适用标准<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">
								<select name="standards" class="fix-medium2-input" id="standards">
                                    <option value="1" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['standards']=="1"){?>selected <?php }?>>国内标准</option>
									<option value="2" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['standards']=="2"){?>selected <?php }?>>国际标准</option>
								</select>
							</td>
                        </tr>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
认证情况<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">
								<select name="certification" class="fix-medium2-input" id="certification">
                                    <option value="1" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['certification']=="1"){?>selected <?php }?>>需要</option>
									<option value="0" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['certification']=="0"){?>selected <?php }?>>不需要</option>
								</select>
							</td>
                        </tr>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
监管类别<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">                                     
								<select name="supervision_flag" class="fix-medium2-input" id="supervision_flag">
                                   <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
									<?php if ($_smarty_tpl->tpl_vars['supervisionArr']->value!=''){?> 
									<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['n'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['n']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['name'] = 'n';
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['supervisionArr']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total']);
?>
									 <option value="<?php echo $_smarty_tpl->tpl_vars['supervisionArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['code'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['supervision_flag']==$_smarty_tpl->tpl_vars['supervisionArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['code'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['supervisionArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['code'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['supervisionArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['name'];?>

									</option>
									<?php endfor; endif; ?> 
									<?php }?>
								</select>&nbsp;<strong>*</strong>
							</td>
                        </tr>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
境外食品生产企业注册号<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">                                     
								<input type="text" name="food_enterprise_number" id="food_enterprise_number" size="10" class="fix-medium1-input text-input" placeholder="境外食品生产企业注册号" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['food_enterprise_number']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['food_enterprise_number'];?>
<?php }?>" />
							</td>
                        </tr>
						<tr>
							<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
企业风险明示<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td class="form_input">                                     
								<select name="warning_flag" class="fix-medium2-input" id="warning_flag">
                                    <option value="1" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['warning_flag']=="1"){?>selected <?php }?>>同意</option>
									<option value="0" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['warning_flag']=="0"){?>selected <?php }?>>不同意</option>
								</select>
							</td>
                        </tr>
                        <tr>
								<td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><input type="text" name="product_description" id="product_description" size="10" class="fix-medium1-input text-input" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_description']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_description'];?>
<?php }?>" /></td>
                        </tr>
                        <tr>
                            <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomsGoodsName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                            <td class="form_input">
                                <input type="text" name="hs_goods_name" id="hs_goods_name" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['hs_goods_name']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['hs_goods_name'];?>
<?php }?>' class="required text-input fix-medium1-input" size='45'/>
                                <strong>*</strong>
                            </td>
                        </tr>
                         <tr>
                                <td class="form_title nowrap text_right">规格型号：</td>
                                <td class="form_input"><input type="text" name="product_model" id="product_model"  placeholder="" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_model']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_model'];?>
<?php }?>' minlength="10" maxlength="10" class="text-input fix-medium1-input" size="45"   />
                                        <strong>*</strong> <span id="hscodeName" class="red">
										</span>
                                </td>
                        </tr>
                         <tr>
                                <td class="form_title nowrap text_right">行邮税号：</td>
                                <td class="form_input">
                                    <select name="gt_code" class="fix-medium2-input" >
                                        <option value=''>--请选择--</option>
                                        <?php  $_smarty_tpl->tpl_vars['tax'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tax']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['taxList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tax']->key => $_smarty_tpl->tpl_vars['tax']->value){
$_smarty_tpl->tpl_vars['tax']->_loop = true;
?>
                                        <option value='<?php echo $_smarty_tpl->tpl_vars['tax']->value['gt_code'];?>
' tax='<?php echo $_smarty_tpl->tpl_vars['tax']->value['gt_rate'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['gt_code']==$_smarty_tpl->tpl_vars['tax']->value['gt_code']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['tax']->value['gt_code'];?>
<?php if ($_smarty_tpl->tpl_vars['tax']->value['gt_name']){?><?php echo $_smarty_tpl->tpl_vars['tax']->value['gt_name'];?>
<?php }?></option>
                                        <?php } ?>
                                    </select>
                                        <strong>*</strong> <span id="gt_codeName" class="red">
										</span>
                                </td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomsCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><input type="text" name="hscode" id="hscode"  placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_select_the_customs_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['hs_code']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['hs_code'];?>
<?php }?>' minlength="10" maxlength="10" class="text-input fix-medium1-input" size="45"  onblur="padHselement();" onKeyDown="if(event.keyCode==13){event.returnValue=false;padHselement();}" />
                                        <strong>*</strong> <span id="hscodeName" class="red">
										</span>&nbsp;&nbsp;<a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_enter_the_product_known_customs_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"/></a></td>
                        </tr>
                     
                        <tr>
                                <td class="form_title nowrap text_right">&nbsp;</td>
                                <td class="form_input">										
										<a href="#"   id="dialog_link" class="ui-state-default  ui-corner-all" style="width:100px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectHScode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></td>
                        </tr>	
						
						
						
                        <tr>
                                <td class="form_title nowrap text_right"></td>
                                <td class="form_input" id="hs_element">								</td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productImage<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input">
										<div style="width: 120px;float:left;">
                                                <div id="queue"></div>
                                                <input id="file_upload" name="file_upload" type="file" multiple="true"  >
                                                <input id="sessionid" value="<?php echo $_smarty_tpl->tpl_vars['sessionid']->value;?>
" type="hidden">
                                        </div>
										<!--
                                        <div style="width: 120px;float: left;">
                                                <p  href="void(0)" style="margin-left:5px;width: 120px;color:#fff" class="uploadify-button"  id='uploadWebImage'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
netimg<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>
										</div>
										-->
										<div style="width: 30px;float: left; margin-left:34px;display:inline;">
										<a href="#"  class="tip" title="（<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_pic_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
）" onclick="return false;"><img src="/images/help.png"/></a></div>
									
								</td>
                        </tr>
						<!--
						 <tr>
							<td class="form_title">&nbsp;</td>
							<td class="form_input">
								<input type="hidden" name="image1" id="image1_input" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value['attach'][1])){?> value="1"<?php }?> />
								<input type="hidden" name="image2" id="image2_input" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value['attach'][2])){?> value="1"<?php }?> />
								<input type="hidden" name="image3" id="image3_input" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value['attach'][3])){?> value="1"<?php }?> />
								<table>
									<tr>
										<td>
										<div style="width:80px;height:80px;border:1px solid #000;">
											<div class="imageDiv" id="image1" style="width:80px;height:60px;cursor:pointer;">
											<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value['attach'][1])){?><img src="data:image/jpeg;base64,<?php echo $_smarty_tpl->tpl_vars['productInfo']->value['attach'][1]['pa_content'];?>
" width='80px' height='60px'/><?php }?>
											</div>
											<div style="width:80px;height:19px;text-align:center;background-color:#F90;">正面</div>
										</div>
										</td>
										<td>
											<div style="width:80px;height:80px;border:1px solid #000;">
												<div class="imageDiv" id="image2" style="width:80px;height:60px;cursor:pointer;">
												<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value['attach'][2])){?><img src="data:image/jpeg;base64,<?php echo $_smarty_tpl->tpl_vars['productInfo']->value['attach'][2]['pa_content'];?>
" width='80px' height='60px'/><?php }?>
												</div>
												<div style="width:80px;height:19px;text-align:center;background-color:#F90;">侧面</div>
											</div>
										</td>
										<td>
											<div style="width:80px;height:80px;border:1px solid #000;">
												<div class="imageDiv" id="image3" style="width:80px;height:60px;cursor:pointer;"><?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value['attach'][3])){?><img src="data:image/jpeg;base64,<?php echo $_smarty_tpl->tpl_vars['productInfo']->value['attach'][3]['pa_content'];?>
" width='80px' height='60px'/><?php }?></div>
												<div style="width:80px;height:19px;text-align:center;background-color:#F90;">背面</div>
											</div>
										</td>
										<?php if (!empty($_smarty_tpl->tpl_vars['productInfo']->value['attach']['addition'])){?>
										<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productInfo']->value['attach']['addition']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
										<td class="image_td">
											<input type="hidden" name="additionImage[]" id="image<?php echo $_smarty_tpl->tpl_vars['item']->value['pa_type'];?>
_input" value="1"/>
											<div style="width:80px;height:80px;border:1px solid #000;">
												<div class="imageDiv" id="image<?php echo $_smarty_tpl->tpl_vars['item']->value['pa_type'];?>
" style="width:80px;height:60px;cursor:pointer;">
												<img src="data:image/jpeg;base64,<?php echo $_smarty_tpl->tpl_vars['item']->value['pa_content'];?>
" width='80px' height='60px'/></div>
												<div style="width:80px;height:19px;text-align:center;background-color:#F90;">标签</div>
											</div>
										</td>
										<?php } ?>
										<?php }else{ ?>
										<td class="image_td">
											<input type="hidden" name="additionImage[]" id="image4_input" />
											<div style="width:80px;height:80px;border:1px solid #000;">
												<div class="imageDiv" id="image4" style="width:80px;height:60px;cursor:pointer;">
												</div>
												<div style="width:80px;height:19px;text-align:center;background-color:#F90;">标签</div>
											</div>
										</td>
										<?php }?>
									</tr>
								</table>
							</td>
                        </tr>
						-->
						
                        <tr>
                                <td class="form_title">&nbsp;</td>
                                <td class="form_input">								
								<div  id='pic_wrapper' > 								
								<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['attach']){?>
                                   <?php  $_smarty_tpl->tpl_vars['att'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['att']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productInfo']->value['attach']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['att']->key => $_smarty_tpl->tpl_vars['att']->value){
$_smarty_tpl->tpl_vars['att']->_loop = true;
?>
                                       <div class="imgWrap" style="position:relative;height:140px;">
										<input type='hidden' name='image[<?php echo $_smarty_tpl->tpl_vars['att']->value['pa_type'];?>
][]' value='<?php echo $_smarty_tpl->tpl_vars['att']->value['pa_path'];?>
'>
										<img src="data:image/jpeg;base64,<?php echo $_smarty_tpl->tpl_vars['att']->value['pa_content'];?>
" style="width: 140px; height: 110px;"/>
										<select style="width:100%;" name="imageSelect[<?php echo $_smarty_tpl->tpl_vars['att']->value['pa_type'];?>
][]">
										<option value="">请选择</option>
										<option value="1" <?php if ($_smarty_tpl->tpl_vars['att']->value['pa_type']==1){?>selected<?php }?>>正面</option>
										<option value="2" <?php if ($_smarty_tpl->tpl_vars['att']->value['pa_type']==2){?>selected<?php }?>>侧面</option>
										<option value="3" <?php if ($_smarty_tpl->tpl_vars['att']->value['pa_type']==3){?>selected<?php }?>>背面</option>
										<option value="4" <?php if ($_smarty_tpl->tpl_vars['att']->value['pa_type']==4){?>selected<?php }?>>标签</option>
										</select>
                                        <img class="deleteImage" src="/images/icons/icon_square_close.png" style="cursor:pointer;position:absolute;top: 9px;right: 9px;width:14px;height:14px;">
									   </div>	
                                   <?php } ?>
                                <?php }?> </div>
                                </td>
                        </tr>
						
                		<tr>
                        		<td class="form_title"></td>
                        		<td class="form_input"><a href="void(0)" class="button tijiao" onclick="dosubmit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> </td>
						</tr> 
				</tbody>
        </table>
        </fieldset>
        <div class="clear"></div>
        <!-- End .clear -->
        <div class="infoTips" id="commonProductTip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"> </div>
</form>

<style type="text/css">
#distributor-pagination {
  display: block;
  padding: 5px 0;
  clear: both;
}

#distributor-pagination span {
  padding: 5px 8px;
  border: 1px solid #cccccc;
  margin-right: 5px;
  cursor: pointer;
}

#distributor-pagination span.current {
  color: #cccccc;
  cursor: text;
}
</style>
<div id="distributor-search-dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorFindOut<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none;">
  <form>
    <table class="table list formtable tableborder">
      <tr>
        <td>
          &nbsp;&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="text" class="text-input fix-small-input" name="distributor_search_code" id="distributor-search-code" value="" />
          &nbsp;&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="text" class="text-input fix-small-input" name="distributor_search_name" id="distributor-search-name" value="" />
          &nbsp;&nbsp;<input type="button" class="button" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorOperationFindOut<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" id="distributor-search-ajax" />
        </td>
      </tr>
    </table>
  </form>

  <table class="table list formtable tableborder" style="margin-top:10px;margin-bottom:5px;display:none;" id="distributor-search-ajax-content"></table>
  <div id="distributor-pagination" style="display:none;"></div>
</div>

<script>
            $('.deleteImage').click(function() {
                $(this).closest('.imgWrap').remove();
            });
			$(document).ready(function(){
						$('#dialog').dialog({
						autoOpen: false,
						modal: true,
						bgiframe:true,
						position:[50,50],
						width: 700,	
						height:500,
						draggable: true,	
						resizable: true	
						});
							
						//产品浏览
						$('#dialog_link').click(function(){					
								$('#dialog').dialog('open');									
								return false;
						});      
			
						
			
					$('#commonProductTip').dialog({
						autoOpen: false,
						modal: false,
						position:[50,50],
						bgiframe:true,
						width: 400,		
						resizable: true			
					});
			});

			


		/*获取选择海关编码的数据*/
		function getHScodeListBoxData(from,page,pageSize,p_name,s_hs_code){		   
			var from = from||'product';			
			var page = page||1;
			var pageSize = pageSize||20;
			var p_name = p_name||'';
			var s_hs_code = s_hs_code||'';
			$.post('/merchant/product/hscode-auxiliary-input',{from:from,page:page,pageSize:pageSize,p_name:p_name,s_hs_code:s_hs_code,global_hs_code:global_hs_code},function(result){$("#dialog").html(result);});
		
        }
	
  
				
		$(function(){
			getHScodeListBoxData();
			
		});

        var global_hs_code = "";
				
   		$(".productactionSku").live("click", function(){

			var hs_code = $(this).attr("hs_code");
            global_hs_code = hs_code;
            $("input[name='hscode']").val(hs_code);
            $(".productactionSku").attr('checked',false);
            $(".productactionSku").each(function(){
                if($(this).attr("hs_code")==hs_code){
                    $(this).attr("checked",true);
                }
            });
			$('#dialog').dialog('close');
			$('#hs_code').trigger('blur');
			padHselement();
            
        });
			

jQuery(document).ready(function ($) {
  /* 供应商代码相对于名称AJAX请求 */
  $('#distributor-code').blur(function (e) {
    var code = $.trim($(this).val());

    $.ajax({
      url : '/merchant/distributor/ajax',
      type : 'post',
      data : {
        code : code,
        type : 1
      },
      dataType : 'json',
      success : function (data, text, xhr) {
        if (data.status) {
          $('#distributor-id').val(data.data.distributor_id);
          $('#distributor-name').html(data.data.distributor_name).show();
        }
        else {
          $('#distributor-id').val(0);
          $('#distributor-name').html('').hide();
        }
      },
      error : function (xhr, text, error) {
        $('#distributor-id').val(0);
        $('#distributor-name').html('').hide();
      }
    });
  });

  /* 查找供应商弹出框初始化 */
  $('#distributor-search-dialog').dialog({
    autoOpen : false,
    modal : false,
    bgiframe : true,
    minWidth : 850,
    position : ['center', 'top'],
    width : 850,
    height :'auto',
    draggable : true,
    resizable : true
  });

  /* 查找供应商弹出框 */
  $('#distributor-search-action').click(function (e) {
    $('#distributor-search-dialog').dialog('open');
    $('#distributor-search-ajax').trigger('click');
  });
  
  $('.imageDiv').live("click", function() {
		$('.imageDiv').css("background-color","#FFF");
		$(this).css("background-color","#EEE");
		$("#currentSelectImage").val($(this).attr("id"));
  })
  /* 查找供应商AJAX请求 */
  $('#distributor-search-ajax').click(function (e) {
    var code = $.trim($('#distributor-search-code').val());
    var name = $.trim($('#distributor-search-name').val());
    var pagination = '';
    var size = $.trim($('#distributor-page-size').val());

    if (!/^[1-9][0-9]{0,2}$/.test(size)) {
      size = 10;
    }

    $.ajax({
      url : '/merchant/distributor/ajax',
      type : 'post',
      data : {
        type : 2,
        code : code,
        name : name,
        page : 1,
        size : size
      },
      dataType : 'json',
      success : function (data, text, xhr) {
        if (data.status) {
          $('#distributor-search-ajax-content').html(data.data.html).show();

          if (data.data.total > 0) {
            pagination = distributorRenderPage(data.data.page, data.data.size, data.data.total);
            $('#distributor-pagination').html(pagination).show();
          }
          else {
            $('#distributor-pagination').html('').hide();
          }
        }
        else {
          $('#distributor-search-ajax-content').html('').hide();
          $('#distributor-pagination').html('').hide();
        }
      },
      error : function (xhr, text, error) {
        $('#distributor-search-ajax-content').html('').hide();
      }
    });
  });
});

/* 查找供应商选择Function */
function selectDistributor(id, code, name) {
  $('#distributor-id').val(id);
  $('#distributor-code').val(code);
  $('#distributor-name').html(name).show();
  $('#distributor-search-dialog').dialog('close');
}

/* 供应商翻页 */
function distributorPaginationShow(page, size) {
  var code = $.trim($('#distributor-search-code').val());
  var name = $.trim($('#distributor-search-name').val());
  var page = page || 1;
  var size = size || 10;
  var pagination = '';

  $.ajax({
    url : '/merchant/distributor/ajax',
    type : 'post',
    data : {
      type : 2,
      code : code,
      name : name,
      page : page,
      size : size
    },
    dataType : 'json',
    success : function (data, text, xhr) {
      if (data.status) {
        $('#distributor-search-ajax-content').html(data.data.html).show();

        if (data.data.total > 0) {
          pagination = distributorRenderPage(data.data.page, data.data.size, data.data.total);
          $('#distributor-pagination').html(pagination).show();
        }
        else {
          $('#distributor-pagination').html('').hide();
        }
      }
      else {
        $('#distributor-search-ajax-content').html('').hide();
        $('#distributor-pagination').html('').hide();
      }
    },
    error : function (xhr, text, error) {
      $('#distributor-search-ajax-content').html('').hide();
    }
  });
}

/* 供应商，生产分页 */
function distributorRenderPage(current, size, total) {
  var html = '';
  var max = Math.ceil(total /size);

  if (1 != current) {
    html += '<span onclick="distributorPaginationShow(1, ' + size + ');"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorPageFirst<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>';
    html += '<span onclick="distributorPaginationShow(' + (current - 1) + ', ' + size + ');"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorPagePrevious<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>';
  }

  if (max <= 10) {
    for (var i = 1; i <= max; ++i) {
      if (i == current) {
        html += '<span class="current">' + i + '</span>';
      }
      else {
        html += '<span onclick="distributorPaginationShow(' + i + ', ' + size + ');">' + i + '</span>';
      }
    }
  }
  else if (max > 10 && current <= 5) {
    for (var i = 1; i <= 10; ++i) {
      if (i == current) {
        html += '<span class="current">' + i + '</span>';
      }
      else {
        html += '<span onclick="distributorPaginationShow(' + i + ', ' + size + ');">' + i + '</span>';
      }
    }
  }
  else if (max > 10 && current > 5) {
    var start = current - 4;
    var end = current + 5;

    if (end > max) {
      start = max - 9;
      end = max;
    }

    for (var i = start; i <= end; ++i) {
      if (i == current) {
        html += '<span class="current">' + i + '</span>';
      }
      else {
        html += '<span onclick="distributorPaginationShow(' + i + ', ' + size + ');">' + i + '</span>';
      }
    }
  }

  if (max != current) {
    html += '<span onclick="distributorPaginationShow(' + (current + 1) + ', ' + size + ');"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorPageNext<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>';
    html += '<span onclick="distributorPaginationShow(' + max + ', ' + size + ');"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorPageLast<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>';
  }

  html += '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorPageRecordItems<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<input type="text" style="width:30px;" value="' + size + '" id="distributor-page-size" onchange="distributorChangePageSize(this);" />';
  html += '&nbsp;&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorPageTotal<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<strong>' + total + '</strong>';

  return html;
}

/* 更改供应商列表每页显示的记录数 */
function distributorChangePageSize(e) {
  var size = $.trim($(e).val());

  if (!/^[1-9][0-9]{0,2}$/.test(size)) {
    size = 10;
  }

  distributorPaginationShow(1, size);
}

function addImages(){
	var count = $('.image_td').length+4;
	if(count>=9)return false;
	var html = '<td class="image_td"><input type="hidden" id="image'+count+'_input" name="additionImage[]" /><div style="width:80px;height:80px;border:1px solid #000;"><div class="imageDiv" id="image'+count+'" style="width:80px;height:60px;cursor:pointer;"></div><div style="width:80px;height:19px;text-align:center;background-color:#F90;">标签</div></div></td>';
	$(".image_td").last().after(html);
}
function delImages(){
	var count = $('.image_td').length;
	if(count<=1)return false;
	$(".image_td").last().remove();
}
$(function(){
$("[name=customer_code]").autocomplete({ 
		minLength: 0,
		source: function(request, response) {
			var customerList=<?php echo $_smarty_tpl->tpl_vars['customerJson']->value;?>
;
                        response(customerList);
		}			
	}).focus(function() {
	   $("[name=customer_code]").autocomplete("search", "");
	});
        $("[name=gt_code]").change(function(){
            var taxRate=$(this).find('option:selected').attr('tax');
            if(typeof(taxRate)!='undefined'&&taxRate!=''){
                $("#gt_codeName").html('行邮税率：'+taxRate);
            }else{
                 $("#gt_codeName").html('');
            }
        })

})
</script>

<div id="dialog"   title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectHScode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"> </div><?php }} ?>