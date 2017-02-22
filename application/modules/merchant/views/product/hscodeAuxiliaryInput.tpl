<!--海关编码辅助输入!-->
<div class="content-box  ui-tabs  ui-corner-all">
	<form action="/merchant/product/hscode-auxiliary-input" method="post" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
		<input type="hidden" id="from" name="from" value="<{$from}>">
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td nowrap="nowrap">
                        
						<{t}>CustomsCode<{/t}>：<input type="text" name="s_hs_code" class="text-input fix-small-input" value="<{$params.hs_code}>"/>
					</td>
					
					
					<td nowrap="nowrap">
                        
						<{t}>pname<{/t}>：<input type="text" name="p_name" class="text-input fix-small-input" value="<{$params.p_name}>"/>
					</td>
					
				
					<td nowrap="nowrap">
					<a  class="button" href="#" onclick="do_search();return false;"><{t}>search<{/t}></a>
					
					</td>
				</tr>
			</table>
			
		</div>
	</form>



	<table class="table list" width="100%"  id="loadData" style="margin-bottom:10px;margin-top:15px">
		<thead class="caption">
			<tr>
				<th align="center" width='180' ><{t}>CustomsCode<{/t}></th>
				<th align="center" width='180' ><{t}>pname<{/t}></th>
				<th align="center" width="50"><{t}>Use<{/t}></th>
			
			</tr>
		</thead>
		<tbody>
			<{if $result|@count gt 0}>
				<{foreach from=$result item=item}>
					<tr>
						<td><{$item['hs_code']}></td>	
						<td><{$item['p_name']}></td>				
						<td align="center"><input type="checkbox" name="pid"  hs_code="<{$item['hs_code']}>"   class="<{$from}>actionSku" <{if $globals_hs_code eq $item['hs_code']}>checked<{/if}> /></td>
					</tr>					
				<{/foreach}>	
			<{/if}>
		</tbody>
	</table>
		<div class="panelBar">
	
        <div class="pagination" id="Pagination1" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>" ajaxfun='pageselectCallback'>
		</div>
		<div class="clear"></div>
		</div>
		
		</div>
		
	<script type="text/javascript">
	$(function(){
	//此demo通过Ajax加载分页元素
    var total = $('#Pagination1').attr('totalcount');
    var currencypage=$('#Pagination1').attr('currentpage');
    var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');
	var from = $('#from').val();

	var initPagination = function() {
		var num_entries = total;
		// 创建分页
		$("#Pagination1").pagination(num_entries, {
			num_edge_entries: 1, //边缘页数
			num_display_entries: 4, //主体页数
			callback: pageselectCallback,
			items_per_page: pageSize, //每页显示1项
			prev_text: "<{t}>Previous<{/t}>",
			next_text: "<{t}>Next<{/t}>",
			current_page:currencypage-1
		});
	 };
	 
	initPagination();
	function pageselectCallback(page_index, jq){
		var from = $('#from').val();	
		var p_name = $("input[name='p_name']").val();
		
        //var page_index = page_index||$('#current').val();
		getHScodeListBoxData(from,page_index+1,pageSize,p_name);
		return false;
	}
	
	

	
	
});

	function do_search(){
		var from = $('#from').val();	
		var p_name = $("input[name='p_name']").val();
		var s_hs_code = $("input[name='s_hs_code']").val();
        var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');
		getHScodeListBoxData(from,1,pageSize,p_name,s_hs_code);
	
	}
	
$(function(){
   //按默认类   
    $("#loadData").alterBgColor();
    
})
	</script>