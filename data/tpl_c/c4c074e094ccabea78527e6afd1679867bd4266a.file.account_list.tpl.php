<?php /* Smarty version Smarty-3.1.13, created on 2016-02-17 14:19:57
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\account\account_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1982056c4110ddc5316-03790934%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4c074e094ccabea78527e6afd1679867bd4266a' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\account\\account_list.tpl',
      1 => 1455677483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1982056c4110ddc5316-03790934',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'condition' => 0,
    'result' => 0,
    'row' => 0,
    'authStatus' => 0,
    'count' => 0,
    'privilege' => 0,
    'module' => 0,
    'right' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c4110e021186_47835486',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c4110e021186_47835486')) {function content_56c4110e021186_47835486($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
account_list1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
    </div>
    <div class="pageHeader">
        <form action="/merchant/account/list" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
            <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes"/>
            <div class="searchBar">
                <table>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
user_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        </td>
                        <td style="text-align: left;">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['account_name'];?>
" name="account_name" class="text-input width140 "/>
                        </td>
                        <td style="text-align:right;color:#000">
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
email_address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        </td>
                        <td style=" text-align:left">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['account_email'];?>
" name="account_email" class="text-input width140 "/>
                        </td>
                        <td style=" text-align:left">
                            <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                            <!--<a type="button" class="button" id="export">导出库存记录</a>-->
                        </td>
                    </tr>
                </table>

            </div>
        </form>
    </div>
</div>
<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
        <tr>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
account_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
user_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
email_address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
account_auth_status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <!--<th >更新时间</th>-->
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($_smarty_tpl->tpl_vars['result']->value!=''){?>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
            <tr>
                <td style="text-align:center" id="account-<?php echo $_smarty_tpl->tpl_vars['row']->value['account_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['account_code'];?>
</td>
                <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['row']->value['account_name'];?>
</td>
                <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['row']->value['account_email'];?>
</td>
                <td style="text-align:center"><?php if ($_smarty_tpl->tpl_vars['row']->value['account_status']=="1"){?>可用<?php }else{ ?>禁用<?php }?></td>
                <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['authStatus']->value[$_smarty_tpl->tpl_vars['row']->value['account_auth_status']];?>
</td>
                <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['row']->value['add_time'];?>
</td>
                <!--<td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['row']->value['account_update_time'];?>
</td>-->
                <td style="text-align:center">
                  <?php if ($_smarty_tpl->tpl_vars['row']->value['account_auth_status']==2||$_smarty_tpl->tpl_vars['row']->value['account_level']=='0'){?>
                      <?php if ($_smarty_tpl->tpl_vars['row']->value['account_status']=="1"){?>
                        <a href="javascript:void(0);" onclick="forbidden('/merchant/account/forbidden/type/notuse/account_id/<?php echo $_smarty_tpl->tpl_vars['row']->value['account_id'];?>
','notuse');">禁用</a>
                      <?php }elseif($_smarty_tpl->tpl_vars['row']->value['account_status']=="0"){?>
                        <a href="javascript:void(0);" onclick="foruse('/merchant/account/forbidden/type/use/account_id/<?php echo $_smarty_tpl->tpl_vars['row']->value['account_id'];?>
','use');">启用</a>
                      <?php }?>
                  <?php }else{ ?>
                    <!-- 取消分配功能
                      <a href="javascript:grantAccountPrivilege(<?php echo $_smarty_tpl->tpl_vars['row']->value['account_id'];?>
);">分配权限</a><span class="pipe">|</span>
                    -->
                    <?php if ($_smarty_tpl->tpl_vars['row']->value['account_status']=="1"){?>
                        <span>禁用</span>
                    <?php }elseif($_smarty_tpl->tpl_vars['row']->value['account_status']=="0"){?>
                        <span>启用</span>
                    <?php }?>
                  <?php }?>
                </td>
            </tr>
            <?php } ?>
        <?php }?>
        </tbody>
    </table>
</form>
<div class="clear"></div>
<div class="panelBar">
    <div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"  pageNumShown="10"></div>
</div>

<!-- 取消分配
<div id="changeAccountStatusTip" style="display:none;" title="信息提示"></div>
<div id="grantAccountPrivilege" style="display:none;" title="权限分配">
<form id="assigned-privilege-form">
  <table style="width:100%;border-collapse:separate;">
  <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['privilege']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
  <tr><td style="text-align:left;background-color:#f2f2f2;"><label><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
" id="privilege-module-<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['module']->value['display_name'];?>
</label></td></tr>
  <tr><td style="background-color:#ffffff;position:relative;text-align:left;">
    <?php  $_smarty_tpl->tpl_vars['right'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['right']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['module']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['right']->key => $_smarty_tpl->tpl_vars['right']->value){
$_smarty_tpl->tpl_vars['right']->_loop = true;
?>
    <div style="float:left;margin-left:20px;width:232px;"><label><input type="checkbox" module="<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
" id="privilege-<?php echo $_smarty_tpl->tpl_vars['right']->value['id'];?>
" name="privilege[<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
][]" value="<?php echo $_smarty_tpl->tpl_vars['right']->value['id'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['right']->value['display_name'];?>
</label></div>
    <?php } ?>
  <div style="clear:both;height:0;overflow:hidden;"></div></td></tr>
  <?php } ?>
  </table>
  <input type="hidden" name="account" id="privilege-account" value="" />
</form>
</div>
-->

<script>
jQuery(document).ready(function ($) {
  /* -- 取消权限分配
  $('#changeAccountStatusTip').dialog({
    autoOpen : false,
    modal : true,
    buttons : {
      '关闭' : function () {
        $(this).dialog('close');
      }
    }
  });
  
  $('#grantAccountPrivilege').dialog({
    width : 800,
    autoOpen : false,
    modal : true
  });
  */
 
  $('[id^="privilege-module-"]').click(function (e) {
    var module = $(this).attr('id').split('-').pop();
    var privilege = $('input[type="checkbox"][name^="privilege[' + module + ']"]');

    if ($(this).is(':checked')) {
      privilege.each(function () {
        $(this).attr('checked', true);
      });
    }
    else {
      privilege.each(function () {
        $(this).attr('checked', false);
      });
    }
  });

  $('input[type="checkbox"][name^="privilege["]').click(function (e) {
    var module = $('#privilege-module-' + $(this).attr('module'));
    var name = $(this).attr('name');
    var privilege = $('input[type="checkbox"][name="' + name + '"]');
    var privilegeChecked = $('input[type="checkbox"][name="' + name + '"]:checked');

    if ($(this).is(':checked') && privilege.length === privilegeChecked.length) {
      module.attr('checked', true);
    }
    else {
      if (module.is(':checked')) {
        module.attr('checked', false);
      }
    }
  });
});

