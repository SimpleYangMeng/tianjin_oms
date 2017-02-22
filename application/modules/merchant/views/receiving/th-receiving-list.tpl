<style type="text/css">
    .btn:hover, .btn:focus, .btn-active, .btn-sub {
        background: #5998D7;
        color: #333;
    }
    .clear{
        clear: both;
    }
    .print{
        margin: 5px;
    }
    .condiv{
        float: left;
        margin-bottom: 5px;
        margin-left: 5px;
        width: 220px;
    }
    .changewidth .width140{
        width:130px;
    }
    .changewidth .width155{
        width:140px;
    }
    .condatediv{
        float: left;
        margin-bottom: 5px;
        margin-left: 5px;
    }
</style>

<div class="content-box  ui-tabs  ui-corner-all  ui-widget ui-widget-content" >
    <div class="content-box-header">
        <h3 style="margin-left:5px"><{t}>ReturnASNList<{/t}></h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/merchant/receiving/listth" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <input type="hidden" value="<{$params.receiving_status}>" name="receiving_status">
        <div class="searchBar ">
            <table class="searchbartable" cellspacing="2" cellpadding="2"  border="0" id="searchbox">
                <tr>
                    <td  align="right" nowrap="nowrap" width="140" class="text_right"><{t}>ReceiveCode<{/t}>/<{t}>CustomerReference2<{/t}>：</td>
                    <td    style="text-align:left;"><input class="text-input width140 leftloat" type="text"  name="receiving_code" value="<{$params['receiving_code_like']}>">
					<div class="simplesearchsubmit" style="float:left;margin-top:4px;">
						<a  onclick="$('#pagerForm').submit()" class="button"><{t}>search<{/t}></a> 
						<a  class="button export" ><{t}>export<{/t}></a>
						<a class="switch_search_model"><{t}>switch_to_advanced_search<{/t}></a>					</div>					</td>
                    <td align="right" nowrap="nowrap"><span  class="advanced_element"><{t}>order_code_or_tranction_order_code<{/t}>：</span></td>
                    <td >
                        <span  class="advanced_element">
                            <input type="text" class="text-input width140" value="<{$params.order_key_code}>" name="order_key_code" />
                        </span>
                    </td>
                </tr>
                <tr  class="advanced_element">
                    <td align="right" nowrap="nowrap" class="text_right"><{t}>DeliveryWarehouse<{/t}>：</td>
                    <td>
                        <select name="warehouseId" class="text-input width155">
                            <option value="">-<{t}>all<{/t}>-</option>
                            <{foreach from=$warehouseArr key=k item=wh }>
                            <option value="<{$wh.warehouse_id}>" <{if $wh.warehouse_id==$params.warehouse_id}>selected<{/if}>><{$wh.warehouse_name}></option>
                            <{/foreach}>
                        </select>
                    </td>
                    <td nowrap="nowrap" width="140" style="text-align: right;"><{t}>customerCode<{/t}>：</td>
                    <td nowrap="nowrap">
                        <select class="text-input width135" name='customerCode'>
                            <{if $customerLogin.customer_type!='1'}>
                                <option value=''>全部</option>
                            <{/if}>
                            <{foreach from=$customerLogin.priv_customer_code_arr item=customer}>
                                    <option value='<{$customer}>' <{if $customer==$params.customerCode}>selected<{/if}>><{$customer}></option>
                            <{/foreach}>
                       </select>
                    </td>
                </tr>
                <tr  class="advanced_element">
                    <td   class="text_right"><{t}>createDate<{/t}>：</td>
                    <td colspan="5" style=" text-align:left;">
                        <input type="text" class="datepicker text-input width140" value="<{$params.created_start|date_format:'%Y-%m-%d'}>" name="created_start" readonly="true">&nbsp;<{t}>To<{/t}>&nbsp;
                        <input type="text" class="datepicker text-input width140" value="<{$params.created_end|date_format:'%Y-%m-%d'}>" name="created_end" readonly="true">
                        <input type="hidden" value="<{$params.receiving_status}>" name="receiving_status" id="receiving_status">                    </td>
                </tr>
				<tr  class="advanced_element">
					<td colspan="6" style="  text-align:left">
							<div class="advancedsearchsubmit">	
					            <a  onclick="$('#pagerForm').submit()" class="button"><{t}>search<{/t}></a> 
								<a  class="button export" ><{t}>export<{/t}></a>
								<a class="switch_search_model"><{t}>switch_to_advanced_search<{/t}></a>							</div>					</td>
				</tr>
            </table>
           

        </div>
    </form>

