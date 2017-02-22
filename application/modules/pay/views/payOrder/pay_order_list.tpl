<style type="text/css">
	table { border-collapse: collapse; border-spacing: 0; }
	label { cursor: pointer;}
	.table-list { background: #FFFFFF;}
	.table-list td,.table-list th{padding-left:6px;padding-right:6px;}
	.table-list tbody td,.table-list .btn{/*border-bottom: #4098CA 1px solid;*/ padding-top:5px; padding-bottom:5px;}
	.table-list tr:hover,.table-list table tbody tr:hover{ background:#fbffe4;}
	.table-list .input-text-c{ padding:0; height:18px;}
	.table-list tr.on,.table-list tr.on td,.table-list tr.on th,.table-list td.on,.table-list th.on{background:#fdf9e5;}
	.table-list td.center {text-align: center;}
	.td-line{border:1px solid #4098CA}
	.td-line td,.td-line th{border:1px solid #4098CA}
	.show_view_span { color: #0066CC;}
</style>
<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>pay_order_list<{/t}></h3>
    </div>
    <div class="pageHeader">
        <form action="/pay/pay-order/pay-order-list" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>
            <input type="hidden" name="app_status" id="app_status" value="" />
            <div class="searchBar">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td><{t}>payNo<{/t}>：</td>
                        <td style="text-align: left;">
                            <input type="text" value="<{$condition.pay_no}>" name="pay_no" id="pay_no" class="text-input width110 "/>
                        </td>
                        <!-- <td><{t}>app_status<{/t}></td>
                        <td style="text-align: left;">
                        	<select name='app_status'>
                        		<{foreach from=$appStatus key=key item=item}>
                        		<option value="<{$key}>" <{if isset($condition.app_status) && $condition.app_status eq $key}>selected<{/if}>><{$item}></option>
                        		<{/foreach}>
                        	</select>
                        </td> -->
                        <{if isset($customerLogin.customer_priv.is_pay) && $customerLogin.customer_priv.is_pay==1}>
						<td>电商企业代码：</td>
                        <td style="text-align:left">
                            <input type="text" value="<{$condition.customer_code}>" name="customer_code" class="text-input width110 "/>
                        </td>
                        <{else}>
                        <td>支付企业<{t}>customerCode<{/t}>：</td>
                        <td style="text-align:left">
                            <input type="text" value="<{$condition.pay_customer_code}>" name="pay_customer_code" class="text-input width110 "/>
                        </td>
                        <{/if}>
                        <td><{t}>addTime<{/t}>：</td>
                        <td style="text-align: left;">
							<input type="text" name="add_start_time" class="datepicker text-input width110" readonly="readonly" value="<{$condition.add_start_time}>" />
							<{t}>To<{/t}>	
							<input type="text" name="add_end_time" class="datepicker text-input width110" readonly="readonly" value="<{$condition.add_end_time}>" />
                        </td>
					</tr>
					<tr>                       
                        <td><{t}>po_code<{/t}>：</td>
                        <td style="text-align: left;">
                            <input type="text" value="<{$condition.po_code}>" name="po_code" id="po_code" class="text-input width110 "/>
                        </td>
                        <td><{t}>reference_no<{/t}>：</td>
                        <td style="text-align: left;">
                            <input type="text" value="<{$condition.reference_no}>" name="reference_no" id="reference_no" class="text-input width110 "/>
                        </td>
                        <td>检验检疫状态：</td>
                        <td style="text-align: left;">
                            <select name="ciq_status">
                                <option value="" <{if $condition['ciq_status'] === ''}>selected<{/if}>>全部</option>
                                <{foreach from=$ciqStatus item=item key=key}>
                                    <option value="<{$key}>" <{if $condition['ciq_status'] !== '' && $condition['ciq_status'] == $key}>selected<{/if}>><{$item}></option>
                                <{/foreach}>
                            </select>
                            <a class="button" id="serachBut" href="javascript:void(0);" ><{t}>search<{/t}></a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<div class="btn_wrap">
	<input class="statusBtn btn <{if empty($condition['app_status']) && !is_numeric($condition['app_status'])}>btn-active<{/if}>" value="全部(<{$appStatusGroupRows['app_statusTotal']}>)" name="app_status" type='button' />
    <{foreach from=$appStatus item=appStatusRow name=appStatusRow key=key}>
	    <{if isset($appStatusGroupRows[$key])}>
	    	<input class="statusBtn btn<{if $condition['app_status']==$key && is_numeric($condition['app_status'])}> btn-active<{/if}>" value="<{$appStatusRow}>(<{$appStatusGroupRows[$key]}>)" type='button' ref='<{$key}>'>
	    <{else}>
	    	<input class="statusBtn btn<{if $condition['app_status']==$key && is_numeric($condition['app_status'])}> btn-active<{/if}>" value="<{$appStatusRow}>(0)" type='button' ref='<{$key}>'>
	    <{/if}>
    <{/foreach}>
</div>

<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
	        <tr>
                <th style="width: 160px;">
                <{if isset($customerLogin.customer_priv.is_pay) && $customerLogin.customer_priv.is_pay==1}>
                电商<{else}>支付<{/if}><{t}>企业代码<{/t}>
                </th>
                <th style="width: 70px;"><{t}>payNo<{/t}></th>
                <th style="width: 60px;">平台单号</th>
	            <th style="width: 70px;"><{t}>reference_no<{/t}></th>
	            
				<th style="width: 60px;"><{t}>pay_amount<{/t}></th>
				<th style="width: 70px;"><{t}>cosignee_code<{/t}></th>
	            <th style="width: 70px;"><{t}>cosignee_name<{/t}></th>
	            <th style="width: 60px;"><{t}>app_type<{/t}></th>
	            <th style="width: 140px;"><{t}>状态<{/t}></th>
	            <th style="width: 120px;"><{t}>addTime<{/t}></th>
	            <th style="width: 80px;"><{t}>operate<{/t}></th>
	        </tr>
        </thead>
        <tbody class="table-list">
        <{if $result neq "" && $result|@count neq 0}>
        <{foreach from=$result item=row}>
            <tr>
            	<{if isset($customerLogin.customer_priv.is_pay) && $customerLogin.customer_priv.is_pay==1}>
                <td class="center"><{$row.customer_data}></td>
                <{else}>
                <td class="center"><{$row.pay_customer_data}></td>
                <{/if}>
                <td class="center"><{$row.pay_no}></td>
                <td class="center"><{$row.po_code}></td>
                <td class="center"><{$row.reference_no}></td>
                
                <td class="center"><{$row.pay_amount}></td>
				<td class="center"><{$row.cosignee_code}></td>
                <td class="center"><{$row.cosignee_name}></td>
                <td class="center"><{$payOrderAppTypes[$row.app_type]}></td>
                <td class="center">海关：<{$appStatus[$row.app_status]}><br/>检验检疫：<{$ciqStatus[$row.ciq_status]}></td>
                <td class="center"><{$row.add_time}></td>
                <td class="center">
					<a href="javascript:viewById(<{$row.po_id}>);">查看</a>
						<{if isset($customerLogin.customer_priv.is_pay) && $customerLogin.customer_priv.is_pay==1}>
							<{if $row.app_status == 3 or $row.app_status == 1}>
								<span class="pipe">|</span>
								<a href="javascript:editById(<{$row.po_id}>);">编辑</a>
								<!--
								<span class="pipe">|</span>
								<a href="javascript:deleteById(<{$row.po_id}>);">删除</a>
								-->
							<{/if}>
						<{/if}>
                </td>
            </tr>
            <{/foreach}>
		<{else}>
			<tr>
				 <td class="center" colspan="11">暂无无数据</td>
			</tr>
        <{/if}>
        </tbody>
    </table>
</form>
<div class="clear"></div>
<div class="panelBar">
    <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>
</div>

<div id="veiwDialog" style="display: none">
	<div class="cl">
		<table cellpadding="0" cespacing="0" border="0" width="100%" class="formtable tableborder">
			<tbody>
				<tr>
					<td align="right"><{t}>po_code<{/t}>：</td>
					<td align="left" colspan="3"><span class="show_view_span blue" id="po_code_span"></span></td>
				</tr>
				<tr>
					<td align="right"><{t}>payNo<{/t}>：</td>
                    <td align="left"><span class="show_view_span blue" id="pay_no_span"></span></td>
					<td align="right"><{t}>CustomerReference<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="reference_no_span"></span></td>
				</tr>
				<tr>
					<td align="right"><{t}>app_type<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="app_type_span"></span></td>
					<td align="right"><{t}>app_time<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="app_time_span"></span></td>
				</tr>
				<tr>
					<td align="right"><{t}>customer_code<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="customer_code_span"></span></td>
					<td align="right"><{t}>enp_name<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="enp_name_span"></span></td>
				</tr>
				<tr>
					<td align="right"><{t}>电商平台代码<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="ecommerce_platform_customer_code_span"></span></td>
					<td align="right"><{t}>ecommerce_platform_customer_name<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="ecommerce_platform_customer_name_span"></span></td>
				</tr>
				<tr>
					<!--
					<td align="right"><{t}>pay_type<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="pay_type_span"></span></td>
					-->
                    <td align="right">支付企业<{t}>代码<{/t}>：</td>
                    <td align="left"><span class="show_view_span blue" id="pay_customer_code_span"></span></td>
					<td align="right"><{t}>pay_enp_name<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="pay_enp_name_span"></span></td>
					
				</tr>
				<tr>
					<td align="right"><{t}>app_status<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="app_status_span"></span></td>
					<td align="right"><{t}>add_time<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="add_time_span"></span></td>
				</tr>
				<tr>
					<td align="right"><{t}>cosignee_name<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="cosignee_name_span"></span></td>
					<td align="right">支付币制：</td>
					<td align="left"><span class="show_view_span blue" id="pay_currency_code_span"></span></td>
				</tr>
				<tr>
					<td align="right"><{t}>cosignee_code<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="cosignee_code_span"></span></td>
					<td align="right"><{t}>pay_amount<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="pay_amount_span"></span></td>
				</tr>
				<tr>
                    <td align="right">检验检疫状态：</td>
                    <td align="left"><span class="show_view_span blue" id="ciq_status_span"></span></td>
					<td align="right"><{t}>note<{/t}>：</td>
					<td align="left"><span class="show_view_span blue" id="note_span"></span></td>
				</tr>
			</tbody>
		</table>
	</div>

	<!-- log begin-->
    <div class="cl">
        <div class="tabs_header cl content-box-header" style="margin: 4px 0 4px;">
            <ul class="tabs cl" style="padding-top: 2px;">
                <li class='active'><a href="javascript:;" class='tab'><span>支付单日志</span></a></li> 
            </ul>
        </div>
        <div class='tabContent'>
            <table width="100%" cellspacing="0" cellpadding="0" class="formtable tableborder sTable">
                <thead>
	                <tr>
	                    <th>变化前状态</th>
	                    <th>变化后状态</th>
	                    <th>操作时间</th>
	                    <th>操作IP</th>
	                    <th>操作人</th>
                        <th>类型</th>
	                    <th>备注</th>
	                </tr>
                </thead>
                <tbody id="payOrderLogList"></tbody>
            </table>
        </div>
    </div>
    <!-- log end-->

</div>
<script>
$(function(){
    //按默认类
    $("#finance-list-box").alterBgColor();
    $('#export').bind('click',function(){
        $('#export_dialog').dialog('open');
    });

    //切换提交
    $('.statusBtn').click(function (){
    	var appStatus = ($(this).attr('ref'));
    	$('#app_status').val(appStatus);
		$('#serachBut').click();
    });

    //表单提交
    $('#serachBut').click(function (){
    	/*
    	if($('#app_status').val() == 0){
    		$('#app_status').val(0);
    	}
    	*/
    	$('#pagerForm').submit();
    });
});

//全选
$('.checkAll').die('click').live('click',function(){
    if ($(this).is(':checked')) {
        $(".Arr").attr('checked', true);

    } else {
        $(".Arr").attr('checked', false);
    }
    changeTrColor();
});

//伴随全选按钮是否选中而变色
function changeTrColor(){
    $(".Arr").each(function(){
        _this = $(this);
        if($('.checkAll').is(':checked')){
            set_tr_class(_this.parent().parent(), true);
        }else{
            set_tr_class(_this.parent().parent(), false);
        }
    });
}

//编辑
function editById(poId){
	parent.openMenuTab('/pay/pay-order/edit?poId='+poId, '<{t}>编辑支付单<{/t}>', 'pay-order-edit', '0');
}

//查看详情
function viewById(poId){
	var veiwDialog = $('#veiwDialog');
	var logHtml = '';
	var myoptions = {
		url:'/pay/pay-order/get-data-by-poid',
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:{'poId': poId},
		success: function(json){
			if(json.ask != 0){
				$.each( json.data, function(key, val) {
					//写入数据
					$('#'+key+'_span').html(val);
				});

				//写入日志
				if(json.log){
					$.each(json.log, function(logKey, logVal){
						logHtml += '<tr>';
                        if(logVal.status_type == '1'){
                            logHtml += '<td>' + logVal.pl_status_from + '</td>';
                            logHtml += '<td>' + logVal.pl_status_to + '</td>';
                        }else{
                            logHtml += '<td>' + logVal.ciq_status_from + '</td>';
                            logHtml += '<td>' + logVal.ciq_status_to + '</td>';
                        }
						logHtml += '<td>' + logVal.pl_add_time + '</td>';
						logHtml += '<td>' + logVal.pl_ip + '</td>';
						logHtml += '<td>' + logVal.account_name + '</td>';
                        logHtml += '<td>' + (logVal.status_type == '1' ? '海关' : '检验检疫') + '</td>';
						logHtml += '<td>' + logVal.pl_comments + '</td>';
						logHtml += '</tr>';
					});
				}

				$('#payOrderLogList').html(logHtml);
				veiwDialog.dialog({
						title: '查看详情(View details)',
						autoOpen: true,
				        position: ['center', 100],
				        width: 800,
				        height: 'auto',
				        modal: true,
				        show: "slide",
				        buttons: {
				        	'关闭(Close)': function () {
				                $(this).dialog('close');
				            }
				        }
				});
			}else{
				alertTip("get data error");
			}
		},
		error:function(a,b,c){
			alertTip("system error");
		}
	};
	$.ajax(myoptions);
}

//删除
function deleteById(poId) {
    if (poId == '' || poId == undefined) {
    	alertTip('500 Data Error.');
		return false;
    }
    $('<div title="Tips-确认删除(Confirm deletion)？" class="dialog-confirm-del-alert-tip"><p style="text-align:left; color: red;">确认删除(Confirm deletion)？</p></div>').dialog({
        autoOpen: true,
        position: ['center', 100],
        width: 400,
        height: 'auto',
        modal: true,
        show: "slide",
        buttons: {
        	'取消(Cancel)': function () {
                $(this).dialog('close');
            },
            '确定(Ok)': function () {
            	var self = $(this);
                $.ajax({
                    type: "post",
                    async: false,
                    dataType: "json",
                    url: '/pay/pay-order/del',
                    data: {'opId': poId},
                    success: function (json) {
                    	if( json.ask == 0 ){
                    		alertTip(json.message);
                    		self.dialog('close')
                    	}else{
                    		$('#serachBut').click();
                    	}
                    }
                });
			//	$(this).dialog('close');
            }
        },
        close: function () {
            $(this).detach();
        }
    });
}

</script>