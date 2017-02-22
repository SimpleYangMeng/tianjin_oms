
<div class="content-box  ui-tabs  ui-corner-all  ui-widget ui-widget-content">
	<div class="content-box-header">
	    <h3 style="margin-left:5px">账册详情</h3>
	    <div class="clear"></div>
	</div>
    <div style="margin-right: 0px;" class="nbox_c marB10 cl">
    	<table cellspacing="0" cellpadding="0" class="formtable tableborder">
    		<tbody>
                <tr>
                    <th>账册号：</th>
                    <td><{$warehouseRow.warehouse_code}></td>      
                    <th>账册状态：</th>
                    <td><{$statusRows[$warehouseRow.warehouse_status]}></td>              
                </tr>    		
                <tr>
                    <th>经营单位编码：</th>
                    <td><{$warehouseRow.trade_co}></td>
    				<th>经营单位名称</th>
    				<td><{$warehouseRow.trade_name}></td>    				
                </tr>
                <tr>
                    <th>仓库面积：</th>
                    <td><{$warehouseRow.area}></td>
    				<th>仓库地址：</th>
    				<td><{$warehouseRow.address}></td>    				
                </tr>
                <tr>
                    <th>联系人：</th>
                    <td><{$warehouseRow.warehouse_code}></td>                    
    				<th>联系电话：</th>
    				<td><{$warehouseRow.phone_no}></td>
    			</tr>
                <tr>                    
                    <th>备注</th>
                    <td colspan="3"><{$warehouseRow.note}></td>
                </tr>
    		</tbody>
    	</table>
    </div>
    <div class='clear'></div>
</div>

<div class="tabs_header cl content-box-header" style="margin: 10px 0 4px;">
    <ul class="tabs cl" style="padding-top: 2px;">
        <li class='active'><a href="javascript:;" class="tab" id='tab_accountLog'><span>操作日志</span></a></li>
        <li><a href="javascript:;" class="tab" id='tab_productInventory'><span>账册库存</span></a></li>
    </ul>
</div>

<div class='tabContent' id='accountLog'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
            <tr>
                <th align="center" width="100px"><{t}>LogType<{/t}></th>
                <th align="center" width="100px"><{t}>operater<{/t}></th>
                <th align="center" width="150px"><{t}>addTime<{/t}></th>
                <th align="center" width="100px"><{t}>AccessIP<{/t}></th>
                <th align="center" ><{t}>remark<{/t}></th>
            </tr>
        </thead>
        <tbody>
            <{foreach from=$warehouseLogRows item=row}>
            <tr>
                <{if $row.type == 0}>
                <td>状态修改</td>
                <{else}>
                <td>内容修改</td>
                <{/if}>
                <{if $row.user_id == 0}>
                <td>系统</td>
                <{else}>
                <td><{$row.account_code}></td>
                <{/if}>
                <td><{$row.add_time}></td>
                <td><{$row.ip}></td>
                <td><{$row.comments}></td>
            </tr>
            <{/foreach}>           
        </tbody>
    </table>
</div>

<div class='tabContent' id='productInventory' style="display: none">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
            <tr>
                <th>料件号</th>
                <th>入库总数量</th>
                <th>入库待集报数量</th>
                <th>出库出境总数量</th>
                <th>可出库存</th>
                <th>待出库存</th>
                <th>出库待集报数量</th>
                <th>待减数量</th>
                <th>海关商品备案号</th>
                <th>商品编码</th>                
            </tr>
        </thead>
        <tbody>
            <{foreach from=$productInventoryRows item=row}>
            <tr>
                <td><{$row.goods_id}></td>
                <td><{$row.stock_in_all}></td>
                <td><{$row.stock_in_td}></td>
                <td><{$row.stock_out_all}></td> 
                <td><{$row.stock_qty}></td>
                <td><{$row.stock_frozen}></td>
                <td><{$row.stock_out_td}></td>
                <td><{$row.amount_to_reduce}></td>
                <td><{$row.cus_goods_id}></td>
                <td><{$row.code_ts}></td>
            </tr>
            <{/foreach}>
            
        </tbody>
    </table>
</div>

<script type="text/javascript">
$(function(){
    $(".tabContent").hide();
    $(".tab").click(function(){
        $(".tabContent").hide();
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
        $("#"+$(this).attr("id").replace("tab_","")).show();
    });
    $(".tabContent").eq(0).show();
});
</script>