<?php /* Smarty version Smarty-3.1.13, created on 2015-11-17 16:34:57
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\logistic\views\index\create-waybill.tpl" */ ?>
<?php /*%%SmartyHeaderCode:133975649329ec3ad93-10632608%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd75f7ce674deade86e5e9cdacfae0f2503a4d14' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\logistic\\views\\index\\create-waybill.tpl',
      1 => 1447749289,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133975649329ec3ad93-10632608',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5649329ee4fc83_82519504',
  'variables' => 
  array (
    'data' => 0,
    'traf' => 0,
    'c' => 0,
    'country' => 0,
    'customsCodes' => 0,
    'currency' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5649329ee4fc83_82519504')) {function content_5649329ee4fc83_82519504($_smarty_tpl) {?><style type="text/css">
    .left-td{
        text-align:right;
        width:175px;
    }
</style>
<script stype="text/javascript">
    $(function(){
        $('#sbt').click(function(){
            var id = $('#id').val();
            $.ajax({
                type:"post",
                dataType:"json",
                async:false,
                url:'/logistic/index/create',
                data:$('#createWaybillForm').serialize(),
                success:function(json){
                    if(json.ask==1){
                        if(id==''){
                            createWaybillForm.reset();
                        }
                    }
                    var msg = '';
                    msg+= '<div>'+json.message+'</div>';
                    if(typeof json.error=='object'){
                        $.each(json.error,function(k,v){
                            msg += v+'<br />';
                        });
                    }else{
                        msg = json.msg;
                    }
                    alertTip(msg);
                }
            });
        });

        $("#consigneeProvince").autocomplete({
            minLength: 0,
            source: function(request, response) {
                var term = request.term;
                if(term) {
                    term = term.toUpperCase();
                    $("#consigneeProvince").val(term);
                }
                $.post('/merchant/order/province', {'country_id':$('#consigneeCountry').val(),'term':term},function(data){
                    response(data);
                }, 'json');
            }
        }).focus(function() {
            $('#consigneeProvince').autocomplete("search", "");
        });

        $("#consigneeCity").autocomplete({
            minLength: 0,
            source: function(request, response) {
                var term = request.term;
                if(term) {
                    term = term.toUpperCase();
                    $("#consigneeCity").val(term);
                }
                $.post('/merchant/order/city', {'country_id':$('#consigneeCountry').val(),'province_id':$("#consigneeProvince").val(),'term':term},function(data){
                    response(data);
                }, 'json');
            }
        }).focus(function() {
            $('#consigneeCity').autocomplete("search", "");
        });

        $("#consigneeDistrict").autocomplete({
            minLength: 0,
            source: function(request, response) {
                var term = request.term;
                if(term) {
                    term = term.toUpperCase();
                    $("#consigneeDistrict").val(term);
                }
                $.post('/merchant/order/district', {'country_id':$('#consigneeCountry').val(),'city_id':$("#consigneeCity").val(),'term':term},function(data){
                    response(data);
                }, 'json');
            }
        }).focus(function() {
            $('#consigneeDistrict').autocomplete("search", "");
        });
    })
</script>
<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div>
        <div class="content-box-header">
            <h3  class="clearborder" style="margin-left:5px;">运单新增</h3>
        </div>
    </div>
    <form id="createWaybillForm">
        <table>
            <tr>
                <td class="left-td">电商客户代码：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="customerCode" name="customerCode" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['customer_code'];?>
<?php }?>"></td>
            </tr>
            <tr>
                <td class="left-td">交易单号：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="transactionOrderCode" name="transactionOrderCode" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['transaction_order_code'];?>
<?php }?>"></td>
                <td class="left-td">物流运单编号：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="logNo" name="logNo" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['log_no'];?>
<?php }?>"></td>
            </tr>
            <tr>
                <td class="left-td">运输方式：</td>
                <td>
                    <select class="text-input width155"  id="trafMode" name="trafMode">
                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['traf']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['tfm_id'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['traf_mode']==$_smarty_tpl->tpl_vars['c']->value['tfm_id']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['c']->value['traf_mode_name']=='公路运输'){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['traf_mode_name'];?>
</option>
                        <?php } ?>
                    </select>
                </td>
                <td class="left-td">运输工具：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="shipName" name="shipName" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['ship_name'];?>
<?php }?>"></td>
            </tr>
            <tr>
                <td class="left-td">航班航次号：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="voyageNo" name="voyageNo" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['voyage_no'];?>
<?php }?>"></td>
                <td class="left-td">提运单号：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="billNo" name="billNo" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['bill_no'];?>
<?php }?>"></td>
            </tr>
            <tr>
                <td class="left-td">发货人：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="shipper" name="shipper" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['shipper'];?>
<?php }?>"></td>
                <td class="left-td">发货人电话：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="shipperTelephone" name="shipperTelephone" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['shipper_telephone'];?>
<?php }?>"></td>
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
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['shipper_country']==$_smarty_tpl->tpl_vars['c']->value['country_id']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['c']->value['country_name_en']=='China'){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
                        <?php } ?>
                    </select>
                </td>
                <td class="left-td">发货人地址：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="shipperAddress" name="shipperAddress" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['shipper_address'];?>
<?php }?>"></td>
            </tr>
            <tr>
                <td class="left-td">收货人：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="consignee" name="consignee" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee'];?>
<?php }?>"></td>
                <td class="left-td">收货人所在国：</td>
                <td>
                    <select name="consigneeCountry" id='consigneeCountry' class="text-input width155">
                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['consignee_country']==$_smarty_tpl->tpl_vars['c']->value['country_id']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['c']->value['country_name_en']=='China'){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="left-td">收货人地址（省）：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="consigneeProvince" name="consigneeProvince" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_province'];?>
<?php }?>"></td>
                <td class="left-td">收货人地址（市）：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="consigneeCity" name="consigneeCity" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_city'];?>
<?php }?>"></td>
            </tr>
            <tr>
                <td class="left-td">收货人地址（区）：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="consigneeDistrict" name="consigneeDistrict" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_district'];?>
<?php }?>"></td>
                <td class="left-td">收货人地址：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="consigneeAddress" name="consigneeAddress" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_address'];?>
<?php }?>"></td>
            </tr>
            <tr>
                <td class="left-td">收货人电话：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="consigneeTelephone" name="consigneeTelephone" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['consignee_telephone'];?>
<?php }?>"></td>
				<td class="left-td">主管海关代码：</td>
				<td>
					<select name="customsCode" id='customsCode' class="text-input width155">
                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customsCodes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['ie_port'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['customs_code']==$_smarty_tpl->tpl_vars['c']->value['ie_port']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['ie_port'];?>
-<?php echo $_smarty_tpl->tpl_vars['c']->value['ie_port_name'];?>
</option>
                        <?php } ?>
                    </select>
				</td>
            </tr>
            <tr>
                <td class="left-td">运费：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="freight" name="freight" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['freight'];?>
<?php }?>"></td>
                <td class="left-td">订单商品货款：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="goodsValue" name="goodsValue" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['goods_value'];?>
<?php }?>"></td>
            </tr>
            <tr>
                <td class="left-td">保价费：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="insureFee" name="insureFee" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['insure_fee'];?>
<?php }?>"></td>
                <td class="left-td">币种：</td>
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
                </td>
            </tr>
            <tr>
                <td class="left-td">毛重：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="weight" name="weight" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['weight'];?>
<?php }?>"> Kg</td>
                <td class="left-td">净重：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="netWeight" name="netWeight" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['net_weight'];?>
<?php }?>"> Kg</td>
            </tr>
            <tr>
                <td class="left-td">件数：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text"  id="packNo" name="packNo" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['pack_no'];?>
<?php }?>"></td>
            </tr>
            <tr>
                <td class="left-td">包裹单信息：</td>
                <td><textarea name="parcelInfo" id="parcelInfo" rows="2" cols="35"><?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['parcel_info'];?>
<?php }?></textarea></td>
                <td class="left-td">商品信息：</td>
                <td><textarea name="goodsInfo" id="goodsInfo" rows="2" cols="35"><?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['goods_info'];?>
<?php }?></textarea></td>
            </tr>
            <tr>
                <td class="left-td">备注：</td>
                <td><textarea name="note" id="note" rows="2" cols="35"><?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['note'];?>
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
</div><?php }} ?>