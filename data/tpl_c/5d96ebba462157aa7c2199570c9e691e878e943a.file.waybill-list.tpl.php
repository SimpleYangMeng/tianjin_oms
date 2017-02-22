<?php /* Smarty version Smarty-3.1.13, created on 2016-03-04 10:49:37
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\logistic\views\index\waybill-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:917256d8f4259f5586-98499233%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d96ebba462157aa7c2199570c9e691e878e943a' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\logistic\\views\\index\\waybill-list.tpl',
      1 => 1457059661,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '917256d8f4259f5586-98499233',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d8f425ae53e5_05318903',
  'variables' => 
  array (
    'customerLogin' => 0,
    'priv_customer' => 0,
    'key' => 0,
    'customer' => 0,
    'ciqStatus' => 0,
    'value' => 0,
    'condition' => 0,
    'appStatusGroupRows' => 0,
    'appStatus' => 0,
    'appStatusRow' => 0,
    'appType' => 0,
    'appStatusJson' => 0,
    'traf' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d8f425ae53e5_05318903')) {function content_56d8f425ae53e5_05318903($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
.adt{ width: 180px; height: 30px; border: none; }
th{ border: 1px solid #CCCCCC; height: 30px; text-align: center; }
#loadData>tr>td{ border:1px solid #CCCCCC; height:30px; }
</style>
<div class="content">
    <div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
        <div class="content-box-header">
            <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
uploadWaybillList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
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
                        <td class="nowrap text_right" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td>
                            <input type="text" name="start_time" id="start_time" class="datepicker text-input width140" readonly="true"   value="" /> &nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;      
                            <input type="text" name="end_time" id="end_time" class="datepicker text-input width140" readonly="true"   value="" />
                        </td>
                    </tr>
                    <tr>
                    	<td class="nowrap text_right" nowrap="nowrap">交易订单号：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="referenceNo" name="referenceNo" value=""></td>
                        <?php if (isset($_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_shipping'])&&$_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_shipping']==1){?>
                        <td class="nowrap text_right" nowrap="nowrap">电商企业代码：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="customerCode" name="customerCode" value="" />
                            <!--
                            <select class="text-input width190" name='customerCode' id="customerCode">
                                <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['priv_customer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['customer']->key;
?>
                                    <option value='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
</option>
                                <?php } ?>
                            </select>
                            -->
                        </td>
                        <?php }else{ ?>
                        <td class="nowrap text_right" nowrap="nowrap">物流客户代码：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="logisticCustomerCode" name="logisticCustomerCode" value="" />
                            <!--
                            <select class="text-input width190" name='logisticCustomerCode' id="logisticCustomerCode">
                                <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['priv_customer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['customer']->key;
?>
                                    <option value='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
</option>
                                <?php } ?>
                            </select>
                            -->
                        </td>
                        <?php }?>
                        <td class="nowrap text_right" nowrap="nowrap">检验检疫状态：</td>
                        <td>
                            <select name="ciq_status" id="ciq_status">
                                <option value="">全部</option>
                                <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ciqStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
                                <?php } ?>
                            </select>
                            <a style="white-space:nowrap;" class="button searchList">搜索</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    
    <div class="btn_wrap">
        <input class="statusBtn btn <?php if (empty($_smarty_tpl->tpl_vars['condition']->value['app_status'])&&!is_numeric($_smarty_tpl->tpl_vars['condition']->value['app_status'])){?>btn-active<?php }?>" value="全部(<?php echo $_smarty_tpl->tpl_vars['appStatusGroupRows']->value['app_statusTotal'];?>
)" name="app_status" type='button' />
        <?php  $_smarty_tpl->tpl_vars['appStatusRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['appStatusRow']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['appStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['appStatusRow']->key => $_smarty_tpl->tpl_vars['appStatusRow']->value){
$_smarty_tpl->tpl_vars['appStatusRow']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['appStatusRow']->key;
?>
            <?php if (isset($_smarty_tpl->tpl_vars['appStatusGroupRows']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
                <input class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['condition']->value['app_status']==$_smarty_tpl->tpl_vars['key']->value&&is_numeric($_smarty_tpl->tpl_vars['condition']->value['app_status'])){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['appStatusRow']->value;?>
(<?php echo $_smarty_tpl->tpl_vars['appStatusGroupRows']->value[$_smarty_tpl->tpl_vars['key']->value];?>
)" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'>
            <?php }else{ ?>
                <input class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['condition']->value['app_status']==$_smarty_tpl->tpl_vars['key']->value&&is_numeric($_smarty_tpl->tpl_vars['condition']->value['app_status'])){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['appStatusRow']->value;?>
(0)" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'>
            <?php }?>
        <?php } ?>
    </div>
    
    <div class="box-body box">
    <form name="dataForm"  method="post" action="/logistic/index/waybill-list" id="inspectionForm">
    <div class="searchBar ">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <!--<th style="width:2%;"><input type="checkbox" class="check-all"></th>-->
                    <?php if (isset($_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_shipping'])&&$_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_shipping']==1){?>
                    <th style="width:260px;">电商企业代码</th>
                    <?php }else{ ?>
                    <th style="width:260px;">物流客户代码</th>
                    <?php }?>
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
                    <td colspan="15" style="border:1px solid #CCCCCC;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
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
    var appType = <?php echo $_smarty_tpl->tpl_vars['appType']->value;?>
;
    var appStatus = <?php echo $_smarty_tpl->tpl_vars['appStatusJson']->value;?>
;
    var traf = <?php echo $_smarty_tpl->tpl_vars['traf']->value;?>
;
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
                            <?php if (isset($_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_shipping'])&&$_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_shipping']==1){?>
                            html += '<td style="text-align:center;">'+v.customer_code+'</td>';
                            <?php }else{ ?>
                            html += '<td style="text-align:center;">'+v.logistic_customer_code+'</td>';
                            <?php }?>
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
                            
                            <?php if (isset($_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_shipping'])&&$_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_shipping']==1){?>
                                if(v.app_status == 3 || v.app_status == 1){
                                    html += '<span class="pipe">|</span><a onclick="parent.openMenuTab(\'/logistic/index/create?id='+v.wb_id+'\',\'运单编辑\',\'edit_waybill\');return false;" href="#/logistic/index/create">编辑</a>';
                                //    html += '<span class="pipe">|</span><a href="javascript:;" onclick="delById('+v.wb_id+')" class="delete-waybill" data="'+v.wb_id+'">删除</a>';
                                }
                            <?php }?>
                            
                            html += '</td>';
                            html += '</tr>';
                        });
                    }else{
                        html = '<tr><td colspan="15" style="border:1px solid #CCCCCC;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td></tr>';
                    }
                }else{
                    html = '<tr><td colspan="15" style="border:1px solid #CCCCCC;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td></tr>';
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
</script><?php }} ?>