// 账号权限分配
/*
function grantAccountPrivilege(id) {
  var account = $('#account-' + id).text();
  var tipDialog = $('#changeAccountStatusTip');
  $('#privilege-account').val(id);

  // 获取已分配的权限
  $.ajax({
    url : '/merchant/account/get-assigned-privilege',
    type : 'POST',
    dataType : 'json',
    async : false,
    data : {
      account : id
    },
    success : function (data) {
      if (1 == data.status) {
        for (var i in data.data) {
          var pc = data.data[i].items.length;

          for (var j in data.data[i].items) {
            $('#privilege-' + data.data[i].items[j].id).attr('checked', true);
          }

          if (pc == $('[name^="privilege[' + data.data[i].id + ']"]').size()) {
            $('#privilege-module-' +  data.data[i].id).attr('checked', true);
          }
        }
      }else {
        tipDialog.html(data.message).dialog('open');
      }
    },
    error : function () {
      // empty
    }
  });

  // 权限分配弹出框
  $('#grantAccountPrivilege').dialog({
    title : '【' + account + '】权限分配',
    autoOpen : true,
    buttons : {
      '取消' : function () {
        $(this).dialog('close');
      },
      '分配' : function () {
        var self = $(this);

        if ($('input[type="checkbox"][name^="privilege["]:checked').size() < 1) {
          tipDialog.html('至少需要分配一项权限').dialog('open');
          return ;
        }

        $.ajax({
          url : '/merchant/account/assign-privilege',
          type : 'POST',
          dataType : 'json',
          async : true,
          data : $('#assigned-privilege-form').serialize(),
          success : function (res) {
            if (1 == res.status) {
              tipDialog.html('子账号【' + account + '】' + res.message).dialog('open');
              self.dialog('close');
            }
            else {
              tipDialog.html(res.message).dialog('open');
            }
          },
          error : function () {
            tipDialog.html('请求无法到达，请稍候再试').dialog('open');
          }
        });
      }
    },
    close : function () {
      $('#assigned-privilege-form').find('input[type="checkbox"]').attr('checked', false);
    }
  });
}
*/
    function forbidden(url,type){
        $('<div title="Note(Esc)"><p align=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
disable_this_account_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p></div>').dialog({
            autoOpen: true,
            width: 300,
            height: 'auto',
            modal: true,
            show:"slide",
            position: ['center', 100],
            buttons: {
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
':function(){
                    $(this).dialog("close");
                },
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                    $(this).dialog("close");
                    $.ajax({
                        type:'POST',
                        url:url,
                        dataType:"json",
                        cache:false,
                        success:function(json){
                            if(json.ask=='1'){
                                alertTip(json.message,'500','auto','1');
                               // $('#pagerForm').submit();
                            }else{
                                var html = '';
                                html+=json.message;
                                alertTip(json.message,'500','auto','1');
                            }
                        },
                        error:function(){
                            alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                        }
                    });
                }
            },
            close: function() {

            }
        });
    }

    function foruse(url){
        $('<div title="Note(Esc)"><p align=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
enable_the_account_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p></div>').dialog({
            autoOpen: true,
            width: 300,
            height: 'auto',
            modal: true,
            show:"slide",
            position: ['center', 100],
            buttons: {
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
':function(){
                    $(this).dialog("close");
                },
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                    $(this).dialog("close");
                    $.ajax({
                        type:'POST',
                        url:url,
                        dataType:"json",
                        cache:false,
                        success:function(json){
                            if(json.ask=='1'){
                                alertTip(json.message,'500','auto','1');
                               // $('#pagerForm').submit();
                            }else{
                                var html = '';
                                html+=json.message;
                                alertTip(json.message,'500','auto','1');
                            }
                        },
                        error:function(){
                            alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                        }
                    });
                }
            },
            close: function() {

            }
        });
    }

    $(function(){
        //按默认类
        $("#finance-list-box").alterBgColor();
        $('#export').bind('click',function(){
            $('#export_dialog').dialog('open');
        });

    });
    //全选
    $('.checkAll').die('click').live('click',function(){
        if ($(this).is(':checked')) {
            $(".Arr").attr('checked', true);

        } else {
            $(".Arr").attr('checked', false);
        }
        changeTrColor();
    });
    /*伴随全选按钮是否选中而变色*/
    function changeTrColor(){
        $(".Arr").each(function(){
            _this = $(this);
            if($('.checkAll').is(':checked')){
                set_tr_class(_this.parent().parent(), true);
            }else{
                set_tr_class(_this.parent().parent(), false);
            }
        });
    }
</script><?php }} ?>