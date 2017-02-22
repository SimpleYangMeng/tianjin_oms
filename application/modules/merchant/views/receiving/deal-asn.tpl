<div class="right-title" style="height:30px;"><{t}>HandelASN<{/t}></div>

<style>
    <!--
    .page{
        margin: 0;
        padding: 0;
    }
    .tabContent {
        display: none;
    }

    .imgWrap {
        width: 76px;
        height: 76px;
        margin: 0px;
        border: 0 none;
    }
    -->
</style>


<div class='' id='detail'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th><{t}>ReceiveCode<{/t}></th>
            <th><{t}>status<{/t}></th>
            <th><{t}>productBarcode<{/t}></th>
            <th><{t}>ShipQuantity<{/t}></th>
            <th><{t}>ShelvesQuantity<{/t}></th>
            <th><{t}>ReceiptQuantity<{/t}></th>
            <th><{t}>IsQuality<{/t}></th>
            <th width="120"><{t}>createDate<{/t}></th>
            <th width="120"><{t}>updateTime<{/t}></th>
            <th><{t}>treatment<{/t}></th>
        </tr>
        </thead>
        <tbody>
        <{if isset($asnInfo.ASNDetail) && $asnInfo.ASNDetail!=''}>
        <{foreach from=$asnInfo.ASNDetail item=row}>
        <tr>
            <td><{$row.receiving_code}></td>
            <td><{if $row.rd_status eq "2"}>处理完成<{elseif $row.rd_status eq "1"}>收货中<{else}>在途<{/if}></td>
            <td><{$row.product_barcode}></td>
            <td><{$row.rd_receiving_qty}></td>
            <td><{$row.rd_putaway_qty}></td>
            <td><{$row.rd_received_qty}></td>
            <td><{if $row.is_qc eq "1"}>是<{else}>否<{/if}></td>
            <td><{$row.rd_add_time}></td>
            <td><{$row.rd_update_time}></td>
            <td>
                <{if $row.rd_status neq "2"}>
                <a target="ajaxTodo" href="/merchant/receiving/deal-asn?rd_id=<{$row.rd_id}>" class="confirm">关闭</a>
                <{/if}>
            </td>
        </tr>
        <{/foreach}>
        <{/if}>
        </tbody>
    </table>
</div>


</div>
<script type="text/javascript">
    function ajaxTodo(url, callback){
        var $callback = callback || navTabAjaxDone;
        if (! $.isFunction($callback)) $callback = eval('(' + callback + ')');
        $.ajax({
            type:'POST',
            url:url,
            dataType:"json",
            cache: false,
            success: $callback,
            error: DWZ.ajaxError
        });
    }
    function dealAsn(){
        alert('sss');
    }
</script>