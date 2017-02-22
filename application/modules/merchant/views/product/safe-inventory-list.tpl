<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div class="content-box-header" style="margin-top:5px">
        <h3 style="margin-left:5px"><{t}>SafetyStockList<{/t}></h3>
        <div class="clear"></div>
    </div>
    <form action="/merchant/product/safe-inventory-list" method="post"  id="pagerForm">
        <input type="hidden" name="page" value="1" id="page" />

        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
        <table class="left searchbartable" id="searchbox">
            <tr>
                <th>
                    <{t}>ProductSKU<{/t}>：
                </th>
                <td >
                    <input type="text" name="product_sku" class="text-input width140 leftloat" value="<{$condition.product_sku_like}>"   />
                </td>
                <th>
                   物流仓储企业：
                </th>
                <td>
                    <select class="text-input width155" name="warehouse_id">
                        <option value=""><{t}>all<{/t}></option>
                        <{foreach from=$warehouse item=row}>
                            <option value="<{$row.warehouse_id}>" <{if $condition.warehouse_id eq $row.warehouse_id }>selected<{/if}>><{$row.warehouse_name}></option>
                        <{/foreach}>

                    </select>
                </td>
                <td>
                    <div  style="float: left; margin-left: 10px; "> <a onclick="$('#pagerForm').submit()" class="button"><{t}>search<{/t}></a> <a onclick="addSafeInventory();" class="button"><{t}>add<{/t}></a> <a onclick="batchUpload();" class="button"><{t}>batch_upload<{/t}></a></div>
                </td>

            </tr>



        </table>
        <div>

        </div>
    </form>

</div>






<table  class="table" id="productlist"  style="margin-top:10px">
    <thead>
    <tr style="height:25px">
        <th align="center" nowrap="nowrap" ><{t}>ProductSKU<{/t}></th>
        <th align="center" nowrap="nowrap">物流仓储企业</th>
        <th align="center" nowrap="nowrap"><{t}>SafetyStock<{/t}></th>
        <th align="center" nowrap="nowrap"><{t}>addTime<{/t}></th>
        <th align="center" nowrap="nowrap"><{t}>updateTime<{/t}></th>
        <th align="center" nowrap="nowrap"><{t}>operate<{/t}></th>
    </tr>
    </thead>


    <tbody>
    <{if $result neq ""}>
    <{foreach from=$result item=row}>
        <tr>
            <td style="text-align:center"><{$row.product_sku}></td>
            <td style="text-align:center"><{$row.warehouse_name}></td>
            <td style="text-align:center"><{$row.safe_number}></td>
            <td style="text-align:center"><{$row.add_time}></td>
            <td style="text-align:center"><{$row.update_time}></td>
            <td style="text-align:center">
                <a class="edit" title="<{t}>edit<{/t}>" onclick="editSf('<{$row.si_id}>','<{$row.product_sku}>','<{$row.warehouse_id}>','<{$row.safe_number}>')" href="javascript:void(0);">
                    <span><{t}>edit<{/t}></span>
                </a>
                <a class="edit" title="<{t}>delete<{/t}>" onclick="if(!confirm('<{t}>AreYouSureToDelete<{/t}>'))return false;" href="/merchant/product/delete-safe-inventory/si_id/<{$row.si_id}>">
                    <span><{t}>delete<{/t}></span>
                </a>

            </td>
        </tr>
     <{/foreach}>
    <{/if}>

    </tbody>

</table>

<div class="clear"></div>
<div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10" url="<{$url}>"></div>

