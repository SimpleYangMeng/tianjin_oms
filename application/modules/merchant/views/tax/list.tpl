<script type="text/javascript">
function downloadTax() {
    var lock = true,
    inputs = $('#pagerForm').find('input[type="text"]');

    for(var i = 0; i < inputs.length; i++){
        var o = $(inputs[i]);
        if(o.val() != ''){            
            lock = false;
            $('#downloadTaxForm input[name="'+o.attr('name')+'"]').val(o.val());
        }
    }

    if(lock){
        alertTip('必须有一个或者多少搜索条件才可以下载！');
        return false;
    }

    $('#downloadTaxForm').submit();
    return false;
}
</script>
<div class="content-box  ui-tabs  ui-corner-all  ui-widget ui-widget-content" >
    <div class="content-box-header">
        <h3 style="margin-left:5px">专用缴款书（税费）</h3>
        <div class="clear"></div>
    </div>

    <form name="searchASNForm"  method="post" action="/merchant/tax/list" id="pagerForm">
        <input type="hidden" name="page" value="1" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <div class="searchBar">
            <table>
                <tr>
                    <td class="form_input">  
                        <label>专用缴款书编号:
                            <input type="text" name="tax_pmt_no" value="<{$condition.tax_pmt_no}>" class="text-input fix-small-input"/>
                        </label>  
                        <label>物品清单号 ：
                            <input type="text" name="form_id" value="<{$condition.form_id}>" class="text-input fix-small-input"/>
                        </label>     
                        <label>订单号 :
                            <input type="text" name="order_no" value="<{$condition.order_no}>" class="text-input fix-small-input"/>
                        </label> 
                        <label>
                            <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a> 

                            <a class="button" href="#" onclick="downloadTax();">下载</a> 
                        </label> 
                    </td>
                </tr>
            </table>
        </div>
    </form>

    <form action="/merchant/tax/download" target="_blank" id="downloadTaxForm">
        <input type="hidden" name="tax_pmt_no" value="">
        <input type="hidden" name="form_id" value="">
        <input type="hidden" name="order_no" value="">
    </form>

</div>
<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list formtable tableborder" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
        <tr>
            <th>专用缴款书编号</th>
            <th>物品清单号</th>
            <th>订单号</th>            
            <th>税额</th>
            <th>完税价格</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            <{if !empty($taxListRows)}>
            <{foreach from=$taxListRows name=taxListRow item=taxListRow}>
            <tr>
                <td class="text_center"><{$taxListRow.tax_pmt_no}></td>
                <td class="text_center"><{$taxListRow.form_id}></td>
                <td class="text_center"><{$taxListRow.order_no}></td>
                <td class="text_center"><{$taxListRow.tax_total}></td>
                <td class="text_center"><{$taxListRow.decl_total}></td>
                <td class="text_center">
                    <a href="javascript:void(0);" onclick="parent.openMenuTab('/merchant/tax/view/tax_no/<{$taxListRow.tax_no}>','查看税费:<{$taxListRow.tax_no}>','<{$taxListRow.tax_no}>');return false;">查看 </a>
                </td>
            </tr>
            <{/foreach}>
            <{/if}>
        </tbody>
    </table>
</form>
<div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>

