<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 19:16:58
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/order/jihuo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:108525551953b3ea2ae8aa79-73949718%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad5ab8a4bb7468df8de997460bc1d62897e1114b' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/order/jihuo.tpl',
      1 => 1399859846,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108525551953b3ea2ae8aa79-73949718',
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
    'targetListWarehouse' => 0,
    'province_array' => 0,
    'city_array' => 0,
    'shipments' => 0,
    'st' => 0,
    'wrapTypes' => 0,
    'wrapType' => 0,
    'currencyAll' => 0,
    'currency' => 0,
    'IdType' => 0,
    'k' => 0,
    'type' => 0,
    'receiving' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3ea2b2d7293_09846217',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3ea2b2d7293_09846217')) {function content_53b3ea2b2d7293_09846217($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style>
.width180{width:180;}
form span{color:red;}
</style>
<!--集货模式模板-->
<a href="#" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductInfo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" id="dialog_link" class="ui-state-default  ui-corner-all nowarp" style="float:left;display:block;padding:10px;margin-bottom:5px;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 </a><span class="jiahuowarehouse1" style="margin-left:5px;margin-top:12px;display:block;float:left;color:red; font-size:1.1em">*</span>
<a href="#" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductImport<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" id="xls_input_link" class="ui-state-default  ui-corner-all nowarp" style="float:left;display:block;padding:10px; margin-left:5px;margin-bottom:5px;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductImport<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
<div class="clear"></div>


<form action="/merchant/order/createjh" method='POST' id='orderForm' class="pageForm required-validate">
<fieldset>
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
            <?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['order_product']){?> <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
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
                    <td></td>-->
            		<td colspan="3"></td>
            	</tr>
            </tbody>
        </table>
        <div class="clear"></div>
    </div>

    <input type="hidden" name="ordersCode" value="<?php echo $_smarty_tpl->tpl_vars['ordersCode']->value;?>
" />
	<input type="hidden" value='1' name="ordermodel" />
    <table class="pageFormContent">
        <tbody>       
        <!--
		<tr>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
WhetherChangeSingle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <td><input type="radio" value='0' name="change_single" checked><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
No<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <input type="radio" value='1' name="change_single"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Is<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
        </tr>
		!-->
        <tr class="jiahuowarehouse">
            <td style="text-align:right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ShippingWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td  width='245'>
			
			<select name="warehouse_id" id='warehouse_id' class="text-input width155">
                <option value="">-Select-</option>
                <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
                <option isfirst="<?php echo $_smarty_tpl->tpl_vars['w']->value['is_first'];?>
"  value='<?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['warehouse_id']==$_smarty_tpl->tpl_vars['w']->value['warehouse_id']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_name'];?>
</option>
                <?php } ?>
            </select> 
            <span>*</span>
			<a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_select_the_order_to_delivery_warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a> <span id="tipwarehouse" class='red'><!--* &nbsp;&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
--></span>
			</td>
            
       
		
        
                <td style="text-align:right"><p class="TargetwarehouseBox" style="display:none"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Targetwarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</p></td>
                <td>
				<span class="TargetwarehouseBox" style="display:none">
				<select name="to_warehouse_id" id='to_warehouse_id' class="text-input width155">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['targetListWarehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?> <option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['to_warehouse_id']==$_smarty_tpl->tpl_vars['w']->value['warehouse_id']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_name'];?>

                        </option>
                        <?php } ?>
                </select></span>
                        <span class="TargetwarehouseBox" style="display:none">*</span></td>
                
        </tr>	
        </tbody>
        <tbody class='not_home_delivery'>
        <tr>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
           
       
		
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
			<span class='red'></span>
            </td>
           
        </tr>		
		
        </tbody>

        <tbody class='not_home_delivery'>
        <tr>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><select name="shipping_method" class="text-input width155" id='shipping_method' default='<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['sm_code'];?>
