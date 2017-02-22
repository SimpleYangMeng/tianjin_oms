<style type="text/css">
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

            <{if empty($data)}>
                <tr>
                    <td class="left-td">物流企业代码：</td>
                    <td>
                        <span class="blue"><{$customer.code}></span>
                        <input type="hidden" name="logistic_customer_code" value="<{$customer.code}>" />
                    </td>
                    <td class="left-td">物流企业名称：</td>
                    <td><span class="blue"><input type="hidden" name="logistic_enp_name" value="<{$companyInfo.trade_name}>"><{$companyInfo.trade_name}></span></td>
                </tr>
            <{else}>
                <tr>
                    <td class="left-td">物流企业代码:</td>
                    <td>
                        <span class="blue"><{$data.logistic_customer_code}></span> 
                        <input type="hidden" name="logistic_customer_code" value="<{$data.logistic_customer_code}>" />
                    </td>
                    <td class="left-td">物流企业名称:</td>
                    <td>
                        <span class="blue"><{$data.logistic_enp_name}></span>
                        <input type="hidden" name="logistic_enp_name" value="<{$data.logistic_enp_name}>" />
                    </td>
                </tr>
            <{/if}>
            <tr>
                <td class="form_title nowrap text_right">进出口类型：</td>
                <td class="form_input">
                    <select name="ieType" id='ie_type' class="width155">
                        <{foreach from=$ieType item=item key=k }>
                            <option value="<{$k}>" <{if isset($productInfo)&&($productInfo.ie_type ==$k) }>selected="selected"<{/if}>><{$item}>
                            </option>
                        <{/foreach}>
                    </select>
                    <strong>*</strong>
                </td>
                <{if !empty($data)}>
                     <td class="left-td">申报类型：</td>
                    <td>
                        <span class="blue">变更</span>
                        <input type="hidden" name="appType" id="appType" value="2" />
                    </td>
                <{else}>
                   <td class="left-td">申报类型：</td>
                    <td>
                        <span class="blue">新增</span>
                        <input type="hidden" name="appType" id="appType" value="1" />
                    </td>
                <{/if}>
            </tr>
            <tr>
                <td class="left-td">电商企业代码：</td>
                <td>
                    <input class="text-input width140 ui-autocomplete-input" type="text" id="customerCode" name="customerCode" value="<{if !empty($data)}><{$data.customer_code}><{/if}>">
                    <strong>*</strong>
                </td>
                <td class="form_title nowrap text_right">电商企业名称：</td>
                <td class="form_input">
                    <input style="width: 200px;" class="text-input ui-autocomplete-input" type="text" id="ebp_name" name="ebp_name" value="<{if !empty($data)}><{$data.ebp_name}><{/if}>">
                    <strong>*</strong>
                </td>
            </tr>
            
            <tr>
                <td class="left-td">交易订单号：</td>
                <td>
                    <input class="text-input width140 ui-autocomplete-input" type="text" id="referenceNo" name="referenceNo" value="<{if !empty($data)}><{$data.reference_no}><{/if}>">
                    <strong>*</strong>
                </td>
                <td class="left-td">运单号：</td>
                <td>
                    <input class="text-input width140 ui-autocomplete-input" type="text" id="logNo" name="logNo" value="<{if !empty($data)}><{$data.log_no}><{/if}>">
                    <strong>*</strong>
                </td>
            </tr>
            <tr>
                <td class="left-td">运输方式：</td>
                <td>
                    <select class="text-input width155" id="trafMode" name="trafMode">
                        <{foreach from=$traf item=c name=c}>
                            <option value='<{$c.tfm_id}>'<{if !empty($data) && $data.traf_mode==$c.tfm_id}> selected="selected"<{/if}>><{$c.traf_mode_name}></option>
                        <{/foreach}>
                    </select>
                    <strong>*</strong>
                </td>
                <td class="left-td">运输工具：</td>
                <td>
                    <!--
                    <input class="text-input width140 ui-autocomplete-input" type="text" id="shipName" name="shipName" value="<{if !empty($data)}><{$data.ship_name}><{/if}>">
                    -->
                    <select name="shipName" id="shipName" class="text-input width155">
                         <{foreach from=$trafTools item=c name=c}>
                            <option value='<{$c.traf_tool_name}>'<{if !empty($data) && $data.ship_name==$c.traf_tool_name}> selected="selected"<{/if}>><{$c.traf_tool_name}></option>
                        <{/foreach}>
                    </select>
                    <strong>*</strong>
                </td>
            </tr>
            <tr>
                <td class="left-td">航班航次号：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="voyageNo" name="voyageNo" value="<{if !empty($data)}><{$data.voyage_no}><{/if}>"></td>
                <td class="left-td">提运单号：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="billNo" name="billNo" value="<{if !empty($data)}><{$data.bill_no}><{/if}>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">发货人：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="shipper" name="shipper" value="<{if !empty($data)}><{$data.shipper}><{/if}>"><strong>*</strong></td>
                <td class="left-td">发货人电话：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="shipperTelephone" name="shipperTelephone" value="<{if !empty($data)}><{$data.shipper_telephone}><{/if}>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">发货人所在国：</td>
                <td>
                    <select name="shipperCountry" id='shipperCountry' class="text-input width155">
                        <{foreach from=$country item=c name=c}>
                            <option value='<{$c.country_code}>'<{if !empty($data) && $data.shipper_country==$c.country_code}> selected<{elseif $c.country_name_en=='China'}> selected<{/if}>><{$c.country_code}> <{$c.country_name}></option>
                        <{/foreach}>
                    </select>
                    <strong>*</strong>
                </td>
                <td class="left-td">发货人地址：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="shipperAddress" name="shipperAddress" value="<{if !empty($data)}><{$data.shipper_address}><{/if}>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">收货人：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="consignee" name="consignee" value="<{if !empty($data)}><{$data.consignee}><{/if}>"><strong>*</strong></td>
                <td class="left-td">收货人所在国：</td>
                <td>
                    <select name="consigneeCountry" id='consigneeCountry' class="text-input width155">
                        <{foreach from=$country item=c name=c}>
                            <option value='<{$c.country_code}>'<{if !empty($data) && $data.consignee_country==$c.country_code}> selected<{elseif $c.country_name_en=='China'}> selected<{/if}>><{$c.country_code}> <{$c.country_name}></option>
                        <{/foreach}>
                    </select>
                    <strong>*</strong>
                </td>
            </tr>
            <tr>
                <td class="left-td">收货人地址（省）：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="consigneeProvince" name="consigneeProvince" value="<{if !empty($data)}><{$data.consignee_province}><{/if}>"><strong>*</strong></td>
                <td class="left-td">收货人地址（市）：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="consigneeCity" name="consigneeCity" value="<{if !empty($data)}><{$data.consignee_city}><{/if}>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">收货人地址（区）：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="consigneeDistrict" name="consigneeDistrict" value="<{if !empty($data)}><{$data.consignee_district}><{/if}>"><strong>*</strong></td>
                <td class="left-td">收货人电话：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="consigneeTelephone" name="consigneeTelephone" value="<{if !empty($data)}><{$data.consignee_telephone}><{/if}>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">收货人地址：</td>
                <td colspan="3"><!--<input style="width: 300px;" class="text-input ui-autocomplete-input" type="text" id="consigneeAddress" name="consigneeAddress" value="<{if !empty($data)}><{$data.consignee_address}><{/if}>">-->
                    <textarea name="consigneeAddress" id="consigneeAddress" rows="2" cols="35"><{if !empty($data)}><{$data.consignee_address}><{/if}></textarea>
                    <strong>*</strong>
                </td>
            </tr>
            <tr>
                <!-- 
                <td class="left-td">业务状态：</td>
                <td>
                    <select name="appStatus" id='appStatus' class="text-input width155">
                        <{foreach from=$appStatus item=c key=k name=c}>
                            <option value='<{$k}>'<{if !empty($data) && $data.fml_status==$k}> selected<{/if}>><{$c}></option>
                        <{/foreach}>
                    </select>
                </td>
                 -->
				<td class="left-td">主管海关代码：</td>
				<td colspan="3">
					<select name="customsCode" id='customsCode' class="text-input width155">
                        <{foreach from=$customsCodes item=c key=k name=a}>
                            <option value='<{$c.ie_port}>'<{if !empty($data) && $data.customs_code==$c.ie_port}> selected<{/if}>><{$c.ie_port_name}>-<{$c.ie_port}></option>
                        <{/foreach}>
                    </select>
                    <strong>*</strong>
				</td>
            </tr>
            <tr>
                <td class="left-td">运费：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" placeholder="0.00" id="freight" name="freight" value="<{if !empty($data)}><{$data.freight}><{/if}>"><strong>*</strong></td>
                <td class="left-td">订单商品货款：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" placeholder="0.00" id="goodsValue" name="goodsValue" value="<{if !empty($data)}><{$data.goods_value}><{/if}>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">保价费：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" placeholder="0.00" id="insureFee" name="insureFee" value="<{if !empty($data)}><{$data.insure_fee}><{/if}>"><strong>*</strong></td>
                <td class="left-td">币制：</td>
                <td>
                    <select name="currencyCode" id='currencyCode' class="text-input width155">
                        <{foreach from=$currency item=c name=c}>
                            <option value='<{$c.code}>'<{if !empty($data) && $data.currency_code==$c.code}> selected<{elseif $c.code=='RMB'}> selected<{/if}>><{$c.name}> <{$c.code}></option>
                        <{/foreach}>
                    </select>
                    <strong>*</strong>
                </td>
            </tr>
            <tr>
                <td class="left-td">毛重：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" placeholder="0.0000" id="weight" name="weight" value="<{if !empty($data)}><{$data.weight}><{/if}>"><strong>*</strong> <span class="blue">Kg</span></td>
                <td class="left-td">净重：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" placeholder="0.0000" id="netWeight" name="netWeight" value="<{if !empty($data)}><{$data.net_weight}><{/if}>"><strong>*</strong> <span class="blue">Kg</span></td>
            </tr>
            <tr>
                <td class="left-td">件数：</td>
                <td><input class="text-input width140 ui-autocomplete-input" type="text" id="packNo" name="packNo" value="<{if !empty($data)}><{$data.pack_no}><{/if}>"><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">包裹单信息：</td>
                <td><textarea name="parcelInfo" id="parcelInfo" rows="2" cols="35"><{if !empty($data)}><{$data.parcel_info}><{/if}></textarea><strong>*</strong></td>
                <td class="left-td">商品信息：</td>
                <td><textarea name="goodsInfo" id="goodsInfo" rows="2" cols="35"><{if !empty($data)}><{$data.goods_info}><{/if}></textarea><strong>*</strong></td>
            </tr>
            <tr>
                <td class="left-td">备注：</td>
                <td colspan="3"><textarea name="note" id="note" rows="2" cols="35"><{if !empty($data)}><{$data.note}><{/if}></textarea></td>
            </tr>

            <tr>
                <td class="left-td"></td>
                <td colspan=3><a id="sbt" class="button tijiao">提交</a></td>
            </tr>
        </table>
        <input type="hidden" name="id" value="<{if !empty($data)}><{$data.wb_id}><{/if}>">
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
</script>