<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>CurrencyBalance<{/t}></h3>        
    </div>


    <table cellspacing="0" cellpadding="0" class="formtable tableborder">

        <tbody>
        <tr>
            <th><{t}>CustomerCode<{/t}></th>
            <td><{$row.customer_code}></td>
            <th>&nbsp;&nbsp;<{t}>AccountAmount<{/t}></th>
            <td><{$row.cb_value}>&nbsp;<{$customer_currency}></td>
        </tr>
        <tr>
            <th><{t}>AmountFrozen<{/t}></th>
            <td><{$row.cb_hold_value|default:0}>&nbsp;<{$customer_currency}></td>
            <th><{t}>lastUpdateTime<{/t}></th>
            <td><{$row.cb_update_time}></td>
        </tr>
        </tbody>
    </table>

	<div class="clear"></div>
    <!--
	<div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>ChargebackLog<{/t}></h3>        
    </div>
	-->
	
	<div class="pageHeader">
    <form action="/merchant/finance/list" method="post" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>

        <div class="searchBar">
            <table border="0" id="searchbox">
                <tr>
					<th class="nowrap" style="text-align:right;color:#000;">
					<{t}>DebitsType<{/t}>：
					</th>
                    <td nowrap="nowrap" style="text-align:left">
                        <select class="text-input width155"  name="cbl_type">
                            <option value=""><{t}>all<{/t}></option>
                            <option value="0" <{if $condition.cbl_type eq "0"}>selected<{/if}>  ><{t}>Reserved<{/t}></option>
                            <option value="1" <{if $condition.cbl_type eq "1"}>selected<{/if}> ><{t}>Thaw<{/t}></option>
                            <option value="2" <{if $condition.cbl_type eq "2"}>selected<{/if}> ><{t}>Debit<{/t}></option>
                            <option value="3" <{if $condition.cbl_type eq "3"}>selected<{/if}> ><{t}>Depositing<{/t}></option>
                        </select>
						
						<span class="simplesearchsubmit">
							<a class="button" href="#" onclick="do_submit();return false;"><{t}>search<{/t}></a>
							<a  class="button export" ><{t}>export<{/t}></a>	
							<a class="switch_search_model"><{t}>switch_to_advanced_search<{/t}></a> 							
						</span>
						
                    </td>
					<th style="text-align:right;color:#000;width:70px"  class="nowrap"><span  class="advanced_element"><{t}>reference_type<{/t}>：</span></th>					
					<td style="text-align: left;"><span  class="advanced_element">				
						<select class="text-input width155" name="cblReferType">
                            <option value=""><{t}>all<{/t}></option>							
                          		<{foreach from=$cblReferType item=item key=key}>
                              		<option value="<{$key}>" <{if $condition.cblReferType eq $key && $condition.cblReferType!==''}>selected<{/if}> ><{$item}></option>
                           		<{/foreach}>
                     	</select>
						</span>
					
					</td>					
                    <th style="text-align:right;color:#000"  class="nowrap"><span  class="advanced_element"><{t}>reference<{/t}>：</span></th>
                    <td style="text-align: left;"><span  class="advanced_element">
                        <input type="text" value="<{$condition.cbl_refer_code}>" name="cbl_refer_code" class="text-input width140 "/>
                        </span>
                    </td>
                </tr>
				<tr>
					<th style="text-align:right;color:#000"  class="nowrap">
					<span  class="advanced_element">
					<{t}>CustomerReference2<{/t}>：
					</span>
					</th>
                    <td style="text-align: left;">
						<span  class="advanced_element" >
                        <input type="text" value="<{$condition.cbl_cus_code}>" name="cbl_cus_code" class="text-input width140 "/>
                        </span>
                    </td>
					<th style="text-align:right;color:#000"  class="nowrap"><span  class="advanced_element"><{t}>feeName<{/t}>：</span></th>
					<td><span  class="advanced_element"><input type="text" name="cbl_note"   value="<{$condition.cbl_note}>" class="text-input width140"/></span></td>
					<td></td>
					<td></td>
				</tr>
				<tr class="advancedsearchsubmit">
					
					<th  style="text-align:right;color:#000" class="nowrap"><span  class="advanced_element"><{t}>fee_happen_time<{/t}>：</span></th>
					 <td colspan="5">
 						<span  class="advanced_element"><input type="text" class="datepicker text-input width90" style="width:140px;" value="<{$condition.add_time_start}>" name="add_time_start" readonly="true">&nbsp;<{t}>To<{/t}>&nbsp;<input type="text" class="datepicker text-input width90" style="width:140px;" value="<{$condition.add_time_end}>" name="add_time_end" readonly="true" /></span>
					 </td>

				</tr>
				
				<tr class="advancedsearchsubmit">
					 <td colspan="6" ><div class="advancedsearchsubmit"> 					
						<a class="button" href="#" onclick="do_submit();return false;"><{t}>search<{/t}></a>
						<a  class="button export" ><{t}>export<{/t}></a>	
						<a class="switch_search_model"><{t}>switch_to_advanced_search<{/t}></a> 
						</div>				 
					 </td>
				</tr>
            </table>
            
        </div>
    </form>
