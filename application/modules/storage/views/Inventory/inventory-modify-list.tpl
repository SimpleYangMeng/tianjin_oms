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
        <h3 style="margin-left:5px">账册调整列表</h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/storage/inventory-modify/index" id="pagerForm" >
        <input type="hidden" name="page" value="<{$page}>" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <input type="hidden" value="<{$params.status}>" name="status">
        <div class="searchBar ">
			<table class="searchbartable" cellspacing="2" cellpadding="2"  border="0" id="searchbox">
				<tbody>
				 <tr>
                    <td class="text_right" nowrap="nowrap" width="140">系统单号：</td>
                    <td style="text-align:left;">
                        <input class="text-input width140 leftloat" type="text"  name="im_code" value="<{if isset($params['im_code'])}><{$params['im_code']}><{/if}>">
						<div class="simplesearchsubmit" style="float:left;margin-top:4px;"> 
                             <a onclick="$('#pagerForm').submit()"  class="button"><{t}>search<{/t}></a>   
                             <a class="switch_search_model" id='simple'><{t}>switch_to_advanced_search<{/t}></a> 
                         </div>	
                    </td>
                    <td  class="text_right" nowrap="nowrap" class="advanced_element">
						</td>
                    <td class="advanced_element">
                    </td>
                </tr>
                <tr  class="advanced_element">
                    <td  class="text_right">申报口岸：</td>
                    <td style=" text-align:left;">
                        <select name="customs_code" class="text-input width155">
							<option value="">全部</option>
							<{foreach from=$iePorts item=item }>
								<option value="<{$item.ie_port}>" <{if $params['customs_code'] eq $item['ie_port']}>selected<{/if}>><{$item['ie_port_name']}></option>
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
				<tr   class="advanced_element">
					<td colspan="4" style="  text-align:left">
						<div class="advancedsearchsubmit">
							<a  onclick="$('#pagerForm').submit()" class="button"><{t}>search<{/t}></a>
                                                         <a class="switch_search_model" id='advance'><{t}>switch_to_advanced_search<{/t}></a> 
						</div>
					</td>
				</tr>
				</tbody>
			</table>
        </div>
    </form>
</div>
<div class="btn_wrap">
    <{foreach from=$statusArr item=v name=v key=k}>
    <input  class="statusBtn btn<{if $params.status==$k}> btn-active<{/if}>" value="<{$v}>"
            name="<{$v}>" type='button' ref='<{$k}>' id='statusBtn<{$k}>' >
    <{/foreach}>
</div>
<div class="clear"></div>
<div class="grid">
	<form  method="post" id='asnDataForm' >
		<table style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
			<thead>
			<tr>
				<th>系统单号</th>
				<th>申报口岸</th>
				<th>账册号</th>
				<th>申报日期</th>
				<th>创建时间</th>
				<th>状态</th>
			</tr>
			</thead>
			<tbody>
			<{if $result neq ""}>
				<{foreach from=$result item=item}>
					<tr>
						<td><a title="账册调整详细" onclick="parent.openMenuTab('/storage/inventory-modify/detail?code=<{$item.im_code}>','账册调整详细(<{$item.im_code}>)','');return false;" href="/storage/inventory-modify/detail?code=<{$item.im_code}>" class="view"><span><{$item.im_code}></span></a></td>
						<td><{$iePortsCode[$item['customs_code']]['ie_port_name']}></td>
						<td><{$item.ems_no}></td>
						<td><{$item.decl_time}></td>
						<td><{$item.add_time}></td>
						<td><{$status[$item.status]}></td>
					</tr>
				<{/foreach}>
				<{else}>
				<tr>
					<td colspan="6" style="text-align:center"><{t}>NoDate<{/t}></td>
				</tr>
			<{/if}>
			</tbody>
		</table>
	</form>
</div>
<div class="clear"></div>
<div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"></div>
<script>
$(function(){
    $("#loadData").alterBgColor();
	$('.statusBtn').bind('click',function(){
		var status = $(this).attr('ref'); 
		$('[name=status]').val(status); 
		$('.statusBtn').removeClass('btn-active'); 
		$('#pagerForm #page').val(1); 
		$(this).addClass('btn-active'); 
		$('#pagerForm').submit(); 
	});
	$("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"bh_receiving_search_mode"});
});
</script>