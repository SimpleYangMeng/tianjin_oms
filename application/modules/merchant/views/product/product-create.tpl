<form method="post" id="commonProductForm"  action="/merchant/product/add-save" class="pageForm required-validate">
        <fieldset>
        <table >
                <tbody>
                <tr>
                    <td class="form_title nowrap text_right">进出口类型：</td>
                    <td class="form_input">
                        <select name="ie_type" id='ie_type' class="fix-medium2-input">
                            <{foreach from=$ieType item=item key=k }>
                                <option value="<{$k}>" <{if isset($productInfo)&&($productInfo.ie_type ==$k) }>selected<{/if}>><{$item}>
                                </option>
                            <{/foreach}>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">主管海关代码：</td>
                    <td class="form_input">
                        <select name="customs_code" class="fix-medium2-input">
                            <{foreach from=$customs item=item key=k }>
                                <option value="<{$item['ie_port']}>" <{if isset($productInfo)&&($productInfo.customs_code ==$item['ie_port']) }>selected<{/if}>><{$item['ie_port_name']}>
                                </option>
                            <{/foreach}>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">属地检验检疫机构：</td>
                    <td class="form_input">
                        <select name="ins_unit_code" class="fix-medium2-input">
                            <{foreach from=$checkOrg item=item key=k }>
                                <option value="<{$item['organization_code']}>" <{if isset($productInfo)&&($productInfo.ins_unit_code ==$item['organization_code']) }>selected<{/if}>><{$item['organization_name']}>
                                </option>
                            <{/foreach}>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>
                <{if isset($customer) && $is_ecommerce=='1'}>
                    <tr>
                        <td class="form_title nowrap text_right">电商企业代码：</td>
                        <td class="form_input"><span class="blue"><{$customer.code}></span>
                            <input name="customer_code" id="title" class="fix-medium1-input text-input" type="hidden" size="45" value="<{$customer.code}>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="form_title nowrap text_right">电商企业名称：</td>
                        <td class="form_input"><span class="blue"><{$customer.company}></span>
                            <input name="enp_name" id="enp_name" class="fix-medium1-input text-input" type="hidden" size="45"  placeholder="电商企业名称" value="<{$customer.company}>" />
                        </td>
                    </tr>
                    <{else}>
                    <tr>
                        <td class="form_title nowrap text_right">电商企业代码：</td>
                        <td class="form_input"><input name="customer_code" id="title" class="fix-medium1-input text-input" type="text" size="45"  placeholder="电商企业代码" value="<{if isset($productInfo)&&$productInfo.customer_code}><{$productInfo.customer_code}><{/if}>" />
                            <strong>*</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="form_title nowrap text_right">电商企业名称：</td>
                        <td class="form_input"><input name="enp_name" id="enp_name" class="fix-medium1-input text-input" type="text" size="45"  placeholder="电商企业名称" value="<{if isset($productInfo)&&$productInfo.enp_name}><{$productInfo.enp_name}><{/if}>" />
                            <strong>*</strong>
                        </td>
                    </tr>
                <{/if}>

                <tr>
                    <td class="form_title nowrap text_right">申报单位企业代码：</td>
                    <td class="form_input"><span class="blue"><{$customer.code}></span><input name="storage_customer_code" id="title" class="fix-medium1-input text-input" type="hidden" size="45"  placeholder="申报单位企业代码" value="<{$customer.code}>" />
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">申报单位企业名称：</td>
                    <td class="form_input"><span class="blue"><{$customer.company}></span><input name="storage_enp_name" id="storage_enp_name" class="fix-medium1-input text-input" type="hidden" size="45"  placeholder="申报单位企业名称" value="<{$customer.company}>" />
                    </td>
                </tr>

                <tr>
                        <td class="form_title nowrap text_right"><{t}>pname<{/t}>：</td>
                        <td class="form_input"><input name="title" id="title" class="fix-medium1-input text-input" type="text" size="45"  placeholder="<{t}>Please_enter_the_product_name_in_Chinese<{/t}>" value="<{if isset($productInfo)&&$productInfo.product_title}><{$productInfo.product_title}><{/if}>" />
                                <strong>*</strong>  <a href="#"  class="tip" title="(<{t}>product_name_tip<{/t}>)" onclick="return false;"><img src="/images/help.png"></a><!--<span class="input-notification error png_bg">Error message</span>!-->                                </td>
                </tr>

                <tr>
                        <td class="form_title nowrap text_right">商品货号：</td>
                        <td class="form_input"><input type="text" name="product_sku" id="product_sku"  placeholder="请输入商品SKU" value='<{if isset($productInfo)&&$productInfo.product_sku}><{$productInfo.product_sku}><{/if}>' maxlength="50" class="text-input fix-medium1-input" size="45"  />
                                <strong>*</strong> <span id="productSkuTip" class="red">
                                </span>&nbsp;&nbsp;<a href="#"  class="tip" title="(请输入商品SKU，不能超50位)" onclick="return false;"><img src="/images/help.png"/></a></td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">商品分类：</td>
                    <td class="form_input">
                        <select name="goods_categories" class="fix-medium2-input">
                        <{foreach from=$ciqGoodsCategories item=item key=k }>
                            <option value="<{$k}>" <{if isset($productInfo)&&$productInfo.goods_categories==$k}>selected="selected"<{/if}>><{$item}></option>
                        <{/foreach}>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>

                <tr>
                        <td class="form_title nowrap text_right">海关商品编码：</td>
                        <td class="form_input"><input type="text" name="hs_code" id="hscode"  placeholder="<{t}>Please_select_the_customs_code<{/t}>" value='<{if isset($productInfo)&&$productInfo.hs_code}><{$productInfo.hs_code}><{/if}>' minlength="10" maxlength="10" class="text-input fix-medium1-input" size="45"  />
                                <strong>*</strong> <span id="hscodeName" class="red">
                                </span>&nbsp;&nbsp;<a href="#"  class="tip" title="(<{t}>Please_enter_the_product_known_customs_code<{/t}>)" onclick="return false;"><img src="/images/help.png"/></a></td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">规格型号：</td>
                    <td class="form_input"><input type="text" name="product_model" id="product_model"  placeholder="" value='<{if isset($productInfo)&&$productInfo.product_model}><{$productInfo.product_model}><{/if}>' class="text-input fix-medium1-input" size="45"   />
                        <strong>*</strong> <span id="hscodeName" class="red">
										</span>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">主要成分：</td>
                    <td class="form_input"><input type="text" name="element" id="element" placeholder="" value='<{if isset($productInfo)&&$productInfo.element}><{$productInfo.element}><{/if}>' class="text-input fix-medium1-input" size="45"   />
                        <strong>*</strong>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">用途：</td>
                    <td class="form_input">
                        <!--
                        <input type="text" name="use_way" id="use_way" placeholder="" value='<{if isset($productInfo)&&$productInfo.use_way}><{$productInfo.use_way}><{/if}>' class="text-input fix-medium1-input" size="45"   />
                        -->
                        <select name="use_way" id="use_way" class="fix-medium2-input">
                        <{foreach from=$sjUseWay item=item key=k }>
                            <option value="<{$item.x_code}>" <{if isset($productInfo)&&$productInfo.use_way==$item['x_code']}>selected="selected"<{/if}>><{$item.x_name}></option>
                        <{/foreach}>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>
                <!--<tr>
                    <td class="form_title nowrap text_right">计量单位：</td>
                    <td class="form_input">

                        <select name="pu_code" class="fix-medium2-input" >
                            <{if $uom neq ""}>
                                <{foreach from=$uom item=item}>
                                    <option value="<{$item['code']}>" <{if isset($productInfo)&&($productInfo.pu_code ==$item['code']) }>selected<{elseif $item.name eq "个"}>selected<{/if}>><{$item["name"]}>
                                    </option>
                                <{/foreach}>


                            <{/if}>
                        </select>
                        <strong>*</strong>  <a href="#"  class="tip" title="(<{t}>legal_measurement_tip<{/t}>)" onclick="return false;"><img src="/images/help.png"></a>										</td>
                </tr>-->
                <tr>
                    <td class="form_title nowrap text_right">申报单位/最小销售单位：</td>
                    <td class="form_input">
                        <select name="pu_code" class="fix-medium2-input" >
                        <{foreach from=$uom item=item}>
                            <option value="<{$item['code']}>" <{if isset($productInfo)&&($productInfo.pu_code ==$item['code']) }>selected="selected"<{elseif $item.name eq "个"}>selected="selected"<{/if}>><{$item["name"]}>
                            </option>
                        <{/foreach}>
                        </select>
                        <strong>*</strong>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">法定单位：</td>
                    <td class="form_input">

                        <select name="law_code" class="fix-medium2-input" >
                            <!--<option value=""><{t}>pleaseSelected<{/t}>...</option>-->
                            <{if $uom neq ""}>
                                <{foreach from=$uom item=item}>
                                    <option value="<{$item['code']}>" <{if isset($productInfo)&&($productInfo.pu_code ==$item['code']) }>selected<{elseif $item.name eq "个"}>selected<{/if}>><{$item["name"]}>
                                    </option>
                                <{/foreach}>


                            <{/if}>
                        </select>
                        <strong>*</strong>  <a href="#"  class="tip" title="(<{t}>legal_measurement_tip<{/t}>)" onclick="return false;"><img src="/images/help.png"></a>										</td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">第二单位：</td>
                    <td class="form_input">

                        <select name="second_code" class="fix-medium2-input" >
                            <option value=""><{t}>pleaseSelected<{/t}>...</option>
                            <{if $uom neq ""}>
                                <{foreach from=$uom item=item}>
                                    <{if isset($productInfo.second_code) && $productInfo.second_code != ''}>
                                        <{if $productInfo.second_code == $item['code']}>
                                            <option value="<{$item['code']}>" selected><{$item["name"]}></option>
                                        <{/if}>
                                    <{else}>
                                        <option value="<{$item["code"]}>"><{$item["name"]}></option>
                                    <{/if}>
                                <{/foreach}>
                            <{/if}>
                        </select>
                          <a href="#"  class="tip" title="(<{t}>legal_measurement_tip_second<{/t}>)" onclick="return false;"><img src="/images/help.png"></a>										</td>
                </tr>

                        <tr>
                                <td class="form_title nowrap text_right"><{t}>declaredValue<{/t}>：</td>
                                <td class="form_input">                                     
                                   
                                        <input type="text" name="declared_value" id="declared_value" size="10" class="fix-medium1-input text-input" placeholder="0.00" value="<{if isset($productInfo)&&$productInfo.product_declared_value}><{$productInfo.product_declared_value}><{/if}>" />
                                        <strong>*</strong> <!--(<span id="currency"><{$customer.customer_currency}></span>)-->
										<a href="#"  class="tip" title="(<{t}>Declared_Value_tip<{/t}>)" onclick="return false;"><img src="/images/help.png"/></a>										 </td>
                        </tr>

                <tr>
                    <td class="form_title nowrap text_right">品牌：</td>
                    <td class="form_input">

                        <input type="text" name="brand" id="brand" size="10" class="fix-medium1-input text-input" placeholder="" value="<{if isset($productInfo)&&$productInfo.brand}><{$productInfo.brand}><{/if}>" />
                        <strong>*</strong>
                        <a href="#"  class="tip" title="(请填写品牌)" onclick="return false;"><img src="/images/help.png"/></a>										 </td>
                </tr>

                        <tr id="country_code_of_origin_tr">
                            <td class="form_title nowrap text_right"><{t}>country_code_of_origin<{/t}>：</td>
                            <td class="form_input">
                                <select name="country_code_of_origin" class="fix-medium2-input" >
                                    <option value=""><{t}>pleaseSelected<{/t}>...</option>
                                    <{if $countryArr neq ""}>
                                        <{section name=n loop=$countryArr}>
                                            <{if $countryArr[n].trade_country!=''}>
                                                <option value="<{$countryArr[n].country_code}>" <{if isset($productInfo)&&($productInfo.country_code_of_origin ==$countryArr[n].country_code) }>selected<{/if}>><{$countryArr[n].country_code}>&nbsp;<{$countryArr[n].country_name}>
                                            <{/if}>
                                            </option>
                                        <{/section}>
                                    <{/if}>
                                </select>
                                <strong>*</strong></td>
                        </tr>

                <tr>
                    <td class="form_title">申报币制：</td>
                    <td class="form_input">
                        <select name="currency_code" class="fix-medium2-input" id="currency_code">
                                 <{if isset($currency)}>
                                    <{foreach from=$currency item=row}>
                                        <{if isset($productInfo.currency_code) && $productInfo.currency_code eq $row.currency_code}>
                                            <option value="<{$row.currency_code}>" selected><{$row.currency_code}></option>
                                        <{else}>
                                            <option value="<{$row.currency_code}>"><{$row.currency_code}></option>
                                        <{/if}>
                                    <{/foreach}>
                                 <{/if}>

                                </select>
                    </td>
                </tr>
				<tr>
                    <td class="form_title">海关品名：</td>
                    <td class="form_input">
                        <input type="text" name="hs_name" id="hs_name" value='<{if isset($productInfo)&&$productInfo.hs_name}><{$productInfo.hs_name}><{/if}>' class="required text-input fix-medium1-input" size='45'/>
                    </td>
                </tr>
				<!--
                <tr id="gt_code_tr">
                    <td class="form_title nowrap text_right">行邮税号：</td>
                    <td class="form_input">
                        <select name="gt_code" class="fix-medium2-input" >
                            <option value=''>--请选择--</option>
                            <{foreach from=$taxList item=tax}>
                                <option value='<{$tax.gt_code}>' tax='<{$tax.gt_rate}>'<{if isset($productInfo)&&$productInfo.gt_code==$tax.gt_code}>selected<{/if}>><{$tax.gt_code}><{if $tax.gt_name}><{$tax.gt_name}><{/if}></option>
                            <{/foreach}>
                        </select>
                        <strong>*</strong> <span id="gt_codeName" class="red">
										</span>
                    </td>
                </tr>
				-->

                        <tr>
                                <td class="form_title nowrap text_right">毛重：</td>
                                <td class="form_input"><input type="text" name="product_weight" id="product_weight" value='<{if isset($productInfo)&&$productInfo.product_weight}><{$productInfo.product_weight}><{/if}>' class="required text-input fix-medium1-input" size='45'  placeholder="0.000"/>
                                        <span style='text-align:left;'><strong>*</strong> KG</span>  
										<a href="#"  class="tip" title="(<{t}>weight_tip<{/t}>)" onclick="return false;"><img src="/images/help.png"/></a>								</td>
                        </tr>

                <tr>
                    <td class="form_title nowrap text_right">净重：</td>
                    <td class="form_input"><input type="text" name="product_net_weight" id="product_net_weight" value='<{if isset($productInfo)&&$productInfo.product_weight}><{$productInfo.product_net_weight}><{/if}>' class="required text-input fix-medium1-input" size='45'  placeholder="0.000"/>
                        <span style='text-align:left;'><strong>*</strong> KG</span>
                        <a href="#"  class="tip" title="(<{t}>weight_tip<{/t}>)" onclick="return false;"><img src="/images/help.png"/></a>								</td>
                
                    
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">生产企业：</td>
                    <td class="form_input"><input type="text" name="enterprises_name" id="enterprises_name" placeholder="" value='<{if isset($productInfo)&&$productInfo.enterprises_name}><{$productInfo.enterprises_name}><{/if}>' class="text-input fix-medium1-input" size="45"   />
                        <strong>*</strong>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">供应商：</td>
                    <td class="form_input"><input type="text" name="supplier" id="supplier" placeholder="" value='<{if isset($productInfo)&&$productInfo.supplier}><{$productInfo.supplier}><{/if}>' class="text-input fix-medium1-input" size="45"   />
                        <strong>*</strong>
                    </td>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">赠品：</td>
                    <td class="form_input">
                        <select id="gift_flag" class="fix-medium2-input" name="gift_flag">
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </td>
                </tr>
                <tr id="barcodebox">
                    <td class="form_title">商品条码:</td>
                    <td class="form_input">
                        <input name="barcode" id="barcode" placeholder="请输入条码" type="text"   size="18" class="fix-medium1-input text-input "  value="<{if isset($productInfo)&&$productInfo.product_barcode}><{$productInfo.product_barcode}><{/if}>" />&nbsp;<strong style=" visibility:hidden;">*</strong>&nbsp;<{*<a href="#"  class="tip" title="请仅限能输入字母、数字和横杠,最大长度为18位" onclick="return false;"><img src="/images/help.png"></a>*}>							</td>
                    <input type="hidden" size="45" value="<{$productInfo.product_id}>"  name="product_id">
                </tr>
                <tr>
                    <td class="form_title nowrap text_right"><{t}>remark<{/t}>：</td>
                    <td class="form_input"><input type="text" name="product_description" id="product_description" size="10" class="fix-medium1-input text-input" value="<{if isset($productInfo)&&$productInfo.product_description}><{$productInfo.product_description}><{/if}>" /></td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right"><{t}>是否符合法律法规申明<{/t}>：</td>
                    <td class="form_input">
                        <select id="is_law_regulation" class="fix-medium2-input" name="is_law_regulation">
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </td>            
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">附件信息：</td>
                    <td class="form_input">
                        <div style="width: 120px;float:left;">
                            <div id="queue"></div>
                            <input id="file_upload" name="file_upload" type="file" multiple="true"  >
                            <input id="sessionid" value="<{$sessionid}>" type="hidden">
                        </div>
                    </td>
                </tr>

                        <tr>
                                <td class="form_title">&nbsp;</td>
                                <td class="form_input">								
								<div  id='pic_wrapper' > 								
								<{if isset($productInfo)&&$productInfo['attach']}>
                                   <{foreach from=$productInfo.attach item=att name=att key=i}>
                                       <div class="imgWrap" style="position:relative;height:140px;">
										<input type='hidden' name='image[<{$i}>][]' value='<{$att.pa_path}>'>
										<img src="data:image/jpeg;base64,<{$att.pa_content}>" style="width: 140px; height: 110px;"/>
                                        <input type="text" style="width:100%;" name="imageSelect[<{$i}>][]" value="<{$att.pa_name}>" placeholder="请输入名称" />
                                        <img class="deleteImage" src="/images/icons/icon_square_close.png" style="cursor:pointer;position:absolute;top: 9px;right: 9px;width:14px;height:14px;">
									   </div>	
                                   <{/foreach}>
                                <{/if}> </div>
                                </td>
                        </tr>
						
                		<tr>
                        		<td class="form_title"></td>
                        		<td class="form_input"><a href="void(0)" class="button tijiao" onclick="dosubmit();return false;"><{t}>submit<{/t}></a> </td>
						</tr> 
				</tbody>
        </table>
        </fieldset>
        <div class="clear"></div>
        <!-- End .clear -->
        <div class="infoTips" id="commonProductTip" title="<{t}>InformationTips<{/t}>"> </div>
