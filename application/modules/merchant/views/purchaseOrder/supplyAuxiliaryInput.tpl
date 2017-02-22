<div class="content-box  ui-tabs  ui-corner-all">
	<form action="/merchant/purchase-order/supplycode-auxiliary-input" method="post" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
		<input type="hidden" id="from" name="from" value="<{$from}>">
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td nowrap="nowrap">
                        
						<{t}>supplier_code<{/t}>：<input type="text" name="s_supplier_code" class="text-input fix-small-input" value="<{$params.supplier_code}>"/>
					</td>
					
					
					<td nowrap="nowrap">
                        
						<{t}>Supplier<{/t}>：<input type="text" name="s_supplier_name" class="text-input fix-small-input" value="<{$params.supplier_name}>"/>
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
				<th align="center" width='180' ><{t}>supplier_code<{/t}></th>
				<th align="center" width='180' ><{t}>Supplier<{/t}></th>
				<th align="center" width="50"><{t}>Use<{/t}></th>
			
			</tr>
		</thead>
		<tbody>
			<{if $result|@count gt 0}>
				<{foreach from=$result item=item}>
					<tr>
						<td><{$item['distributor_code']}></td>	
						<td><{$item['distributor_name']}></td>				
						<td style="text-align:center;width:30px"><input type="radio" name="pid"  supply_code="<{$item['distributor_code']}>"   class="<{$from}>actionSku" <{if $selected_supplier_code eq $item['distributor_code']}>checked<{/if}> /></td>
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
		
		var supplier_code = $("input[name='s_supplier_code']").val();
		var supplier_name = $("input[name='s_supplier_name']").val();		
        //var page_index = page_index||$('#current').val();
		getPurchaseOrderData(page_index+1,pageSize,supplier_code,supplier_name);
		return false;
	}
	
	

	
	
});

	function do_search(){	
			
		var supplier_code = $("input[name='s_supplier_code']").val();
		var supplier_name = $("input[name='s_supplier_name']").val();
        var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');
		getPurchaseOrderData(1,pageSize,supplier_code,supplier_name);
	
	}
	
$(function(){
   //按默认类   
    $("#loadData").alterBgColor();	
	var default_supplier_code = $('#supply_code').val();
	//$("input[name='s_supplier_code']").val(default_supplier_code);
	keepTheInterface();	
    //do_search();
});


	
	/*选则项要跟页面一致*/
	function keepTheInterface(){
		var default_supplier_code = $('#supply_code').val();		
		var pids = $("input[name='pid']");
		//alert(pids.size());
		if(pids.size()==0){return;}		
			pids.each(function(i){
				_this = $(this);				
				var supply_code = _this.attr('supply_code');
										
				if(default_supplier_code == supply_code){												
					_this.attr("checked",true);	
					set_tr_class(_this.parent().parent(), true);				
				}else{
					set_tr_class(_this.parent().parent(), false);	
					//_this.attr("checked",false);
				}
				/*
				if($("#asnproduct"+product_id).size()==0){					
					_this.attr("checked",false);
				}else{
					_this.attr("checked",true);
				}
				*/			
				
			}); 
			
	}		
	
	
	
	
	


	</script>