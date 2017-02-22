<?php /* Smarty version Smarty-3.1.13, created on 2016-03-02 19:25:45
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\storage\views\Inventory\inventory-modify-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181756d6cdb963b373-96793657%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3db2cd938033601a805705eb7feeca5da53cbda' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\storage\\views\\Inventory\\inventory-modify-list.tpl',
      1 => 1455677486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181756d6cdb963b373-96793657',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'params' => 0,
    'iePorts' => 0,
    'item' => 0,
    'statusArr' => 0,
    'k' => 0,
    'v' => 0,
    'result' => 0,
    'iePortsCode' => 0,
    'status' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d6cdb970b477_98524688',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d6cdb970b477_98524688')) {function content_56d6cdb970b477_98524688($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
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
        <h3 style="margin-left:5px">账册调整列表</h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/storage/inventory-modify/index" id="pagerForm" >
        <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['status'];?>
" name="status">
        <div class="searchBar ">
			<table class="searchbartable" cellspacing="2" cellpadding="2"  border="0" id="searchbox">
				<tbody>
				 <tr>
                    <td class="text_right" nowrap="nowrap" width="140">系统单号：</td>
                    <td style="text-align:left;">
                        <input class="text-input width140 leftloat" type="text"  name="im_code" value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value['im_code'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['im_code'];?>
<?php }?>">
						<div class="simplesearchsubmit" style="float:left;margin-top:4px;"> 
                             <a onclick="$('#pagerForm').submit()"  class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>   
                             <a class="switch_search_model" id='simple'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> 
                         </div>	
                    </td>
                    <td  class="text_right" nowrap="nowrap" class="advanced_element">
						</td>
                    <td class="advanced_element">
                    </td>
                </tr>
                <tr  class="advanced_element">
                    <td  class="text_right">申报口岸：</td>
                    <td style=" text-align:left;">
                        <select name="customs_code" class="text-input width155">
							<option value="">全部</option>
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port'];?>
" <?php if ($_smarty_tpl->tpl_vars['params']->value['customs_code']==$_smarty_tpl->tpl_vars['item']->value['ie_port']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port_name'];?>
</option>
							<?php } ?>
                         </select>
                    </td>
					<td  class="text_right">添加时间：</td>
                    <td style=" text-align:left;">
                        <input type="text" class="datepicker text-input width140" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['params']->value['created_start'],'%Y-%m-%d');?>
" name="created_start" readonly="true">&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;
                        <input type="text" class="datepicker text-input width140" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['params']->value['created_end'],'%Y-%m-%d');?>
" name="created_end" readonly="true">
                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['receiving_status'];?>
" name="receiving_status" id="receiving_status">
                    </td>
                </tr>
				<tr   class="advanced_element">
					<td colspan="4" style="  text-align:left">
						<div class="advancedsearchsubmit">
							<a  onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                                                         <a class="switch_search_model" id='advance'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> 
						</div>
					</td>
				</tr>
				</tbody>
			</table>
        </div>
    </form>
</div>
<div class="btn_wrap">
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['statusArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
		<table style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
			<thead>
			<tr>
				<th>系统单号</th>
				<th>申报口岸</th>
				<th>账册号</th>
				<th>申报日期</th>
				<th>创建时间</th>
				<th>状态</th>
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
						<td><a title="账册调整详细" onclick="parent.openMenuTab('/storage/inventory-modify/detail?code=<?php echo $_smarty_tpl->tpl_vars['item']->value['im_code'];?>
','账册调整详细(<?php echo $_smarty_tpl->tpl_vars['item']->value['im_code'];?>
)','');return false;" href="/storage/inventory-modify/detail?code=<?php echo $_smarty_tpl->tpl_vars['item']->value['im_code'];?>
" class="view"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['im_code'];?>
</span></a></td>
						<td><?php echo $_smarty_tpl->tpl_vars['iePortsCode']->value[$_smarty_tpl->tpl_vars['item']->value['customs_code']]['ie_port_name'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['ems_no'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['decl_time'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['add_time'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['status']->value[$_smarty_tpl->tpl_vars['item']->value['status']];?>
</td>
					</tr>
				<?php } ?>
				<?php }else{ ?>
				<tr>
					<td colspan="6" style="text-align:center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
<script>
$(function(){
    $("#loadData").alterBgColor();
	$('.statusBtn').bind('click',function(){
		var status = $(this).attr('ref'); 
		$('[name=status]').val(status); 
		$('.statusBtn').removeClass('btn-active'); 
		$('#pagerForm #page').val(1); 
		$(this).addClass('btn-active'); 
		$('#pagerForm').submit(); 
	});
	$("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"bh_receiving_search_mode"});
});
</script><?php }} ?>