</form>

<style type="text/css">
#distributor-pagination {
  display: block;
  padding: 5px 0;
  clear: both;
}

#distributor-pagination span {
  padding: 5px 8px;
  border: 1px solid #cccccc;
  margin-right: 5px;
  cursor: pointer;
}

#distributor-pagination span.current {
  color: #cccccc;
  cursor: text;
}
</style>


<script>
            $('.deleteImage').click(function() {
                $(this).closest('.imgWrap').remove();
            });
			$(document).ready(function(){
						$('#dialog').dialog({
						autoOpen: false,
						modal: true,
						bgiframe:true,
						position:[50,50],
						width: 700,	
						height:500,
						draggable: true,	
						resizable: true	
						});
							
						//产品浏览
						$('#dialog_link').click(function(){					
								$('#dialog').dialog('open');									
								return false;
						});      
			
						
			
					$('#commonProductTip').dialog({
						autoOpen: false,
						modal: false,
						position:[50,50],
						bgiframe:true,
						width: 400,		
						resizable: true			
					});
			});



        var global_hs_code = "";
				
   		$(".productactionSku").live("click", function(){

			var hs_code = $(this).attr("hs_code");
            global_hs_code = hs_code;
            $("input[name='hs_code']").val(hs_code);
            $(".productactionSku").attr('checked',false);
            $(".productactionSku").each(function(){
                if($(this).attr("hs_code")==hs_code){
                    $(this).attr("checked",true);
                }
            });
			$('#dialog').dialog('close');
			$('#hs_code').trigger('blur');
            
        });
			

