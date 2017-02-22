<style type="text/css">
    .box td{
        text-align: left;
    }
    #ASNForm tbody th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;

    }
    #ASNForm tbody td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
   *#ASNForm tbody span.error{
        top:auto;
    }
    span.error{
        top:auto;
    }
    a.dialog_link {
        margin-bottom: 5px;
        margin-top: 5px;
        padding: 10px;
        text-align: center;
       
        float:left;
        margin-right: 5px;
    }
   
    .asndetailstrong {
        color: #FF0000;
        display: block;
        float: left;
        margin-right: 20px;
        margin-top: 15px;
    }
</style>
<style>
  #subProducts .textInput{
      float:none;;
  }
</style>


 <div class="content-box-header">
        <h3 style="margin-left:5px"><{$actions}>-<{t}>CollectingMode<{/t}></h3>
        <div class="clear"></div>
    </div>		


    <div class="asndetail">
 	 <table  style="width:200px;border:none;">
			<tr>
			<td><a href="#" id="dialog_link" title="<{t}>ProductInfo<{/t}>" class="nowarp dialog_link ui-state-default  ui-corner-all" ><{t}>SelectOrder<{/t}></a></td>
			<td><span style="font-size:1.1em;color:red">*</span></td>			
			<td><a href="#" id="selectasndetail" class="nowarp dialog_link ui-state-default  ui-corner-all" ><{t}>BulkUploadOrders<{/t}></a></td>
			</tr>
	 </table>
	 
    </div>

		<form   action="/merchant/receiving/create" method="post"  id='ASNForm' name="createForm" >
			<div id="create-asn-center" >
				
					<table cellspacing="0" cellpadding="0"  class="asnordersbox formtable tableborder">
						<thead>
							<tr>
								<th width='100'><{t}>CustomerReference<{/t}><input type="hidden" name="ASNCode" value="<{$receiving_code}>"  /></th>
								<th width='200'><{t}>shippingMethod<{/t}></th>
								<th width='180'><{t}>consignee<{/t}><{t}>state<{/t}></th>
								<th width='120'><{t}>createDate<{/t}></th>
								<th width='100'><{t}>operate<{/t}></th>
							</tr>
						</thead>
						<tbody id='asnorders'>
                        <{if $receivingDetail!=''}>
                        <{foreach from=$receivingDetail item="detail"}>
                        <tr  id="asnorder<{$detail.product_id}>" class="product_sku">
                            <td><a href="/merchant/order/detail/ordersCode/<{$detail.order_code}>" target="_blank" onclick="parent.openMenuTab('/merchant/order/detail?ordersCode=<{$detail['order_code']}>','<{t}>orderDetail<{/t}>(<{$detail['order_code']}>)','orderdetail<{$detail['order_code']}>');return false;"><{$detail.reference_no}></a>
							<input type="hidden" name="asn_order[<{$detail.order_id}>]" value="<{$detail.order_code}>"></td>
                            <td title="<{$detail.sm_code}>"><{$detail.sm_code}></td><td><{$detail.country_name}></td>
                            <td><{$detail.add_time}></td>
                            <td><a class="orderDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>
                        </tr>
                        <{/foreach}>
                        <{/if}>
            			<tr class="norowdata">
            				<td colspan="5" style="text-align:center;"><b><{t}>Do_not_select_order<{/t}></b></td>            		
            			</tr>							
						</tbody>
          		
            	
						
					</table>
				<div class="clear"></div>	
				<input type="hidden" name="ASNCode" value="<{$receiving_code}>" />
				<table class="pageFormContent">
					<tbody>
						<tr class="jiahuowarehouse">
							<td  style="text-align:right" class="nowrap text_right"><{t}>warehousing_logistics_enterprises<{/t}>：<input type="hidden" name="receive_model_type" value="1"></td>
							<td><select name="warehouseId" class="required width155" id="warehouseId">
									<option value="">-Select-</option> <{foreach from=$warehouseArr key=k item=wh }>
									<option value="<{$k}>" <{if isset($receiving)&&($receiving.warehouse_id==$wh.warehouse_id)}>selected<{/if}>><{$wh.warehouse_name}></option> <{/foreach}>
							</select> <strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"  class="tip" title="<{t}>Please_select_the_warehousing_logistics_enterprises<{/t}>" onclick="return false;"><img src="/images/help.png"></a></td>
						</tr>
                        <{if isset($receiving)&&($receiving.to_warehouse_id>0)}>
                        <tr class="aimwarehouses">
                            <td style="text-align:right"  class="nowrap text_right"><{t}>ObjectiveWarehouse<{/t}>：</td>
                            <td>
                                <select name='to_warehouse' class="width155">
                                    <option value=''>-Select-</option>
                                    <{foreach from=$warehousemdAll key=k item=mdc}>
                                    <option value="<{$mdc.warehouse_id}>" <{if isset($receiving)&&($receiving.to_warehouse_id==$mdc.warehouse_id)}>selected<{/if}>><{$mdc.warehouse_name}></option>
                                    <{/foreach}>
                                </select></td>
                        </tr>
                        <{/if}>
                        <tr class="ReferenceCode">
                            <td  class="nowarp text_right"><{t}>IE_Port<{/t}>：</td>
                            <td>
                                <select name="ie_ort" class="required width155" id="ie_ort">
                                    <option value="">前海湾港区</option>
                                    <option value="">天津港区</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="ReferenceCode">
                            <td  class="nowarp text_right"><{t}>country_of_origin<{/t}>：</td>
                            <td>
                                <select name="country_of_origin" class="required width155" id="country_of_origin">
                                    <option value="">-Select-</option>
                                    <{foreach from=$country item=item}>
                                        <option value="<{$item.country_name}>" <{if $item.country_id==49}> selected<{/if}>><{$item.country_name}> <{$item.country_name_en}></option>
                                    <{/foreach}>
                                </select>
                            </td>
                        </tr>
                        <tr class="ReferenceCode">
                            <td  class="nowarp text_right"><{t}>destination_country<{/t}>：</td>
                            <td>
                                <select name="destination_country" class="required width155" id="destination_country">
                                    <option value="">-Select-</option>
                                    <{foreach from=$country item=item}>
                                        <option value="<{$item.country_name}>" <{if $item.country_id==49}> selected<{/if}>><{$item.country_name}> <{$item.country_name_en}></option>
                                    <{/foreach}>
                                </select>
                            </td>
                        </tr>
						<tr class="ReferenceCode">
							<td  style="text-align:right" class="nowrap text_right"><{t}>CustomerReference2<{/t}>：</td>
							<td><input type="text" size="60" class="text-input width140" value="<{if isset($receiving)&&$receiving.reference_no}><{$receiving.reference_no}><{/if}>" name="ref_code" id="ref_code"> <strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"  class="tip" title="<{t}>asn_reference_tip<{/t}>" onclick="return false;"><img src="/images/help.png"></a></td>
						</tr>
                        <tr class="ReferenceCode">
                            <td   class="nowarp text_right">提单号：</td>
                            <td><input type="text" size="60" class="text-input width155 " value="<{if isset($receiving)&&$receiving.trake_code}><{$receiving.trake_code}><{/if}>" name="trake_code" id="trake_code"></td>
                        </tr>
                        <tr class="ReferenceCode">
                            <td   class="nowarp text_right">报关单号：</td>
                            <td><input type="text" size="60" class="text-input width155 " value="" name="declaration_number" id="declaration_number"></td>
                        </tr>
                        <tr class="ReferenceCode">
                            <td   class="nowarp text_right">车牌号：</td>
                            <td><input type="text" size="60" class="text-input width155 " value="" name="plate_numbe" id="plate_numbe"></td>
                        </tr>
                        <tr>
                          <td class="nowrap text_right">总件数：</td>
                          <td>
                            <input type="text" class="text-input width140" name="pack_no" id="pack_no" value="<{if isset($receiving) && $receiving.pack_no}><{$receiving.pack_no}><{/if}>" />&nbsp;<strong class="red">*</strong>
                            &nbsp;&nbsp;&nbsp;<a href="#" class="tip" title="请填写ASN总件数" onclick="return false;"><img src="/images/help.png" /></a>
                          </td>
                        </tr>


                        <!--<tr>
                            <td class='nowrap text_right'><{t}>ImportexportPorts<{/t}>:</td>
                            <td>
                                <select name="ie_port" class="required width155">
                                    <{foreach from=$iePorts item=ieport}>
                                      <option value="<{$ieport.ie_port}>" <{if isset($receiving)&&($receiving.ie_port==$ieport.ie_port)}>selected<{/if}>><{$ieport.ie_port_name}></option>
                                    <{/foreach}>
                                </select>
                            </td>
                        </tr>-->

                        <!--<tr>
                            <th><{t}>BusinessType<{/t}>:</th>
                            <td>
                                <select name="form_type" class="required width155">
                                    <{foreach from=$formtypes item=formtype}>
                                    <option value="<{$formtype.form_type}>" <{if isset($receiving)&&($receiving.form_type==$formtype.form_type)}>selected<{/if}> ><{$formtype.form_type_name}></option>
                                    <{/foreach}>
                                </select>
                            </td>
                        </tr>-->
                        <!--<tr id="avinumber">
                            <td style="text-align:right"><{t}>AviationSingleNumber<{/t}>：</td>
                            <td>
                                <input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.traf_name}><{$receiving.traf_name}><{/if}>" name="traf_name" >
                                &nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(请填入ASN出运后对应的航空提单)						    </td>
                        </tr>-->
                        <tr>
                            <td class="nowrap text_right"><{t}>PackingType<{/t}>:</td>
                            <td>
                                <select name='wrap_type' class="required width155">
                                    <option value=""><{t}>pleaseSelected<{/t}>...</option>
                                     <{foreach from=$wrapTypes item=wrapType}>
                                    <option value="<{$wrapType.wrap_type}>" <{if isset($receiving)&&($receiving.wrap_type==$wrapType.wrap_type)}>selected<{/if}>><{$wrapType.wrap_type_name}></option>
                                     <{/foreach}>
                                </select><strong class="red">*</strong>
                            </td>
                        </tr>
                        <!--<tr>
                            <th><{t}>TotalNumber<{/t}>:</th>
                            <td><input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.pack_no}><{$receiving.pack_no}><{/if}>" name="pack_no" ><strong class="red">*</strong></td>
                        </tr>-->
                        <!--<tr>
                            <th><{t}>AccessPortTransport<{/t}>:</th>
                            <td>
                                <select name='traf_mode' class="required width155">
                                    <{foreach from=$trafModes item=trafMode}>
                                    <option value="<{$trafMode.traf_mode}>" <{if isset($receiving)&&($receiving.traf_mode==$trafMode.traf_mode)}>selected<{/if}>><{$trafMode.traf_mode_name}></option>
                                    <{/foreach}>
                                </select>
                        </tr>-->
                        <!--<tr>
                            <th><{t}>RegulatoryApproach<{/t}>:</th>
                            <td>
                                <select name="trade_mode" class="required width155">
                                    <{foreach from=$tradeModes item=tradeMode}>
                                    <option value="<{$tradeMode.trade_mode}>" <{if isset($receiving)&&($receiving.trade_mode==$tradeMode.trade_mode)}>selected<{/if}>><{$tradeMode.trade_mode_name}></option>
                                    <{/foreach}>
                                </select>
                            </td>
                        </tr>-->
                        <!--<tr>
                            <th><{t}>TransactionMethod<{/t}>:</th>
                            <td>
                                <select name="trans_mode" class="required width155">
                                    <{foreach from=$transModes item=transMode}>
                                    <option value="<{$transMode.trans_mode}>" <{if isset($receiving)&&($receiving.trans_mode==$transMode.trans_mode)}>selected<{/if}>><{$transMode.trans_mode_name}></option>
                                    <{/foreach}>
                                </select>
                            </td>
                        </tr>-->
                        <tr>
                            <td style="text-align:right"  class="nowrap text_right"><{t}>roughweight<{/t}>：</td>
                            <td><input type="text" placeholder="0.00" class="text-input width140" name='roughweight' value='<{if isset($receiving)&&$receiving.roughweight}><{$receiving.roughweight}><{/if}>'> 
                            KG <strong class="red">*</strong>&nbsp;<p style="display:inline;zoom:1;width:2px"></p><a href="#"  class="tip" title="<{t}>please_enter_asn_total_weight<{/t}>" onclick="return false;"><img src="/images/help.png"></a></td>
                        </tr>
                        <tr>
                            <td style="text-align:right"  class="nowrap text_right"><{t}>volume<{/t}>：</td>
                            <td><input type="text" placeholder="0.00" class="text-input width140" name='volumnweight' value='<{if isset($receiving)&&$receiving.volumnweight}><{$receiving.volumnweight}><{/if}>'> 
                            CBM<p style="display:inline;zoom:1;width:1px;">&nbsp;</p>
                            <a href="#"  class="tip" title="<{t}>please_enter_asn_total_volumn<{/t}>" onclick="return false;"><img src="/images/help.png"></a></td>
                        </tr>
                        <!--<tr>
                            <th><{t}>HaveContainers<{/t}>:</th>
                            <td><input type="radio" value="1" name="haveconta"><{t}>Yes<{/t}><input type="radio" value="0" name="haveconta"><{t}>No<{/t}></td>
                        </tr>
                        <tr class="haveconta">
                            <th><{t}>ContainerNumber<{/t}>:</th>
                            <td>
                                <input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.conta_id}><{$receiving.conta_id}><{/if}>" name="conta_id">
                            </td>
                        </tr>
                        <tr class="haveconta">
                            <th><{t}>ContainerSpecificationNo<{/t}>:</th>
                            <td>
                                <input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.conta_model}><{$receiving.conta_model}><{/if}>" name="conta_model">
                            </td>
                        </tr>
                        <tr class="haveconta">
                            <th><{t}>ContainerWeight<{/t}>:</th>
                            <td>
                                <input type="text" size="60" class="text-input width140 " value="<{if isset($receiving)&&$receiving.conta_wt}><{$receiving.conta_wt}><{/if}>" name="conta_wt">
                            </td>
                        </tr>-->

                        <tr>
                            <td style="text-align:right"><{t}>remark<{/t}>：</td>
                            <td><textarea rows="5" cols="80" id="instructions" name="instructions"><{if isset($receiving)&&$receiving.receiving_description}><{$receiving.receiving_description}><{/if}></textarea></td>
                        </tr>

                        <tr>
                            <td style="text-align:right">&nbsp;</td>
                            <td><a  href="#" class="button tijiao" id='asnbutton'  onclick="dosubmit();return false;"><{t}>submit<{/t}></a>
						</td>
                        </tr>			
						 
					</tbody>
				</table>
			
			</div>

		</form>

