<?php /* Smarty version Smarty-3.1.13, created on 2016-03-02 19:25:57
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\personitem\person-item-detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:218856d6cdc511cdf0-62749212%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '270f676fbefb76ea7b5d8dcecde9aa0a328666cd' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\personitem\\person-item-detail.tpl',
      1 => 1455677482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '218856d6cdc511cdf0-62749212',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'personItemRow' => 0,
    'statusRows' => 0,
    'customsStatus' => 0,
    'ciqStatus' => 0,
    'personItemProductRows' => 0,
    'personItemProductRow' => 0,
    'personItemLogRows' => 0,
    'personItemLogRow' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d6cdc52b6945_21327251',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d6cdc52b6945_21327251')) {function content_56d6cdc52b6945_21327251($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all" >
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">个人物品清单</h3>
    </div>
<div style="margin-right: 0px; padding: 6px;" class="content-box nbox_c marB10 product_detail cl">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder" width='100%'>       
        <tr>
            <th width="16%">物品清单号</th>
            <td width="16%"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_code'];?>
</td>
            <th width="16%">企业清单内部编号</th>
            <td width="16%"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_reference_no'];?>
</td>
            <th width="16%">业务类型</th>
            <td>进口出区</td>
        </tr>

        <tr>
            <th>电商企业代码</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['customer_code'];?>
</td>
            <th>物流企业代码</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['logistic_customer_code'];?>
</td>
            <th>支付企业代码</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pay_customer_code'];?>
</td>

            
            
        </tr>
        <tr>
            <th>交易订单号</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['order_reference_no'];?>
</td> 
            <th>运单号</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['log_no'];?>
</td>
            <th>支付单号</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['po_code'];?>
</td>
            <!-- <th>运单编号</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['wb_code'];?>
</td> -->
        </tr>
<!--         <tr>
            
            
            <th>支付单编号</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['po_code'];?>
</td>

        </tr> -->

        <tr>            
            <th>仓储企业代码</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['storage_customer_code'];?>
</td>
            <th>申报单位</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['agent_name'];?>
</td>
            <th>运输方式</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['traf_mode'];?>
(<?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['traf_mode_name'];?>
)</td>
            
        </tr>

<!--         <tr>            
            
            
            <th>订单编号</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['order_code'];?>
</td>
        </tr> -->

        

        <tr>
            <th>进出口口岸</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['ie_port'];?>
</td>
            <th>申报口岸</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['declare_ie_port'];?>
</td>
            <th>抵运国家</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['aim_country'];?>
</td> 
        </tr>

        <tr>
            <th>发件人国家</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['ship_trade_country'];?>
</td>
            
            <th>发件人</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['ship_name'];?>
</td> 
            <th>发件人城市</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['ship_city'];?>
</td>
        </tr>       

        <tr>
            <th>收件人国家</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['receive_country'];?>
</td>
            <th>收件人省份</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['receive_state'];?>
</td>
            <th>收件人城市</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['receive_city'];?>
</td>
            
        </tr>

        <tr>
            <th>收件人姓名</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['receive_name'];?>
</td>
            <th>收件人地址</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['receiving_address'];?>
</td>
            <th>收件人身份证信息</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['receive_id_number'];?>
</td>
        </tr>

        <tr>
            <th>收件人电话</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['receive_telphone'];?>
</td>
            <th>录入单位</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['input_company'];?>
</td>
            <th>报关员</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['declare_no'];?>
</td>
        </tr>

        <tr>
            <th>单位地址</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['agent_address'];?>
</td>
            <th>邮编</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['agent_post'];?>
</td>
            <th>子账号电话</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['agent_tel'];?>
</td>
        </tr>

        <tr>
            <th>外包装类型</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['wrap_type'];?>
(<?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['wrap_type_name'];?>
)</td>
            <th>运费</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['freight'];?>
</td>
            <th>保费</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['insure_fee'];?>
</td>
            
        </tr>

        <tr>
            <th>净重</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['net_wt'];?>
</td>
            <th>毛重</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['gross_wt'];?>
</td>
            <th>件数</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pack_no'];?>
</td>
            
        </tr>

        <tr>
            <th>监管场所代码</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['customs_field'];?>
</td>
            <th>录入员</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['input_no'];?>
</td>
            <th>录入时间</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['input_date'];?>
</td>
            
        </tr>

        <tr>
            <th>添加时间</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_add_time'];?>
</td>
            <th>进出境日期</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['i_e_date'];?>
</td>
            <th>申报日期</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['declare_time'];?>
</td>
        </tr>
        <tr>
            <th>总状态</th>
            <td><?php echo $_smarty_tpl->tpl_vars['statusRows']->value[$_smarty_tpl->tpl_vars['personItemRow']->value['status']];?>
</td>
            <th>海关状态</th>
            <td><?php echo $_smarty_tpl->tpl_vars['customsStatus']->value[$_smarty_tpl->tpl_vars['personItemRow']->value['customs_status']];?>
</td>
            <th>检验检疫状态</th>
            <td><?php echo $_smarty_tpl->tpl_vars['ciqStatus']->value[$_smarty_tpl->tpl_vars['personItemRow']->value['ciq_status']];?>
</td> 
        </tr>
        <tr>
            <th>最后更新时间</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_update_time'];?>
</td>
            <th>检疫情况</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['quarantine'];?>
</td>
            <th>查验情况</th>
            <td><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['check'];?>
</td>
        </tr>
        <tr>
            <th>备注</th>
            <td colspan="5"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['note'];?>
</td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['personItemRow']->value['ciq_reject_reason']!=''){?>
        <tr>
            <th>商检错误回执</th>
            <td colspan="5"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['ciq_reject_reason'];?>
</td>
        </tr>
        <?php }?>
    </table>
</div>

<div class="cl">
    <div class="tabs_header cl content-box-header" style="margin: 10px 0 4px;">
        <ul class="tabs cl" style="padding-top: 2px;">
            <li class='active'>  <a href="javascript:;" id='tab_productRows' class='tab'><span>清单产品</span></a></li>
            <li><a href="javascript:;" id='tab_log' class='tab'><span>清单日志</span></a></li> 
        </ul>
    </div>

    <div class='tabContent' id='productRows'>
        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th>企业商品货号</th>
                <th>海关商品备案编号</th>
                <th>料件号</th>
                <th>海关编码</th>
                <th>行邮税号</th>
                <th>商品名称</th>
                <th>规格型号</th>
                <th>数量</th>
                <th>单位</th>
                <th>单价</th>
                <th>总价</th>
                <th>币制</th>
                <th>原产国</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($_smarty_tpl->tpl_vars['personItemProductRows']->value){?>
            <?php  $_smarty_tpl->tpl_vars['personItemProductRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['personItemProductRow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['personItemProductRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['personItemProductRow']->key => $_smarty_tpl->tpl_vars['personItemProductRow']->value){
$_smarty_tpl->tpl_vars['personItemProductRow']->_loop = true;
?>
                <tr>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['g_no'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['registerID'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['goods_id'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['hs_code'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['gt_code'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['g_name_cn'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['g_model'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['g_qty'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['g_uint'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['price'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['total_price'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['curr'];?>
</td>
                    <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemProductRow']->value['country'];?>
</td>
                </tr>
            <?php } ?>
            <?php }?>
            </tbody>

        </table>

    </div>

    <div class='tabContent' id='log'>
        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th align="center" width="100px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operater<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th align="center" width="150px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th align="center" width="100px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AccessIP<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th align="center" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($_smarty_tpl->tpl_vars['personItemLogRows']->value){?>
            <?php  $_smarty_tpl->tpl_vars['personItemLogRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['personItemLogRow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['personItemLogRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['personItemLogRow']->key => $_smarty_tpl->tpl_vars['personItemLogRow']->value){
$_smarty_tpl->tpl_vars['personItemLogRow']->_loop = true;
?>
            <tr>
            <?php if ($_smarty_tpl->tpl_vars['personItemLogRow']->value['user_id']==0){?>
                <td class="text_center">系统</td>
            <?php }else{ ?>
                <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemLogRow']->value['account_name'];?>
</td>
            <?php }?>
                <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemLogRow']->value['pil_add_time'];?>
</td>
                <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemLogRow']->value['pil_ip'];?>
</td>
                <td class="text_center"><?php echo $_smarty_tpl->tpl_vars['personItemLogRow']->value['pil_comments'];?>
</td>
            </tr>
            <?php } ?>
            <?php }?>
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