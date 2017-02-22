<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>ceive_use_list_detail<{/t}></h3>
    </div>
    <div class="pageHeader">
        <form action="/merchant/cei-use/detail" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>
			<input type="hidden" name="cu_code" value="<{$result.aCeiveUse.cu_code }>" />
            <div class="searchBar" style="height:180px;">
                <table class="formtable tableborder" width='100%'>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <{t}>CommonCode<{/t}>：
                        </td>
                        <td style=" text-align:left">
                           <{$result.aCeiveUse.cu_code}>
                        </td>
                        <td style="text-align: right;color:#000;">
                            <{t}>warehouse<{/t}>：
                        </td>
                        <td style=" text-align:left">
                           <{$result.aCeiveUse.warehouse_name }>
                        </td>
                    </tr>
					<tr>
                        <td style="text-align:right;color:#000">
                            <{t}>lender/receiver<{/t}>：
                        </td>
                        <td style=" text-align:left">
                           <{$result.aCeiveUse.cu_username}>
                        </td>
                        <td style="text-align: right;color:#000;">
                            <{t}>status<{/t}>：
                        </td>
                        <td style=" text-align:left">
							<{if $result.aCeiveUse.cu_status eq "0"}> <{t}>Draft<{/t}> 
							<{elseif $result.aCeiveUse.cu_status eq "1"}> <{t}>Confirm<{/t}> 
							<{elseif $result.aCeiveUse.cu_status eq "2"}> <{t}>Complete<{/t}> 
							<{/if}>
                        </td>
                    </tr>
					<tr>
                        <td style="text-align:right;color:#000">
                            <{t}>type<{/t}>：
                        </td>
                        <td style=" text-align:left">
							<{if $result.aCeiveUse.cu_type eq "1"}> <{t}>Lend<{/t}> 
							<{elseif $result.aCeiveUse.cu_type eq "2"}> <{t}>Receive<{/t}> 
							<{/if}>
                        </td>
                        <td style="text-align: right;color:#000;">
                            <{t}>createrId<{/t}>：
                        </td>
                        <td style=" text-align:left">
                           <{$result.aCeiveUse.createUserName }>
                        </td>
                    </tr>
					<tr>
                        <td style="text-align:right;color:#000">
                            <{t}>updateUser<{/t}>：
                        </td>
                        <td style=" text-align:left">
                           <{$result.aCeiveUse.updateUserName}>
                        </td>
                        <td style="text-align: right;color:#000;">
                            <{t}>createDate<{/t}>：
                        </td>
                        <td style=" text-align:left">
                           <{$result.aCeiveUse.cu_add_time }>
                        </td>
                    </tr>
					<tr>
                        <td style="text-align:right;color:#000">
                            <{t}>confirmDate<{/t}>：
                        </td>
                        <td style=" text-align:left">
                           <{$result.aCeiveUse.cu_confirm_time}>
                        </td>
                        <td style="text-align: right;color:#000;">
                            <{t}>completeDate<{/t}>：
                        </td>
                        <td style=" text-align:left">
                           <{$result.aCeiveUse.cu_finish_time }>
                        </td>
                    </tr>
					<tr>
                        <td style="text-align:right;color:#000">
                            <{t}>note<{/t}>：
                        </td>
                        <td style=" text-align:left" colspan='3'>
                           <{$result.aCeiveUse.cu_note}>
                        </td>
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
            <th><{t}>ProductSKU<{/t}></th>
            <th><{t}>productTitle<{/t}></th>
            <th><{t}>returnUser<{/t}></th>
            <th><{t}>status<{/t}></th>
            <th><{t}>quantity<{/t}></th>
            <th><{t}>backQuantity<{/t}></th>
            <th><{t}>createDate<{/t}></th>
            <th><{t}>backDate<{/t}></th>
			<th><{t}>updateDate<{/t}></th>
        </tr>
        </thead>
        <tbody>
        <{if $result neq ""}>
        <{foreach from=$result.lDetail item=item}>
            <tr>
                <td style="text-align:center"><{$item.sku}></td>
                <td style="text-align:center"><{$item.product_title}></td>
                <td style="text-align:center"><{$item.cud_username}></td>
                <td style="text-align:center">
					<{if $item.cud_status eq "0"}><{t}>notReturn<{/t}>
					<{elseif $item.cud_status eq "1"}><{t}>returning<{/t}>
					<{elseif $item.cud_status eq "2"}><{t}>alreadyComplete<{/t}>
					<{elseif $item.cud_status eq "3"}><{t}>alreadyWarehouseOut<{/t}>
					<{/if}>
				</td>
                <td style="text-align:center"><{$item.cud_quantity}></td>
                <td style="text-align:center"><{$item.cud_back_quantity}></td>
                <td style="text-align:center"><{$item.cud_add_time}></td>
                <td style="text-align:center"><{$item.cud_back_time}></td>
				<td style="text-align:center"><{$item.cud_update_time}></td>
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