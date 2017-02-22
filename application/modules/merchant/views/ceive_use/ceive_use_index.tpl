<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>ceive_use_list<{/t}></h3>
    </div>
    <div class="pageHeader">
        <form action="/merchant/cei-use/list" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>

            <div class="searchBar">
                <table>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <{t}>status<{/t}>：
                        </td>
                        <td style=" text-align:left">
                            <select class="text-input width195" name="cud_status">
                                <option value=""><{t}>all<{/t}></option>
                                <option value="0" <{if $condition.cud_status eq "0"}> selected <{/if}>><{t}>Draft<{/t}></option>
                                <option value="1" <{if $condition.cud_status eq "1"}> selected <{/if}>><{t}>Confirm<{/t}></option>
								<option value="2" <{if $condition.cud_status eq "2"}> selected <{/if}>><{t}>Complete<{/t}></option>
                            </select>
                        </td>
                        <td style="text-align: right;color:#000;">
                            <{t}>type<{/t}>：
                        </td>
                        <td style=" text-align:left">
                            <select class="text-input width195" name="cud_type">
                                <option value=""><{t}>all<{/t}></option>
                                <option value="1" <{if $condition.cud_type eq "1"}> selected <{/if}>><{t}>Lend<{/t}></option>
								<option value="2" <{if $condition.cud_type eq "2"}> selected <{/if}>><{t}>Receive<{/t}></option>
                            </select>
                        </td>
                        <td style="text-align:right;color:#000">
                            <{t}>CommonCode<{/t}>：
                        </td>
                        <td>
							<input type="text" value="<{$condition.cu_code}>" name="cu_code" class="text-input width180 " />
                        </td>
                    </tr>
                    <tr>
						<td><{t}>ProductSKU<{/t}>：</td>
						<td><input type="text" value="<{$condition.sku}>" name="sku" class="text-input width180 " /></td>
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
            <th><{t}>CommonCode<{/t}></th>
            <th><{t}>warehouse<{/t}></th>
			<th><{t}>ProductSKU<{/t}></th>
            <th><{t}>quantity<{/t}></th>
            <th><{t}>status<{/t}></th>
            <th><{t}>type<{/t}></th>
            <th><{t}>createDate<{/t}></th>
            <th><{t}>completeDate<{/t}></th>
            <th><{t}>operate<{/t}></th>
        </tr>
        </thead>
        <tbody>
        <{if $result neq ""}>
        <{foreach from=$result item=item}>
            <tr>
                <td style="text-align:center"><{$item.cu_code}></td>
                <td style="text-align:center"><{$item.warehouse_name}></td>
				<th><{$item.product_sku}></th>
                <td style="text-align:center"><{$item.cud_quantity}> </td>
                <td style="text-align:center">
					<{if $item.cud_status eq "0"}><{t}>Draft<{/t}>
					<{elseif $item.cud_status eq "1"}><{t}>Confirm<{/t}>
					<{elseif $item.cud_status eq "2"}><{t}>Complete<{/t}>
					<{/if}>
				</td>
				 <td style="text-align:center">
					<{if $item.cud_type eq "1"}><{t}>Lend<{/t}>
					<{elseif $item.cud_type eq "2"}><{t}>Receive<{/t}>
					<{/if}>
				</td>
                <td style="text-align:center"><{$item.cud_add_time}></td>
                <td style="text-align:center"><{$item.cud_back_time}></td>
                <td style="text-align:center">
                    <a href="javascript:View('<{$item.cu_code}>')"><{t}>view<{/t}></a>
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
<script>

    function View(code) {
		parent.openMenuTab("/merchant/cei-use/detail/cu_code/" + code,'借/领用明细('+code+')','');
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