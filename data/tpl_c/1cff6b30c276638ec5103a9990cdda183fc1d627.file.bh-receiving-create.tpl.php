<?php /* Smarty version Smarty-3.1.13, created on 2014-07-04 09:02:46
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/receiving/bh-receiving-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:43131444653b5fd363850e6-57416927%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cff6b30c276638ec5103a9990cdda183fc1d627' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/receiving/bh-receiving-create.tpl',
      1 => 1400727191,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '43131444653b5fd363850e6-57416927',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'actions' => 0,
    'receiving_code' => 0,
    'receivingDetail' => 0,
    'detail' => 0,
    'warehouseArr' => 0,
    'k' => 0,
    'receiving' => 0,
    'wh' => 0,
    'warehousemdAll' => 0,
    'mdc' => 0,
    'formtypes' => 0,
    'formtype' => 0,
    'wrapTypes' => 0,
    'wrapType' => 0,
    'trafModes' => 0,
    'trafMode' => 0,
    'tradeModes' => 0,
    'tradeMode' => 0,
    'transModes' => 0,
    'transMode' => 0,
    'actionLabel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b5fd3663a388_24624858',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b5fd3663a388_24624858')) {function content_53b5fd3663a388_24624858($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style type="text/css">
    .box td{
        text-align: left;
    }
    #ASNForm tbody th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;

    }
    #ASNForm tbody td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    *#ASNForm tbody span.error{
        top:auto;
    }
    span.error{
        top:auto;
    }
    a.dialog_link {
        margin-bottom: 5px;
        margin-top: 5px;
        padding: 10px;
        text-align: center;
       
        float:left;
    }
    .asndetailstrong {
        color: #FF0000;
        display: block;
        float: left;
        margin-right: 20px;
        margin-top: 15px;
    }
    #subProducts .textInput{
        float:none;;
    }
</style>

<div class="content-box-header">
    <h3 style="margin-left:5px"><?php echo $_smarty_tpl->tpl_vars['actions']->value;?>
-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
    <div class="clear"></div>
</div>

<div class="asndetail">
 <table  style="width:200px"> 
	<tr>
	<td>
	<a href="#" id="dialog_link" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductInfo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" class="dialog_link ui-state-default  ui-corner-all nowrap" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
   
	</td>
	<td><span style="font-size:1.1em;color:red">*</span></td>
	<td>
	<a href="#" id="selectasndetail" class="dialog_link ui-state-default  ui-corner-all nowrap" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BulkUploadProducts<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
	</td>
	</tr>
</table>

</div>

<form   action="/merchant/receiving/create" method="post"  id='ASNForm' name="createForm" >
    <div id="create-asn-center" >

        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th width='100'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<input type="hidden" name="ASNCode" value="<?php echo $_smarty_tpl->tpl_vars['receiving_code']->value;?>
"  /></th>
                <th width='200'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th width='180'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductCategory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            </tr>
            </thead>
            <tbody id='asnproducts'>
            <?php if ($_smarty_tpl->tpl_vars['receivingDetail']->value!=''){?>
            <?php  $_smarty_tpl->tpl_vars["detail"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["detail"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['receivingDetail']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["detail"]->key => $_smarty_tpl->tpl_vars["detail"]->value){
$_smarty_tpl->tpl_vars["detail"]->_loop = true;
?>
                <tr  id="asnproduct<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
" class="product_sku">
                    <td><a href="/merchant/product/detail/productId/<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
"  onclick="parent.openMenuTab('/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_sku'];?>
)','productdetail<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
');return false;" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['detail']->value['product_sku'];?>
</a><input type="hidden" name="product_sku[<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_sku'];?>
"></td>
                    <td title="<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_title'];?>
"><?php echo $_smarty_tpl->tpl_vars['detail']->value['product_title'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['detail']->value['category_name'];?>
</td>
                   
					<td><input type="text" class="inputbox inputMinbox" name="sku[<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['rd_receiving_qty'];?>
" size="6"  onkeyup="changeWeight(<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
,<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_weight'];?>
,this.value)" >&nbsp;<strong>*</strong></td>
					<td id="psku<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['detail']->value['product_weight']*$_smarty_tpl->tpl_vars['detail']->value['rd_receiving_qty'];?>
</td>
                    <td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>
                </tr>
                <?php } ?>
            <?php }?>
            	<tr class="norowdata">
            		<td colspan="6" style="text-align:center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
            			<td></td>
            			</tr>
              </tbody>	
			
        </table>
        <div class="clear"></div>
        <input type="hidden" name="ASNCode" value="<?php echo $_smarty_tpl->tpl_vars['receiving_code']->value;?>
" />
        <table class="pageFormContent">
            <tbody>
            <tr class="jiahuowarehouse">
                <td  class="nowarp text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shipping<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="hidden" name="receive_model_type" value="0"></td>
                <td><select name="warehouseId" class="required width155" id="warehouseId">
                    <option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['wh'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wh']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehouseArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wh']->key => $_smarty_tpl->tpl_vars['wh']->value){
$_smarty_tpl->tpl_vars['wh']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['wh']->key;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['warehouse_id']==$_smarty_tpl->tpl_vars['wh']->value['warehouse_id'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['wh']->value['warehouse_name'];?>
</option> <?php } ?>
                </select>&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"  class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_select_the_asn_to_delivery_warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a></td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['to_warehouse_id']>0)){?>
            <tr class="aimwarehouses">
                <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ObjectiveWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td >
                <td>
                    <select name='to_warehouse' class="width155">
                        <option value=''>-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['mdc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mdc']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehousemdAll']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mdc']->key => $_smarty_tpl->tpl_vars['mdc']->value){
$_smarty_tpl->tpl_vars['mdc']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['mdc']->key;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['mdc']->value['warehouse_id'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['to_warehouse_id']==$_smarty_tpl->tpl_vars['mdc']->value['warehouse_id'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['mdc']->value['warehouse_name'];?>
</option>
                        <?php } ?>
                </select></td>
            </tr>
            <?php }?>
            <tr class="ReferenceCode">
                <td   class="nowarp text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><input type="text" size="60" class="text-input width155 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['reference_no']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['reference_no'];?>
<?php }?>" name="ref_code" id="ref_code">&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"  class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
asn_reference_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a></td>
            </tr>

    <tr>
      <td class="nowrap text_right">总件数：</td>
      <td>
        <input type="text" class="text-input width155" name="pack_no" id="pack_no" value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['pack_no']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['pack_no'];?>
<?php }?>" />&nbsp;<strong class="red">*</strong>
        &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="tip" title="请填写ASN总件数" onclick="return false;"><img src="/images/help.png" /></a>
      </td>
    </tr>

            <!--<tr>
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BusinessType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                <td>
                    <select name="form_type" class="required width155">
                        <?php  $_smarty_tpl->tpl_vars['formtype'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['formtype']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['formtypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['formtype']->key => $_smarty_tpl->tpl_vars['formtype']->value){
$_smarty_tpl->tpl_vars['formtype']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['formtype']->value['form_type'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['form_type']==$_smarty_tpl->tpl_vars['formtype']->value['form_type'])){?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['formtype']->value['form_type_name'];?>
</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>-->
            <!--<tr id="avinumber">
                <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AviationSingleNumber<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td>
                    <input type="text" size="60" class="text-input width155" value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['traf_name']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['traf_name'];?>
<?php }?>" name="traf_name" >&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(请填入ASN出运后对应的航空提单)
                </td>
            </tr>-->
            <!--<tr>
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PackingType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                <td>
                    <select name='wrap_type' class="required width155">
                        <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
                        <?php  $_smarty_tpl->tpl_vars['wrapType'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wrapType']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wrapTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wrapType']->key => $_smarty_tpl->tpl_vars['wrapType']->value){
$_smarty_tpl->tpl_vars['wrapType']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['wrapType']->value['wrap_type'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['wrap_type']==$_smarty_tpl->tpl_vars['wrapType']->value['wrap_type'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['wrapType']->value['wrap_type_name'];?>
</option>
                        <?php } ?>
                    </select><strong class="red">*</strong>
                </td>
            </tr>-->
            <!--<tr>
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
TotalNumber<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                <td><input type="text" size="60" class="text-input width155 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['pack_no']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['pack_no'];?>
<?php }?>" name="pack_no" ><strong class="red">*</strong></td>
            </tr>-->
            <!--<tr>
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AccessPortTransport<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                <td>
                    <select name='traf_mode' class="required width155">
                        <?php  $_smarty_tpl->tpl_vars['trafMode'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['trafMode']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['trafModes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['trafMode']->key => $_smarty_tpl->tpl_vars['trafMode']->value){
$_smarty_tpl->tpl_vars['trafMode']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['trafMode']->value['traf_mode'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['traf_mode']==$_smarty_tpl->tpl_vars['trafMode']->value['traf_mode'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['trafMode']->value['traf_mode_name'];?>
</option>
                        <?php } ?>
                    </select>
            </tr>-->
            <!--<tr>
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
RegulatoryApproach<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                <td>
                    <select name="trade_mode" class="required width155">
                        <?php  $_smarty_tpl->tpl_vars['tradeMode'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tradeMode']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tradeModes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tradeMode']->key => $_smarty_tpl->tpl_vars['tradeMode']->value){
$_smarty_tpl->tpl_vars['tradeMode']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['tradeMode']->value['trade_mode'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['trade_mode']==$_smarty_tpl->tpl_vars['tradeMode']->value['trade_mode'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['tradeMode']->value['trade_mode_name'];?>
</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>-->
            <!--<tr>
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
TransactionMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                <td>
                    <select name="trans_mode" class="required width155">
                        <?php  $_smarty_tpl->tpl_vars['transMode'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['transMode']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['transModes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['transMode']->key => $_smarty_tpl->tpl_vars['transMode']->value){
$_smarty_tpl->tpl_vars['transMode']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['transMode']->value['trans_mode'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['trans_mode']==$_smarty_tpl->tpl_vars['transMode']->value['trans_mode'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['transMode']->value['trans_mode_name'];?>
</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>-->
            <tr>
                <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
roughweight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><input type="text"  placeholder="0.00" class="text-input width155" name='roughweight' value='<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['roughweight']&&$_smarty_tpl->tpl_vars['receiving']->value['roughweight']!=0){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['roughweight'];?>
<?php }?>'> KG  &nbsp;&nbsp;&nbsp;<p style="display:inline;zoom:1;width:2px"></p><a href="#"  class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_asn_total_weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a></td>
            </tr>
            <!--<tr>
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
HaveContainers<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                <td><input type="radio" value="1" name="haveconta"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Yes<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<input type="radio" value="0" name="haveconta"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
No<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
            </tr>
            <tr class="haveconta">
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ContainerNumber<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['conta_id']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['conta_id'];?>
<?php }?>" name="conta_id">
                </td>
            </tr>
            <tr class="haveconta">
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ContainerSpecificationNo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['conta_model']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['conta_model'];?>
<?php }?>" name="conta_model">
                </td>
            </tr>
            <tr class="haveconta">
                <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ContainerWeight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['conta_wt']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['conta_wt'];?>
<?php }?>" name="conta_wt">
                </td>
            </tr>-->

            <tr >
                <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><textarea rows="5" cols="80" id="instructions" name="instructions"><?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['receiving_description']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['receiving_description'];?>
<?php }?></textarea></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td><a  href="#" class="button tijiao" id='asnbutton'  onclick="dosubmit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                </td>
            </tr>

            </tbody>
        </table>

    </div>

</form>

 <div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
 </div>
<div class="infoTips" id="messageTip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">

</div>
    <div id="asndetailDialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
import_by_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
        <form action="/merchant/product/batch-input" method="post" id="asndetailForm">
            <table>
                <tr><th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                    <td><input type="file" name="XMLForInput" />
                    </td></tr>
                <tr>
                    <th></th>
                    <td>
                        <p><img style="width:25px;" src="/images/download.png"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
download_templete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:<a href="/merchant/product/select-product-templete" style="text-decoration:underline;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_template<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></p>
                        
                    </td>
                </tr>
            </table>

            <table cellspacing="0" cellpadding="0" class="formtable tableborder">
                <thead>
                <tr>
                    <th width='200'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                </tr>
                <!--
                <tr>
                    <td colspan="10"   style="text-align:center"><strong  style="color:red">请选择产品</strong></td>
                </tr>
                -->
                </thead>
                <tbody id='batchAddTips'>

                </tbody>
				
				
				
				
            </table>

            <!--<div id="batchAddTips"></div>-->
        </form>
    </div>


<script type="text/javascript">
	var actionLabel='<?php echo $_smarty_tpl->tpl_vars['actionLabel']->value;?>
';
	
    $(function () {
        var exd=$("[name='expected_date']");
        exd.datepicker({ dateFormat: "yy-mm-dd" });
        exd.datepicker({ constrainInput: true });
		
        $('#asnbutton').die('click').live('click',function(){
            //$('#asnbutton').show();
           // $('#ASNForm').submit();
        });
        //selectModelDialog
        $('#normalasn').show();
        $('#returnasn').hide();
        $('.create-asn-head').show();



        $("[name='shippingMethod']").click(function () {
            if ($(this).val() == 0) {
                $(".trackingNumber").hide();
            } else {
                $(".trackingNumber").show();
            }
        });
        $("[name='ref_code']").blur(function () {
            checkRefCode();
        });

        var asnCode = $("[name='ASNCode']", "#ASNForm").val();
        if (asnCode != '') {
            receivingProduct(asnCode);
        }
    });




	//未选择产品的提示
	function getRipOfNodataRow(){
	 		var dataRows = $("#asnproducts tr:not(.norowdata)").size();
	 		if(dataRows>0){
	   				$('.norowdata').remove();
	 		}else{	 
	 				var html='<tr class="norowdata">\n';
            		html+='<td colspan="6" style="text-align:center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
not_select_product_yet<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</b></td></tr>';
					$("#asnproducts").append(html);		
	 		}
	}//	function getRipOfNodataRow(

	//检查交易订单号
    function checkRefCode() {
        var obj=$("#ref_code");
        var refCode = obj.val();
        if (refCode == '')return true;
        $.ajax({
            type:"POST",
            async:false,
            dataType:"json",
            url:"/merchant/receiving/check-refcode",
            data: {
                'refCode':refCode
            },
            success:function (json) {
                //alertTip('Reference No. existed.');
                if (json.ask == '1') {
                    obj.removeClass('errorbox');
                    obj.parent().find('span').html('<img alt="允许" src="/images/icons/icon_approve.png">');
                    return true;
                } else {
                    //alertTip('POCode existed!');
                    obj.addClass('errorbox');
                    obj.parent().find('span').html('<img alt="错误" src="/images/icons/icon_missing.png"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReferenceNumberExistence<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                    return false;
                }
            }
        });
    }//function checkRefCode() {


	//数量必须为数字
    function chval() {
        var errmsg = "";
        var pattern = /^\d+$/;
        $("input[name^='sku[']","#ASNForm").each(function (k, v) {
            var this_val = $(this).val();
            if (this_val == '' || this_val == '0' || !pattern.test(this_val)) {
                errmsg += '<span style="width:100%;float:left;"><img src=\"/images/no.gif\">Line ' + (k + 1) + ' ,Receive Qty Must be numeric.</span>';
            }
        });

        if (errmsg != '') {
            alertTip(errmsg);
            return false;
        }
        return true;
    }
    function receivingProduct(ASNCode) {
        $.ajax({
            type:"POST",
            async:false,
            dataType:"json",
            url:"/merchant/receiving/receiving-product",
            data:{
                'ASNCode':ASNCode
            },
            success:function (json) {
                var html = '';
                if (json.ask != 1) {
                    html ="<td colspan='5' class=\"center\">&nbsp;No Data !</td>";
                } else {
                    $.each(json.result.products, function (k, item) {
                        html += '<tr id="product' + item.product_id + '" class="product_sku">';
                        html += '<td>' + item.product_sku + '<input type="hidden" name="product_sku[' + item.product_id + ']" value="' + item.product_sku + '"></td>';
                        html += '<td>' + item.product_title + '</td>';
                        html += '<td>' + item.category_name + '</td>';
                        html += '<td><input type="text" name="sku[' + item.product_id + ']" value="'+item.rd_receiving_qty+'" size="6">&nbsp;<strong>*</strong></td>';
  
						html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                        html += '</tr>';
                    });
                    $("[name='warehouseId']").val(json.result.warehouse_id);
                    if (json.result.tracking_number != '') {
                        $("[name='shippingMethod']").each(function () {
                            if ($(this).val() == 1) {
                                $(this).attr("checked", 'checked');
                            } else {
                                $(this).attr("checked", false);
                            }
                        });
                        $(".trackingNumber").show();
                        $("[name='tracking_number']").val(json.result.tracking_number);
                    } else {
                        $(".trackingNumber").hide();
                    }
                    //$(".ReferenceCode").hide();
                    $('[name=expected_date]').val(json.result.expected_date);
                    $('[name=instructions]').val(json.result.receiving_description);
                }
                $("#products").append(html);
				if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
				if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}	
            }
        });
    }

	
	
	
    $(function () {

        //添加产品
        $(".asnactionSku").live("click", function () {
           	 var productId = $(this).attr("productId");
             var productSku = $(this).attr("productSku");
             var productName = $(this).attr("productName");
             var category = $(this).attr("category");
             var productWeight = $(this).attr("productWeight");
        	if ($(this).is(':checked')){
    			if($("#asnproduct"+productId).size()==0){
    				if ($("#asnproduct" + productId).size() == 0) {
    	                var html = '';
    	                html += '<tr id="asnproduct' + productId + '" class="product_sku">';
    	                html += '<td><a href="/merchant/product/detail/productId/'+productId+'" target="_blank">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
    	                html += '<td title="'+productName+'">' + productName + '</td>';
    	                html += '<td>' + category + '</td>';
    	                html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" value="1" size="6"  onkeyup="changeWeight('+ productId +','+productWeight+',this.value)">&nbsp;<strong>*</strong></td>';
						html += '<td id="psku' + productId + '">'+productWeight+'</td>';   
    	                html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
    	                html += '</tr>';
    	                $("#asnproducts").append(html);
    	            }
    			}
        	}else{
    			if($("#asnproduct"+productId).size()>0){
    				$("#asnproduct"+productId).remove();
    			}
    		}	
			if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
			if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
			if(typeof(countWeight)!='undefined'){countWeight();}			
        });

       
        $(".productDel").live("click", function () {
            $(this).parent().parent().remove();
			if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
			if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
			if(typeof(countWeight)!='undefined'){countWeight();}
        });
        <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['haveconta']=='1')){?>
            $('[name=haveconta][value=1]').attr('checked',true);
         <?php }else{ ?>
            $('[name=haveconta][value=0]').attr('checked',true);
            $('.haveconta').hide();
            selectwarehouse();
        <?php }?>
        //有无集装箱
        $('[name=haveconta]').die('click').live('click',function(){
            $('.haveconta').hide();
            if($(this).val()=='1'){
                $('.haveconta').show();
            }
        });
        $('#warehouseId').change(function(){
            selectwarehouse();
            getAimWarehouse();
        })
        $('#selectasndetail').click(function(){
            //$('#dialog').html();
            $("#batchAddTips").html('');
            $('[name=XMLForInput]').val('');
            $('#asndetailDialog').dialog('open');
           // $('#startUploadXLS').click(function(){
            //});
            return false;
        });
    });
	
	
		// 产品浏览的对话框			
		$('#dialog').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			width: 1000,
			minHeight:500,
			height:500,			
			resizable: true
			});
		$('#asndetailDialog').dialog({
            autoOpen: false,
            modal: false,
			position:[50,50],
            bgiframe:true,
            width: 900,
            resizable: true,
            buttons: {
                '确定': function() {
                    var pFile=$('[name=XMLForInput]').val();
                    var postfix = pFile.substr(pFile.length-3,3).toLowerCase();
                    if(pFile==""){
                        $("#batchAddTips").html("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
FileCanNotBeEmptyPleaseSelectCorrectFile<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");
                    }else if(postfix!='xls' && postfix!='csv' ){
                        $("#batchAddTips").html("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
OnlySupportXlsCsvDocument<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");
                        return false;
                    }else{
                        $('#asndetailForm').ajaxSubmit({
                            target:'#output1',
                            dataType:'json',
                            success:function(json){
                                if(json.ask==1){

                                    insertProductRow(json);															
								
                                }else{
                                    $("#batchAddTips").html(json.message);
                                }
                            }
                        });
                        //$(this).dialog('close');
                    }
                }  ,
                '关闭': function() {
                    $(this).dialog('close');
                }
            },
            close: function() {

            }
        });//$('#asndetailDialog').dialog({
	
	//产品浏览
	$('#dialog_link').click(function(){	
					getProductListBoxData('asn');
					$('#dialog').dialog('open');
					return false;
	});

    //表单提交
	function dosubmit(){
				var options = {
				url:'/merchant/receiving/create',
				type:'POST',
				dataType:'json',
				success: function(data){
					var html ="";						
					if(data.ask==1){						
                        $( "#messageTip").dialog({
                            autoOpen: false,
							position:[50,50],
                            close: function(event, ui) {locationToList();}
                        });
						$('<div title="提示(Tip)">'+data.msg+'</div>').dialog({
							autoOpen: true,
                            close: function(event, ui) {locationToList();},
					        width: '320',
							position:[50,50],
					        height: 'auto',
					        modal: true,
					        buttons: {
					            '关闭(close)': function () {
					            	locationToList();
					            }
					        }
					    });
                        $("#messageTip").html(html);
					}else{
						$("#messageTip").html('');
						if (typeof(data.message) != "undefined")
						{
    						html+=data.message+"<br/>";
						}
						 				
						$.each(data.error,function(idx,vitem){
						 html+=vitem+"<br/>";
						});
						$("#messageTip").html(html);

						$('#messageTip').dialog('open');
					}				
				}}; //显示操作提示

				$("#ASNForm").ajaxSubmit(options); 
				
				return false;
	
		    
}  //end of function
function locationToList(){
   //location.href="/merchant/receiving/listbh";
   var url = "/merchant/receiving/listbh";
   parent.openMenuTab(url,"<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
StockingASNList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'StockingASNList','1');
   
}



function changeWeight(product_id, productWeight, val) {
    	if(/^\d+$/.test(val)) {
			var sku = $('#psku'+product_id),
				weight = Number(productWeight),
				val = parseInt(val);
			sku.text(Math.round(weight*val*1000)/1000);
			countWeight();
        }    	
}
/*计算重量*/
function countWeight() {
		var total = 0;
		$("#asnproducts td[id^='psku']").each(function(){
			total += Number($(this).text());
			//psku<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
		
		});
		$('#total_weight').text(Math.round(total*1000)/1000);
}


