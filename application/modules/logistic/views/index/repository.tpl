<div class="content-box  ui-tabs  ui-corner-all">
	<form action="/merchant/product/repository" method="post" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
		<input type="hidden" id="from" name="from" value="<{$from}>">
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <input type="hidden" name="customer" value="<{$customer}>" id="customer" />
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td nowrap="nowrap">
                        
						<{t}>ProductSKU<{/t}>：<input type="text" name="sku" class="text-input fix-small-input" value="<{$params.product_sku}>"/>
					</td>
					<td nowrap="nowrap">
                        <{t}>pname<{/t}>：<input type="text" name="title" class="text-input fix-small-input" value="<{$params.product_title}>"/>
					</td>				
					<td nowrap="nowrap">
					<a  class="button" href="#" onclick="do_search();return false;"><{t}>search<{/t}></a>
					
					</td>
				</tr>

			</table>
			
		</div>
	</form>



	<table class="table list" width="100%"  id="loadData" style="margin-bottom:10px;margin-top:5px">
		<thead class="caption">
			<tr>
				<th align="center" style="width:4em"><{t}>Use<{/t}></th>
				<th align="center" style="width:10em" ><{t}>ProductSKU<{/t}></th>
				<th align="center"><{t}>pname<{/t}></th>
				<th align="center" style="width:12em"><{t}>addTime<{/t}></th>
				
			</tr>
		</thead>
		<tbody>
			<{if $result|@count gt 0}>
				<{foreach from=$result item=item}>
					<tr>
						<td align="center" style="width:15px; text-align:center"><input type="checkbox" name="pid"  productSku="<{$item['product_sku']}>" productId="<{$item['product_id']}>" productName="<{$item['product_title']}>" productSalesValue="<{$item['product_sales_value']}>" category="<{$item['pc_name']}>" productWeight="<{$item['product_weight']}>" option="{id:<{$item['product_id']}>,sku:'<{$item['product_sku']}>'}"  class="<{$from}>actionSku" /></td>					
						<td style="width:100px; "><{$item['product_sku']}></td>
						<td title="<{$item['product_title']}>"><{$item['product_title_short']}></td>
						<td nowrap="nowrap"><{$item['product_add_time']}></td>
						
					</tr>					
				<{/foreach}>	
			<{/if}>
		</tbody>
	</table>
		<div class="panelBar">
		<!--<div class="pages">
			
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="dialogPageBreak({numPerPage:this.value})">
				<option value="20" <{if $pageSize eq 20}>selected<{/if}>>20</option>
				<option value="50" <{if $pageSize eq 50}>selected<{/if}>>50</option>
				<option value="100" <{if $pageSize eq 100}>selected<{/if}>>100</option>
			</select>
			
			<span>条，共<{$count}>条数据</span>

		</div>!-->
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
		var sku = $("input[name='sku']").val();
		var title = $("input[name='title']").val();
		var type = $("#type").val();
        //var page_index = page_index||$('#current').val();
		getProductListBoxData(from,page_index+1,pageSize,sku,title,type);
		return false;
	}
	
	

	
	
});

	function do_search(){
		var from = $('#from').val();	
		var sku = $("input[name='sku']").val();
		var title = $("input[name='title']").val();
		var type = $("#type").val();
        var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');
		var customer = $("#customer").val();
		getProductListBoxData(from,1,pageSize,sku,title,type,customer);
	
	}
	
	$(function(){     
    	$("#loadData").alterBgColor();	
    	keepTheInterface();
		$('#dialog').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			position:['center','top'],
			width: 900,	
			height:'auto',
			draggable:true,			
			resizable: true			
		});
		//$('.ui-dialog').draggable();
		
	});
	
	/*选则项要跟页面一致*/
	function keepTheInterface(){
	
		var pre_id_name ='#orderproduct';
		if($('#from').val()=='asn'){
			pre_id_name ='#asnproduct';
		}
		if($('#from').val()=='productCombine'){
			pre_id_name ='#subProduct';
		}			
		
		//alert($('#from').val());	
		
		var pids = $("input[name='pid']");
		//alert(pids.size());
		if(pids.size()==0){return;}		
			pids.each(function(i){
				_this = $(this);				
				var product_id = _this.attr('productid');
				//alert($("#orderproduct"+product_id).size());						
				if($(pre_id_name+product_id).size()==0){					
					_this.attr("checked",false);					
				}else{
					_this.attr("checked",true);
				}
				/*
				if($("#asnproduct"+product_id).size()==0){					
					_this.attr("checked",false);
				}else{
					_this.attr("checked",true);
				}
				*/			
				
			}); 
			resetbgcolor();
	}		
	
	
	
	
	function resetbgcolor(){

		var pids = $("input[name='pid']");
		if(pids.size()==0){return;}		
		pids.each(function(i){
				_this = $(this);
				if(_this.is(':checked')){								
					set_tr_class(_this.parent().parent(), true);
				}else{			
					set_tr_class(_this.parent().parent(), false);	
				}
				//alert(_this.parent().parent().attr('rel'));
		});	
	}	
</script>