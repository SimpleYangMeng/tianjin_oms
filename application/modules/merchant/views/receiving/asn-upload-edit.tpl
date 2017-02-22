<!--暂废弃!-->
<script type="text/javascript">

function   checkAll1(){
 
    if($('#checkAll').is(':checked')){
        $('.checked').attr('checked',true)
    }else{
        $('.checked').attr('checked',false)
    }
}
function  submitBatch(){
    var checked = false;
    $('.checked').each(function(){
        if($(this).is(':checked')){
            checked = true;
        }
    })
    
    if(checked == false){
   	 	alertTip('请选择需要操作的ASN');
       return false;
    }
    if($('#selectBatch').val() == ''){
    	alertTip('请选择要操作的ASN');
        return false;
    }
	$('#datafrom').submit();
}

</script> 
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
        <h3 style="margin-left:5px">集货模式ASN批量上传</h3>
        <div class="clear"></div>
     </div>

 
<form id="datafrom" action="/merchant/receiving-upload/jhimport" method="post">

<table cellpadding="0" cellspacing="0" width="100%">
  <tbody>
  <tr style="background-color: rgb(170, 255, 255);">
    <th  align="center" bgcolor="#AAFFFF"><input id="checkAll" checked="checked" onclick="checkAll1();" type="checkbox">序号</th>
    <th  align="center" bgcolor="#AAFFFF">交货仓库</th>
    <th align="center" bgcolor="#AAFFFF">目的仓库</th>
    <th align="center" bgcolor="#AAFFFF">客户参考号</th>
    <th align="center" bgcolor="#AAFFFF">航空单号</th>
    <th align="center" bgcolor="#AAFFFF">毛重</th>
    <th align="center" bgcolor="#AAFFFF">长</th>
    <th align="center" bgcolor="#AAFFFF">宽</th>
    <th align="center" bgcolor="#AAFFFF">高</th>
    <th>备注</th>
  </tr>
 </tbody>
  <{foreach name=data key=index from=$uploadData item=order}>
    <tr>
      <td>
      <{if $order.is_valid=='1'}>
          <input class="checked" type="checkbox"  checked="true" value="<{$index}>" name="select[]">
      <{/if}>
      </td>
      <td><{$order.warehouse_name}></td>
      <td><{$order.to_warehouse_name}></td>
      <td><{$order.ref_code}></td>
      <td><{$order.traf_name}></td>
      <td><{$order.roughweight}></td>
      <td><{$order.length}></td>
      <td><{$order.width}></td>
      <td><{$order.height}></td>
      <td><{$order.instructions}></td>
    </tr>
    <{if $order.is_valid=='0' }>
    <tr>
       <td colspan="11">
         <{foreach from=$order.error item=error}>
         <div class="error">
            <{$error}>
         </div>
         <{/foreach}>
       </td>
    </tr>
    <{/if}>
  <{/foreach}>

 </table>
 
 
 <DIV align="center">
  <INPUT id="checkbuttom" onclick="submitBatch();" class='button' type="button" value="导入ASN数据">
</DIV>
</form>
</div>
