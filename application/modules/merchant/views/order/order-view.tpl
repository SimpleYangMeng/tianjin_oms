<div class="content-box  ui-tabs  ui-corner-all" >
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">订单详情</h3>
    </div>
<div style="margin-right: 0px; padding: 6px;" class="content-box nbox_c marB10 product_detail cl">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder" width='100%'>
        <tr>
            <th width="15%">进出口类型:</th>
            <td width="30%"><{$orderRow.ie_name}>【<{$orderRow.ie_type}>】</td>
            <th width="15%">主管海关代码:</th>
            <td><{$ieport[$orderRow.customs_code]}>【<{$orderRow.customs_code}>】</td>
        </tr>
        <tr>
            <th>订单编号:</th>
            <td><{$orderRow.order_code}></td>
            <th>交易订单号:</th>
            <td><{$orderRow.reference_no}></td>
        </tr>
        <tr>
            <th>海关审核状态:</th>
            <td><{$orderRow.customs_status}></td>
            <th>海关状态:</th>
            <td><{$orderRow.order_status}></td>
        </tr>
        <tr>
            <th>业务状态:</th>
            <td><{$orderRow.app_status}></td>
            <th>检验检疫状态:</th>
            <td><{$orderRow.ciq_status}></td>
        </tr>
        <tr>
            <th>订单商品货款:</th>
            <td><{$orderRow.goods_amount}></td>
            <th>币制:</th>         
            <td><{$currency[$orderRow.currency_code]}>【<{$orderRow.currency_code}>】</td>
        </tr>
        <tr>
            <th>订单商品运费:</th>
            <td><{$orderRow.freight}></td>
            <th>优惠金额:</th>
            <td><{$orderRow.pro_amount}></td>
        </tr>
        <tr>
            <th>优惠信息说明:</th>
            <td><{$orderRow.pro_remark}></td>
            <th>收货人姓名</th>
            <td><{$orderAddressBookRow.consignee}></td>
        </tr>
        <tr>
            <th>身份证号码</th>
            <td><{$orderAddressBookRow.consignee_id_number}></td>
            <th>收货人所在国:</th>
            <td><{$orderAddressBookRow.country_name}>【<{$orderAddressBookRow.consignee_country}>】</td>
        </tr>
        <tr>
            <th>收货人地址:</th>
            <td><{$orderAddressBookRow.consignee_addres}></td>
            <th>收货人电话:</th>
            <td><{$orderAddressBookRow.consignee_telephone}></td>
        </tr>
        <tr>
            <th>收货人传真:</th>
            <td><{$orderAddressBookRow.consignee_fax}></td>
            <th>收货人电子邮件:</th>
            <td><{$orderAddressBookRow.consignee_email}></td>
        </tr>
        <tr>
            <th>电商平台:</th>
            <td colspan="3"><{$orderRow.ecommerce_platform_customer_name}></td>
        </tr>
        <tr>
            <th>备注:</th>
            <td colspan="3"></td>
        </tr>
        <{if $orderRow.ciq_reject_reason neq ''}>
        <tr>
            <th>商检错误回执</th>
            <td colspan="3"><{$orderRow.ciq_reject_reason}></td>
        </tr>
        <{/if}>
    </table>

    <div class="tabs_header cl content-box-header" style="margin: 10px 0 4px;">
        <ul class="tabs cl" style="padding-top: 2px;">
            <li class='active'><a href="javascript:;" id='tab_orderProduct' class='tab'><span><{t}>ProductOrders<{/t}></span></a></li>
            <li>  <a href="javascript:;" id='tab_OrderLogs' class='tab'><span>订单日志</span></a></li>
        </ul>
    </div>

    <div class='tabContent' id='orderProduct'>
        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th>企业商品货号</th>
                <th>海关商品备案编号</th>
                <th>海关商品编码</th>
                <th>商品名称</th>
                <th>规格型号</th>
                <th>条形码</th>
                <th>品牌</th>
                <th>申报单位</th>
                <th>币制</th>
                <th>申报数量</th>
                <th>单价</th>
                <th>总价</th>
                <th>是否赠品</th>
                <th>备注</th>
            </tr>
            </thead>
            <tbody>
            <{foreach from=$orderProductRows item=row}>
                <tr>
                    <td><{$row.product_no}></td>
                    <td><{$row.registerID}></td>
                    <td><{$row.hs_code}></td>
                    <td><{$row.product_title}></td>
                    <td><{$row.product_model}></td>
                    <td><{$row.product_barcode}></td>
                    <td><{$row.brand}></td>
                    <td><{$row.pu_code}></td>
                    <td><{$row.currency_code}></td>
                    <td><{$row.quantity}></td>
                    <td><{$row.price}></td>
                    <td><{$row.total_price}></td>
                    <td><{$row.gift_flag}></td>
                    <td><{$row.note}></td>
                </tr>
            <{/foreach}>
            </tbody>
        </table>
    </div>
    <div class='tabContent' id='OrderLogs'>
        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th align="center" width="100px"><{t}>LogType<{/t}></th>
                <th align="center" width="100px"><{t}>operater<{/t}></th>
                <th align="center" width="150px"><{t}>addTime<{/t}></th>
                <th align="center" width="100px"><{t}>AccessIP<{/t}></th>
                <th align="center" width="100px">检疫类型</th>
                <th align="center" ><{t}>remark<{/t}></th>
            </tr>
            </thead>
            <tbody>
                <{foreach from=$orderLogRows item=row}>
                <tr>
                    <{if $row.ol_type == 0}>
                    <td>状态修改</td>
                    <{else}>
                    <td>内容修改</td>
                    <{/if}>
                    <{if $row.user_id == 0}>
                    <td>系统</td>
                    <{else}>
                    <td><{$row.account_name}></td>
                    <{/if}>
                    <td><{$row.ol_add_time}></td>
                    <td><{$row.ol_ip}></td>
                    <td><{if $row.status_type eq '1'}>海关<{else}>检验检疫<{/if}></td>
                    <td><{$row.ol_comments}></td>
                </tr>
                <{/foreach}>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
$(function(){
    $(".tabContent").hide();
    $(".tab").click(function(){
        $(".tabContent").hide();
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
        $("#"+$(this).attr("id").replace("tab_","")).show();
    });
    $(".tabContent").eq(0).show();
});
</script>