function selectwarehouse(){
<?php if (!isset($_smarty_tpl->tpl_vars['receiving']->value)){?>
       if($('#warehouseId').val()!=''){
            $('.tableborder').show()
            $('#dialog_link').show();
            $('.pageFormContent tr').show();
            $('.jiahuowarehouse').show();
            $('.asndetail').show();
        }else{
            $('.tableborder').hide()
            $('#dialog_link').hide();
            $('.pageFormContent tr').hide();
            $('.jiahuowarehouse').show();
            $('.asndetail').hide();
        }
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['haveconta']=='1')){?>
    $('[name=haveconta][value=1]').attr('checked',true);
<?php }else{ ?>
    $('[name=haveconta][value=0]').attr('checked',true);
    $('.haveconta').hide();
<?php }?>
    if($('#warehouseId').val()=='1'){
        $('#avinumber').hide();
    }
}
//根据交货仓库获取目的仓
function getAimWarehouse(){
    $.ajax({
        type:'post',
        dataType:'json',
        url:'/merchant/receiving/get-aim-warehouse',
        data:{'warehouse_id':$('#warehouseId').val()},
        success:function(json){
            var html='';
            if($('.aimwarehouses').size()==0){
                if(json.ask=='1'){
                    html+='<tr class="aimwarehouses">';
                    html+='<td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ObjectiveWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>';
                    html+='<td><select name="to_warehouse" class="width155">'
                    $.each(json.warehouse,function(k,v){
                        html+='<option value='+ v.warehouse_id+'>'+ v.warehouse_name+'</option>';
                    });
                    html+='</select></td>';
                    html+='</tr>';
                    if($(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').length==0){
                        $(".jiahuowarehouse").after(html);
                    }else{
                        $(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').remove();
                        $(".jiahuowarehouse").after(html);
                    }
                }else{
                    if($(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').length==0){
                        $(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').remove();
                    }
                }
            }else{
                if(json.ask=='1'){
                    html+='<tr class="aimwarehouses">';
                    html+='<td  style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ObjectiveWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>';
                    html+='<td><select name="to_warehouse" class="width155">'
                    $.each(json.warehouse,function(k,v){
                        html+='<option value='+ v.warehouse_id+'>'+ v.warehouse_name+'</option>';
                    });
                    html+='</select></td>';
                    html+='</tr>';
                    if($(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').length==0){
                        $('.jiahuowarehouse').after(html);
                    }else{
                        $(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').remove();
                        $(".jiahuowarehouse").after(html);
                    }
                }else{
                    $(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').remove();
                }
            }

        }
    });
}

//插入产品
function insertProductRow(json){
   var product_number =  1;
    var errorHtml = '';
    $(json.data).each(function(k,row){
        var html = '';
        // insertProductRow(row.product_id,row.product_sku,row.product_title,row.pc_name,row.product_weight,row.product_number);
        if(row.is_valid=='1'){
            var productId = row.product_id;
            var productSku = row.product_sku;
            var productName = row.product_title;
            var category = row.pc_name;
            var number = row.product_number;
			var productWeight = row.product_weight;
            //var productWeight
            if($("#asnproduct"+productId).size()==0){
                html += '<tr id="asnproduct' + productId + '" class="product_sku">';
                html += '<td><a href="/merchant/product/detail/productId/'+productId+'" onclick="parent.openMenuTab(\'/merchant/product/detail?productId='+productId+'\',\'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
('+productSku+')\',\'productdetail'+productId+'\');return false;"  target="_blank">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                html += '<td title="'+productName+'">' + productName + '</td>';
                html += '<td>' + category + '</td>';
                html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" value="'+number+'" size="6" onkeyup="changeWeight('+productId+','+productWeight+',this.value)">&nbsp;<strong>*</strong></td>';
                html += '<td id="psku' + productId + '">'+number*productWeight+'</td>';  
				html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                html += '</tr>';
                $("#asnproducts").append(html);
				
            }
        }else{
            var error = row.errordata;
            if(error){
                $(error).each(function(ek,ed){
                    errorHtml+='<tr>';
                    errorHtml+='<td>'+ed.product_sku+'</td>';
                    errorHtml+='<td>'+ed.error+'</td>';
                    errorHtml+='</tr>';
                });
            }
            //errorHtm+=
        }
    });		
	if(typeof(countWeight)!='undefined'){countWeight();}
	if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
	if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
    if(json.errordata){
        //var error = row.errordata;
        /*if(error){

        }*/
        $(json.errordata).each(function(ek,ed){
            errorHtml+='<tr>';
            errorHtml+='<td>'+ed.product_sku+'</td>';
            errorHtml+='<td>'+ed.error+'</td>';
            errorHtml+='</tr>';
        });
    }
    /*$(json.data).each(function(k,row){
        // insertProductRow(row.product_id,row.product_sku,row.product_title,row.pc_name,row.product_weight,row.product_number);
        if(row.is_valid=='1'){
            var productId = row.product_id;
            var productSku = row.product_sku;
            var productName = row.product_title;
            var category = row.pc_name;
            var number = row.product_number;
            alert(number);

            var productWeight
            if($("#asnproduct"+productId).size()==0){
                html += '<tr id="asnproduct' + productId + '" class="product_sku">';
                html += '<td><a href="/merchant/product/detail/productId/'+productId+'" target="_blank">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                html += '<td title="'+productName+'">' + productName + '</td>';
                html += '<td>' + category + '</td>';
                html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" value="'+number+'" size="6"><span class="red">*</span></td>';
                html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                html += '</tr>';
                $("#asnproducts").append(html);
            }
        }else{
            var error = row.error;
            if(error){
                $(error).each(function(ek,ed){
                    errorHtml+='<p>'+ed+'</p>';
                });
            }
        }
    });*/
    $('#batchAddTips').html(errorHtml);
}

$(document).ready(function(){
	<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)){?>
	if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
	if(typeof(countWeight)!='undefined'){countWeight();}
	<?php }?>
	
	$('input[type=text]').placeholder();
	$('.tip').poshytip({className: 'tip-yellowsimple',
	showOn: 'focus',
	alignTo: 'target',
	alignX: 'right',
	alignY: 'center',
	offsetX: 5});

	
});

$('#messageTip').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			position:[50,50],
			width: 400,
			position:[50,50],
			resizable: true			
});
</script><?php }} ?>