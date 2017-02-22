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
		padding:5px;
		height: auto;
		
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
<div class="content-box  ui-tabs  ui-corner-all" style="height:800px">

    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">海关申报要素上传</h3> 
		<div class="clear"></div>       
    </div>
	
	<!--<form action="/merchant/product/batch-product-insert" method="post" id="XLSInputForm">	-->
	<form action="/merchant/element/upload" method="post" id="XLSInputForm"  enctype="multipart/form-data" onsubmit="return checkform()">	
		<table cellspacing="0" cellpadding="0" class="tableborder">
			<tr>
				<th>输入海关编码下载对应模板:</th>
				<td>
					<input type="text" id="hs_code" size="15">
					<a href="javascript:download();">点击下载</a>
          &nbsp;&nbsp;<a href="javascript:queryHsCode();">查询</a>
				</td>
				</tr>	
				
				<tr>
				<th>请选择要上传的文件:</th>
				<td><input type="file" name="XMLForInput" id="XMLForInput" /></td>
				</tr>
				
				<tr><td colspan="2" style="padding-left:35%;">
				<input class="button" type="submit" value="批量上传">
				<!--<a  id="startUploadXLS" class="button"  onclick="return false;"><{t}>导入<{/t}></a>!-->
				</td>
			</tr>
		</table>		
	</form>		

  <div id="messageTip" style="display:none;margin:10px 10px;"></div>

	<{if isset($message)}>
	<br>
	<div class="message-warning">
	   <{$message}>
	</div>
	
	<{/if}>	
	
</div>



<script type="text/javascript">
function checkform(){
   if(!$('#XMLForInput').val()){
		alertTip('必须选择文件');
		return false;
	}
    return true;
}

function download() {
	var hs_code = $('#hs_code').val();
	if(hs_code=='') {
		alert('请输入海关编码');
		return false;
	}
	window.open('/merchant/element/template/hs_code/'+hs_code);
}

function queryHsCode() {
  var hsCode = $.trim($('#hs_code').val());

  if ('' == hsCode) {
    $('#messageTip').css({
      'color' : '#b22222'
    }).html('请输入海关编码').show();
    return ;
  }

  $.ajax({
    url : '/merchant/element/query-hscode',
    type : 'POST',
    dataType : 'json',
    data : {'code' : hsCode},
    async : true,
    success : function (data) {
      if (data.status) {
        $('#messageTip').css({
          'color' : '#323232'
        }).html('海关编码[' + hsCode + ']申报要素：<br />' + data.element.join('<br />')).show();
      }
      else {
        $('#messageTip').css({
          'color' : '#b22222'
        }).html(data.message).show();
      }
    },
    error : function () {
      alert('请求错误，请稍候再试');
    }
  });
}
</script>