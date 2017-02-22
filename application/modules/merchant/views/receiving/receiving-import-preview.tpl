<script type="text/javascript">

function  submitBatch(){
    var selectedNumber = $('.checked').size();
	if(selectedNumber == 0){
    	alertTip('<{t}>please_select_products_those_need_to_upload<{/t}>');
        return false;
    }
	$('#datafrom').submit();
}
$(function(){
	$('#messageTip').dialog({
		autoOpen: false,
		modal: false,
		bgiframe:true,
		width: 400,
		resizable: true			
	});
	
	<{if !empty($uploadData.error)}>
		var html = '';
		<{foreach  key=index from=$uploadData.error item=item}>
			html += "<{$item}>"+'<br/>';
		<{/foreach}>
		$("#messageTip").html(html);
		$('#messageTip').dialog('open');
	<{/if}>
	
})


</script> 
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px">入库单明细上传</h3>
        <div class="clear"></div>
     </div>
<form id="datafrom" action="/merchant/receiving-detail/insert" method="post">

<table cellpadding="0" cellspacing="0" width="100%" id="previewbox">
  <tbody>
  <tr style="background-color: rgb(170, 255, 255);">
    <th align="center" bgcolor="#AAFFFF"><{t}>no<{/t}></th>
	<th align="center" bgcolor="#AAFFFF">入库单号</th>
    <th align="center" bgcolor="#AAFFFF">料件号</th>
    <th align="center" bgcolor="#AAFFFF">产品名称</th>
    <th align="center" bgcolor="#AAFFFF">申报数量</th>
    <th align="center" bgcolor="#AAFFFF">法定数量</th>
	<th align="center" bgcolor="#AAFFFF">申报单价</th>
	<th align="center" bgcolor="#AAFFFF">申报总价</th>
  </tr>
 </tbody>
  <{foreach key=index from=$uploadData.data item=item}>
    <tr>
	  <td><{$index}></td>
      <td><{$item.receivingCode}></td>
	  <td><{$item.goodsId}></td>
      <td><{$item.nameCn}></td>
	  <td><{$item.gQty}></td>
	  <td><{$item.qty1}></td>
	  <td><{$item.declPrice}></td>
	  <td><{$item.declTotal}></td>
    </tr>
  <{/foreach}>
 </table>
 <div align="center">
  <{if empty($uploadData.error)}>
  <input class='button' type="submit" value="确定上传">
  <{/if}>
  <input onclick="returnBack();" class='button' type="button" value="<{t}>back<{/t}>">
</div>
</form>
</div>

<div class="infoTips" id="messageTip" title="<{t}>InformationTips<{/t}>"></div>
<script>
function returnBack(){
	history.go(-1);
}
</script>