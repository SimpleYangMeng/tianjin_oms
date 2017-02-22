<style type="text/css">
    .btn:hover, .btn:focus, .btn-active, .btn-sub {
        background-color: #666;
        color: #333;
    }
    .clear{
        clear: both;
    }
    .print{
        margin: 5px;
    }
</style>

<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><{t}>ASNList<{/t}></h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/merchant/receiving/list" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <input type="hidden" value="<{$params.receiving_status}>" name="receiving_status">
        <div class="searchBar">
            <table  class="border searchbartable" >
                <tbody>
                <tr>
                    <th><{t}>ReceiveCode<{/t}>:</th>
                    <td><input class="text-input width180" type="text"  name="receiving_code" value="<{$params['receiving_code_like']}>"></td>
                    <th><{t}>CustomerReference<{/t}>:</th>
                    <td><input class="text-input width180" type="text"  name="reference_no" value="<{$params['reference_no_like']}>"></td>
                    <th><{t}>ASNType<{/t}>:</th>
                    <td><select name="ASNType" class="text-input width195">
                        <option value="">-Select-</option>
                        <{foreach from=$AsnTypeArr key=k item=type }>
                        <option value="<{$k}>" <{if $k==$params.receiving_type}>selected<{/if}>><{$type}></option>
                        <{/foreach}>
                    </select>
                    </td>
                </tr>

                <tr>
                    <th><{t}>warehouse<{/t}>:</th>
                    <td>
                        <select name="warehouseId" class="text-input width195">
                            <option value="">-Select-</option>
                            <{foreach from=$warehouseArr key=k item=wh }>
                            <option value="<{$k}>" <{if $k==$params.warehouse_id}>selected<{/if}>><{$wh}></option>
                            <{/foreach}>
                        </select></td>
                    <th><{t}>createDate<{/t}>:</th>
                    <td colspan="3">
                        <input type="text" class="datepicker text-input width180" value="<{$params.created_start|date_format:'%Y-%m-%d'}>" name="created_start" readonly="true">~
                        <input type="text" class="datepicker text-input width180" value="<{$params.created_end|date_format:'%Y-%m-%d'}>" name="created_end" readonly="true">
                        <input type="hidden" value="<{$params.receiving_status}>" name="receiving_status" id="receiving_status">						
						<a  onclick="$('#pagerForm').submit()" class="button"><{t}>search<{/t}></a>                       
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </form>

</div>


<div class="btn_wrap">
    <{foreach from=$AsnStatusArr item=v name=v key=k}>
    <input  class="statusBtn btn<{if $params.receiving_status==$k}> btn-active<{/if}>" value="<{$v}>" name="<{$v}>" type='button' ref='<{$k}>' id='statusBtn<{$k}>' >
    <{/foreach}>
</div>



<{if $params.receiving_status eq '1' }>
<div class="bulk-actions align-left" style="margin-top: 5px;  border-radius: 4px 4px 4px 4px;">
<select name="dropdown" class="text-input width180" id="batchSelect">
<option value=''><{t}>PleaseSelectOperating<{/t}></option>
<option value='bacthConfirm'><{t}>BatchConfirm<{/t}></option>
</select>
<a class="button" href="#" id="batchSubmit"><{t}>Confirm<{/t}></a>
</div>
<{elseif $params.receiving_status eq '2'}>
<div class="bulk-actions align-left"  style="margin-top: 5px; border-radius: 4px 4px 4px 4px;">
<select name="dropdown" class="text-input width180" id="batchSelect">
    <option value=''><{t}>PleaseSelectOperating<{/t}></option>
    <option value='movepending'><{t}>MoveToPendingAudit<{/t}></option>
    <option value='movedraft'><{t}>MoveDraft<{/t}></option>
</select>
    <a class="button" href="#" id="batchSubmit"><{t}>Confirm<{/t}></a>
</div>
<{/if}>
<div class="clear"></div>

    <div class="grid">
        <form  method="post" id='asnDataForm'>
            <table   style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
                <thead>
                <tr>
                    <th style="text-align:center;width:25px"><input type="checkbox" class="asncheckAll"></th>
                    <th  ><{t}>ReceiveCode<{/t}></th>
                    <th  ><{t}>reference<{/t}></th>
                    <th  ><{t}>warehouse<{/t}></th>
                    <th  ><{t}>ASNType<{/t}></th>
                    <th  ><{t}>createDate<{/t}></th>
                    <th  ><{t}>operate<{/t}></th>
                </tr>
                </thead>
                <tbody>
                <{if $result neq ""}>
                <{foreach from=$result item=item}>
                    <tr target="pid">
                        <td style="text-align:center;width:25px"><input type="checkbox" name="AsnArr[]" ref="<{$item['receiving_code']}>" class="AsnArr" value="<{$item['receiving_code']}>" /></td>
                        <td style="text-align:center;">
                            <a class="view" href="/merchant/receiving/detail?ASNCode=<{$item['receiving_code']}>"
                               target="navTab" title="<{t}>ASNDetail<{/t}>" width='800' height='600'><span><{$item['receiving_code']}></span></a>
                        </td>
                        <td style="text-align:center"><{$item['reference_no']}></td>
                        <td style="text-align:center">
                            <{$item['warehouse']}>
                        </td>
                        <td style="text-align:center"><{$item['typetext']}></td>
                        <td style="text-align:center" nowrap="nowrap"><{$item['receiving_add_time']}></td>
                        <td style="text-align:center">

                            <{if $item['receiving_status'] eq '1'}>
                            <a class="edit" href="/merchant/receiving/create?ASNCode=<{$item['receiving_code']}>"
                               target="navTab" rel='asnAdd'   title="<{t}>editAsn<{/t}>" width='800' height='600'><span><{t}>edit<{/t}></span></a>
                            <a class="delete" onclick="deleteAsn('/merchant/receiving/delete/ASNCode/<{$item['receiving_code']}>')"
                               target="ajaxTodo" title="<{t}>ConfirmDelete<{/t}>"><span><{t}>delete<{/t}></span></a>
                            <{elseif  $item['receiving_status'] eq '2'}>
                            <{elseif $item['receiving_status'] eq '4'}>
                            <a class="confirm" href="/merchant/receiving/print?ASNCode=<{$item['receiving_code']}>"
                               title='<{t}>Confirm<{/t}>ASN' target="_blank"><{t}>printList<{/t}></a>
                            <{elseif $item['receiving_status'] eq '5'}>
                            <a class="confirm" href="/merchant/receiving/reprint?ASNCode=<{$item['receiving_code']}>"
                               title='<{t}>RePrint<{/t}>' target="_blank"><{t}>RePrint<{/t}></a>
                            <{elseif $item['receiving_status'] eq '6'}>
                            <a class="confirm" href="/merchant/receiving/deal-asn?ASNCode=<{$item['receiving_code']}>"
                               title='<{t}>HandelASN<{/t}>' target="navTab" rel='dealAsn'><{t}>HandelASN<{/t}></a>
                            <{/if}>

                            <a class="view" href="/merchant/receiving/detail?ASNCode=<{$item['receiving_code']}>"
                               target="navTab" title="<{t}>ASNDetail<{/t}>" width='800' height='600'><span><{t}>view<{/t}></span></a>
                        </td>
                    </tr>
                    <{/foreach}>
                <{else}>
                <tr>
                    <td colspan="7"><{t}>NoDate<{/t}></td>
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
   //按默认类   
    $("#loadData").alterBgColor();
    
})
</script>
<script type="text/javascript" src="/loadjs/loadjs/name/receiving"></script>