<style type="text/css">
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
.valid {
  color: #228b22;
}
.invalid {
  color: #b22222;
}
</style>

<div class="content-box-header">
    <h3 style="margin-left:5px"><{$actions}>-<{t}>return_mode<{/t}></h3>
    <div class="clear"></div>
</div>



<form   action="/merchant/receiving/create" method="post"  id='ASNForm' name="createForm" >
 	<input type="hidden" name="ASNCode" value="<{$receiving_code}>"  />
	<input type="hidden" name="receiving_type" value="1"  />
    <input type="hidden" name="receive_model_type" value="0">
	<div id="create-asn-center" >

        <table cellspacing="0" cellpadding="0" class="formtable tableborder" >
            <thead>
            <tr>
                <th width='100' ><{t}>skuCode<{/t}></th>
                <th width='200'><{t}>pname<{/t}></th>
                <th width='180'><{t}>ProductCategory<{/t}></th>
                <th width='70'><{t}>quantity<{/t}></th>
				<th width='70'><{t}>weight<{/t}></th>
              
            </tr>
            </thead>
            <tbody id='asnproducts'>
            <{if $receivingDetail!=''}>
            <{foreach from=$receivingDetail item="detail"}>
                <tr  id="asnproduct<{$detail.product_id}>" class="product_sku">
                    <td><a href="/merchant/product/detail/productId/<{$detail.product_id}>" target="_blank" onclick="parent.openMenuTab('/merchant/order/detail?ordersCode=<{$detail['order_code']}>','<{t}>orderDetail<{/t}>(<{$detail['order_code']}>)','orderdetail<{$detail['order_code']}>');return false;"><{$detail.product_sku}></a><input type="hidden" name="product_sku[<{$detail.product_id}>]" value="<{$detail.product_sku}>"></td>
                    <td title="<{$detail.product_title}>"><{$detail.product_title}></td>
					<td><{$detail.category_name}></td>                   
					<td><input type="text"  readonly="readonly" class="inputbox inputMinbox" name="sku[<{$detail.product_id}>]" value="<{$detail.rd_receiving_qty}>" size="6"  onkeyup="changeWeight(<{$detail.product_id}>,<{$detail.product_weight}>,this.value)" >&nbsp;</td>
					<td id="psku<{$detail.product_id}>"><{$detail.product_weight*$detail.rd_receiving_qty}></td>
                    
                </tr>
                <{/foreach}>
            <{/if}>
            	<tr class="norowdata">
            		<td colspan="5" style="text-align:center;"><b><{t}>not_select_product_yet<{/t}></b></td>    		
            		
            	</tr>
								
            </tbody>
			
			 <tbody>
            			<tr>
            			<td colspan="3" style="text-align:right;"><b><{t}>total<{/t}>：</b></td>
                                                                                                                        <td id="total_PCE"></td>
						<td id="total_weight"></td>
            			
            			</tr>
              </tbody>	
			
        </table>
        <div class="clear"></div>
      
        <table class="pageFormContent">
            <tbody>
            <tr class="jiahuowarehouse">
                <td style="text-align:right" class="nowrap text_right" id="order_code_title"><{t}>orderCode<{/t}>/<{t}>TradingOrderNo<{/t}>：
                <td>
				         <input type="text" size="60" class="text-input width140 "   value="<{if isset($receiving)&&$receiving.return_order_code}><{$receiving.return_order_code}><{/if}>" name="order_code" id="order_code" />
				
						
						<input type="button"  href="#" class="ui-state-default button selectmodelbtn" id="select_order"  value="<{t}>Determine<{/t}>" />			
            <input type="button" class="ui-state-default button selectmodelbtn" id="batchImportOrder" value="批量导入" />
				</td>
            </tr>


            <tr class="ReferenceCode">
                <td style="text-align:right" class="nowrap text_right"><{t}>DeliveryWarehouse<{/t}>：</td>
                <td>
				         
					<input type="hidden" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.warehouse_id}><{$receiving.warehouseId}><{/if}>" name="warehouseId" id="warehouseId" />
					<input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.warehouse_id}><{$receiving.warehouse_name}><{/if}>" name="warehouse_name" id="warehouse_name" readonly="readonly" />				</td>
            </tr>
            <{if isset($receiving)&&($receiving.to_warehouse_id>0)}><{/if}>
            <tr class="aimwarehouses">
                <td style="text-align:right" class="nowrap text_right"><{t}>ObjectiveWarehouse<{/t}>：</td >
                <td>
                  
				
					<input type="hidden" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.to_warehouse}><{$receiving.to_warehouse_id}><{/if}>" name="to_warehouse" id="to_warehouse" />
					<input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.to_warehouse}><{$receiving.to_warehouse_name}><{/if}>" name="to_warehouse_name" id="to_warehouse_name" readonly="readonly"/>				</td>
            </tr>
            
            <tr class="ReferenceCode">
                <td  style="text-align:right" class="nowrap text_right"><{t}>CustomerReference2<{/t}>：</td>
                <td><input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.reference_no}><{$receiving.reference_no}><{/if}>" name="ref_code" id="ref_code" readonly="readonly">&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"  class="tip" title="请填写一个该ASN特有的参考号，以便查询追踪" onclick="return false;"><img src="/images/help.png"></a></td>
            </tr>
           

            <tr >
                <td  style="text-align:right" class="nowrap text_right"><{t}>return_express_company<{/t}>：</td>
                <td><input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.return_express_company}><{$receiving.return_express_company}><{/if}>" name="return_express_company" id="return_express_company" >&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>	
			
            <tr >
                <td style="text-align:right"><{t}>who_pay_return_fee<{/t}>：</td>
                <td valign="middle">
							<select name="return_shipping_pay_party" class="required width155" id="return_shipping_pay_party">																	
									<option value="1" <{if isset($receiving)&&($receiving.return_shipping_pay_party=='1')}>selected<{/if}>>自付</option> 
									<option value="2" <{if isset($receiving)&&($receiving.return_shipping_pay_party=='2')}>selected<{/if}>>代付</option> 
							</select>
				
				
				</td>
            </tr>
		
		
            <tr class="return_shipping_amount_box" style="display:none">
                <td  style="text-align:right" class="nowrap text_right"><{t}>return_shipping_amount<{/t}>：</td>
                <td><input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.return_shipping_amount}><{$receiving.return_shipping_amount}><{/if}>" name="return_shipping_amount" id="return_shipping_amount" >&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"  class="tip" title="必须为正数" onclick="return false;"><img src="/images/help.png"></a></td>
            </tr>			
			

            <tr>
                <td  style="text-align:right" class="nowrap text_right"><{t}>return_tracking_no<{/t}>：</td>
                <td><input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.return_tracking_no}><{$receiving.return_tracking_no}><{/if}>" name="return_tracking_no" id="return_tracking_no">&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>		



            <tr >
                <td style="text-align:right"><{t}>remark<{/t}>：</td>
                <td valign="middle"><textarea rows="5" cols="60"   placeholder="<{t}>return_order_tip<{/t}>" style="width:600px !important;" id="instructions" name="instructions"><{if isset($receiving)&&$receiving.receiving_description}><{$receiving.receiving_description}><{/if}></textarea>&nbsp;<strong class="red">*</strong>&nbsp;</td>
            </tr>			
			

            <tr>
                <td>&nbsp;</td>
                <td><a  href="#" class="button tijiao" id='asnbutton'  onclick="dosubmit();return false;"><{t}>submit<{/t}></a>                </td>
            </tr>

            </tbody>
        </table>

    </div>

