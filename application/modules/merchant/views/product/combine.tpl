<!--此页可能是废弃页面!-->
<form id="pagerForm" method="post" action="/merchant/product/combine">
	<input type="hidden" name="sku" value="<{$params['product_sku']}>">
	<input type="hidden" name="title" value="<{$params['product_title']}>" />
	<input type="hidden" name="time" value="<{$params['product_add_time']}>" />
	<input type="hidden" name="page" value="1" />
	<input type="hidden" name="pageSize" value="<{$pageSize}>" />
</form>
<div class="pageHeader">
	<form action="/merchant/product/combine" method="post" onsubmit="return navTabSearch(this);">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						组合SKU：<input type="text" name="sku" class="custom100"/>
					</td>
					<td>
						组合名称：<input type="text" name="title" />
					</td>				
					<td>
						创建日期：<input type="text" name="time" class="date" readonly="true"  minDate="2013-06-01" />
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
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/merchant/product/combine-add" target="navTab" rel="combineAdd" title="新增组合"><span>添加</span></a></li>
			<li class="line">line</li>
			<li><a class="edit" href="/merchant/product/combine-edit?id={pid}" target="navTab" rel="combineEdit"  title="修改组合"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="delete" href="/merchant/product/combine-del?id={pid}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>			
		</ul>
	</div>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th align="center" width="150" >组合SKU</th>
				<th align="center" >组合名称</th>
				<th align="center" width="100">组合数量</th>
				<th align="center" width="150">添加日期</th>
			</tr>
		</thead>
		<tbody>
			<{if $result neq ""}>
				<{foreach from=$result item=item}>
					<tr target="pid" rel="<{$item['product_id']}>">
						<td><{$item['product_sku']}></td>
						<td><{$item['product_title']}></td>
						<td><{$item['product_barcode']}></td>
						<td><{$item['product_add_time']}></td>
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
<script type="text/javascript">
    $(function(){
        $(".subProductDel").live("click",function(){
            $(this).parent().parent().remove();
        });
    });
</script>


