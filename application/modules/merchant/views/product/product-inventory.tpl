<form id="pagerForm" method="post" action="/merchant/product/inventory">

    <input type="hidden" value="<{$params.receiving_status}>" name="receiving_status">
    <input type="hidden" name="page" value="1" />
    <input type="hidden" name="pageSize" value="<{$pageSize}>" />

</form>
<div class="pageHeader">
    <form action="/merchant/product/inventory" method="post" onsubmit="return navTabSearch(this);">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        产品SKU：<input type="text" name="sku" class="custom100" value="<{$condition.product_sku}>" />
                    </td>
                    <td>
                        仓储
                        <select name="warehouse_id">
                            <option value="">-Select-</option> <{foreach
                        from=$warehouse item=w name=w}>
                            <option value='<{$w.warehouse_id}>' ><{$w.warehouse_code}></option>
                            <{/foreach}>
                        </select>
                    </td>

                </tr>
            </table>
            <div class="subBar">
                <ul>
                    <li>
                        <div class="buttonActive">
                            <div class="buttonContent"><button type="submit">检索</button></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>
<div class="pageContent">

    <table class="table" width="100%" layoutH="138">
        <thead>
        <tr>
            <th align="center" >产品SKU</th>
			<th align="center" >产品名称</th>
            <th align="center" >仓储</th>
			<th align="center" >在途数量</th>
			<th align="center" >入库中</th>
			<th align="center" >可用库存</th>
			<th align="center" >不可用库存</th>
			<th align="center" >已占用</th>
			<th align="center" >已出库</th>
            <th align='center' >操作</th>
        </tr>
        </thead>
        <tbody>
        <{if $result neq ""}>
        <{foreach from=$result item=item}>
            <tr target="pid" rel="<{$item['product_id']}>">
                <td>
                    <a height="600" width="800" title="产品详情" rel="productView"
                       target="navTab" href="/merchant/product/detail?productId=<{$item['product_id']}>"
                       class="edit"><span><{$item['product_sku']}></span></a>
                </td>
				<td><{$item['product_title_en']}></td>
                <td><{$item['warehouse_code']}></td>
                <td style="text-align: right;"><{$item['pi_onway']}></td>
				<td style="text-align: right;"><{$item['pi_pending']}></td>
				<td style="text-align: right;"><{$item['pi_sellable']}></td>
				<td style="text-align: right;"><{$item['pi_unsellable']}></td>
                <td style="text-align: right;"><{$item['pi_reserved']}></td>
				<td style="text-align: right;"><{$item['pi_shipped']}></td>
                <td>
                    <a rel="productDetailList" target="navTab" title="库存信息" href="/merchant/product/inventory-log/productId/<{$item['product_id']}>/pi_id/<{$item['pi_id']}>">
						<img alt="View" src="/images/icon_view.gif" />
					</a>
                </td>
            </tr>
            <{/foreach}>
        <{/if}>
        </tbody>
    </table>
    <div class="panelBar">
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="20" <{if $pageSize eq 20}>selected<{/if}>>20</option>
                <option value="50" <{if $pageSize eq 50}>selected<{/if}>>50</option>
                <option value="100" <{if $pageSize eq 100}>selected<{/if}>>100</option>
            </select>
            <span>条，共<{$count}>条数据</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"></div>
    </div>
</div>
