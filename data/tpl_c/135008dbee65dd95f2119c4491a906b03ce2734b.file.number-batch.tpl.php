<?php /* Smarty version Smarty-3.1.13, created on 2014-07-04 19:51:08
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/order/number-batch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:164075821453b6952ca7aad7-13246965%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '135008dbee65dd95f2119c4491a906b03ce2734b' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/order/number-batch.tpl',
      1 => 1387879616,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '164075821453b6952ca7aad7-13246965',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'uploadData' => 0,
    'order' => 0,
    'index' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b6952caeac02_85466252',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b6952caeac02_85466252')) {function content_53b6952caeac02_85466252($_smarty_tpl) {?><script type="text/javascript">

    function   checkAll1(){

        if($('#checkAll').is(':checked')){
            $('.checked').attr('checked',true)
        }else{
            $('.checked').attr('checked',false)
        }
    }
    function  submitBatch(){
        var checked = false;
        $('.checked').each(function(){
            if($(this).is(':checked')){
                checked = true;
            }
        })

        if(checked == false){
            alertTip('请选择需要操作的订单');
            return false;
        }
        if($('#selectBatch').val() == ''){
            alertTip('请选择要操作的订单行');
            return false;
        }
        $('#datafrom').submit();
    }

</script>
<style>
    <!--
    #editUpload table,  #editUpload td,#editUpload th{
        border: solid 1px  #AAFFFF;

        border-collapse:collapse;
        text-align:center;
    }
    #editUpload th{
        -moz-background-clip:border;
        -moz-background-inline-policy:continuous;
        -moz-background-origin:padding;
        background:#F79732 none repeat scroll 0 0;
        color:#FFFFFF;

        line-height:30px;

    }
    .tablebiaoge{ border-collapse:collapse}
    .tablebiaoge td{border:1px solid #AAFFFF}

    .error{
        float: left;
        margin-right: 20px;
        border:1px solid red;
    }


    -->
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px">订单收件人证件信息批量上传</h3>
        <div class="clear"></div>
    </div>


    <form id="datafrom" action="/merchant/order-upload/import-batch-number" method="post">

        <table cellpadding="0" cellspacing="0" style="width:100%">
            <tbody>
            <tr style="background-color: rgb(170, 255, 255);">
                <th  align="center" bgcolor="#AAFFFF"><input id="checkAll" checked="checked" onclick="checkAll1();" type="checkbox">序号</th>
                <th>订单号</th>
                <th>交易订单号</th>
                <th>收件人证件</th>
                <th>收件人证件号码</th>
            </tr>
            </tbody>
            <?php  $_smarty_tpl->tpl_vars['order'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['order']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['uploadData']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['order']->key => $_smarty_tpl->tpl_vars['order']->value){
$_smarty_tpl->tpl_vars['order']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['order']->key;
?>
            <tr >
                <td style="text-align: center;">
                    <?php if ($_smarty_tpl->tpl_vars['order']->value['is_valid']=='1'){?>
                        <input class="checked" type="checkbox"  checked="true" value="<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name="select[]">
                    <?php }?>
                </td>
                <td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['order']->value['order_code'];?>
</td>
                <td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['order']->value['reference_no'];?>
</td>
                <td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['order']->value['IdTypeStr'];?>
</td>
                <td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['order']->value['idNumber'];?>
</td>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['order']->value['is_valid']=='0'){?>
            <tr>
                <td colspan="5" style="border-bottom:1px solid #0000ff;">
                    <?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order']->value['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
                    <div class="error">
                        <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

                    </div>
                    <?php } ?>
                </td>
            </tr>
            <?php }?>
            <?php } ?>

        </table>


        <DIV align="center">
            <INPUT id="checkbuttom" onclick="submitBatch();" class='button' type="button" value="导入订单数据">
        </DIV>
    </form>
</div>
<?php }} ?>