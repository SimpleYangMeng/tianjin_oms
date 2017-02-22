<script type="text/javascript">

function   checkAll1(){
 
    if($('#checkAll').is(':checked')){	
        $('.checked').attr('checked',true);		
    }else{
        $('.checked').attr('checked',false);
		
    }
}
function  submitBatch(){
    
    var selectedNumber = $('.checked').size();
   
	if(selectedNumber == 0){
    	alertTip('<{t}>please_select_products_those_need_to_upload<{/t}>');
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
table td
.error{
    float: left;
    margin-right: 20px;
    border:1px solid red;
}
table#previewbox td{  text-align:center; }

-->
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><{t}>BatchProductExport<{/t}></h3>
        <div class="clear"></div>
     </div>

 
<form id="datafrom" action="/merchant/product-batch-upload/do-batch-insert" method="post">

<table cellpadding="0" cellspacing="0" width="100%" id="previewbox">
  <tbody>
  <tr style="background-color: rgb(170, 255, 255);">
    <th  align="center" bgcolor="#AAFFFF"><input id="checkAll" checked="checked" onclick="checkAll1();" type="checkbox"> <{t}>no<{/t}></th>
    <th  align="center" bgcolor="#AAFFFF"><{t}>skuCode<{/t}></th>
    <th align="center" bgcolor="#AAFFFF" style="width:30em"><{t}>productTitle<{/t}></th>
    <th align="center" bgcolor="#AAFFFF"><{t}>ProductCategory<{/t}></th>
    <th align="center" bgcolor="#AAFFFF"><{t}>puCode<{/t}></th>
    
    <th align="center" bgcolor="#AAFFFF"><{t}>ReportingCurrency<{/t}></th>
	<th align="center" bgcolor="#AAFFFF"><{t}>declaredValue<{/t}></th>
    <th><{t}>weight<{/t}>(KG)</th>  
	<th><{t}>country_code_of_origin<{/t}></th> 
	<th><{t}>brand<{/t}></th>   
  </tr>
 </tbody>
  <{foreach name=data key=index from=$uploadData item=order}>
    <tr>
      <td>
      <{if $order.is_valid=='1'}>
          <input  type="checkbox"  class="checked" checked="true" value="<{$index}>" name="select[]" />
      <{/if}>
      </td>
      <td ><{$order.product_sku}></td>
      <td><{$order.product_title}></td>
      <td><{$order.pc_name}></td>
      <td><{$order.pu_name}></td>
      
      <td><{$order.currency_code}></td>
	  <td><{$order.product_declared_value}></td>	  
      <td><{$order.product_weight}></td>
      <td><{$order.country_title}></td>
	  <td><{$order.brand}></td>
    </tr>
    <{if $order.is_valid=='0' }>
    <tr>
       <td colspan="13">
         <{foreach from=$order.error item=error}>
         <div class="error">
            <{$error}>
         </div>
         <{/foreach}>
       </td>
    </tr>
    <{/if}>
    <tr>
       <td colspan="13" style="border-top:1px solid #7766ee">&nbsp;        
       </td>
    </tr>	
  <{/foreach}>

 </table>
 
 
 <DIV align="center">
  <INPUT id="checkbuttom" onclick="submitBatch();" class='button' type="button" value="<{t}>confirm_to_upload_products_those_selected<{/t}>">
</DIV>
</form>
</div>
<script>
/*
$(function(){
   //隔行换色   
    $("#datafrom").alterBgColor();
    
})
*/
</script>