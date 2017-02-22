<style>
    <!--
    .tabContent {
        display: none;
    }

    .imgWrap {
        width: 100px;
        height: 76px;
        margin: 0px;
        border: 0 none;
    }
    -->
</style>

<link rel="stylesheet" type="text/css"
      href="/js/fancybox/jquery.fancybox.css" media="screen" />
<link rel="stylesheet" type="text/css"
      href="/js/fancybox/jquery.fancybox-thumbs.css" />

<script type="text/javascript"
        src="/js/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript"
        src="/js/fancybox/jquery.fancybox-thumbs.js"></script>


<div class="content-box  ui-tabs  ui-corner-all" >
<div class="content-box-header">
    <h3  class="clearborder" style="margin-left:5px;"><{t}>ProductDetail<{/t}></h3>
</div>
<div style="margin-right: 0px;" class="content-box nbox_c marB10">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder" width='100%'>
        <tbody>
        <tr>
            <th><{t}>ProductSKU<{/t}></th>
            <td><{$productRow.product_sku}></td>
            <th><{t}>CustomerID<{/t}></th>
            <td><{$productRow.customer_code}></td>

        </tr>
        <tr>
            <th><{t}>pname<{/t}></th>
            <td><{$productRow.product_title}></td>

            <th><{t}>p_en_name<{/t}></th>
            <td><{$productRow.product_title_en}></td>
        </tr>
        <tr>

            <!--<th><{t}>BarcodeType<{/t}></th>
            <td ><{if $productRow.product_barcode_type eq "2"}><{t}>SerialNumber<{/t}><{elseif $productRow.product_barcode_type eq "1"}><{t}>CustomizeBarcode<{/t}><{else}><{t}>DefaultBarcode<{/t}><{/if}></td>-->
            <th><{t}>productBarcode1<{/t}></th>
            <td><{$productRow.product_barcode}></td>
            <th>重量(KG)</th>
            <td><{$productRow.product_weight}></td>
        </tr>
        <!--<tr>
            <th><{t}>ProductCategory<{/t}></th>
            <td><{$productRow.category_name}></td>
            <th><{t}>p_unit<{/t}></th>
            <td><{$productRow.pu_name}></td>

        </tr>-->

        <!--<tr>
            <th><{t}>length<{/t}>*<{t}>width<{/t}>*<{t}>height<{/t}>(cm)</th>
            <td><{$productRow.product_length}>*<{$productRow.product_width}>*<{$productRow.product_height}></td>
            <th>重量(KG)</th>
            <td><{$productRow.product_weight}></td>
        </tr>-->


        <!--<tr>

            <th><{t}>ReportingCurrency<{/t}></th>
            <td><{$productRow.currency_code}></td>
            <th><{t}>declaredValue<{/t}></th>
            <td><{$productRow.product_declared_value}></td>
        </tr>

        <tr>
            <th><{t}>country_code_of_origin<{/t}></th>
            <td><{$productRow.country_code_of_origin}></td>
            <th><{t}>CustomsCode<{/t}></th>
            <td><{$productRow.hs_code}></td>

        </tr>-->


        <tr>

            <th><{t}>ProductType<{/t}></th>
            <td><{if $productRow.product_type eq "1"}><{t}>CombineProduct<{/t}><{else}><{t}>OrdinaryProducts<{/t}><{/if}></td>
            <th><{t}>productStatus<{/t}></th>
            <td><{if $productRow.product_status eq "0"}><{t}>record_in_custom_status<{/t}><{/if}>
                <{if $productRow.product_status eq "1"}><{t}>ok_status<{/t}><{/if}></td>
        </tr>
        <!--<tr>
            <th><{t}>QualityType<{/t}></th>
            <td><{if $productRow.product_is_qc eq "1"}><{t}>Quality<{/t}><{else}><{t}>NotQuality<{/t}><{/if}></td>
            <th><{t}>ReceiveProductType<{/t}></th>
            <td><{if $productRow.product_receive_status eq "1"}><{t}>ProductsHaveReceivedTheGoods<{/t}><{else}><{t}>NewProducts<{/t}><{/if}></td>

        </tr>
        <tr>
            <th><{t}>parcelTax<{/t}></th>
            <td><{$productRow.parcel_tax}></td>
            <th>品牌</th>
            <td><{$productRow.brand}></td>
        </tr>-->
        <tr>
            <th><{t}>ProductAddTime<{/t}></th>
            <td><{$productRow.product_add_time}></td>
            <th><{t}>LastUpdatedProducts<{/t}></th>
            <td><{$productRow.product_update_time}></td>

        </tr>


        <tr>
            <th>备注</th>
            <td><{$productRow.product_description}></td>
            <th><{t}>businessCode<{/t}>：</th>
            <td><{$productGoods.registerID}></td>


        </tr>


        </tbody>
    </table>
