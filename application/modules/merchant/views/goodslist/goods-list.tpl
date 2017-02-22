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
            <form name="searchGoodsListForm"  method="post" action="" id="pagerForm">

                <table style="word-wrap:break-word;table-layout:fixed;width='100%'" >
                    <tr>
                        <td class="nowrap text_right" nowrap="nowrap">运单号：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="trackingCode" name="trackingCode" value=""></td>
                        <td class="nowrap text_right" nowrap="nowrap">运单编号：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="wbCode" name="wbCode" value=""></td>
                        <td class="nowrap text_right" nowrap="nowrap">交易订单号：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="referenceNo" name="referenceNo" value=""></td>
                        
                        
                        
                        <{if isset($customerLogin.customer_priv.is_shipping) && $customerLogin.customer_priv.is_shipping==1}>
                        <td class="nowrap text_right" nowrap="nowrap">电商企业代码：</td>
                        <td>
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
                        <td>
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
                        <td class="nowrap text_right" nowrap="nowrap"><{t}>addTime<{/t}>：</td>
                        <td>
                            <input type="text" name="start_time" id="start_time" class="datepicker text-input width140" readonly="true"   value="" /> &nbsp;<{t}>To<{/t}>&nbsp;      
                            <input type="text" name="end_time" id="end_time" class="datepicker text-input width140" readonly="true"   value="" />
                        </td>

                        <td><a style="white-space:nowrap;" class="button searchList">搜索</a></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="clear"></div>

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
                    
                    <th>申报类型</th>
                    <!--<th>申报状态</th>-->
                    <th>国检状态</th>
                    <th>发件人</th>
                    <th>运输方式</th>
                    <th>收件人</th>
                    <th>毛重</th>
                    <th>件数</th>
                    <th>运费</th>
                    <th>币制</th>
                    <th>系统添加时间</th>
                    <th>操作</th>
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
            loadData($('#page').val(), $('#pageSizes').val());
        });
        $('.searchList').click(function(){
            loadData(0);
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
            'app_status': $('#app_status').val()
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
                if(json.ask==1){
                    if(json.data.length>0){
                        $.each(json.data,function(k,v){
                            
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