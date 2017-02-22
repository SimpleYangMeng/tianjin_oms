<style type="text/css">
.content-box{padding:10px;}
.order{padding-top: 15px;}
.order-table td.form_title{width:20%;font-weight:bold;text-align:right;border:1px solid #D8E0E4;}
table{border-collapse:collapse;border-spacing:0;}
.form-table{width:100%;font-size:13px;}
.form-table th{text-align:right;font-weight:bold;padding:8px 5px;border:1px solid #D8E0E4; background:none repeat scroll 0 0 #e1effb;}
.form-table td{padding:8px 3px;border:1px solid #D8E0E4;text-align:center;}
.form-table td.left{width:20%;font-weight:bold;text-align:right;border:1px solid #D8E0E4;}
.form-table td.right{width:30%;text-align:left;border:1px solid #D8E0E4;}
.form-table td.error{display:none;color:red;background:#FDFFD2;text-align:center;border:1px solid #D8E0E4;}
.form-table td textarea.medium-input,.form-table .text-input{height:14px;resize:none;  border-radius: 2px;}
.form-input{height:28px;outline:0;border:1px solid #D8E0E4;padding:0 5px;}
.form-input,.text-input{width:160px;height:28px;outline:0;border:1px solid #D8E0E4;padding:0 5px;}
.product-table .b-custom-select__title__text{margin-top: 3px;}
.EditButton > a.fm-button{padding:0.4em 0.5em 0.4em 0.5em;}
.EditButton > a.fm-button-icon-left{ padding-left: 1.9em; position: relative;}
.EditButton > a.fm-button-icon-right{padding-right: 1.9em; position: relative;}
.EditButton > .fm-button-icon-left > .ui-icon{left:0.2em;margin-left:0;margin-top:-8px;position:absolute;right:auto;top:50%;}
.EditButton > a.fm-button-icon-right > .ui-icon{left:auto;margin-left:0;margin-top:-8px;position:absolute;right:0.2em;top:50%;}
#order-form .n-default-product > .msg-wrap{position: relative;}
</style>
<link rel="stylesheet" type="text/css" href="/js/jqGrid/jqgrid.css" />
<link rel="stylesheet" type="text/css" href="/js/nice-validator-0.8.1/jquery.validator.css" />
<script type="text/javascript" src="/js/artTemplate/template.js"></script>
<script type="text/javascript" src="/js/jqGrid/locale-cn.js"></script>
<script type="text/javascript" src="/js/jqGrid/jqGrid.min.js"></script>
<script type="text/javascript" src="/js/nice-validator-0.8.1/jquery.validator.js"></script>
<script type="text/javascript" src="/js/nice-validator-0.8.1/local/zh-CN.js"></script>
<script type="text/javascript" src="/js/jquery-fileUpload.js"></script>

<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div>
        <div class="content-box-header">
            <h3  class="clearborder" style="margin-left:5px;">订单新增</h3>
        </div>
    </div>

    <form class="pageForm" id="order-form" action="/merchant/order/create" autocomplete="off">
        <div class="product">
            <table class="product-table form-table" style="width: 100%;">
                <tr>
                    <th colspan='16'>
                        <!-- <input type="button" class="form-input " value="选择商品" id="choiceProduct"> -->
                        <input type="button" class="form-input" value="选择商品" id="choiceProductForExcel">
                    </th>
                </tr>
                <tr>
                    <td colspan="16" id="product-table-message_tip" class="error">
                    </td>
                </tr>
                <tr>
                    <td>企业商品货号</td>
                    <td>海关备案编号</td>
                    <td>海关商品编码</td>
                    <td>商品名称</td>
                    <td>企业商品描述</td>
                    <td>规格型号</td>
                    <td>条形码</td>
                    <td>品牌</td>
                    <td>申报单位</td>
                    <td>币制</td>
                    <td>申报数量</td>
                    <td>单价</td>
                    <td>总价</td>
                    <td>原产国</td>
                    <td>是否赠品</td>
                    <td>备注</td>
                </tr>

            </table>
        </div>

        <div class='order'>
            <table class="order-table form-table" style="width: 100%;">
                <tr>
                    <td class="form_title nowrap text_right">
                        进出口类型:
                    </td>
                    <td class="form_input">
                        <select class="fix-small-input" name="ie_type" id="ieTypeRow" data-rule="required" data-msg-required="进出口类型必填">
                            <option value=''>请选择</option>
                            <{foreach from=$ieTypeRows name=ieTypeRow key=key item=ieTypeRow}>
                            <option value="<{$key}>"><{$ieTypeRow}></option>
                            <{/foreach}>
                        </select>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="ieTypeRow"></span>
                    </td>


                    <td  class="form_title nowrap text_right">
                        主管海关代码:
                    </td>
                    <td class="form_input" >
                        <select class="fix-small-input" name="ie_port" id='iePortRow' data-rule="required" data-msg-required="主管海关代码必填">
                            <option value=''>请选择</option>
                            <{foreach from=$iePortRows name=iePortRow key=key item=iePortRow}>                            
                            <{if $customerAuthRows.customs_code == $iePortRow.ie_port}>
                            <option value='<{$iePortRow.ie_port}>' selected="selected"><{$iePortRow.ie_port}>  <{$iePortRow.ie_port_name}></option>
                            <{else}>
                            <option value='<{$iePortRow.ie_port}>'><{$iePortRow.ie_port}>  <{$iePortRow.ie_port_name}></option>
                            <{/if}>
                            <{/foreach}>
                        </select>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="iePortRow"></span>
                    </td>
                </tr>

                
                <tr>
                    <td class="form_title nowrap text_right">
                        交易订单号:
                    </td>
                    <td class="form_input">
                        <input type="text" name='reference_no' id="referenceNo" class="form fix-small-input text-input" data-rule="required" data-msg-required="交易订单号必填"/>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="referenceNo"></span>
                    </td>
                    <td class="form_title nowrap text_right">
                        电商平台备案编码:
                    </td>
                    <td class="form_input">
                        <input type="text" name='ecommerce_platform_customer_code' id="ecommercePlatformCustomerCode" class="form fix-small-input text-input"/>
                        <span class="msg-box n-right" style=""><span role="alert" class="msg-wrap n-tip"><span class="n-icon"></span><span class="n-msg">电商平台不是登陆用户企业时必须填写！</span></span></span>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">
                        订单商品货款:
                    </td>
                    <td class="form_input">
                        <input type="text" name='goods_amount' id="goodsAmount" class="form fix-small-input text-input" data-rule="required;doubles;range[0~]" data-msg-required="订单商品货款必填"/>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="goodsAmount"></span>
                    </td>
                    <td  class="form_title nowrap text_right">
                        订单商品运费:
                    </td>
                    <td class="form_input">
                        <input type="text" id="freight" name="freight" class="form fix-small-input text-input" data-rule="required;doubles; range[0~]"  data-msg-required="订单商品运费必填"/>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="freight"></span>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        订单商品税款:
                    </td>
                    <td class="form_input">
                        <input type="text" name='tax_total' id="taxTotal" class="form fix-small-input text-input" data-rule="doubles;range[0~]" data-msg-required="订单商品税款必填"/>
                    </td>
                    <td  class="form_title nowrap text_right">
                        实际支付金额:
                    </td>
                    <td class="form_input">
                        <input type="text" id="acctualPaid" name="acctual_paid" class="form fix-small-input text-input" data-rule="required;doubles; range[0~]"  data-msg-required="实际支付金额必填"/>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="acctualPaid"></span>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        订购人注册号:
                    </td>
                    <td class="form_input">
                        <input type="text" name='buyer_reg_no' id="buyer_reg_no" class="form fix-small-input text-input" data-rule="required;" data-msg-required="订购人注册号必填"/>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="buyer_reg_no"></span>
                    </td>
                    <td  class="form_title nowrap text_right">
                        订购人姓名:
                    </td>
                    <td class="form_input">
                        <input type="text" id="buyer_name" name="buyer_name" class="form fix-small-input text-input" data-rule="required;"  data-msg-required="订购人姓名必填"/>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="buyer_name"></span>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">
                        订购人身份证号码:
                    </td>
                    <td class="form_input" >
                        <input type="text" name="buyer_id" id="buyerId"
                        data-rule="required;idnumber;" 
                        data-msg-required="订购人身份证号码必填"
                        data-rule-idnumber="[/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/i, '身份证号码格式不正确']" 
                        class="form medium-input text-input" />
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="buyerId"></span>                        
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">
                        币制:
                    </td>
                    <td class="form_input">
                        <select class="fix-small-input choiceCurrencyCode" name="currency_code" id="currencyCode" data-rule="required" data-msg-required="币制必填">
                            <option value="">请选择</option>
                            <{foreach from=$currencyRows name=currencyRow item=currencyRow}>
                            <option value="<{$currencyRow.currency_code}>"><{$currencyRow.currency_code}>  <{$currencyRow.currency_name}></option>
                            <{/foreach}>
                        </select>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="currencyCode"></span>
                    </td>
                    <td  class="form_title nowrap text_right">
                        优惠金额:
                    </td>
                    <td class="form_input">
                        <input type="text" name='pro_amount' class="form fix-small-input text-input" data-rule="doubles; range[0~]"/>
                    </td>

                </tr>
                <tr>
                    <td class="form_title nowrap text_right">
                        优惠信息说明:
                    </td>
                    <td class="form_input" colspan="3">
                        <textarea class="medium-input" name="pro_remark"></textarea>
                    </td>
                </tr>

                <tr>
                    <td  class="form_title nowrap text_right">
                        收货人名称:
                    </td>
                    <td class="form_input">
                        <input type="text" name="consignee" id="consignee" class="form fix-small-input text-input" data-rule="required" data-msg-required="收货人名称必填"/>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="consignee"></span>
                    </td>
                    <td class="form_title nowrap text_right">
                        收货人身份证号码:
                    </td>
                    <td class="form_input">
                        <input type="text" name="consignee_id_number" id="consigneeIdNumber"
                        data-rule="idnumber;" 
                        data-rule-idnumber="[/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/i, '身份证号码格式不正确']" 
                        class="form medium-input text-input" />
                        <span class="msg-box n-right" style="position:static;" for="consigneeIdNumber"></span>                        
                    </td>
                    
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">
                        收货人所在国:
                    </td>
                    <td class="form_input" colspan="3">
                        <select name="consignee_country" id="consigneeCountry" data-rule="required" data-msg-required="收货人所在国必填">
                            <option value="">请选择</option>
                            <{foreach from=$countryRows name=countryRow item=countryRow}>
                            <option value="<{$countryRow.country_code}>"><{$countryRow.country_code}>  <{$countryRow.country_name}></option>
                            <{/foreach}>
                        </select>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="consigneeCountry"></span>
                    </td>                    
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">
                        收货人地址:
                    </td>
                    <td class="form_input">
                        <input type="text" id="consigneeAddres" name="consignee_addres" class="form fix-small-input text-input" data-rule="required" data-msg-required="收货人地址必填"/>
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="consigneeAddres"></span>
                    </td>
                    <td  class="form_title nowrap text_right">
                        收货人电话:
                    </td>
                    <td class="form_input">
                        <input type="text" id="consigneeTelephone" name="consignee_telephone" class="form fix-small-input text-input"                         
                        data-rule="required;mobile" 
                        data-msg-required="收货人电话必填"
                        data-rule-mobile="[/^((0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?)|(^1[3|4|5|8][0-9]\d{4,8})$/, '联系电话格式不正确！']" 
                        />
                        <strong>*</strong>
                        <span class="msg-box n-right" style="position:static;" for="consigneeTelephone"></span>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        收货人传真:
                    </td>
                    <td class="form_input">
                        <input type="text" id="consigneeFax"
                        data-rule="mobile" 
                        data-rule-mobile="[/^((0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?)|(^1[3|4|5|8][0-9]\d{4,8})$/, '传真模式不正确']" 
                        name="consignee_fax" class="form fix-small-input text-input"/>
                        <span class="msg-box n-right" style="position:static;" for="consigneeFax"></span>
                    </td>

                    <td class="form_title nowrap text_right">
                        收货人电子邮件:
                    </td>
                    <td class="form_input">
                        <input type="text" name="consignee_email" data-rule="email" class="form fix-small-input text-input" data-rule="email"/>
                    </td>
                </tr>
                

                <tr>
                    <td class="form_title nowrap text_right">
                        备注:
                    </td>
                    <td class="form_input" colspan="3">
                        <textarea class="large-input" name="note"></textarea>
                    </td>
                </tr>


                <tr>
                    <th colspan='4'>
                        <input type="submit" class="form-input " value="创建订单">
                    </th>
                </tr>

            </table>
        </div>

    </form>
</div>




<script id="product-list-success" type="text/html">
{{each success as product key}}
<tr class="product-table-return-message product-item">
<td>
    {{product.product_no}}
    <input type="hidden" value="{{product.product_no}}" name="product[{{key}}][product_no]" />
</td>
<td>
    {{product.registerID}}
</td>
<td>
    {{product.hs_code}}
    <input type="hidden" value="{{product.hs_code}}" name="product[{{key}}][hs_code]" />
</td>
<td>
    {{product.product_title}}
    <input type="hidden" value="{{product.product_title}}" name="product[{{key}}][product_title]" />
</td>
<td>
    {{product.item_desc}}
    <input type="hidden" value="{{product.item_desc}}" name="product[{{key}}][item_desc]" />
</td>
<td>
    {{product.product_model}}
    <input type="hidden" value="{{product.product_model}}" name="product[{{key}}][product_model]" />
</td>
<td>
    {{product.product_barcode}}
    <input type="hidden" value="{{product.product_barcode}}" name="product[{{key}}][product_barcode]" />
</td>
<td>
    {{product.brand}}
    <input type="hidden" value="{{product.brand}}" name="product[{{key}}][brand]" />
</td>
<td>
    {{product.pu_code}}
    <input type="hidden" value="{{product.pu_code}}" name="product[{{key}}][pu_code]" />
</td>
<td>
    {{product.currency_code}}
    <input type="hidden" value="{{product.currency_code}}" name="product[{{key}}][currency_code]" />
</td>
<td>
    {{product.quantity}}
    <input type="hidden" value="{{product.quantity}}" name="product[{{key}}][quantity]" />
</td>
<td>
    {{product.price}}
    <input type="hidden" value="{{product.price}}" name="product[{{key}}][price]" />
</td>
<td>
    {{product.total_price}}
    <input type="hidden" value="{{product.total_price}}" name="product[{{key}}][total_price]" />
</td>
<td>
    {{product.origin_country}}
    <input type="hidden" value="{{product.origin_country}}" name="product[{{key}}][origin_country]" />
</td>

<td>
    {{product.gift_flag}}
    <input type="hidden" value="{{product.gift_flag}}" name="product[{{key}}][gift_flag]" />
</td>
<td>
    {{product.note}}
    <input type="hidden" value="{{product.note}}" name="product[{{key}}][note]" />
</td>
</tr>
{{/each}}
</script>

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

<div id="dialog" title="选择商品" style="display:none">
    <table id="jqGrid_product_list"></table>
    <div id="jqGrid_Pager"></div>
</div>

<div id="dialogExcel" title="选择要上传的文件" style="display:none">
    <table class="form-table" style="width: 100%;">
        <tr>
            <td colspan="2">
                <span>下载模板：</span>
                <a href="/template/ordre-product.xlsx" target="_blank">商品上传模板</a>
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


<script type="text/javascript">
$(function () {
    // 用户为类型进口

    $('#order-form').bind('valid.form', function(){
        var _length = $(".product-item").length;
        if(_length <= 0){
            alertTip("必须选择一个或者多个商品");
            return false;
        }
        var type = $('#ieTypeRow').val();
        if(type == 'BI' || type == 'NI'){
            var  consigneeIdNumber = $('#consigneeIdNumber').val();        
            if(consigneeIdNumber == ''){
                alertTip("进口订单身份证为必填项！");
                return false;
            }
        }
        $.ajax({
            url: '/merchant/order/create',
            type: 'POST',
            data: $(this).serialize(),
            dataType:'json',
            success: function(json){
                if(json.ask == 1){
                    alertTip(json.message + "["+json.orderCode+"]" , 500 , 'auto' , 1);                    
                }else{
                    var message = '';

                    if(typeof (json.error)!="undefined"&&json.error!=""){
                        $.each(json.error, function(k, v){
                            message += '<p>'+v+'</p>';
                        });
                    }
                    alertTip(message);
                }           
            }
        });
        return false;
    });

    
    $('#choiceProductForExcel').bind('click' , function(){
        $('#dialogExcel').dialog('open');
    });

    $('#ieTypeRow').bind('change' , function(){        
        var type = $(this).val();
        var currencyCode = $('#currencyCode');
        if(type == 'BE' || type == 'NE'){
            currencyCode.val('USD');
        }else{
            currencyCode.val('RMB');
        }
        // currencyCode.attr('disabled' , 'disabled');
        currencyCode.trigger('update');
    });

});



$('#dialogExcel').dialog({
    autoOpen: false,
    modal: true,
    bgiframe:true,
    width: 850,
    resizable: false,
    position:['center']
});




readAsText.init({
    url:"/merchant/order/find-product",
    element:'#dialogInputForExcel',
    triggerElement: '#dialogButtonForExcel',
    success:function(json){
        $('.product-table-return-message').remove();
        $('#product-table-message_tip').hide();       
        if(json.ask == 0){
            var msghtml = template('product-excel-list', json);
            $('#product-table-message_tip').html(msghtml);
            $('#product-table-message_tip').show();
        }else if(json.ask == 1){
            var successHtml = template('product-list-success', json);
            $(successHtml).appendTo('.product-table');
        }
        $('#dialogExcel').dialog('close');
    }
});


</script>