</div>


<!--
<div  id='pic_wrapper'>
								<{if isset($productRow)&&$productRow['attach']}>
                                   <{foreach from=$productRow.attach item=att name=att}>
                                       <div class="imgWrap">
									   		<{if $att.pa_file_type=='img'}>

                                                  <a href="<{$att.url}>"  target="_blank"><img src="<{$att.url}>"  ></a>
												   <{else}>
                                           <a href="<{$att.url}>" target="_blank"> <img
                                        src="<{$att.url}>"> </a><{/if}>
										</div>
                                                <{/foreach}>
                                                <{/if}>


</div>
-->



<div class="tabs_header">
    <ul class="tabs">
        <!--<li class='active'>
            <a href="javascript:;" id='tab_productlog' class='tab'><span><{t}>ProductLogs<{/t}></span></a>
        </li>-->
        <li class='active'><a href="javascript:;" id='tab_inventoryProduct' class='tab'><span><{t}>产品子SKU<{/t}></span></a></li>
        <li><a href="javascript:;" id='tab_orderProduct' class='tab'><span><{t}>ProductOrders<{/t}></span></a></li>
        <!--<li><a href="javascript:;" id='tab_receiving' class='tab'><span><{t}>ProductASN<{/t}></span></a></li>
        <li><a href="javascript:;" id="tab_productImage" class="tab"><span><{t}>productImage<{/t}></span></a></li>-->
    </ul>
</div>

<!--
<div class='tabContent' id='productlog'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th align="center" width="100px"><{t}>LogType<{/t}></th>
            <th align="center" width="100px"><{t}>operater<{/t}></th>
            <th align="center" width="100px">修改前状态</th>
            <th align="center" width="100px">修改后状态</th>
            <th align="center" width="150px"><{t}>addTime<{/t}></th>
            <th align="center" width="100px"><{t}>AccessIP<{/t}></th>
            <th align="center" ><{t}>remark<{/t}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach from=$productLog item=row}>
        <tr>
            <td><{if $row.pl_type eq "1"}><{t}>StateModification<{/t}><{else}><{t}>ContentModification<{/t}><{/if}></td>
            <td><{if $row.customer_id > 0}><{$row.account_name}><{else}><{t}>system<{/t}><{/if}></td>
            <td><{$logStatus[$row.pl_statu_pre]}></td>
            <td><{$logStatus[$row.pl_statu_now]}></td>
            <td><{$row.pl_add_time}></td>
            <td><{$row.pl_ip}></td>
            <td><{$row.pl_note}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>

</div>-->

<!--产品库存-->
<div class='tabContent' id='inventoryProduct'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th><{t}>skuCode<{/t}></th>
            <th><{t}>产品名称<{/t}></th>
            <th><{t}>产品品类<{/t}></th>
            <th><{t}>数量<{/t}></th>
            <th><{t}>重量<{/t}></th>
            <th><{t}>添加时间<{/t}></th>
            <!--<th><{t}>Reserved<{/t}></th>
            <th><{t}>Outbound<{/t}></th>
            <th><{t}>createDate<{/t}></th>
            <th><{t}>lastUpdateTime<{/t}></th>-->
        </tr>
        </thead>
        <tbody id='loadData'>
        <{foreach from=$pcr item=row}>
        <tr>
            <td><{$row.product_sku}></td>
            <td><{$row.product_title}></td>
            <td><{$row.category_name}></td>
            <td><{$row.pcr_quantity}></td>
            <td><{$row.product_weight}></td>
            <td><{$row.pcr_add_time}></td>
            <!--<td><{$row.pi_reserved}></td>
            <td><{$row.pi_shipped}></td>
            <td><{$row.pi_add_time}></td>
            <td><{$row.pi_update_time}></td>-->

        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>


