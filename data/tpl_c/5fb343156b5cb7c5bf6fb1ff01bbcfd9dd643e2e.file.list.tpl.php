<?php /* Smarty version Smarty-3.1.13, created on 2016-02-17 14:19:49
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\tax\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2204756c41105dc8ba3-20777959%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5fb343156b5cb7c5bf6fb1ff01bbcfd9dd643e2e' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\tax\\list.tpl',
      1 => 1455677482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2204756c41105dc8ba3-20777959',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'condition' => 0,
    'taxListRows' => 0,
    'taxListRow' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c41105f02a31_80341600',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c41105f02a31_80341600')) {function content_56c41105f02a31_80341600($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all  ui-widget ui-widget-content" >
    <div class="content-box-header">
        <h3 style="margin-left:5px">专用缴款书（税费）</h3>
        <div class="clear"></div>
    </div>

    <form name="searchASNForm"  method="post" action="/merchant/tax/list" id="pagerForm">
        <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
        <div class="searchBar">
            <table>
                <tr>
                    <td class="form_input">  
                        <label>物品清单号：
                            <input type="text" name="pim_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['pim_code'];?>
" class="text-input fix-small-input"/>
                        </label>  
                        <label>订单号：
                            <input type="text" name="order_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['order_code'];?>
" class="text-input fix-small-input"/>
                        </label>     
                        <label>专用缴款书收编号（税费号）：
                            <input type="text" name="tax_no" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['tax_no'];?>
" class="text-input fix-small-input"/>
                        </label> 
                        <label>
                            <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> 
                        </label> 
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>
<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list formtable tableborder" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
        <tr>
            <th>物品清单号</th>
            <th>订单号</th>
            <th>专用缴款书收编号(税费号)</th>
            <th>币种</th>          
            <th>完税价格</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            <?php if (!empty($_smarty_tpl->tpl_vars['taxListRows']->value)){?>
            <?php  $_smarty_tpl->tpl_vars['taxListRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['taxListRow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['taxListRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['taxListRow']->key => $_smarty_tpl->tpl_vars['taxListRow']->value){
$_smarty_tpl->tpl_vars['taxListRow']->_loop = true;
?>
            <tr>
                <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['taxListRow']->value['pim_code'];?>
</td>
                <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['taxListRow']->value['order_code'];?>
</td>
                <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['taxListRow']->value['tax_no'];?>
</td>
                <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['taxListRow']->value['tax_total'];?>
</td>
                <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['taxListRow']->value['decl_total'];?>
</td>
                <td class="text_center">
                    <a href="javascript:void(0);" onclick="parent.openMenuTab('/merchant/tax/view/tax_no/<?php echo $_smarty_tpl->tpl_vars['taxListRow']->value['tax_no'];?>
','查看税费:<?php echo $_smarty_tpl->tpl_vars['taxListRow']->value['tax_no'];?>
','<?php echo $_smarty_tpl->tpl_vars['taxListRow']->value['tax_no'];?>
');return false;">查看 </a>
                </td>
            </tr>
            <?php } ?>
            <?php }?>
        </tbody>
    </table>
</form>
<div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"  pageNumShown="10"></div><?php }} ?>