<div id="editSafeInventory" title="<{t}>edit_safety_stock<{/t}>" style="display:none">
    <form action="/merchant/product/edit-safe-inventory" method="post"  id="editForm">
        <input type="hidden" name="si_id" value="" />
        <table style="border:0px solid #F3F3F3;">
            <tr>
                <th>
                    <{t}>warehouse<{/t}>：
                </th>
                <td>
                    <select id="editFormWarehouseId" class="text-input width195" name="warehouse_id" disabled>
                        <option value=""><{t}>pleaseSelected<{/t}></option>
                        <{foreach from=$warehouse item=row}>
                        <option value="<{$row.warehouse_id}>" <{if $condition.warehouse_id eq $row.warehouse_id }>selected<{/if}>><{$row.warehouse_name}></option>
                        <{/foreach}>

                    </select>
                </td>
            </tr>
            <tr>
                <th>
                    <{t}>skuCode<{/t}>：
                </th>
                <td>
                    <input id="editFormProductSku" type="text" name="product_sku" class="text-input width180 leftloat" value="" disabled />
                </td>
            </tr>
            <tr>
                <th>
                    <{t}>SafetyStock<{/t}>：
                </th>
                <td>
                    <input id="editFormSafeNumber" type="text" name="safe_number" class="text-input width180 leftloat" value="" />
                </td>
            </tr>
        </table>
    </form>

</div>

<div id="importSafeInventory" title="<{t}>batch_import_safety_stock<{/t}>" style="display:none">
    <form action="/merchant/product/batch-input-safe-number" method="post" id="SafeInputForm">
        <table>
            <tr>
                <td>
                    <{t}>export_xls<{/t}>:</td><td><input type="file" name="XMLForInput" />
                </td>
                <td>
                </td>
            </tr>
            <tr>

                <td>&nbsp;</td>
                <td><p>
                    <img src="/images/download.png" style="width:25px;"><{t}>download_templete<{/t}>:	<a  style="text-decoration:underline;" href="/merchant/product/product-sf-templete"><{t}>product_template<{/t}></a>
                </p>
                </td>
            </tr>


        </table>
    </form>

    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th width='70'><{t}>skuCode<{/t}></th>
            <th width='200'><{t}>notice1<{/t}></th>
        </tr>
        </thead>
        <tbody id='orderproductserror'>

        </tbody>
    </table>

    <div id="message" style="text-align: center;margin-top: 20px;margin-left: 20px;margin-right: 20px;background: #F56D04;padding: 10px;display: none;">

    </div>


</div>

<div id="addSafeInventory" title="<{t}>add_safety_stock<{/t}>" style="display:none">
    <div class="modelcontent" style="display: block;">
        <div>
            <a style="display: block; padding: 10px; width: 60px; margin-bottom: 5px; float: left;" class="ui-state-default  ui-corner-all" id="dialog_link" title="<{t}>ProductInfo<{/t}>" href="#"><{t}>SelectProduct<{/t}></a>
            <span style="margin-left: 5px; margin-top: 12px; display: block; float: left; color: red; font-size: 1.1em;" class="jiahuowarehouse1">*</span>
        </div>

        <form id="addForm" class="pageForm required-validate" method="POST" action="/merchant/product/add-safe-inventory">

        <div class="nbox_c marB10" style="margin-right:0px;">
            <table class="pageFormContent">
                <tr class="jiahuowarehouse" style="display: table-row;">
                    <td width="175" style="text-align:right"><{t}>warehouse<{/t}>：</td>
                    <td colspan="3">
                        <select id="addFormWarehouseId" class="text-input width195" name="warehouse_id">
                            <option value=""><{t}>pleaseSelected<{/t}></option>
                            <{foreach from=$warehouse item=row}>
                            <option value="<{$row.warehouse_id}>" <{if $condition.warehouse_id eq $row.warehouse_id }>selected<{/if}>><{$row.warehouse_name}></option>
                            <{/foreach}>

                        </select>
                        <span style="color: red;">*</span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="nbox_c marB10" style="margin-right:0px;">
            <table cellspacing="0" cellpadding="0" class="formtable tableborder" style="display: table;">
                <thead>
                <tr>
                    <th width="200" align="center"><{t}>skuCode<{/t}></th>
                    <th align="center"><{t}>productTitle<{/t}></th>
                    <th align="center" width="150"><{t}>SafetyStock<{/t}></th>
                    <th align="center" width="100"><{t}>operate<{/t}></th>
                </tr>
                </thead>
                <tbody id="orderproducts">

                </tbody>
            </table>
            <div class="clear"></div>
        </div>

        </form>
    </div>
</div>

