<style>
.width180 {
	width: 180;
}

form span {
	color: red;
}

.topButDiv #dialog_link {
	float: left;
	display: block;
	padding: 10px;
	margin-bottom: 5px;
}
</style>
<script type="text/javascript" src="/js/artTemplate/template.js"></script>
<script src="/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/jquery-fileUpload.js"></script>
<div class="topButDiv cl">
	<a href="javascript:;" disabled='ture' title="<{t}>SelectProduct<{/t}>"
		id="dialog_link" class="ui-state-default  ui-corner-all nowarp">上传产品</a>
	<span class="jiahuowarehouse1"
		style="margin-left: 5px; margin-top: 12px; display: block; float: left; color: red; font-size: 1.1em">*</span>
	<!-- <a href="javascrip:;" title="<{t}>ProductImport<{/t}>" id="xls_input_link" class="ui-state-default  ui-corner-all nowarp" style="float:left;display:block;padding:10px; margin-left:5px;margin-bottom:5px;" ><{t}>ProductImport<{/t}></a> -->
</div>
<form action="/merchant/personal-items/add-save" method='POST' id='orderForm' class="pageForm required-validate">
	<fieldset>
		<div style="margin:0 0 10px 0" class="nbox_c marB10">
			<table cellspacing="0" cellpadding="0" class="tableborder formtable">
				<thead>
                <tr id="error" style="display:none">
                    <td colspan="12" id="product-table-message_tip" class="error"></td>
                </tr>
					<tr>
                        <td>海关商品备案编号</td>
                        <td>行邮税号</td>
                        <td>商品序号</td>
                        <td>料件号</td>
                        <td>商品条码</td>
                        <td>海关编码</td>
                        <td>申报单价</td>
                        <td>数量</td>
                        <td>币制</td>
                        <td>商品名称</td>
                        <td>规格型号</td>
                        <td>申报单位</td>
                        <td>目的国</td>
					</tr>
					<!--
						<tr>
							<td colspan="10"   style="text-align:center"><span  style="color:red">请选择产品</span></td>
						</tr>
					-->
				</thead>
			</table>
			<div class="clear"></div>
		</div>
		<table class="pageFormContent">
			<tbody>
                <tr>
                    <td class="form_title nowrap text_right">清单企业内部编号：</td>
                    <td>
                        <input class="text-input width140 ui-autocomplete-input" type="text" id="gl_reference_no" name="gl_reference_no" value="<{if !empty($data)}><{$data.gl_reference_no}><{/if}>">
                    </td>
                    <td class="form_title nowrap text_right">业务类型：</td>
                    <td width='245'>
                        <select name="form_type" class="width155">
                            <option value="">-Select-</option> <{foreach from=$formType item=w
                            name=w}>
                                <option value='<{$w.form_type}>'><{$w.form_type_name}></option>
                            <{/foreach}>
                        </select>
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>申报口岸：</td>
                    <td width='245'>
                        <select name="declare_ie_port" id='declare_ie_port' class="text-input width155">
                            <option value="">-Select-</option>
                            <{foreach from=$iePorts item=w name=w}>
                                <option value='<{$w.ie_port}>'><{$w.ie_port_name}></option>
                            <{/foreach}>
                        </select>&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'><{t}>进出口岸<{/t}>：</td>
                    <td width='245'>
                        <select name="ie_port" id='ie_port' class="text-input width155">
                            <option value="">-Select-</option>
                            <{foreach from=$iePorts item=w name=w}>
                                <option value='<{$w.ie_port}>'><{$w.ie_port_name}></option>
                            <{/foreach}>
                        </select>&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>启运国/运抵国：</td>
                    <td width='245'>
                        <select name="departure_or_destination_country" id="departure_or_destination_country" class="text-input width155">
                            <option value="">-Select-</option>
                            <{foreach from=$country item=c name=c}>
                                <option value='<{$c.country_id}>'<{if isset($orderInfo)&&$orderInfo.oab_country_id==$c.country_id}> selected<{/if}> ><{$c.country_code}> <{$c.country_name}></option>
                            <{/foreach}>
                        </select>
                        <span><strong>*</strong></span>
                    </td>

                    <td style="text-align: right" width='175'>指运港：</td>
                    <td width='245'>
                        <select name="port_of_departure" id="port_of_departure" class="text-input width155">
                            <option value="">-Select-</option>
                            <{foreach from=$country item=c name=c}>
                                <option value='<{$c.country_id}>'<{if isset($orderInfo)&&$orderInfo.oab_country_id==$c.country_id}> selected<{/if}> ><{$c.country_code}> <{$c.country_name}></option>
                            <{/foreach}>
                        </select>
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <!--<tr>
                    <td style="text-align: right" width='175'><{t}>exit_time<{/t}>：</td>
                    <td width='245'>
                        <input type="text" class="datepicker text-input width140" value="" name="exit_time" id="exit_time" readonly="readonly" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>-->

                <tr>
                    <td style="text-align: right" width='175'><{t}>AccessPortTransport<{/t}>：</td>
                    <td width='245'>
                        <select class="text-input width155" id="traf_mode" name="traf_mode">
                            <{foreach from=$traf item=c name=c}>
                                <option value='<{$c.tfm_id}>'<{if !empty($data) && $data.traf==$c.tfm_id}> selected<{elseif $c.traf_mode_name=='公路运输'}> selected<{/if}> ><{$c.traf_mode_name}></option>
                            <{/foreach}>
                        </select>&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>运输工具名称：</td>
                    <td width='245'>
                        <input name="traf_name" id='traf_name' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'><{t}>wrap_type<{/t}>：</td>
                    <td width='245'>
                        <select name="wrap_type" id='wrap_type' class="text-input width155">
                            <option value="">-Select-</option> <{foreach from=$wrapType item=w
                            name=w}>
                                <option value='<{$w.wrap_type}>'><{$w.wrap_type_name}></option>
                            <{/foreach}>
                        </select>
                         <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>监管场所代码：</td>
                    <td width='245'>
                        <input name="customs_field" id='customs_field' class="text-input width140" value="" />
                    </td>
                </tr>

                 <tr>
                    <td style="text-align: right" width='175'>报关员：</td>
                    <td width='245'>
                        <input name="declare_no" class="text-input width140" value="<{$customer.account_name}>">
                    </td>
                    <td style="text-align: right" width='175'>申报日期：</td>
                    <td width='245'><input name="declare_date" id='declare_date'
                                           class="datepicker text-input width140" value="<{$smarty.now|date_format:"%Y-%m-%d"}>" readonly />
                    </td>
                </tr>

                <!--<tr>
                    <td style="text-align: right" width='175'><{t}>declare_time<{/t}>：</td>
                    <td width='245'>
                        <input type="text" class="datepicker text-input width140" value="" name="declare_time" id="declare_time" readonly="readonly" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>-->

                <tr>
                    <td style="text-align: right" width='175'>录入员：</td>
                    <td width='245'>
                        <input name="input_no" id='input_no' class="text-input width140" value="<{$customer.account_name}>"  />
                    </td>
                    <td style="text-align: right" width='175'>录入时间：</td>
                    <td width='245'>
                        <input name="input_date" id='input_date' class="datepicker text-input width140" value="<{$smarty.now|date_format:"%Y-%m-%d"}>" readonly/>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>录入单位：</td>
                    <td width='245'>
                        <input name="input_company" id='input_company' class="text-input width140" value="<{$companyInfo['customer_company_name']}>" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>单位地址：</td>
                    <td width='245'>
                        <input name="agent_address" id='agent_address' class="text-input width140" value="<{$companyInfo['customer_address']}>" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>单位邮编：</td>
                    <td width='245'>
                        <input name="agent_post" id='agent_post' class="text-input width140" value="<{$companyInfo['customer_postno']}>" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>单位电话：</td>
                    <td width='245'>
                        <input name="agent_tel" id='agent_tel' class="text-input width140" value="<{$companyInfo['customer_telephone']}>" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>电商企业代码：</td>
                    <td width='245'>
                        <input name="customer_code" id='customer_code' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>电商企业名称：</td>
                    <td width='245'>
                        <input name="enp_name" id='enp_name' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>仓储企业代码：</td>
                    <td width='245'>
                        <input type="hidden" name="storage_customer_code" value="<{$companyInfo.customer_code}>" />
                        <span class="blue"><{$companyInfo.customer_code}></span>
                    </td>
                    <td style="text-align: right" width='175'>仓储企业名称：</td>
                    <td width='245'>
                        <input type="hidden" name="storage_name" value="<{$companyInfo.trade_name}>" />
                        <span class="blue"><{$companyInfo.trade_name}></span></td>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>申报单位代码：</td>
                    <td width='245'>
                        <input type="hidden" name="agent_customer_code" value="<{$companyInfo.customer_code}>" />
                        <span class="blue"><{$companyInfo.customer_code}></span>
                    </td>
                    <td style="text-align: right" width='175'>申报单位名称：</td>
                    <td width='245'>
                        <input type="hidden" name="agent_name" value="<{$companyInfo.trade_name}>" />
                        <span class="blue"><{$companyInfo.trade_name}></span></td>
                    </td>
                </tr>

                <tr>
                    <!-- <td style="text-align: right" width='175'>客户订单号：</td> -->
                    <td style="text-align: right" width='175'>交易订单号：</td>
                    <td width='245'>
                        <input name="reference_no" id='reference_no' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>支付单号：</td>
                    <td width='245'>
                        <input name="pay_no" id='pay_no' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'><{t}>wb_code<{/t}>：</td>
                    <td width='245'>
                        <input name="log_no" id='log_no' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>提运单号：</td>
                    <td width='245'>
                        <input name="bill_no" id='pay_no' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>航班(次)号：</td>
                    <td width='245'>
                        <input name="flight_or_voyage_number" id='flight_or_voyage_number' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>运费：</td>
                    <td width='245'>
                        <input name="freight" id='freight' class="text-input width140" value="" />
                    </td>
                    <td style="text-align: right" width='175'>保费：</td>
                    <td width='245'>
                        <input name="insure_fee" id='insure_fee' class="text-input width140" value="" />
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>净重：</td>
                    <td width='245'>
                        <input name="net_weight" id='net_weight' class="text-input width140" value="" />
                    </td>
                    <td style="text-align: right" width='175'>毛重：</td>
                    <td width='245'>
                        <input name="gross_weight" id='gross_weight' class="text-input width140" value="" />
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>件数：</td>
                    <td width='245'><input name="pack_no" id='pack_no'
                                           class="text-input width140" value="" />
                    </td>
                    <td style="text-align: right" width='175'>进出境日期：</td>
                    <td width='245'>
                        <input name="ie_date" id='i_e_date' class="datepicker text-input width140" value="<{$smarty.now|date_format:"%Y-%m-%d"}>" readonly />
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>收(发)货人代码：</td>
                    <td width='245'>
                        <input name="owner_code" id='owner_code' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>收(发)货人名称：</td>
                    <td width='245'>
                        <input name="owner_name" id='owner_name' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>许可证号：</td>
                    <td width='245'>
                        <input name="cus_license" id='cus_license' class="text-input width140" value="" />&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>填制日期：</td>
                    <td width='245'>
                        <input name="filled_date" id='filled_date' class="datepicker text-input width140" value="<{$smarty.now|date_format:"%Y-%m-%d"}>" readonly/>&nbsp;
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'><{t}>note<{/t}>：</td>
                    <td colspan="3"><textarea style="width: 580px; height: 70px;" name="note"></textarea></td>
                </tr>
                <tr>
                    <td style="text-align: right">&nbsp;</td>
                    <td colspan='3'><a href="javascript:;" class="button tijiao" id="orderbutton" onclick="addSubmit();return false;"><{t}>submit<{/t}></a></td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</form>

