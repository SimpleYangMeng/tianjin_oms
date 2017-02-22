<?php /* Smarty version Smarty-3.1.13, created on 2014-07-10 08:58:55
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/purchaseOrder/purchase-order-batch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:206685741653bde54f4c5653-63895643%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddc0f6eef3fb938ea092e5790ae54382f97be137' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/purchaseOrder/purchase-order-batch.tpl',
      1 => 1404895719,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206685741653bde54f4c5653-63895643',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'uploadinfo' => 0,
    'error' => 0,
    'uploadResult' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53bde54f535f50_84602832',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bde54f535f50_84602832')) {function content_53bde54f535f50_84602832($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style type="text/css">
    .tableborder th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;
        width: 30%;
    }
    .tableborder td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    .message-warning
    {
        color: #5f5200;
    }
    .error
    {
        margin: 0;
        padding: 8px 0 0 0;
        height: 1%;
        display: block;
        clear: both;
        overflow: hidden;
        color: #FF0000;
        padding-left: 20px;
    }
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
purchase-order-batch-upload<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
    </div>
   <form action="/merchant/purchase-order-batch-upload/batchcheck" enctype="multipart/form-data" method="post" id='batchUploadForm' onsubmit="return checkform()">
    <table  cellspacing="0" cellpadding="0" class="tableborder">
    <tr>
     <th>请选择要上传的文件：</th>
     <td><input type="file" size="25" id="PurchaseOrderFile" name="PurchaseOrderFile" class="text-input"></td>
    </tr>
    <tr>
       <th>样例文件下载:</th>
       <td>
           <img style="width:25px;" src="/images/download.png">
           <a href="/merchant/purchase-order-batch-upload/down-order-templete/file/orderupload">批量上传模板</a></td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left:35%;">
            <input class="button" type="submit" value="批量上传">
        </td>
    </tr><!--formtable tableborder-->
    </table>
   </form>
</div>
<?php if (isset($_smarty_tpl->tpl_vars['uploadinfo']->value)&&($_smarty_tpl->tpl_vars['uploadinfo']->value['ask']=='0')){?>
<div class="message-warning">
   <div><?php echo $_smarty_tpl->tpl_vars['uploadinfo']->value['message'];?>
</div>
    <?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['uploadinfo']->value['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
    <div class="error"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
    <?php } ?>
</div>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['uploadResult']->value)&&$_smarty_tpl->tpl_vars['uploadResult']->value!=''){?>
<div class="message-warning" style="display:none;">
<?php echo $_smarty_tpl->tpl_vars['uploadResult']->value;?>

</div>
<?php }?>
<script type="text/javascript">
    function checkform(){
        if(!$('#PurchaseOrderFile').val()){
            alertTip('必须选择文件');
            return false;
        }
        return true;
    }
    $(function(){
        $('.message-warning').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 800,
            height:'auto',
            resizable:false,
            close: function() {
                //window.location.href='/merchant/order/listjh';
            }
        });
        <?php if (isset($_smarty_tpl->tpl_vars['uploadResult']->value)&&$_smarty_tpl->tpl_vars['uploadResult']->value!=''){?>
            $('.message-warning').show().dialog('open');
        <?php }?>
    });
</script><?php }} ?>