<div id="dialog" title="<{t}>PleaseSelectOrder<{/t}>">
</div>
<div class="infoTips" id="messageTip" title="<{t}>InformationTips<{/t}>">
			
</div>
 <div id="asndetailDialog" title="<{t}>import_by_xls<{/t}>" style="display:none">
     <form action="/merchant/order/bulkorder" method="post" id="asndetailForm">
         <table>
             <tr><th><{t}>export_xls<{/t}>:</th>
                 <td><input type="file" name="XMLForInput" />
                 </td></tr>
             <tr>
                 <th><input name="warehouse_select" id="warehouse_select" value='' type="hidden"><input name="to_warehouse_select" id="to_warehouse_select" value="" type="hidden"></th>
                 <td>
                     <p><img style="width:25px;" src="/images/download.png"><{t}>download_templete<{/t}>:<a href="/merchant/order/order-select-templete" style="text-decoration:underline;"><{t}>order_templete<{/t}></a></p>
                     
                 </td>
             </tr>
         </table>

         <table cellspacing="0" cellpadding="0" class="formtable tableborder">
             <{*<thead>
             <tr>
                 <th width='200'><{t}>CustomerReference<{/t}></th>
                 <th width='70'><{t}>operate<{/t}><{t}>result<{/t}></th>
             </tr>
             <!--
             <tr>
                 <td colspan="10"   style="text-align:center"><strong  style="color:red">请选择产品</strong></td>
             </tr>
             -->
             </thead>*}>
             <tbody id='batchAddTips'>

             </tbody>
         </table>
     </form>
 </div>
