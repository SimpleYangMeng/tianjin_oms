<style>
  #subProducts .textInput{
      float:none;;
  }
</style>
<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
        <div class="content-box-header">
                <h3 style="margin-left:5px"><{$action}></h3>
                <div class="clear"></div>
        </div>
        <form method="post" action="/merchant/product/combine" id="productCombinebForm" class="pageForm required-validate">
                <table >
                        <tbody>
                                <tr>
                                        <td class="form_title"><{t}>skuCode<{/t}>：</td>
                                        <td class="form_input"><input name="product_id" value="<{$product_id}>" type="hidden" id="product_id">
                                                <{if isset($productCombineInfo)&&$productCombineInfo.product_sku}>												
                                                <input name="product_sku" id="product_sku" class="required text-input fix-medium-input readonly inputbox"  type="text" value="<{if isset($productCombineInfo)&&$productCombineInfo.product_sku}><{$productCombineInfo.product_sku}><{/if}>" readonly  />
                                                <{else}>
                                                <input name="product_sku" id="product_sku" class="required text-input fix-medium-input" type="text" placeholder="<{t}>Please_input_combinations_of_SKU<{/t}>"/>   
                                                <{/if}> <strong>*</strong> <a href="#"  class="tip" title="(<{t}>combinations_bar_tip<{/t}>)" onclick="return false;"><img src="/images/help.png"></a></td>
                                </tr>
                                <tr>
                                        <td class="form_title"><{t}>CombineProductName<{/t}>：</td>
                                        <td class="form_input"><input name="product_title_cn" id="product_title_cn" class="required text-input fix-medium-input" placeholder="<{t}>Please_enter_the_name_of_the_Chinese_combination_products<{/t}>" type="text"  value="<{if isset($productCombineInfo)&&$productCombineInfo.product_title}><{$productCombineInfo.product_title}><{/if}>" />
                                                <strong>*</strong>  <a href="#"  class="tip" title="(<{t}>product_name_tip<{/t}>)" onclick="return false;"><img src="/images/help.png"></a></td>
                                </tr>
                                <tr>
                                        <td class="form_title"><{t}>currencyNameEn<{/t}>：</td>
                                        <td class="form_input"><input name="product_title_en" id="product_title_en" type="text"  class="text-input fix-medium-input" placeholder="<{t}>Please_enter_the_name_of_the_English_combination_products<{/t}>"  value="<{if isset($productCombineInfo)&&$productCombineInfo.product_title_en}><{$productCombineInfo.product_title_en}><{/if}>" /> <strong style=" visibility:hidden;">*</strong>&nbsp;<a href="#"  class="tip" title="(请输入产品的英文名称，建议使用网站英文品名)" onclick="return false;"><img src="/images/help.png"></a></td>
                                </tr>
                        
                        <tr>
                                <td class="form_title">&nbsp;</td>
                                <td class="form_input"><a href="#" id="dialog_link" class="ui-state-default  ui-corner-all" style="width:80px"><{t}>SelectProduct<{/t}></a> </td>
                        </tr>
                        
                        <tr>
                                <td class="form_title">&nbsp;</td>
                                <td class="form_input">							
								
								<table id="subProducts" border="1" width="400">
									<{if isset($productCombineInfo)&&$productCombineInfo.subs}> 
									<{foreach from=$productCombineInfo.subs item=sub name=sub}>
									
										<tr id="subProduct<{$sub.pcr_product_id}>">
									
										<th> <{t}>CombineSonSku<{/t}>:</th>
										<td  style="text-align:left">
										<input type='text' class='readonly inputbox' readonly value='<{$sub.pcr_product_sku}>' size='28'>
										</td>
										<th >
										 <{t}>quantity<{/t}>:
										 </th>
										 <td style="text-align:left">
										 <input type='text' class='inputbox inputMinbox' name='sub[<{$sub.pcr_product_id}>]' value='<{$sub.pcr_quantity}>' size='5' /> 
										</td>
										
										<td style="text-align:left">
										 <img title='Delete' product_id='<{$sub.pcr_product_id}>' class='subProductDel' src='/images/icon_del.gif'/>
										</td>
										
										
										</tr>                         
												
                                		<{/foreach}> 
									<{/if}> 
								
								
								</table>
								
								<!--
								<div id="subProducts" style="float:left;"> 
								
								<{if isset($productCombineInfo)&&$productCombineInfo.subs}> 
								<{foreach from=$productCombineInfo.subs item=sub name=sub}>
                                                <div id="subProduct<{$sub.pcr_product_id}>" style="border:1px solid #ff0000"> 
												 <span>&nbsp;&nbsp;&nbsp;&nbsp;<{t}>CombineSonSku<{/t}>:</span>
												 <span>
                                                        <input type="text" size="28" value="<{$sub.pcr_product_sku}>"  class="readonly text-input fix-medium-input" readonly="readonly" size="28" />
														
                                                        &nbsp;&nbsp;&nbsp;<span style="font-weight: bold;">Quantity:</span>&nbsp;&nbsp;<input type="text" class="text-input fix-small-input" size="5" value="<{$sub.pcr_quantity}>" name="sub[<{$sub.pcr_product_id}>]" size="5" />                                           
                                                        
														&nbsp;<a href='javascript:;' title='Delete' class='subProductDel'><img src='/images/icon_del.gif'/></a>
														
														
                                                        </span> 
														
												</div>
												<div class="clear"></div>
                                <{/foreach}> 
								<{/if}>
                                                
                                </div>
								!-->
										
										
								</td>
                        </tr>
                        <tr>
                                <td class="form_title">&nbsp;</td>
                                <td class="form_input"><a  class="button tijiao" onclick="do_combine_submit()"><{t}>submit<{/t}></a> </td>
                        </tr>
                        </tbody>
                        
                </table>
        </form>
        <div class="infoTips" id="combinetips" title="<{t}>InformationTips<{/t}>"> </div>
        <div id="dialog" title="<{t}>SelectProduct<{/t}>"> </div>
