<style type="text/css">
    .btn:hover, .btn:focus, .btn-active, .btn-sub {
        background-color: #666;
        color: #FFFFFF;
    }
</style>
<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
		<h3 class="clearborder" style="margin-left:5px;">请选择个人物品清单</h3>
    </div>
    <form name="searchASNorderForm"  method="post" action="/merchant/personalItems/order-list" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <input type="hidden" value="<{$orders_status}>" name="orders_status" class='status'>
        <div class="searchBar">
            <table  class="left" cellspacing="5" cellpadding="5">
                <tbody>
                <tr>
                    <td><{t}>orderCode<{/t}>/<{t}>TradingOrderNo<{/t}>:</td>
                    <td>
                        <input type="text" class="text-input width120" name="order_code" id='orders_code' value="<{$params.order_code}>">
                    </td>
                    <td><{t}>wb_code<{/t}>：</td>
                    <td align='left'>
                        <input type="text" class="text-input width120" value="<{$params.wb_code}>" name="wb_code">
                    </td>
                    <td><{t}>po_code<{/t}>：</td>
                    <td>
                        <input type="text" class="text-input width120" value="<{$params.po_code}>" name="po_code"  />
                    </td>
                </tr>
                <tr>
                    <td><{t}>createDate<{/t}>:</td>
                    <td colspan="4">
                        <input type="text" class="datepicker text-input width120 " value="<{$params.add_time_start}>" name="add_time_start" readonly="true">~
                        <input type="text" class="datepicker text-input width120 " value="<{$params.add_time_end}>" name="add_time_end" readonly="true">
                        <input type="hidden" value="<{$orders_status}>" name="orders_status" class="status">
                        <a onclick="do_search();return false;" class="button"><{t}>search<{/t}></a>
                     <{*  <a type="button" class="button" value="0" id="foldToggle"><{t}>Expand<{/t}>/<{t}>Collapse<{/t}></a>*}>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </form>
</div>
<div class="clear"></div>
<div class="content-box  ui-tabs  ui-corner-all cl" style="margin-top: 2px;">
	<form  method="post" id='orderDataForm'>
	    <table id="loadData"  class="table" width="100%" layoutH="138">
	        <thead class="caption">
	        <tr>
	            <th style="text-align:center;" ><{t}>orderCode<{/t}></th>
	            <th style="text-align:center;">运单号</th>
	            <th style="text-align:center;" >支付单号</th>
	            <th style="text-align:center;" >仓储物流企业</th>
	            <th style="text-align:center;" >创建时间</th>
	            <th style="text-align:center;" >申报时间</th>
	            <th style="text-align:center;" ><{t}>operate<{/t}></th>
	        </tr>
	        </thead>
	        <tbody>
	        <{if $result neq ""}>
	        <{foreach from=$result item=item}>
	            <tr class="" target="pid" rel="<{$item['pim_id']}>"  >
	                <td style="width:30px;text-align:center" nowrap="nowrap"><a href="javascript:void(0);" onclick="showProduct('<{$item['order_code']}>')"><{$item['order_code']}></a></td>
	                <td style="width:60px;text-align:center"><{$item['wb_code']}></td>
	                <td style="width:60px;text-align:center"><{$item['po_code']}></td>
	                <td style="width:60px;text-align:center"><{$item['warehouse_name']}></td>
	                <td style="width:60px;text-align:center"><{$item['pim_add_time']}></td>
	                <td style="width:60px;text-align:center" nowrap="nowrap"><{$item['declare_time']}></td>
	                <td style="width:60px;text-align:center">
	                	<input type="checkbox" name="oid" state="<{$item['status']}>"  po_code='<{$item['po_code']}>' orderCode="<{$item['order_code']}>" wb_code="<{$item['wb_code']}>" orderId="<{$item['pim_id']}>" declareTime="<{$item['declare_time']}>" createDate="<{$item['pim_add_time']}>" warehouse_name='<{$item['warehouse_name']}>' class="actionOrder" />
	                </td>
	            </tr>
	            <tr class="order_product son"    id="<{$item['order_code']}>" status="0">
	                <td colspan="7" >
	                   <table style="float:left;width:100%; margin:0;padding:0;border:1px solid #CCCCCC;border-collapse:collapse;">
		<tr >
			<td style="text-align:center"  nowrap="nowrap"><{t}>ProductSKU<{/t}></td>
			<td style="text-align:center"  nowrap="nowrap"><{t}>quantity<{/t}></td>
			<td style="text-align:center"  nowrap="nowrap"><{t}>productTitle<{/t}></td>
			<td style="text-align:center"  nowrap="nowrap"><{t}>specificationModel<{/t}></td>
			<td style="text-align:center"  nowrap="nowrap"><{t}>Unit<{/t}></td>
			<td style="text-align:center"  nowrap="nowrap"><{t}>UnitPrice<{/t}></td>
			<td style="text-align:center"  nowrap="nowrap"><{t}>sku_purchase_price<{/t}></td>
			<td style="text-align:center"  nowrap="nowrap"><{t}>Currency<{/t}></td>
		</tr>
		<{if $item['order_product'] neq '' && $item['order_product']|@count neq 0}>
			<{foreach from=$item['order_product'] item=row}>
				<tr>
					<td style="text-align:center" nowrap="nowrap">
	                	<a class="edit"  title="<{t}>ProductDetail<{/t}>" onclick="parent.openMenuTab('/merchant/product/detail?productId=<{$row.product_id}>','产品详细(<{$row.product_sku}>)','productdetail<{$row.product_id}>');return false;">
							<span><{$row.product_sku}></span>
	                	</a>
	               	</td>
	               <td style="text-align:center" nowrap="nowrap"><{$row.g_qty}></td>
	               <td style="text-align:center" nowrap="nowrap"><{$row.category_name}></td>
	               <td style="text-align:center" nowrap="nowrap"><{$row.g_model}></td>
	               <td style="text-align:center" nowrap="nowrap"><{$row.g_uint}></td>
	               <td style="text-align:center" nowrap="nowrap"><{$row.price}></td>
				<td style="text-align:center" nowrap="nowrap"><{$row.total_price}></td>
				<td style="text-align:center" nowrap="nowrap"><{$row.curr}></td>
	             	</tr>
			<{/foreach}>
		<{else}>
			<tr>
				<td colspan="8" style="text-align:center"><{t}>NoDate<{/t}></td>
			</tr>
		<{/if}>
	         </table>
	                </td>
	            </tr>
	            <{/foreach}>
	        <{else}>
	        <tr>
	            <td colspan="7"><{t}>NoDate<{/t}></td>
	        </tr>
	        <{/if}>
	        
	        </tbody>
	    </table>
	</form>
	<div class="pagination" id="Pagination1" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>" ajaxfun='pageselectCallback'></div>
