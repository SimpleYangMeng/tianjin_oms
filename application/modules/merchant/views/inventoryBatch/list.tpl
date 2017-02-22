<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>inventory_batch_list<{/t}></h3>        
    </div> 
	<div class="pageHeader">
    <form action="/merchant/inventory-batch/list" method="post" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>

        <div class="searchBar">
            <table id="searchbox" border="0">
                <tr>
      
					<td style="text-align:right;color:#000;" class="nowrap">
                        <{t}>ProductSKU<{/t}>：
                    </td>
                    <td style="text-align: left;" nowrap="nowrap">
                        <input type="text" value="<{$condition.product_sku}>" name="product_sku_s" class="text-input width140 leftloat"/>
						
						<div class="simplesearchsubmit" style="float:left; margin-top:4px;">
						<a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a>
						<a type="button" class="button export" ><{t}>export<{/t}><{t}>batch<{/t}><{t}>inventory_record<{/t}></a>	
						 <a class="switch_search_model"><{t}>switch_to_advanced_search<{/t}></a>
						</div> 
   
                    </td>
					<td style="text-align:right;width:140px;color:#000">
                        <span  class="advanced_element"><{t}>ReceiveCode<{/t}>：</span>
                    </td>
                    <td style="text-align: left;">
                        <span  class="advanced_element"><input type="text" value="<{$condition.receiving_code}>" name="receiving_code_s" class="text-input width140"/></span>
                       
                    </td>	
					</tr>
					<tr  class="advanced_element">	
					<td style="text-align:right;color:#000">
                        <{t}>CustomerReference2<{/t}>：
                    </td>

                    <td style="text-align: left;">
                        <input type="text" value="<{$condition.reference_no}>" name="reference_no_s" class="text-input width140"/>
                       
                    </td>
															
					<td style="text-align:right;color:#000">
					<{t}>warehouse<{/t}>：
					</td>
                    <td style=" text-align:left" colspan="5">
                        <select class="text-input width155" name="warehouse_id_s">
                            <option value=""><{t}>all<{/t}></option>
							<{foreach from=$allWarehouse item=item}>
                            <option value="<{$item.warehouse_id}>" <{if $condition.warehouse_id eq $item.warehouse_id}>selected<{/if}>  ><{$item.warehouse_name}></option>
                        	<{/foreach}>
						</select>		
						 
                    </td>
					
                </tr>
                <tr class="advanced_element">
                    <td style="text-align:right;color:#000">
                        <{t}>是否过期<{/t}>：
                    </td>
                    <td>
                        <select class="text-input width155" name="ib_expire">
                            <option value=""><{t}>all<{/t}></option>
                            <option value="1" <{if $condition.ib_expire eq "1"}>selected<{/if}>><{t}>Is<{/t}></option>
                            <option value="0" <{if $condition.ib_expire eq "0"}>selected<{/if}>><{t}>No<{/t}></option>
                        </select>
                    </td>
                    <td style="text-align:right;color:#000">
                        <{t}>过期时间<{/t}>：
                    </td>
                    <td>
                        <input type="text" value="<{$condition.production_time_start}>" name="production_time_start" class="datepicker text-input width140"/>
                        到
                        <input type="text" value="<{$condition.production_time_end}>" name="production_time_end" class="datepicker text-input width140"/>
                    </td>
                </tr>
				<tr>
					<td style=" text-align:left;" colspan="6">

						<div class="advancedsearchsubmit">
						 <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a>
						 <a type="button" class="button export" ><{t}>export<{/t}><{t}>batch<{/t}><{t}>inventory_record<{/t}></a>	
						 <a class="switch_search_model"><{t}>switch_to_advanced_search<{/t}></a>
						 </div> 
                    </td>
				</tr>
            </table>
            
        </div>
    </form>
		
