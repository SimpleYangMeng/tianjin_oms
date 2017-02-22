<script src="/js/viewToDialog.js" type="text/javascript"></script>
<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">账册列表</h3>
    </div>
    <div class="pageHeader">
        <form action="/storage/inventory/product-inventory" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>

            <div class="searchBar">
                <table>
                    <tr>
                        <td class="form_input">                            
                            <label>料件号：
                                <input type="text" name="goods_id" value="<{$condition.goods_id}>" class="text-input fix-small-input"/>
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
                <th>料件号</th>
                <th>入库总数量</th>
                <th>入库待集报数量</th>
                <th>出库出境总数量</th>
                <th>可出库存</th>
                <th>待出库存</th>
                <th>出库待集报数量</th>
                <th>待减数量</th>
                <th>海关商品备案号</th>
                <th>海关商品编码</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <{if $productInventoryRows}>
            <{foreach from=$productInventoryRows item=productInventoryRow name=productInventoryRow}>
            <tr>
                <td><{$productInventoryRow.goods_id}></td>
                <td><{$productInventoryRow.stock_in_all}></td>
                <td><{$productInventoryRow.stock_in_td}></td>
                <td><{$productInventoryRow.stock_out_all}></td>
                <td><{$productInventoryRow.stock_qty}></td>
                <td><{$productInventoryRow.stock_frozen}></td>
                <td><{$productInventoryRow.stock_out_td}></td>
                <td><{$productInventoryRow.amount_to_reduce}></td>
                <td><{$productInventoryRow.cus_goods_id}></td>
                <td><{$productInventoryRow.code_ts}></td>
                <td><a href="javascript:void(0);" class="veiwDialog" data-url="/storage/inventory/product-view/piId/<{$productInventoryRow.pi_id}>">查看</a></td>
            </tr>
            <{/foreach}>
        <{/if}>
        </tbody>
    </table>
</form>
<div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>

<script type="text/javascript">
$('.veiwDialog').viewToDialog();
</script>