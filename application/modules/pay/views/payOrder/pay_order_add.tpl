<script src="/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<style type="text/css">
	#distributor-pagination{display: block;padding: 5px 0;clear: both;}
	#distributor-pagination span{padding: 5px 8px;border: 1px solid #cccccc;margin-right: 5px;cursor: pointer;}
	#distributor-pagination span.current{color: #cccccc;cursor: text;}
</style>
<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><{if empty($payOrderData)}><{t}>add_pay_order<{/t}><{else}><{t}>edit_pay_order<{/t}><{/if}></h3>
        <div class="clear"></div>
    </div>
	<form method="post" id="payOrderForm" class="pageForm required-validate">
		<fieldset>
	        <table>
				<tbody>
					<{if empty($payOrderData)}>
						<tr>
							<td class="form_title nowrap text_right"><{t}>支付企业<{/t}>：</td>
							<td>
								<span class="blue"><{$customer.code}>-<{$companyInfo.trade_name}></span>
								<input type="hidden" name="pay_customer_code" value="<{$customer.code}>" />
								<input type="hidden" name="pay_account_code" value="<{$customer.account_code}>" />
								<input type="hidden" name="pay_enp_name" value="<{$companyInfo.trade_name}>">
							</td>
						</tr>
						<tr>
							<td class="form_title nowrap text_right"><{t}>app_type<{/t}>：</td>
							<td class="form_input">
								<span class="blue">新增</span>
								<input type="hidden" name="app_type" id="app_type" value="1"/>
							</td>
						</tr>
					<{else}>
						<tr>
							<td class="form_title nowrap text_right"><{t}>支付企业<{/t}>：</td>
							<td>
								<span class="blue"><{$payOrderData.pay_customer_code}>-<{$payOrderData.pay_enp_name}></span>
								<input type="hidden" name="pay_customer_code" value="<{$payOrderData.pay_customer_code}>" />
								<input type="hidden" name="pay_account_code" value="<{$payOrderData.pay_account_code}>" />
								<input type="hidden" name="pay_enp_name" value="<{$payOrderData.pay_enp_name}>" />
							</td>
						</tr>
						<tr>
							<td class="form_title nowrap text_right"><{t}>app_type<{/t}>：</td>
							<td class="form_input">
								<span class="blue">变更</span>
								<input type="hidden" name="app_type" id="app_type" value="2"/>
							</td>
						</tr>
					<{/if}>
					<!--
					<tr>
						<td class="form_title nowrap text_right"><{t}>orderCode<{/t}>：</td>
						<td class="form_input">
							<input type="text" name="order_code" id="order_code" class="fix-medium1-input required text-input" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.order_code}><{$payOrderData.order_code}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>Trading_Order_No_maximum_length_of_18<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					-->
					<tr>
						<td class="form_title nowrap text_right"><{t}>CustomerReference<{/t}>：</td>
						<td class="form_input"><input name="reference_no" id="reference_no" type="text" class="orderInfo text-input fix-medium1-input" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.reference_no}><{$payOrderData.reference_no}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>请输入交易订单号<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right">电商平台代码：</td>
						<td class="form_input">
							<input type="text" name="ecommerce_platform_customer_code" id="ecommerce_platform_customer_code" class="orderInfo fix-medium1-input required text-input" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.ecommerce_platform_customer_code}><{$payOrderData.ecommerce_platform_customer_code}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="请输入<{t}>ecommerce_platform_customer_code<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>ecommerce_platform_customer_name<{/t}>：</td>
						<td class="form_input">
							<input type="text" name="ecommerce_platform_customer_name" id="ecommerce_platform_customer_name" class="orderInfo fix-medium1-input required text-input" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.ecommerce_platform_customer_name}><{$payOrderData.ecommerce_platform_customer_name}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="请输入<{t}>ecommerce_platform_customer_name<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>电商企业代码<{/t}>：</td>
						<td class="form_input">
							<input name="customer_code" id="customer_code" class="orderInfo fix-medium1-input text-input" type="text" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.customer_code}><{$payOrderData.customer_code}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>请输入电商企业代码<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>enp_name<{/t}>：</td>
						<td class="form_input">
							<input name="enp_name" id="enp_name" class="orderInfo fix-medium1-input text-input" type="text" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.enp_name}><{$payOrderData.enp_name}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="请输入<{t}>enp_name<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					
					
					<tr>
						<td class="form_title nowrap text_right"><{t}>payNo<{/t}>：</td>
						<td class="form_input">
							<input type="text" name="pay_no" id="pay_no" class="fix-medium1-input required text-input" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.pay_no}><{$payOrderData.pay_no}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>Trading_Order_No_maximum_length_of_18<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>cosignee_name<{/t}>：</td>
						<td class="form_input">
							<input type="text" name="cosignee_name" id="cosignee_name" size="10" class="fix-medium1-input text-input" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.cosignee_name}><{$payOrderData.cosignee_name}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>please_enter_the_consignee_name<{/t}>" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>cosignee_code<{/t}>：</td>
						<td class="form_input">
							<input type="text" name="cosignee_code" id="cosignee_code" size="10" class="fix-medium1-input text-input" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.cosignee_code}><{$payOrderData.cosignee_code}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>请输入支付人证件号码<{/t}>" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right">支付币制：</td>
						<td class="form_input">
							<select name='pay_currency_code' class="fix-medium2-input">
			                    <{foreach from=$currencyAll key=curId item=currency}>
			                        <option value='<{$currency.currency_code}>' <{if (!empty($payOrderData) && ($currency.currency_code == $payOrderData.pay_currency_code)) || ($currency.currency_code == 'RMB') }>selected="selected"<{/if}>><{$currency.currency_code}>-<{$currency.currency_name}></option>
			                    <{/foreach}>
			                </select>
			                <strong>*</strong>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>pay_amount<{/t}>：</td>
						<td class="form_input">
							<input type="text" name="pay_amount" id="pay_amount" size="10" class="fix-medium1-input text-input" placeholder="<{t}>0.00<{/t}>" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.pay_amount}><{$payOrderData.pay_amount}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>请输入支付金额<{/t}>" onclick="return false;"><img src="/images/help.png"/></a>
						</td>
					</tr>
                    <tr>
                        <td class="form_title nowrap text_right">支付时间：</td>
                        <td class="form_input">
                            <input name="pay_time" id='pay_time' class="datepicker text-input width140" value="<{$smarty.now|date_format:"%Y-%m-%d"}>" readonly/>&nbsp;
                        <span><strong>*</strong></span>
                        </td>
                    </tr>

					<tr>
                       	<td class="form_title nowrap text_right"><{t}>note<{/t}>：</td>
                       	<td>
                       		<textarea cols="50" rows="3" name="note"><{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.note}><{$payOrderData.note}><{/if}></textarea>
                       	</td>
					</tr>
               		<tr>
						<td class="form_title"></td>
						<td class="form_input">
							<input type="hidden" name="po_id" value="<{if isset($payOrderData)&&!empty($payOrderData)&&$payOrderData.po_id}><{$payOrderData.po_id}><{/if}>" />
							<{if empty($payOrderData)}>
								<a href="javascript:void(0)" class="button tijiao" onclick="addSubmit();return false;"><{t}>submit<{/t}></a>
							<{else}>
								<input type="hidden" name="po_code" value="<{$payOrderData.po_code}>" />
								<a href="javascript:void(0)" class="button tijiao" onclick="editSubmit(<{$payOrderData.po_id}>);return false;"><{t}>DistributorOperationSave<{/t}></a>
							<{/if}>
						</td>
					</tr> 
				</tbody>
	        </table>
        </fieldset>
        <div class="clear"></div>
        <div class="infoTips" id="commonPayTip" title="<{t}>InformationTips<{/t}>"></div>
	</form>
