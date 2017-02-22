<?php /* Smarty version Smarty-3.1.13, created on 2015-11-17 15:19:11
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\receiving\jh-receiving-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6450564ad4efc914e0-95753104%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5baa8ea64bc52781d865fee9b61a97bfa18b5067' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\receiving\\jh-receiving-create.tpl',
      1 => 1446288383,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6450564ad4efc914e0-95753104',
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
    'country' => 0,
    'item' => 0,
    'iePorts' => 0,
    'ieport' => 0,
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
  'unifunc' => 'content_564ad4f02b4bf8_51839215',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_564ad4f02b4bf8_51839215')) {function content_564ad4f02b4bf8_51839215($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
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
        margin-right: 5px;
    }
   
    .asndetailstrong {
        color: #FF0000;
        display: block;
        float: left;
        margin-right: 20px;
        margin-top: 15px;
    }
</style>
<style>
  #subProducts .textInput{
      float:none;;
  }
</style>


 <div class="content-box-header">
        <h3 style="margin-left:5px"><?php echo $_smarty_tpl->tpl_vars['actions']->value;?>
-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectingMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
    </div>		


    <div class="asndetail">
 	 <table  style="width:200px;border:none;">
			<tr>
			<td><a href="#" id="dialog_link" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductInfo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" class="nowarp dialog_link ui-state-default  ui-corner-all" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></td>
			<td><span style="font-size:1.1em;color:red">*</span></td>			
			<td><a href="#" id="selectasndetail" class="nowarp dialog_link ui-state-default  ui-corner-all" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BulkUploadOrders<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></td>
			</tr>
	 </table>
	 
    </div>

		<form   action="/merchant/receiving/create" method="post"  id='ASNForm' name="createForm" >
			<div id="create-asn-center" >
				
					<table cellspacing="0" cellpadding="0"  class="asnordersbox formtable tableborder">
						<thead>
							<tr>
								<th width='100'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<input type="hidden" name="ASNCode" value="<?php echo $_smarty_tpl->tpl_vars['receiving_code']->value;?>
"  /></th>
								<th width='200'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
								<th width='180'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
								<th width='120'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
								<th width='100'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
							</tr>
						</thead>
						<tbody id='asnorders'>
                        <?php if ($_smarty_tpl->tpl_vars['receivingDetail']->value!=''){?>
                        <?php  $_smarty_tpl->tpl_vars["detail"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["detail"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['receivingDetail']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["detail"]->key => $_smarty_tpl->tpl_vars["detail"]->value){
$_smarty_tpl->tpl_vars["detail"]->_loop = true;
?>
                        <tr  id="asnorder<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
" class="product_sku">
                            <td><a href="/merchant/order/detail/ordersCode/<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_code'];?>
" target="_blank" onclick="parent.openMenuTab('/merchant/order/detail?ordersCode=<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_code'];?>
)','orderdetail<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_code'];?>
');return false;"><?php echo $_smarty_tpl->tpl_vars['detail']->value['reference_no'];?>
</a>
							<input type="hidden" name="asn_order[<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_code'];?>
"></td>
                            <td title="<?php echo $_smarty_tpl->tpl_vars['detail']->value['sm_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['detail']->value['sm_code'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['detail']->value['country_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['detail']->value['add_time'];?>
</td>
                            <td><a class="orderDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>
                        </tr>
                        <?php } ?>
                        <?php }?>
            			<tr class="norowdata">
            				<td colspan="5" style="text-align:center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Do_not_select_order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</b></td>            		
            			</tr>							
						</tbody>
          		
            	
						
					</table>
				<div class="clear"></div>	
				<input type="hidden" name="ASNCode" value="<?php echo $_smarty_tpl->tpl_vars['receiving_code']->value;?>
" />
				<table class="pageFormContent">
					<tbody>
						<tr class="jiahuowarehouse">
							<td  style="text-align:right" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
warehousing_logistics_enterprises<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="hidden" name="receive_model_type" value="1"></td>
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
							</select> <strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"  class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_select_the_warehousing_logistics_enterprises<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a></td>
						</tr>
                        <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['to_warehouse_id']>0)){?>
                        <tr class="aimwarehouses">
                            <td style="text-align:right"  class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ObjectiveWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
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
                            <td  class="nowarp text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
IE_Port<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                            <td>
                                <select name="ie_ort" class="required width155" id="ie_ort">
                                    <option value="">前海湾港区</option>
                                    <option value="">天津港区</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="ReferenceCode">
                            <td  class="nowarp text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
country_of_origin<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                            <td>
                                <select name="country_of_origin" class="required width155" id="country_of_origin">
                                    <option value="">-Select-</option>
                                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['country_name'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['country_id']==49){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['country_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value['country_name_en'];?>
</option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="ReferenceCode">
                            <td  class="nowarp text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
destination_country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                            <td>
                                <select name="destination_country" class="required width155" id="destination_country">
                                    <option value="">-Select-</option>
                                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['country_name'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['country_id']==49){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['country_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value['country_name_en'];?>
</option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
						<tr class="ReferenceCode">
							<td  style="text-align:right" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
							<td><input type="text" size="60" class="text-input width140" value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['reference_no']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['reference_no'];?>
<?php }?>" name="ref_code" id="ref_code"> <strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"  class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
asn_reference_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a></td>
						</tr>
                        <tr class="ReferenceCode">
                            <td   class="nowarp text_right">提单号：</td>
                            <td><input type="text" size="60" class="text-input width155 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['trake_code']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['trake_code'];?>
<?php }?>" name="trake_code" id="trake_code"></td>
                        </tr>
                        <tr class="ReferenceCode">
                            <td   class="nowarp text_right">报关单号：</td>
                            <td><input type="text" size="60" class="text-input width155 " value="" name="declaration_number" id="declaration_number"></td>
                        </tr>
                        <tr class="ReferenceCode">
                            <td   class="nowarp text_right">车牌号：</td>
                            <td><input type="text" size="60" class="text-input width155 " value="" name="plate_numbe" id="plate_numbe"></td>
                        </tr>
                        <tr>
                          <td class="nowrap text_right">总件数：</td>
                          <td>
                            <input type="text" class="text-input width140" name="pack_no" id="pack_no" value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['pack_no']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['pack_no'];?>
<?php }?>" />&nbsp;<strong class="red">*</strong>
                            &nbsp;&nbsp;&nbsp;<a href="#" class="tip" title="请填写ASN总件数" onclick="return false;"><img src="/images/help.png" /></a>
                          </td>
                        </tr>


                        <!--<tr>
                            <td class='nowrap text_right'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ImportexportPorts<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
                            <td>
                                <select name="ie_port" class="required width155">
                                    <?php  $_smarty_tpl->tpl_vars['ieport'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ieport']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ieport']->key => $_smarty_tpl->tpl_vars['ieport']->value){
$_smarty_tpl->tpl_vars['ieport']->_loop = true;
?>
                                      <option value="<?php echo $_smarty_tpl->tpl_vars['ieport']->value['ie_port'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['ie_port']==$_smarty_tpl->tpl_vars['ieport']->value['ie_port'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['ieport']->value['ie_port_name'];?>
</option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>-->

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
                                <input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['traf_name']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['traf_name'];?>
<?php }?>" name="traf_name" >
                                &nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(请填入ASN出运后对应的航空提单)						    </td>
                        </tr>-->
                        <tr>
                            <td class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PackingType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
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
                        </tr>
                        <!--<tr>
                            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
TotalNumber<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                            <td><input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['pack_no']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['pack_no'];?>
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
                            <td style="text-align:right"  class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
roughweight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                            <td><input type="text" placeholder="0.00" class="text-input width140" name='roughweight' value='<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['roughweight']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['roughweight'];?>
<?php }?>'> 
                            KG <strong class="red">*</strong>&nbsp;<p style="display:inline;zoom:1;width:2px"></p><a href="#"  class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_asn_total_weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="return false;"><img src="/images/help.png"></a></td>
                        </tr>
                        <tr>
                            <td style="text-align:right"  class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
volume<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                            <td><input type="text" placeholder="0.00" class="text-input width140" name='volumnweight' value='<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['volumnweight']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['volumnweight'];?>
<?php }?>'> 
                            CBM<p style="display:inline;zoom:1;width:1px;">&nbsp;</p>
                            <a href="#"  class="tip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_enter_asn_total_volumn<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
                                <input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['conta_id']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['conta_id'];?>
<?php }?>" name="conta_id">
                            </td>
                        </tr>
                        <tr class="haveconta">
                            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ContainerSpecificationNo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                            <td>
                                <input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['conta_model']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['conta_model'];?>
<?php }?>" name="conta_model">
                            </td>
                        </tr>
                        <tr class="haveconta">
                            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ContainerWeight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                            <td>
                                <input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['conta_wt']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['conta_wt'];?>
<?php }?>" name="conta_wt">
                            </td>
                        </tr>-->

                        <tr>
                            <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                            <td><textarea rows="5" cols="80" id="instructions" name="instructions"><?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['receiving_description']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['receiving_description'];?>
<?php }?></textarea></td>
                        </tr>

                        <tr>
                            <td style="text-align:right">&nbsp;</td>
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
PleaseSelectOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
</div>
<div class="infoTips" id="messageTip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
			
</div>
 <div id="asndetailDialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
import_by_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
     <form action="/merchant/order/bulkorder" method="post" id="asndetailForm">
         <table>
             <tr><th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                 <td><input type="file" name="XMLForInput" />
                 </td></tr>
             <tr>
                 <th><input name="warehouse_select" id="warehouse_select" value='' type="hidden"><input name="to_warehouse_select" id="to_warehouse_select" value="" type="hidden"></th>
                 <td>
                     <p><img style="width:25px;" src="/images/download.png"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
download_templete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:<a href="/merchant/order/order-select-templete" style="text-decoration:underline;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_templete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></p>
                     
                 </td>
             </tr>
         </table>

         <table cellspacing="0" cellpadding="0" class="formtable tableborder">
             
             <tbody id='batchAddTips'>

             </tbody>
         </table>
     </form>
 </div>
<div id="selectModelDialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_asn_model<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display: none;">
<input type="button" value='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectingMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' class="ui-state-default button selectmodelbtn">
<input type="button" value='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' class="ui-state-default button selectmodelbtn">
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
        $('#warehouseId').change(function(){
            selectwarehouse();
            getAimWarehouse();
        });
        $('#selectasndetail').click(function(){
            //$('#dialog').html();
            $("#batchAddTips").html('');
            $('#asndetailDialog').dialog('open');
            /* $('#startUploadXLS').click(function(){
             });*/
            return false;
        });
    });

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
    }



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
                        html += '<td><input type="text" name="sku[' + item.product_id + ']" value="'+item.rd_receiving_qty+'" size="6"><span class="red">*</span></td>';
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
            }
        });
    }


    $(function () {
        //选择订单
        $(".actionOrder").live("click", function () {
           	 var orderid = $(this).attr("orderId");
             var ordercode = $(this).attr("orderCode");
             var shipType = $(this).attr("shipType");
             var countryName = $(this).attr("countryName");
             var createDate = $(this).attr("createDate");
			 var reference_no = $(this).attr("reference_no");
             var state = $(this).attr("state");
			 // html += '<td><a href="/merchant/order/detail/ordersCode/'+ordercode+'" target="_blank">' + reference_no + '</a><input type="hidden" name="asn_order[' + orderid + ']" value="' + ordercode + '"></td>';
        	if ($(this).is(':checked')){
    			if($("#asnorder"+orderid).size()==0){
    				if ($("#asnorder" + orderid).size() == 0) {
    	                var html = '';
    	                html += '<tr id="asnorder' + orderid + '" class="product_sku">';
    	                html += '<td><a href="/merchant/order/detail/ordersCode/'+ordercode+'" onclick="parent.openMenuTab(\'/merchant/order/detail?ordersCode='+ordercode+'\',\'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
('+ordercode+')\',\'orderdetail'+ordercode+'\');return false;"  target="_blank">' + reference_no + '</a><input type="hidden" name="asn_order[' + orderid + ']" value="' + ordercode + '"></td>';
    	                html += '<td title="'+shipType+'">' + shipType + '</td>';
    	                html += '<td>'+state+'</td>';
                        html += '<td>'+createDate+'</td>';
    	                html += '<td><a class="orderDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
    	                html += '</tr>';
    	                $("#asnorders").append(html);
    	            }
    			}
        	}else{
    			if($("#asnorder"+orderid).size()>0){
    				$("#asnorder"+orderid).remove();
    			}
    		}			
			if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}	
        });

        $(".orderDel").live("click", function () {
            $(this).parent().parent().remove();
			//keepTheInterface();
			if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
			if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
        });
        <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['haveconta']=='1')){?>
            $('[name=haveconta][value=1]').attr('checked',true);
         <?php }else{ ?>
            $('[name=haveconta][value=0]').attr('checked',true);
            $('.haveconta').hide();
            selectwarehouse();
            //getAimWarehouse();
        <?php }?>
        //有无集装箱
        $('[name=haveconta]').die('click').live('click',function(){
            $('.haveconta').hide();
            if($(this).val()=='1'){
                $('.haveconta').show();
            }
        });
    });

		// 选择订单的对话框			
		$('#dialog').dialog({
        		autoOpen: false,
				position: ['center','top'],
        		modal: false,
        		bgiframe:true,
        		width: 850,
				minHeight:100,
        		resizable: false
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
                             $('#warehouse_select').val($('#warehouseId').val());
                            if($('.aimwarehouses').size()>0){
                                $('#to_warehouse_select').val($('[name=to_warehouse]').val());
                            }else{
                                $('#to_warehouse_select').val('');
                            }
                            $('#asndetailForm').ajaxSubmit({
                                target:'#output1',
                                dataType:'json',
                                async: false,
                                beforeSend : function () {
                                  $('#batchAddTips').html('<img src="/images/loading.gif" />正在处理验证数据，请勿进行其他操作');
                                },
                                success:function(json){
                                    if(json.ask==1){
                                        /*$(json.data).each(function(k,row){
                                            // insertProductRow(row.product_id,row.product_sku,row.product_title,row.pc_name,row.product_weight,row.product_number);

                                        });*/
                                        insertOrderRow(json);
										if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
										if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
                                    }else{
                                        $("#batchAddTips").html(json.message);
                                    }
                                    $('input[name="XMLForInput"]').val(''); // AJAX请求成功，清除文本域数据
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
            });
			//产品浏览
			$('#dialog_link').click(function(){	
					//getProductListBoxData('asn');
                    getOrderList();
					$('#dialog').dialog('open');
					return false;
			});
        //开始时提示
        $('#selectModelDialog').dialog({
            autoOpen: false,
			position:[50,50],
            modal: false,
            bgiframe:true,
            width: 800,
            resizable: true
        });
        //$('#selectModelDialog').dialog('open');
    /*表单提交*/
	function dosubmit(){
				var options = {
				url:'/merchant/receiving/create', //提交给哪个执行
				type:'POST',
				dataType:'json',
				success: function(data){
					var html ="";						
					if(data.ask==1){
						/*html += data.msg+'</br></br>';
						if(actionLabel=='add'){
							html += '<a href="/merchant/receiving/create"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
ASN</a><br/>';
							
							var ASNCode = data.ASNCode || '';
							if(ASNCode!=''){
								html += '<a href="/merchant/receiving/create/ASNCode/';
								html+=ASNCode;
								html+='">修改此ASN</a></br>';
							}
													
							html += '<a href="/merchant/receiving/listjh"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BackASNList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>';
						}

						if(actionLabel=='update'){
							html += '<a href="/merchant/receiving/create"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
ASN</a><br/>';
							html += '<a href="/merchant/receiving/listjh"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BackASNList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>';
						}

						$("#messageTip").html(html);*/
						
						$('<div title="提示(Tip)">'+data.msg+'</div>').dialog({
							autoOpen: true,
                            close: function(event, ui) {locationToList();},
					        width: '320',
							position:[50,50],
					        height: 'auto',
					        modal: true,
					        buttons: {
					            '关闭(close)': function () {
					            	//window.location.href='/merchant/receiving/listjh';
									locationToList();
					            }
					        }
					    });
																
					}else{
						$("#messageTip").html('');
						if (typeof(data.msg) != "undefined")
						{
    						html+=data.msg+"<br/>";
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
         //location.href="/merchant/receiving/listjh";
		  var url = "/merchant/receiving/listjh";
		  parent.openMenuTab(url,"集货ASN列表",'CollectionASNList','1');
     }
    //得到订单信息
    function getOrderList(){
        if(checkwarehouse()){
            var orderData = $("#pagerForm").serialize();
            orderData+="&warehouse_id=" + $('#warehouseId').val();
            if($('.aimwarehouses').size()>0){
                orderData += "&to_warehouse=" + $('[name=to_warehouse]').val();
            }
            $.ajax({
                type:'post',
                url:'/merchant/order/list-asn-order',
                data:orderData,
                dataType:'html',
                success:function(html){
                    $("#dialog").html(html);
                }
            });
            $('#dialog').dialog('open');
        }
    }
function checkwarehouse(){
    if($('#warehouseId').val()==''){
        alertTip('交货仓库必填才能选择订单');
        return false;
    }
    if($('.aimwarehouses').size()>0){
        if($('[name=to_warehouse]').val()==''){
            alertTip('目的仓库必填才能选择订单');
            return false;
        }
    }
    return true;
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
$(function(){
    if($('#warehouseId').val() == '6'){
        if($('input[name="volumnweight"]').siblings('strong').size() < 1){
            $('input[name="volumnweight"]').siblings('a').prev().after('<strong class="red">*</strong>');
        }        
    }
})
//根据交货仓库获取目的仓
function getAimWarehouse(){
    var warehouseId = $('#warehouseId').val();
    if(warehouseId == '6'){
        if($('input[name="volumnweight"]').siblings('strong').size() < 1){
            $('input[name="volumnweight"]').siblings('a').prev().after('<strong class="red">*</strong>');
        }
    }else{
        $('input[name="volumnweight"]').siblings('strong').remove();
    }
    $.ajax({
        type:'post',
        dataType:'json',
        url:'/merchant/receiving/get-aim-warehousejh',
        data:{'warehouse_id':$('#warehouseId').val()},
        success:function(json){
            var html='';
            if($('.aimwarehouses').size()==0){
                if(json.ask=='1'){
                    html+='<tr class="aimwarehouses">';
                    html+='<td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
                    html+='<td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
//插入订单
function insertOrderRow(json){
    //return;
    var product_number =  1;
    var errorHtml = '';
    $(json.data).each(function(k,row){
        var html = '';
        // insertProductRow(row.product_id,row.product_sku,row.product_title,row.pc_name,row.product_weight,row.product_number);
        if(row.is_valid=='1'){
            var orderid = row.order_id;
            var ordercode = row.order_code;
            var shipType = row.sm_code;
            var countryName = row.country_name;
            var createDate = row.add_time;
            var reference_no = row.reference_no;
            if($("#asnorder" + orderid).size() == 0 && orderid>0){
                html += '<tr id="asnorder' + orderid + '" class="product_sku">';
                html += '<td><a href="/merchant/order/detail/ordersCode/'+ordercode+'" target="_blank">' + reference_no + '</a><input type="hidden" name="asn_order[' + orderid + ']" value="' + ordercode + '"></td>';
                html += '<td title="'+shipType+'">' + shipType + '</td>';
                html += '<td>'+countryName+'</td>';
                html += '<td>'+createDate+'</td>';
                html += '<td><a class="orderDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                html += '</tr>';
                $("#asnorders").append(html);
				errorHtml+='<tr>';
				errorHtml+='<td>'+reference_no+'</td>';
				errorHtml+='<td>'+'成功'+'</td>';
				errorHtml+='</tr>';
				//$('#batchAddTips').html(errorHtml);
				
                //$("#asnproducts").append(html);
            }
        }else{
            var orderid = row.order_id;
            var ordercode = row.order_code;
            var shipType = row.sm_code;
            var countryName = row.country_name;
            var createDate = row.add_time;
            var reference_no = row.reference_no;
            if(!reference_no){
                reference_no='';
            }
            var error = row.error;
            errorHtml+='<tr >';
            errorHtml+='<td>'+reference_no+'</td>';
            errorHtml+='<td >失败,';
            if(error){
                $(error).each(function(ek,ed){
                    if(ed){
                        errorHtml+='<p style="color:red">'+ed+'</p>';
                    }else{
                        errorHtml+='<p> </p>';
                    }
                });
            }
            errorHtml+='</td>';
            errorHtml+='</tr>';
            //errorHtm+=
        }
    });	
    //$('#batchAddTips').html(errorHtml);
    $('#batchAddTips').html('数据导入成功');
}


/*未选择订单的提示*/
function getRipOfNodataRow(){
	 var dataRows = $("#asnorders tr:not(.norowdata)").size();
	 if(dataRows>0){
	   $('.norowdata').remove();
	 }else{
	 	$('.norowdata').remove();
	 	var html='<tr class="norowdata">\n';
            html+='<td colspan="5" style="text-align:center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Do_not_select_order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</b></td></tr>';
			$("#asnorders").append(html);		
	 }
}	

</script>	

<script>

$(document).ready(function(){
	<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)){?>
	if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
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
			position:[50,50],
			bgiframe:true,
			width: 400,		
			resizable: true			
});
</script>
<?php }} ?>