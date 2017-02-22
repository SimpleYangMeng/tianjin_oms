<style>
<!--
#editUpload table,  #editUpload td,#editUpload th{
	border: solid 1px  #AAFFFF;  
	border-collapse:collapse;
	text-align:center;
}
 #editUpload th{
	-moz-background-clip:border;
	-moz-background-inline-policy:continuous;
	-moz-background-origin:padding;
	background:#F79732 none repeat scroll 0 0;
	color:#FFFFFF;	
	line-height:30px;
}
.tablebiaoge{ border-collapse:collapse}
.tablebiaoge td{border:1px solid #AAFFFF}

.error{
    float: left;
    margin-right: 20px;
    border:1px solid red;
}
-->
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px">预览</h3>
        <div class="clear"></div>
     </div>

 
<table cellpadding="0" cellspacing="0" width="100%">
  <tbody>
  <tr style="background-color: rgb(170, 255, 255);">
  	<{foreach from=$excelHead key=index item=val}>
    	<th align="center" bgcolor="#AAFFFF"><{$val}></th>
   	<{/foreach}>
  </tr>
 </tbody>
  <{foreach from=$excelData item=row}>
    <tr>      
    	<{foreach from=$row item=cell}>
      		<td><{$cell}></td>
      	<{/foreach}>
    </tr>    
    <tr>
       <td colspan="13" style="border-top:1px solid #7766ee">&nbsp;</td>
    </tr>	
  <{/foreach}>
 </table>
 
 <div id="btnConfirm" align="center">
  <INPUT id="checkbuttom" onclick="confirmUpload();" class='button' type="button" value="确定上传">
</div>

</div>
<script>
function confirmUpload() {
	$.post('/merchant/element/confirm',{},function(data){
		if(data.ask==0) alert(data.message);
		else {
			alert('上传申报要素成功');
			$('#btnConfirm').html('已上传');
		}
	},'json');
}
</script>