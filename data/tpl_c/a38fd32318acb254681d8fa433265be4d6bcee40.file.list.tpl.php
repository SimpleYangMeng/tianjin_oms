<?php /* Smarty version Smarty-3.1.13, created on 2016-03-03 15:57:04
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\logistic\views\loadingOrder\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2298656d6c77e59f169-51333014%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a38fd32318acb254681d8fa433265be4d6bcee40' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\logistic\\views\\loadingOrder\\list.tpl',
      1 => 1456990137,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2298656d6c77e59f169-51333014',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d6c77e6f0552_86813789',
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'params' => 0,
    'iePorts' => 0,
    'item' => 0,
    'status' => 0,
    'k' => 0,
    'v' => 0,
    'result' => 0,
    'iePortsCode' => 0,
    'statusArray' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d6c77e6f0552_86813789')) {function content_56d6c77e6f0552_86813789($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\modifier.date_format.php';
?><style type="text/css">
    .btn:hover, .btn:focus, .btn-active, .btn-sub {
        background: #5998D7;
        color: #333;
    }
    .clear{
        clear: both;
    }
    .print{
        margin: 5px;
    }
    .condiv{
        float: left;
        margin-bottom: 5px;
        margin-left: 5px;
        width: 220px;
    }
    .changewidth .width140{
        width:130px;
    }
    .changewidth .width155{
        width:140px;
    }
    .condatediv{
        float: left;
        margin-bottom: 5px;
        margin-left: 5px;
    }
</style>

<div class="content-box  ui-tabs  ui-corner-all  ui-widget ui-widget-content" >
    <div class="content-box-header">
        <h3 style="margin-left:5px">载货单列表</h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/logistic/loading-order/list" id="pagerForm">
        <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['status'];?>
" name="status">
        <div class="searchBar ">
            <table class="searchbartable" cellspacing="2" cellpadding="2"  border="0" id="searchbox">
                <tr>
                    <td class="text_right" nowrap="nowrap" width="140">载货单号：</td>
                    <td style="text-align:left;"><input class="text-input width140 leftloat" type="text"  name="sb_code" value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value['sb_code'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['sb_code'];?>
<?php }?>">
					</td>
                    <td  class="text_right">申报口岸：</td>
                    <td style=" text-align:left;">
                        <select name="decl_port" class="text-input width155">
							<option value="">全部</option>
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port'];?>
" <?php if ($_smarty_tpl->tpl_vars['params']->value['decl_port']==$_smarty_tpl->tpl_vars['item']->value['ie_port']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port_name'];?>
</option>
							<?php } ?>
                         </select>
                    </td>
                </tr>
                <tr  class="advanced_element">
                    <td  class="text_right">进出口岸：</td>
                    <td style=" text-align:left;">
                        <select name="ie_port" class="text-input width155">
							<option value="">全部</option>
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port'];?>
" <?php if ($_smarty_tpl->tpl_vars['params']->value['ie_port']==$_smarty_tpl->tpl_vars['item']->value['ie_port']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port_name'];?>
</option>
							<?php } ?>
                         </select>
                    </td>
					<td  class="text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td style=" text-align:left;">
                        <input type="text" class="datepicker text-input width140" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['params']->value['created_start'],'%Y-%m-%d');?>
" name="created_start" readonly="true">&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;
                        <input type="text" class="datepicker text-input width140" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['params']->value['created_end'],'%Y-%m-%d');?>
" name="created_end" readonly="true">
                    </td>
                </tr>
				<tr   class="advanced_element">
					<td colspan="4" style="  text-align:left">
						<div class="advancedsearchsubmit">
							<a  onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
						</div>
					</td>
				</tr>
            </table>
        </div>
    </form>
</div>

<div class="btn_wrap">
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['status']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
    <input  class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['params']->value['status']==$_smarty_tpl->tpl_vars['k']->value){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"
            name="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
' id='statusBtn<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
' >
    <?php } ?>
</div>

<div class="clear"></div>
    <div class="grid">
        <form  method="post" id='asnDataForm' >
            <table   style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
                <thead>
				<tr>
					<th>载货单号</th>
					<th>申报口岸</th>
					<th>进出口岸</th>
					<th>总重量</th>
					<th>车牌号</th>
					<th>创建时间</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
				</thead>
			<tbody>
			<?php if ($_smarty_tpl->tpl_vars['result']->value!=''){?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['item']->value['sb_code'];?>
</td>
					<td><?php if (isset($_smarty_tpl->tpl_vars['iePortsCode']->value[$_smarty_tpl->tpl_vars['item']->value['decl_port']]['ie_port_name'])){?><?php echo $_smarty_tpl->tpl_vars['iePortsCode']->value[$_smarty_tpl->tpl_vars['item']->value['decl_port']]['ie_port_name'];?>
<?php }?></td>
					<td><?php if (isset($_smarty_tpl->tpl_vars['iePortsCode']->value[$_smarty_tpl->tpl_vars['item']->value['ie_port']]['ie_port_name'])){?><?php echo $_smarty_tpl->tpl_vars['iePortsCode']->value[$_smarty_tpl->tpl_vars['item']->value['ie_port']]['ie_port_name'];?>
<?php }?></td>
					<td><?php echo $_smarty_tpl->tpl_vars['item']->value['total_wt'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['item']->value['car_no'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['item']->value['add_time'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['statusArray']->value[$_smarty_tpl->tpl_vars['item']->value['status']];?>
</td>
					<td>
						<a class="view" onclick="parent.openMenuTab('/logistic/loading-order/detail?code=<?php echo $_smarty_tpl->tpl_vars['item']->value['sb_code'];?>
','载货单详细(<?php echo $_smarty_tpl->tpl_vars['item']->value['sb_code'];?>
)');return false;" href="#"
								   target="navTab" title=""><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
view<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
						<?php if ($_smarty_tpl->tpl_vars['item']->value['status']==3||$_smarty_tpl->tpl_vars['item']->value['status']==4||$_smarty_tpl->tpl_vars['item']->value['status']==5){?>
						<?php if ($_smarty_tpl->tpl_vars['item']->value['mark_delete']==0){?>
							<a class="view" onclick="applyDelete('<?php echo $_smarty_tpl->tpl_vars['item']->value['sb_code'];?>
')"><span>申请删除</span></a>
						<?php }?>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['item']->value['status']==6){?>
							<a href="/logistic/loading-order/print?code=<?php echo $_smarty_tpl->tpl_vars['item']->value['sb_code'];?>
" target="_blank">打印载货单</a>
						<?php }?>
					</td>
				</tr>
			<?php } ?>
			<?php }else{ ?>
			<tr>
				<td colspan="8" style="text-align:center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
			</tr>
			<?php }?>
			</tbody>
		</table>
	</form>
</div>
<div class="clear"></div>
<div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"></div>

<div id="mark-delete-dialog" title="申请删除" style="display:none">
	<form method="post" id="from1" name="from1">
	<input type="hidden" value="" id="sbCode" name="sbCode"/>
	<table cellspacing="0" cellpadding="0" class="formtable tableborder">
		<tr>
			<td>载货单号:</td>
			<td>
			<span id="sbCodeTd"></span>
			</td>
		</tr>
		<tr>
			<td>申请原因:</td>
			<td>
			<textarea name="reason" id="reason" style="width:95%;"></textarea>
			</td>
		</tr>
	</table>
	<form>
</div>

<script>
$(function(){
	$('.statusBtn').bind('click',function(){
		var status = $(this).attr('ref'); 
		$('[name=status]').val(status); 
		$('.statusBtn').removeClass('btn-active'); 
		$('#pagerForm #page').val(1); 
		$(this).addClass('btn-active'); 
		$('#pagerForm').submit(); 
	});
    $("#loadData").alterBgColor();
	
	$('#mark-delete-dialog').dialog({
		autoOpen: false,
		modal: false,
		bgiframe:true,
		width: 400,
		resizable: false,
		buttons:{
			'取消': function() {
				$(this).dialog('close');
			},'确认': function() {
				$(this).dialog('close');
				if('' == $("#reason").val()){
					alertTip('申请原因必填');
					return false;
				}
				$.ajax({
					type:"POST",
					async:false,
					dataType:"json",
					url:"/logistic/loading-order/mark-delete",
					data:$("#from1").serialize(),
					success:function (json) {
						alertTip(json.message);
					}
				})
			}
		}
	})
});
function applyDelete(sbCode){
	$("#reason").val('');
	$("#sbCodeTd").text(sbCode);
	$("#sbCode").val(sbCode);
	$('#mark-delete-dialog').dialog('open');
}
</script><?php }} ?>