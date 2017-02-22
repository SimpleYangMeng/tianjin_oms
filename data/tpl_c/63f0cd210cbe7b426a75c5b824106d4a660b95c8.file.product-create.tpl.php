<?php /* Smarty version Smarty-3.1.13, created on 2014-07-09 17:27:04
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/product/product-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173519074153b3a1c1217937-26127784%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63f0cd210cbe7b426a75c5b824106d4a660b95c8' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/product/product-create.tpl',
      1 => 1404894882,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173519074153b3a1c1217937-26127784',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3a1c142d225_22511220',
  'variables' => 
  array (
    'productInfo' => 0,
    'category' => 0,
    'item' => 0,
    'uom' => 0,
    'currency' => 0,
    'row' => 0,
    'customer' => 0,
    'countryArr' => 0,
    'sessionid' => 0,
    'att' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3a1c142d225_22511220')) {function content_53b3a1c142d225_22511220($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><form method="post" id="commonProductForm"  action="/merchant/product/add-save" class="pageForm required-validate">
        <fieldset>
        <table >
                <tbody>
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
                          <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                          <td class="form_input">
                            <input name="distributor_code" id="distributor-code" type="text"  placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseEnterDistributorCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" class="text-input fix-medium1-input" size="45" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&isset($_smarty_tpl->tpl_vars['productInfo']->value['distributor'])){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productInfo']->value['distributor']['distributor_code'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>" />
                            <input name="distributor_id" id="distributor-id" type="hidden" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&isset($_smarty_tpl->tpl_vars['productInfo']->value['distributor'])){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['distributor']['distributor_id'];?>
<?php }?>" />
                            &nbsp;<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&isset($_smarty_tpl->tpl_vars['productInfo']->value['distributor'])){?><span id="distributor-name"><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['distributor']['distributor_name'];?>
</span><?php }else{ ?><span id="distributor-name" style="display:none;"></span><?php }?>
                            &nbsp;<input id="distributor-search-action" type="button" class="ui-state-default ui-corner-all" style="padding:6px 8px;cursor:pointer;" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorFindOut<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" />
                          </td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductCategory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><select name="type" class="fix-medium2-input"  >
                                                <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
                                                <?php if ($_smarty_tpl->tpl_vars['category']->value!=''){?> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?> <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['pc_id'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['pc_id']==$_smarty_tpl->tpl_vars['item']->value['pc_id'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value["pc_name"];?>

                                                </option>
                                                <?php } ?> <?php }?>
                                        </select>
										<strong>*</strong>   <a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_category_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>                        </td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
p_unit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
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
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BarcodeType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><select name="barcode_type" class="fix-medium2-input" id="barcode_type">
                                                <option value="0" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['product_barcode_type']=='0')){?>selected<?php }?> >默认类型
                        
                                                </option>
                                                <option value="1" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['product_barcode_type']=='1')){?>selected<?php }?>>自定义类型
                        
                                                </option>
                                                <option value="2" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['product_barcode_type']=='2')){?>selected<?php }?>>序列类型
                        
                                                </option>
                                        </select>                                </td>
                        </tr>
                        <tr id="barcodebox">
                                <td class="form_title nowrap text_right"></td>
								<td class="form_input">
<input name="barcode" id="barcode" type="text"   size="18" class="fix-medium1-input text-input "  value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_barcode']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_barcode'];?>
<?php }?>" /> 
&nbsp;&nbsp; <a href="#"  class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_input_can_only_alphanumeric_and_rung_maximum_length_of_18<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a></td>
								</tr>				
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductSpecifications<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lengthd<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="text" name="length" id="length" size="10" placeholder="0.00" class="text-input fix-small-small-input" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_length']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_length'];?>
<?php }?>" />
                                       cm  &nbsp;&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
widthd<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                                        <input type="text" name="width" id="width" size="10" placeholder="0.00" class="text-input fix-small-small-input" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_width']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_width'];?>
<?php }?>" />
                                    	cm  &nbsp;&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
heightd<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                                        <input type="text" name="height" id="height" size="10" placeholder="0.00" class="text-input fix-small-small-input" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_height']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_height'];?>
<?php }?>" />
                                      cm <a href="#"  class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
dimensions_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"/></a></td>
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
												 <option value="<?php echo $_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_code'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['country_code_of_origin']==$_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_code'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_code'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['countryArr']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['country_name'];?>

                                                </option>
                                                <?php endfor; endif; ?> 
												<?php }?>
                                        </select>
										<strong>*</strong>								</td>
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
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><input type="text" name="product_description" id="product_description" size="10" class="fix-medium1-input text-input" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_description']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_description'];?>
<?php }?>" /></td>
                        </tr>
                        <tr>
                                <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomsCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                <td class="form_input"><input type="text" name="hscode" id="hscode"  placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_select_the_customs_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['hs_code']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['hs_code'];?>
<?php }?>' minlength="10" maxlength="10" class="text-input fix-medium1-input" size="45"  onblur="padHselement();" onKeyDown="if(event.keyCode==13){event.returnValue=false;padHselement();}" />
                                        <strong></strong> <span id="hscodeName" class="red">
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
                                        <div style="width: 120px;float: left;">
                                                <p  href="void(0)" style="margin-left:5px;width: 120px;color:#fff" class="uploadify-button"  id='uploadWebImage'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
netimg<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>
										</div>
										<div style="width: 30px;float: left; margin-left:34px;display:inline;">
										<a href="#"  class="tip" title="（<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_pic_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
）" onclick="return false;"><img src="/images/help.png"/></a>										</div>										</td>
                        </tr>
						

						
                        <tr>
                                <td class="form_title">&nbsp;</td>
                                <td class="form_input">								
								<div  id='pic_wrapper'> 								
								<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['attach']){?>
                                   <?php  $_smarty_tpl->tpl_vars['att'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['att']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productInfo']->value['attach']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['att']->key => $_smarty_tpl->tpl_vars['att']->value){
$_smarty_tpl->tpl_vars['att']->_loop = true;
?>
                                       <div class="imgWrap"> 
									   		<?php if ($_smarty_tpl->tpl_vars['att']->value['pa_file_type']=='img'){?>
                                                  <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['att']->value['pa_path'];?>
"
                                       name="picUrl[]">
                                                  <img src="<?php echo $_smarty_tpl->tpl_vars['att']->value['url'];?>
" style="" title='duble click to remove!'> <?php }else{ ?>
                                             <input type="hidden"
                                       value="<?php echo $_smarty_tpl->tpl_vars['att']->value['pa_path'];?>
"
                                       name="picLink[]">
                                            <img
                                        src="<?php echo $_smarty_tpl->tpl_vars['att']->value['url'];?>
"
                                        style=" display:;" title='duble click to remove!'> <?php }?> </div>
                                                <?php } ?>
                                                <?php }?> </div>
                                        <!--网络图片-->                                        </td>
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

			$(window).load(function(){
				//$.ajaxsetup({cache:false});
				var picNumber = $('.imgWrap img').size();									
				
				$('.imgWrap img').each(function(){
					
				var wrapWidth = 140;
				var wrapHeight = 140;
				var marginLeft = 0;
				var marginTop = 0;
				var width_ = height_ = 0;
					var img = $(this)[0];
					var width  = $(this).width();
					var height = $(this).height();
					
					var  scale_org = wrapWidth/wrapHeight;
			
					if (wrapWidth / width > wrapHeight / height)
					{
						height_ = wrapHeight;
						width_ = width  * wrapHeight/height;
					} else
					{
						width_ = wrapWidth;
						height_ = height * wrapWidth/width;
					}
					marginLeft = (wrapWidth-width_)/2+1;
					marginTop = (wrapHeight-height_)/2+1;
					//alert(height_);
				   // img.style.width=width_+"px";
					//img.style.height=height_+"px";
					//img.style.marginLeft=marginLeft+"px";
					//img.style.marginTop=marginTop+"px";	
						
					$(this).css({'width':width_});
					$(this).css({'height':height_});
					$(this).css({'marginLeft':marginLeft});
					$(this).css({'marginTop':marginTop});
					
					
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
</script>

<div id="dialog"   title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectHScode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"> </div><?php }} ?>