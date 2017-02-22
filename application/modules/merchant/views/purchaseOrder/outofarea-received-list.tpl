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
        <h3 style="margin-left:5px"><{t}>out_of_area_received_list<{/t}></h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/merchant/purchase-order/outofarea-received-list" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <input type="hidden" value="<{$params.receiving_status}>" name="receiving_status">
        <div class="searchBar">
            <table  class="border"  id="searchbox">
                <tbody>
                <tr>
                    <td  class="form_title"><{t}>tracking_number<{/t}>：</td>
                    <td  class="form_input"><input class="text-input width180 leftloat" type="text"  name="tracking_number" value="<{$params['tracking_number']}>">
					
						<div class="simplesearchsubmit" style="float:left;">
						<a  onclick="$('#pagerForm').submit()" class="button"><{t}>search<{/t}></a>
						<a type="button" class="button export" ><{t}>export<{/t}></a>
						<a class="switch_search_model">切换到高级搜索</a> 
						
						</div>
					
					
					
					</td>
                    <td  class="form_title"><span class="advanced_element"><{t}>purchase_order_code<{/t}>：</span></td>
                    <td  class="form_input" colspan="3"><span class="advanced_element"><input class="text-input width180" type="text"  name="po_code" value="<{$params['po_code']}>"></span></td>

                </tr>

               
					<tr  class="advanced_element">					
                    <td   class="form_title"><span class="advanced_element"><{t}>createDate<{/t}>：</span></td>
                    <td colspan="5"   class="form_input"  nowrap="nowrap">
					  <span class="advanced_element">
                        <input type="text" class="datepicker text-input width180" value="<{$params.created_start|date_format:'%Y-%m-%d'}>" name="created_start" readonly="true">&nbsp;到&nbsp;
                        <input type="text" class="datepicker text-input width180" value="<{$params.created_end|date_format:'%Y-%m-%d'}>" name="created_end" readonly="true">
                        <input type="hidden" value="<{$params.receiving_status}>" name="receiving_status" id="receiving_status">
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

</div>



<div class="clear"></div>

    <div class="grid">
        <form  method="post" id='DataForm'   target="_blank">
            <table   style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
                <thead>
                <tr>
                    <th style="text-align:center;width:25px"><input type="checkbox" class="ordercheckAll"></th>
                    <th  ><{t}>tracking_number<{/t}></th>
                    <th  ><{t}>express_company<{/t}></th>
                    <th  ><{t}>purchase_order_code<{/t}></th>
                    <th  ><{t}>sku<{/t}></th>
					<th  ><{t}>QuantityReceived<{/t}></th>
                    <th  ><{t}>createDate<{/t}></th>
					<th  ><{t}>status<{/t}></th>
					<th  ><{t}>ReceiveCode<{/t}></th>
                    <th  ><{t}>operate<{/t}></th>
                </tr>
                </thead>
                <tbody>
                <{if $result neq ""}>
                <{foreach from=$result item=item}>
                    <tr target="pid">
                        <td style="text-align:center;width:25px"><input type="checkbox" name="orderArr[]" ref="<{$item['po_tb_id']}>" class="orderArr" value="<{$item['po_tb_id']}>" /></td>
                        <td style="text-align:center;">
                           <span><{$item['tracking_number']}></span>
                        </td>
                        <td style="text-align:center"><{$item['express_company']}></td>
                        <td style="text-align:center">
                            <{$item['po_code']}>
                        </td>
                        <td style="text-align:center"><{$item['product_sku']}></td>
						<td style="text-align:center"><{$item['received_quantity']}></td>
                        <td style="text-align:center" nowrap="nowrap"><{$item['create_time']}></td>
						<td style="text-align:center" nowrap="nowrap"><{$item['po_tb_status_text']}></td>
						<td style="text-align:center" nowrap="nowrap"><{$item['receiving_code']}></td>
                        <td style="text-align:center">        	     
					
                            <a class="view" href="/merchant/purchase-order/purchase-received-detail?po_t_id=<{$item['po_t_id']}>"
                               onclick="parent.openMenuTab('/merchant/purchase-order/purchase-received-detail?po_t_id=<{$item['po_t_id']}>','<{t}>PurchaseReceivedDetail<{/t}>(<{$item.receiving_code}>)','PurchaseReceivedDetail<{$item.po_t_id}>');return false;" title="<{t}>PurchaseReceivedDetail<{/t}>" ><span><{t}>view<{/t}></span></a>
							   
							<{if $item['po_tb_status']=='0'}>
								<a href="" onclick="closePurchaseOrderTrackingBody('<{$item['po_tb_id']}>');return false;">转为已审核</a>
							<{/if}>   
							   
							   
                        </td>
                    </tr>
                    <{/foreach}>
                <{else}>
                <tr>
                    <td colspan="10"  style="text-align:center"><{t}>NoDate<{/t}></td>
                </tr>
                <{/if}>

                </tbody>
            </table>
        </form>
    </div>
	<div class="clear"></div>
    <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"></div>


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

                    $('#DataForm').attr('action','/merchant/purchase-order/outofarea-received-export');
                    $('#DataForm').attr('method','POST');
                    $('#DataForm').submit();

                    $('#DataForm').removeAttr('action');
                    $('#DataForm').removeAttr('method');

                }else if(exportType=='0'){
                    //全部的
                    $('#pagerForm').attr('action','/merchant/purchase-order/outofarea-received-export');
                    $('#pagerForm').attr('method','POST');
                    $('#pagerForm').submit();
                    $('#pagerForm').attr('action','/merchant/purchase-order/outofarea-received-list');
                    //$('#orderDataForm').removeAttr('method');

                }
                return;
            }
        }
    });	

   $('.export').bind('click',function(){

       $('#exportdialog').dialog('open');
   });	
    
})
</script>

<script type="text/javascript" src='/loadjs/loadjs/name/purchaseorderTracking'></script>