<script id="product-excel-list" type="text/html">
    {{each error as product key}}
    <p class="product-table-return-message">
        <span class="msg-box n-default-product n-right"><span class="msg-wrap n-error" role="alert"><span class="n-msg ">备案编号[{{key}}]:</span></span></span>
        {{each product as e}}
        <span class="msg-box n-default-product n-right"><span class="msg-wrap n-error" role="alert"><span class="n-msg ">{{e}}</span></span></span>
        {{/each}}
    </p>
    {{/each}}
</script>

<script id="product-list-success" type="text/html">
    {{each success as product key}}
    <tr class="product-table-return-message product-item">
        <td>
            {{product.register_id}}
            <input type="hidden" value="{{product.register_id}}" name="product[{{key}}][register_id]" />
        </td>
        <td>
            {{product.code_tx}}
            <input type="hidden" value="{{product.code_tx}}" name="product[{{key}}][code_tx]" />
        </td>
        <td>
            {{product.g_no}}
            <input type="hidden" value="{{product.g_no}}" name="product[{{key}}][g_no]" />
        </td>
        <td>
            {{product.goods_id}}
            <input type="hidden" value="{{product.goods_id}}" name="product[{{key}}][goods_id]" />
        </td>
        <td>
            {{product.product_barcode}}
            <input type="hidden" value="{{product.product_barcode}}" name="product[{{key}}][product_barcode]" />
        </td>
        <td>
            {{product.hs_code}}
            <input type="hidden" value="{{product.hs_code}}" name="product[{{key}}][hs_code]" />
        </td>
        <td>
            {{product.price}}
            <input type="hidden" value="{{product.price}}" name="product[{{key}}][price]" />
        </td>
        <td>
            {{product.g_qty}}
            <input type="hidden" value="{{product.g_qty}}" name="product[{{key}}][g_qty]" />
        </td>
        <td>
            {{product.currency}}
            <input type="hidden" value="{{product.currency}}" name="product[{{key}}][currency]" />
        </td>

        <td>
            {{product.g_name_cn}}
            <input type="hidden" value="{{product.g_name_cn}}" name="product[{{key}}][g_name_cn]" />
        </td>

        <td>
            {{product.g_model}}
            <input type="hidden" value="{{product.g_model}}" name="product[{{key}}][g_model]" />
        </td>
        <td>
            {{product.g_unit_name}}
            <input type="hidden" value="{{product.g_unit}}" name="product[{{key}}][g_unit]" />
        </td>
        <td>
            {{product.country}}
            <input type="hidden" value="{{product.country}}" name="product[{{key}}][country]" />
        </td>
    </tr>
    {{/each}}