<?php }?>'>
                <option value="">-Select-</option>
               
							<?php  $_smarty_tpl->tpl_vars['st'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['st']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shipments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['st']->key => $_smarty_tpl->tpl_vars['st']->value){
$_smarty_tpl->tpl_vars['st']->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['st']->value=="CNAM"||$_smarty_tpl->tpl_vars['st']->value=="CNEMS"||$_smarty_tpl->tpl_vars['st']->value=="NEUB"||$_smarty_tpl->tpl_vars['st']->value=="SF"||$_smarty_tpl->tpl_vars['st']->value=="YT"){?>
							<option value='<?php echo $_smarty_tpl->tpl_vars['st']->value['sm_code'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['sm_code']==$_smarty_tpl->tpl_vars['st']->value['sm_code']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['st']->value['sm_code'];?>
</option>
                    <?php }?>
							<?php } ?>
							
            </select> 
            <span>*</span><span class='red'></span></td>
  			<td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input  type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['reference_no'];?>
<?php }?>"
                        placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_input_the_sales_site_Trading_Order_No<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" name="reference_no" id="reference_no" class="text-input width140 valid">
						 <span> *</span> <a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer_reference_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
.)" onclick="return false;"><img src="/images/help.png"></a>
			</td>
        </tr>
       <tr>
            <!--<td style="text-align:right">收件人<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lastName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input class="text-input width180" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_lastname'];?>
<?php }?>" name="oab_lastname"><span> *</span><span class='red'></span></td>-->
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lastName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
firstName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input class="text-input width140" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_firstname'];?>
<?php }?>" name="oab_firstname">
            <span> *</span><span class='red'></span>
            </td>            
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
<?php }?>" name="oab_street_address1">
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
<?php }?>" name="oab_phone"/><span> *</span><span class='red'></span></td>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
email<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
            <td><input  class="text-input width140" type="text" size="40" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_email'];?>
<?php }?>" name="oab_email"/><span class='red'></span></td>
        </tr>
       <!--
        <tr>
            <th>包装种类</th>
            <td>
            <select name='wrap_type' class="required width195" >
                <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
                <?php  $_smarty_tpl->tpl_vars['wrapType'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wrapType']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wrapTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wrapType']->key => $_smarty_tpl->tpl_vars['wrapType']->value){
$_smarty_tpl->tpl_vars['wrapType']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['wrapType']->value['wrap_type'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&($_smarty_tpl->tpl_vars['orderInfo']->value['wrap_type']==$_smarty_tpl->tpl_vars['wrapType']->value['wrap_type'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['wrapType']->value['wrap_type_name'];?>
</option>
                <?php } ?>
            </select>        </tr>
		-->	
        <tr>
		
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_gross_weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td ><input class="text-input width140"  placeholder="0.00" type="text" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['grossWt']!=0){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['grossWt'];?>
<?php }?>" name="grossWt"> KG<span class='red'></span></td>
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
                </select>
            </td>
        </tr>
		
        <!--<tr>
            <td style="text-align:right">币种：</td>
            <td>
                <select name='currency_code' class="width195">
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
                </select>
            </td>     
            <td style="text-align:right">订单成交总价：</td>
            <td><input class="text-input width180" placeholder="0.00"  type="text" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['charge'];?>
<?php }?>" name="charge">
            <span> *</span>
			 <a href="#"  class="tip" title="(请填写网站订单成交的总价)" onclick="return false;"><img src="/images/help.png"></a><span class='red'></span>
			</td>
			
        </tr>-->
        <!--<tr>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
discount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td>
                <select name="is_discount" id='is_discount' class="text-input width195">
                    <option value="0" <?php if ($_smarty_tpl->tpl_vars['orderInfo']->value['is_discount']=='0'){?>selected<?php }?> >无</option>
                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['orderInfo']->value['is_discount']=='1'){?>selected<?php }?> >有</option>
                </select>
                <span>* </span><span class='red'></span>
                <a href="#"  class="tip" title="(如果有请在备注中注明相应SKU)" onclick="return false;"><img src="/images/help.png"></a>
            </td>
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
is_promotional_item<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td>
                <select name="is_gift" id='is_gift' class="text-input width195">
                    <option value="0" <?php if ($_smarty_tpl->tpl_vars['orderInfo']->value['is_gift']=='0'){?>selected<?php }?> >否</option>
                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['orderInfo']->value['is_gift']=='1'){?>selected<?php }?> >是</option>
                </select>
                <span>* </span><span class='red'></span>
                <a href="#"  class="tip" title="(如果有请在备注中注明相应SKU)" onclick="return false;"><img src="/images/help.png"></a>
            </td>
        </tr>-->
	
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
				<strong style=" visibility:hidden;">*</strong>  
				<a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
