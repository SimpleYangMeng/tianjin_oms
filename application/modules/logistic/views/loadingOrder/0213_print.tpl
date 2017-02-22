<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>天津跨境贸易电子商务综合服务平台-载货单打印</title>
    <style type="text/css">
        table {border:none;}
        tr { line-height: 28px; }
        .formtable{background-color: #ffffff;border: 1px solid #ccc;float: left;width: 100%;}
        .tableborder{border-bottom: 1px solid #000000;border-collapse: collapse;border-top: 1px solid #000000;}
        .formtable th{color: #000000;font-weight: bold;text-align: center;}
        .formtable td{line-height: 1.5em; padding: 5px; text-align: left;vertical-align: top; color: #000000;text-align: center;}
        .tableborder td, .tableborder th{border: 1px solid #000000;height: 20px;line-height: 20px;}
        .main-table { text-align: center; }
        .tableborder th{height: 30px;}
    </style>
</head>
<body>
    <div style="width: 680px; text-align: center; margin: 0 auto;">
        <table width="680" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="left">
                    <img src="/logistic/loading-order/barcode?drawText=&code=<{$shipBatch.sb_code}>" />
                </td>
            </tr> 
            <tr height="50">
                <td style="font-size: 20px; text-align: center; font-weight: 700">出区核放单(载货清单)</td>
            </tr>
            <tr>
                <td>
                    <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="main-table formtable tableborder">
                        <tr>
                            <td colspan="3" style="text-align: right;">载货清单编号：</td>
                            <td colspan="4"><{$shipBatch.sb_code}></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;">报关申请单编号：</td>
                            <td colspan="4"><{$shipBatch.ref_loader_no}></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;">仓储企业名称：</td>
                            <td colspan="4"><{$shipBatch.wh_name}></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;">仓储企业编码：</td>
                            <td colspan="4"><{$shipBatch.wh_code}></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;">收发货企业名称：</td>
                            <td colspan="4"><{$shipBatch.owner_name}></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;">收发货企业编码：</td>
                            <td colspan="4"><{$shipBatch.owner_code}></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;">经营企业名称：</td>
                            <td colspan="4"><{$shipBatch.trade_name}></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;">经营企业编码：</td>
                            <td colspan="4"><{$shipBatch.trade_code}></td>
                        </tr>
                        <tr>
                            <td colspan="2">包装种类：</td>
                            <td colspan="2">纸箱</td>
                            <td>车牌号码：</td>
                            <td colspan="2"><{$shipBatch.car_no}></td>
                        </tr>
                        <tr>
                            <td colspan="2">毛重(千克)</td>
                            <td><{$shipBatch.total_wt}></td>
                            <td>净重(千克)</td>
                            <td><{$shipBatch.total_wt}></td>
                            <td>件数</td>
                            <td><{$shipBatch.pack_no}></td>
                        </tr>
                        <tr>
                            <td colspan="3">出卡口时间：</td>
                            <td colspan="4"><{$shipBatch.sb_update_time}></td>
                        </tr>
                        <tr>
                            <th width="60">序号</th>
                            <th width="80">项号</th>
                            <th width="100">商品编码</th>
                            <th width="180">商品名称</th>
                            <th width="120">商品规格</th>
                            <th width="120">申报数量</th>
                            <th width="180">申报计量单位</th>
                        </tr>
                        <{if !empty($shipBatchProduct) }>
                            <{foreach from=$shipBatchProduct item=product name=product key=key}>
                            <tr>
                                <td><{$key + 1}></td>
                                <td><{$product.merge_no}></td>
                                <td><{$product.code_ts}></td>
                                <td><{$product.g_name_cn}></td>
                                <td><{$product.g_model}></td>
                                <td><{$product.g_qty}></td>
                                <td><{$product.g_unit}></td>
                            </tr>
                            <{/foreach}>
                        <{else}>
                            <tr>
                                <td colspan="7" style="align: center">暂无数据</td>
                            </tr>
                        <{/if}>
                        <tr height="50">
                            <td colspan="5" style="line-height: 50px;">以上内容真实，我司愿承担申报不实带来的法律责任</td>
                            <td colspan="2" rowspan="3"><br /><br /><br />仓储单位<br />盖章</td>
                        </tr>
                        <tr height="50">
                            <td colspan="3" style="line-height: 50px;">操作员：</td>
                            <td colspan="2" style="line-height: 50px;"><{$customer.account_name}></td>
                        </tr>
                        <tr height="50">
                            <td colspan="3" style="line-height: 50px;">打印日期：</td>
                            <td colspan="2" style="line-height: 50px;"><{date('Y/m/d')}></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>