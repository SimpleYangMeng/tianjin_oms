<?php /* Smarty version Smarty-3.1.13, created on 2016-12-19 09:42:49
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\order\order-view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:902158573b190556b2-03768592%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f77586266ad3f9f3dbb36857cc42a6c2c8c59d7' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\order\\order-view.tpl',
      1 => 1455677483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '902158573b190556b2-03768592',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'orderRow' => 0,
    'ieport' => 0,
    'currency' => 0,
    'orderAddressBookRow' => 0,
    'orderProductRows' => 0,
    'row' => 0,
    'orderLogRows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_58573b191d4e30_42461094',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58573b191d4e30_42461094')) {function content_58573b191d4e30_42461094($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all" >
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">订单详情</h3>
    </div>
<div style="margin-right: 0px; padding: 6px;" class="content-box nbox_c marB10 product_detail cl">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder" width='100%'>
        <tr>
            <th width="15%">进出口类型:</th>
            <td width="30%"><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['ie_name'];?>
【<?php echo $_smarty_tpl->tpl_vars['orderRow']->value['ie_type'];?>
】</td>
            <th width="15%">主管海关代码:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['ieport']->value[$_smarty_tpl->tpl_vars['orderRow']->value['customs_code']];?>
【<?php echo $_smarty_tpl->tpl_vars['orderRow']->value['customs_code'];?>
】</td>
        </tr>
        <tr>
            <th>订单编号:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['order_code'];?>
</td>
            <th>交易订单号:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['reference_no'];?>
</td>
        </tr>
        <tr>
            <th>海关审核状态:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['customs_status'];?>
</td>
            <th>海关状态:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['order_status'];?>
</td>
        </tr>
        <tr>
            <th>业务状态:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['app_status'];?>
</td>
            <th>检验检疫状态:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['ciq_status'];?>
</td>
        </tr>
        <tr>
            <th>订单商品货款:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['goods_amount'];?>
</td>
            <th>币制:</th>         
            <td><?php echo $_smarty_tpl->tpl_vars['currency']->value[$_smarty_tpl->tpl_vars['orderRow']->value['currency_code']];?>
【<?php echo $_smarty_tpl->tpl_vars['orderRow']->value['currency_code'];?>
】</td>
        </tr>
        <tr>
            <th>订单商品运费:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['freight'];?>
</td>
            <th>优惠金额:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['pro_amount'];?>
</td>
        </tr>
        <tr>
            <th>优惠信息说明:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['pro_remark'];?>
</td>
            <th>收货人姓名</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderAddressBookRow']->value['consignee'];?>
</td>
        </tr>
        <tr>
            <th>身份证号码</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderAddressBookRow']->value['consignee_id_number'];?>
</td>
            <th>收货人所在国:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderAddressBookRow']->value['country_name'];?>
【<?php echo $_smarty_tpl->tpl_vars['orderAddressBookRow']->value['consignee_country'];?>
】</td>
        </tr>
        <tr>
            <th>收货人地址:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderAddressBookRow']->value['consignee_addres'];?>
</td>
            <th>收货人电话:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderAddressBookRow']->value['consignee_telephone'];?>
</td>
        </tr>
        <tr>
            <th>收货人传真:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderAddressBookRow']->value['consignee_fax'];?>
</td>
            <th>收货人电子邮件:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['orderAddressBookRow']->value['consignee_email'];?>
</td>
        </tr>
        <tr>
            <th>电商平台:</th>
            <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['ecommerce_platform_customer_name'];?>
</td>
        </tr>
        <tr>
            <th>备注:</th>
            <td colspan="3"></td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['orderRow']->value['ciq_reject_reason']!=''){?>
        <tr>
            <th>商检错误回执</th>
            <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['orderRow']->value['ciq_reject_reason'];?>
</td>
        </tr>
        <?php }?>
    </table>

    <div class="tabs_header cl content-box-header" style="margin: 10px 0 4px;">
        <ul class="tabs cl" style="padding-top: 2px;">
            <li class='active'><a href="javascript:;" id='tab_orderProduct' class='tab'><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductOrders<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a></li>
            <li>  <a href="javascript:;" id='tab_OrderLogs' class='tab'><span>订单日志</span></a></li>
        </ul>
    </div>

    <div class='tabContent' id='orderProduct'>
        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th>企业商品货号</th>
                <th>海关商品备案编号</th>
                <th>海关商品编码</th>
                <th>商品名称</th>
                <th>规格型号</th>
                <th>条形码</th>
                <th>品牌</th>
                <th>申报单位</th>
                <th>币制</th>
                <th>申报数量</th>
                <th>单价</th>
                <th>总价</th>
                <th>是否赠品</th>
                <th>备注</th>
            </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['orderProductRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_no'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['registerID'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['hs_code'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_title'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_model'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_barcode'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['brand'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pu_code'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['quantity'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['price'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['total_price'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['gift_flag'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['note'];?>
</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class='tabContent' id='OrderLogs'>
        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th align="center" width="100px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
LogType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th align="center" width="100px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operater<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th align="center" width="150px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th align="center" width="100px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AccessIP<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th align="center" width="100px">检疫类型</th>
                <th align="center" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            </tr>
            </thead>
            <tbody>
                <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['orderLogRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                <tr>
                    <?php if ($_smarty_tpl->tpl_vars['row']->value['ol_type']==0){?>
                    <td>状态修改</td>
                    <?php }else{ ?>
                    <td>内容修改</td>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['row']->value['user_id']==0){?>
                    <td>系统</td>
                    <?php }else{ ?>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['account_name'];?>
</td>
                    <?php }?>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ol_add_time'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ol_ip'];?>
</td>
                    <td><?php if ($_smarty_tpl->tpl_vars['row']->value['status_type']=='1'){?>海关<?php }else{ ?>检验检疫<?php }?></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ol_comments'];?>
</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
$(function(){
    $(".tabContent").hide();
    $(".tab").click(function(){
        $(".tabContent").hide();
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
        $("#"+$(this).attr("id").replace("tab_","")).show();
    });
    $(".tabContent").eq(0).show();
});
</script><?php }} ?>