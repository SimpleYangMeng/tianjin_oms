<style>
    body {
        font: 12px/150% Arial, Helvetica, sans-serif, '宋体';
    }

    #print_content {
        background: none repeat scroll 0 0 white;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        text-align: center;
        width: 19cm;
        padding: 0px;
        font-size: 13px;
    }

    #print_content table {
        border-collapse: collapse;
        border: none;
        width: 100%;
    }

    #print_content td {
        border: solid #000000 1px;
        height: 27px;
        font-size: 13px;
        text-align: center;
    }

    #print_content .barcode {
        display: inline-block;
    }

    .printTitle {
        display: inline-block;
        font-size: 24px;
        float: right;
        margin-top: 20px;
    }

    .fontBold {
        font-weight: bold;
    }
</style>
<div id="print_content">
    <{if isset($data)}>
    <{foreach from=$data key=key item=val}>
        <div style="<{if !$smarty.foreach.data.last}>page-break-after:always;<{/if}>clear:both;">
            <div style="text-align:left; margin:20px 0 10px 0;">
                <div class="barcode"><img src="/default/index/barcode/code/<{$val.order.qc_code}>"></div>
                <div class="printTitle">
                    <br/>
                    质检单
                    <!--<{if $val.order.qc_type=='0'}>
                    <{t}>exemption<{/t}>
                    <{else}>
                    <{t}>QcOrder<{/t}>
                    <{/if}>-->
                    &nbsp;&nbsp;<span style="padding-left:280px;"></span></div>

            </div>
            <div style="clear:both;" class="qccontent">

                <table style="border:1px solid #000">
                    <tbody>
                    <tr class="fontBold">
                        <td style="width:10%"><{t}>productImage<{/t}></td>
                        <td style="width:14%"><{t}>skuCode<{/t}></td>
                        <td><{t}>ASNCode<{/t}></td>
                        <td style="width:12%"><{t}>receivingUser<{/t}></td>
                        <td colspan="4" style="width:24%"><{t}>receivingTime<{/t}></td>
                    </tr>
                    <tr>
                        <td><img alt="" src="/default/index/view-product-img/id/<{$val.order.product_id}>"  width="75" height="75"></td>
                        <td><{$val.order.product.product_sku}></td>
                        <td><{$val.order.receiving_code}></td>
                        <td><{$val.order.receiving_user}></td>
                        <td colspan="4"><{$val.order.qc_add_time}></td>
                    </tr>
                    <{if isset($val.order.qcOption)}>
                    <tr class="fontBold">
                        <td><{t}>QcItems<{/t}></td>
                        <td colspan="2"><{t}>QcDetails<{/t}></td>
                        <td><{t}>quantityQnsellable<{/t}></td>
                        <td colspan="3"><{t}>remark<{/t}></td>
                    </tr>
                    <{foreach from=$val.order.qcOption key=k item=v}>
                        <tr>
                            <td><{$v.qc}></td>
                            <td colspan="2">
                                <{$v.pq_detail}>
                            </td>
                            <td>&nbsp;</td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <{/foreach}>
                    <{/if}>
                    <tr class="fontBold">
                        <td><{t}>productNetWeight<{/t}>/KG</td>
                        <td><{t}>送检数<{/t}></td>
                        <td style="width:16%"><{t}>收货数<{/t}></td>
                        <td><{t}>不良品数<{/t}></td>
                        <td style="width:10%"><{t}>未贴标数量<{/t}></td>
                        <td style="width:10%"><{t}>推荐货架<{/t}></td>
                        <td style="width:10%"><{t}>不良品货架<{/t}></td>
                    </tr>
                    <tr>
                        <td><{$val.order.product.product_weight}></td>
                        <td><{$val.order.qc_quantity}></td>
                        <td><{$val.order.qc_received_quantity}></td>
                        <td><{$val.order.qc_quantity_unsellable}></td>
                        <td></td>
                        <td></td>
                        <td><{$val.other.lc_code}></td>
                    </tr>
                    <{if $val.order.product.product_receive_status=='0'}>
                    <tr class="fontBold">
                        <td></td>
                        <td><{t}>group<{/t}></td>
                        <td style="width:16%"><{t}>package<{/t}></td>
                        <td style="width:10%"><{t}>productDeclaredValue<{/t}></td>
                        <td><{t}>productLength<{/t}></td>
                        <td style="width:10%"><{t}>productWidth<{/t}></td>
                        <td style="width:10%"><{t}>productHeight<{/t}></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <{/if}>
                    <tr>
                        <td class="fontBold"><{t}>remark<{/t}></td>
                        <td colspan="7"><{$val.order.qc_note}></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <{/foreach}>
    <{else}>
    <div style="width:100%">No data.</div>
    <{/if}>
</div>