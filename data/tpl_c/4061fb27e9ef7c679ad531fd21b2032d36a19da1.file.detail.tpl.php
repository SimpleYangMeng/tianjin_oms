<?php /* Smarty version Smarty-3.1.13, created on 2016-03-02 19:38:41
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\logistic\views\loadingOrder\detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3052356d6c781d43715-57214917%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4061fb27e9ef7c679ad531fd21b2032d36a19da1' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\logistic\\views\\loadingOrder\\detail.tpl',
      1 => 1456916534,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3052356d6c781d43715-57214917',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d6c781e09912_05466113',
  'variables' => 
  array (
    'row' => 0,
    'status' => 0,
    'deleteStatus' => 0,
    'detail' => 0,
    'item' => 0,
    'log' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d6c781e09912_05466113')) {function content_56d6c781e09912_05466113($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">载货单详细</h3>        
    </div>


<style type="text/css">
    <!--
    .tabContent {
        display: none;
    }

    .imgWrap {
        width: 76px;
        height: 76px;
        margin: 0px;
        border: 0 none;
    }
    .center{
        text-align: center;
    }
    .right{
        text-align: right;
    }
    .tableborder th {text-align: right;}
    -->
</style>
<script type="text/javascript">
$(function(){
	$(".tab").click(function(){
		$(".tabContent").hide();
		$(this).parent().addClass("active");
		$(this).parent().siblings().removeClass("active");
		$("#"+$(this).attr("id").replace("tab_","")).show();
	});
	$("#detail").show();
});
</script>
<div style="margin-right: 0px;" class="nbox_c marB10">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <tbody>
        <tr>
            <th>载货单号</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['sb_code'];?>
</td>
            <th>状态</th>
            <td><?php echo $_smarty_tpl->tpl_vars['status']->value[$_smarty_tpl->tpl_vars['row']->value['status']];?>
</td>
        </tr>
        <tr>
            <th>申报口岸</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['decl_port'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['decl_port_name'];?>
</td>
            <th>进出口岸</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ie_port'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['ie_port_name'];?>
</td>
        </tr>
        <tr>
            <th>车牌号</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['car_no'];?>
</td>
			<th>总件数</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pack_no'];?>
</td>
        </tr>
		<tr>
            <th>总重量</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['total_wt'];?>
</td>
			<th>车自重 </th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['car_wt'];?>
</td>
        </tr>
		<tr>
            <th>单证总数</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['form_num'];?>
</td>
			<th>辅助系统载货单号</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['fzxt_code'];?>
</td>
        </tr>
		<tr>
            <th>申报单位代码</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['agent_code'];?>
</td>
			<th>申报单位名称</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['agent_name'];?>
</td>
        </tr>
		<tr>
            <th>经营单位代码</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['trade_code'];?>
</td>
			<th>经营单位名称</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['trade_name'];?>
</td>
        </tr>
		<tr>
            <th>仓储企业单位代码</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['wh_code'];?>
</td>
			<th>仓储企业单位名称</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['wh_name'];?>
</td>
        </tr>
		<tr>
            <th>收发货人代码</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['owner_code'];?>
</td>
			<th>收发货人名称</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['owner_name'];?>
</td>
        </tr>
		<?php if ($_smarty_tpl->tpl_vars['row']->value['mark_delete']>=1){?>
		<tr>
            <th>申报删除状态</th>
            <td><?php echo $_smarty_tpl->tpl_vars['deleteStatus']->value[$_smarty_tpl->tpl_vars['row']->value['mark_delete']];?>
</td>
			<th>申请单编号</th>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mark_delete_code'];?>
</td>
        </tr>
		<tr>
            <th>申请原因</th>
            <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['row']->value['mark_delete_reason'];?>
</td>
        </tr>
		<?php }?>
        </tbody>
    </table>
</div>


<div class="tabs_header">
    <ul class="tabs">
        <li class='active'>
            <a href="javascript:void(0);" id='tab_detail' class='tab'><span>货物清单</span></a>
        </li>
        <li><a href="javascript:void(0);" id='tab_log' class='tab'><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Log<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a></li>
    </ul>
</div>

<div class='tabContent' id='detail'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th>载货单号</th>
            <th>物品清单号</th>
			<th>订单编号</th>
            <th>物流单编号</th>
            <th>支付单编号</th>
            <th>交易订单号</th>
        </tr>
        </thead>
        <tbody id='loadData'>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['sb_code'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['form_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['wb_code'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['po_code'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['order_reference_no'];?>
</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class='tabContent' id='log'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th>载货单号</th>
            <th>原始状态</th>
            <th>修改后的状态</th>
            <th>描述</th>
            <th>发生时间</th>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AccessIP<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        </tr>
        </thead>
        <tbody id='loadData'>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['sb_code'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['status']->value[$_smarty_tpl->tpl_vars['row']->value['sbl_status_from']];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['status']->value[$_smarty_tpl->tpl_vars['row']->value['sbl_status_to']];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['sbl_note'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['sbl_add_time'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['sbl_ip'];?>
</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class='clear'></div>

<script>
$(function(){
    
    $("#detail").alterBgColor();
	$("#asnlog").alterBgColor();
    $("#detailbatch").alterBgColor();
    $("#asnTracking").alterBgColor();
});
</script><?php }} ?>