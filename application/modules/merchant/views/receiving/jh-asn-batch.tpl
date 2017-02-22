<!--暂废弃!-->
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
    }
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px">集货模式ASN批量上传</h3>
        <div class="clear"></div>
    </div>
   <form action="/merchant/receiving-upload/jhbatchcheck" enctype="multipart/form-data" method="post" id='batchUploadForm' onsubmit="return checkform()">
    <table  cellspacing="0" cellpadding="0" class="tableborder">
    <tr>
     <th>请选择要上传的文件：</th>
     <td><input type="file" size="25" id="jhASNFile" name="jhASNFile" class="text-input"></td>
    </tr>
    <tr>
       <th>样例文件下载:</th>
       <td><a href="/merchant/receiving-upload/down-asn-templete/file/jh-asn-upload">ASN上传模板</a></td>
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
<div class="message-warning">
<{$uploadResult}>
</div>
<{/if}>
<script type="text/javascript">
    function checkform(){
        if(!$('#jhASNFile').val()){
            alertTip('必须选择文件');
            return false;
        }
        return true;
    }
</script>