jQuery(document).ready(function ($) {
  
  $('.imageDiv').live("click", function() {
		$('.imageDiv').css("background-color","#FFF");
		$(this).css("background-color","#EEE");
		$("#currentSelectImage").val($(this).attr("id"));
  })

});



function addImages(){
	var count = $('.image_td').length+4;
	if(count>=9)return false;
	var html = '<td class="image_td"><input type="hidden" id="image'+count+'_input" name="additionImage[]" /><div style="width:80px;height:80px;border:1px solid #000;"><div class="imageDiv" id="image'+count+'" style="width:80px;height:60px;cursor:pointer;"></div><div style="width:80px;height:19px;text-align:center;background-color:#F90;">标签</div></div></td>';
	$(".image_td").last().after(html);
}
function delImages(){
	var count = $('.image_td').length;
	if(count<=1)return false;
	$(".image_td").last().remove();
}
$(function(){
        $("[name=gt_code]").change(function(){
            var taxRate=$(this).find('option:selected').attr('tax');
            if(typeof(taxRate)!='undefined'&&taxRate!=''){
                $("#gt_codeName").html('行邮税率：'+taxRate);
            }else{
                 $("#gt_codeName").html('');
            }
        });
        $('#ie_type').change(function(){
            if($(this).val()=='I'){
                $('#currency_code').html('<option value="CNY" selected>CNY</option>');
                $('#gt_code_tr').show();
                $('#country_code_of_origin_tr').show();
                $('#currency_code').trigger('update');
            }else{
                $('#currency_code').html('<option value="USD" selected>USD</option>');
                $('#gt_code_tr').hide();
                $('#country_code_of_origin_tr').hide();
                $('#currency_code').trigger('update');
            }
        }).change();
})
</script>

<div id="dialog"   title="<{t}>SelectHScode<{/t}>"> </div>