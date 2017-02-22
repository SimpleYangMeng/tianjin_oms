<?php /* Smarty version Smarty-3.1.13, created on 2015-11-16 09:34:27
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\logistic\views\index\waybill-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2999056458d30ab5098-16722216%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7458617ac63ac496958165456c05cf8cd10b57c6' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\logistic\\views\\index\\waybill-list.tpl',
      1 => 1447406231,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2999056458d30ab5098-16722216',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56458d30b6a0b1_31902607',
  'variables' => 
  array (
    'customerLogin' => 0,
    'customer' => 0,
    'appType' => 0,
    'appStatus' => 0,
    'traf' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56458d30b6a0b1_31902607')) {function content_56458d30b6a0b1_31902607($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
    .adt{
        width:180px;
        height:30px;
        border:none;
    }
    th{
        border:1px solid #CCCCCC;
        height:30px;
    }
    #loadData>tr>td{
        border:1px solid #CCCCCC;
        height:30px;
    }
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
                <table>
                    <tr>
                        <td class="nowrap text_right" nowrap="nowrap">订单号：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="orderCode" name="orderCode" value=""></td>
                        <td class="nowrap text_right" nowrap="nowrap">交易订单号</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="transactionOrderCode" name="transactionOrderCode" value=""></td>
                    </tr>
                    <tr>
                        <td class="nowrap text_right" nowrap="nowrap">运单号：</td>
                        <td><input class="text-input width120 leftloat" type="text"  id="trackingCode" name="trackingCode" value=""></td>
                        <td class="nowrap text_right" nowrap="nowrap">客户代码：</td>
                        <td>
                            <select class="text-input width135" name='customerCode' id="customerCode">
                                <?php if ($_smarty_tpl->tpl_vars['customerLogin']->value['customer_type']!='1'){?>
                                    <option value=''>全部</option>
                                <?php }?>
                                <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customerLogin']->value['priv_customer_code_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
                                    <option value='<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
</option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="float: left; margin-top: 4px; margin-left: 10px; display: block;" class="simplesearchsubmit nowrap">
                                <a class="button searchList">搜索</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <br/>
	<div class="box-body box">
	<form name="dataForm"  method="post" action="/logistic/index/waybill-list" id="inspectionForm">
	<div class="searchBar ">
		<table class="table table-bordered table-hover">
			<thead>
                <tr>
                    <th style="width:2%;text-align:center;"><input type="checkbox" class="check-all"></th>
                    <th style="width:3%;text-align:center;" >客户代码</th>
                    <th style="width:4%;text-align:center;" >订单</th>
                    <th style="width:4%;text-align:center;" >运单</th>
                    <th style="width:4%;text-align:center;" >交易单</th>
                    <th style="width:4%;text-align:center;" >申报类型</th>
                    <th style="width:4%;text-align:center;" >业务状态</th>
                    <th style="width:4%;text-align:center;" >发件人</th>
                    <th style="width:4%;text-align:center;" >运输方式</th>
                    <th style="width:4%;text-align:center;" >收件人</th>
                    <th style="width:4%;text-align:center;" >毛重</th>
                    <th style="width:4%;text-align:center;" >件数</th>
                    <th style="width:4%;text-align:center;" >运费</th>
                    <th style="width:4%;text-align:center;" >币种</th>
                    <th style="width:6%;text-align:center;" >操作</th>
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
    var appStatus = <?php echo $_smarty_tpl->tpl_vars['appStatus']->value;?>
;
    var traf = <?php echo $_smarty_tpl->tpl_vars['traf']->value;?>
;
    $(function(){
        initData(0);
        $('.searchList').click(function(){
            initData(0);
        });
        $('.check-all').click(function(){
            if($(this).is(':checked')){
                $('.check-single').prop('checked',true);
            }else{
                $('.check-single').prop('checked',false);
            }
        });

        $('.delete-waybill').click(function(){
            var id = $(this).attr('data');
            width = 400;
            height = 'auto';
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
                        deleteWaybill(id);
                    },
                    '取消':function(){
                        $(this).dialog('close');
                    }
                },
                close:function(){
                    $('.ui-dialog').remove();
                }
            });
        })
    })
    
    function loadData(page,pageSize){
        $('#loadData').html('');
        $.ajax({
            type:'post',
            dataType:'json',
            async:false,
            url: '/logistic/index/waybill-list',
            data: {'page': page, 'pageSize': pageSize, 'orderCode': $('#orderCode').val(), 'trackingCode': $('#trackingCode').val(), 'transactionOrderCode': $('#transactionOrderCode').val(), 'customerCode': $('#customerCode').val()},
            success:function(json){
                var html = '';
                paginationTotal = json.total;
                if(json.ask==1){
                    if(json.data.length>0){
                        $.each(json.data,function(k,v){
                            html += '<tr><td style="text-align:center;width:2%;"><input type="checkbox" class="check-single" value="'+v.order_code+'" name="oc"></td>';
                            html += '<td style="text-align:center;width:3%;">'+v.customer_code+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+v.order_code+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+v.log_no+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+v.transaction_order_code+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+appType[v.app_type]+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+appStatus[v.fml_status]+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+v.shipper+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+traf[v.traf_mode]+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+v.consignee+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+v.weight+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+v.pack_no+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+v.freight+'</td>';
                            html += '<td style="text-align:center;width:4%;">'+v.currency_code+'</td>';
                            html += '<td style="text-align:center;width:4%;"><a onclick="parent.openMenuTab(\'/logistic/index/create?id='+v.wb_id+'\',\'运单编辑\',\'add_waybill\');return false;" href="#/logistic/index/create" style="font-size:12px;">编辑</a>';
                            html += ' | <a class="delete-waybill" data="'+v.wb_id+'" style="font-size:12px;">删除</a></td>'
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

    function deleteWaybill(id){
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
                alertTip(json.msg);
            }
        })
    }

</script>
<?php }} ?>