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
    }
    .asndetailstrong {
        color: #FF0000;
        display: block;
        float: left;
        margin-right: 20px;
        margin-top: 15px;
    }
    #subProducts .textInput{
        float:none;;
    }
</style>


<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all asncontent" style="display:block;"> 
<div class="content-box-header">
    <h3 style="margin-left:5px">入库单新增</h3>
    <div class="clear"></div>
</div>

<{include file="merchant/views/receiving/receiving-import-inner.tpl"}>

<form  action="/merchant/receiving/create" method="post"  id='ASNForm' name="createForm" >
    <div id="create-asn-center" >
        <table class="pageFormContent">
            <tbody>
            <tr class="ReferenceCode">
				<td  class="nowarp text_right">申报口岸：</td>
                <td>
                   <select name="decl_port" class="required width155" id="decl_port">
                        <option value="">-Select-</option>
                        <{foreach from=$iePorts item=item}>
						 <option value="<{$item.ie_port}>"><{$item.ie_port_name}></option>
						<{/foreach}>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
                <td  class="nowarp text_right">进出口岸：</td>
                <td>
                    <select name="ie_port" class="required width155" id="ie_port">
                        <option value="">-Select-</option>
                        <{foreach from=$iePorts item=item}>
						 <option value="<{$item.ie_port}>"><{$item.ie_port_name}></option>
						<{/foreach}>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			
			<tr class="ReferenceCode">
				<td   class="nowarp text_right">起运国：</td>
                <td>
					<select name="trade_country" class="required width155" id="trade_country">
                        <option value="">-Select-</option>
                        <{foreach from=$country item=item}>
                            <option value="<{$item.country_code}>" <{if $item.country_id==49}> selected<{/if}>><{$item.country_name}> <{$item.country_name_en}></option>
                        <{/foreach}>
                    </select>&nbsp;<strong class="red">*</strong>
				</td>
				<td   class="nowarp text_right">目的港：</td>
                <td>
					<select name="destination_port" class="required width155" id="destination_port">
                        <option value="">-Select-</option>
                        <{foreach from=$country item=item}>
                            <option value="<{$item.trade_country}>" <{if $item.country_id==49}> selected<{/if}>><{$item.country_name}> <{$item.country_name_en}></option>
                        <{/foreach}>
                    </select>&nbsp;<strong class="red">*</strong>
				</td>
			</tr>
            <tr class="ReferenceCode">
				<td  class="nowarp text_right">进出口类型：</td>
                <td>
                   <select name="ie_flag" class="required width155" id="ie_flag">
                        <option value="">-Select-</option>
                        <option value="I">进口</option>
						<option value="E">出口</option>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
				<td class='nowrap text_right'>监管方式 :</td>
                <td>
                    <select name="trade_mode" class="required width155" id="trade_mode">
                        <option value="">-Select-</option>
                        <{foreach from=$tradeModes item=item}>
                            <option value="<{$item.trade_mode}>"><{$item.trade_mode_name}></option>
                        <{/foreach}>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			
			<tr class="ReferenceCode">
				<td class='nowrap text_right'>成交方式  :</td>
                <td>
                    <select name="trans_mode" class="required width155" id="trans_mode">
                        <option value="">-Select-</option>
                        <{foreach from=$transModes item=item}>
                            <option value="<{$item.trans_mode}>"><{$item.trans_mode_name}></option>
                        <{/foreach}>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
                
				<td class='nowrap text_right'>业务类型:</td>
                <td>
					<select name="form_type" class="required width155">
						<option value="">-Select-</option>
                        <{foreach from=$formtypes item=formtype}>
							<{if $formtype.form_type eq 'I1A' or $formtype.form_type eq 'I2A'}>
								<option value="<{$formtype.form_type}>" <{if isset($receiving)&&($receiving.form_type==$formtype.form_type)}>selected<{/if}> ><{$formtype.form_type_name}></option>
							<{/if}>
                        <{/foreach}>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>			
			<tr class="ReferenceCode">
				<td class='nowrap text_right'>运输方式:</td>
                <td>
                    <select name="traf_mode" class="required width155" id="traf_mode">
                        <option value="">-Select-</option>
                        <{foreach from=$trafModes item=item}>
                            <option value="<{$item.traf_mode}>"><{$item.traf_mode_name}></option>
                        <{/foreach}>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
				<td  class="nowarp text_right">出入库类型：</td>
                <td>
                   <select name="ie_mode" class="required width155" id="ie_mode">
                        <option value="">-Select-</option>
                        <option value="I">入库</option>
						<option value="E">出库</option>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td class='nowrap text_right'>外包装类型:</td>
                <td>
                    <select name='wrap_type' class="required width155">
                        <option value=""><{t}>pleaseSelected<{/t}>...</option>
                        <{foreach from=$wrapTypes item=wrapType}>
                        <{if $wrapType.wrap_type neq ''}>
                        <option value="<{$wrapType.wrap_type}>" <{if isset($receiving)&&($receiving.wrap_type==$wrapType.wrap_type)}>selected<{/if}>><{$wrapType.wrap_type_name}></option>
                        <{/if}>
                        <{/foreach}>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
				<td   class="nowarp text_right">企业清单内部编号：</td>
                <td>
					 <input type="text" size="60" class="text-input width155 " value="" name="list_no" id="list_no">&nbsp;<strong class="red">*</strong>
				</td>
            </tr>
			<tr>
				<td  class="nowarp text_right">运输工具名称：</td>
                <td>
                    <input name="traf_name" class="text-input width155 " id="traf_name">&nbsp;<strong class="red">*</strong>
                </td>
                
				<td class='nowrap text_right'>航次:</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="" name="voyage_no" id="voyage_no">
                </td>
            </tr>
			<tr>
				<td class='nowrap text_right'>经营单位代码  :</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<{$customer.code}>" name="trade_co" id="trade_co" readonly>&nbsp;<strong class="red">*</strong>
                </td>
				<td class='nowrap text_right'>经营单位名称:</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<{$customer.company}>" name="trade_name" id="trade_name" readonly>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr>
				<td class='nowrap text_right'>仓储企业代码  :</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<{$customer.code}>" name="storage_co" id="trade_co" readonly>&nbsp;<strong class="red">*</strong>
                </td>
				<td class='nowrap text_right'>仓储企业名称:</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<{$customer.company}>" name="storage_name" id="trade_name" readonly>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
            <tr class="ReferenceCode">
               
				<td class='nowrap text_right'>申报单位代码  :</td>
				
                <td>
                   <input type="text" size="60" class="text-input width155 " value="<{$customer.code}>" name="agent_code" id="agent_code" readonly>&nbsp;<strong class="red">*</strong>
                </td>
				<td class='nowrap text_right'>申报单位名称:</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<{$customer.company}>" name="agent_name" id="agent_name" readonly>
					&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
                
				<td class='nowrap text_right'>收（发）货单位  :</td>
                <td>
                   <input type="text" size="60" class="text-input width155 " value="" name="owner_code" id="owner_code" >&nbsp;<strong class="red">*</strong>
                </td>
				 <td   class="nowarp text_right">收（发）货单位名称：</td>
                <td><input type="text" size="60" class="text-input width155 " value="" name="owner_name" id="owner_name" >&nbsp;<strong class="red">*</strong></td>
            </tr>
            <tr class="ReferenceCode">
                <td   class="nowarp text_right">提运单号：</td>
                <td><input type="text" size="60" class="text-input width155 " value="<{if isset($receiving)&&$receiving.bill_no}><{$receiving.bill_no}><{/if}>" name="bill_no" id="bill_no"><strong class="red">*</strong></td>
				<td  class="nowarp text_right">仓库账册号 ：</td>
                <td>
                   <input type="text" size="60" class="text-input width155 " value="" name="warehouse_code" id="warehouse_code">&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
            
            <tr>
                <td style="text-align:right">总<{t}>roughweight<{/t}>：</td>
                <td><input type="text"  placeholder="0.000" class="text-input width155" name='roughweight' value='<{if isset($receiving)&&$receiving.roughweight &&$receiving.roughweight!=0}><{$receiving.roughweight}><{/if}>'> KG <strong class="red">*</strong>&nbsp;&nbsp;&nbsp;
				
				<!--<img src="/images/help.png">-->
				
				</a></td>
				
				<td style="text-align:right">总净重：</td>
                <td><input type="text"  placeholder="0.000" class="text-input width155" name='net_weight' value='<{if isset($receiving)&&$receiving.netweight &&$receiving.netweight!=0}><{$receiving.netweight}><{/if}>'> KG &nbsp;<strong class="red">*</strong></td>
				
            </tr>
            
            <tr>
			  <td class="nowrap text_right">件数：</td>
			  <td>
				<input type="text" class="text-input width155" name="pack_no" id="pack_no" value="<{if isset($receiving) && $receiving.pack_no}><{$receiving.pack_no}><{/if}>" />&nbsp;<strong class="red">*</strong>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				<!--<img src="/images/help.png" /></a>-->
			  </td>
			  <td class="nowrap text_right">入库日期：</td>
			  <td>
				<input type="text"
						class="datepicker text-input" value=""
						name="import_date" id="import_date" readonly="readonly" />&nbsp;<strong class="red">*</strong>
			  </td>
			</tr>
			
			<tr>
			  <td class="nowrap text_right">是否有废旧物品：</td>
			  <td>
				<input type="radio" name="waste_flag" id="waste_flag1" value="Y"/>&nbsp;<label for="waste_flag1">是</label>
				<input type="radio" name="waste_flag" id="waste_flag0" value="N"/>&nbsp;<label for="waste_flag0">否</label>
				<strong class="red">*</strong>
				<!--<img src="/images/help.png" /></a>-->
			  </td>
			  <td class="nowrap text_right">是否带有植物性包装及铺垫材料:</td>
			  <td>
				<input type="radio" name="pack_flag" id="pack_flag1" value="Y"/>&nbsp;<label for="pack_flag1">是</label>
				<input type="radio" name="pack_flag" id="pack_flag0" value="N"/>&nbsp;<label for="pack_flag0">否</label>
				<strong class="red">*</strong>
			  </td>
			</tr>
			<tr>
			  <td class="nowrap text_right">报检单号：</td>
			  <td>
				<input type="text" class="text-input width155" name="law_no" id="law_no" />&nbsp;<strong class="red">*</strong>
				&nbsp;&nbsp;&nbsp;&nbsp;
			  </td>
			  <td class="nowrap text_right">检疫电商企业代码：</td>
			  <td>
				<input type="text" class="text-input" name="ebc_no" id="ebc_no" />&nbsp;<strong class="red">*</strong>
			  </td>
			</tr>
			<tr>
			  <td class="nowrap text_right">启运口岸：</td>
			  <td>
				<select name="desp_port" class="required width155" id="desp_port">
					<option value="">-Select-</option>
					<{foreach from=$dPort item=item}>
					<option value="<{$item.port_code}>"><{$item.port_name}></option>
					<{/foreach}>
                </select>&nbsp;<strong class="red">*</strong>
			  </td>
			  <td class="nowrap text_right">入境口岸：</td>
			  <td>
				<select name="entry_port" class="required width155" id="entry_port">
					<option value="">-Select-</option>
					<{foreach from=$ePort item=item}>
					<option value="<{$item.port_code}>"><{$item.port_name}></option>
					<{/foreach}>
                </select>&nbsp;<strong class="red">*</strong>
			  </td>
			</tr>
			<tr>
			  <td class="nowrap text_right">施检机构：</td>
			  <td>
				<select name="check_org_code" class="required width155" id="check_org_code">
					<option value="">-Select-</option>
					<{foreach from=$organization item=item}>
					<option value="<{$item.organization_code}>"><{$item.organization_name}></option>
					<{/foreach}>
                </select>&nbsp;<strong class="red">*</strong>
			  </td>
			  <td class="nowrap text_right">目的机构：</td>
			  <td>
				<select name="org_code" class="required width155" id="org_code">
					<option value="">-Select-</option>
					<{foreach from=$organization item=item}>
					<option value="<{$item.organization_code}>"><{$item.organization_name}></option>
					<{/foreach}>
                </select>&nbsp;<strong class="red">*</strong>
			  </td>
			</tr>
			<tr>
			  <td class="nowrap text_right">申报人名称：</td>
			  <td>
				<input type="text" class="text-input width155" name="decl_person" id="decl_person" value="<{$customer.account_name}>"/>&nbsp;<strong class="red">*</strong>
				&nbsp;&nbsp;&nbsp;&nbsp;
			  </td>
			  <td class="nowrap text_right">货物存放地:</td>
			  <td><input type="text" class="text-input width155" name="goods_address" id="goods_address" />&nbsp;<strong class="red">*</strong></td>
			</tr>
			<tr>
			  <td class="nowrap text_right">合同号:</td>
			  <td>
				<input type="text" class="text-input width155" name="contract_no" id="contract_no" value=""/>&nbsp;<strong class="red">*</strong>
				&nbsp;&nbsp;&nbsp;&nbsp;
			  </td>
			  <td class="nowrap text_right">运输号码:</td>
			  <td><input type="text" class="text-input width155" name="trans_type_no" id="trans_type_no" />&nbsp;<strong class="red">*</strong></td>
			</tr>
            <tr >
                <td style="text-align:right"><{t}>remark<{/t}>：</td>
                <td colspan="3"><textarea rows="5" cols="80" id="notes" name="notes"><{if isset($receiving)&&$receiving.notes}><{$receiving.notes}><{/if}></textarea></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td colspan="3"><a  href="#" class="button tijiao" id='asnbutton'  onclick="dosubmit();return false;"><{t}>submit<{/t}></a>
                </td>
            </tr>

            </tbody>
        </table>

    </div>