</div>
<script type="text/javascript">
$(function(){

    var dayNamesMin = ['日', '一', '二', '三', '四', '五', '六'];
    var monthNamesShort = ['01月', '02月', '03月', '04月', '05月', '06月', '07月', '08月', '09月', '10月', '11月', '12月'];
    $.timepicker.regional['ru'] = {
        timeText: '选择时间',
        hourText: '小时',
        minuteText: '分钟',
        secondText: '秒',
        millisecText: '毫秒',
        currentText: '当前时间',
        closeText: '确定',
        ampm: false
    };
    $.timepicker.setDefaults($.timepicker.regional['ru']);

    $('#input_date').datetimepicker({
        dayNamesMin: dayNamesMin,
        monthNamesShort: monthNamesShort,
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

    //时间控件
    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});

	//公用提示信息
	$('#commonPayTip').dialog({
		autoOpen: false,
		modal: true,
		position:['center', 100],
		bgiframe:true,
		width: 400,
		height: 'auto',	
		resizable: true,
		title: '提示信息(按ESC关闭)',
		buttons: {
	            '<{t}>close<{/t}>': function() {
	                $(this).dialog('close');
	            }
		},
		close: function() {
			
		}
	});

	//获取订单相关信息
	/*
	$('#order_code').blur(function (){
	    var order_code = $(this).val();
	    var myoptions = {
	        url: '/pay/pay-order/get-order-info-by-order-code',
	        type: 'POST',
	        cache: false,       
	        dataType: 'json',
	        processData: true,
	        data: {'order_code': order_code},
	        success: function(json){
	            if(json.ask==1){
	                $('#order_code').css({'border-color':''});
	                $('#enp_name').val(json.data);
	                $.each( json.data, function(key, val) {
						$('#'+key).val(val);
					});
	            }else {
	                $("#commonPayTip").html(json.message);
	                $('#commonPayTip').dialog('open');
	                $('#order_code').css({'border-color':'#a94442'});
	                $('.orderInfo').val('');
				//	$('#order_code').focus();
	            }
	        }, error:function(a,b,c){
	            $("#commonPayTip").html("system error");
	            $('#commonPayTip').dialog('open');
	        }
	    }; 
	    //显示操作提示
	    $.ajax(myoptions);
	});
	*/
});

