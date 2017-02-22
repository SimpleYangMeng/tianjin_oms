<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">账册列表</h3>
    </div>
	<div class="pageHeader">
		<form action="/storage/account-book/index" method="post" id="pagerForm">
			<input type="hidden" name="page" value="<{$page}>" id="page" />
			<input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>

			<div class="searchBar">
				<table>
					<tr>
						<td class="form_input">                            
							<label>账册编号：
								<input type="text" name="warehouse_code" value="<{$condition.warehouse_code}>" class="text-input fix-small-input"/>
							</label>
			
							<label for="">
								主管海关代码：
								<select name="customs_code" data-rule="required" id='customsCode' class="text-input fix-medium1-input">
									<option value="">请选择</option>
									<{foreach from=$customsCodeRows item=c key=k name=a}>
									<{if $condition.customs_code == $c.ie_port}>
										<option value='<{$c.ie_port}>'  selected="selected"><{$c.ie_port}>-<{$c.ie_port_name}></option>
									<{else}>
										<option value='<{$c.ie_port}>'><{$c.ie_port}>-<{$c.ie_port_name}></option>
									<{/if}>
									<{/foreach}>
								</select>
							</label>
							
							<label for="">
								进出类型：
								<select name="ie_type" id='ieType' data-rule="required" class="text-input fix-medium1-input">
									<option value="">请选择</option>
									<{foreach from=$ieTypeRows item=ietypeRow key=k name=ietypeRow}>
									<{if $condition.ie_type == $k}>
									<option value="<{$k}>" selected="selected"><{$ietypeRow}></option>
									<{else}>
									<option value="<{$k}>"><{$ietypeRow}></option>
									<{/if}>
									<{/foreach}>
								</select>
							</label>

							<a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a>
						</td>
					</tr>
				</table>
			</div>
		</form>
	</div>
</div>
<div class="btn_wrap">    
    <input class="statusBtn btn <{if empty($condition['warehouse_status']) && !is_numeric($condition['warehouse_status'])}>btn-active<{/if}>" value="全部(<{$statusGroupRows['warehouse_statusTotal']}>)" name="warehouse_status" type='button'>
    <{foreach from=$statusRows item=appStatusRow name=appStatusRow key=key}> 
    <{if isset($statusGroupRows[$key])}>
    <input class="statusBtn btn<{if $condition['warehouse_status']==$key && is_numeric($condition['warehouse_status'])}> btn-active<{/if}>" value="<{$appStatusRow}>(<{$statusGroupRows[$key]}>)" name="warehouse_status" type='button' ref='<{$key}>'> 
    <{else}>
    <input class="statusBtn btn<{if $condition['warehouse_status']==$key && is_numeric($condition['warehouse_status'])}> btn-active<{/if}>" value="<{$appStatusRow}>(0)" name="warehouse_status" type='button' ref='<{$key}>'> 
    <{/if}>
    <{/foreach}>
</div>

<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list formtable tableborder" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
            <tr>
                <th>账册编号</th>
                <th>进出类型</th>
                <th>主管海关代码</th>
                <th>经营单位代码</th>
                <th>经营单位名称</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <{if $warehouseRows}>
            <{foreach from=$warehouseRows item=warehouseRow name=warehouseRow}>
            <tr>               
                <td class="text_center"> <{$warehouseRow.warehouse_code}> </td>
                <td class="text_center"> <{if isset($ieTypeRows[$warehouseRow.ie_type])}> <{$ieTypeRows[$warehouseRow.ie_type]}> <{/if}></td>
                <td class="text_center"> <{$customsCodeRows[$warehouseRow.customs_code]['ie_port_name']}> </td>
                <td class="text_center"> <{$warehouseRow.trade_co}> </td>
                <td class="text_center"> <{$warehouseRow.trade_name}> </td>
                <td class="text_center"> <{$statusRows[$warehouseRow.warehouse_status]}> </td>
                <td class="text_center"><a href="javascript:void(0);" onclick="parent.openMenuTab('/storage/account-book/view/warehouse_code/<{$warehouseRow.warehouse_code}>','查看账册:<{$warehouseRow.warehouse_code}>','<{$warehouseRow.warehouse_code}>');return false;">查看 </a></td>
            </tr>
            <{/foreach}>
            <{/if}>
        </tbody>
    </table>
</form>
<div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>