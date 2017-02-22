<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 15:28:38
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/order/beihuo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126960784453b3b4a6d23ee5-51434986%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e9887d527f30ce4b60f5d66d8b35f407e1c130c' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/order/beihuo.tpl',
      1 => 1399859848,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126960784453b3b4a6d23ee5-51434986',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'orderInfo' => 0,
    'product' => 0,
    'ordersCode' => 0,
    'warehouse' => 0,
    'w' => 0,
    'province_array' => 0,
    'city_array' => 0,
    'currencyAll' => 0,
    'currency' => 0,
    'IdType' => 0,
    'k' => 0,
    'type' => 0,
    'receiving' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3b4a70818e6_76227242',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3b4a70818e6_76227242')) {function content_53b3b4a70818e6_76227242($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style>
.width140{width:180;}
form span{color:red;}

</style>
<!--备货模式模板-->
<a href="#" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductInfo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" id="dialog_link" class="ui-state-default  ui-corner-all nowarp" style="display:block;padding:10px;margin-bottom:5px;float:left;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a><span class="jiahuowarehouse1"  style="margin-left:5px;margin-top:12px;display:block;float:left;color:red;font-size:1.1em">*</span>
<a href="#" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductImport<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" id="xls_input_link" class="ui-state-default  ui-corner-all nowarp" style="float:left;display:block;padding:10px; margin-left:5px;margin-bottom:5px;float:left" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductImport<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
<div class="clear"></div>
<form action="/merchant/order/create" method='POST' id='orderForm' class="pageForm required-validate">

    <div style="margin-right:0px;" class="nbox_c marB10">
        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th width='200'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th width='200'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductCategory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th width='80'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
total<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(KG)</th>
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
transaction_price<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
total_turnover<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            </tr>
			<!--
			<tr>
				<td colspan="10"   style="text-align:center"><span  style="color:red">请选择产品</span></td>
			</tr>
			-->			
            </thead>
            <tbody id='orderproducts'>
            <?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['order_product']){?>
			 <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['orderInfo']->value['order_product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
            <tr id="orderproduct<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
">
                <td><a target="_blank" href='/merchant/product/detail/productId/<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
'><?php echo $_smarty_tpl->tpl_vars['product']->value['product_sku'];?>
</a></td>
                <td><?php echo $_smarty_tpl->tpl_vars['product']->value['product_title'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['product']->value['category_name'];?>
</td>
                <td><input type="text" size="3" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['op_quantity'];?>
"
                			onkeyup="changeWeight(<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
,<?php echo $_smarty_tpl->tpl_vars['product']->value['product_weight'];?>
,this.value)"
                            name="sku[<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
]"><span class="red">*</span></td>
                <td id="sku<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_weight']*$_smarty_tpl->tpl_vars['product']->value['op_quantity'];?>
</td>
                <td><input type="text" class="inputbox inputMinbox price" name="price[<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['op_price'];?>
"  size="6"><span class="red">*</span></td>
                <td><input type="text" class="inputbox inputMinbox total_price" name="total_price[<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['op_total_price'];?>
" size="6"><span class="red">*</span></td>
                <td><a title="delete" href="javascript:;" class="productDel"><img
                        src="/images/icon_del.gif"></a></td>
            </tr>
            <?php } ?> <?php }?>
			
            	<tr class="norowdata">
            		<td colspan="8" style="text-align:center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
not_select_product_yet<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</b></td>
            		
            	</tr>			
			
            </tbody>
           

           		
            <tbody>
            	<tr>
            		<td colspan="4" style="text-align:right;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weigth_total<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</b></td>
            		<td id="total_weight"></td>
                    <!--<td>总成交总价</td>
                    <td id="count_total_weight"></td>-->
            		<td colspan="3"></td>
            	</tr>
            </tbody>
			
			
        </table>
        <div class="clear"></div>
    </div>
	<input type="hidden" value='0' name="ordermodel">
    <input type="hidden" name="ordersCode" value="<?php echo $_smarty_tpl->tpl_vars['ordersCode']->value;?>