</script>


<!-- 选择产品dialog begin -->
<div id="dialog" title="<{t}>选择商品<{/t}>">
    <table class="form-table" style="width: 100%;" border="1">
        <tr>
            <td colspan="2">
                <span>下载模板：</span>
                <a href="/template/goods-list-detail.xlsx" target="_blank">商品上传模板</a>
            </td>
        </tr>
        <tr>
            <td class="form_title nowrap text_right">
                选择要上传的文件
            </td>
            <td class="form_input">
                <input type="file" class="input-file" id="dialogInputForExcel" />
            </td>
        </tr>
        <tr>
            <td colspan="3"><input type="button" id="dialogButtonForExcel" value="上传" class="form-input "></td>
        </tr>
    </table>
</div>
<!-- 选择产品 dialog end -->

<script type="text/javascript">
    $(function(){
        $(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});
    })
//省份
/*$("#receive_state").autocomplete({
	minLength: 0,
	source: function(request, response) {
	        var term = request.term;
	        if(term) {
	            term = term.toUpperCase();
	            $("#receive_state").val(term);
	        }
	        $.post('/merchant/order/province', {'country_id':$('#receive_country_name').val(),'term':term},function(data){
	            response(data);
	    }, 'json');
	}
}).focus(function() {
    $('#receive_state').autocomplete("search", "");
});

//城市
$("#receive_city").autocomplete({
    minLength: 0,
    source: function(request, response) {
	        var term = request.term;
	        if(term) {
	            term = term.toUpperCase();
	            $("#receive_city").val(term);
	        }
	        $.post('/merchant/order/city', {'country_id':$('#receive_country_name').val(),'province_id':$("#receive_state").val(),'term':term},function(data){
	            response(data);
	    }, 'json');
	}
}).focus(function() {
    $('#receive_city').autocomplete("search", "");
});*/



