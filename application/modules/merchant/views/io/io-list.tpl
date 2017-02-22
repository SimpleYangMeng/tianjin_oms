<style>
    .abormaltd{
        color: red;
    }
</style>
<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">出入库数据</h3>
    </div>



    <div class="pageHeader">
        <form action="/merchant/io-data/list" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>

            <div class="searchBar">
                <table>
                    <tr>
                        <td style="text-align:right;color:#000">
                            起止时间：
                        </td>
                        <td>
                            <input type="text" value="<{$condition.time_start}>" name="time_start" class="datepicker text-input width180" />
                        </td>
                        <td style="text-align:center;color:#000">
                            <{t}>To<{/t}>
                        </td>
                        <td>
                            <input type="text" value="<{$condition.time_end}>" name="time_end" class="datepicker text-input width180" />
                        </td>
                        <td style="text-align:right;color:#000">
                            入库/出库：
                        </td>
                        <td>
                            <select class="text-input width195" name="io_type">
                                <option value="0" <{if $io_type eq "0"}>selected<{/if}> >入库</option>
                                <option value="1" <{if $io_type eq "1"}>selected<{/if}> >出库</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a>
                        </td>
                        <td>
                            <a class="button" href="#" onclick="exportIOData(0);">导出入库信息</a>
                            <a class="button" href="#" onclick="exportIOData(1);">导出出库信息</a>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

            </div>
        </form>
    </div>

</div>
<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <{if $io_type eq "0"}>
            <thead>
            <tr>
                <th  >客户代码</th>
                <th  >入库单号</th>
                <th  >客户参考号</th>
                <th  >产品SKU</th>
                <th  >入库数量</th>
                <th  >入库时间</th>
                <th >出库/入库</th>
            </tr>
            </thead>
            <tbody>
            <{if $result neq ""}>
            <{foreach from=$result item=item}>
                <tr>
                <td style="text-align:center"><{$item.customer_code}></td>
                <td style="text-align:center"><{$item.receiving_code}></td>
                <td style="text-align:center"><{$item.reference_no}></td>
                <td style="text-align:center"><{$item.product_sku}></td>
                <td style="text-align:center"><{$item.rd_putaway_qty}></td>
                <td style="text-align:center"><{$item.pd_putaway_time}></td>
                <td style="text-align:center">入库</td>
                </tr>
                <{/foreach}>
            <{/if}>
            </tbody>
        <{else}>
        <thead>
        <tr>
            <th  >客户代码</th>
            <th  >订单号</th>
            <th  >交易订单号</th>
            <th  >产品SKU</th>
            <th  >出货数量</th>
            <th  >出货时间</th>
            <th >出库/入库</th>
        </tr>
        </thead>
        <tbody>
            <{if $result neq ""}>
                <{foreach from=$result item=item}>
                <tr>
                    <td style="text-align:center"><{$item.customer_code}></td>
                    <td style="text-align:center"><{$item.order_code}></td>
                    <td style="text-align:center"><{$item.reference_no}></td>
                    <td style="text-align:center"><{$item.product_sku}></td>
                    <td style="text-align:center"><{$item.op_quantity}></td>
                    <td style="text-align:center"><{$item.ship_time}></td>
                    <td style="text-align:center">出库</td>
                </tr>
                <{/foreach}>
            <{/if}>
        </tbody>
        <{/if}>
    </table>
</form>
<div class="panelBar">
    <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>
</div>


<div id="export_dialog" title="导出出入库数据" style="display:none">
    <input type="radio" name="exportType" value="1" checked="checked">选择的库存记录<input type="radio" name="exportType" value="0">全部

</div>
<script>

    function QC(code) {
        window.open("/merchant/quality-control/qc/code/" + code);
    }

    function exportIOData(type){
        $oldUrl = "/merchant/io-data/list";
        $exportUrl = "/merchant/io-data/export/export_type/"+type;
        $("#pagerForm").attr('action',$exportUrl);
        $("#pagerForm").attr('target','_BLANK');
        $("#pagerForm").submit();
        $("#pagerForm").attr('target','');
        $("#pagerForm").attr('action',$oldUrl);
    }

    $(function(){
        //按默认类
        $("#finance-list-box").alterBgColor();
        $('#export').bind('click',function(){
            $('#export_dialog').dialog('open');
        });

    });


    //全选
    $('.checkAll').die('click').live('click',function(){
        if ($(this).is(':checked')) {
            $(".Arr").attr('checked', true);

        } else {
            $(".Arr").attr('checked', false);
        }
        changeTrColor();
    });

    /*伴随全选按钮是否选中而变色*/
    function changeTrColor(){

        $(".Arr").each(function(){
            _this = $(this);
            if($('.checkAll').is(':checked')){
                set_tr_class(_this.parent().parent(), true);
            }else{
                set_tr_class(_this.parent().parent(), false);
            }

        });
    }

</script>