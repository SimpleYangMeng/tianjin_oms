<?php /* Smarty version Smarty-3.1.13, created on 2016-03-04 10:34:05
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\logistic\views\index\create-waybill.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2589556d8f41dc64e30-29937698%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3578b68759060f9eece11635e608bc6fd13a8418' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\logistic\\views\\index\\create-waybill.tpl',
      1 => 1455677486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2589556d8f41dc64e30-29937698',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'customer' => 0,
    'companyInfo' => 0,
    'ieType' => 0,
    'k' => 0,
    'productInfo' => 0,
    'item' => 0,
    'traf' => 0,
    'c' => 0,
    'trafTools' => 0,
    'country' => 0,
    'appStatus' => 0,
    'customsCodes' => 0,
    'currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d8f41df09c92_33491952',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d8f41df09c92_33491952')) {function content_56d8f41df09c92_33491952($_smarty_tpl) {?><style type="text/css">
    .left-td{
        text-align:right;
        width:175px;
    }
</style>
<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div>
        <div class="content-box-header">
            <h3  class="clearborder" style="margin-left:5px;">运单新增</h3>
        </div>
    </div>
    <form id="createWaybillForm" class="pageForm required-validate" method="post">
        <table>

            <?php if (empty($_smarty_tpl->tpl_vars['data']->value)){?>
                <tr>
                    <td class="left-td">物流企业代码：</td>
                    <td>
                        <span class="blue"><?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
</span>
                        <input type="hidden" name="logistic_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
" />
                    </td>
                    <td class="left-td">物流企业名称：</td>
                    <td><span class="blue"><input type="hidden" name="logistic_enp_name" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
</span></td>
                </tr>
            <?php }else{ ?>
                <tr>
                    <td class="left-td">物流企业代码:</td>
                    <td>
                        <span class="blue"><?php echo $_smarty_tpl->tpl_vars['data']->value['logistic_customer_code'];?>
</span> 
                        <input type="hidden" name="logistic_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['logistic_customer_code'];?>
" />
                    </td>
                    <td class="left-td">物流企业名称:</td>
                    <td>
                        <span class="blue"><?php echo $_smarty_tpl->tpl_vars['data']->value['logistic_enp_name'];?>
</span>
                        <input type="hidden" name="logistic_enp_name" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['logistic_enp_name'];?>
" />
                    </td>
                </tr>
            <?php }?>
            <tr>
                <td class="form_title nowrap text_right">进出口类型：</td>
                <td class="form_input">
                    <select name="ieType" id='ie_type' class="width155">
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ieType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['productInfo']->value)&&($_smarty_tpl->tpl_vars['productInfo']->value['ie_type']==$_smarty_tpl->tpl_vars['k']->value)){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>

                            </option>
                        <?php } ?>
                    </select>
                    <strong>*</strong>
                </td>
                <?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?>
                     <td class="left-td">申报类型：</td>
                    <td>
                        <span class="blue">变更</span>
                        <input type="hidden" name="appType" id="appType" value="2" />
                    </td>
                <?php }else{ ?>
                   <td class="left-td">申报类型：</td>
                    <td>
                        <span class="blue">新增</span>
                        <input type="hidden" name="appType" id="appType" value="1" />
                    </td>
                <?php }?>
            </tr>
            <tr>
                <td class="left-td">电商企业代码：</td>
                <td>
                    <input class="text-input width140 ui-autocomplete-input" type="text" id="customerCode" name="customerCode" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['customer_code'];?>
<?php }?>">
                    <strong>*</strong>
                </td>
                <td class="form_title nowrap text_right">电商企业名称：</td>
                <td class="form_input">
                    <input style="width: 200px;" class="text-input ui-autocomplete-input" type="text" id="ebp_name" name="ebp_name" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['ebp_name'];?>
<?php }?>">
                    <strong>*</strong>
                </td>
            </tr>
            
            <tr>
                <td class="left-td">交易订单号：</td>
                <td>
                    <input class="text-input width140 ui-autocomplete-input" type="text" id="referenceNo" name="referenceNo" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['reference_no'];?>
<?php }?>">
                    <strong>*</strong>
                </td>
                <td class="left-td">运单号：</td>
                <td>
                    <input class="text-input width140 ui-autocomplete-input" type="text" id="logNo" name="logNo" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['log_no'];?>
<?php }?>">
                    <strong>*</strong>
                </td>
            </tr>
            <tr>
                <td class="left-td">运输方式：</td>
                <td>
                    <select class="text-input width155" id="trafMode" name="trafMode">
                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['traf']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['tfm_id'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['traf_mode']==$_smarty_tpl->tpl_vars['c']->value['tfm_id']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['traf_mode_name'];?>
</option>
                        <?php } ?>
                    </select>
                    <strong>*</strong>
                </td>
                <td class="left-td">运输工具：</td>
                <td>
                    <!--
                    <input class="text-input width140 ui-autocomplete-input" type="text" id="shipName" name="shipName" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['ship_name'];?>
<?php }?>">
                    -->
                    <select name="shipName" id="shipName" class="text-input width155">
                         <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['trafTools']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['traf_tool_name'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['ship_name']==$_smarty_tpl->tpl_vars['c']->value['traf_tool_name']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['traf_tool_name'];?>
</option>
                        <?php } ?>
                    </select>
                    <strong>*</strong>
                </td>
            </tr>
            <tr>
                <td class="left-td">航班航次号：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="voyageNo" name="voyageNo" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['voyage_no'];?>
<?php }?>"></td>
                <td class="left-td">提运单号：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="billNo" name="billNo" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['bill_no'];?>
<?php }?>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">发货人：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="shipper" name="shipper" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['shipper'];?>
<?php }?>"><strong>*</strong></td>
                <td class="left-td">发货人电话：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="shipperTelephone" name="shipperTelephone" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['shipper_telephone'];?>
<?php }?>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">发货人所在国：</td>
                <td>
                    <select name="shipperCountry" id='shipperCountry' class="text-input width155">
                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['shipper_country']==$_smarty_tpl->tpl_vars['c']->value['country_code']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['c']->value['country_name_en']=='China'){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
                        <?php } ?>
                    </select>
                    <strong>*</strong>
                </td>
                <td class="left-td">发货人地址：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="shipperAddress" name="shipperAddress" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['shipper_address'];?>
<?php }?>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">收货人：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="consignee" name="consignee" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee'];?>
<?php }?>"><strong>*</strong></td>
                <td class="left-td">收货人所在国：</td>
                <td>
                    <select name="consigneeCountry" id='consigneeCountry' class="text-input width155">
                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['consignee_country']==$_smarty_tpl->tpl_vars['c']->value['country_code']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['c']->value['country_name_en']=='China'){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
                        <?php } ?>
                    </select>
                    <strong>*</strong>
                </td>
            </tr>
            <tr>
                <td class="left-td">收货人地址（省）：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="consigneeProvince" name="consigneeProvince" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_province'];?>
<?php }?>"><strong>*</strong></td>
                <td class="left-td">收货人地址（市）：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="consigneeCity" name="consigneeCity" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_city'];?>
<?php }?>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">收货人地址（区）：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="consigneeDistrict" name="consigneeDistrict" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_district'];?>
<?php }?>"><strong>*</strong></td>
                <td class="left-td">收货人电话：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="consigneeTelephone" name="consigneeTelephone" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_telephone'];?>
<?php }?>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">收货人地址：</td>
                <td colspan="3"><!--<input style="width: 300px;" class="text-input ui-autocomplete-input" type="text" id="consigneeAddress" name="consigneeAddress" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_address'];?>
<?php }?>">-->
                    <textarea name="consigneeAddress" id="consigneeAddress" rows="2" cols="35"><?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_address'];?>
<?php }?></textarea>
                    <strong>*</strong>
                </td>
            </tr>
            <tr>
                <!-- 
                <td class="left-td">业务状态：</td>
                <td>
                    <select name="appStatus" id='appStatus' class="text-input width155">
                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['appStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['fml_status']==$_smarty_tpl->tpl_vars['k']->value){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value;?>
</option>
                        <?php } ?>
                    </select>
                </td>
                 -->
				<td class="left-td">主管海关代码：</td>
				<td colspan="3">
					<select name="customsCode" id='customsCode' class="text-input width155">
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
                    <strong>*</strong>
				</td>
            </tr>
            <tr>
                <td class="left-td">运费：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" placeholder="0.00" id="freight" name="freight" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['freight'];?>
<?php }?>"><strong>*</strong></td>
                <td class="left-td">订单商品货款：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" placeholder="0.00" id="goodsValue" name="goodsValue" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['goods_value'];?>
<?php }?>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">保价费：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" placeholder="0.00" id="insureFee" name="insureFee" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['insure_fee'];?>
<?php }?>"><strong>*</strong></td>
                <td class="left-td">币制：</td>
                <td>
                    <select name="currencyCode" id='currencyCode' class="text-input width155">
                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['currency']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['code'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['currency_code']==$_smarty_tpl->tpl_vars['c']->value['code']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['c']->value['code']=='RMB'){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['code'];?>
</option>
                        <?php } ?>
                    </select>
                    <strong>*</strong>
                </td>
            </tr>
            <tr>
                <td class="left-td">毛重：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" placeholder="0.0000" id="weight" name="weight" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['weight'];?>
<?php }?>"><strong>*</strong> <span class="blue">Kg</span></td>
                <td class="left-td">净重：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" placeholder="0.0000" id="netWeight" name="netWeight" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['net_weight'];?>
<?php }?>"><strong>*</strong> <span class="blue">Kg</span></td>
            </tr>
            <tr>
                <td class="left-td">件数：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="packNo" name="packNo" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['pack_no'];?>
<?php }?>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">包裹单信息：</td>
                <td><textarea name="parcelInfo" id="parcelInfo" rows="2" cols="35"><?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['parcel_info'];?>
<?php }?></textarea><strong>*</strong></td>
                <td class="left-td">商品信息：</td>
                <td><textarea name="goodsInfo" id="goodsInfo" rows="2" cols="35"><?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['goods_info'];?>
<?php }?></textarea><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">备注：</td>
                <td colspan="3"><textarea name="note" id="note" rows="2" cols="35"><?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['note'];?>
<?php }?></textarea></td>
            </tr>

            <tr>
                <td class="left-td"></td>
                <td colspan=3><a id="sbt" class="button tijiao">提交</a></td>
            </tr>
        </table>
        <input type="hidden" name="id" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['wb_id'];?>
<?php }?>">
    </form>
</div>

<script stype="text/javascript">
    $(function(){
        //表单提交
        $('#sbt').click(function(){
            var id = $('#id').val();
            $.ajax({
                type:"post",
                dataType:"json",
                async:false,
                url:'/logistic/index/create',
                data:$('#createWaybillForm').serialize(),
                success:function(json){
                    var message = '';
                    if(typeof json.message=='object'){
                        $.each(json.message,function(k,v){
                            message += v + '<br />';
                        });
                    }else{
                        message = json.message;
                    }
                    alertTip(message);
                    if(json.ask==1){
                       $('#createWaybillForm')[0].reset();
                    }
                }
            });
        });
        //省份
        $("#consigneeProvince").autocomplete({
            minLength: 0,
            source: function(request, response) {
                var term = request.term;
                if(term) {
                    term = term.toUpperCase();
                    $("#consigneeProvince").val(term);
                }
                $.post('/logistic/index/province', {'country_id':$('#consigneeCountry').val(),'term':term},function(data){
                    response(data);
                }, 'json');
            }
        }).focus(function() {
            $('#consigneeProvince').autocomplete("search", "");
        });
        //市
        $("#consigneeCity").autocomplete({
            minLength: 0,
            source: function(request, response) {
                var term = request.term;
                if(term) {
                    term = term.toUpperCase();
                    $("#consigneeCity").val(term);
                }
                $.post('/logistic/index/city', {'country_id':$('#consigneeCountry').val(),'province_id':$("#consigneeProvince").val(),'term':term},function(data){
                    response(data);
                }, 'json');
            }
        }).focus(function() {
            $('#consigneeCity').autocomplete("search", "");
        });
        //地区
        $("#consigneeDistrict").autocomplete({
            minLength: 0,
            source: function(request, response) {
                var term = request.term;
                if(term) {
                    term = term.toUpperCase();
                    $("#consigneeDistrict").val(term);
                }
                $.post('/logistic/index/district', {'country_id':$('#consigneeCountry').val(),'city_id':$("#consigneeCity").val(),'term':term},function(data){
                    response(data);
                }, 'json');
            }
        }).focus(function() {
            $('#consigneeDistrict').autocomplete("search", "");
        });
        //自动获取公司名称
        $('#customerCode').blur(function (){
            var customer_code = $(this).val();
            var myoptions = {
                url: '/logistic/index/get-company-name-by-cus-code',
                type: 'POST',
                cache: false,       
                dataType: 'json',
                processData: true,
                data: {'customer_code': customer_code},
                success: function(json){
                    if(json.ask==1){
                        $('#customer_code').css({'border-color':''});
                        $('#ebp_name').val(json.data.trade_name);
                    }else {
                        $("#commonPayTip").html(json.message);
                        $('#commonPayTip').dialog('open');
                        $('#ebp_name').val('');
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
    })
</script><?php }} ?>