<script src="/js/viewToDialog.js" type="text/javascript"></script>
<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">账册列表</h3>
    </div>
    <div class="pageHeader">
        <form action="/storage/inventory/receiving-inventory" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>

            <div class="searchBar">
                <table>
                    <tr>
                        <td class="form_input">                            
                            <label>入库单号：
                                <input type="text" name="receiving_code" value="<{$condition.receiving_code}>" class="text-input fix-small-input"/>
                            </label>
                            <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>



<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list formtable tableborder" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
            <tr>
                <th>项号</th>
                <th>入库单号</th>
                <th>实际数量</th>
                <th>入库总数</th>
                <th>出库总数</th>
                <th>冻结总数</th>
				<th>法定数量</th>
				<th>第二数量</th>
                <th>仓储企业</th>
                <th>海关商品编码</th>
                <th>申报单位</th>
                <th>币种</th>
            
            </tr>
        </thead>
        <tbody>
        <{if $receivingInventoryRows}>
            <{foreach from=$receivingInventoryRows item=receivingInventoryRow name=receivingInventoryRow}>
            <tr>
                <td><{$receivingInventoryRow.merge_g_no}></td>
                <td><{$receivingInventoryRow.receiving_code}></td>
                <td><{$receivingInventoryRow.qty}></td>
                <td><{$receivingInventoryRow.stock_in_all}></td>
                <td><{$receivingInventoryRow.stock_out_all}></td>
                <td><{$receivingInventoryRow.stock_frozen}></td>
				<td><{$receivingInventoryRow.qty_1}><{$productUom[$receivingInventoryRow.unit_1]['name']}></td>
				<td><{if $receivingInventoryRow.qty_2 gt 0}><{$receivingInventoryRow.qty_2}><{$productUom[$receivingInventoryRow.unit_2]['name']}><{/if}></td>
                <td><{$receivingInventoryRow.warehouse_code}></td>
                <td><{$receivingInventoryRow.code_ts}></td>
                <td><{$receivingInventoryRow.stock_unit}></td>
                <td><{$receivingInventoryRow.curr}></td>                
            </tr>
            <{/foreach}>
        <{/if}>
        </tbody>
    </table>
</form>
<div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>
