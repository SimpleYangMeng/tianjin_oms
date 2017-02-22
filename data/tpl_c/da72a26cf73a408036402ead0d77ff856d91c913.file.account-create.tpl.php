<?php /* Smarty version Smarty-3.1.13, created on 2016-03-03 16:15:30
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\storage\views\book\account-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2818256d7f1875ac571-60049511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da72a26cf73a408036402ead0d77ff856d91c913' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\storage\\views\\book\\account-create.tpl',
      1 => 1456992928,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2818256d7f1875ac571-60049511',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d7f1876655f3_56542496',
  'variables' => 
  array (
    'ieTypeRows' => 0,
    'k' => 0,
    'ietypeRow' => 0,
    'customsCodeRows' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d7f1876655f3_56542496')) {function content_56d7f1876655f3_56542496($_smarty_tpl) {?><style type="text/css">
.content-box{padding:10px;}
.form-table{width:100%;font-size:13px;}
.form-table th{text-align:right;font-weight:bold;padding:8px 5px;border:1px solid #D8E0E4; background:none repeat scroll 0 0 #e1effb;}
.form-table td{padding:8px 3px;border:1px solid #D8E0E4;text-align:center;}
.form-table td.left{width:20%;font-weight:bold;text-align:right;border:1px solid #D8E0E4;}
.form-table td.right{width:30%;text-align:left;border:1px solid #D8E0E4;}
.form-table td.error{display:none;color:red;background:#FDFFD2;text-align:center;border:1px solid #D8E0E4;}
.form-table td textarea.medium-input,.form-table .text-input{height:14px;resize:none;  border-radius: 2px;}
.form-input{height:28px;outline:0;border:1px solid #D8E0E4;padding:0 5px;}
.form-input,.text-input{width:160px;height:28px;outline:0;border:1px solid #D8E0E4;padding:0 5px;}
</style>

<link rel="stylesheet" type="text/css" href="/js/nice-validator-0.8.1/jquery.validator.css" />
<script type="text/javascript" src="/js/nice-validator-0.8.1/jquery.validator.js"></script>
<script type="text/javascript" src="/js/nice-validator-0.8.1/local/zh-CN.js"></script>

<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div>
        <div class="content-box-header">
            <h3  class="clearborder" style="margin-left:5px;">账册备案</h3>
        </div>
    </div>
    <form class="pageForm required-validate" id="accountBookForm" action="/storage/account-book/add">
        <table class="form-table">
             
            <tr>
                <td class="form_title nowrap text_right">进出类型：</td>
                <td class="form_input">
                    <select name="ie_type" id='ieType' data-rule="required" class="text-input fix-medium1-input">
                        <option value="">请选择</option>
                        <?php  $_smarty_tpl->tpl_vars['ietypeRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ietypeRow']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ieTypeRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ietypeRow']->key => $_smarty_tpl->tpl_vars['ietypeRow']->value){
$_smarty_tpl->tpl_vars['ietypeRow']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['ietypeRow']->key;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['ietypeRow']->value;?>
</option>
                        <?php } ?>
                    </select>
                    <strong>*</strong>
                    <span class="msg-box n-right" style="position:static;" for="ieType"></span>
                </td>
                <td class="form_title nowrap text_right">主管海关代码：</td>
                <td class="form_input">
                    <select name="customs_code" data-rule="required" id='customsCode' class="text-input fix-medium1-input">
                        <option value="">请选择</option>
                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customsCodeRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['ie_port'];?>
'><?php echo $_smarty_tpl->tpl_vars['c']->value['ie_port'];?>
-<?php echo $_smarty_tpl->tpl_vars['c']->value['ie_port_name'];?>
</option>
                        <?php } ?>
                    </select>
                    <strong>*</strong>
                    <span class="msg-box n-right" style="position:static;" for="customsCode"></span>
                </td>
            </tr>

            <tr>
                <td class="form_title nowrap text_right">仓储企业代码：</td>
                <td class="form_input">
                    <input class="text-input fix-medium1-input" data-rule="required" type="text"  id="tradeCo" name="trade_co">
                    <strong>*</strong>
                    <span class="msg-box n-right" style="position:static;" for="tradeCo"></span>
                </td>

                <td class="form_title nowrap text_right">企业海关编码：</td>
                <td class="form_input">
                    <input class="text-input fix-medium1-input" data-rule="required;length[10]" type="text"  id="customsUsingCode" name="customs_using_code" data-msg-length="海关进出口唯一编码长度长10">
                    <strong>*</strong>
                    <span class="msg-box n-right" style="position:static;" for="customsUsingCode"></span>
                </td>
                
            </tr>
            <tr>
                <td class="form_title nowrap text_right">经营单位名称：</td>
                <td class="form_input">
                    <input class="text-input fix-medium1-input" data-rule="required" type="text"  id="tradeName" name="trade_name">
                    <strong>*</strong>
                    <span class="msg-box n-right" style="position:static;" for="tradeName"></span>
                </td>
                <td class="form_title nowrap text_right">仓库面积：</td>
                <td class="form_input">
                    <input class="text-input fix-medium1-input" 
                    data-rule="required;area"                     
                    data-rule-area="/^[1-9][0-9]*(\.[0-9]{1,2})?$/" 
                    data-msg-area="仓库面积必须大于1并且最多只能两位小数！" 
                    type="text"  id="area" name="area">
                    <strong>*</strong>
                    <span class="msg-box n-right" style="position:static;" for="area"></span>
                </td>               
            </tr>
            <tr>
                <td class="form_title nowrap text_right">仓库地址：</td>
                <td class="form_input" colspan="3">
                    <input class="text-input medium-input" data-rule="required" type="text"  id="address" name="address">
                    <strong>*</strong>
                    <span class="msg-box n-right" style="position:static;" for="address"></span>
                </td>
            </tr>
            <tr>
                <td class="form_title nowrap text_right">联系人：</td>
                <td class="form_input">
                    <input class="text-input fix-medium1-input" 
                    data-rule="required;length[2~6]" 
                    data-msg-length="联系人长度加2到6位！" 
                    type="text"  id="contacter" name="contacter">
                    <strong>*</strong>
                    <span class="msg-box n-right" style="position:static;" for="contacter"></span>
                </td>
                <td class="form_title nowrap text_right">联系电话：</td>
                <td class="form_input" colspan="3">
                    <input class="text-input fix-medium1-input" 
                    data-rule="required;tel" 
                    data-rule-mobile="/^((0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?)|(^1[3|4|5|8][0-9]\d{4,8})$/, '联系电话格式不正确！']" 
                    type="text"  id="phoneNo" name="phone_no">
                    <strong>*</strong>
                    <span class="msg-box n-right" style="position:static;" for="phoneNo"></span>
                </td>
            </tr>
            <tr>
                <td class="form_title nowrap text_right">备注：</td>
                <td colspan="3" class="form_input"><textarea name="note" id="note" style="width: 568px; height: 69px;"></textarea></td>
            </tr>
            <tr>
                <th colspan="4"><input type="submit" class="form-input" value="提交账册备案信息" /></th>
            </tr>

        </table>
    </form>
</div>

<script type="text/javascript">
$(function () {
    $('#accountBookForm').bind('valid.form', function(){
        // alert(1);
        $.ajax({
            url: '/storage/account-book/add',
            type: 'POST',
            data: $(this).serialize(),
            dataType:'json',
            success: function(json){
                if(json.ask == 1){
                    alertTip(json.message , 500 , 'auto' , 1);
                }else{
                    var message = '';

                    if(typeof (json.error)!="undefined"&&json.error!=""){
                        $.each(json.error, function(k, v){
                            message += '<p>'+v+'</p>';
                        });
                    }
                    alertTip(message);
                }
            }
        });
        return false;
    });
});
</script><?php }} ?>