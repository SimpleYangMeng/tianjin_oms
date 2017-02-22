<?php /* Smarty version Smarty-3.1.13, created on 2014-07-10 11:13:53
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/receiving/th-receiving-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157064704653be04f1d38c69-47373886%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '625be02a0e141a67bc96025c33c5308963dd3876' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/receiving/th-receiving-create.tpl',
      1 => 1400141553,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157064704653be04f1d38c69-47373886',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'actions' => 0,
    'receiving_code' => 0,
    'receivingDetail' => 0,
    'detail' => 0,
    'receiving' => 0,
    'actionLabel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53be04f1eeaa64_26768765',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53be04f1eeaa64_26768765')) {function content_53be04f1eeaa64_26768765($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
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
        width: 60px;
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
return_mode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
    <div class="clear"></div>
</div>



<form   action="/merchant/receiving/create" method="post"  id='ASNForm' name="createForm" >
 	<input type="hidden" name="ASNCode" value="<?php echo $_smarty_tpl->tpl_vars['receiving_code']->value;?>
"  />
	<input type="hidden" name="receiving_type" value="1"  />
    <input type="hidden" name="receive_model_type" value="0">
	<div id="create-asn-center" >

        <table cellspacing="0" cellpadding="0" class="formtable tableborder" >
            <thead>
            <tr>
                <th width='100' ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
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
" target="_blank" onclick="parent.openMenuTab('/merchant/order/detail?ordersCode=<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_code'];?>
)','orderdetail<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_code'];?>
');return false;"><?php echo $_smarty_tpl->tpl_vars['detail']->value['product_sku'];?>
</a><input type="hidden" name="product_sku[<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_sku'];?>
"></td>
                    <td title="<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_title'];?>
"><?php echo $_smarty_tpl->tpl_vars['detail']->value['product_title'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['detail']->value['category_name'];?>
</td>                   
					<td><input type="text"  readonly="readonly" class="inputbox inputMinbox" name="sku[<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['rd_receiving_qty'];?>
" size="6"  onkeyup="changeWeight(<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
,<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_weight'];?>
,this.value)" >&nbsp;</td>
					<td id="psku<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['detail']->value['product_weight']*$_smarty_tpl->tpl_vars['detail']->value['rd_receiving_qty'];?>
</td>
                    
                </tr>
                <?php } ?>
            <?php }?>
            	<tr class="norowdata">
            		<td colspan="5" style="text-align:center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
            			
            			</tr>
              </tbody>	
			
        </table>
        <div class="clear"></div>
      
        <table class="pageFormContent">
            <tbody>
            <tr class="jiahuowarehouse">
                <td style="text-align:right" class="nowrap text_right" id="order_code_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
TradingOrderNo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                <td>
				         <input type="text" size="60" class="text-input width140 "   value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['return_order_code']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['return_order_code'];?>
<?php }?>" name="order_code" id="order_code" />
				
						
						<input type="button"  href="#" class="ui-state-default button selectmodelbtn" id="select_order"  value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" />			
				</td>
            </tr>


            <tr class="ReferenceCode">
                <td style="text-align:right" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td>
				         
					<input type="hidden" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['warehouse_id']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['warehouseId'];?>
<?php }?>" name="warehouseId" id="warehouseId" />
					<input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['warehouse_id']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['warehouse_name'];?>
<?php }?>" name="warehouse_name" id="warehouse_name" readonly="readonly" />				</td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['to_warehouse_id']>0)){?><?php }?>
            <tr class="aimwarehouses">
                <td style="text-align:right" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ObjectiveWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td >
                <td>
                  
				
					<input type="hidden" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['to_warehouse']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['to_warehouse_id'];?>
<?php }?>" name="to_warehouse" id="to_warehouse" />
					<input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['to_warehouse']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['to_warehouse_name'];?>
<?php }?>" name="to_warehouse_name" id="to_warehouse_name" readonly="readonly"/>				</td>
            </tr>
            
            <tr class="ReferenceCode">
                <td  style="text-align:right" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['reference_no']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['reference_no'];?>
<?php }?>" name="ref_code" id="ref_code" readonly="readonly">&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"  class="tip" title="请填写一个该ASN特有的参考号，以便查询追踪" onclick="return false;"><img src="/images/help.png"></a></td>
            </tr>
           

            <tr >
                <td  style="text-align:right" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
return_express_company<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['return_express_company']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['return_express_company'];?>
<?php }?>" name="return_express_company" id="return_express_company" >&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>	
			
            <tr >
                <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
who_pay_return_fee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td valign="middle">
							<select name="return_shipping_pay_party" class="required width155" id="return_shipping_pay_party">																	
									<option value="1" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['return_shipping_pay_party']=='1')){?>selected<?php }?>>自付</option> 
									<option value="2" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['return_shipping_pay_party']=='2')){?>selected<?php }?>>代付</option> 
							</select>
				
				
				</td>
            </tr>
		
		
            <tr class="return_shipping_amount_box" style="display:none">
                <td  style="text-align:right" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
return_shipping_amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['return_shipping_amount']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['return_shipping_amount'];?>
<?php }?>" name="return_shipping_amount" id="return_shipping_amount" >&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"  class="tip" title="必须为正数" onclick="return false;"><img src="/images/help.png"></a></td>
            </tr>			
			

            <tr>
                <td  style="text-align:right" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
return_tracking_no<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><input type="text" size="60" class="text-input width140 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['return_tracking_no']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['return_tracking_no'];?>
<?php }?>" name="return_tracking_no" id="return_tracking_no">&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>		



            <tr >
                <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td valign="middle"><textarea rows="5" cols="60"   placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
return_order_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="width:600px !important;" id="instructions" name="instructions"><?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['receiving_description']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['receiving_description'];?>
<?php }?></textarea>&nbsp;<strong class="red">*</strong>&nbsp;</td>
            </tr>			
			

            <tr>
                <td>&nbsp;</td>
                <td><a  href="#" class="button tijiao" id='asnbutton'  onclick="dosubmit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>                </td>
            </tr>

            </tbody>
        </table>

    </div>

</form>


<div class="infoTips" id="messageTip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">

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
   var url = "/merchant/receiving/listth";
   parent.openMenuTab(url,"<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReturnASNList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'ReturnASNList','1');
   
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
			var number_text = $(this).text();
			
			total += Number(parseFloat(number_text));
			//psku<?php echo $_smarty_tpl->tpl_vars['detail']->value['product_id'];?>
		
		});
		$('#total_weight').text(Math.round(total*1000)/1000);
}




function selectedOrder(){

<?php if (!isset($_smarty_tpl->tpl_vars['receiving']->value)){?>
       if($('#order_code').val()!=''){
            $('.tableborder').show();            
            $('.pageFormContent tr').show();
            $('.jiahuowarehouse').show();
            $('#select_order').hide();
			show_amount_box_by_shipping_pay_party();
			
        }else{
            $('.tableborder').hide();          
            $('.pageFormContent tr').hide();
            $('.jiahuowarehouse').show();
            $('#select_order').show();
        }		
<?php }?>   
}


//插入产品
function insertProductRow(json){
   var product_number =  1;
    var errorHtml = '';
    $(json.data).each(function(k,row){
        var html = '';        	
            var productId = row.product_id;
            var productSku = row.product_sku;
            var productName = row.product_title;
            var category = row.pc_name;
            var number = row.product_number;
			var productWeight = row.product_weight;
            //var productWeight
            if($("#asnproduct"+productId).size()==0){
                html += '<tr id="asnproduct' + productId + '" class="product_sku">';
                html += '<td><a href="/merchant/product/detail/productId/'+productId+'" target="_blank" onclick="parent.openMenuTab(\'/merchant/product/detail?productId='+productId+'\',\'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
('+productSku+')\',\'productdetail'+productId+'\');return false;">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                html += '<td title="'+productName+'">' + productName + '</td>';
                html += '<td>' + category + '</td>';
                html += '<td><input readonly="readonly" type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" value="'+number+'" size="6" onkeyup="changeWeight('+productId+','+productWeight+',this.value)"></td>';
                html += '<td id="psku' + productId + '">'+number*productWeight+'KG</td>';  
				
                html += '</tr>';
                $("#asnproducts").append(html);
				
            }
        
    });		
	if(typeof(countWeight)!='undefined'){countWeight();}
	if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
	if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}

   
   
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
	
	$('#select_order').click(function(){
		getorderinfo_by_order_code();
	});
	
	
	
	<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)){?>
	  
	 <?php }else{ ?>           
		selectedOrder();
		//getAimWarehouse();
	<?php }?>
	
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
/*根据订单编号找物品*/
function getorderinfo_by_order_code(){

   var html = "";
   var order_code = $('input[name="order_code"]').val();
   if(Trim(order_code)==''){
   		html='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_code_required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'; 
		$('#messageTip').html(html);   
   		$('#messageTip').dialog('open'); 
   		return;
   }
	$.ajax({
		type:"POST",
		async:false,
		dataType:"json",
		url:"/merchant/receiving/get-order-from-createth",
		data: {
			'order_code':order_code
		},
		success:function (json) {
			
			//alertTip('Reference No. existed.');
			if (json.ask == '1') {
					  
					if (typeof(json.warehouse_id) != "undefined"){
						$('#warehouseId').val(json.warehouse_id);
					}					  
					if (typeof(json.warehouse_name) != "undefined"){
						$('#warehouse_name').val(json.warehouse_name);
					}
					
					if (typeof(json.to_warehouse_id) != "undefined"){
						$('#to_warehouseId').val(json.to_warehouse_id);
					}					  
					if (typeof(json.to_warehouse_name) != "undefined"){
						$('#to_warehouse_name').val(json.to_warehouse_name);
					}					
					if (typeof(json.reference_no) != "undefined"){
						$('#ref_code').val(json.reference_no);
					}
					
					if (typeof(json.order_code) != "undefined"){
						$('#order_code').val(json.order_code);
					}					
						
					$('#order_code_title').html('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:');						
					$('#order_code').attr('readonly','true');										                  
					insertProductRow(json);
					selectedOrder();
			} else {			
					if (typeof(json.error) != "undefined"){
						html+=json.error+"<br/>";
					}
					$('#messageTip').html(html);   
					$('#messageTip').dialog('open'); 										
			}
			

		}
	}); // $.ajax({
   
   

};


$(document).ready(function(){
	$("select[name='return_shipping_pay_party']").change(function(){
		show_amount_box_by_shipping_pay_party();
	});
	
	
	
});


function show_amount_box_by_shipping_pay_party(){
	var return_shipping_pay_party = $("select[name='return_shipping_pay_party']").val();
	if(return_shipping_pay_party=='2'){
		$('.return_shipping_amount_box').show();		
	}else{
		$('.return_shipping_amount_box').hide();
		$('input[name="return_shipping_amount"]').val('');
	}

}
</script><?php }} ?>