<?php /* Smarty version Smarty-3.1.13, created on 2016-12-19 09:41:04
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\default\welcome.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2820656c3e80a7b01c2-37609253%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bb8f2883fd055971ed10d0402619347b976997a' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\default\\welcome.tpl',
      1 => 1463103216,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2820656c3e80a7b01c2-37609253',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c3e80a824674_52945349',
  'variables' => 
  array (
    'customerAPIArray' => 0,
    'customer_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c3e80a824674_52945349')) {function content_56c3e80a824674_52945349($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
	.welcome { height:650px; width: 1165px; background: url('/images/104.png') no-repeat center; background-size:50% auto; background-size:auto 50%; border-bottom:none ;}
</style>

<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <span style="display:block; float: left;">
            <h3 class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
interface_info<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        </span>
        <span id="interface" style="display:block; float: right; padding-right: 10px;">
            <?php if ($_smarty_tpl->tpl_vars['customerAPIArray']->value['ca_token']){?>
                <!--<a onclick="changeToken('<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
');" href="javascript:void(0);"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
change_interface_info<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
            <?php }else{ ?>
                <a onclick="requireToken('<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
');" href="javascript:void(0);"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
request_interface_info<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
            <?php }?>
        </span>
        <div class="clear"></div>
    </div>
    <table cellspacing="0" cellpadding="0" class="formtable">
        <tbody>
            <tr>
                <td style="width:50px;">Token</td>
                <td id="ca_token"><?php echo $_smarty_tpl->tpl_vars['customerAPIArray']->value['ca_token'];?>
</td>
            </tr>
            <tr>
                <td>Key</td>
                <td id="ca_key"><?php echo $_smarty_tpl->tpl_vars['customerAPIArray']->value['ca_key'];?>
</td>
            </tr>
        </tbody>
    </table>
    <div class="clear"></div>
</div>

<div class="welcome btn_wrap"></div>
<!--<img src="/images/104.png" width="1164" height="640" />-->

<script type="text/javascript">
function changeToken(id){
    $.ajax({
        async:true,
        type:'POST',
        url:'/merchant/customer/change-token/id/'+id,
        dataType:'json',
        success:function(json){
            if(json.state=="1"){
                $("#ca_token").html(json.data.token);
                $("#ca_key").html(json.data.key);
                alertTip('接口变更成功!');
            }else{
                alertTip('接口变更失败!');
            }
        }
    });
}

function requireToken(id){
    $.ajax({
        async:true,
        type:'POST',
        url:'/merchant/customer/require-token/id/'+id,
        dataType:'json',
        success:function(json){
            if(json.state=="1"){
                $("#ca_token").html(json.data.token);
                $("#ca_key").html(json.data.key);
                alertTip('接口申请成功!');
                $("#interface").html('<a onclick="changeToken(\'<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
\');" href="javascript:void(0);">变更接口信息</a>');
            }else{
                alertTip('接口申请失败!');
            }
        }
    });
}
</script><?php }} ?>