" />
    <table class="pageFormContent" >
        <tbody>
       
        <tr class="jiahuowarehouse">
            <td  style="text-align:right" width='175' class="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ShippingWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td colspan="3">
			<select name="warehouse_id" id='warehouse_id' class="text-input width155 ">
                <option value="">-Select-</option>
                <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
                <option isfirst="<?php echo $_smarty_tpl->tpl_vars['w']->value['is_first'];?>
" value='<?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['warehouse_id']==$_smarty_tpl->tpl_vars['w']->value['warehouse_id']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_name'];?>
</option>
                <?php } ?>
            </select>
             <span>*</span>
			 <a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_select_the_order_to_delivery_warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>
			 <span id="tipwarehouse" class='red'><!--&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
!--></span>			 </td>
        </tr>
        </tbody>
        <tbody class='not_home_delivery'>

       <tr>
            <td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><select name="province_id" id='province_id' class="text-input width155">
          		<option value="">-Select-</option>
               
				 <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sn'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['name'] = 'sn';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['province_array']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total']);
?>				
                <option value='<?php echo $_smarty_tpl->tpl_vars['province_array']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['region_id'];?>
'
				
				<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['oab_state_id']==$_smarty_tpl->tpl_vars['province_array']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['region_id']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['province_array']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['region_name'];?>
</option>
                <?php endfor; endif; ?>
            </select>
            <span> *</span><span class='red'></span></td>        
            <td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
city<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><select name="city_id" id='city_id' class="text-input width155">
          		<option value="">-Select-</option>
               
				 <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sn'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['name'] = 'sn';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['city_array']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total']);
?>				
                <option value='<?php echo $_smarty_tpl->tpl_vars['city_array']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['region_id'];?>
'
				
				<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['oab_city_id']==$_smarty_tpl->tpl_vars['city_array']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['region_id']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['city_array']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['region_name'];?>
</option>
                <?php endfor; endif; ?>
				
            </select>
            <span></span><span class='red'></span></td>            
        </tr>	
        </tbody>

        <tbody class='not_home_delivery'>
       <tr>
            <td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><select name="shipping_method" class="text-input width155" id='shipping_method' default='<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['sm_code'];?>
<?php }?>'>
                <option value="">-Select-</option>							
            </select> 
            <span>*</span></td>
            <td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input  type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['reference_no'];?>
<?php }?>"
                         placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_input_the_sales_site_Trading_Order_No<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" name="reference_no" id="reference_no" class="text-input width140 valid">
                    <span> *</span>
			<a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer_reference_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>			</td>           
        </tr>
      <tr>
            <!--<td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lastName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input class="text-input width140" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_lastname'];?>
<?php }?>" name="oab_lastname">
            <span> *</span><span class='red'></span></td>-->
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lastName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
firstName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input class="text-input width140" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_firstname'];?>
<?php }?>" name="oab_firstname">
            <span> *</span><span class='red'></span></td>           
        </tr>
  
        <tr>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
companyName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input class="text-input width140" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_company'];?>
<?php }?>" name="oab_company"/><span class='red'></span></td>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
postalCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input class="text-input width140" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_postcode'];?>
<?php }?>" name="oab_postcode"/><span class='red'></span></td>
        </tr>

        <tr>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
address1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input  class="text-input width140" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_street_address1'];?>
<?php }?>" name="oab_street_address1"/>
            <span> *</span><span class='red'></span></td>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
address2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input  class="text-input width140" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_street_address2'];?>
<?php }?>" name="oab_street_address2"/><span class='red'></span></td>
        </tr>

        <tr>
            <td style="text-align:right" class="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
phone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input  class="text-input width140" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_phone'];?>
<?php }?>" name="oab_phone"/>
                    <span>*</span><span class='red'></span></td>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
