<?php /* Smarty version Smarty-3.1.13, created on 2015-11-13 15:02:35
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\account\account_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:534856458b0b98fed0-27145894%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87254865c351f38eb3173fce51e5c05dc922ff3f' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\account\\account_add.tpl',
      1 => 1446033128,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '534856458b0b98fed0-27145894',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56458b0ba29596_50662156',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56458b0ba29596_50662156')) {function content_56458b0ba29596_50662156($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
add_account<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
    </div>

    <form id="addAcount" class="pageForm required-validate"action="/merchant/account/add">
        <fieldset>
            <table>
                <tr>
                    <td class="form_title nowrap text_right" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
user_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td class="form_input">
                        <input type="text" value="" placeholder="" size="45" class="fix-medium1-input text-input" id="account_name" name="account_name">
                        <strong>*</strong>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
email_address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td class="form_input">
                        <input type="text" placeholder="" class="fix-medium1-input required text-input " name="account_email" value="" size="45">
                        <strong>*</strong>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td class="form_input">
                        <input type="password" value="" placeholder="" size="45" class="fix-medium1-input text-input" id="account_password" name="account_password">
                        <strong>* </strong>
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
change_password_tip1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
confirm_password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td class="form_input">
                        <input type="password" value="" placeholder="" size="45" class="fix-medium1-input text-input" id="confirm_password" name="confirm_password">
                        <strong>* </strong>
                         <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
change_password_tip1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    </td>
                </tr>
                <tr>
                    <td class="form_title"></td>
                    <td class="form_input">
                        <a onclick="dosubmit();return false;" class="button tijiao" href="void(0)"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

</div>
<script type="text/javascript">
    $(function(){
        $("#addAcount")[0].reset();
    })
    function dosubmit(){
        var formdata =  $("#addAcount").serialize();
        var account_name = $("[name='account_name']").val();
        var account_email = $('[name="account_email"]').val();
        var password1 = $('[name="account_password"]').val();
        var password2 = $('[name="confirm_password"]').val();
        var errorHtml = "";
        if(account_name==""){
            errorHtml+='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
username_require<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>';
        }
        if(account_email==""){
            errorHtml+="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
email_required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
        }
        if(password1==""){
            errorHtml+="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
password_required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
        }
        if(password2==""){
            errorHtml+="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
confirm_password_required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
        }
        if(password1!=password2){
            errorHtml+="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
the_password_and_confirm_password_does_not_match<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
        }
        if(errorHtml!=""){
            alertTip(errorHtml);
            return false;
        }
        var myoptions = {
            url:'/merchant/account/add',
            type:'POST',
            cache:false,
            dataType:'json',
            processData:true,
            data:formdata,
            success: function(json){
                var html ="";
                if(json.ask=='0'){
                    if(typeof (json.error)!="undefined"&&json.error!=""){
                        $.each(json.error,function(k,v){
                            html+=v+'</br>';
                        })
                    }
                    alertTip(html);
                }else{
                    $("#addAcount")[0].reset();
                    alertTip(json.message);
                }
            }
        };
        $.ajax(myoptions);
        return false;
    }
</script><?php }} ?>