</div>


<div class="btn_wrap">
    <{foreach from=$AsnStatusArr item=v name=v key=k}>
    <input  class="statusBtn btn<{if $params.receiving_status==$k}> btn-active<{/if}>" value="<{$v}>"
            name="<{$v}>" type='button' ref='<{$k}>' id='statusBtn<{$k}>' >
    <{/foreach}>
</div>



<{if $params.receiving_status eq '1' }>
<div class="bulk-actions align-left" style="margin-top: 5px;  border-radius: 4px 4px 4px 4px;">
<select name="dropdown" class="text-input width140" id="batchSelect">
<option value=''><{t}>PleaseSelectOperating<{/t}></option>
<option value='bacthConfirm'><{t}>BatchConfirm<{/t}></option>
</select>
<a class="button" href="#" id="batchSubmit"><{t}>Confirm<{/t}></a>
</div>
<{elseif $params.receiving_status eq '2'}>
<div class="bulk-actions align-left"  style="margin-top: 5px; border-radius: 4px 4px 4px 4px;">
<select name="dropdown" class="text-input width140" id="batchSelect">
    <option value=''><{t}>PleaseSelectOperating<{/t}></option>
    <option value='movepending'><{t}>MoveToPendingAudit<{/t}></option>
    <option value='movedraft'><{t}>MoveDraft<{/t}></option>
</select>
    <a class="button" href="#" id="batchSubmit"><{t}>Confirm<{/t}></a>
</div>
<{/if}>
<div class="clear"></div>

    <div class="grid">
        <form  method="post" id='asnDataForm'>
            <table   style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
                <thead>
                <tr>
                    <th style="text-align:center;width:25px"><input type="checkbox" class="asncheckAll"></th>
                    <th  ><{t}>ReceiveCode<{/t}></th>
                    <th  ><{t}>CustomerReference2<{/t}></th>
					
                    <th  ><{t}>DeliveryWarehouse<{/t}></th>
                    <th  ><{t}>ASNType<{/t}></th>
                    <th  ><{t}>createDate<{/t}></th>
				<{if $receiving_status eq '8'}>
				<th style="text-align:center;" ><{t}>status<{/t}></th>
               
				<{else}>
				 <th style="text-align:center;" ><{t}>operate<{/t}></th>
				<{/if}>
                </tr>
                </thead>
                <tbody>
                <{if $result neq ""}>
                <{foreach from=$result item=item}>
                    <tr target="pid">
                        <td style="text-align:center;width:25px"><input type="checkbox" name="AsnArr[]" ref="<{$item['receiving_code']}>" class="AsnArr" value="<{$item['receiving_code']}>" /></td>
                        <td style="text-align:center;">
                            <a class="view" href="/merchant/receiving/detail?ASNCode=<{$item['receiving_code']}>"
                              onclick="parent.openMenuTab('/merchant/receiving/detail?ASNCode=<{$item['receiving_code']}>','<{t}>ASNDetail<{/t}>(<{$item['receiving_code']}>)','receivedetail<{$item['receiving_code']}>');return false;" title="<{t}>ASNDetail<{/t}>"><span><{$item['receiving_code']}></span></a>
                        </td>
                        <td style="text-align:center"><{$item['reference_no']}></td>
						
                        <td style="text-align:center">
                            <{$item['warehouse']}>
                        </td>
                        <td style="text-align:center"><{$item['typetext']}></td>
                        <td style="text-align:center" nowrap="nowrap"><{$item['receiving_add_time']}></td>
                        <td style="text-align:center">

					<{if $receiving_status eq '8'}>
					
						<{if $item['receiving_status'] eq '0'}>
						删除
						<{elseif $item['receiving_status'] eq '1'}>	
						草稿					
						<{elseif $item['receiving_status'] eq '2'}>
						确认	
						<{elseif $item['receiving_status'] eq '3'}>
						等审核						
						<{elseif $item['receiving_status'] eq '4'}>						
						已审核
						<{elseif $item['receiving_status'] eq '5'}>
						在途
						<{elseif $item['receiving_status'] eq  '6'}>						
						收货中
						<{elseif $item['receiving_status'] eq '7'}>
						收货完成
						<{else}>
						未知
						<{/if}>
               
					<{else}>						
					
                            <{if $item['receiving_status'] eq '1'}>
                            <a class="edit" href="/merchant/receiving/create?ASNCode=<{$item['receiving_code']}>"
                                  onclick="parent.openMenuTab('/merchant/receiving/create?ASNCode=<{$item['receiving_code']}>','<{t}>editAsn<{/t}>(<{$item['receiving_code']}>)')" title="<{t}>editAsn<{/t}>" ><span><{t}>edit<{/t}></span></a>
                            <a class="delete" onclick="deleteAsn('/merchant/receiving/delete/ASNCode/<{$item['receiving_code']}>')"
                               target="ajaxTodo" title="<{t}>ConfirmDelete<{/t}>"><span><{t}>delete<{/t}></span></a>
                            <{elseif  $item['receiving_status'] eq '2'}>
                            <{elseif $item['receiving_status'] eq '4'}>
                            <!--<a class="confirm" href="/merchant/receiving/print?ASNCode=<{$item['receiving_code']}>"
                               title='<{t}>Confirm<{/t}>ASN' target="_blank"><{t}>printList<{/t}></a>-->
                            <{elseif $item['receiving_status'] eq '5'}>
                            <a class="confirm" href="/merchant/receiving/reprint?ASNCode=<{$item['receiving_code']}>"
                               title='<{t}>RePrint<{/t}>' target="_blank"><{t}>RePrint<{/t}></a>
                            <{elseif $item['receiving_status'] eq '6'}>
                            <!--<a class="confirm" href="/merchant/receiving/deal-asn?ASNCode=<{$item['receiving_code']}>"
                               title='<{t}>HandelASN<{/t}>' target="navTab" rel='dealAsn'><{t}>HandelASN<{/t}></a>-->
                            <{/if}>

                            <a class="view"   onclick="parent.openMenuTab('/merchant/receiving/detail?ASNCode=<{$item['receiving_code']}>','<{t}>ASNDetail<{/t}>(<{$item['receiving_code']}>)');return false;" href="/merchant/receiving/detail?ASNCode=<{$item['receiving_code']}>"
                               target="navTab" title="<{t}>ASNDetail<{/t}>" width='800' height='600'><span><{t}>view<{/t}></span></a>
							   <{/if}>				   
							   
							   
							  
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

	<div id="dialog" title="<{t}>export<{/t}><{t}>CurrencyBalance<{/t}>" style="display:none">
		<input type="radio" name="exportType" value="1" checked="checked"><{t}>selectedASN<{/t}> <input type="radio" name="exportType" value="0"><{t}>all<{/t}>
	</div>