<!--产品订单-->
<div class='tabContent' id='orderProduct'>
    <table  cellspacing="0" cellpadding="0" class="formtable tableborder" >
        <thead>
        <tr>
            <th align="center" ><{t}>orderCode<{/t}></th>
            <th align="center" ><{t}>skuCode<{/t}></th>
            <th align="center" ><{t}>quantity<{/t}></th>
            <th align="center" ><{t}>addTime<{/t}></th>
            <th align="center" ><{t}>lastEditTime<{/t}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach from=$orderProduct item=row}>
        <tr>
            <td><{$row.order_code}></td>
            <td><{$productRow.product_sku}></td>
            <td><{$row.op_quantity}></td>
            <td><{$row.op_add_time}></td>
            <td><{$row.op_update_time}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>



<!--
<div class='tabContent' id='productImage'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th>产品名称</th>
            <th>图片</th>
            <th>添加时间</th>
        </tr>
        </thead>
        <{foreach from=$productImage item=row}>
        <tr>
            <td><{$productRow.product_title}></td>
            <td>
                <div class="imgWrap" style=" white-space: nowrap; ">
                    <a data-fancybox-group="gallery" class="fancybox"
                    <{if $row.pa_file_type eq "img"}>
                    href="/default/product-image/view-attach/aid/<{$row.pa_id}>"
                    <{else}>
                    href="<{$row.pa_path}>"
                    <{/if}> style="width:76px;">
                    <img
                    <{if $row.pa_file_type eq "img"}>
                    src="/default/product-image/view-attach/aid/<{$row.pa_id}>"
                    <{else}>
                    src="<{$row.pa_path}>"
                    <{/if}>
                    style="width: 100px; height: 75px; margin-left: 1px; margin-top: 1px;">
                    </a>
                </div>
            </td>
            <td><{$row.pa_update_time}></td>
        </tr>
        <{/foreach}>
    </table>
</div>


<div class='tabContent' id='receiving'>
    <table class="formtable tableborder" width="1000px" layoutH="138">
        <thead>
        <tr>
            <th align="center" ><{t}>ReceiveCode<{/t}></th>
            <th align="center" ><{t}>status<{/t}></th>
            <th align="center" ><{t}>ShipQuantity<{/t}></th>
            <th align="center" ><{t}>ShelvesQuantity<{/t}></th>
            <th align="center" ><{t}>ReceiptQuantity<{/t}></th>
            <th align="center" ><{t}>createDate<{/t}></th>
            <th align="center" ><{t}>updateTime<{/t}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach from=$productAsn item=row}>
        <tr>
            <td><{$row.receiving_code}></td>
            <td><{$asnStatusArr[$row.rd_status]}></td>
            <td><{$row.rd_receiving_qty}></td>
            <td><{$row.rd_putaway_qty}></td>
            <td><{$row.rd_received_qty}></td>
            <td><{$row.rd_add_time}></td>
            <td><{$row.rd_update_time}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>-->

<div class='clear'></div>

</div>


</div>
<script type="text/javascript">

    $(function(){
        //$(".tabContent").show();
        $(".tab").click(function(){
            $(".tabContent").hide();
            // $(".tabContent").show();
            //return;
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
            $("#"+$(this).attr("id").replace("tab_","")).show();
        });

        //$(".tabContent").eq(0).show();
        $("#inventoryProduct").show();

        $('.fancybox').fancybox({
            prevEffect	: 'none',
            nextEffect	: 'none',
            loop : true,
            autoPlay : false,
            helpers	: {
                title	: {
                    type: 'outside'
                },
                overlay	: {
                    opacity : 0.8,
                    css : {
                        'background-color' : '#000'
                    }
                },
                thumbs	: {
                    width	: 100,
                    height	: 100
                }
            }
        });

    });
    //-->
</script>
<script>
    $(function(){
        //按默认类
        $("table").alterBgColor();

    })
</script>