</div>

	
</div>
	 <form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
        <tr>
			<th style="text-align:center;width:30px;"><input type="checkbox" class="checkAll"></th>		
            <th><{t}>ProductSKU<{/t}></th>   
			<th><{t}>warehouse<{/t}></th>         
            <th><{t}>quantity<{/t}></th>
            <th><{t}>CustomerReference2<{/t}></th>
            <th><{t}>ReceiveCode<{/t}></th>
            <th><{t}>是否过期<{/t}></th>
            <th><{t}>过期时间<{/t}></th>
            <th  style="width:160px"><{t}>time_of_putting_on_shelf<{/t}></th>           
            <th  style="width:160px"><{t}>updateTime<{/t}></th>          
        </tr>
        </thead>
        <tbody>
        <{if $result neq ""}>
        <{foreach from=$result item=item}>
            <tr>
			     <td width="30" style="text-align:center;"><input type="checkbox" name="Arr[]" ref="<{$item['pi_id']}>" class="Arr" value="<{$item['ib_id']}>" /></td>
                <td >
                    <a class="edit" title="<{t}>ProductDetail<{/t}>"  onclick="parent.openMenuTab('/merchant/product/detail?productId=<{$item.product_id}>','<{t}>ProductDetail<{/t}>(<{$item['product_sku']}>)','productdetail<{$item['product_id']}>');return false;" href="/merchant/product/detail?productId=<{$item.product_id}>">
                        <{$item.product_sku}>
                    </a>
                </td>
                <td>
                    <{$item.warehouse_name}>
                </td>
                <td><{$item.ib_quantity}></td>
                <td><{$item.reference_no}></td>
                <td><{$item.receiving_code}></td>
                <td><{if $item.ib_expire eq "1"}>是<{else}>否<{/if}></td>
                <td><{$item.production_time}></td>
                <td class="nowrap"><{$item.ib_add_time}></td>
               
                <td class="nowrap"><{$item.ib_update_time}></td>
                
            </tr>
            <{/foreach}>
        <{/if}>
        </tbody>
    </table>
	</form>
	<div class="clear"></div>
    <div class="panelBar">
        <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>
    </div>


	<div id="export_dialog" title="<{t}>export_batch_inventory_record<{/t}>" style="display:none">
	<input type="radio" name="exportType" value="1" checked="checked"><{t}>selected_batch_inventory_records<{/t}><input type="radio" name="exportType" value="0"><{t}>all<{/t}>
 
	</div>
<script>

$(function(){    
    $('#export_dialog').dialog({
        autoOpen: false,
        modal: false,
        bgiframe:true,
        width: 850,
        resizable: true,
        close:function(){
            //alert('close');
        },buttons:{
            '<{t}>close<{/t}>': function() {
                $('#export_dialog').dialog('close');
            },'<{t}>Determine<{/t}>': function() {

                var exportType = $('[name=exportType]:checked').val();               
                if(exportType=='1'){
                    //选择的订单
                   /* var exportformat = $('[name=exportformat]').val();
                    param+="&exportType="+exportType;
                    param+="&exportformat="+exportformat;

                    alert(exportType);*/

                    var param = $("#DataForm").serialize();
                    var checkedSizesize = $('.Arr:checked').size();
                    if(checkedSizesize<=0){
                        alertTip("<{t}>selected_inventory_records<{/t}>",'500','auto','1');
                        return;
                    }
                    //alert($('#pagerForm').attr('action'));

                    $('#DataForm').attr('action','/merchant/inventory-batch/export');
                    $('#DataForm').attr('method','POST');
                    $('#DataForm').submit();

                    $('#DataForm').removeAttr('action');
                    //$('#orderDataForm').removeAttr('method');

                }else if(exportType=='0'){
                    //全部的订单
                    $('#pagerForm').attr('action','/merchant/inventory-batch/export');
                    $('#pagerForm').attr('method','POST');
                    $('#pagerForm').submit();

                    $('#pagerForm').attr('action','merchant/inventory-batch/list');
                    //$('#orderDataForm').removeAttr('method');

                }
                return;
            }
        }
    });
});

$(function(){
   //按默认类   
    $("#finance-list-box").alterBgColor();
		$('.export').bind('click',function(){
        $('#export_dialog').dialog('open');
   });
   
   $("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"inventoryBatch_search_mode"});
   
    
});




</script>
<script>

  //全选
    $('.checkAll').die('click').live('click',function(){
        if ($(this).is(':checked')) {
            $(".Arr").attr('checked', true);
			
        } else {
            $(".Arr").attr('checked', false);
        }
		changeTrColor();
    });
	
	/*伴随全选按钮是否选中而变色*/
	function changeTrColor(){
	
		$(".Arr").each(function(){
				_this = $(this);
				if($('.checkAll').is(':checked')){			
					set_tr_class(_this.parent().parent(), true);			
				}else{			
					set_tr_class(_this.parent().parent(), false);		
				}					
						
		});		
	}

</script>