</form>


<div class="infoTips" id="messageTip" title="<{t}>InformationTips<{/t}>">

</div>
    

<div id="batchImportOrderDialog" title="批量导入" style="display:none;">
  <form action="/merchant/receiving/batch-import-order" method="POST" id="batchImportOrderForm" enctype="multipart/form-data" target="hiddenAjaxIframe">
    <input type="file" name="order_file" value="" />&nbsp;&nbsp;
    <input type="button" value="导入" class="ui-state-default button selectmodelbtn" onclick="javascript:batchImportOrderData();" />
    &nbsp;&nbsp;<a href="/template/return-order-import-template.xls" target="_blank">批量导入模板下载</a>
  </form>

  <table class="table" style="width:100%;border:1px solid #cccccc;border-collapse:collapse;margin-top:10px;" id="batchImportOrderTable">
    <thead class="caption">
      <tr>
        <th style="width:150px;border:1px solid #cccccc;">订单号/交易订单号</th>
        <th style="border:1px solid #cccccc;">验证结果</th>
      </tr>
    </thead>
    <tbody id="batchImportOrderTableBody"></tbody>
  </table>
</div>

<iframe src="" name="hiddenAjaxIframe" id="hiddenAjaxIframe" style="display:block;width:1px;height:1px;overflow:hidden;border:0;"></iframe>

<script type="text/javascript">
	var actionLabel='<{$actionLabel}>';
	
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
            		html+='<td colspan="6" style="text-align:center;"><b><{t}>not_select_product_yet<{/t}></b></td></tr>';
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
   parent.openMenuTab(url,"<{t}>ReturnASNList<{/t}>",'ReturnASNList','1');
   
}



