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
    <h3 style="margin-left:5px">载货单新增</h3>
    <div class="clear"></div>
</div>

<{include file="logistic/views/loadingOrder/import-person-item.tpl"}>
<div class="clear"></div>
<form  action="/logistic/loading-order/create" method="post"  id='ASNForm' name="createForm" >
    <div id="create-asn-center" >
        <table class="pageFormContent">
            <tbody>
            <tr class="ReferenceCode">
				<td  class="nowarp text_right">车牌号：</td>
                <td>
                   <input name="car_no" class="text-input width155 " id="car_no">&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
                <td  class="nowarp text_right">进出口：</td>
                <td>
                    <select name="ie_type" class="required width155" id="ie_type">
                        <option value="">-Select-</option>
                        <option value="I">进口</option>
                        <option value="E">出口</option>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
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
            </tr>
			<tr class="ReferenceCode">
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
				<td  class="nowarp text_right">业务类型：</td>
                <td>
                   <select name="form_type" class="required width155">
					<option value="">-Select-</option>
					<!--
					<{foreach from=$formtypes item=formtype}>
						<{if $formtype.form_type eq 'I1A' or $formtype.form_type eq 'I2A'}>
							<option value="<{$formtype.form_type}>"><{$formtype.form_type_name}></option>
						<{/if}>
					<{/foreach}>
					-->
					<option value="I2A">保税进口-二线出区</option>
				   </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">载货单企业内部编号：</td>
                <td>
                   <input name="ref_loader_no" class="text-input width155 " id="ref_loader_no">&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
                <td  class="nowarp text_right">总件数：</td>
                <td>
                    <input name="pack_no" class="text-input width155 " id="pack_no">&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">总重量：</td>
                <td>
                   <input name="total_wt" class="text-input width155 " id="total_wt">KG&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
                <td  class="nowarp text_right">车自重 ：</td>
                <td>
                    <input name="car_wt" class="text-input width155 " id="car_wt">KG&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">单证总数：</td>
                <td>
                   <input name="form_num" class="text-input width155 " id="form_num">&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">申报单位代码：</td>
                <td>
                   <input name="agent_code" class="text-input width155" value="<{$customer.code}>" id="agent_code" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">申报单位名称：</td>
                <td>
                   <input name="agent_name" class="text-input width155 " value="<{$customer.company}>" id="agent_name" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">经营单位代码：</td>
                <td>
                   <input name="trade_code" class="text-input width155" value="<{$customer.code}>" id="trade_code" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">经营单位名称：</td>
                <td>
                   <input name="trade_name" class="text-input width155 " value="<{$customer.company}>" id="trade_name" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">仓储企业单位代码：</td>
                <td>
                   <input name="wh_code" class="text-input width155" value="<{$customer.code}>" id="wh_code" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">仓储企业单位名称：</td>
                <td>
                   <input name="wh_name" class="text-input width155 " value="<{$customer.company}>" id="wh_name" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">收发货人代码：</td>
                <td>
                   <input name="owner_code" class="text-input width155" value="" id="owner_code" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">收发货人名称：</td>
                <td>
                   <input name="owner_name" class="text-input width155 " value="" id="owner_name" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><a  href="#" class="button tijiao" id='asnbutton'  onclick="dosubmit();return false;"><{t}>submit<{/t}></a>
                </td>
            </tr>

            </tbody>
        </table>

    </div>

</form>
</div>
<div class="infoTips" id="messageTip" title="<{t}>InformationTips<{/t}>">
</div>
<script type="text/javascript">
function dosubmit(){
	var options = {
	url:'/logistic/loading-order/create',
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
			$('<div title="提示(Tip)">'+data.message+'</div>').dialog({
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
			if (typeof(data.message) != "undefined"){
				html+=data.message+"<br/>";
			}
			$.each(data.error,function(idx,vitem){
				html+=vitem+"<br/>";
			});
			$("#messageTip").html(html);
			$('#messageTip').dialog('open');
		}				
	}};
	$("#ASNForm").ajaxSubmit(options); 
	return false;
} 
function locationToList(){
   var url = "/logistic/loading-order/list";
   parent.openMenuTab(url,"载货单列表",'载货单列表','1');
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