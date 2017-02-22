<?php /* Smarty version Smarty-3.1.13, created on 2016-02-17 11:25:02
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\product\product-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1841156c3e80e733933-86133857%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e10effdc8ed86394fdfae37211b043b22810791d' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\product\\product-create.tpl',
      1 => 1455677482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1841156c3e80e733933-86133857',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ieType' => 0,
    'k' => 0,
    'productInfo' => 0,
    'item' => 0,
    'customs' => 0,
    'checkOrg' => 0,
    'customer' => 0,
    'is_ecommerce' => 0,
    'ciqGoodsCategories' => 0,
    'sjUseWay' => 0,
    'uom' => 0,
    'countryArr' => 0,
    'currency' => 0,
    'row' => 0,
    'taxList' => 0,
    'tax' => 0,
    'sessionid' => 0,
    'i' => 0,
    'att' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c3e80ea345e9_41595253',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c3e80ea345e9_41595253')) {function content_56c3e80ea345e9_41595253($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><form method="post" id="commonProductForm"  action="/merchant/product/add-save" class="pageForm required-validate">
        <fieldset>
        <table >
                <tbody>
                <tr>
                    <td class="form_title nowrap text_right">进出口类型：</td>
                    <td class="form_input">
                        <select name="ie_type" id='ie_type' class="fix-medium2-input">
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ieType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['ie_type']==$_smarty_tpl->tpl_vars['k']->value)){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>

                                </option>
                            <?php } ?>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">主管海关代码：</td>
                    <td class="form_input">
                        <select name="customs_code" class="fix-medium2-input">
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['customs_code']==$_smarty_tpl->tpl_vars['item']->value['ie_port'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port_name'];?>

                                </option>
                            <?php } ?>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">属地检验检疫机构：</td>
                    <td class="form_input">
                        <select name="ins_unit_code" class="fix-medium2-input">
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['checkOrg']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['organization_code'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['ins_unit_code']==$_smarty_tpl->tpl_vars['item']->value['organization_code'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['organization_name'];?>

                                </option>
                            <?php } ?>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>
                <?php if (isset($_smarty_tpl->tpl_vars['customer']->value)&&$_smarty_tpl->tpl_vars['is_ecommerce']->value=='1'){?>
                    <tr>
                        <td class="form_title nowrap text_right">电商企业代码：</td>
                        <td class="form_input"><span class="blue"><?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
</span>
                            <input name="customer_code" id="title" class="fix-medium1-input text-input" type="hidden" size="45" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
" />
                        </td>
                    </tr>
                    <tr>
                        <td class="form_title nowrap text_right">电商企业名称：</td>
                        <td class="form_input"><span class="blue"><?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
</span>
                            <input name="enp_name" id="enp_name" class="fix-medium1-input text-input" type="hidden" size="45"  placeholder="电商企业名称" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
" />
                        </td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                        <td class="form_title nowrap text_right">电商企业代码：</td>
                        <td class="form_input"><input name="customer_code" id="title" class="fix-medium1-input text-input" type="text" size="45"  placeholder="电商企业代码" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['customer_code']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['customer_code'];?>
<?php }?>" />
                            <strong>*</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="form_title nowrap text_right">电商企业名称：</td>
                        <td class="form_input"><input name="enp_name" id="enp_name" class="fix-medium1-input text-input" type="text" size="45"  placeholder="电商企业名称" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['enp_name']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['enp_name'];?>
<?php }?>" />
                            <strong>*</strong>
                        </td>
                    </tr>
                <?php }?>

                <tr>
                    <td class="form_title nowrap text_right">申报单位企业代码：</td>
                    <td class="form_input"><span class="blue"><?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
</span><input name="storage_customer_code" id="title" class="fix-medium1-input text-input" type="hidden" size="45"  placeholder="申报单位企业代码" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
" />
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">申报单位企业名称：</td>
                    <td class="form_input"><span class="blue"><?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
</span><input name="storage_enp_name" id="storage_enp_name" class="fix-medium1-input text-input" type="hidden" size="45"  placeholder="申报单位企业名称" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
" />
                    </td>
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
                        <td class="form_title nowrap text_right">商品货号：</td>
                        <td class="form_input"><input type="text" name="product_sku" id="product_sku"  placeholder="请输入商品SKU" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_sku']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_sku'];?>
<?php }?>' maxlength="50" class="text-input fix-medium1-input" size="45"  />
                                <strong>*</strong> <span id="productSkuTip" class="red">
                                </span>&nbsp;&nbsp;<a href="#"  class="tip" title="(请输入商品SKU，不能超50位)" onclick="return false;"><img src="/images/help.png"/></a></td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">商品分类：</td>
                    <td class="form_input">
                        <select name="goods_categories" class="fix-medium2-input">
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ciqGoodsCategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['goods_categories']==$_smarty_tpl->tpl_vars['k']->value){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                        <?php } ?>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>

                <tr>
                        <td class="form_title nowrap text_right">海关商品编码：</td>
                        <td class="form_input"><input type="text" name="hs_code" id="hscode"  placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_select_the_customs_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['hs_code']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['hs_code'];?>
<?php }?>' minlength="10" maxlength="10" class="text-input fix-medium1-input" size="45"  />
                                <strong>*</strong> <span id="hscodeName" class="red">
                                </span>&nbsp;&nbsp;<a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_enter_the_product_known_customs_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"/></a></td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">规格型号：</td>
                    <td class="form_input"><input type="text" name="product_model" id="product_model"  placeholder="" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_model']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_model'];?>
<?php }?>' class="text-input fix-medium1-input" size="45"   />
                        <strong>*</strong> <span id="hscodeName" class="red">
										</span>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">主要成分：</td>
                    <td class="form_input"><input type="text" name="element" id="element" placeholder="" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['element']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['element'];?>
<?php }?>' class="text-input fix-medium1-input" size="45"   />
                        <strong>*</strong>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">用途：</td>
                    <td class="form_input">
                        <!--
                        <input type="text" name="use_way" id="use_way" placeholder="" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['use_way']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['use_way'];?>
<?php }?>' class="text-input fix-medium1-input" size="45"   />
                        -->
                        <select name="use_way" id="use_way" class="fix-medium2-input">
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sjUseWay']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['x_code'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['use_way']==$_smarty_tpl->tpl_vars['item']->value['x_code']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['x_name'];?>
</option>
                        <?php } ?>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>
                <!--<tr>
                    <td class="form_title nowrap text_right">计量单位：</td>
                    <td class="form_input">

                        <select name="pu_code" class="fix-medium2-input" >
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
                </tr>-->
                <tr>
                    <td class="form_title nowrap text_right">申报单位/最小销售单位：</td>
                    <td class="form_input">
                        <select name="pu_code" class="fix-medium2-input" >
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['uom']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['code'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['pu_code']==$_smarty_tpl->tpl_vars['item']->value['code'])){?>selected="selected"<?php }elseif($_smarty_tpl->tpl_vars['item']->value['name']=="个"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value["name"];?>

                            </option>
                        <?php } ?>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">法定单位：</td>
                    <td class="form_input">

                        <select name="law_code" class="fix-medium2-input" >
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
                    <td class="form_title nowrap text_right">第二单位：</td>
                    <td class="form_input">

                        <select name="second_code" class="fix-medium2-input" >
                            <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
                            <?php if ($_smarty_tpl->tpl_vars['uom']->value!=''){?>
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['uom']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                    <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value['second_code'])&&$_smarty_tpl->tpl_vars['productInfo']->value['second_code']!=''){?>
                                        <?php if ($_smarty_tpl->tpl_vars['productInfo']->value['second_code']==$_smarty_tpl->tpl_vars['item']->value['code']){?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['code'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['item']->value["name"];?>
</option>
                                        <?php }?>
                                    <?php }else{ ?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value["code"];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value["name"];?>
</option>
                                    <?php }?>
                                <?php } ?>
                            <?php }?>
                        </select>
                          <a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
legal_measurement_tip_second<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>										</td>
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
                    <td class="form_title nowrap text_right">品牌：</td>
                    <td class="form_input">

                        <input type="text" name="brand" id="brand" size="10" class="fix-medium1-input text-input" placeholder="" value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['brand']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['brand'];?>
<?php }?>" />
                        <strong>*</strong>
                        <a href="#"  class="tip" title="(请填写品牌)" onclick="return false;"><img src="/images/help.png"/></a>										 </td>
                </tr>

                        <tr id="country_code_of_origin_tr">
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
                    <td class="form_title">申报币制：</td>
                    <td class="form_input">
                        <select name="currency_code" class="fix-medium2-input" id="currency_code">
                                 <?php if (isset($_smarty_tpl->tpl_vars['currency']->value)){?>
                                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['currency']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                        <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value['currency_code'])&&$_smarty_tpl->tpl_vars['productInfo']->value['currency_code']==$_smarty_tpl->tpl_vars['row']->value['currency_code']){?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
</option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
</option>
                                        <?php }?>
                                    <?php } ?>
                                 <?php }?>

                                </select>
                    </td>
                </tr>
                <tr id="gt_code_tr">
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
                                <td class="form_title nowrap text_right">毛重：</td>
                                <td class="form_input"><input type="text" name="product_weight" id="product_weight" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_weight']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_weight'];?>
<?php }?>' class="required text-input fix-medium1-input" size='45'  placeholder="0.000"/>
                                        <span style='text-align:left;'><strong>*</strong> KG</span>  
										<a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weight_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"/></a>								</td>
                        </tr>

                <tr>
                    <td class="form_title nowrap text_right">净重：</td>
                    <td class="form_input"><input type="text" name="product_net_weight" id="product_net_weight" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_weight']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_net_weight'];?>
<?php }?>' class="required text-input fix-medium1-input" size='45'  placeholder="0.000"/>
                        <span style='text-align:left;'><strong>*</strong> KG</span>
                        <a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weight_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"/></a>								</td>
                
                    
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">生产企业：</td>
                    <td class="form_input"><input type="text" name="enterprises_name" id="enterprises_name" placeholder="" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['enterprises_name']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['enterprises_name'];?>
<?php }?>' class="text-input fix-medium1-input" size="45"   />
                        <strong>*</strong>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">供应商：</td>
                    <td class="form_input"><input type="text" name="supplier" id="supplier" placeholder="" value='<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['supplier']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['supplier'];?>
<?php }?>' class="text-input fix-medium1-input" size="45"   />
                        <strong>*</strong>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">赠品：</td>
                    <td class="form_input">
                        <select id="gift_flag" class="fix-medium2-input" name="gift_flag">
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </td>
                </tr>
                <tr id="barcodebox">
                    <td class="form_title">商品条码:</td>
                    <td class="form_input">
                        <input name="barcode" id="barcode" placeholder="请输入条码" type="text"   size="18" class="fix-medium1-input text-input "  value="<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['product_barcode']){?><?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_barcode'];?>
<?php }?>" />&nbsp;<strong style=" visibility:hidden;">*</strong>&nbsp;							</td>
                    <input type="hidden" size="45" value="<?php echo $_smarty_tpl->tpl_vars['productInfo']->value['product_id'];?>
"  name="product_id">
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
是否符合法律法规申明<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td class="form_input">
                        <select id="is_law_regulation" class="fix-medium2-input" name="is_law_regulation">
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </td>            
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">附件信息：</td>
                    <td class="form_input">
                        <div style="width: 120px;float:left;">
                            <div id="queue"></div>
                            <input id="file_upload" name="file_upload" type="file" multiple="true"  >
                            <input id="sessionid" value="<?php echo $_smarty_tpl->tpl_vars['sessionid']->value;?>
" type="hidden">
                        </div>
                    </td>
                </tr>

                        <tr>
                                <td class="form_title">&nbsp;</td>
                                <td class="form_input">								
								<div  id='pic_wrapper' > 								
								<?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&$_smarty_tpl->tpl_vars['productInfo']->value['attach']){?>
                                   <?php  $_smarty_tpl->tpl_vars['att'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['att']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['productInfo']->value['attach']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['att']->key => $_smarty_tpl->tpl_vars['att']->value){
$_smarty_tpl->tpl_vars['att']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['att']->key;
?>
                                       <div class="imgWrap" style="position:relative;height:140px;">
										<input type='hidden' name='image[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
][]' value='<?php echo $_smarty_tpl->tpl_vars['att']->value['pa_path'];?>
'>
										<img src="data:image/jpeg;base64,<?php echo $_smarty_tpl->tpl_vars['att']->value['pa_content'];?>
" style="width: 140px; height: 110px;"/>
                                        <input type="text" style="width:100%;" name="imageSelect[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
][]" value="<?php echo $_smarty_tpl->tpl_vars['att']->value['pa_name'];?>
" placeholder="请输入名称" />
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



        var global_hs_code = "";
				
   		$(".productactionSku").live("click", function(){

			var hs_code = $(this).attr("hs_code");
            global_hs_code = hs_code;
            $("input[name='hs_code']").val(hs_code);
            $(".productactionSku").attr('checked',false);
            $(".productactionSku").each(function(){
                if($(this).attr("hs_code")==hs_code){
                    $(this).attr("checked",true);
                }
            });
			$('#dialog').dialog('close');
			$('#hs_code').trigger('blur');
            
        });
			

jQuery(document).ready(function ($) {
  
  $('.imageDiv').live("click", function() {
		$('.imageDiv').css("background-color","#FFF");
		$(this).css("background-color","#EEE");
		$("#currentSelectImage").val($(this).attr("id"));
  })

});



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
        $("[name=gt_code]").change(function(){
            var taxRate=$(this).find('option:selected').attr('tax');
            if(typeof(taxRate)!='undefined'&&taxRate!=''){
                $("#gt_codeName").html('行邮税率：'+taxRate);
            }else{
                 $("#gt_codeName").html('');
            }
        });
        $('#ie_type').change(function(){
            if($(this).val()=='I'){
                $('#currency_code').html('<option value="RMB" selected>RMB</option>');
                $('#gt_code_tr').show();
                $('#country_code_of_origin_tr').show();
                $('#currency_code').trigger('update');
            }else{
                $('#currency_code').html('<option value="USD" selected>USD</option>');
                $('#gt_code_tr').hide();
                $('#country_code_of_origin_tr').hide();
                $('#currency_code').trigger('update');
            }
        }).change();
})
</script>

<div id="dialog"   title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectHScode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"> </div><?php }} ?>