<div id="selectModelDialog" title="<{t}>please_select_asn_model<{/t}>" style="display: none;">
<input type="button" value='<{t}>CollectingMode<{/t}>' class="ui-state-default button selectmodelbtn">
<input type="button" value='<{t}>DeliveryMode<{/t}>' class="ui-state-default button selectmodelbtn">
</div>

<script type="text/javascript">
var actionLabel='<{$actionLabel}>';

    $(function () {
        var exd=$("[name='expected_date']");
        exd.datepicker({ dateFormat: "yy-mm-dd" });
        exd.datepicker({ constrainInput: true });

        $('#asnbutton').die('click').live('click',function(){
            //$('#asnbutton').show();
           // $('#ASNForm').submit();
        });
        //selectModelDialog
        $('#normalasn').show();
        $('#returnasn').hide();
        $('.create-asn-head').show();

        $("[name='shippingMethod']").click(function () {
            if ($(this).val() == 0) {
                $(".trackingNumber").hide();
            } else {
                $(".trackingNumber").show();
            }
        });
        $("[name='ref_code']").blur(function () {
            checkRefCode();
        });

        var asnCode = $("[name='ASNCode']", "#ASNForm").val();
        if (asnCode != '') {
            receivingProduct(asnCode);
        }
        $('#warehouseId').change(function(){
            selectwarehouse();
            getAimWarehouse();
        });
        $('#selectasndetail').click(function(){
            //$('#dialog').html();
            $("#batchAddTips").html('');
            $('#asndetailDialog').dialog('open');
            /* $('#startUploadXLS').click(function(){
             });*/
            return false;
        });
    });

    function checkRefCode() {
        var obj=$("#ref_code");
        var refCode = obj.val();
        if (refCode == '')return true;
        $.ajax({
            type:"POST",
            async:false,
            dataType:"json",
            url:"/merchant/receiving/check-refcode",
            data: {
                'refCode':refCode
            },
            success:function (json) {
                //alertTip('Reference No. existed.');
                if (json.ask == '1') {
                    obj.removeClass('errorbox');
                    obj.parent().find('span').html('<img alt="允许" src="/images/icons/icon_approve.png">');
                    return true;
                } else {
                    //alertTip('POCode existed!');
                    obj.addClass('errorbox');
                    obj.parent().find('span').html('<img alt="错误" src="/images/icons/icon_missing.png"><{t}>CustomerReferenceNumberExistence<{/t}>');
                    return false;
                }
            }
        });
    }



    function chval() {
        var errmsg = "";
        var pattern = /^\d+$/;
        $("input[name^='sku[']","#ASNForm").each(function (k, v) {
            var this_val = $(this).val();
            if (this_val == '' || this_val == '0' || !pattern.test(this_val)) {
                errmsg += '<span style="width:100%;float:left;"><img src=\"/images/no.gif\">Line ' + (k + 1) + ' ,Receive Qty Must be numeric.</span>';
            }
        });

        if (errmsg != '') {
            alertTip(errmsg);
            return false;
        }
        return true;
    }
    function receivingProduct(ASNCode) {
        $.ajax({
            type:"POST",
            async:false,
            dataType:"json",
            url:"/merchant/receiving/receiving-product",
            data:{
                'ASNCode':ASNCode
            },
            success:function (json) {
                var html = '';
                if (json.ask != 1) {
                    html ="<td colspan='5' class=\"center\">&nbsp;No Data !</td>";
                } else {
                    $.each(json.result.products, function (k, item) {
                        html += '<tr id="product' + item.product_id + '" class="product_sku">';
                        html += '<td>' + item.product_sku + '<input type="hidden" name="product_sku[' + item.product_id + ']" value="' + item.product_sku + '"></td>';
                        html += '<td>' + item.product_title + '</td>';
                        html += '<td><input type="text" name="sku[' + item.product_id + ']" value="'+item.rd_receiving_qty+'" size="6"><span class="red">*</span></td>';
                        html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                        html += '</tr>';
                    });
                    $("[name='warehouseId']").val(json.result.warehouse_id);
                    if (json.result.tracking_number != '') {
                        $("[name='shippingMethod']").each(function () {
                            if ($(this).val() == 1) {
                                $(this).attr("checked", 'checked');
                            } else {
                                $(this).attr("checked", false);
                            }
                        });
                        $(".trackingNumber").show();
                        $("[name='tracking_number']").val(json.result.tracking_number);
                    } else {
                        $(".trackingNumber").hide();
                    }
                    //$(".ReferenceCode").hide();
                    $('[name=expected_date]').val(json.result.expected_date);
                    $('[name=instructions]').val(json.result.receiving_description);
                }
                $("#products").append(html);
            }
        });
    }


    $(function () {
        //选择订单
        $(".actionOrder").live("click", function () {
           	 var orderid = $(this).attr("orderId");
             var ordercode = $(this).attr("orderCode");
             var shipType = $(this).attr("shipType");
             var countryName = $(this).attr("countryName");
             var createDate = $(this).attr("createDate");
			 var reference_no = $(this).attr("reference_no");
             var state = $(this).attr("state");
			 // html += '<td><a href="/merchant/order/detail/ordersCode/'+ordercode+'" target="_blank">' + reference_no + '</a><input type="hidden" name="asn_order[' + orderid + ']" value="' + ordercode + '"></td>';
        	if ($(this).is(':checked')){
    			if($("#asnorder"+orderid).size()==0){
    				if ($("#asnorder" + orderid).size() == 0) {
    	                var html = '';
    	                html += '<tr id="asnorder' + orderid + '" class="product_sku">';
    	                html += '<td><a href="/merchant/order/detail/ordersCode/'+ordercode+'" onclick="parent.openMenuTab(\'/merchant/order/detail?ordersCode='+ordercode+'\',\'<{t}>orderDetail<{/t}>('+ordercode+')\',\'orderdetail'+ordercode+'\');return false;"  target="_blank">' + reference_no + '</a><input type="hidden" name="asn_order[' + orderid + ']" value="' + ordercode + '"></td>';
    	                html += '<td title="'+shipType+'">' + shipType + '</td>';
    	                html += '<td>'+state+'</td>';
                        html += '<td>'+createDate+'</td>';
    	                html += '<td><a class="orderDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
    	                html += '</tr>';
    	                $("#asnorders").append(html);
    	            }
    			}
        	}else{
    			if($("#asnorder"+orderid).size()>0){
    				$("#asnorder"+orderid).remove();
    			}
    		}			
			if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}	
        });

        $(".orderDel").live("click", function () {
            $(this).parent().parent().remove();
			//keepTheInterface();
			if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
			if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
        });
        <{if isset($receiving) && ($receiving.haveconta=='1') }>
            $('[name=haveconta][value=1]').attr('checked',true);
         <{else}>
            $('[name=haveconta][value=0]').attr('checked',true);
            $('.haveconta').hide();
            selectwarehouse();
            //getAimWarehouse();
        <{/if}>
        //有无集装箱
        $('[name=haveconta]').die('click').live('click',function(){
            $('.haveconta').hide();
            if($(this).val()=='1'){
                $('.haveconta').show();
            }
        });
    });

		// 选择订单的对话框			
		$('#dialog').dialog({
        		autoOpen: false,
				position: ['center','top'],
        		modal: false,
        		bgiframe:true,
        		width: 850,
				minHeight:100,
        		resizable: false
			});

            $('#asndetailDialog').dialog({
                autoOpen: false,
                modal: false,
				position:[50,50],
                bgiframe:true,
                width: 900,
                resizable: true,
                buttons: {
                    '确定': function() {
                        var pFile=$('[name=XMLForInput]').val();
                        var postfix = pFile.substr(pFile.length-3,3).toLowerCase();
                        if(pFile==""){
                            $("#batchAddTips").html("<{t}>FileCanNotBeEmptyPleaseSelectCorrectFile<{/t}>");
                        }else if(postfix!='xls' && postfix!='csv' ){
                            $("#batchAddTips").html("<{t}>OnlySupportXlsCsvDocument<{/t}>");
                            return false;
                        }else{
                             $('#warehouse_select').val($('#warehouseId').val());
                            if($('.aimwarehouses').size()>0){
                                $('#to_warehouse_select').val($('[name=to_warehouse]').val());
                            }else{
                                $('#to_warehouse_select').val('');
                            }
                            $('#asndetailForm').ajaxSubmit({
                                target:'#output1',
                                dataType:'json',
                                async: false,
                                beforeSend : function () {
                                  $('#batchAddTips').html('<img src="/images/loading.gif" />正在处理验证数据，请勿进行其他操作');
                                },
                                success:function(json){
                                    if(json.ask==1){
                                        /*$(json.data).each(function(k,row){
                                            // insertProductRow(row.product_id,row.product_sku,row.product_title,row.pc_name,row.product_weight,row.product_number);

                                        });*/
                                        insertOrderRow(json);
										if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
										if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
                                    }else{
                                        $("#batchAddTips").html(json.message);
                                    }
                                    $('input[name="XMLForInput"]').val(''); // AJAX请求成功，清除文本域数据
                                }
                            });
                            //$(this).dialog('close');
                        }
                    }  ,
                    '关闭': function() {
                        $(this).dialog('close');
                    }
                },
                close: function() {

                }
            });
			//产品浏览
			$('#dialog_link').click(function(){	
					//getProductListBoxData('asn');
                    getOrderList();
					$('#dialog').dialog('open');
					return false;
			});
        //开始时提示
        $('#selectModelDialog').dialog({
            autoOpen: false,
			position:[50,50],
            modal: false,
            bgiframe:true,
            width: 800,
            resizable: true
        });
        //$('#selectModelDialog').dialog('open');
    /*表单提交*/
	function dosubmit(){
				var options = {
				url:'/merchant/receiving/create', //提交给哪个执行
				type:'POST',
				dataType:'json',
				success: function(data){
					var html ="";						
					if(data.ask==1){
						/*html += data.msg+'</br></br>';
						if(actionLabel=='add'){
							html += '<a href="/merchant/receiving/create"><{t}>Add<{/t}>ASN</a><br/>';
							
							var ASNCode = data.ASNCode || '';
							if(ASNCode!=''){
								html += '<a href="/merchant/receiving/create/ASNCode/';
								html+=ASNCode;
								html+='">修改此ASN</a></br>';
							}
													
							html += '<a href="/merchant/receiving/listjh"><{t}>BackASNList<{/t}></a>';
						}

						if(actionLabel=='update'){
							html += '<a href="/merchant/receiving/create"><{t}>Add<{/t}>ASN</a><br/>';
							html += '<a href="/merchant/receiving/listjh"><{t}>BackASNList<{/t}></a>';
						}

						$("#messageTip").html(html);*/
						
						$('<div title="提示(Tip)">'+data.msg+'</div>').dialog({
							autoOpen: true,
                            close: function(event, ui) {locationToList();},
					        width: '320',
							position:[50,50],
					        height: 'auto',
					        modal: true,
					        buttons: {
					            '关闭(close)': function () {
					            	//window.location.href='/merchant/receiving/listjh';
									locationToList();
					            }
					        }
					    });
																
					}else{
						$("#messageTip").html('');
						if (typeof(data.msg) != "undefined")
						{
    						html+=data.msg+"<br/>";
						}
						 				
						$.each(data.error,function(idx,vitem){
						 html+=vitem+"<br/>";
						});
						$("#messageTip").html(html);

						$('#messageTip').dialog('open');
					}
					
				
				}}; //显示操作提示

				$("#ASNForm").ajaxSubmit(options); 
				
				return false;
    }  //end of function
    function locationToList(){
         //location.href="/merchant/receiving/listjh";
		  var url = "/merchant/receiving/listjh";
		  parent.openMenuTab(url,"集货ASN列表",'CollectionASNList','1');
     }
    //得到订单信息
    function getOrderList(){
        if(checkwarehouse()){
            var orderData = $("#pagerForm").serialize();
            orderData+="&warehouse_id=" + $('#warehouseId').val();
            if($('.aimwarehouses').size()>0){
                orderData += "&to_warehouse=" + $('[name=to_warehouse]').val();
            }
            $.ajax({
                type:'post',
                url:'/merchant/order/list-asn-order',
                data:orderData,
                dataType:'html',
                success:function(html){
                    $("#dialog").html(html);
                }
            });
            $('#dialog').dialog('open');
        }
    }