//保存
function addSubmit(){
	// alertTip('保存成功~');
    var id = $('#id').val();
    $.ajax({
        type:"post",
        dataType:"json",
        async:false,
        url:'/merchant/goods-list/add-save',
        data:$('#orderForm').serialize(),
        success:function(json){
            // if(json.ask==1){
            //     alertTip('保存成功~');
            //     // if(id==''){
            //     //     orderForm.reset();
            //     // }
            // }
            var msg = '';
            if(json.ask==0){
                msg+=json.message+'<br />';
                $.each(json.error,function(k,v){
                    msg += v+'<br />';
                });
            }else{
                msg = json.message;
                $('#orderForm')[0].reset();
            }
            alertTip(msg);
        }
    });
}

//得到订单信息 -- 暂未用
function getOrderList(){
    var orderData = $("#pagerForm").serialize();
    // alert(orderData);
    //orderData+="&warehouse_id=" + $('#warehouseId').val();
    if($('.aimwarehouses').size()>0){
        orderData += "&to_warehouse=" + $('[name=to_warehouse]').val();
    }
    orderData += "&from=asn";
    $.ajax({
        type:'post',
        url:'/merchant/product/repository?customer=true',
        data:orderData,
        dataType:'html',
        success:function(html){
            $("#dialog").html(html);
        }
    });
    $('#dialog').dialog('open');
}
//未选择产品
function getRipOfNodataRow(){
	 var dataRows = $("#orderproducts tr:not(.norowdata)").size();
	 
	 if(dataRows>0){
	   $('.norowdata').remove();
	 }else{	 	 	
	 	var html='<tr class="norowdata">\n';
           html+='<td colspan="6" style="text-align:center;"><b><{t}>not_select_product_yet<{/t}></b></td></tr>';
			$("#orderproducts").append(html);		
	 }
}