/*是否为合格的URL*/
function isurl(str_url){
    // var strregex = "(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])?";
    //var re=new RegExp(strregex);
    var regexp = new RegExp("(http[s]{0,1})://[a-zA-Z0-9\\.\\-]+\\.([a-zA-Z]{2,4})(:\\d+)?(/[a-zA-Z0-9\\.\\-~!@#$%^&amp;*+?:_/=<>]*)?", "gi");
    if (regexp.test(str_url)){
        return (true);
    }else{
        return (false);
    }
}

//处理表单数据
function addSubmit(){
 	var formdata =  $("#payOrderForm").serialize();
 	/*
 	// var order_code = $("[name='order_code']").val();
    var customer_code = $('[name="customer_code"]').val();
    var reference_no = $('[name="reference_no"]').val();
    var status = $('[name="status"]').val();
    var goods_value = $('[name="goods_value"]').val();
    var freight_fee = $('[name="freight_fee"]').val();
    var pay_currency_code = $('[name="pay_currency_code"]').val();
    var cosignee_name = $('[name="cosignee_name"]').val();
    var cosignee_code = $('[name="cosignee_code"]').val();
    var cosignee_address = $('[name="cosignee_address"]').val();
    var cosignee_telephone = $('[name="cosignee_telephone"]').val();
    var cosignee_country_id = $('[name="cosignee_country_id"]').val();
    var pro_amount = $('[name="pro_amount"]').val();
    var pro_remark = $('[name="pro_remark"]').val();
    var note = $('[name="note"]').val();
    var errorHtml = "";
    // if(order_code==""){
    //     errorHtml += '<{t}>please_enter_order_code<{/t}></br>';
    // }
    if(customer_code==""){
        errorHtml += "<{t}>please_enter_the_customer_encoding<{/t}>;</br>";
    }
    if(reference_no==""){
        errorHtml += "<{t}>please_enter_the_customer_reference_number<{/t}>;</br>";
    }
    if(status==""){
        errorHtml += "<{t}>please_choose_to_pay_a_single_state<{/t}>;</br>";
    }
    if(goods_value==""){
        errorHtml += "<{t}>请输入订单商品货款;<{/t}></br>";
    }
    if(freight_fee==""){
        errorHtml += "<{t}>请输入订单商品运费;<{/t}></br>";
    }
    if(pay_currency_code==""){
        errorHtml += "<{t}>请选择币种;<{/t}></br>";
    }
    if(cosignee_country_id==""){
        errorHtml += "<{t}>请选择支付人所在国家;<{/t}></br>";
    }
    if(cosignee_code == ''){
    	errorHtml += "<{t}>请输入支付人证件号码;<{/t}></br>";
    }
    if(cosignee_name==""){
        errorHtml += "<{t}>请输入支付人姓名;<{/t}></br>";
    }
    if(cosignee_address==""){
        errorHtml += "<{t}>请输入支付人地址;<{/t}></br>";
    }
    if(cosignee_telephone==""){
        errorHtml += "<{t}>请输入支付人电话;<{/t}></br>";
    }
    if(pro_amount==""){
        errorHtml += "<{t}>请输入优惠金额;<{/t}></br>";
    }
    
    if(errorHtml!=""){
		$("#commonPayTip").html(errorHtml);
		$('#commonPayTip').dialog('open');
        return false;
    }
    */
    var po_id = $('#po_id').val();
	var myoptions = {
		url:'/pay/pay-order/add-save', //提交给哪个执行
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:formdata,
		//dataType:'html',
		success: function(json){
			if(json.ask == 1){
				$('#payOrderForm')[0].reset();
				/*
				if(po_id==''){
					$('#payOrderForm')[0].reset();
				}
				*/
			}
			var messages = '';
			if(typeof json.message=='object'){
				$.each(json.message, function(k, v){
					messages += v + '<br />';
				});
			}else{
				messages = json.message;
			}
			$("#commonPayTip").html(messages);
			$('#commonPayTip').dialog('open');
		}, error:function(a,b,c){
			$("#commonPayTip").html("system error");
			$('#commonPayTip').dialog('open');
		}
	}; 
	//显示操作提示
	$.ajax(myoptions); 
	return false;
}