type_of_certificate_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>
				 </td>
				
				   
            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
IdentificationNumbers<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td><input class="text-input width140" type="text" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['idNumber'];?>
<?php }?>" name="idNumber"> 
            <span></span>
			<strong id="idNumberStrong" style=" visibility:hidden;">*</strong>
			<a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
identification_numbers_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>
			</td>		
        </tr>
	
        </tbody>
        <tbody>
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
</fieldset>
</form>
<script type="text/javascript">

	
    $(function(){
        $(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});
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
            $('[name=ordermodel]').val($(this).attr('model'))
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
            if($('#warehouse_id').val()!=''){
                $('#tipwarehouse').hide();
				var is_first= $('#warehouse_id').find('option:selected').attr('isfirst');  //交货仓库是否是头程仓
				if(is_first==1){
					$('.TargetwarehouseBox').show();
				}else{					
					$('.TargetwarehouseBox').hide();
					$('#to_warehouse_id').val('');
				}//if(is_first==1){
				//$('#TargetwarehouseBox').show();
				//$('#to_warehouse_id').val(''); //目的仓库变为默认
				
            }else{
				$('#tipwarehouse').show();
			}
            var warehouseId = $('#warehouse_id').val();
            var targetWarehouse= $('#to_warehouse_id').val();
            var obj = document.getElementById("idNumberStrong");
            if(warehouseId==3){
                obj.style.visibility='hidden';
                $(".price").parents("td").children("span").text("*");
                $(".total_price").parents("td").children("span").text("*");
            }else{

                $(".price").parents("td").children("span").text("");
                $(".total_price").parents("td").children("span").text("");

                if(warehouseId==1){
                    if(targetWarehouse!=3){
                        //obj.style.visibility='visible';
                        $(".price").parents("td").children("span").text("");
                        $(".total_price").parents("td").children("span").text("");
                    }else{
                        obj.style.visibility='hidden';
                        $(".price").parents("td").children("span").text("*");
                        $(".total_price").parents("td").children("span").text("*");
                    }
                }else if(warehouseId==2){
                    //obj.style.visibility='visible';
                }
            }
            getShipments();
        }).change();
		
		$('#to_warehouse_id').change(function(){		
			
				var shippingWarehouse= $('#warehouse_id').val();
				var targetWarehouse= $('#to_warehouse_id').val();
				if(shippingWarehouse == targetWarehouse && shippingWarehouse>0 && targetWarehouse>0){
					alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
WarehouseIsEquil<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');				
				}
                var warehouseId = $('#warehouse_id').val();
                var targetWarehouse= $('#to_warehouse_id').val();
                var obj = document.getElementById("idNumberStrong");
                if(warehouseId==3){
                    obj.style.visibility='hidden';
                    $(".price").parents("td").children("span").text("*");
                    $(".total_price").parents("td").children("span").text("*");
                }else{
                    if(warehouseId==1){
                        if(targetWarehouse!=3){
                            //obj.style.visibility='visible';
                            $(".price").parents("td").children("span").text("");
                            $(".total_price").parents("td").children("span").text("");
                        }else{
                            obj.style.visibility='hidden';
                            $(".price").parents("td").children("span").text("*");
                            $(".total_price").parents("td").children("span").text("*");
                        }
                    }else{
                        //obj.style.visibility='visible';
                    }
                }
            getShipments();
		});
		
		/*
        $("#country_id").change(function(){
            //alert(countryJs[2]['ship_type'][0]['st_code']);
            var wId=$("#warehouse_id").val();
            var countryId = $(this).val()+"";
            var html = '<option value="">-Select-</option>';
            if(!countryId){
                $("#shipping_method").html(html);
                return;
            }
            if(wId==''&&$(this).val()!=''){
                $(this).val('');
                //alertTip('Pls Select Warehouse First!');
                alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                return false;
            }
            html = '<option value="">-Select-</option>';
            countryId = parseInt(countryId);
            var shipTypes = countryJs[countryId]['ship_type'];

            var default_ = $("#shipping_method").attr('default');
            $.each(shipTypes,function(k,v){
                if(wId== v.warehouse_id || v.warehouse_id=='0' ){
                    var select = default_==v.sm_code?'selected':'';
                    html+='<option value="'+v.sm_code+'" '+select+'>'+v.sm_code+'</option>';
                }
            })
            $("#shipping_method").html(html);
        }).change();
        //产品选择
		*/
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
        
			

        $('#XLSInputBox').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 900,
			height:500,
            resizable: true,
			close:function(){
				reseterrorrow();
			},buttons:{
				'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
						$('#XLSInputBox').dialog('close');
				},'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
					do_import_action();
				}		
			}/*buttons*/
			
        });
		
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
		
	
		//导入XML
        $('#xls_input_link').click(function(){
            //$('#dialog').html();	
			//$('#xls_input_link').unbind('click');		
            $('#XLSInputBox').dialog('open');
	
            return false;
        });		
		
    });
    $(function(){
        getProductListBoxData('order');
    });
	

