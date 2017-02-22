<?php /* Smarty version Smarty-3.1.13, created on 2014-07-04 09:32:00
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/receiving/receiving-print.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25023595253b6041030a246-60271337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc13d6badc4ab726198104e6b250e7fb30dd0408' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/receiving/receiving-print.tpl',
      1 => 1396509568,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25023595253b6041030a246-60271337',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'asnInfo' => 0,
    'key' => 0,
    'product' => 0,
    'customerinfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b604103dd7a8_51014852',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b604103dd7a8_51014852')) {function content_53b604103dd7a8_51014852($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/apache/www/import/oms/libs/Smarty/plugins/modifier.date_format.php';
?><style>
    <!--
    *{margin:0px;padding:0px;font-size:12px;color:#000000;}

    @meida screen{

    }
    .print-main{
        font-size: 10px;
        width: 20cm;
        padding-top: 5px;
        text-align: center;
        margin: 0 auto;
        line-height:20px;
    }
    @meida print{
       .print-main{
        font-size: 10px;
        width: 20cm;
        padding-top: 5px;
       }
    }
    .print-table{
        width:98%;
        margin:0 auto;
    }
    table { border-collapse: separate; }
    .print-table td, .print-table th{
        border: 1px solid #000000;
        border-collapse: collapse;
    }
    .print-table .qiye td, .print-table .qiye th{
        border: 0px solid #000000;
        border-collapse: collapse;
        text-align: center;
    }
    .print-table .noborder td, .print-table .noborder th{
        border:none;
        border-collapse: collapse;
    }

    .info th {
        width:120px;
    }
    .info td {
        padding-left:5px;
    }
    * {
        word-break: break-all;
        word-wrap: break-word;
    }
    .imgWrap{
        width:75px;
        text-align:center;
    }
    .list td{
       text-align:center;
    }
    td,th{
        height:30px;
        white-space:nowrap;
    }
    .noborder td,th{
        height:30px;
        border-collapse: collapse;
        /*white-space:normal;*/
    }
   .baosui{
       /*float: left;
       clear: both;*/
       font-weight: 600;
   }
   .bond{
       font-weight: 600;
   }
   .left{
       float: left;
   }
   .clear{
       clear: both;
   }
    .print-table .noborder .xuxian{
       border-bottom:1px dashed #000000;
        border-collapse: collapse;

   }
    .print-table .noborder .shixian{
       border-bottom:1px solid #000000;
        border-collapse: collapse;
   }
   td div{
       margin-top: 5px;
       margin-bottom: 5px;
   }
    -->
</style>

<div class="print-main">
<?php if (!isset($_smarty_tpl->tpl_vars['asnInfo']->value)){?>
<div class='center'>ASN不存在</div>
<?php }else{ ?>
<div style="width:20cm;text-align: center;">
    <div class="clear"><div class="left"><img  class='barcode' style="width:8.2cm;height:1cm;margin-left:0cm;" src="/default/index/barcode?code=<?php echo $_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['receiving_code'];?>
"></div><div class='baosui left' style="padding-left: 50px;">中华人民共和国保税港区</div></div>
    <div class="clear" style="padding-left: 20px;padding-top:20px;"><div class="left">报关单:534920130495570413</div><div class="left bond" style="padding-left: 150px;">一般清关出口入区清单</div></div>
    <div class="clear">
    <table cellspacing="0" cellpadding="0" class="print-table info" style="border-collapse:collapse;text-align: ;">
      <tr>
          <td>
              <div>仓库账册号</div>
              <div>W4403630010901</div>
          </td>
          <td>
              <div>出入库单编号</div>
              <div>3000I211130549239</div>
          </td>
          <td>
              <div>清单企业内部编号</div>
              <div>9278316</div>
          </td>
          <td>
              <div>申请日期</div>
              <div><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['receiving_add_time'],'%Y-%m-%d');?>
</div>
          </td>
          <td>
              <div>申报地海关</div>
              <div><?php echo $_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['to_warehouse_name'];?>
</div>
          </td>
          <td>
              <div>申报单位 440364001</div>
              <div>招商局保税物流有限公司</div>
          </td>
      </tr>
      <tr>
           <td>
                <div>进出口岸</div>
                <div><?php echo $_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['warehouse_name'];?>
</div>
           </td>
           <td>
               <div>监管方式(<?php echo $_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['trade_mode'];?>
)</div>
               <div><?php echo $_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['trade_mode_name'];?>