email<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input  class="text-input width140" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_email'];?>
<?php }?>" name="oab_email"/><span class='red'></span></td>
        </tr>
        </tbody>
        <tbody>
		
        <tr>
                <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_gross_weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><input  class="text-input width140" type="text" placeholder="0.00" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['grossWt']!=0){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['grossWt'];?>
<?php }?>" name="grossWt" />&nbsp;KG</td>
                <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Currency<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td>
                    <select name='currency_code' class="width155">
                        <?php  $_smarty_tpl->tpl_vars['currency'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency']->_loop = false;
 $_smarty_tpl->tpl_vars['curId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['currencyAll']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency']->key => $_smarty_tpl->tpl_vars['currency']->value){
$_smarty_tpl->tpl_vars['currency']->_loop = true;
 $_smarty_tpl->tpl_vars['curId']->value = $_smarty_tpl->tpl_vars['currency']->key;
?>
                        <?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&($_smarty_tpl->tpl_vars['orderInfo']->value['currency_code']==$_smarty_tpl->tpl_vars['currency']->value['currency_code'])){?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['currency']->value['currency_code'];?>
' <?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&($_smarty_tpl->tpl_vars['orderInfo']->value['currency_code']==$_smarty_tpl->tpl_vars['currency']->value['currency_code'])){?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['currency']->value['currency_code'];?>
</option>
                            <?php }else{ ?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['currency']->value['currency_code'];?>
' <?php if ((($_smarty_tpl->tpl_vars['currency']->value['currency_code']=='RMB')&&$_smarty_tpl->tpl_vars['orderInfo']->value['currency_code']=='')){?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['currency']->value['currency_code'];?>
</option>
                            <?php }?>
                        <?php } ?>
                    </select>            </td>
        </tr>
       
		
       <tr>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
type_of_certificate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td>
                <select id="IdType" name='IdType' class="width155">
                    <!-- <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option> -->
                    <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['IdType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value){
$_smarty_tpl->tpl_vars['type']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['type']->key;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&($_smarty_tpl->tpl_vars['orderInfo']->value['IdType']==$_smarty_tpl->tpl_vars['k']->value)){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</option>
                    <?php } ?>
                </select>
                <span></span> 
<strong style=" visibility:hidden;">*</strong><a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
type_of_certificate_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>				</td>		
			   
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
IdentificationNumbers<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input class="text-input width140" type="text" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['idNumber'];?>
<?php }?>" name="idNumber"> 
            <span></span>
			<strong id="bhidNumberStrong" style=" visibility:hidden;">*</strong>
			<a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
identification_numbers_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>			</td>
        </tr>
		
        <tr>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
note<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td colspan='3'>
                <textarea cols="80" rows="2" name="remark"><?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['remark'];?>
<?php }?></textarea>
                <span class='red'></span></td>
        </tr>
        <tr>
            <td style="text-align:right">&nbsp;</td>
            <td colspan='3'>
                <a href="" class="button tijiao" id="orderbutton" onclick="ordervalidateCallback();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                <?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><input type="hidden" name='ordersCode' value="<?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['order_code'];?>
