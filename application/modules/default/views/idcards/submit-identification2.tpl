<style>

</style>
<div class="grid-780 grid-780-pd fn-hidden fn-clear" style="border:1px solid #ddd;height:400px; padding:20px;">
    <div class="flow-steps">
        <h3 style=" border-bottom:1px solid #666">
          -海关清关入境包裹，请配合提交收件人身份证明
        </h3>
    </div>
    <div class="grid-780 fn-clear" style="margin-top:30px">
        
        <form id="registerForm" class="fm-layout" method="post" action="/id/submit-identification2" enctype="multipart/form-data">
		
			<table style="float:left;width:360px; ">
				<tr>
					<td style="text-align:right;width:160px">交易订单号：</td><td><{$reference_no}><input  type="hidden"  value="<{$reference_no}>" class="text-input validate[required]" id="reference_no" name="reference_no"></td>
				</tr>
				<tr>
					<td style="text-align:right">身份证名字：</td>
					<td><{$consignee_person}><input  type="hidden" class="text-input validate[required]" id="consignee_person" name="consignee_person" value="<{$consignee_person}>"/></td>
				</tr>
				<tr>
					<td style="text-align:right">身份证号码：</td><td><{$order.idNumber}><input  type="hidden" class="text-input validate[required]" id="idcard_number" name="idcard_number"  value="<{$order.idNumber}>"  /></td>
				</tr>
								
				<tr >
					<td style="text-align:right">身份证正反两面复印件上传：</td><td>
					<p class="uploadfrontsidebox"><input class="text-input3" type="file" id="frontsidefile" name="frontsidefile"  /></p>
					
					<p class="uploadbutton" style="display:none;"><input type="button" value="重新上传身份证" onclick="re_upload()"/></p>
					
					<br/><a href="" id="frontsideimga"   target="_blank"><img src=""   id="frontsideimg"  style="display:none;border:1px solid #ddd" height="50" /></a>
					
					</td>
				</tr>							
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" class="button text-input" value="确定" style="width:80px;"  /></td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td style="color:#FF0000">
					<{foreach from=$info item=error }>
    					<{$error}><br/>
    				<{/foreach}>						
					</td>
				</tr>				
				
								
			</table>  
			
			<table style="float:left;">
				<tr>
					<td style="text-align:right">收件人省份：</td><td><{$orderAddress.oab_state}></td>
				</tr>

				<tr>
					<td style="text-align:right">收件人城市：</td><td><{$orderAddress.oab_city}></td>
				</tr>
				
				<tr>
					<td style="text-align:right">收件人电话：</td><td><{$orderAddress.oab_phone}></td>
				</tr>
				<tr>
					<td style="text-align:right">收件人邮编：</td><td><{$orderAddress.oab_postcode}></td>
				</tr>	
				<tr>
					<td style="text-align:right">收件人地址：</td><td><{$orderAddress.oab_street_address1}></td>
				</tr>															
			</table>  			        
        </form>
    </div>
</div>




<script type="text/javascript">

	$(document).ready(function(){
		
		$('#idcard_number').trigger('change');
	
	});
	$('#idcard_number').change(function(){
		var idcard_number = $("input[name='idcard_number']").val();	
		var consignee_person = $("input[name='consignee_person']").val();
		if(idcard_number==''){
			return;
		}
		getIDcard(idcard_number,consignee_person);		
	});	
	
	
	function getIDcard(idcard_number,consignee_person)	{
				var reference_no = $("input[name='reference_no']").val();
  				$.ajax({
                    type:"POST",
                    async:false,
                    dataType:"json",
                    data:{idcardNumber:idcard_number,consigneePerson:consignee_person,reference_no:reference_no},
                    url:'/id/getidcard-number',
                    success:function(json) {
                        if(json.ask=='1'){
							//front_side_idcard
							$('#frontsideimg').attr('src',json.front_side_idcard);							
							$('#frontsideimga').attr('href',json.front_side_idcard);												
							$('#frontsideimg').show();
							
							$('.uploadfrontsidebox').hide();
							$('.uploadbutton').show();
						}else{
							$('.uploadfrontsidebox').show();
												
							
						}
                        
                    }
                });
	}
	
	function re_upload(){
		$('.uploadfrontsidebox').show();
		$('.uploadbutton').hide();
	}					
</script>