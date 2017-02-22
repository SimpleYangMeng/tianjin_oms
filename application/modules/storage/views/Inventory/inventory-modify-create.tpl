
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
    <h3 style="margin-left:5px">账册调整新增</h3>
    <div class="clear"></div>
</div>

<{include file="storage/views/Inventory/inventory-modify-create-inner.tpl"}>

<form  action="/merchant/inventory-modify/create" method="post"  id='ASNForm' name="createForm" >
    <div id="create-asn-center" >
        <table class="pageFormContent">
            <tbody>
            <tr class="ReferenceCode">
				<td  class="nowarp text_right">申报口岸：</td>
                <td>
                   <select name="customs_code" class="required width155" id="customs_code">
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
				<td  class="nowarp text_right">进出口类型：</td>
                <td>
                   <select name="ie_flag" class="required width155" id="ie_flag">
                        <option value="">-Select-</option>
                        <option value="I">进口</option>
						<option value="E">出口</option>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
				<td  class="nowarp text_right">账册号：</td>
				<td><input type="text" size="60" class="text-input width155 " value="" name="ems_no" id="ems_no">&nbsp;<strong class="red">*</strong></td>
            </tr>
			<tr>
				<td class='nowrap text_right'>仓储企业代码  :</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<{$customer.code}>" name="wh_code" id="wh_code" readonly>&nbsp;<strong class="red">*</strong>
                </td>
				<td class='nowrap text_right'>仓储企业名称:</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<{$customer.company}>" name="wh_name" id="wh_name" readonly>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td class='nowrap text_right'>申报单位代码:</td>
                <td>
                   <input type="text" size="60" class="text-input width155 " value="<{$customer.code}>" name="agent_code" id="agent_code" >&nbsp;<strong class="red">*</strong>
                </td>
				 <td   class="nowarp text_right">申报单位名称：</td>
                <td><input type="text" size="60" class="text-input width155 " value="<{$customer.company}>" name="agent_name" id="agent_name" >&nbsp;<strong class="red">*</strong></td>
            </tr>
			<tr class="ReferenceCode">
				<td class='nowrap text_right'>电商企业编码:</td>
                <td>
                   <input type="text" size="60" class="text-input width155 " value="" name="ebc_code" id="ebc_code" >&nbsp;<strong class="red">*</strong>
                </td>
				 <td   class="nowarp text_right">电商企业名称：</td>
                <td><input type="text" size="60" class="text-input width155 " value="" name="ebc_name" id="ebc_name" >&nbsp;<strong class="red">*</strong></td>
            </tr>
			<tr>
			  <td class="nowrap text_right">申报人：</td>
			  <td>
				<input type="text" size="60" class="text-input width155 " value="" name="decl_by" id="decl_by" >&nbsp;<strong class="red">*</strong>
			  </td>
			  <td class="nowrap text_right">申报日期：</td>
			  <td>
				<input type="text" class="datepicker text-input width140" value="" name="decl_time" id="decl_time" readonly="readonly" />&nbsp;<strong class="red">*</strong>
			  </td>
			</tr>
            <tr >
                <td style="text-align:right">调整原因：</td>
                <td colspan="3"><textarea rows="5" cols="80" id="note" name="note"></textarea></td>
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
<div class="infoTips" id="messageTip" title="<{t}>InformationTips<{/t}>"></div>
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
	url:'/storage/inventory-modify/create',
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
	}};

	$("#ASNForm").ajaxSubmit(options); 
	return false;
}
function locationToList(){
   var url = "/storage/inventory-modify/create";
   parent.openMenuTab(url,"账册调整新增",'账册调整新增','1');
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