/*导入动作*/
function do_import_action(){	
				
				if($("input[name='XMLForInput']").val()==''){alert("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
.");return;}
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
							alert("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
file_format_error_or_file_content_is_wrong<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");
						}
						$('#XLSInputForm').resetForm();
						
					}
				});//	$('#XLSInputForm')
					
			
}				
	
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
                        html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" value="'+product_number+'" size="6" onkeyup="changeWeight('+productId+','+productWeight+',this.value)">&nbsp;<strong>*</strong></td>';
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
		var warehouse_id = $('#warehouse_id').val();
        if(warehouse_id=='1'){
            if($('#to_warehouse_id').val()!=''){
                warehouse_id = $('#to_warehouse_id').val();
            }
        }
		var html ='';
        $.ajax({url: '/merchant/Order/get-shipments',
        type: 'POST',
        data:{warehouse_id:warehouse_id},
        dataType: 'json',
        success:function(data){
            if(data.data){
            $(data.data).each(function(k,row){
                    if(sm_code!='' && sm_code == row.sm_code)
                    {
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


function selectwarehouse(){
<?php if (!isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?>
    if($('#warehouse_id').val()!=''){
        $('.tableborder').show()
        $('#dialog_link').show();		
        $('.pageFormContent tr').show();		
        $('.jiahuowarehouse').show();
		$('#xls_input_link').show();
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

 $(function(){
		$('#order_mode_title').html('-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectingMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
			
			$('.tip').poshytip({className: 'tip-yellowsimple',
			showOn: 'focus',
			alignTo: 'target',
			alignX: 'right',
			alignY: 'center',
			offsetX: 5});
		
 });
 
$(function(){
	<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?>
	if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
	<?php }?>
	if(typeof(countWeight)!='undefined'){countWeight();}
	$('input[type=text]').placeholder();
}); 	
</script><?php }} ?>