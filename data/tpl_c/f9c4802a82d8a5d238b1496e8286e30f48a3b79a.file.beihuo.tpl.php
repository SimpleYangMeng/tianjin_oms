<?php /* Smarty version Smarty-3.1.13, created on 2015-11-13 15:10:38
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\order\beihuo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2389856458cee5ae452-30187015%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9c4802a82d8a5d238b1496e8286e30f48a3b79a' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\order\\beihuo.tpl',
      1 => 1446280044,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2389856458cee5ae452-30187015',
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
    'country' => 0,
    'c' => 0,
    'currencyAll' => 0,
    'currency' => 0,
    'IdType' => 0,
    'k' => 0,
    'type' => 0,
    'receiving' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56458cee8c59d9_80713145',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56458cee8c59d9_80713145')) {function content_56458cee8c59d9_80713145($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
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
                <td><a onclick="window.parent.openMenuTab('merchant/product/detail/productId/<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
','产品详情','product-detail');return false;"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_sku'];?>
</a></td>
                <td><?php echo $_smarty_tpl->tpl_vars['product']->value['product_title'];?>
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
" size="6" disabled="disabled"><span class="red"></span></td>
                <td><a title="delete" href="javascript:;" class="productDel"><img
                        src="/images/icon_del.gif"></a></td>
            </tr>
            <?php } ?> <?php }?>
			
            	<tr class="norowdata">
            		<td colspan="7" style="text-align:center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
            		<td colspan="2"></td>
            	</tr>
            </tbody>
			
			
        </table>
        <div class="clear"></div>
    </div>
	<input type="hidden" value='0' name="ordermodel"/>
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
Please_select_the_warehousing_logistics_enterprises<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a>
			 <span id="tipwarehouse" class='red'><!--&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
!--></span>			 </td>
        </tr>
        </tbody>
        <tbody class='not_home_delivery'>

        <tr>
            <td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReciveCountry<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td  class="form_input"><select name="country_id" id='country_id' class="text-input width155">
                <!--  --><option value="">-Select-</option>
                <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['oab_country_id']==$_smarty_tpl->tpl_vars['c']->value['country_id']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
                <?php } ?>
            </select>&nbsp;<strong>*</strong><span class='red'></span></td>
            <td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td>
                <div class="notcn">
                    <input name="province_id" id='province_id' class="text-input width140" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_state'];?>
<?php }?>" >
                    <span> *</span>
                </div>
        </tr>

       <tr>

                  
            <td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
city<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td>
                <div class="notcn">
                    <input  name="city_id" id='city_id' class="text-input width140" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_city'];?>
<?php }?>" >
                </div>

            <span></span><span class='red'></span></td>
            <td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
区（县）：</td>
            <td>
                <div class="notcn">
                    <input  name="district_id" id='district_id' class="text-input width140" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['oab_district'];?>
<?php }?>" >
                </div>

            <span></span><span class='red'></span></td>
        </tr>
        <tr> 
           <td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
           <td>
           <select name="shipping_method" class="text-input width155" id='shipping_method' default='<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['sm_code'];?>
<?php }?>'>
                <option value="">-Select-</option>
           </select>
           <span>*</span>
           </td>
        </tr>	
        </tbody>

        <tbody class='not_home_delivery'>
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
		<!--增加支付单号(走前海需要)-->
        <tr class="pay_no">
            <td style="text-align:right;">支付单号：</td>
            <td><input name='pay_no' class="text-input width140" value="<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['pay_no'];?>
<?php }?>"><span id="payTip"> *</span></td>
            <td></td>
            <td></td>
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
            var productWeight = $(this).attr("productWeight");
            if ($(this).is(':checked')){;
                if ($("#orderproduct" + productId).size() == 0) {
                    var html = '';
                    html += '<tr id="orderproduct' + productId + '" class="product_sku">';
                    html += '<td><a onclick="window.parent.openMenuTab(\'merchant/product/detail/productId/' + productId + '\',\'产品详情\',\'product-detail\');return false;">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                    html += '<td title="'+productName+'">' + productName + '</td>';
                    html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" value="1" size="6"><span class="red">*</span></td>';
                    html += '<td>'+productWeight+'</td>';
                    html += '<td><input type="text" class="inputbox inputMinbox price" name="price[">'+productId+']" size="6"><span class="red">*</span> </td>';
                    html += '<td><input type="text" class="inputbox inputMinbox total_price" name="total_price[">'+productId+']" size="6"><span class="red">*</span> </td>';
                    html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                    html += '</tr>';
                    $("#orderproducts").append(html);
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
            /*
            // 都必填，无需这样子做了，注释
            if(warehouseId==3||warehouseId==6||warehouseId==2){
                var obj = document.getElementById("bhidNumberStrong");
                obj.style.visibility='hidden';
                $(".price").parents("td").children("span").text("*");
                $(".total_price").parents("td").children("span").text("*");
            }else{
                var obj = document.getElementById("bhidNumberStrong");
                //obj.style.visibility='visible';
                $(".price").parents("td").children("span").text("");
                $(".total_price").parents("td").children("span").text("");
            }*/
            //var warehouseid = $('#warehouse_id').val();
            getShipments();
        }).change();
        
        
       $("#country_id").change(function (e) {
         getShipments();
       });
       /* $("#country_id").change(function(){
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
                    html+='<option value="'+v.sm_code+'" '+select+'>'+v.sm_code+'&nbsp;&nbsp;'+ v.sm_name_cn+'</option>';
                }
            })
            $("#shipping_method").html(html);
        }).change();*/

     /* $("#province_id").change(function(){
           
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
					   
            
        });*/
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
    //省份
    //auto complete
    $("#province_id").autocomplete({
        minLength: 0,
        source: function(request, response) {
            var term = request.term;
            if(term) {
                term = term.toUpperCase();
                $("#province_id").val(term);
            }
            $.post('/merchant/order/province', {'country_id':$('#country_id').val(),'term':term},function(data){
                response(data);
        }, 'json');
    }
    }).focus(function() {
        $('#province_id').autocomplete("search", "");
    });

    $("#city_id").autocomplete({
        minLength: 0,
        source: function(request, response) {
            var term = request.term;
            if(term) {
                term = term.toUpperCase();
                $("#city_id").val(term);
            }
            $.post('/merchant/order/city', {'country_id':$('#country_id').val(),'province_id':$("#province_id").val(),'term':term},function(data){
                response(data);
        }, 'json');
    }
    }).focus(function() {
        $('#city_id').autocomplete("search", "");
    });
    $("#district_id").autocomplete({
        minLength: 0,
        source: function(request, response) {
            var term = request.term;
            if(term) {
                term = term.toUpperCase();
                $("#district_id").val(term);
            }
            $.post('/merchant/order/district', {'country_id':$('#country_id').val(),'city_id':$("#city_id").val(),'term':term},function(data){
                response(data);
        }, 'json');
    }
    }).focus(function() {
        $('#district_id').autocomplete("search", "");
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
    if($('#warehouse_id').val()!='2'){
        $("#country_id").val('49');
    }else{
        $("#country_id").val('');
    }
    if($('#warehouse_id').val()=='6'){
        $('#payTip').html(' *');
    }else{
        $('#payTip').html('');
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
							 		insertProductRow(row.product_id,row.product_sku,row.product_title,row.product_weight,row.product_number);
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
function insertProductRow(productId,productSku,productName,productWeight,product_number){
          	product_number = product_number|| 1;
            if ($("#orderproduct" + productId).size() == 0) {
                        var html = '';
                        html += '<tr id="orderproduct' + productId + '" class="product_sku">';
                        html += '<td><a onclick="window.parent.openMenuTab(\'merchant/product/detail/productId/' + productId + '\',\'产品详情\',\'product-detail\');return false;">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                        html += '<td title="'+productName+'">' + productName + '</td>';
						var total = Math.round(product_number*productWeight*1000)/1000
                        html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" value="'+product_number+'" size="6" onkeyup="changeWeight('+productId+','+productWeight+',this.value)"><span class="red">*</span></td>';
                        html += '<td id="sku'+productId+'">'+total+'</td>';
                        html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                        html += '</tr>';
						
                        $("#orderproducts").append(html);
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
					data:{warehouse_id:$('#warehouse_id').val(),country_id:$('#country_id').val()},
					dataType: 'json',
                    async:false,
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
            $("#shipping_method").html('<option value="STO">申通快递 STO</option>');
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
</script>
<?php }} ?>