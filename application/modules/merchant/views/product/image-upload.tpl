<link href="/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<div class="content-box  ui-tabs  ui-corner-all" style="height:800px">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>批量上传图片<{/t}></h3> 
		<div class="clear"></div>       
    </div>
	<form method="post" id="commonProductForm"  action="/merchant/product/batch-upload-image-preview" class="pageForm required-validate">
		<fieldset>
		<table >
			<tbody>
				<tr>
					<td class="form_title nowrap text_right"></td>
					<td class="form_input" id="hs_element">								</td>
				</tr>
				<tr>
					<td class="form_title nowrap text_right"><{t}>productImage<{/t}>:</td>
					<td class="form_input">
						<div style="width: 120px;float:left;">
							<div id="queue"></div>
							<input id="file_upload" name="file_upload" type="file" multiple="true"  >
							<input id="sessionid" value="<{$sessionid}>" type="hidden">
						</div>
						<div style="width: 30px;float: left; margin-left:34px;display:inline;">
						<a href="#"  class="tip" title="<{t}>product_pic_tip<{/t}>" onclick="return false;"><img src="/images/help.png"/></a></div>
					</td>
				</tr>
				<tr>
					<td class="form_title"></td>
					<td class="form_input"><input  type="submit" id="submitBtn" style="display:none" class="button buttonheight" value="<{t}>submit<{/t}>" /></td>
				</tr> 
			</tbody>
		</table>
		</fieldset>
		<div class="clear"></div>
		<div class="infoTips" id="commonProductTip" title="<{t}>InformationTips<{/t}>"> </div>
	</form>
	<{if isset($result) && $result && $result.ask==1 }>
		<table cellspacing="0" cellpadding="0" class="formtable tableborder"  style="margin-top:10px">
			<thead>
			<tr>
				<th style=" text-align:center" ><{t}>skuCode<{/t}></th>             
				<th style=" text-align:center"><{t}>notice<{/t}></th>
			</tr>
			<{foreach name=data key=index from=$result.data item=row}>
			<tr>
				<td><{$index}></td>
				<td><{$row.message}></td>
			</tr>
			<{/foreach}>
			</thead>
			<tbody id='orderproducts'>
			</tbody>
		</table>
	<{/if}>

</div>
<script>
$(function() {
    if(!flashcheck()){
        alertMsg.error('<{t}>no_installed_flash_control<{/t}>');
        window.location.href='/merchant/product/playflash';        
        return;
    }
    $('#file_upload').uploadify({
		'swf'      : '/dwz/uploadify/scripts/uploadify.swf',
		'uploader' : '/merchant/product/batch-upload-image',
        'buttonText': '<{t}>压缩文件zip<{/t}>',
        'fileTypeExts': '*.zip',
		'fileSizeLimit' : 102400,
		'multi':false,
        'formData': { '<{$session_name}>' : '<{$sessionid}>' },
        'scriptData' : { '<{$session_name}>': '<{$sessionid}>' },
        'debug':false,
        'onUploadSuccess':function(file,data,response){
           if(1 != data){
				alertTip(data);
		   }else{
				$("#submitBtn").show();
		   }
        },
        'onUploadError':function(file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + ' could not be uploaded: ' + errorString+':errorCode:'+errorCode);
        }
    });
	function _loadImage(data){
		
	}
});
</script>