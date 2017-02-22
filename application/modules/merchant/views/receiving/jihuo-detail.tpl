<table cellspacing="0" cellpadding="0" class="formtable tableborder">
    <thead>
    <tr>
        <th class="center"><{t}>orderCode<{/t}></th>
        <th class="center"><{t}>CustomerReference<{/t}></th>
        <th class="center"><{t}>current_warehouse<{/t}></th>
        <th class="center"><{t}>current_status<{/t}></th>
        <th><{t}>createDate<{/t}></th>
        <th><{t}>lastEditTime<{/t}></th>
    </tr>
    </thead>
    <tbody>
    <{foreach from=$detail item=row}>
    <tr>
        <td class="center"><a href="/merchant/order/detail/ordersCode/<{$row.order_code}>" onclick="parent.openMenuTab('/merchant/order/detail/ordersCode/<{$row.order_code}>','<{t}>orderDetail<{/t}>(<{$row['order_code']}>)','orderdetail<{$row.order_code}>');return false;" ><{$row.order_code}></a></td>
        <td class="center"><{$row.reference_no}></td>
        <td class="center"><{$row.warehouse_name}></td>
        <td class="center"><{$row.status_to_str}></td>
        <td><{$row.add_time}></td>
        <td><{$row.update_time}></td>
    </tr>
    <{/foreach}>
    </tbody>
</table>