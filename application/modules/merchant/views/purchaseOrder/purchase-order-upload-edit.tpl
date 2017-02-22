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
   	 	alertTip('请选择需要操作的采购订单');
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
        <h3 style="margin-left:5px"><{t}>purchase-order-batch-upload<{/t}></h3>
        <div class="clear"></div>
     </div>

 
<form id="datafrom" action="/merchant/purchase-order-batch-upload/import" method="post">

<table cellpadding="0"   cellspacing="0" width="100%">
  <tbody>
  <tr style="background-color: rgb(170, 255, 255);">
    <th  align="center" bgcolor="#AAFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="checkAll" checked="checked" onclick="checkAll1();" type="checkbox"> 序号</th>
    <th  align="center" bgcolor="#AAFFFF">采购订单</th>
    <th  align="center" bgcolor="#AAFFFF">供应商代码</th>

    <th align="center" bgcolor="#AAFFFF">产品SKU</th> 
	<th align="center" bgcolor="#AAFFFF">采购数量</th> 
    <th  align="center" bgcolor="#AAFFFF">备注</th>
  </tr>
 </tbody>
  <{foreach name=data key=index from=$uploadData item=order}>
    <tr >
      <td style="text-align:center">
      <{if $order.is_valid=='1'}>
          <input class="checked" type="checkbox"  checked="true" value="<{$index}>" name="select[]">
      <{/if}>
      </td>
      <td><{$order.po_code}></td>
      <td><{$order.supply_code}></td>
      
   

      <td>
	     <{foreach key=index from=$order.product_sku item=product_sku}>
     		<{$product_sku}><br/>			
			
 		 <{/foreach}>
	  
	  </td>
 
       <td style="text-align:center">
	     <{foreach key=index from=$order.product_sku item=product_sku}>
     		<{$order.sku[$index]}><br/>		
 		 <{/foreach}>
	  
	  </td>
	  
	   <td><{$order.po_description}></td>
      
    </tr>
    <{if $order.is_valid=='0' }>
    <tr>
       <td colspan="12" style="border-bottom:1px solid #0000ff;">
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
  <INPUT id="checkbuttom" onclick="submitBatch();" class='button' type="button" value="导入采购单"/>
</DIV>
</form>
</div>
