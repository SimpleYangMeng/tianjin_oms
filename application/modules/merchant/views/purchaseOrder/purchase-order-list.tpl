<style type="text/css">
    .btn:hover, .btn:focus, .btn-active, .btn-sub {
        background:#5998D7;
        color: #333;
    }
    .clear{
        clear: both;
    }
    .print{
        margin: 5px;
    }
</style>

<div class="content-box  ui-tabs  ui-corner-all  ui-widget ui-widget-content">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><{t}>purchase_order_list<{/t}></h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/merchant/purchase-order/purchase-order-list" id="pagerForm">
        <input type="hidden" name="page" value="1" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <input type="hidden" value="<{$params.receiving_status}>" name="receiving_status">
        <div class="searchBar">
            <table  class="border"  id="searchbox">
                <tbody>
                <tr>
					<td  class="form_title"><{t}>sku<{/t}>：</td>
					<td  class="form_input"><input class="text-input width140 leftloat" type="text"  name="product_sku" value="<{$params['product_sku']}>"/></td>
                    <td  class="form_title"><{t}>purchase_order_code<{/t}>：</td>
                    <td  class="form_input"><input class="text-input width140 leftloat" type="text"  name="po_code" value="<{$params['po_code']}>">
					
						<div class="simplesearchsubmit" style="float:left;">
						<a  onclick="$('#pagerForm').submit()" class="button"><{t}>search<{/t}></a>
						<a type="button" class="button export" ><{t}>export<{/t}></a>
						<a class="switch_search_model">切换到高级搜索</a> 
						
						</div>
					
					
					
					</td>
                    <td  class="form_title"><span class="advanced_element"><{t}>status<{/t}>：</span></td>
                    <td  class="form_input" colspan="3">
					
						<span class="advanced_element">
                        <select name="pobd_status" class="text-input width155">
                            <option value=""><{t}>all<{/t}></option>
                            <{foreach from=$purchase_order_status_list key=k item=wh }>
                            <option value="<{$k}>" <{if $k==$params.pobd_status && $params.pobd_status!=''}>selected<{/if}>><{$wh}></option>
                            <{/foreach}>
                        </select>
						</span>
					
					
					</td>


                </tr>

               
					<tr class="advanced_element">					
                    <td   class="form_title"><span class="advanced_element"><{t}>createDate<{/t}>：</span></td>
                    <td colspan="4"   class="form_input"  nowrap="nowrap">
					  <span class="advanced_element">
                        <input type="text" class="datepicker text-input width140" value="<{$params.created_start}>" name="created_start" readonly="true">&nbsp;到&nbsp;
                        <input type="text" class="datepicker text-input width140" value="<{$params.created_end}>" name="created_end" readonly="true">
                       
						</span>
						

						<div class="advancedsearchsubmit">
						<a  onclick="$('#pagerForm').submit()" class="button"><{t}>search<{/t}></a> 
						<a type="button" class="button export" ><{t}>export<{/t}></a>
						<a class="switch_search_model">切换到高级搜索</a>
						
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </form>








