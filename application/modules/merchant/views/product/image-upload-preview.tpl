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
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><{t}>BatchProductExport<{/t}></h3>
        <div class="clear"></div>
     </div>
<form id="datafrom" action="/merchant/product/do-batch-image-insert" method="post">

<table cellpadding="0" cellspacing="0" width="100%" id="previewbox">
  <tbody>
  <tr style="background-color: rgb(170, 255, 255);">
    <th  align="center" bgcolor="#AAFFFF"><input id="checkAll" checked="checked" onclick="checkAll1();" type="checkbox"> <{t}>no<{/t}></th>
    <th align="center" bgcolor="#AAFFFF" style="width:15%;"><{t}>skuCode<{/t}></th>
    <th align="center" bgcolor="#AAFFFF" style="width:20%"><{t}>图片1<{/t}></th>
    <th align="center" bgcolor="#AAFFFF" style="width:20%"><{t}>图片2<{/t}></th>
    <th align="center" bgcolor="#AAFFFF" style="width:20%"><{t}>图片3<{/t}></th>
    <th align="center" bgcolor="#AAFFFF" style="width:20%"><{t}>图片4<{/t}></th>
  </tr>
 </tbody>
  <{foreach name=data key=index from=$imageData item=image}>
    <tr>
      <td>
      <{if $image.is_valid=='1'}>
          <input  type="checkbox"  class="checked" checked="true" value="<{$index}>" name="select[]" />
      <{/if}>
      </td>
	  <td><{$index}></td>
      <td><{if isset($image.1_)}><img src="<{$image.1_.0}>" width="60px" height="60px" /><{else}>No Image<{/if}></td>
      <td><{if isset($image.2_)}><img src="<{$image.2_.0}>" width="60px" height="60px" /><{else}>No Image<{/if}></td>
	  <td><{if isset($image.3_)}><img src="<{$image.3_.0}>" width="60px" height="60px" /><{else}>No Image<{/if}></td>
	  <td><{if isset($image.4_)}><img src="<{$image.4_.0}>" width="60px" height="60px" /><{else}>No Image<{/if}></td>
    </tr>
    <{if $image.is_valid=='0' }>
    <tr>
       <td colspan="13">
         <{foreach from=$image.error item=error}>
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
  <INPUT id="checkbuttom" onclick="returnBack();" class='button' type="button" value="<{t}>back<{/t}>">
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
function returnBack(){
	history.go(-1);
}
</script>