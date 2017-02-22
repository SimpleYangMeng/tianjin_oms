<!--此页可能是废弃页面!-->
<div class="right-title">库存详情</div>

<style type="text/css">
    .tabContent {
        display: none;
    }
    .imgWrap {
        width: 76px;
        height: 76px;
        margin: 0px;
        border: 0 none;
    }
    #infomation .center{
        text-align: center;
    }
    #infomation .right{
        text-align: right;
    }

</style>
<script type="text/javascript">


    $(function(){

        $(".tab").click(function(){
            $(".tabContent").hide();

            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
            $("#"+$(this).attr("id").replace("tab_","")).show();
        });

        $("#inventoryLog").show();
    });
    //-->
</script>

<div style="margin-right: 0px;" class="nbox_c marB10">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <tbody>
        <tr>
            <th>产品唯一识别码</th>
            <td><{$inventory.product_barcode}></td>
            <th>客户</th>
            <td><{$inventory.customer_code}></td>
        </tr>
        <tr>
            <th>仓库</th>
            <td><{$inventory.warehouse_code}></td>
            <th>在途数量</th>
            <td><{$inventory.pi_onway }></td>
        </tr>
        <tr>
            <th>到货数量</th>
            <td><{$inventory.pi_pending}></td>
            <th>可用数量</th>
            <td><{$inventory.pi_sellable}></td>
        </tr>
        <tr>
            <th>不良品数量</th>
            <td><{$inventory.pi_unsellable}></td>
            <th>已占用数量</th>
            <td><{$inventory.pi_reserved}></td>
        </tr>
        <tr>
            <th>出库数量</th>
            <td><{$inventory.pi_shipped}></td>
            <th>冻结数量</th>
            <td><{$inventory.pi_hold}></td>
        </tr>
        <tr>
            <th>创建日期</th>
            <td><{$inventory.pi_add_time }></td>
            <th>最后更新时间</th>
            <td><{$inventory.pi_update_time }></td>
        </tr>
        </tbody>
    </table>
</div>

<div class="tabs_header">
    <ul class="tabs">
        <li class='active'>
            <a href="javascript:;" id='tab_inventoryLog' class='tab'><span>库存日志</span></a>
        </li>
    </ul>
</div>

<div class='tabContent' id='inventoryLog'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th class="center">产品标识码</th>
            <th class="center">仓库</th>
            <th class="center">操作单号</th>
            <th class="center">操作人</th>
            <th class="center">在途</th>
            <th class="center">到货</th>
            <th class="center">可用</th>
            <th class="center">不良品</th>
            <th class="center">已占用</th>
            <th class="center">出库</th>
            <th class="center">变化前</th>
            <th class="center">变化后</th>
        </tr>
        </thead>
        <tbody>
        <{foreach from=$productInventoryLog item=row}>
        <tr>
            <td ><{$row.product_barcode}></td>
            <td ><{$row.warehouse_code}></td>
            <td ><{$row.reference_code}></td>
            <td ><{if $row.user_id eq "1"}>客户<{else}>系统<{/if}></td>
            <td class='right'><{$row.pil_onway}></td>
            <td class='right'><{$row.pil_pending}></td>
            <td class='right'><{$row.pil_sellable}></td>
            <td class='right'><{$row.pil_unsellable}></td>
            <td class='right'><{$row.pil_reserved}></td>
            <td class='right'><{$row.pil_shipped}></td>
            <td><{$row.from_it_code}></td>
            <td><{$row.to_it_code}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>
<div class='clear'></div>
</div>