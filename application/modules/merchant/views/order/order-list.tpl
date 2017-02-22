<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <{if $conditioin.ie_type == 'BI'}>
        <h3 class="clearborder" style="margin-left:5px;">保税进口订单列表</h3>
        <{else}>
        <h3 class="clearborder" style="margin-left:5px;">保税进口订单列表</h3>
        <{/if}>
    </div>



    <div class="pageHeader">
        <form action="/merchant/order/list" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>
            <input type="hidden" name="type" value="<{$conditioin['ie_type']}>" id="_type"/>

            <div class="searchBar">
                <table>
                    <tr>
                        <td class="form_input">
                            <div>
                                <label>订单编号：
                                    <input type="text" name="order_code" value="<{$conditioin.order_code}>" class="text-input fix-small-input"/>
                                </label>
                                <label>交易订单号：
                                    <input type="text" name="reference_no" value="<{$conditioin.reference_no}>" class="text-input fix-small-input"/>
                                </label>                         
                                <label>主管海关：
                                    <select name="customs_code">
                                        <option value="">请选择</option>
                                        <{foreach from=$iePortRows name=iePortRow item=iePortRow}>
                                        <{if $iePortRow.ie_port == $conditioin.customs_code}>
                                        <option value="<{$iePortRow.ie_port}>" selected="selected"><{$iePortRow.ie_port}> == <{$iePortRow.ie_port_name}></option>
                                        <{else}>
                                        <option value="<{$iePortRow.ie_port}>"><{$iePortRow.ie_port}> == <{$iePortRow.ie_port_name}></option>
                                        <{/if}>
                                        <{/foreach}>
                                    </select>
                                </label> 
                            </div>
                            <div style="margin-top: 10px;">
                                <label>添加时间：                      
                                <input type="text" name="start_time" value="<{$conditioin.order_add_time}>" class="datepicker text-input width140" readonly="true"/>
                                </label>    
                                <label><{t}>To<{/t}>
                                <input type="text" name="end_time" value="<{$conditioin.order_end_time}>" class="datepicker text-input width140" readonly="true"/>
                                </label>   
                                <label>检验检疫状态：
                                    <select name="ciq_status">
                                        <option value="" <{if $conditioin['ciq_status'] === ''}>selected<{/if}>>全部</option>
                                        <{foreach from=$ciqStatus key=key item=item}>
                                            <option value="<{$key}>" <{if $conditioin['ciq_status'] !== '' && $conditioin['ciq_status'] == $key}>selected<{/if}>><{$item}></option>
                                        <{/foreach}>
                                    </select>
                                </label>
                                <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a>                          
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<div class="btn_wrap">    
    <input class="statusBtn btn <{if empty($conditioin['order_status']) && !is_numeric($conditioin['order_status'])}>btn-active<{/if}>" value="全部(<{$statusGroupRows['order_statusTotal']}>)" name="order_status" type='button'>
    <{foreach from=$orderStatus item=appStatusRow name=appStatusRow key=key}>
    <{if isset($statusGroupRows[$key])}>
    <input class="statusBtn btn<{if $conditioin['order_status']==$key && is_numeric($conditioin['order_status'])}> btn-active<{/if}>" value="<{$appStatusRow}>(<{$statusGroupRows[$key]}>)" name="order_status" type='button' ref='<{$key}>'>
    <{else}>
    <input class="statusBtn btn<{if $conditioin['order_status']==$key && is_numeric($conditioin['order_status'])}> btn-active<{/if}>" value="<{$appStatusRow}>(0)" name="order_status" type='button' ref='<{$key}>'>
    <{/if}>
    <{/foreach}>
</div>

<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list formtable tableborder" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
        <tr>
            <th>交易订单号</th>
            <th>订单编号</th>
            <th>主管海关</th>
            <th>状态</th>          
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        <{if isset($newOrdersRows) && !empty($newOrdersRows)}>
        <{foreach from=$newOrdersRows name=newOrdersRow item=newOrdersRow}>
        <tr>
            <td class="text_center" style="vertical-align:middle"><{$newOrdersRow.reference_no}></td>
            <td class="text_center" style="vertical-align:middle"><{$newOrdersRow.order_code}></td>
            <td class="text_center" style="vertical-align:middle"><{$newOrdersRow.customs_code}></td>
            <td class="text_center" style="vertical-align:middle">海关：<{$newOrdersRow.status}><br/>检验检疫：<{$newOrdersRow.ciq_status}></td>         
            <td class="text_center" style="vertical-align:middle"><{$newOrdersRow.add_time}></td>            
            <td class="text_center" style="vertical-align:middle">
                
            <{if isset($conditioin['order_status']) && $conditioin['order_status']=='2'}>
                <a href="javascript:void(0);" onclick="parent.openMenuTab('/merchant/order/edit/order_code/<{$newOrdersRow.order_code}>','编辑订单:<{$newOrdersRow.order_code}>','<{$newOrdersRow.order_code}>');return false;">修改 </a>
            <{/if}>
               

                <a href="javascript:void(0);" onclick="parent.openMenuTab('/merchant/order/view/order_code/<{$newOrdersRow.order_code}>','查看订单:<{$newOrdersRow.order_code}>','<{$newOrdersRow.order_code}>');return false;">查看 </a>
                
            </td>
        </tr>
        <{/foreach}>
        <{/if}>
        </thead>
        <tbody>
        </tbody>
    </table>
</form>
<div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>