function changeWeight(product_id, productWeight, val) {
    	if(/^\d+$/.test(val)) {
			var sku = $('#psku'+product_id),
				weight = Number(productWeight),
				val = parseInt(val);
			sku.text(Math.round(weight*val*1000)/1000);
			countWeight();
                                                            countPCE();
        }    	
}
/*计算重量*/
function countWeight() {
		var total = 0;
		$("#asnproducts td[id^='psku']").each(function(){
			var number_text = $(this).text();
			
			total += Number(parseFloat(number_text));
			//psku<{$detail.product_id}>		
		});
		$('#total_weight').text(Math.round(total*1000)/1000);
}

function countPCE(){
    var total = 0;
    $("#asnproducts td input[id^='pceSku']").each(function(){
            var number_text = $(this).val();
            total += Number(parseFloat(number_text));		
    });
    $('#total_PCE').text(Math.round(total*1000)/1000);
}


function selectedOrder(){

<{if !isset($receiving)}>
       if($('#order_code').val()!=''){
            $('.tableborder').show();            
            $('.pageFormContent tr').show();
            $('.jiahuowarehouse').show();
            $('#select_order').hide();
            $('#batchImportOrder').hide();
			show_amount_box_by_shipping_pay_party();
			
        }else{
            $('.tableborder').hide();          
            $('.pageFormContent tr').hide();
            $('.jiahuowarehouse').show();
            $('#select_order').show();
        }		
<{/if}>   
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
                html += '<td><a href="/merchant/product/detail/productId/'+productId+'" target="_blank" onclick="parent.openMenuTab(\'/merchant/product/detail?productId='+productId+'\',\'<{t}>ProductDetail<{/t}>('+productSku+')\',\'productdetail'+productId+'\');return false;">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                html += '<td title="'+productName+'">' + productName + '</td>';
                html += '<td>' + category + '</td>';
                html += '<td><input readonly="readonly" type="text" class="inputbox inputMinbox" id="pceSku'+productId+'" name="sku[' + productId + ']" value="'+number+'" size="6" onkeyup="changeWeight('+productId+','+productWeight+',this.value)"></td>';
                html += '<td id="psku' + productId + '">'+number*productWeight+'KG</td>';  
				
                html += '</tr>';
                $("#asnproducts").append(html);
				
            }
        
    });	if(typeof(countPCE)!='undefined'){countPCE();}	
	if(typeof(countWeight)!='undefined'){countWeight();}
	if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
	if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
                   
                    

}

/**
 * 上传订单数据文件验证
 */
function batchImportOrderData() {
  var file = $.trim($('#batchImportOrderForm').find('[name="order_file"]').val());

  if ('' === file) {
    alertTip('请上传订单数据文件');
  }
  else if (!/\.xls|\.xlsx$/.test(file)) {
    alertTip('订单数据文件只支持.xls/.xlsx文件格式');
  }
  else {
    $('#batchImportOrderTableBody').html('<tr class="even"><td colspan="2" class="invalid" style="border:1px solid #cccccc;"><img src="/images/loading.gif" />&nbsp;&nbsp;&nbsp;&nbsp;正在上传处理订单数据，请勿进行其他操作</td></tr>');
    $('#batchImportOrderForm').submit();
    $('#batchImportOrderForm').find('[name="order_file"]').val('');
  }
}

$(document).ready(function(){
	<{if isset($receiving)}>
	if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
	if(typeof(countWeight)!='undefined'){countWeight();}
	<{/if}>
	
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
	
	
	
	<{if isset($receiving) }>
	  
	 <{else}>           
		selectedOrder();
		//getAimWarehouse();
	<{/if}>
	
  // 批量导入对话框
  $('#batchImportOrderDialog').dialog({
    autoOpen: false,
    modal: false,
    bgiframe: true,
    position: [150, 50],
    width: 600,
    resizable: true,
    close : function () {
      $('#batchImportOrderForm').find('[name="order_file"]').val('');
    }
  });

  // 批量导入按钮
  $('#batchImportOrder').click(function (e) {
    $('#batchImportOrderDialog').dialog('open');
  });
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
   		html='<{t}>order_code_required<{/t}>'; 
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
						
					$('#order_code_title').html('<{t}>orderCode<{/t}>:');						
					$('#order_code').attr('readonly','true');										                  
					insertProductRow(json);
					selectedOrder();
			} else {			
					if (typeof(json.error) != "undefined"){
						html+=json.error+"<br/>";
					}
                    html = html.replace(/,/g, "")
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
</script>