readAsText.init({
    url:"/merchant/goods-list/find-product",
    element:'#dialogInputForExcel',
    triggerElement: '#dialogButtonForExcel',
    success:function(json){
        $('.product-table-return-message').remove();
        $('#error').hide();
        if(json.ask == 0){
            var msghtml = template('product-excel-list', json);
            $('#product-table-message_tip').html(msghtml);
            $('#error').show();
        }else if(json.ask == 1){
            var successHtml = template('product-list-success', json);
            $(successHtml).appendTo('.tableborder');
        }
        $('#dialog').dialog('close');
    }
});


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

	//产品浏览
	$('#dialog_link').click(function(){
		//获取产品信息
        $('#dialog').dialog('open');
	});

	//选择产品
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
                    html += '<td><a onclick="window.parent.openMenuTab(\'merchant/product/detail/productId/' + productId + '\',\'产品详情\',\'product-detail\');return false;">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                    html += '<td title="'+productName+'">' + productName + '</td>';
                    html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" onkeyup="changeWeight('+productId+','+productWeight+',this.value)" value="1" size="6">&nbsp;<strong>*</strong></td>';
                    html += '<td id="sku'+productId+'">'+productWeight+'</td>';
                    // 不分仓库了，所有的交易价格、成交单价都必填
                    html += '<td><input type="text" class="inputbox inputMinbox price" name="price['+productId+']" size="6"><span class="red">*</span> </td>';
                    html += '<td><input type="text" class="inputbox inputMinbox total_price" name="total_price['+productId+']" size="6" disabled="disabled"><span class="red">*</span> </td>';
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
        //if(typeof(countWeight)!='undefined'){countWeight();}
		if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
    });
	
	//导入XML
    $('#xls_input_link').click(function(){
        $('#XLSInputBox').dialog('open');
    });

	
    $('#XLSInputBox').dialog({
        autoOpen: false,
        modal: false,
        bgiframe:true,
        width: 900,
		height:500,
        resizable: true,
		close:function(){
		//	reseterrorrow();
		},buttons:{
			'<{t}>close<{/t}>': function() {
					$('#XLSInputBox').dialog('close');
			},'<{t}>Determine<{/t}>': function() {
			//	do_import_action();
			}		
		}
    });
    
    //产品dialog 由 noleftlayout 模板里面 getProductListBoxData(…) 方法导入数据
	$('#dialog').dialog({
      		autoOpen: false,
			position: ['center','top'],
      		modal: true,
      		bgiframe:true,
      		width: 850,
			minHeight:100,
      		resizable: false
	});


	//删除产品
	$(".productDel").live("click",function(){
	    $(this).parent().parent().remove();		
		if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
		//if(typeof(countWeight)!='undefined'){countWeight();}
		if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
	});
	
	//计算总价
	$('[name^="sku["],[name^="price["]').live('keyup', function () {
		var attrName = $(this).attr('name');
		var pattern  = /\[(\d+)\]/;
		var matches  = attrName.match(pattern);
	    var pid      = matches[1];
	    var quantity = $('[name="sku[' + pid + ']"]').val();
	    var price    = $('[name="price[' + pid + ']"]').val();
	    var total    = quantity * price;

	    if (!isNaN(total)) {
	      total = total.toFixed(2);
	    }

	    $('[name="total_price[' + pid + ']"]').val(total);
	});
	//countWeight();
});

</script>