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
        <h3 style="margin-left:5px">入库单列表</h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/merchant/receiving/listbh" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <input type="hidden" value="<{$params.receiving_status}>" name="receiving_status">
        <div class="searchBar ">
            <table class="searchbartable" cellspacing="2" cellpadding="2"  border="0" id="searchbox">
                <tr>
                    <td class="text_right" nowrap="nowrap" width="140">企业清单内部编号：</td>
                    <td style="text-align:left;">
                        <input class="text-input width140 leftloat" type="text"  name="list_no" value="<{if isset($params['list_no'])}><{$params['list_no']}><{/if}>">
			 <div class="simplesearchsubmit" style="float:left;margin-top:4px;"> 
                             <a onclick="$('#pagerForm').submit()"  class="button"><{t}>search<{/t}></a>   
                             <a class="switch_search_model" id='simple'><{t}>switch_to_advanced_search<{/t}></a> 
                         </div>		
                    </td>
                    <td  class="text_right" nowrap="nowrap" class="advanced_element"><span  class="advanced_element">关联单证号：</span></td>
                    <td class="advanced_element">
                        <input class="text-input width140 leftloat" type="text"  name="declaration_number" value="<{if isset($params['declaration_number'])}><{$params['declaration_number']}><{/if}>" />
                    </td>
                </tr>
                <tr  class="advanced_element">
                    <td  class="text_right">申报口岸：</td>
                    <td style=" text-align:left;">
                        <select name="decl_port" class="text-input width155">
							<option value="">全部</option>
							<{foreach from=$iePorts item=item }>
								<option value="<{$item.ie_port}>" <{if $params['decl_port'] eq $item['ie_port']}>selected<{/if}>><{$item['ie_port_name']}></option>
							<{/foreach}>
                         </select>
                    </td>
					<td  class="text_right">添加时间：</td>
                    <td style=" text-align:left;">
                        <input type="text" class="datepicker text-input width140" value="<{$params.created_start|date_format:'%Y-%m-%d'}>" name="created_start" readonly="true">&nbsp;<{t}>To<{/t}>&nbsp;
                        <input type="text" class="datepicker text-input width140" value="<{$params.created_end|date_format:'%Y-%m-%d'}>" name="created_end" readonly="true">
                        <input type="hidden" value="<{$params.receiving_status}>" name="receiving_status" id="receiving_status">
                    </td>
                </tr>
                <tr  class="advanced_element">
                    <td  class="text_right">海关状态：</td>
                    <td style=" text-align:left;">
                        <select name="customsStatus" class="text-input width155">
                            <option value="">全部</option>
                            <{foreach from=$customsStatus item=item key=key}>
                                <option value="<{$key}>" <{if $params['customs_status'] !== '' && $params['customs_status'] eq $key}>selected<{/if}>><{$item}></option>
                            <{/foreach}>
                         </select>
                    </td>
                    <td  class="text_right">检验检疫状态：</td>
                    <td style=" text-align:left;">
                        <select name="ciqStatus" class="text-input width155">
                            <option value="">全部</option>
                            <{foreach from=$ciqStatus item=item key=key}>
                                <option value="<{$key}>" <{if $params['ciq_status'] !== '' && $params['ciq_status'] eq $key}>selected<{/if}>><{$item}></option>
                            <{/foreach}>
                         </select>
                    </td>
                </tr>
				<tr   class="advanced_element">
					<td colspan="4" style="  text-align:left">
						<div class="advancedsearchsubmit">
							<a  onclick="$('#pagerForm').submit()" class="button"><{t}>search<{/t}></a>
                                                         <a class="switch_search_model" id='advance'><{t}>switch_to_advanced_search<{/t}></a> 
							<!--<a  class="button export" ><{t}>export<{/t}></a>-->
						</div>
					</td>
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

<!--

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