function checkwarehouse(){
    if($('#warehouseId').val()==''){
        alertTip('交货仓库必填才能选择订单');
        return false;
    }
    if($('.aimwarehouses').size()>0){
        if($('[name=to_warehouse]').val()==''){
            alertTip('目的仓库必填才能选择订单');
            return false;
        }
    }
    return true;
}
function selectwarehouse(){
<{if !isset($receiving)}>
    if($('#warehouseId').val()!=''){
        $('.tableborder').show()
        $('#dialog_link').show();
        $('.pageFormContent tr').show();
        $('.jiahuowarehouse').show();
        $('.asndetail').show();
    }else{
        $('.tableborder').hide()
        $('#dialog_link').hide();
        $('.pageFormContent tr').hide();
        $('.jiahuowarehouse').show();
        $('.asndetail').hide();
    }
<{/if}>
<{if isset($receiving) && ($receiving.haveconta=='1') }>
    $('[name=haveconta][value=1]').attr('checked',true);
<{else}>
    $('[name=haveconta][value=0]').attr('checked',true);
    $('.haveconta').hide();
<{/if}>
    if($('#warehouseId').val()=='1'){
        $('#avinumber').hide();
    }
}
$(function(){
    if($('#warehouseId').val() == '6'){
        if($('input[name="volumnweight"]').siblings('strong').size() < 1){
            $('input[name="volumnweight"]').siblings('a').prev().after('<strong class="red">*</strong>');
        }        
    }
})
//根据交货仓库获取目的仓
function getAimWarehouse(){
    var warehouseId = $('#warehouseId').val();
    if(warehouseId == '6'){
        if($('input[name="volumnweight"]').siblings('strong').size() < 1){
            $('input[name="volumnweight"]').siblings('a').prev().after('<strong class="red">*</strong>');
        }
    }else{
        $('input[name="volumnweight"]').siblings('strong').remove();
    }
    $.ajax({
        type:'post',
        dataType:'json',
        url:'/merchant/receiving/get-aim-warehousejh',
        data:{'warehouse_id':$('#warehouseId').val()},
        success:function(json){
            var html='';
            if($('.aimwarehouses').size()==0){
                if(json.ask=='1'){
                    html+='<tr class="aimwarehouses">';
                    html+='<td style="text-align:right"><{t}>ObjectiveWarehouse<{/t}>：</td>';
                    html+='<td><select name="to_warehouse" class="width155">'
                    $.each(json.warehouse,function(k,v){
                        html+='<option value='+ v.warehouse_id+'>'+ v.warehouse_name+'</option>';
                    });
                    html+='</select></td>';
                    html+='</tr>';
                    if($(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').length==0){
                        $(".jiahuowarehouse").after(html);
                    }else{
                        $(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').remove();
                        $(".jiahuowarehouse").after(html);
                    }
                }else{
                    if($(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').length==0){
                        $(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').remove();
                    }
                }
            }else{
                if(json.ask=='1'){
                    html+='<tr class="aimwarehouses">';
                    html+='<td style="text-align:right"><{t}>ObjectiveWarehouse<{/t}>：</td>';
                    html+='<td><select name="to_warehouse" class="width155">'
                    $.each(json.warehouse,function(k,v){
                        html+='<option value='+ v.warehouse_id+'>'+ v.warehouse_name+'</option>';
                    });
                    html+='</select></td>';
                    html+='</tr>';
                    if($(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').length==0){
                        $('.jiahuowarehouse').after(html);
                    }else{
                        $(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').remove();
                        $(".jiahuowarehouse").after(html);
                    }
                }else{
                    $(".jiahuowarehouse ~ tr").first().filter('.aimwarehouses').remove();
                }
            }

        }
    });
}
//插入订单
function insertOrderRow(json){
    //return;
    var product_number =  1;
    var errorHtml = '';
    $(json.data).each(function(k,row){
        var html = '';
        // insertProductRow(row.product_id,row.product_sku,row.product_title,row.pc_name,row.product_weight,row.product_number);
        if(row.is_valid=='1'){
            var orderid = row.order_id;
            var ordercode = row.order_code;
            var shipType = row.sm_code;
            var countryName = row.country_name;
            var createDate = row.add_time;
            var reference_no = row.reference_no;
            if($("#asnorder" + orderid).size() == 0 && orderid>0){
                html += '<tr id="asnorder' + orderid + '" class="product_sku">';
                html += '<td><a href="/merchant/order/detail/ordersCode/'+ordercode+'" target="_blank">' + reference_no + '</a><input type="hidden" name="asn_order[' + orderid + ']" value="' + ordercode + '"></td>';
                html += '<td title="'+shipType+'">' + shipType + '</td>';
                html += '<td>'+countryName+'</td>';
                html += '<td>'+createDate+'</td>';
                html += '<td><a class="orderDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                html += '</tr>';
                $("#asnorders").append(html);
				errorHtml+='<tr>';
				errorHtml+='<td>'+reference_no+'</td>';
				errorHtml+='<td>'+'成功'+'</td>';
				errorHtml+='</tr>';
				//$('#batchAddTips').html(errorHtml);
				
                //$("#asnproducts").append(html);
            }
        }else{
            var orderid = row.order_id;
            var ordercode = row.order_code;
            var shipType = row.sm_code;
            var countryName = row.country_name;
            var createDate = row.add_time;
            var reference_no = row.reference_no;
            if(!reference_no){
                reference_no='';
            }
            var error = row.error;
            errorHtml+='<tr >';
            errorHtml+='<td>'+reference_no+'</td>';
            errorHtml+='<td >失败,';
            if(error){
                $(error).each(function(ek,ed){
                    if(ed){
                        errorHtml+='<p style="color:red">'+ed+'</p>';
                    }else{
                        errorHtml+='<p> </p>';
                    }
                });
            }
            errorHtml+='</td>';
            errorHtml+='</tr>';
            //errorHtm+=
        }
    });	
    //$('#batchAddTips').html(errorHtml);
    $('#batchAddTips').html('数据导入成功');
}


/*未选择订单的提示*/
function getRipOfNodataRow(){
	 var dataRows = $("#asnorders tr:not(.norowdata)").size();
	 if(dataRows>0){
	   $('.norowdata').remove();
	 }else{
	 	$('.norowdata').remove();
	 	var html='<tr class="norowdata">\n';
            html+='<td colspan="5" style="text-align:center;"><b><{t}>Do_not_select_order<{/t}></b></td></tr>';
			$("#asnorders").append(html);		
	 }
}	

</script>	

<script>

$(document).ready(function(){
	<{if isset($receiving)}>
	if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
	<{/if}>
	
	$('input[type=text]').placeholder();
	$('.tip').poshytip({className: 'tip-yellowsimple',
	showOn: 'focus',
	alignTo: 'target',
	alignX: 'right',
	alignY: 'center',
	offsetX: 5});

	
});
$('#messageTip').dialog({
			autoOpen: false,
			modal: false,
			position:[50,50],
			bgiframe:true,
			width: 400,		
			resizable: true			
});
</script>