"><?php }?>            </td>
        </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">
    $(function(){
        $(".orderactionSku").live("click", function () {
            var productId = $(this).attr("productId");
            var productSku = $(this).attr("productSku");
            var productName = $(this).attr("productName");
            var category = $(this).attr("category");
            var productWeight = $(this).attr("productWeight");
            if ($(this).is(':checked')){
                if($("#orderproduct"+productId).size()==0){
                    if ($("#orderproduct" + productId).size() == 0) {
                        var html = '';
                        html += '<tr id="orderproduct' + productId + '" class="product_sku">';
                        html += '<td><a href="/merchant/product/detail/productId/'+productId+'" target="_blank">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                        html += '<td title="'+productName+'">' + productName + '</td>';
                        html += '<td>' + category + '</td>';
                        html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" value="1" size="6"><span class="red">*</span></td>';
                        html += '<td>'+productWeight+'</td>';
                        html += '<td><input type="text" class="inputbox inputMinbox price" name="price[">'+productId+']" size="6"><span class="red">*</span> </td>';
                        html += '<td><input type="text" class="inputbox inputMinbox total_price" name="total_price[">'+productId+']" size="6"><span class="red">*</span> </td>';
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
        });
        //处理模式
        $('.selectmodelbtn').bind('click',function(){
            //alert($(this).attr('model'));
            $('#ordermodeltext').html($(this).val());
            $('[name=ordermodel]').val($(this).attr('model'));
            $('.modelcontent').show();
            $('.model').hide();
            getOrderModel($(this).attr('model'))
        });
        $('.modelcontent').hide();
        $('#tipwarehouse').show();
        $(".productDel").live("click",function(){
            $(this).parent().parent().remove();
        });

        $('#warehouse_id').change(function(){
			selectwarehouse();
            var warehouseId = $('#warehouse_id').val();
            if($('#warehouse_id').val()!=''){                
				//$('#TargetwarehouseBox').show();
				//$('#to_warehouse_id').val(''); //目的仓库变为默认
				
            }else{
				$('#tipwarehouse').show();
			}
            if(warehouseId==3){
                var obj = document.getElementById("bhidNumberStrong");
                obj.style.visibility='hidden';
                $(".price").parents("td").children("span").text("*");
                $(".total_price").parents("td").children("span").text("*");
            }else{
                var obj = document.getElementById("bhidNumberStrong");
                //obj.style.visibility='visible';
                $(".price").parents("td").children("span").text("");
                $(".total_price").parents("td").children("span").text("");
            }
            //var warehouseid = $('#warehouse_id').val();
            getShipments();
        }).change();		

      $("#province_id").change(function(){           
           
            var provinceID = $(this).val();
			
            var html = '<option value="">-Select-</option>';
            if(!provinceID){                
                return;
            }      
			$.ajax({url: '/merchant/product/city-input',
					type: 'POST',
					data:{province_id:provinceID},
					dataType: 'json',
					success:function(data){						
						$(data).each(function(k,row){
							html += '<option value="'+row.region_id+'">'+ row.region_name+'</option>';
						
						});//data.each
						$("#city_id").html(html);
					}
					
			});
					   
            
        });
        //产品选择

        $('#dialog').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 850,
			height:500,
            resizable: true
        });

        //产品浏览
        $('#dialog_link').click(function(){
            //$('#dialog').html();
            $('#dialog').dialog('open');
            return false;
        });
		
        $('#XLSInputBox').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 700,
			height:500,
            resizable: true,
			close:function(){				
				reseterrorrow();
			},buttons:{
				'关闭': function() {
						$('#XLSInputBox').dialog('close');
				},'确定': function() {
					do_import_action();
				}		
			}/*buttons*/
        });		
		
		
    });
    $(function(){
        getProductListBoxData('order');
    });
	
	
function selectwarehouse(){
<?php if (!isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?>
    if($('#warehouse_id').val()!=''){
        $('.tableborder').show()
        $('#dialog_link').show();	
		$('#xls_input_link').show();	
        $('.pageFormContent tr').show();		
        $('.jiahuowarehouse').show();
		$('.jiahuowarehouse1').show();
    }else{
        $('.tableborder').hide()
        $('#dialog_link').hide();
		$('#xls_input_link').hide();
        $('.pageFormContent tr').hide();
        $('.jiahuowarehouse').show();
		$('.jiahuowarehouse1').hide();
    }
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['haveconta']=='1')){?>
    //$('[name=haveconta][value=1]').attr('checked',true);
<?php }else{ ?>
   // $('[name=haveconta][value=0]').attr('checked',true);
   // $('.haveconta').hide();
<?php }?>
}


