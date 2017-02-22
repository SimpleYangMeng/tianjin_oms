<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 15:28:23
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/order/order-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:191907654753b3b4974fe0d3-46290160%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45b132acee7a0f3d5e4e653fc70f575366d0273c' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/order/order-create.tpl',
      1 => 1399859849,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '191907654753b3b4974fe0d3-46290160',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'modify' => 0,
    'countryJs' => 0,
    'warehouseJs' => 0,
    'orderInfo' => 0,
    'continueCreate' => 0,
    'order_mode_type' => 0,
    'ordersCode' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3b4975e0db6_31003427',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3b4975e0db6_31003427')) {function content_53b3b4975e0db6_31003427($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style type="text/css">
    #orderForm tbody th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;

    }
    #orderForm tbody td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    #orderForm tbody span.error{
        top:auto;
    }
    span.error{
        top:auto;
    }
    button.button{
        height: 35px;
    }
	
	form span{ font-size:1.1em;}	
	
</style>

<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content" id="tabs" >
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><?php echo $_smarty_tpl->tpl_vars['action']->value;?>
<span id="order_mode_title">-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOrderMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> </h3>
        <div class="clear"></div>
    </div>	
	<div id="selectModelDialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOrderMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:" class="hidden">	
	<table>
    <tr>
        <td align='right'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseFirstSelectOrderMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
        <td align='left'><input type="button" value='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectingMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' class="ui-state-default button selectmodelbtn" model='1'>
            <input type="button" value='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' class="ui-state-default button selectmodelbtn" model='0'>
        </td>
    </tr>
	</table>


	</div>	
	
    <!--
	<div class="model">
        <?php if (!(isset($_smarty_tpl->tpl_vars['modify']->value)&&$_smarty_tpl->tpl_vars['modify']->value=='1')){?>
        <input type="button" id="jihuomodel" model='1' value='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectingMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' class="ui-state-default button selectmodelbtn" >
        <input type="button" id="beihuomodel" model='0' value='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' class="ui-state-default button selectmodelbtn" >
        <?php }?>
    </div>
	-->

<div class="modelcontent">

</div>
</div>
<div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">    
</div>


<div id="XLSInputBox" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
import_by_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
	<form action="/merchant/product/batch-input" method="post" id="XLSInputForm">	
		<table>
			<tr><td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td><td><input type="file" name="XMLForInput" /></td>
			<td>
			
			</td></tr>	
			<!--			
			<tr>
			
			<td>
			<a  id="startUploadXLS" class="button"  onclick="return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
导入<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
			</td>		
			
			<td>&nbsp;</td>
			</tr>
			-->	
			<tr>
			
			<td>&nbsp;</td>
			<td><p>
			<img src="/images/download.png" style="width:25px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
download_templete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:	<a  style="text-decoration:underline;" href="/merchant/product/product-select-templete"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_template<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
			</p>
			</td>
			</tr>	
			
							
		</table>
		
		
	</form>
	

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
            <tbody id='orderproductserror'>          

            </tbody>
        </table>	
		
</div>

<script type="text/javascript">
    var countryJs = <?php echo $_smarty_tpl->tpl_vars['countryJs']->value;?>
;
    var warehouseJs = <?php echo $_smarty_tpl->tpl_vars['warehouseJs']->value;?>
;
    var order_mode_type = "";
   /**/
    function changeWeight(product_id, productWeight, val) {

    	if(/^\d+$/.test(val)) {
			var sku = $('#sku'+product_id),
				weight = Number(productWeight),
				val = parseInt(val);
			sku.text(Math.round(weight*val*1000)/1000);
			countWeight();
        }    	
    }
	/*计算重量*/
    function countWeight() {
		var total = 0;
		$("#orderproducts td[id^='sku']").each(function(){
			total += Number($(this).text());		
		});
		$('#total_weight').text(Math.round(total*1000)/1000);
    }
    /*计算总成交总价*/
    function countTotalPrice(){
        var totalPrice = 0;
        $("#orderproducts td[id^='sku']").each(function(){
            total += Number($(this).text());
        });
        $('#total_weight').text(Math.round(total*1000)/1000);
    }