</div>

<script>
$(function(){
    var total = $('#Pagination1').attr('totalcount');
    var currencypage=$('#Pagination1').attr('currentpage');
    var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');

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
        $("[name='page']").val(page_index+1);
        /*var from = $('#from').val();
        var sku = $("input[name='sku']").val();
        var title = $("input[name='title']").val();
        var type = $("#type").val();*/
        //var page_index = page_index||$('#current').val();
        getOrderList();
        return false;
    }
    return false;
});

function do_search(){
    /*var from = $('#from').val();
    var sku = $("input[name='sku']").val();
    var title = $("input[name='title']").val();
    var type = $("#type").val();*/
    var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');
    //getProductListBoxData(from,1,pageSize,sku,title,type);
    getOrderList();
}

//得到订单信息
/*function getOrderList(){
    $.ajax({
        type:'post',
        url:'/merchant/order/list-asn-order',
        data:$('#pagerForm').serializeArray(),
        dataType:'html',
        success:function(html){
            $("#dialog").html(html);
        }
    });
}*/

	/*选则项要跟页面一致*/
	function keepTheInterface(){
		
		var pids = $("input[name='oid']");
		if(pids.size()==0){return;}		
			pids.each(function(i){
				_this = $(this);				
				var orderid = _this.attr('orderid');				
				if($("#asnorder"+orderid).size()==0){					
					_this.attr("checked",false);
				}else{
					_this.attr("checked",true);
				}
				
						
				
			}); 
			
			resetbgcolor();	
	
	}	
	function resetbgcolor(){

		var pids = $("input[name='oid']");
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
$(function(){
   //保持界面一致
   	keepTheInterface();  
    $("#loadData").alterBgColor();
    $('#dialog').dialog({
        autoOpen: false,
		position: ['center','top'],
        modal: false,
        bgiframe:true,
        width: 850,
		minHeight:100,
        resizable: false
    });
    $('.datepicker').datepicker({ dateFormat: "yy-mm-dd"});
})
</script>
<!--<script type="text/javascript" src='/js/order.js'></script>-->
<script type="text/javascript" src='/loadjs/loadjs/name/order'></script>
