<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>inventory_query<{/t}></h3>        
    </div>   

	

	<div class="pageHeader">
    <form action="/merchant/inventory/list" method="post" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>

        <div class="searchBar">
            <table>
                <tr>
      
					<td style="text-align:right;color:#000">
                        <{t}>skuCode<{/t}>：
                    </td>
                    <td style="text-align: left;">
                        <input type="text" value="<{$condition.product_sku}>" name="product_sku_s" class="text-input width140 "/>
                       
                    </td>				
					<td style="text-align:right;color:#000">
					<{t}>the<{/t}><{t}>warehouse<{/t}>：
					</td>
                    <td style=" text-align:left">
                        <select class="text-input width155" name="warehouse_id_s">
                            <option value=""><{t}>all<{/t}></option>
							<{foreach from=$allWarehouse item=item}>
                            <option value="<{$item.warehouse_id}>" <{if $condition.warehouse_id eq $item.warehouse_id}>selected<{/if}>  ><{$item.warehouse_name}></option>
                        	<{/foreach}>
						</select>
							
						
						 
                    </td>
                    <td style="text-align:right;color:#000">
                        <{t}>productTitle<{/t}>：
                    </td>
                    <td style="text-align: left;">
                        <input type="text" value="<{$condition.product_title}>" name="product_title" class="text-input width140 "/>
                    </td>
					
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td style=" text-align:left"  colspan="10">
						<a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a>
						<a type="button" class="button" id="export" ><{t}>export<{/t}><{t}>inventory_record<{/t}></a>	
						
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
          	<th style="text-align:center;width:30px;">                   
                    <input type="checkbox" class="checkAll">
            </th>		
            <th><{t}>skuCode<{/t}></th>
            <th><{t}>productTitle<{/t}></th>
            <th>物流仓储企业</th>
            <{*<th><{t}>onway<{/t}></th>*}>
            <th><{t}>Pending<{/t}></th>
            <th><{t}>Available<{/t}></th>
            <th><{t}>SafetyStock<{/t}></th>
            <{*<th><{t}>Unavailable<{/t}></th>*}>
            <th><{t}>shipment_occupation<{/t}></th>
            <{*<th ><{t}>Shipped<{/t}></th>*}>
            <{*<th >过期数</th>*}>
            <th  style="width:160px"><{t}>pqoUpdateTime<{/t}></th>
            
        </tr>
        </thead>
        <tbody>
        <{if $result neq ""}>
        <{foreach from=$result item=item}>
            <tr>
			     <td width="30" style="text-align:center;"><input type="checkbox" name="Arr[]" ref="<{$item['pi_id']}>" class="Arr" value="<{$item['pi_id']}>" /></td>
                <td >
                    <a class="edit" title="<{t}>ProductDetail<{/t}>"  onclick="parent.openMenuTab('/merchant/product/detail?productId=<{$item.product_id}>','<{t}>ProductDetail<{/t}>(<{$item['product_sku']}>)','productdetail<{$item.product_id}>');return false;" href="/merchant/product/detail?productId=<{$item.product_id}>">
                        <{$item.product_sku}>
                    </a>
                </td>
                <td><{if $lang=='en_US'}><{$item.product_title_en}><{else}><{$item.product_title}><{/if}></td>
                <td>
                    <{$item.warehouse_name}>
                </td>
               <{* <td><{$item.pi_onway}></td>*}>
                <td><{$item.pi_pending}></td>
                <td><{if $item.pi_sellable< $item.safe_number}><font color="red"><{$item.pi_sellable}></font><{else}><{$item.pi_sellable}><{/if}></td>
                <td><{$item.safe_number}></td>
                <{*<td><{$item.pi_unsellable}></td>*}>
                <td><{$item.pi_reserved}></td>
                <!--<td><{$item.user_code}></td>-->
                <!--<td><{$item.fee_id}></td>-->
                <{*<td><{$item.pi_shipped}></td>*}>
               <{* <td><{$item.pi_expired}></td>*}>
                <td  class="nowrap"><{$item.pi_update_time}></td>
                
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


	<div id="export_dialog" title="<{t}>Export_inventory_records<{/t}>" style="display:none">
	<input type="radio" name="exportType" value="1" checked="checked"><{t}>selected_inventory_records<{/t}><input type="radio" name="exportType" value="0"><{t}>all<{/t}>
 
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
                        alertTip("<{t}>at_least_select_one_inventory_record<{/t}>",'500','auto','1');
                        return;
                    }
                    //alert($('#pagerForm').attr('action'));

                    $('#DataForm').attr('action','/merchant/inventory/export');
                    $('#DataForm').attr('method','POST');
                    $('#DataForm').submit();

                    $('#DataForm').removeAttr('action');
                    //$('#orderDataForm').removeAttr('method');

                }else if(exportType=='0'){
                    //全部的订单
                    $('#pagerForm').attr('action','/merchant/inventory/export');
                    $('#pagerForm').attr('method','POST');
                    $('#pagerForm').submit();

                    $('#pagerForm').attr('action','/merchant/inventory/list');
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
		$('#export').bind('click',function(){
        $('#export_dialog').dialog('open');
   });
    
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