$(function(){
	
    $('#selectModelDialog').dialog({
        autoOpen: false,
        modal: false,
		position:[50,150],
        bgiframe:true,
        width: 800,
		height:'auto',
        resizable:false
    });


    <?php if (!isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?>
    $('#selectModelDialog').dialog('open');
    <?php }?>

  

  $(".orderactionSku").live("click", function () {
        var productId = $(this).attr("productId");
        var productSku = $(this).attr("productSku");
        var productName = $(this).attr("productName");
        var category = $(this).attr("category");
        var productWeight = $(this).attr("productWeight");
        var warehouse_id = $("[name='warehouse_id']").val();
        var to_warehouse_id = $("[name='to_warehouse_id']").val();
        if ($(this).is(':checked')){
            if($("#orderproduct"+productId).size()==0){
                if ($("#orderproduct" + productId).size() == 0) {
                    var html = '';
                    html += '<tr id="orderproduct' + productId + '" class="product_sku">';
                    html += '<td><a href="/merchant/product/detail/productId/'+productId+'" target="_blank">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                    html += '<td title="'+productName+'">' + productName + '</td>';
                    html += '<td>' + category + '</td>';
                    html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" onkeyup="changeWeight('+productId+','+productWeight+',this.value)" value="1" size="6">&nbsp;<strong>*</strong></td>';
                    html += '<td id="sku'+productId+'">'+productWeight+'</td>';
                    if(warehouse_id==3||to_warehouse_id==3){
                        html += '<td><input type="text" class="inputbox inputMinbox price" name="price['+productId+']" size="6"><span class="red">*</span> </td>';
                        html += '<td><input type="text" class="inputbox inputMinbox total_price" name="total_price['+productId+']" size="6"><span class="red">*</span> </td>';
                    }else{
                        html += '<td><input type="text" class="inputbox inputMinbox price" name="price['+productId+']" size="6"><span class="red"></span> </td>';
                        html += '<td><input type="text" class="inputbox inputMinbox total_price" name="total_price['+productId+']" size="6"><span class="red"></span> </td>';
                    }
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
        if(typeof(countWeight)!='undefined'){countWeight();}
		if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
    });
  
    <?php if ($_smarty_tpl->tpl_vars['continueCreate']->value=="1"){?>
        $('#ordermodeltext').html("<?php echo $_smarty_tpl->tpl_vars['order_mode_type']->value;?>
");
        $('[name=ordermodel]').val("<?php echo $_smarty_tpl->tpl_vars['order_mode_type']->value;?>
");
        $('.modelcontent').show();
        $('.model').hide();
        getOrderModel("<?php echo $_smarty_tpl->tpl_vars['order_mode_type']->value;?>
");
        $('#selectModelDialog').dialog('close');
    <?php }else{ ?>
        <?php if (isset($_smarty_tpl->tpl_vars['modify']->value)&&$_smarty_tpl->tpl_vars['modify']->value=='1'){?>
            getOrderModel('<?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['order_mode_type'];?>
');
        <?php }else{ ?>
            //处理模式
            $('.selectmodelbtn').bind('click',function(){
                //alert($(this).attr('model'));
                $('#ordermodeltext').html($(this).val());
                $('[name=ordermodel]').val($(this).attr('model'))
                $('.modelcontent').show();
                $('.model').hide();
                getOrderModel($(this).attr('model'));
                $('#selectModelDialog').dialog('close');
            });
            $('.modelcontent').hide();
        <?php }?>
    <?php }?>
    $('#tipwarehouse').show();
    $(".productDel").live("click",function(){
        $(this).parent().parent().remove();		
		if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
		if(typeof(countWeight)!='undefined'){countWeight();}
		if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
    });

    $('#warehouse_id').change(function(){
        if($('#warehouse_id').val()!=''){
            $('#tipwarehouse').hide();
        }
    }).change();

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

    $('#dialog').dialog({
        autoOpen: false,
        modal: false,
        bgiframe:true,
        width: 850,  
        resizable: true
    });

    //产品浏览
    $('#dialog_link').click(function(){
        //$('#dialog').html();
        $('#dialog').dialog('open');
        return false;
    });
});


 $(function(){
    getProductListBoxData('order');
});

function ordervalidateCallback(form, callback){
   var $form = $('#orderForm');
   callback=callback||ordercallback;
    var _submitFn = function(){
        $.ajax({
            type: $form.method || 'POST',
            url:$form.attr("action"),
            data:$form.serializeArray(),
            dataType:"json",
            cache: false,
            success: callback,
            error: function(){
                alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SubmitError<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
            }
        });
    }
    _submitFn();
    return false;
}

    //订单创建的回调函数
    function ordercallback(json){
        if(json.ask){
            var message=json.message;
            var order_mode_type = json.order_mode_type;
			var ordersCode = json.ordersCode;
            message+="<br/><button class='button' type='button' onclick='gocontinueCreateOrder()'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ContinueAdd<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</button>";
			//message+="<button class='button' type='button'  onclick='golistOrder();'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ListView<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</button>";
			message+="&nbsp;<button class='button' type='button' onclick=\"gotoEdit('"+ordersCode+"')\"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit_this_order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</button>";
			//http://www.jinkouoms.new/merchant/order/create?ordersCode=SOEC0010000177
            if(json.action && json.action=='update'){
				alertTip(message,'500','auto','3');
			}
            if(json.action && json.action=='add'){
				alertTip(message,'500','auto','3');
			}
			//alertTip(message,'500','auto','1');
			//action
			//$('#orderForm').resetForm();
        }else{
            var html = "<strong>"+json.message+"</strong>";
            if(json.error){
                html+=":<br/>";
                $.each(json.error,function(k,v){
                    html+="<span class='red'>*</span>"+v+"<br/>";
                });
            }
            alertTipnobutton(html)
        }

    }
    function gocontinueCreateOrder(){
        //window.location.href='/merchant/order/create/continueCreate/1/order_mode_type/'+order_mode_type;
		
		if(order_mode_type=='1'){
			var title='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Create_new_collectionOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
			var key = 'newjh';
		}else{
			order_mode_type = '0';
			var title='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
create_new_stocking_order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
			var key = 'newbh';
		}
		var url = '/merchant/order/create/continueCreate/1/order_mode_type/'+order_mode_type;
		parent.openMenuTab(url,title,key,'1');
    }
	
	function gotoEdit(ordersCode){
		var url = '/merchant/order/create?ordersCode='+ordersCode;
		var title='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit_order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
('+ordersCode+')';
		parent.openMenuTab(url,title,'orderedit'+ordersCode,'1');
		//window.location.href='/merchant/order/create?ordersCode='+ordersCode;
	}	
	
    function golistOrder(){
        var orderType = $('[name=ordermodel]').val();
        if(orderType=='1'){
			var title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectionOrdersList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
";
            var url ='/merchant/order/listjh';
			var key = 'CollectingOrderList';
			
        }else{
			var title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
StockingOrderList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
";
            var url ='/merchant/order/listbh';
			var key = 'StockingOrderList';
        }
		parent.openMenuTab(url,title,key,'1');
    }
    //得带模板内容
    function getOrderModel(ordermodel){
        var orderCode = '<?php echo $_smarty_tpl->tpl_vars['ordersCode']->value;?>
';
        var url='';
        if(ordermodel=='0'){
            url='/merchant/order/create'; //备货模式
        }else if(ordermodel=='1'){
            url='/merchant/order/createjh'; //集货模式
        }else{
            return false;
        }
        $.ajax({
            type:'get',
            dataType:'html',
            url:url,
            data:{'ordermodel':ordermodel,'type':'getTpl','ordersCode':orderCode},
            success:function(html){
                $('.model').hide();						
                $('.modelcontent').html(html).show();
            }
        });
    }
	
    $(function(){		

	});
	
function alertTip(tip,width,height,flush) {
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tip_esc_escape<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
        height: height,
        modal: true,
        show:"slide",		
        buttons: {
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                $(this).dialog('close');
							
                if(flush=='1'){
                    window.location.reload();
                }
							
                if(flush=='3'){
                     golistOrder();
                }				
            }
        },
        close: function() {
            golistOrder();
        }
    });
}
//无button的提示
function alertTipnobutton(tip,width,height,flush) {
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tip_esc_escape<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
        height: height,
        modal: true,
        show:"slide",
        close: function() {
        }
    });
}
/*未选择产品的提示*/
function getRipOfNodataRow(){
	 var dataRows = $("#orderproducts tr:not(.norowdata)").size();
	 
	 if(dataRows>0){
	   $('.norowdata').remove();
	 }else{	 	 	
	 	var html='<tr class="norowdata">\n';
            html+='<td colspan="6" style="text-align:center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
not_select_product_yet<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</b></td></tr>';
			$("#orderproducts").append(html);		
	 }
}

	
</script>
<?php }} ?>