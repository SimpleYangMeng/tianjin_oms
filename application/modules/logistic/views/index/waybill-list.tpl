<style type="text/css">
.adt{ width: 180px; height: 30px; border: none; }
th{ border: 1px solid #CCCCCC; height: 30px; text-align: center; }
#loadData>tr>td{ border:1px solid #CCCCCC; height:30px; }
</style>
<div class="content">
    <div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
        <div class="content-box-header">
            <h3  class="clearborder" style="margin-left:5px;"><{t}>uploadWaybillList<{/t}></h3>
        </div>
        <div class="box-body">
            <form name="searchWaybillForm"  method="post" action="/logistic/index/waybill-list" id="pagerForm">
                <input type="hidden" name="page" value="1" id="page" />
                <input type="hidden" name="pageSize" value="20" id="pageSizes" />
                <input type="hidden" name="app_status" id="app_status" value="" />
                <table style="word-wrap:break-word;table-layout:fixed;width='100%'" >
                    <tr>
                        <td class="nowrap text_right" nowrap="nowrap">运单号：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="trackingCode" name="trackingCode" value=""></td>
                        <td class="nowrap text_right" nowrap="nowrap">运单编号：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="wbCode" name="wbCode" value=""></td>
                        <td class="nowrap text_right" nowrap="nowrap"><{t}>addTime<{/t}>：</td>
                        <td>
                            <input type="text" name="start_time" id="start_time" class="datepicker text-input width140" readonly="true"   value="" /> &nbsp;<{t}>To<{/t}>&nbsp;      
                            <input type="text" name="end_time" id="end_time" class="datepicker text-input width140" readonly="true"   value="" />
                        </td>
                    </tr>
                    <tr>
                    	<td class="nowrap text_right" nowrap="nowrap">交易订单号：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="referenceNo" name="referenceNo" value=""></td>
                        <{if isset($customerLogin.customer_priv.is_shipping) && $customerLogin.customer_priv.is_shipping==1}>
                        <td class="nowrap text_right" nowrap="nowrap">电商企业代码：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="customerCode" name="customerCode" value="" />
                            <!--
                            <select class="text-input width190" name='customerCode' id="customerCode">
                                <{foreach from=$priv_customer item=customer key=key}>
                                    <option value='<{$key}>'><{$customer}></option>
                                <{/foreach}>
                            </select>
                            -->
                        </td>
                        <{else}>
                        <td class="nowrap text_right" nowrap="nowrap">物流客户代码：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="logisticCustomerCode" name="logisticCustomerCode" value="" />
                            <!--
                            <select class="text-input width190" name='logisticCustomerCode' id="logisticCustomerCode">
                                <{foreach from=$priv_customer item=customer key=key}>
                                    <option value='<{$key}>'><{$customer}></option>
                                <{/foreach}>
                            </select>
                            -->
                        </td>
                        <{/if}>
                        <td class="nowrap text_right" nowrap="nowrap">检验检疫状态：</td>
                        <td>
                            <select name="ciq_status" id="ciq_status">
                                <option value="">全部</option>
                                <{foreach $ciqStatus as $key => $value }>
                                    <option value="<{$key }>"><{$value}></option>
                                <{/foreach}>
                            </select>
                            <a style="white-space:nowrap;" class="button searchList">搜索</a>
                        </td>
                    </tr>
                </table>
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
    
    <div class="box-body box">
    <form name="dataForm"  method="post" action="/logistic/index/waybill-list" id="inspectionForm">
    <div class="searchBar ">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <!--<th style="width:2%;"><input type="checkbox" class="check-all"></th>-->
                    <{if isset($customerLogin.customer_priv.is_shipping) && $customerLogin.customer_priv.is_shipping==1}>
                    <th style="width:260px;">电商企业代码</th>
                    <{else}>
                    <th style="width:260px;">物流客户代码</th>
                    <{/if}>
                    <th>运单号</th>
                    <!-- <th>订单编号</th> -->
                    <th>运单编号</th>
                    <th>交易订单号</th>
                    
                    <!--<th>申报类型</th>-->
                    <!--<th>申报状态</th>-->
                    <th style="width:180px;">状态</th>
                    <th style="width:140px;">发件人</th>
                    <th style="width:140px;">运输方式</th>
                    <th style="width:140px;">收件人</th>
                    <th style="width:60px;">毛重</th>
                    <th style="width:60px;">件数</th>
                    <th style="width:60px;">运费</th>
                    <th style="width:60px;">币制</th>
                    <th style="width:140px;">系统添加时间</th>
                    <th style="width:140px;">操作</th>
                </tr>
            </thead>
            <tbody id="loadData" style="text-align:center;background-color:#F3F3F3;">
                 <tr>
                    <td colspan="15" style="border:1px solid #CCCCCC;"><{t}>NoDate<{/t}></td>
                </tr>
            </tbody>
        </table>
        </div>
    </form>
    </div>
    <div class="clear"></div>
    <div class="pagination"></div>
</div>
<script type="text/javascript">
    var appType = <{$appType}>;
    var appStatus = <{$appStatusJson}>;
    var traf = <{$traf}>;
    $(function(){
        initData(0);
        //切换提交
        $('.statusBtn').click(function (){
            $('.btn_wrap').find('input').each(function (){
                $(this).removeClass('btn-active');
            });
            $(this).addClass('btn-active');

            var appStatus = ($(this).attr('ref'));
            $('#app_status').val(appStatus);
        //    loadData($('#page').val(), $('#pageSizes').val());
            initData(0);
        });
        $('.searchList').click(function(){
        //    loadData(0);
            initData(0);
        });

        $('.check-all').click(function(){
            if($(this).is(':checked')){
                $('.check-single').prop('checked',true);
            }else{
                $('.check-single').prop('checked',false);
            }
        });
    })
    
    //加载数据
    function loadData(page, pageSize){
        $('#loadData').html('');
        var searchData = {
            'page': page, 
            'pageSize': pageSize, 
            'orderCode': $('#orderCode').val(), 
            'wbCode': $('#wbCode').val(), 
            'trackingCode': $('#trackingCode').val(), 
            'referenceNo': $('#referenceNo').val(), 
            'customerCode': $('#customerCode').val(),
            'start_time': $('#start_time').val(),
            'end_time': $('#end_time').val(),
            'app_status': $('#app_status').val(),
            'ciq_status': $('#ciq_status').val(),
        };
        $.ajax({
            type:'post',
            dataType:'json',
            async:false,
            url: '/logistic/index/waybill-list',
            data: searchData,
            success:function(json){
                var html = '';
                paginationTotal = json.total;
                ciqStatus = json.ciqStatus;
                if(json.ask==1){
                    if(json.data.length>0){
                        $.each(json.data,function(k,v){
                            html += '<tr>';
                        //    html += '<td style="text-align:center;width:2%;"><input type="checkbox" class="check-single" value="'+v.order_code+'" name="oc"></td>';
                            <{if isset($customerLogin.customer_priv.is_shipping) && $customerLogin.customer_priv.is_shipping==1}>
                            html += '<td style="text-align:center;">'+v.customer_code+'</td>';
                            <{else}>
                            html += '<td style="text-align:center;">'+v.logistic_customer_code+'</td>';
                            <{/if}>
                            html += '<td style="text-align:center;">'+v.log_no+'</td>';
                            
                            // html += '<td style="text-align:center;">'+v.order_code+'</td>';
                            html += '<td style="text-align:center;">'+v.wb_code+'</td>';
                            html += '<td style="text-align:center;">'+v.reference_no+'</td>';

                            
                        //    html += '<td style="text-align:center;">'+appType[v.app_type]+'</td>';
                        //    html += '<td style="text-align:center;">'+appStatus[v.app_status]+'</td>';
                            html += '<td style="text-align:center;">海关：'+appStatus[v.app_status]+'<br/>检验检疫：'+ciqStatus[v.ciq_status]+'</td>';
                            html += '<td style="text-align:center;">'+v.shipper+'</td>';
                            html += '<td style="text-align:center;">'+traf[v.traf_mode]+'</td>';
                            html += '<td style="text-align:center;">'+v.consignee+'</td>';
                            html += '<td style="text-align:center;">'+v.weight+'</td>';
                            html += '<td style="text-align:center;">'+v.pack_no+'</td>';
                            html += '<td style="text-align:center;">'+v.freight+'</td>';
                            html += '<td style="text-align:center;">'+v.currency_code+'</td>';
                            html += '<td style="text-align:center;">'+v.wb_add_time+'</td>';
                            html += '<td style="text-align:center;">';
                            html += '<a onclick="parent.openMenuTab(\'/logistic/index/public-view?wb_id='+v.wb_id+'\',\'运单详情\',\'view_waybill\');return false;" href="#/logistic/index/view">查看</a>';
                            
                            <{if isset($customerLogin.customer_priv.is_shipping) && $customerLogin.customer_priv.is_shipping==1}>
                                if(v.app_status == 3 || v.app_status == 1){
                                    html += '<span class="pipe">|</span><a onclick="parent.openMenuTab(\'/logistic/index/create?id='+v.wb_id+'\',\'运单编辑\',\'edit_waybill\');return false;" href="#/logistic/index/create">编辑</a>';
                                //    html += '<span class="pipe">|</span><a href="javascript:;" onclick="delById('+v.wb_id+')" class="delete-waybill" data="'+v.wb_id+'">删除</a>';
                                }
                            <{/if}>
                            
                            html += '</td>';
                            html += '</tr>';
                        });
                    }else{
                        html = '<tr><td colspan="15" style="border:1px solid #CCCCCC;"><{t}>NoDate<{/t}></td></tr>';
                    }
                }else{
                    html = '<tr><td colspan="15" style="border:1px solid #CCCCCC;"><{t}>NoDate<{/t}></td></tr>';
                }
                $('#loadData').html(html);
            }
        })
    }

    //删除
    function delById(id){
        var width = 400;
        var height = 'auto';
        $('<div title="提示(Esc退出)"><p align="center" style="color:red;">确定删除？</p></div>').dialog({
            autoOpen: true,
            width: width,
            height: height,
            modal: true,
            show:"slide",
            position:"top",
            buttons: {
                '确认': function() {
                    $(this).dialog('close');
                    $.ajax({
                        type:'post',
                        dataType:'json',
                        async:false,
                        url:'/logistic/index/delete-waybill',
                        data:{id:id},
                        success:function(json){
                            if(json.ask==1){
                                initData(0);
                            }
                            alertTip(json.message);
                        }
                    });
                },
                '取消':function(){
                    $(this).dialog('close');
                }
            },
            close:function(){
                $('.ui-dialog').remove();
            }
        });
    }
</script>