<div id="dialog" title="<{t}>SelectProduct<{/t}>" style="display:none">
</div>
<script>

    function addSafeInventory(){
        $("#addSafeInventory").dialog('open');
    }

    function editSafeInventory(){
        $("#editSafeInventory").dialog('open');
    }

    function batchUpload(){
        $("#importSafeInventory").dialog('open');
    }

</script>


<script>
    var importok = "0";
    $(function(){

        getProductListBoxData('order');

        //产品浏览
        $('#dialog_link').click(function(){
            //$('#dialog').html();
            $('#dialog').dialog('open');
            return false;
        });


        $(".orderactionSku").live("click", function () {
            var productId = $(this).attr("productId");
            var productSku = $(this).attr("productSku");
            var productName = $(this).attr("productName");
            var category = $(this).attr("category");
            var productWeight = $(this).attr("productWeight");
            if ($(this).is(':checked')){
                if($("#orderproduct"+productId).size()==0){
                    if ($("#orderproduct" + productId).size() == 0) {
                        var html = '';
                        html += '<tr id="orderproduct' + productId + '" class="product_sku">';
                        html += '<td style="text-align: center;"><a href="/merchant/product/detail/productId/'+productId+'" target="_blank">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"><input type="hidden" name="product_id[' + productId + ']" value="' + productId + '"/></td>';
                        html += '<td style="text-align: center;" title="'+productName+'">' + productName + '</td>';
                        html += '<td style="text-align: center;" ><input type="text" class="inputbox inputMinbox" name="safeNumber[' + productId + ']"  value="" size="6">&nbsp;<strong style="color: red;">*</strong></td>';
                        html += '<td style="text-align: center;" ><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                        html += '</tr>';
                        $("#orderproducts").append(html);
                    }
                }
            }else{
                if($("#orderproduct"+productId).size()>0){
                    $("#orderproduct"+productId).remove();
                }
            }
        });

        $(".productDel").live("click",function(){
            $(this).parent().parent().remove();
        });

        //按默认类
        $("#productlist").alterBgColor();
        $("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"safe_inventory_search_mode"});

        $('#dialog').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 850,
            height:500,
            resizable: true
        });
        $('#importSafeInventory').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 700,
            height:500,
            resizable: true,
            close:function(){
                if(importok=="1"){
                    window.location.href='/merchant/product/safe-inventory-list';
                }else{
                    reseterrorrow();
                }

            },buttons:{
                '<{t}>close<{/t}>': function() {
                    $('#SafeInputForm').resetForm();
                    $("#message").html("");
                    $("#message").hide();
                    $('#importSafeInventory').dialog('close');
                },'<{t}>Determine<{/t}>': function() {
                    do_import_action();
                }
            }/*buttons*/

        });

        $('#addSafeInventory').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 850,
            height:500,
            resizable: true,
            buttons:[
                {
                    text: "<{t}>cancel<{/t}>",
                    click: function () {
                        $(this).dialog("close");
                    }
                },
                {
                    text: "<{t}>Determine<{/t}>",
                    click: function () {
                        var data = $("#addForm").serialize();
                        var product_sku = $("#addFormProductSku").val();
                        var warehouse_id = $("#addFormWarehouseId").val();
                        var safe_number = $("[name='safe_number']").val();
                        var errorMessage = "";
                        if(warehouse_id==""){
                            errorMessage+="<{t}>Warehouse_required<{/t}></br>";
                        }
                        if(errorMessage!=""){
                            alertTipWrong(errorMessage);
                            return false;
                        }
                        $.ajax({
                            type:"POST",
                            async:false,
                            dataType:'json',
                            url:"/merchant/product/add-safe-inventory",
                            data:data,
                            success:function(json){
                                if(json.state=="0"){
                                    var html = "";
                                    $.each(json.error,function(k,v){
                                        html+=v+"<br>";
                                    })
                                    alertTipWrong(html);
                                }else{
                                    var html = "";
                                    $.each(json.message,function(k,v){
                                        html+=v+"<br>";
                                    })
                                    alertTip(html);
                                }
                            }
                        })
                    }
                }
            ], close: function () {
                $(this).dialog("close");
            }
        });

        $('#editSafeInventory').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 400,
            height:300,
            resizable: true,
            buttons:[
                {
                    text: "<{t}>cancel<{/t}>",
                    click: function () {
                        $(this).dialog("close");
                    }
                },
                {
                    text: "<{t}>Determine<{/t}>",
                    click: function () {
                        var data = $("#editForm").serialize();
                        var product_sku = $("#editFormProductSku").val();
                        var warehouse_id = $("#editFormWarehouseId").val();
                        var safe_number = $("[name='safe_number']").val();
                        var errorMessage = "";
                        if(warehouse_id==""){
                            errorMessage+="<{t}>Warehouse_required<{/t}></br>";
                        }
                        if(product_sku==""){
                            errorMessage+="<{t}>product_sku_required<{/t}></br>";
                        }
                        if(safe_number==""){
                            errorMessage+="<{t}>safety_stock_required<{/t}></br>";
                        }
                        if(errorMessage!=""){
                            alertTipWrong(errorMessage);
                            return false;
                        }
                        $.ajax({
                            type:"POST",
                            async:false,
                            dataType:'json',
                            url:"/merchant/product/edit-safe-inventory",
                            data:data,
                            success:function(json){
                                if(json.state=="0"){
                                    var html = "";
                                    $.each(json.error,function(k,v){
                                        html+=v+"<br>";
                                    })
                                    alertTipWrong(html);
                                }else{
                                    alertTip(json.message);
                                    //window.location.href='/merchant/product/safe-inventory-list';
                                }
                            }
                        })
                    }
                }
            ], close: function () {
                $(this).dialog("close");
            }
        });

    })

    /*导入动作*/
    function do_import_action(){

        if($("input[name='XMLForInput']").val()=='')
        {
            alert("<{t}>please_select_file<{/t}>");
            return;
        }
        $('#SafeInputForm').ajaxSubmit({
            dataType:'json',
            success:function(json){
                if(json.ask==1){
                    var html = "";
                    $.each(json.data,function(k,v){
                        html+="<tr>";
                        html+="<td>"+ v.product_sku+"</td>";
                        html+="<td>"+ v.error+"</td>";
                        html+="</tr>";
                    })
                    $("#orderproductserror").html(html);
                    importok = "1";
                }else if(json.ask==0){
                    html = "<tr><td colspan='2'>"+json.message+"</td> </tr>";
                    $("#orderproductserror").html(html);
                    importok = "0";
                }else{
                    html = "<tr><td colspan='2'><{t}>file_format_error_or_file_content_is_wrong<{/t}></td> </tr>";
                    importok = "0";
                }
                $('#SafeInputForm').resetForm();
            },
            error:function(json){
                alertTipWrong("not submit!");
            }
        });

    }

    function reseterrorrow(){

        $("#orderproductserror").empty();

    }

    function del(){

    }

    function editSf(si_id,product_sku,warehouse_id,safe_number){
        $("#editSafeInventory").dialog('open');
        $('[name="si_id"]').val(si_id);
        $("#editFormProductSku").val(product_sku);
        $("#editFormWarehouseId").val(warehouse_id);
        $("#editFormSafeNumber").val(safe_number);
    }

    function alertTip(tip,width,height,notflash) {
        width = width?width:500;
        height = height?height:'auto';
        $('<div title="<{t}>notice<{/t}>"><p align="">' + tip + '</p></div>').dialog({
            autoOpen: true,
            width: width,
            height: height,
            modal: true,
            show:"slide",
            buttons: {
                '<{t}>close<{/t}>': function() {
                    $(this).dialog('close');
                }
            },
            close: function() {
                window.location.href='/merchant/product/safe-inventory-list';
            }
        });
    }

    function alertTipWrong(tip,width,height,notflash){
        width = width?width:500;
        height = height?height:'auto';
        $('<div title="<{t}>notice<{/t}>"><p align="">' + tip + '</p></div>').dialog({
            autoOpen: true,
            width: width,
            height: height,
            modal: true,
            show:"slide",
            buttons: {
                '<{t}>close<{/t}>': function() {
                    $(this).dialog('close');
                }
            },
            close: function() {

            }
        });
    }

</script>


<script>
    $(function(){
        //$("#productlist").colResizable();
    });
</script>