-->
<div class="clear"></div>

    <div class="grid">
        <form  method="post" id='asnDataForm' >
            <table   style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
                <thead>
                <tr>
                    <th style="text-align:center;width:25px"><input type="checkbox" class="asncheckAll"></th>
                    <th>企业清单内部编号</th>
                    <th>关联单证号</th>
                    <th>关联单证类型</th>
                    <th>申报口岸</th>
                    <th><{t}>createDate<{/t}></th>
                    <th>海关状态</th>
                    <th>检验检疫状态</th>
				<{if $receiving_status eq '0'}>
				<th style="text-align:center;">状态</th>
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
                              onclick="parent.openMenuTab('/merchant/receiving/detail?ASNCode=<{$item['receiving_code']}>','入库单详细(<{$item['receiving_code']}>)','receivedetail<{$item['receiving_code']}>');return false;" title="入库单详细"><span><{$item['list_no']}></span></a>
                        </td>
                        <td style="text-align:center">
                            <{$item['declaration_number']}>
                        </td>
                        <td style="text-align:center">
						<{if $item['receiving_type'] eq '1'}>报关<{elseif $item['receiving_type'] eq '2'}>
						转关
						<{/if}></td>
						<td style="text-align:center" nowrap="nowrap"><{$iePortsCode[$item['decl_port']]['ie_port_name']}></td>
                        <td style="text-align:center" nowrap="nowrap"><{$item['receiving_add_time']}></td>
                        <td style="text-align:center" nowrap="nowrap"><{if $customsStatus[$item['customs_status']]}><{$customsStatus[$item['customs_status']]}><{else}>未知状态<{/if}></td>
                        <td style="text-align:center" nowrap="nowrap"><{if isset($ciqStatus[$item['ciq_status']])}><{$ciqStatus[$item['ciq_status']]}><{else}>未知状态<{/if}></td>
                        <td style="text-align:center">
						<{if $receiving_status eq '0'}>
							<{$status[$item['receiving_status']]}>
						<{else}>						
							<a class="view" onclick="parent.openMenuTab('/merchant/receiving/detail?ASNCode=<{$item['receiving_code']}>','入库单详细(<{$item['receiving_code']}>)');return false;" href="/merchant/receiving/detail?ASNCode=<{$item['receiving_code']}>"
								   target="navTab" title=""><span><{t}>view<{/t}></span></a>
							<{if $item['receiving_status'] eq 1}>
							<a class="confirm" href="/merchant/receiving/print/ASNCode/<{$item['receiving_code']}>" title='打印' target="_blank">打印</a>
							<a class="confirm" href="/merchant/receiving/print/detail/1/ASNCode/<{$item['receiving_code']}>" title='打印明细' target="_blank">打印明细</a>
							<{/if}>
							<{if $item['receiving_status'] eq 2}>
							<a class="confirm" href="/merchant/receiving/print/ASNCode/<{$item['receiving_code']}>" title='重新打印' target="_blank">重新打印</a>
							<a class="confirm" href="/merchant/receiving/print/detail/1/ASNCode/<{$item['receiving_code']}>" title='重新打印明细' target="_blank">重新打印明细</a>
							<{/if}>
							<{if $item['receiving_status'] eq 2}>
							<a class="confirm"  title='上传单证' onclick="upload('<{$item['receiving_code']}>')" target="_blank">上传单证</a>
							<{/if}>
							<{if $item['receiving_status'] eq 8}>
							<a class="confirm" href="/merchant/receiving/print-qrcode/receiving_code/<{$item['receiving_code']}>" title='打印二维码' target="_blank">打印二维码</a>
							<{/if}>
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
	
	<div id="upload-dialog" title="上传备案清单号" style="display:none">
		<input type="hidden" value="" id="receivingCode" />
		<table cellspacing="0" cellpadding="0" class="formtable tableborder">
		<tr>
		<td>关联单证类型:</td>
		<td>
		<select name="type" class="text-input width155" id="type">
			<option value=''>请选择</option>
			<option value='1'>报关</option>
			<option value='2'>转关</option>
		</select>
		</td>
		</tr>
		<tr>
		<td>关联单证号:</td>
		<td><input type="text" value="" name="declaration_number" id="declaration_number" class="text-input width140" /></td>
		</tr>
		</table>
	</div>
	
<script>
    $(function(){
        $('.switch_search_model').click(function(){
            $('#pagerForm')[0].reset();
            $('#pagerForm').find('input').not('[name="page"]').each(function(){
                if($(this).attr('name') != 'page' && $(this).attr('name') != 'pageSize' && $(this).attr('name') != 'receiving_status'){
                    $(this).val('');
                }     
            })
            $('#pagerForm').find('select').each(function(){
                $(this).find('option:selected').attr('selected',false);
                $(this).find('option:first').attr('selected','selected');
                $(this).trigger('update');
                //$(this).siblings('.b-custom-select').find('.b-custom-select__title__text').text($(this).find('option:first').text())
            })
        })
    })
function upload(asnCode){
	$("#receivingCode").val(asnCode);
	$('#type').val('');
	$('#declaration_number').val('');
	$('#upload-dialog').dialog('open');
}
$(function(){
   //按默认类   
    $("#loadData").alterBgColor();
	$("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"bh_receiving_search_mode"});
});


	$(function(){
		 $('#upload-dialog').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 400,
            resizable: false,
			buttons:{
				'取消': function() {
                    $(this).dialog('close');
                },'确认': function() {
					$(this).dialog('close');
					if('' == $("#type").val()){
						alertTip('请选择关联单证类型');
						return false;
					}
					if('' == $("#declaration_number").val()){
						alertTip('请选择关联单证号');
						return false;
					}
					$.ajax({
						type:"POST",
						async:false,
						dataType:"json",
						url:"/merchant/receiving/upload-listno",
						data:{
							'ASNCode':$("#receivingCode").val(),
							'type':$("#type").val(),
							'declaration_number':$("#declaration_number").val(),
						},
						success:function (json) {
							alertTip(json.message);
						}
					})
				}
			}
		})
		
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

                        $('#asnDataForm').attr('action','/merchant/receiving/bh-export');
                        $('#asnDataForm').attr('method','POST');
                        $('#asnDataForm').submit();				
                        //$('#orderDataForm').removeAttr('action');
                        //$('#orderDataForm').removeAttr('method');

                    }else if(exportType=='0'){
                        //全部的订单
                        $('#pagerForm').attr('action','/merchant/receiving/bh-export');
                        $('#pagerForm').attr('method','POST');
                        $('#pagerForm').submit();
                        $('#pagerForm').attr('action','/merchant/receiving/listbh');
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