</div>
<!--pageheader end!-->
</div>


	
    <table class="table list" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
        <tr>
			<th style="text-align:center;width:30px;"><input type="checkbox" class="cbcheckAll"></th>
            <th><{t}>feeName<{/t}></th>
            <th><{t}>reference_type<{/t}></th>
            <th><{t}>reference<{/t}></th>
            <th><{t}>CustomerReference2<{/t}></th>
            <th><{t}>DebitsType<{/t}></th>
            <th><{t}>exchange_amount<{/t}></th>            
            <th><{t}>Currency<{/t}></th>
            <th><{t}>currency_amount_equivalent_to_the_customer<{/t}></th>
            <!--<th align='center'>操作人员</th>-->
            <!--<th>费用名称</th>-->
            <th ><{t}>AvailableBalance<{/t}></th>
            <th ><{t}>FreezeBalance<{/t}></th>
            <th><{t}>fee_happen_time<{/t}></th>
        </tr>
        </thead>
        <tbody>
		<form  method="post" id='cbDataForm' enctype="multipart/form-data">
        <{if $result neq ""}>
        <{foreach from=$result item=item}>
            <tr  target="pid" rel="<{$item['cbl_id']}>">                
                <td width="30" style="text-align:center;"><input type="checkbox" name="cb_arr[]" ref="<{$item['cbl_id']}>" class="cb_arr" value="<{$item['cbl_id']}>" /></td>			
                <td ><{$item.cbl_note}></td>
                <td><{$cblReferType[$item.cbl_refer_type]}></td>
                <td>
                	<{if $item.cbl_refer_type eq 0}>
                	<a class="edit" href="javascript:parent.openMenuTab('/merchant/order/detail?ordersCode=<{$item.cbl_refer_code}>','<{t}>orderDetail<{/t}>(<{$item.cbl_refer_code}>)','orderdetail<{$item.cbl_refer_code}>');" >
                		<span><{$item.cbl_refer_code}></span>
                	</a>
                	<{elseif $item.cbl_refer_type eq 1}>
         			<a class="view" href="javascript:parent.openMenuTab('/merchant/receiving/detail?ASNCode=<{$item.cbl_refer_code}>','<{t}>ASNDetail<{/t}>(<{$item.cbl_refer_code}>)');">
                    	<span><{$item.cbl_refer_code}></span>
                    </a>         			
         			<{elseif $item.cbl_refer_type eq 2}>
         			<a class="edit" href="javascript:parent.openMenuTab('/merchant/product/detail?sku=<{$item.cbl_refer_code}>','<{t}>ProductDetail<{/t}>(<{$item.cbl_refer_code}>)','productdetail<{$item.cbl_refer_code}>');" >
                        <span><{$item.cbl_refer_code}></span>
                    </a>
         			<{/if}>
                </td>
                <td><{$item.cbl_cus_code}></td>
                <td><{$cblType[$item.cbl_type]}></td>
                <td><{$item.cbl_value}></td>
                <td><{$item.currency_code}></td>
                <td><{$item.cbl_transaction_value}></td>
                <!--<td><{$item.user_code}></td>-->
                <!--<td><{$item.fee_id}></td>-->
                <td><{$item.cbl_current_value}></td>
                <td><{$item.cbl_current_hold_value}></td>
                <td class="nowarp"><{$item.cbl_add_time}></td>
            </tr>
            <{/foreach}>
        <{/if}>
		</form>
        </tbody>
    </table>
	
	<div class="clear"></div>
    <div class="panelBar">
        <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>
    </div>

	<div id="dialog" title="<{t}>export<{/t}><{t}>CurrencyBalance<{/t}>" style="display:none">
    <input type="radio" name="exportType" value="1" checked="checked"><{t}>selected<{/t}><{t}>CurrencyBalance<{/t}> <input type="radio" name="exportType" value="0"><{t}>all<{/t}>
    <!--<input type="radio" name="exportformat" value="csv">csv
    <input type="radio" name="exportformat" value="xls" checked="checked">xls-->
	</div>

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
                        var checkedSizesize = $('.cb_arr:checked').size();
                        if(checkedSizesize<=0){
                            alertTip("<{t}>at_least_select_one_tranction_record<{/t}>",'500','auto','1');
                            return;
                        }
                        //alert($('#pagerForm').attr('action'));

                        $('#cbDataForm').attr('action','/merchant/finance/export');
                        $('#cbDataForm').attr('method','POST');
                        $('#cbDataForm').submit();				
                        //$('#orderDataForm').removeAttr('action');
                        //$('#orderDataForm').removeAttr('method');

                    }else if(exportType=='0'){
                        //全部的订单
                        $('#pagerForm').attr('action','/merchant/finance/export');
                        $('#pagerForm').attr('method','POST');
                        $('#pagerForm').submit();
                        $('#pagerForm').attr('action','/merchant/finance/list');
                        //$('#orderDataForm').removeAttr('method');

                    }
                    return;
                }
            }
        });	
        $('.export').bind('click',function(){
            $('#dialog').dialog('open');
        });	  
    	$("#finance-list-box").alterBgColor();    
	});

    $('.cbcheckAll').die('click').live('click',function(){
        if ($(this).is(':checked')) {
            $(".cb_arr").attr('checked', true);
			
        } else {
            $(".cb_arr").attr('checked', false);
        }
		changeTrColor();
    });
	
	/*伴随全选按钮是否选中而变色*/
	function changeTrColor(){
	
		$(".cb_arr").each(function(){
				_this = $(this);
				if($('.cbcheckAll').is(':checked')){			
					set_tr_class(_this.parent().parent(), true);			
				}else{			
					set_tr_class(_this.parent().parent(), false);		
				}					
						
		});		
	}
	
	
	function do_submit(){	
		$('#pagerForm').attr('action','/merchant/finance/list');
		$('#page').val(1);
		$('#pagerForm').submit();
	}
	
</script>


<script>
$(function(){    
    $("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"finance_list"});
})
</script>