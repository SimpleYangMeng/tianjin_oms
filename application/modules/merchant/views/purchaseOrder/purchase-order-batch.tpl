<style type="text/css">
    .tableborder th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;
        width: 30%;
    }
    .tableborder td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    .message-warning
    {
        color: #5f5200;
    }
    .error
    {
        margin: 0;
        padding: 8px 0 0 0;
        height: 1%;
        display: block;
        clear: both;
        overflow: hidden;
        color: #FF0000;
        padding-left: 20px;
    }
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><{t}>purchase-order-batch-upload<{/t}></h3>
        <div class="clear"></div>
    </div>
   <form action="/merchant/purchase-order-batch-upload/batchcheck" enctype="multipart/form-data" method="post" id='batchUploadForm' onsubmit="return checkform()">
    <table  cellspacing="0" cellpadding="0" class="tableborder">
    <tr>
     <th>请选择要上传的文件：</th>
     <td>
		<input type="file" size="25" id="PurchaseOrderFile" name="PurchaseOrderFile" class="text-input">
		<font style="color:red;"><{t}>please_select_xls_file<{/t}></font>
	</td>
    </tr>
    <tr>
       <th>样例文件下载:</th>
       <td>
           <img style="width:25px;" src="/images/download.png">
           <a href="/merchant/purchase-order-batch-upload/down-order-templete/file/orderupload">批量上传模板</a></td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left:35%;">
            <input class="button" type="submit" value="批量上传">
        </td>
    </tr><!--formtable tableborder-->
    </table>
   </form>
</div>
<{if isset($uploadinfo) && ($uploadinfo['ask']=='0')}>
<div class="message-warning">
   <div><{$uploadinfo['message']}></div>
    <{foreach from=$uploadinfo['error'] item=error }>
    <div class="error"><{$error}></div>
    <{/foreach}>
</div>
<{/if}>
<{if isset($uploadResult) && $uploadResult!=''}>
<div class="message-warning" style="display:none;">
<{$uploadResult}>
</div>
<{/if}>
<script type="text/javascript">
    function checkform(){
        if(!$('#PurchaseOrderFile').val()){
            alertTip('必须选择文件');
            return false;
        }
        return true;
    }
    $(function(){
        $('.message-warning').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 800,
            height:'auto',
            resizable:false,
            close: function() {
                //window.location.href='/merchant/order/listjh';
            }
        });
        <{if isset($uploadResult) && $uploadResult!=''}>
            $('.message-warning').show().dialog('open');
        <{/if}>
    });
</script>