<div class="clear"></div>

    <div class="grid">
        <form  method="post"  target="_blank" id='DataForm'>
            <table   style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
                <thead>
                <tr>
                    <th style="text-align:center;width:25px"><input type="checkbox" class="ordercheckAll"></th>
                    <th  ><{t}>purchase_order_code<{/t}></th>
					<th  ><{t}>supplier_code<{/t}></th>                   
           			<th  ><{t}>sku<{/t}></th>
					<th  ><{t}>pname<{/t}></th>
					<th  ><{t}>purchase_order_quantity<{/t}></th>
					<th  ><{t}>PendingReceiveQuantity<{/t}></th>        
                    <th  ><{t}>createDate<{/t}></th>
					<th  ><{t}>status<{/t}></th>
                    <th  ><{t}>operate<{/t}></th>
                </tr>
                </thead>
                <tbody>
                <{if $result neq ""}>
                <{foreach from=$result item=item}>
                    <tr target="pid">
                        <td style="text-align:center;width:25px"><input type="checkbox" name="orderArr[]" ref="<{$item['pobd_id']}>" class="orderArr" value="<{$item['pobd_id']}>" /></td>
                        <td style="text-align:center;">
						
						<{$item['po_code']}>
                           
                        </td>
						<td style="text-align:center"><{$item['supply_code']}></td>             
						<td style="text-align:center"><{$item['product_sku']}></td>   
						<td style="text-align:center"><{$item['product_title']}></td>   
						<td style="text-align:center"><{$item['order_quantity']}></td>   
                        <td style="text-align:center"><{$item['order_quantity']-$item['received_quantity']}></td>   		
						
                        
                        <td style="text-align:center" nowrap="nowrap"><{$item['create_time']}></td>
						
						
						<td style="text-align:center"><{$item['pobd_status_text']}></td>
                        <td style="text-align:center">                          
							
                            <a class="view" href="/merchant/purchase-order/outofarea-received-detail?po_id=<{$item['po_id']}>"
                               onclick="parent.openMenuTab('/merchant/purchase-order/outofarea-received-detail?po_id=<{$item['po_id']}>','<{t}>purchase_order_detail<{/t}>(<{$item.po_id}>)','purchase_order_detail<{$item.po_id}>');return false;" title="<{t}>purchase_order_detail<{/t}>" ><span><{t}>view<{/t}></span></a>
							   <{if $item['pobd_status'] eq '1'}><a href="/" onclick="closePurchaseOrderBody('<{$item['pobd_id']}>');return false;">关闭</a><{/if}>
                        </td>
                    </tr>	
					
					
                    <{/foreach}>
                <{else}>
                <tr>
                    <td colspan="10" style="text-align:center"><{t}>NoDate<{/t}></td>
                </tr>
                <{/if}>

                </tbody>
            </table>
        </form>
    </div>
	<div class="clear"></div>
    <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"></div>



</div>
<div id="exportdialog" title="<{t}>export<{/t}>" style="display:none">
	<input type="radio" name="exportType" value="1" checked="checked"/> <{t}>selected<{/t}> <input type="radio" name="exportType" value="0"/> <{t}>all<{/t}>
</div>
<script>
$(function(){
   //
    $("#loadData").alterBgColor();
	$("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element'});
	
	


   $('#exportdialog').dialog({
        autoOpen: false,
        modal: false,
        bgiframe:true,
        width: 850,
        resizable: true,
		position:[50,150],
        close:function(){
            //alert('close');
        },buttons:{
            '<{t}>close<{/t}>': function() {
                $('#exportdialog').dialog('close');
            },'<{t}>Determine<{/t}>': function() {

                var exportType = $('[name=exportType]:checked').val();
                var exportformat = $('[name=exportformat]:checked').val();
                $('.dateformate').val(exportformat);
                if(exportType=='1'){
                    //选择的订单
                   /* var exportformat = $('[name=exportformat]').val();
                    param+="&exportType="+exportType;
                    param+="&exportformat="+exportformat;

                    alert(exportType);*/

                    var param = $("#DataForm").serialize();
                    var checkedSizesize = $('.orderArr:checked').size();
                    if(checkedSizesize<=0){
                        alertTip("<{t}>pleaseOne<{/t}>",'500','auto','1');
                        return;
                    }
                    //alert($('#pagerForm').attr('action'));

                    $('#DataForm').attr('action','/merchant/purchase-order/purchase-order-export');
                    $('#DataForm').attr('method','POST');
                    $('#DataForm').submit();

                    $('#DataForm').removeAttr('action');
                    $('#DataForm').removeAttr('method');

                }else if(exportType=='0'){
                    //全部的
                    $('#pagerForm').attr('action','/merchant/purchase-order/purchase-order-export');
                    $('#pagerForm').attr('method','POST');
                    $('#pagerForm').submit();
                    $('#pagerForm').attr('action','/merchant/purchase-order/purchase-order-list');
                    //$('#orderDataForm').removeAttr('method');

                }
                return;
            }
        }
    });	

   $('.export').bind('click',function(){

       $('#exportdialog').dialog('open');
   });
	
    
});
</script>
<script type="text/javascript" src='/loadjs/loadjs/name/purchaseorder'></script>