<table cellspacing="0" cellpadding="0" class="formtable tableborder">
    <thead>
    <tr>
        <th class="center" width='100'>入库单号</th>
		<th class="center" width='100'>商品流水号</th>
		<th class="center" width='100'>料件号</th>
        <th class="center" width='100'>海关品名</th>
		<th class="center" width='100'>商品名称</th>
        <th class="center">申报数量</th>
        <th class="center">法定数量</th>
		<th class="center">第二数量</th>
		<th class="center">申报单价</th>
		<th class="center">申报总价</th>
    </tr>
    </thead>
    <tbody>
    <{foreach from=$detail item=row}>
    <tr>
        <td><{$row.receiving_code}></td>
		<td><{$row.ciq_g_no}></td>
		<td><{$row.goods_id}></td>
		<td><{$row.hs_name}></td>
        <td><{$row.g_name_cn}></td>
        <td><{$row.g_qty}></td>
        <td><{$row.qty_1}></td>
        <td><{$row.qty_2}></td>
        <td><{$row.decl_price}></td>
        <td><{$row.decl_total}></td>
    </tr>
    <{/foreach}>
    </tbody>
</table>