//编辑
function editSubmit(poId){
	var formdata =  $("#payOrderForm").serialize();
	var poId = $('#poId').val();
	var myoptions = {		
		url:'/pay/pay-order/edit-save', //提交给哪个执行
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:formdata,
		//dataType:'html',
		success: function(json){
			if(json.ask==1){
				if(poId==''){
					payOrderForm.reset();
				}
			}
			var messages = '';
			if(typeof json.message=='object'){
				$.each(json.message,function(k,v){
					messages += v+'<br />';
				});
			}else{
				messages = json.message;
			}
			$("#commonPayTip").html(messages);
			$('#commonPayTip').dialog('open');
		}, error:function(a,b,c){
			$("#commonPayTip").html("system error");
			$('#commonPayTip').dialog('open');
		}
	}; 
	//显示操作提示
	$.ajax(myoptions); 
	return false;
}

function alertTip2(tip,width,height,notflash) {
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<{t}>InformationTips<{/t}>"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
		position:['center', 'top'],
        height: height,
        modal: false,
        show:"slide",
        buttons: {
            '<{t}>close<{/t}>': function() {
                $(this).dialog('close');
                if(!(typeof(notflash)!="undefined" && notflash=='1')){
                    //$('#pagerForm').submit();
                    parent.openMenuTab('/merchant/product','<{t}>ProductList<{/t}>','ProductList','1');
                }
            }
        },
        close: function() {
            //window.location.href='/merchant/product';			
			parent.openMenuTab('/merchant/product','<{t}>ProductList<{/t}>','ProductList','1');
        }
    });
}
</script>