</div>


<script type="text/javascript">

	var actionLabel = '<{$actionLabel}>';
    //console.log(actionLabel);

	$(function(){
		/*选择产品的复选框单击*/
        $(".productCombineactionSku").live("click", function(){
            var productSku = $(this).attr("productSku");
            var productId = $(this).attr("productId");
            if($(this).is(':checked')){
                if($("#subProduct"+productId).size()==0){
                     $("#subProducts").append("<tr id='subProduct"+productId+"'><th><{t}>son_SKU<{/t}>:</th><td style='text-align:left'><input type='text' class='readonly inputbox' readonly value='"+productSku+"' size='28'> </td> <th><{t}>quantity<{/t}>:</th><td style='text-align:left'><input type='text' class='inputbox inputMinbox' name='sub["+productId+"]' value='1' size='5'> </td><td style='text-align:left'><img title='Delete' product_id='"+ productId +"' class='subProductDel' src='/images/icon_del.gif'/></td></tr>");
					//$("#subProducts").append("<div id='subProduct"+productId+"'><span> &nbsp;&nbsp;&nbsp;&nbsp;子sku:&nbsp;</span><span><input type='text' id='orderproduct"+ productId +"' class='readonly text-input fix-medium-input' readonly value='"+productSku+"' size='28'> &nbsp;&nbsp;&nbsp;<span style='font-weight:bold;'>Quantity:</span>&nbsp;&nbsp;<input type='text' class='text-input fix-small-input' name='sub["+productId+"]' value='1' size='5'><a href='javascript:;' product_id='"+ productId+"' title='Delete' class='subProductDel'>&nbsp;<img src='/images/icon_del.gif'/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class='clear'></div></div>");
                }
            }else{
                if($("#subProduct"+productId).size()>0){
                    $("#subProduct"+productId).remove();
                }
            }
        });
		/*取消子sku*/
        $(".subProductDel").live("click",function(){
			_this = $(this);
			var product_id = _this.attr('product_id');
			$('#subProduct'+product_id).remove();
			//$(this).parent().parent.remove();
			//alert($(this).parent().attr('id'));
            //$(this).parent().remove();
			keepTheInterface();
        });
        
 		/*----------------产品弹出框的功能---------2013-08-19 colin yang---------------*/
		
		
		// 产品浏览的对话框			
		$('#dialog').dialog({
			autoOpen: false,
			modal: false,			
			bgiframe:true,
			position:[50,50],
			width: 850,	
			height:'auto',
			resizable: true			
		});
		
		$('#combinetips').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			position:[50,50],
			width: 400,	
			minHeight:100,
			height:'auto',	
			resizable: true			
		});	
						
			//产品浏览
		$('#dialog_link').click(function(){					
					$('#dialog').dialog('open');
					getProductListBoxData('productCombine'); 					
					return false;
		});     
		
		  
        
	});
	
	/*对话框内部切换数据 分页*/
	function dialogSearch(form){
		
		var $form = $(form);		
		getProductListBoxData('productCombine',2,50);
	//if (form[DWZ.pageInfo.pageNum]) form[DWZ.pageInfo.pageNum].value = 1;
	//$.pdialog.reload($form.attr('action'), {data: $form.serializeArray()});
		return false;
	}
	
		
		
		
		
		
	function do_combine_submit(){
    //return false;	
	///merchant/product/add-save
             	//$('.mytip').emptyTip();
				var options = {
				//target:'#combinetips', //后台将把传递过来的值赋给该元素
				url:'/merchant/product/combine', //提交给哪个执行
				type:'POST',
				dataType:'json',
				//dataType:'html',
				success: function(data){
					var html ="";
					//alert(data);return;
					if(data.ask==1){
						html += data.message+'</br></br>';
						if(actionLabel=='add'){
							html += '<button class="button buttonheight" onclick="parent.openMenuTab('+'\'/merchant/product/combine\',\'<{t}>CombineProductAdd<{/t}>\',\'CombineProductAdd\',\'1\')"><{t}>CombineProductAdd1<{/t}></button>';
							
							var productId = data.productId || '';
							var product_sku =  data.product_sku || '';
							
							if(productId!=''){
								html += '<button class="button buttonheight" onclick="parent.openMenuTab('+'\'/merchant/product/combine/productId/';
								html+=productId;
								html+='\',\'<{t}>edit_combine_product<{/t}>(';
								html+=product_sku;
								html+=')\',\'productcombineedit';
								html+=productId;
								html+='\',\'1\')"><{t}><{t}>edit_combine_product<{/t}><{/t}></button>';
							}
													
							//html += '<a href="/merchant/product"><{t}>ProductList<{/t}></a>';
						}//=='add'){
						
						if(actionLabel=='update'){
							html += '<button class="button buttonheight" onclick="parent.openMenuTab('+'\'/merchant/product/combine\',\'<{t}>CombineProductAdd<{/t}>\',\'CombineProductAdd\',\'1\')"><{t}>CombineProductAdd1<{/t}></button>';							
							var productId = data.productId || '';
							var product_sku =  data.product_sku || '';
							if(productId!=''){
								html += '<button class="button buttonheight" onclick="parent.openMenuTab('+'\'/merchant/product/combine/productId/';
								html+=productId;
								html+='\',\'<{t}>edit_combine_product<{/t}>(';
								html+=product_sku;
								html+=')\',\'productcombineedit';
								html+=productId;
								html+='\',\'1\')"><{t}><{t}>edit_combine_product<{/t}><{/t}></button></br>';
							}							
							//html += '<a href="/merchant/product"><{t}>ProductList<{/t}></a>';
						}		//update				 
						$("#combinetips").dialog({close:function(){ gotoproductlist(); }});
						$("#combinetips").html(html);			
					}else{													
						
						
						html+=data.message+"<br/>";
						
						try{				
								$.each(data.error,function(idx,vitem){
						 			html+=vitem+"<br/>";
								});
						}catch(e){
								
						}						
						//alert(html);
						$("#combinetips").dialog({close:null});
						$("#combinetips").html(html);
					
					}
					
					$('#combinetips').dialog('open');
					
				
				
				
				}}; //显示操作提示
	
				$("#productCombinebForm").ajaxSubmit(options); 
				return false;
	
		    
	}  //end of function		
		


	
function gotoproductlist(){
	parent.openMenuTab('/merchant/product','<{t}>ProductList<{/t}>','ProductList','1');
}			
			
			
</script>