<script>
$(function(){
   //按默认类   
    $("#loadData").alterBgColor();
	$("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"bh_receiving_search_mode"});
    
})
</script>

<script>

	$(function(){
        $('#dialog').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 850,
			position:[50,50],
            resizable: false,
            close:function(){
                //alert('close');
            },buttons:{
                '<{t}>close<{/t}>': function() {
                    $('#dialog').dialog('close');
                },'<{t}>Determine<{/t}>': function() {

                    var exportType = $('[name=exportType]:checked').val();
                    //var exportformat = $('[name=exportformat]:checked').val();
					var exportformat = 'xls';				
                    $('.dateformate').val(exportformat);
                    if(exportType=='1'){
                        //选择的订单               

                        var param = $("#cbDataForm").serialize();						
                        var checkedSizesize = $('.AsnArr:checked').size();
                        if(checkedSizesize<=0){
                            alertTip("<{t}>pleaseOne<{/t}>",'500','auto','1');
                            return;
                        }
                        //alert($('#pagerForm').attr('action'));

                        $('#asnDataForm').attr('action','/merchant/receiving/th-export');
                        $('#asnDataForm').attr('method','POST');
                        $('#asnDataForm').submit();				
                        //$('#orderDataForm').removeAttr('action');
                        //$('#orderDataForm').removeAttr('method');

                    }else if(exportType=='0'){
                        //全部的订单
                        $('#pagerForm').attr('action','/merchant/receiving/th-export');
                        $('#pagerForm').attr('method','POST');
                        $('#pagerForm').submit();
                        $('#pagerForm').attr('action','/merchant/receiving/listth');
                        //$('#orderDataForm').removeAttr('method');

                    }
                    return;
                }
            }
        });	
        $('.export').bind('click',function(){
            $('#dialog').dialog('open');
        });	  
    	
	});
</script>


<script type="text/javascript" src="/loadjs/loadjs/name/receiving"></script>