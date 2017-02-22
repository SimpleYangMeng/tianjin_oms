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
        <h3 style="margin-left:5px">载货单列表</h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/logistic/loading-order/list" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <input type="hidden" value="<{$params.status}>" name="status">
        <div class="searchBar ">
            <table class="searchbartable" cellspacing="2" cellpadding="2"  border="0" id="searchbox">
                <tr>
                    <td class="text_right" nowrap="nowrap" width="140">载货单号：</td>
                    <td style="text-align:left;"><input class="text-input width140 leftloat" type="text"  name="sb_code" value="<{if isset($params['sb_code'])}><{$params['sb_code']}><{/if}>">
					</td>
                    <td  class="text_right">申报口岸：</td>
                    <td style=" text-align:left;">
                        <select name="decl_port" class="text-input width155">
							<option value="">全部</option>
							<{foreach from=$iePorts item=item }>
								<option value="<{$item.ie_port}>" <{if $params['decl_port'] eq $item['ie_port']}>selected<{/if}>><{$item['ie_port_name']}></option>
							<{/foreach}>
                         </select>
                    </td>
                </tr>
                <tr  class="advanced_element">
                    <td  class="text_right">进出口岸：</td>
                    <td style=" text-align:left;">
                        <select name="ie_port" class="text-input width155">
							<option value="">全部</option>
							<{foreach from=$iePorts item=item }>
								<option value="<{$item.ie_port}>" <{if $params['ie_port'] eq $item['ie_port']}>selected<{/if}>><{$item['ie_port_name']}></option>
							<{/foreach}>
                         </select>
                    </td>
					<td  class="text_right"><{t}>createDate<{/t}>：</td>
                    <td style=" text-align:left;">
                        <input type="text" class="datepicker text-input width140" value="<{$params.created_start|date_format:'%Y-%m-%d'}>" name="created_start" readonly="true">&nbsp;<{t}>To<{/t}>&nbsp;
                        <input type="text" class="datepicker text-input width140" value="<{$params.created_end|date_format:'%Y-%m-%d'}>" name="created_end" readonly="true">
                    </td>
                </tr>
				<tr   class="advanced_element">
					<td colspan="4" style="  text-align:left">
						<div class="advancedsearchsubmit">
							<a  onclick="$('#pagerForm').submit()" class="button"><{t}>search<{/t}></a>
						</div>
					</td>
				</tr>
            </table>
        </div>
    </form>
</div>

<div class="btn_wrap">
    <{foreach from=$status item=v name=v key=k}>
    <input  class="statusBtn btn<{if $params.status==$k}> btn-active<{/if}>" value="<{$v}>"
            name="<{$v}>" type='button' ref='<{$k}>' id='statusBtn<{$k}>' >
    <{/foreach}>
</div>

<div class="clear"></div>
    <div class="grid">
        <form  method="post" id='asnDataForm' >
            <table   style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
                <thead>
				<tr>
					<th>载货单号</th>
					<th>申报口岸</th>
					<th>进出口岸</th>
					<th>总重量</th>
					<th>车牌号</th>
					<th>创建时间</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
				</thead>
			<tbody>
			<{if $result neq ""}>
			<{foreach from=$result item=item}>
				<tr>
					<td><{$item.sb_code}></td>
					<td><{if isset($iePortsCode[$item.decl_port]['ie_port_name'])}><{$iePortsCode[$item.decl_port]['ie_port_name']}><{/if}></td>
					<td><{if isset($iePortsCode[$item.ie_port]['ie_port_name'])}><{$iePortsCode[$item.ie_port]['ie_port_name']}><{/if}></td>
					<td><{$item.total_wt}></td>
					<td><{$item.car_no}></td>
					<td><{$item.add_time}></td>
					<td><{$statusArray[$item.status]}></td>
					<td>
						<a class="view" onclick="parent.openMenuTab('/logistic/loading-order/detail?code=<{$item['sb_code']}>','载货单详细(<{$item['sb_code']}>)');return false;" href="#"
								   target="navTab" title=""><span><{t}>view<{/t}></span></a>
						<{if $item.status eq 3 OR $item.status eq 4 OR $item.status eq 5}>
						<{if $item.mark_delete eq 0}>
							<a class="view" onclick="applyDelete('<{$item['sb_code']}>')"><span>申请删除</span></a>
						<{/if}>
						<{/if}>
						<{if $item.status eq 6}>
							<a href="/logistic/loading-order/print?code=<{$item['sb_code']}>" target="_blank">打印载货单</a>
						<{/if}>
					</td>
				</tr>
			<{/foreach}>
			<{else}>
			<tr>
				<td colspan="8" style="text-align:center"><{t}>NoDate<{/t}></td>
			</tr>
			<{/if}>
			</tbody>
		</table>
	</form>
</div>
<div class="clear"></div>
<div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"></div>

<div id="mark-delete-dialog" title="申请删除" style="display:none">
	<form method="post" id="from1" name="from1">
	<input type="hidden" value="" id="sbCode" name="sbCode"/>
	<table cellspacing="0" cellpadding="0" class="formtable tableborder">
		<tr>
			<td>载货单号:</td>
			<td>
			<span id="sbCodeTd"></span>
			</td>
		</tr>
		<tr>
			<td>申请原因:</td>
			<td>
			<textarea name="reason" id="reason" style="width:95%;"></textarea>
			</td>
		</tr>
	</table>
	<form>
</div>

<script>
$(function(){
	$('.statusBtn').bind('click',function(){
		var status = $(this).attr('ref'); 
		$('[name=status]').val(status); 
		$('.statusBtn').removeClass('btn-active'); 
		$('#pagerForm #page').val(1); 
		$(this).addClass('btn-active'); 
		$('#pagerForm').submit(); 
	});
    $("#loadData").alterBgColor();
	
	$('#mark-delete-dialog').dialog({
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
				if('' == $("#reason").val()){
					alertTip('申请原因必填');
					return false;
				}
				$.ajax({
					type:"POST",
					async:false,
					dataType:"json",
					url:"/logistic/loading-order/mark-delete",
					data:$("#from1").serialize(),
					success:function (json) {
						alertTip(json.message);
					}
				})
			}
		}
	})
});
function applyDelete(sbCode){
	$("#reason").val('');
	$("#sbCodeTd").text(sbCode);
	$("#sbCode").val(sbCode);
	$('#mark-delete-dialog').dialog('open');
}
</script>