<style>
    .abormaltd{
        color: red;
    }
</style>
<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>qc_list<{/t}></h3>
    </div>



    <div class="pageHeader">
        <form action="/merchant/quality-control/list" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>

            <div class="searchBar">
                <table>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <{t}>ASNCode<{/t}>：
                        </td>
                        <td style=" text-align:left">
                            <input type="text" value="<{$condition.receiving_code}>" name="receiving_code" class="text-input width180 "/>
                        </td>
                        <td style="text-align: right;color:#000;">
                            <{t}>skuCode<{/t}>：
                        </td>
                        <td style=" text-align:left">
                            <input type="text" value="<{$condition.product_sku}>" name="product_sku" class="text-input width180 "/>
                        </td>
                        <td style="text-align:right;color:#000">
                            <{t}>problemStatus<{/t}>：
                        </td>
                        <td>
                            <select class="text-input width195" name="abnormal">
                                <option value=""><{t}>all<{/t}></option>
                                <option value="0" <{if $condition.abnormal eq "0"}> selected <{/if}>>否</option>
                                <option value="1" <{if $condition.abnormal eq "1"}> selected <{/if}>>是</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <{t}>QCDate<{/t}>：
                        </td>
                        <td>
                            <input type="text" value="<{$condition.qc_finish_time_start}>" name="qc_finish_time_start" class="datepicker text-input width180" />
                        </td>
                        <td style="text-align:center;color:#000">
                            <{t}>To<{/t}>
                        </td>
                        <td>
                            <input type="text" value="<{$condition.qc_finish_time_end}>" name="qc_finish_time_end" class="datepicker text-input width180" />
                        </td>
                        <td style="text-align:right;color:#000">
                            <{t}>warehouse<{/t}>：
                        </td>
                        <td>
                            <select class="text-input width195" name="warehouse_id">
                                <option value=""><{t}>all<{/t}></option>
                                <{foreach from=$warehouse item=row}>
                                <option value="<{$row.warehouse_id}>" <{if $row.warehouse_id eq $condition.warehouse_id}> selected <{/if}>><{$row.warehouse_name}></option>
                                <{/foreach}>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <{t}>CustomerReference2<{/t}>：
                        </td>
                        <td>
                            <input type="text" value="<{$condition.reference_no}>" name="reference_no" class="text-input width180 " />
                        </td>
                        <td>
                            <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a>
                        </td>
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
        <thead>
        <tr>
            <th  ><{t}>ASNCode<{/t}></th>
            <th  ><{t}>CustomerReference2<{/t}></th>
            <th  ><{t}>skuCode<{/t}></th>
            <th  ><{t}>the_warehouse<{/t}></th>
            <th  ><{t}>QCquantity<{/t}></th>
            <th  ><{t}>ReceiptQuantity<{/t}></th>
            <th ><{t}>available_quantity<{/t}></th>
            <th ><{t}>defective_quantity<{/t}></th>
            <!--<th >状态</th>-->
            <th ><{t}>problemStatus<{/t}></th>
            <!--<th  style="width:260px">时间</th>-->
            <th ><{t}>QCDate<{/t}></th>
            <th  ><{t}>operate<{/t}></th>

        </tr>
        </thead>
        <tbody>
        <{if $result neq ""}>
        <{foreach from=$result item=item}>
            <tr <{if $item.qc_quantity_unsellable>0}>class="abormaltd"<{/if}>>
                <td style="text-align:center">
                    <{$item.receiving_code}>
                </td>
                <td>
                    <{$item.reference_no}>
                </td>
                <td style="text-align:center">
                    <a title="<{t}>ProductDetail<{/t}>" onclick="parent.openMenuTab('/merchant/product/detail?productId=<{$item.product_id}>','产品详情(<{$item.product_sku}>)','productdetail<{$item.product_id}>');return false;" href="/merchant/product/detail?productId=<{$item.product_id}>" class="edit"><span <{if $item.qc_quantity_unsellable>0}>style="color:red;"<{/if}>><{$item.product_sku}></span>
                    </a>
                </td>
                <td style="text-align:center"><{$item.warehouse_name}></td>
                <td style="text-align:center"><{$item.qc_quantity}></td>
                <td style="text-align:center"><{$item.qc_received_quantity}></td>
                <td style="text-align:center"><{$item.qc_quantity_sellable}></td>
                <td style="text-align:center"><{$item.qc_quantity_unsellable}></td>
                <!--<td style="text-align:center">
                    <{if $item.qc_status eq "0"}>
                    草稿
                    <{elseif $item.qc_status eq "1"}>
                    完成
                    <{else}>
                    已上架
                    <{/if}>
                </td>-->
                <td style="text-align:center">
                    <{if $item.qc_quantity_unsellable>0}>
                    是
                    <{else}>
                    否
                    <{/if}>
                </td>
                <!--<td style="text-align:center">
                    创建时间：<{$item.qc_add_time}>
                    <br>质检日期：<{$item.qc_finish_time}>
                </td>-->
                <td><{$item.qc_finish_time}></td>
                <td style="text-align:center">
                    <a <{if $item.qc_quantity_unsellable>0}>style="color:red;"<{/if}> href="javascript:QC('<{$item.qc_code}>')"><{t}>view<{/t}></a>
                </td>
            </tr>
            <{/foreach}>
        <{/if}>
        </tbody>
    </table>
</form>
<div class="panelBar">
    <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>
</div>


<div id="export_dialog" title="导出库存记录" style="display:none">
    <input type="radio" name="exportType" value="1" checked="checked">选择的库存记录<input type="radio" name="exportType" value="0">全部

</div>
<script>

    function QC(code) {
        window.open("/merchant/quality-control/qc/code/" + code);
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