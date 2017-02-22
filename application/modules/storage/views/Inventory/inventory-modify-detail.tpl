<style>
.tabContent{display:none;}
</style>
<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">账册调整详细</h3>        
    </div>
<div style="margin-right: 0px;" class="nbox_c marB10">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <tbody>
        <tr>
            <th class="center">系统单号</th>
            <td><{$row.im_code}></td>
            <th>状态</th>
            <td><{$status[$row.status]}></td>
        </tr>
        <tr>
            <th>申报口岸</th>
            <td><{$iePortsCode[$row['customs_code']]['ie_port_name']}></td>
            <th>进出口岸</th>
            <td><{$iePortsCode[$row['ie_port']]['ie_port_name']}></td>
        </tr>
        <tr>
            <th>进出口类型</th>
            <td><{if $row.ie_flag eq 'I'}>进口<{elseif $row.ie_flag eq 'E'}>出口<{/if}></td>
			<th>账册号</th>
            <td><{$row.ems_no}></td>
        </tr>
        <tr>
            <th>仓储企业代码 </th>
            <td><{$row.wh_code}></td>
            <th>仓储企业名称</th>
            <td><{$row.wh_name}></td>
        </tr>
        <tr>
            <th>申报单位代码 </th>
            <td><{$row.agent_code}></td>
            <th>仓储企业名称</th>
            <td><{$row.agent_name}></td>
        </tr>
		<tr>
            <th>电商企业编码 </th>
            <td><{$row.ebc_code}></td>
            <th>电商企业名称</th>
            <td><{$row.ebc_name}></td>
        </tr>
        <tr>
            <th>申报人</th>
            <td ><{$row.decl_by}></td>
            <th>申报时间</th>
            <td><{$row.decl_time}></td>
        </tr>
        <tr>
			<th>调整原因</th>
            <td colspan="3"><{$row.note}></td>
        </tbody>
    </table>
</div>

<div class="tabs_header">
    <ul class="tabs">
        <li class="active"><a href="javascript:void(0);" id='tab_log' class='tab'><span><{t}>Log<{/t}></span></a></li>
		<li><a href="javascript:void(0);" id='tab_product' class='tab'><span>料件级库存</span></a></li>
		<li><a href="javascript:void(0);" id='tab_merger' class='tab'><span>项号级库存</span></a></li>
    </ul>
</div>

<div class='tabContent' id='log'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th><{t}>editContent<{/t}></th>
            <th><{t}>Operator<{/t}></th>
            <th><{t}>OriginalState<{/t}></th>
            <th><{t}>afterModifyStatus<{/t}></th>
            <th><{t}>occurTime<{/t}></th>
            <th><{t}>AccessIP<{/t}></th>
			<th>备注</th>
        </tr>
        </thead>
        <tbody id='loadData'>
        <{foreach from=$log item=item}>
        <tr>
            <td><{if $item.type eq 0}>内容修改<{else}>状态修改<{/if}></td>
            <td><{if $item.user_id > 0 }><{t}>system<{/t}><{else}><{$item.customer_code}><{/if}></td>
            <td><{$status[$item.status_from]}></td>
            <td><{$status[$item.status_to]}></td>
            <td><{$item.add_time}></td>
            <td><{$item.ip}></td>
			<td><{$item.note}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>

<div class='tabContent' id='product'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
			<th>料件号</th>
			<th>海关商品备案编号</th>
			<th>海关商品编码</th>
			<th>商品名称</th>
			<th>库存数量</th>
            <th>申报单价</th>
        </tr>
        </thead>
        <tbody id='loadData'>
        <{foreach from=$products item=item}>
        <tr>
            <td><{$item.goods_id}></td>
            <td><{$item.cus_goods_id}></td>
            <td><{$item.code_ts}></td>
			<td><{$item.g_name}></td>
			<td><{$item.stock_all}><{$productUom[$item.g_unit]['name']}></td>
			<td><{$item.decl_price}><{$item.curr}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>

<div class='tabContent' id='merger'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
			<th>顺序号</th>
			<th>入区报关单号</th>
			<th>入区报关单项号</th>
			<th>商品名称</th>
            <th>海关商品编码</th>
			<th>申报数量</th>
            <th>法定数量</th>
			<th>原法定数量</th>
            <th>规格型号</th>
            <th>申报总价</th>
            <th>原产国</th>
        </tr>
        </thead>
        <tbody id='loadData'>
        <{foreach from=$merger item=item}>
        <tr>
            <td><{$item.seq_id}></td>
            <td><{$item.i_form_id}></td>
            <td><{$item.i_form_item}></td>
			<td><{$item.g_name}></td>
            <td><{$item.code_ts}></td>
            <td><{$item.stock_all}><{$productUom[$item.g_unit]['name']}></td>
			<td><{$item.qty_1}><{$productUom[$item.unit_1]['name']}></td>
			<td><{$item.qty_1_bf}><{$productUom[$item.unit_1]['name']}></td>
			<td><{$item.g_model}></td>
			<td><{$item.total_price}><{$item.curr}></td>
            <td><{$countryCache[$item.origin_country]['country_name']}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>


<div class='clear'></div>
</div>

<script>
$(function(){
	$("#log").alterBgColor();
    $("#merger").alterBgColor();
    $("#product").alterBgColor();
	$(".tab").click(function(){
		$(".tabContent").hide();
		$(this).parent().addClass("active");
		$(this).parent().siblings().removeClass("active");
		$("#"+$(this).attr("id").replace("tab_","")).show();
	});
	$("#log").show();
});
</script>