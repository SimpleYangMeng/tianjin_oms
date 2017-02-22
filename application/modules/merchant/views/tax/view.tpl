<div class="content-box  ui-tabs  ui-corner-all" >
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">税费详细</h3>
    </div>
    <div style="margin-right: 0px; padding: 6px;" class="content-box nbox_c marB10 product_detail cl">
        <table cellspacing="0" cellpadding="0" class="formtable tableborder" width='100%'>
            <tr>
                <th>专用缴款书收编号:</th>
                <td><{$taxRow.tax_no}></td>
                <th>主管海关:</th>
                <td><{$taxRow.dexl_prot}></td>
            </tr>
            <tr>
                <th>电商企业名称:</th>
                <td><{$taxRow.customer_code}></td>
                <th>完税价格:</th>
                <td><{$taxRow.decl_total_all}></td>
            </tr>
            <tr>
                <th>税单税额:</th>
                <td><{$taxRow.tax_total_all}></td>
                <th>税单打印时间:</th>
                <td><{$taxRow.tax_bill_print_time}></td>
            </tr>
            <tr>
                <th>备注:</th>
                <td colspan="3"><{$taxRow.ramark}></td>
            </tr>
        </table>
    </div>
</div>

<div class="tabs_header cl content-box-header" style="margin: 10px 0 4px;">
    <ul class="tabs cl" style="padding-top: 2px;">
        <li class='active'><a href="javascript:;" id='tab_orderProduct' class='tab'><span>税单内容</span></a></li>      
    </ul>
</div>

<div class='tabContent' id='orderProduct'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <td>物品清单号</td>
            <td>订单号</td>
            <td>税单税额</td>
            <td>完税价格</td>
            <td>纳税人姓名（地址）</td>    
            <td>税金时间</td>                    
            <td>备注</td>
        </tr>
        </thead>
        <tbody>
        <{if !empty($taxListRows)}>
        <{foreach from=$taxListRows name=taxListRow item=taxListRow}>
        <tr>
            <td><{$taxListRow.pim_code}></td>
            <td><{$taxListRow.order_code}></td>
            <td><{$taxListRow.tax_total}></td>
            <td><{$taxListRow.decl_total}></td>            
            <td><{$taxListRow.taxpayer}></td>    
            <td><{$taxListRow.tax_calc_time}></td>        
            <td><{$taxListRow.remark}></td>
        </tr>
        <{/foreach}>
        <{/if}>
        </tbody>
    </table>
</div>