<?php /* Smarty version Smarty-3.1.13, created on 2014-07-10 09:09:05
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/distributor/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77347998353bde7b1bc93f0-12545172%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20cdef69139dc05baa4728e06efdcf6a35eab6bc' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/distributor/list.tpl',
      1 => 1404894868,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77347998353bde7b1bc93f0-12545172',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'code' => 0,
    'name' => 0,
    'status' => 0,
    'data' => 0,
    'record' => 0,
    'total' => 0,
    'size' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53bde7b1ccc213_50835298',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bde7b1ccc213_50835298')) {function content_53bde7b1ccc213_50835298($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style type="text/css">
form table .button:hover {
  text-decoration: underline;
}
</style>

<div class="content-box ui-tabs ui-corner-all ui-widget ui-widget-content" style="padding-bottom:10px;">
  <div class="content-box-header">
    <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
  </div>

  <form method="post" action="/merchant/distributor/list" id="distributor-search-form">
    <table>
      <tr>
        <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
        <td class="form_input">
          <input class="text-input width180" type="text" name="distributor_code" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
        </td>
        <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
        <td class="form_input">
          <input class="text-input width180" type="text" name="distributor_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
        </td>
        <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorStatus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
        <td>
          <select class="text-input" name="distributor_status">
            <option value="-1"<?php if (-1==$_smarty_tpl->tpl_vars['status']->value){?> selected="selected"<?php }?>><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorStatusAll<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
            <option value="1"<?php if (1==$_smarty_tpl->tpl_vars['status']->value){?> selected="selected"<?php }?>><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorStatusEnabled<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
            <option value="0"<?php if (0==$_smarty_tpl->tpl_vars['status']->value){?> selected="selected"<?php }?>><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorStatusDisabled<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <span class="button" id="distributor-search-action"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorOperationSearch<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
          <span class="button" id="distributor-add-action"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorOperationAdd<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
        </td>
      </tr>
    </table>
  </form>
</div>

<table class="table formtable tableborder" id="distributor-list-table" style="margin:10px 0;">
  <thead>
    <tr style="height:25px;">
      <th style="width:20%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
      <th style="width:30%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
      <th style="width:10%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorStatus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
      <th style="width:20%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorCreatedTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
      <th style="width:20%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorOperation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    </tr>
  </thead>
  <tbody>
  <?php  $_smarty_tpl->tpl_vars['record'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['record']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['record']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['record']->key => $_smarty_tpl->tpl_vars['record']->value){
$_smarty_tpl->tpl_vars['record']->_loop = true;
 $_smarty_tpl->tpl_vars['record']->index++;
?>
    <tr <?php if (0==$_smarty_tpl->tpl_vars['record']->index%2){?>class="even"<?php }else{ ?>class="odd"<?php }?>>
      <td style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['record']->value['distributor_code'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['record']->value['distributor_name'];?>
</td>
      <td style="text-align:center;">
        <?php if (0==$_smarty_tpl->tpl_vars['record']->value['distributor_status']){?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorStatusDisabled<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }elseif(1==$_smarty_tpl->tpl_vars['record']->value['distributor_status']){?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorStatusEnabled<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }else{ ?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorStatusUnknown<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }?>
      </td>
      <td style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['record']->value['distributor_created'];?>
</td>
      <td style="text-align:center;">
        <a href="javascript:void(0);" class="operation-edit" link="/merchant/distributor/edit/id/<?php echo $_smarty_tpl->tpl_vars['record']->value['distributor_id'];?>
"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorOperationEdit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>&nbsp;
        <a href="javascript:void(0);" class="operation-view" link="/merchant/distributor/view/id/<?php echo $_smarty_tpl->tpl_vars['record']->value['distributor_id'];?>
"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorOperationView<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
      </td>
    </tr>
  <?php }
if (!$_smarty_tpl->tpl_vars['record']->_loop) {
?>
    <tr class="even"><td colspan="6" style="text-align:center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorListNoData<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td></tr>
  <?php } ?>
  </tbody>
</table>

<?php if ($_smarty_tpl->tpl_vars['total']->value>0){?>
<form action="/merchant/distributor/list" method="post" id="pagerForm">
  <input type="hidden" name="page" value="1" id="page" />
  <input type="hidden" name="size" value="<?php echo $_smarty_tpl->tpl_vars['size']->value;?>
" id="pageSizes" />
  <input type="hidden" name="distributor_code" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
  <input type="hidden" name="distributor_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
  <input type="hidden" name="distributor_status" value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
" />
</form>

<div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['size']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" pageNumShown="10"></div>
<?php }?>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function ($) {
  $('#distributor-search-action').click(function (e) {
    $('#distributor-search-form').submit();
  });

  $('#distributor-add-action').click(function (e) {
    if (window.self !== window.top) {
      window.parent.openMenuTab('/merchant/distributor/add', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorAdd<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'tab-distributor-add', 0);
    }
    else {
      window.location.href = '/merchant/distributor/add';
    }
  });

  $('.operation-edit').click(function (e) {
    var link = $(this).attr('link');

    if (window.self !== window.top) {
      window.parent.openMenuTab(link, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorEdit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'tab-distributor-edit', 0);
    }
    else {
      window.location.href = link;
    }
  });

  $('.operation-view').click(function (e) {
    var link = $(this).attr('link');

    if (window.self !== window.top) {
      window.parent.openMenuTab(link, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorView<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'tab-distributor-view', 0);
    }
    else {
      window.location.href = link;
    }
  });
});
//]]>
</script>
<?php }} ?>