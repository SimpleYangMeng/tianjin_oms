<style>
	.fm-req{margin-top:10px;}
	.fm-opt{margin-top:10px;}
</style>


<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><{t}>account_baseinfo<{/t}></h3>
        <div class="clear"></div>
    </div>

	
			
			<form action="/merchant/customer/edit"  id="customeredit" method="post"   class="fm-layout"  enctype="multipart/form-data"  style="padding-left:20px;" >

		
			<table>
				<tr>
					<th class="nowrap text_right"><{t}>account_name<{/t}>：</th>
					<td> <{$userInfo['customer_code']}></td>
				</tr>
				
				<tr>
					<th class="nowrap text_right"><{t}>email_address<{/t}>：</th>
					<td><{$userInfo['customer_email']}></td>
				</tr>
			<!-- 	
				<tr>
					<th class="nowrap text_right"><{t}>company_name<{/t}>：</th>
					<td><{$userInfo['customer_company_name']}></td>
				</tr> -->
				
				<tr>
					<th class="nowrap text_right">企业类型：</th>
					<td>
                <!--     <{if $userInfo['customer_type'] eq 1}>电商企业
						<{elseif $userInfo['customer_type'] eq 2}>物流企业
						<{elseif $userInfo['customer_type'] eq 3}>支付企业
					<{/if}> -->
                    
                        <!-- <input type="checkbox" <{if $userInfo['is_ecommerce'] eq 1}>checked = "checked"<{/if}>>电商企业
                        <input type="checkbox" <{if $userInfo['is_shipping'] eq 1}>checked = "checked"<{/if}>>物流企业
                        <input type="checkbox" <{if $userInfo['is_pay'] eq 1}>checked = "checked"<{/if}>>支付企业
                        <input type="checkbox" <{if $userInfo['is_storage'] eq 1}>checked = "checked"<{/if}>>仓储企业 -->
                        <{if $userInfo['is_ecommerce'] eq 1}>电商企业<{/if}>
                        <{if $userInfo['is_shipping'] eq 1}>物流企业<{/if}>
                        <{if $userInfo['is_pay'] eq 1}>支付企业<{/if}>
                        <{if $userInfo['is_storage'] eq 1}>仓储企业<{/if}>
                        <{if $userInfo['is_supervision'] eq 1}>监管场所<{/if}>
                        <{if $userInfo['is_platform'] eq 1}>电商平台<{/if}>
					</td>
					<!-- <td>
						<{if $userInfo['customer_type'] eq 1}>
						<a class="button" onclick="add();">申请绑定功能</a>
						<{/if}>
					</td> -->

				</tr>
				
				<tr>
                    <th class="nowrap text_right"><{t}>企业名称<{/t}>：</th>
                    <td> <{$userInfo['trade_name']}></td>
                </tr>
                <{if $userInfo['is_storage'] eq 1 || $userInfo['is_ecommerce'] eq 1}>
                <tr>
					<th class="nowrap text_right"><{t}>企业海关编码<{/t}>：</th>
					<td> <{$userInfo['customs_reg_num']}></td>
				</tr>	
				<{/if}>
				<!-- <tr>
                    <th class="nowrap text_right"><{t}>BusinessCode<{/t}>：</th>
                    <td><{$userInfo['trade_co']}></td>
                </tr> -->

               <!--  <{if $userInfo['customer_type'] eq 1}>
                <tr>
                    <th class="nowrap text_right"><{t}>物流仓储企业<{/t}>：</th>
                    <td><{$customerTypeTwo}></td>
                </tr>

                <tr>
					<th class="nowrap text_right"><{t}>支付企业<{/t}>：</th>
					<td><{$customerTypeThree}></td>
				</tr>
                <{/if}> -->
			</table>

          
			
			
          
           	
		
		
		</form>
		

<!-- <div id="add" title="<{t}>申请物流和支付绑定功能<{/t}>" style="display:none;">
    <div class="modelcontent" style="display: block;">
        <form id="addForm" method="POST" action="/merchant/customer/apply">
        <div>
            <table class="pageFormContent">
                <tr class="jiahuowarehouse" style="display: table-row;">
                    <td width="120" style="text-align:right"><label>物流仓储企业:</label></td>
                    <td width="" style="text-align:right">
                    <select style="width:200px;" name="customer_type_second">
                    <{foreach from=$customerTypeSecond item=foo}>
                        <option value="<{$foo['customer_code']}>"><{$foo['customer_company_name']}></option>
                    <{/foreach}>
                    </select>
                    </td> -->
                    <!-- <{$customerTypeSecond|print_r}> -->
<!--                 </tr>
                <tr class="jiahuowarehouse" style="display: table-row;">
                    <td width="120" style="text-align:right"><label>支付企业:</label></td>
                    <td width="" style="text-align:right">
                    <select style="width:200px;" name="customer_type_third">
                    <{foreach from=$customerTypeThird item=foo}>
                        <option value="<{$foo['customer_code']}>"><{$foo['customer_company_name']}></option>
                    <{/foreach}>
                    </select>
                    </td>
                </tr>
            </table>
        </div>
        </form>
    </div>
