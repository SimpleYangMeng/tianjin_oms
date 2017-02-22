<?php /* Smarty version Smarty-3.1.13, created on 2014-07-10 09:10:53
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/distributor/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:113860247253bde81d15d130-25482546%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a490a6a3087a8674af701e0619c0ef9dafc39e75' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/distributor/edit.tpl',
      1 => 1404894867,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113860247253bde81d15d130-25482546',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tip' => 0,
    'message' => 0,
    'distributorId' => 0,
    'code' => 0,
    'name' => 0,
    'status' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53bde81d1e8c58_73952086',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bde81d1e8c58_73952086')) {function content_53bde81d1e8c58_73952086($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style type="text/css">
form table .button:hover {
  text-decoration: underline;
}

.ui-icon-circle-close {
  cursor: pointer;
}

.distributor-back {
  color: #cd0a0a;
  cursor: pointer;
}

.distributor-back:hover {
  text-decoration: underline;
}
</style>

<div class="content-box ui-tabs ui-corner-all ui-widget ui-widget-content">
  <div class="content-box-header">
    <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorEdit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
  </div>

  <?php if ('info'==$_smarty_tpl->tpl_vars['tip']->value){?>
  <div class="ui-widget" style="margin:10px 0;" id="distributor-tip-info">
    <div style="padding:10px 10px;" class="ui-state-highlight ui-corner-all">
      <p>
        <span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
        <strong id="distributor-tip-info-content"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorEditSuccess<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
，<span class="distributor-back" id="distributor-list-view"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorListView<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></strong>
        <span style="float: right; margin-right: .3em;" class="ui-icon ui-icon-circle-close"></span>
      </p>
    </div>
  </div>
  <?php }elseif('error'==$_smarty_tpl->tpl_vars['tip']->value){?>
  <div class="ui-widget" style="margin:10px 0;" id="distributor-tip-alert">
    <div style="padding:10px 10px;" class="ui-state-error ui-corner-all">
      <p>
        <span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
        <strong id="distributor-tip-alert-content"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</strong>
        <span style="float: right; margin-right: .3em;" class="ui-icon ui-icon-circle-close"></span>
      </p>
    </div>
  </div>
  <?php }?>

  <form method="post" action="/merchant/distributor/edit/id/<?php echo $_smarty_tpl->tpl_vars['distributorId']->value;?>
" id="distributor-edit-form">
    <table>
      <tr>
        <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
        <td class="form_input">
          <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8', true);?>

          <input class="text-input width195" type="hidden" name="distributor_code" id="distributor-code" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
        </td>
      </tr>
      <tr>
        <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
        <td class="form_input">
          <input class="text-input width195" type="text" name="distributor_name" id="distributor-name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
" /> <strong>*</strong>
        </td>
      </tr>
      <tr>
        <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorStatus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
        <td>
          <select class="text-input" name="distributor_status" id="distributor-status">
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
        <td colspan="2">
          <input type="submit" class="button" id="distributor-edit-action" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorOperationSave<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"/>
        </td>
      </tr>
    </table>
  </form>
</div>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function ($) {
  $('#distributor-list-view').click(function (e) {
    if (window.self !== window.top) {
      window.parent.openMenuTab('/merchant/distributor/list', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DistributorList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'tab-distributor-list', 1);
    }
    else {
      window.location.href = '/merchant/distributor/list';
    }
  });

  $('.ui-icon-circle-close').click(function (e) {
    $('#distributor-tip-info').hide();
    $('#distributor-tip-alert').hide();
  });
});
//]]>
</script>
<?php }} ?>