</form>
</div>
<div id="dialog" title="<{t}>SelectProduct<{/t}>"></div>
<div class="infoTips" id="messageTip" title="<{t}>InformationTips<{/t}>">

</div>
    <div id="asndetailDialog" title="<{t}>import_by_xls<{/t}>" style="display:none">
        <form action="/merchant/product/batch-input" method="post" id="asndetailForm">
            <table>
                <tr><th><{t}>export_xls<{/t}>:</th>
                    <td><input type="file" name="XMLForInput" />
                    </td></tr>
                <tr>
                    <th></th>
                    <td>
                        <p><img style="width:25px;" src="/images/download.png"><{t}>download_templete<{/t}>:<a href="/merchant/product/select-product-templete" style="text-decoration:underline;"><{t}>product_template<{/t}></a></p>
                        
                    </td>
                </tr>
            </table>

            <table cellspacing="0" cellpadding="0" class="formtable tableborder">
                <thead>
                <tr>
                    <th width='200'>产品备案号</th>
                    <th width='70'><{t}>operate<{/t}></th>
                </tr>
                </thead>
                <tbody id='batchAddTips'>
                </tbody>
            </table>
        </form>
    </div>


<script type="text/javascript">

$(function(){
	$(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});
})
	
$('#dialog').dialog({
	autoOpen: false,
	modal: false,
	bgiframe:true,
	width: 1000,
	minHeight:500,
	height:500,			
	resizable: true
});
   
function dosubmit(){
	var options = {
	url:'/merchant/receiving/create',
	type:'POST',
	dataType:'json',
	success: function(data){
		var html ="";						
		if(data.ask==1){						
			$( "#messageTip").dialog({
				autoOpen: false,
				position:[50,50],
				close: function(event, ui) {locationToList();}
			});
			$('<div title="提示(Tip)">'+data.msg+'</div>').dialog({
				autoOpen: true,
				close: function(event, ui) {locationToList();},
				width: '320',
				position:[50,50],
				height: 'auto',
				modal: true,
				buttons: {
					'关闭(close)': function () {
						locationToList();
					}
				}
			});
			$("#messageTip").html(html);
		}else{
			$("#messageTip").html('');
			if (typeof(data.message) != "undefined")
			{
				html+=data.message+"<br/>";
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
   var url = "/merchant/receiving/listbh";
   parent.openMenuTab(url,"入库单列表",'入库单列表','1');   
}

$('#messageTip').dialog({
	autoOpen: false,
	modal: false,
	bgiframe:true,
	position:[50,50],
	width: 400,
	position:[50,50],
	resizable: true			
});
</script>