</div>
</div> -->

<script>
$('#tips').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			width: 400,	
			height:500,	
			resizable: true			
			});
</script>
<style type="text/css">
    #infoform label{
        line-height: 20px;
    }
	#infoform .fm-opt{}
    #infoform .fm-req{
        margin-bottom: 10px;
    }
    #orderForm tbody span.error{
        top:auto;
    }
    span.error{
        top:auto;
        left:158px;
    }
</style>

<script>
    $(function () {
     
        });
        
    function userinfovalidateCallback(form, callback, confirmMsg) {
        alert(this);
        //var $form = $(form);
        var $form = $('#infoform');
        if (!$form.valid()) {
            return false;
        }
        $form.submit();

        var _submitFn = function(){
            $.ajax({
                type: form.method || 'POST',
                url:$form.attr("action"),
                data:$form.serializeArray(),
                dataType:"json",
                cache: false,
                success: callback || DWZ.ajaxDone,
                error: DWZ.ajaxError
            });
        }

        if (confirmMsg) {
            alertMsg.confirm(confirmMsg, {okCall: _submitFn});
        } else {
            _submitFn();
        }

        return false;
    }
    function userinfocallback(json){
        if(json.ask){
            alertMsg.correct(json.message);
            window.location.reload();
        }else{
            var html = "<strong>"+json.message+"</strong>";
            if(json.error){
                html+=":<br/>";
                $.each(json.error,function(k,v){
                    html+="<span class='red'>*</span>"+v+"<br/>";
                });
            }
            alertMsg.error(html)
        }

    }
	
		$(function(){					
				var tabs_nav = $('#tabs').tabs();	
				tabs_nav.tabs('select', 1); 
				
						
		});	
		
		
function dosubmit(){
    //return false;	
	///merchant/product/add-save
    var errorHtml = '';
    if($.trim($('#cab_lastname').val())==''){
        errorHtml +='<p>姓氏必填</p>';
    }
    if($.trim($('#cab_firstname').val())==''){
        errorHtml +='<p>名字必填</p>';
    }
    if($.trim($('#cab_phone').val())==''){
        errorHtml +='<p>电话必填</p>';
    }
    if($.trim($('#country').val())==''){
        errorHtml +='<p>国家必填</p>';
    }
    if($.trim($('#cab_state').val())==''){
        errorHtml +='<p>省份必填</p>';
    }
    if($.trim($('#cab_city').val())==''){
        errorHtml +='<p>城市必填</p>';
    }
    if($.trim($('#postcode').val())==''){
        errorHtml +='<p>邮编必填</p>';
    }
    if($.trim($('#cab_street_address1').val())==''){
        errorHtml +='<p>地址必填</p>';
    }
    if(errorHtml!=''){
        alertTip(errorHtml);
        return false;
    }
				var options = {
				//target:'#combinetips', //后台将把传递过来的值赋给该元素
				url:'/merchant/customer/edit', //提交给哪个执行
				type:'POST',
				dataType:'json',
				//dataType:'html',
				success: function(data){
					var html ="";
					
					if(data.ask==1){
						html += data.message+'</br></br>';
						
						$("#tips").html(html);			
					}else{													
						
						html+=data.message+"<br/>";				
						$.each(data.error,function(idx,vitem){
						 	html+=vitem+"<br/>";
						});
						
						
						$("#tips").html(html);
					
					}
					
					$('#tips').dialog('open');
					
				
				
				
				}}; //显示操作提示
	
				$("#infoform").ajaxSubmit(options); 
				return false;
	
		    
	}  //end of function	

	function add(){
        $("#add").dialog('open');
    }		
    $('#add').dialog({
            autoOpen: false,
            modal: true,
            bgiframe:true,
            width: 550,
            height:250,
            resizable: true,
            position: ['center', 60],
            buttons:[
                {
                    text: "<{t}>cancel<{/t}>",
                    click: function () {
                        $(this).dialog("close");
                    }
                },
                {
                    text: "<{t}>Determine<{/t}>",
                    click: function () {
                        var data = $("#addForm").serialize();
                        var product_sku = $("#addFormProductSku").val();
                        var warehouse_id = $("#addFormWarehouseId").val();
                        var safe_number = $("[name='safe_number']").val();
                        var errorMessage = "";
                        if(warehouse_id==""){
                            errorMessage+="<{t}>Warehouse_required<{/t}></br>";
                        }
                        if(errorMessage!=""){
                            alertTipWrong(errorMessage);
                            return false;
                        }
                        $.ajax({
                            type:"POST",
                            async:false,
                            dataType:'json',
                            url:"/merchant/customer/apply",
                            data:data,
                            success:function(json){
                                if(json.state=="0"){
                                    var html = "";
                                    html = json.error;
                                    alert(html);
                                }else{
                                    var html = "";
                                    html = json.message;
                                    alert(html);
                                    $("#add").dialog('close');
                                }
                            }
                        })
                    }
                }
            ], close: function () {
                $(this).dialog("close");
            }
        });
</script>