/*导入动作*/
function do_import_action(){
						
				if($("input[name='XMLForInput']").val()==''){alert("请选择文件");return;}
				$('#XLSInputForm').ajaxSubmit({					
					dataType:'json',
					success:function(data){												
						if(data.ask==1){							
							 $(data.data).each(function(k,row){
							 		insertProductRow(row.product_id,row.product_sku,row.product_title,row.pc_name,row.product_weight,row.product_number);
							 });	
							 reseterrorrow();
							 $(data.errordata).each(function(k,row){
							 		
							 		inserterror(row.product_sku,row.error);
									
									//insertProductRow(row.product_sku,row.product_title,row.pc_name,row.product_weight,row.product_number);
							 });						 
							 //countWeight();
							if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}	
       						if(typeof(countWeight)!='undefined'){countWeight();}
							if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}							 				
						}else if(data.ask==0){
							alert(data.message);
						}else{
							alert("文件格式错误或文件内容格式错误");
						}
						$('#XLSInputForm').resetForm();
						
					}
				});//	$('#XLSInputForm')
					
			
}


$(function(){
        $('#xls_input_link').click(function(){
		
            //$('#dialog').html();
            $('#XLSInputBox').dialog('open');
				
            return false;
        });			
    
});

 
 $(function(){
			$('#order_mode_title').html('-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');			
			$('.tip').poshytip({className: 'tip-yellowsimple',
			showOn: 'focus',
			alignTo: 'target',
			alignX: 'right',
			alignY: 'center',
			offsetX: 5});		
		
 });
//插入产品
function insertProductRow(productId,productSku,productName,category,productWeight,product_number){
          	product_number = product_number|| 1;
            if($("#orderproduct"+productId).size()==0){
                    if ($("#orderproduct" + productId).size() == 0) {
                        var html = '';
                        html += '<tr id="orderproduct' + productId + '" class="product_sku">';
                        html += '<td><a href="/merchant/product/detail/productId/'+productId+'" target="_blank">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                        html += '<td title="'+productName+'">' + productName + '</td>';
                        html += '<td>' + category + '</td>';
						var total = Math.round(product_number*productWeight*1000)/1000
                        html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" value="'+product_number+'" size="6" onkeyup="changeWeight('+productId+','+productWeight+',this.value)"><span class="red">*</span></td>';
                        html += '<td id="sku'+productId+'">'+total+'</td>';
                        html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                        html += '</tr>';
						
                        $("#orderproducts").append(html);
                    }
            }

}	


function inserterror(product_sku,error_info){

          	 var info = info|| '';                 
             var html = '';
             html += '<tr  class="product_sku">';
			 html += '<td>'+product_sku+'</td>';                           
             html += '<td>'+error_info+'</td>';                       
             html += '</tr>';
             $("#orderproductserror").append(html); 

}

function reseterrorrow(){

	$("#orderproductserror").empty(); 

}

       function getShipments(){
			var sm_code = '';
        	<?php if (!empty($_smarty_tpl->tpl_vars['orderInfo']->value)){?>
			sm_code =  '<?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['sm_code'];?>
';
			<?php }?>	   
            var html ='';
			$.ajax({url: '/merchant/Order/get-shipments',
					type: 'POST',
					data:{warehouse_id:$('#warehouse_id').val()},
					dataType: 'json',
					success:function(data){	
						if(data.data){
                             $(data.data).each(function(k,row){
                                    if(sm_code!='' && sm_code == row.sm_code){
                                        html += '<option  selected="selected" value="'+row.sm_code+'">'+ row.sm_code+'</option>';
                                        }else{
                                        html += '<option value="'+row.sm_code+'">'+ row.sm_code+'</option>';
                                    }
                              
                            });//data.each
                            $("#shipping_method").html(html);
                        }
					}
			});
        }
$(function(){
	countWeight();
}); 		
$(document).ready(function(){
	<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?>
	if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
	<?php }?>
	$('input[type=text]').placeholder();
});
</script><?php }} ?>