</div>
           </td>
           <td>
               <div>成交方式(13)</div>
               <div>FOB</div>
           </td>
           <td>
               <div>运输方式(Y)</div>
               <div>保税港区</div>
           </td>
           <td>
               <div>经营单位</div>
               <div>嘉宏国际物流有限公司</div>
           </td>
           <td>
               <div>收(发)货单位</div>
               <div>嘉宏国际物流有限公司</div>
           </td>
      </tr>
      <tr>
          <td>
              <div>起/抵运地 (142)</div>
              <div>中国</div>
          </td>
          <td>
              <div>征免性质(101)</div>
              <div>一般征税</div>
          </td>
          <td>
              <div>运输工具名称</div>
              <div></div>
          </td>
          <td>
              <div>航次</div>
              <div></div>
          </td>
          <td>
              <div>业务类型(<?php echo $_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['form_type'];?>
)</div>
              <div><?php echo $_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['form_type_name'];?>
</div>
          </td>
          <td>
              <div>提运单号</div>
              <div></div>
          </td>
      </tr>
      <tr>
          <td>
              <div>件数 <?php echo $_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['pack_no'];?>
</div>
          </td>
          <td>
              <div>包装种类  <?php echo $_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['wrap_type_name'];?>
</div>
          </td>
          <td>
              <div>毛重</div>
          </td>
          <td>
              <div>净重</div>
              <div></div>
          </td>
          <td>
              <div>操作员</div>
              <div>一般清关出口入区</div>
          </td>
          <td>
              <div>指/抵运港  中国境内</div>
              <div></div>
          </td>
      </tr>
      <tr>
          <td>
              <div>转关单预录入号</div>
          </td>
          <td colspan="2">
              <div>集装箱号   <?php echo $_smarty_tpl->tpl_vars['asnInfo']->value['asnRow']['conta_id'];?>
</div>
          </td>
          <td colspan="3">
              <table class='qiye' style="border-collapse:collapse;text-align: left;" >
                  <tr>
                      <td style="border-right: 1px solid #000000;text-align:left;">
                          <div>仓库使用企业</div>
                          <div>嘉宏国际物流有限公司</div>
                      </td>
                      <td>
                          备注
                      </td>
                  </tr>
              </table>
          </td>
      </tr>
      <tr>
          <td colspan="6" style="padding-left: 0;">
              <table class="noborder"  cellpadding='0' cellspace='0' border="0" style="border-collapse:collapse;margin: 0;padding: 0;">
                  <thead style="padding-left: 0;">
                    <tr>
                        <td style="padding: 0;" class="shixian">序号</td>
                        <td class="shixian">归并序号</td>
                        <td class="shixian">商品料件号</td>
                        <td class="shixian">商品编码</td>
                        <td class="shixian">中文名称/英文名称/规格型号</td>
                        <td class="shixian">法定数量/单位</td>
                        <td class="shixian">数量/单位</td>
                        <td class="shixian">第二数量/单位</td>
                        <td class="shixian">单价</td>
                        <td class="shixian">总价</td>
                        <td class="shixian">币制</td>
                        <td class="shixian">目的国</td>
                        <td class="shixian">征免方式</td>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if (isset($_smarty_tpl->tpl_vars['asnInfo']->value['ASNDetail'])){?>
                  <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['asnInfo']->value['ASNDetail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['product']->key;
?>
                    <tr>
                       <td class="xuxian"><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
</td>
                       <td class="xuxian"><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
</td>
                       <td class="xuxian">9278316-<?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
</td>
                       <td class="xuxian"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_barcode'];?>
</td>
                       <td class="xuxian"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_title'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['product_title_en'];?>
/</td>
                       <td class="xuxian"><?php echo $_smarty_tpl->tpl_vars['product']->value['hum_quantity_law'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['pu_name_law'];?>
</td>
                       <td class="xuxian"><?php echo $_smarty_tpl->tpl_vars['product']->value['hum_quantity_law'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['pu_name_law'];?>
</td>
                       <td class="xuxian"><?php echo $_smarty_tpl->tpl_vars['product']->value['hum_quantity_second'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['pu_name_second'];?>
</td>
                       <td class="xuxian"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_sales_value'];?>
</td>
                       <td class="xuxian"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_sales_value']*$_smarty_tpl->tpl_vars['product']->value['rd_receiving_qty'];?>
</td>
                       <td class="xuxian"><?php echo $_smarty_tpl->tpl_vars['customerinfo']->value['customer_currency'];?>
</td>
                       <td class="xuxian">中国</td>
                       <td class="xuxian">
                           <div>1</div>
                           <div>照章征收</div>
                       </td>
                    </tr>
                  <?php } ?>
                  <?php }?>
                  </tbody>
              </table>
          </td>
      </tr>
    </table>
    </div>
</div>

</div>
<?php }?>
</div>
<?php }} ?>