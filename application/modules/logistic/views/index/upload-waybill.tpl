<style type="text/css">
.tableborder th{ text-align: right;height: 20px;line-height: 20px;padding:5px;width: 30%;}
.tableborder td{ text-align: left;height: 20px;line-height: 20px;padding:5px;}
.tableborder a { color: #4377ab; text-decoration: none;}
.tableborder a:hover { color: #FF7600;}
.message-warning { margin-top: 10px;}
.message-warning .message-title { text-align: center; padding: 10px 0; font-size: 14px; font-weight: 700; }
div.error { margin: 2px 0 0 0; height: 30px; line-height: 30px; padding: 0 0px 0 20px;}
.error{margin: 0;padding: 8px 0 0 0;height: 1%;display: block;clear: both;overflow: hidden;color: #FF0000;padding-left: 20px;}
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
<div class="content-box-header">
	<h3 style="margin-left:5px"><{t}>uploadWaybill<{/t}></h3>
	<div class="clear"></div>
</div>
<form action="/logistic/index/batchcheck" enctype="multipart/form-data" method="post" id='batchUploadForm' onsubmit="return checkform()">
	<table cellspacing="0" cellpadding="0" class="tableborder">
		<tr>
			<th>请选择要上传的文件:</th>
			<td>
				<input type="file" size="25" id="waybillUpload" name="waybillUpload" class="text-input">
				<font style="color:red;"><{t}>please_select_xls_file<{/t}></font>
			</td>
		</tr>
		<tr>
			<th>样例文件下载:</th>
			<td>
				<img style="width:25px;" align="absmiddle" src="/images/download.png" />
				<a href="/pay/pay-order/down-templete/file/waybillupload">批量上传模板</a>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<input class="button" type="submit" value="批量上传">
			</td>
		</tr>
	</table>
</form>
</div>

<!-- 上传文件错误信息 begin-->
<{if isset($uploadinfo) && ($uploadinfo['ask']=='0')}>
<div class="message-warning content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
	<div class="content-box-header cl">
		<h3 style="margin-left:5px; color: red;"><{t}>错误信息<{/t}></h3>
	</div>
	<div class="message-title"><{$uploadinfo['message']}></div>
	<{foreach from=$uploadinfo['error'] item=error }>
    	<div class="error"><{$error}></div>
	<{/foreach}>
</div>
<{/if}>
<!-- 上传文件错误信息 end-->

<!-- 导入结果 begin-->
<{if isset($uploadResult) && $uploadResult!=''}>
<div class="message-warning" style="display: none;">
	<{$uploadResult}>
</div>
<{/if}>
<!-- 导入结果 end-->

<script type="text/javascript">

	//验证表单
    function checkform(){
        if(!$('#waybillUpload').val()){
            alertTip('请选择文件');
            return false;
        }
        return true;
    }
    
    $(function(){
    	
    	//导出结果 dialog
		<{if isset($uploadResult) && $uploadResult!=''}>
	        $('.message-warning').dialog({
	        	title: '导入结果(Import results)',
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
			$('.message-warning').show().dialog('open');
        <{/if}>
        
    });
    
</script>