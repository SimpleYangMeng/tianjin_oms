<?php /* Smarty version Smarty-3.1.13, created on 2016-12-19 09:41:44
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\personitem\person-item-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2147056d6cdc1b3f057-71047119%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89350f6af70b516c026474bbb3ff16e1102f5074' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\personitem\\person-item-list.tpl',
      1 => 1464244550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2147056d6cdc1b3f057-71047119',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d6cdc1cdc383_65674223',
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'condition' => 0,
    'ciqStatus' => 0,
    'key' => 0,
    'item' => 0,
    'customsStatusRows' => 0,
    'statusGroupRows' => 0,
    'appStatusRows' => 0,
    'appStatusRow' => 0,
    'status' => 0,
    'customerType' => 0,
    'personItemRows' => 0,
    'personItemRow' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d6cdc1cdc383_65674223')) {function content_56d6cdc1cdc383_65674223($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
    .simple-table th { text-align: right; width: 110px;}
    .b-custom-select__title__text { margin: 4px 30px 3px 10px;}
</style>
<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">个人物品清单列表</h3>
    </div>
    <div class="pageHeader"> 
        <form name="searchASNForm"  method="post" action="/merchant/personal-items/list" id="pagerForm">
            <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
            <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes"/>
            <input type="hidden" name="customs_status" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['customs_status'];?>
" />
            <div class="searchBar">
                <table cellpadding="0" cellspacing="0" border="0" class="simple-table">
                    <tr>
                        <th>订单号：</th>
                        <td>
                            <input type="text" name="order_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['order_code'];?>
" class="text-input fix-medium1-input"/>
                        </td>
                        <th>运单号：</th>
                        <td>
                            <input type="text" name="wb_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['wb_code'];?>
" class="text-input fix-medium1-input"/>
                        </td>
                        <th>支付单号：</th>
                        <td>
                            <input type="text" name="po_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['po_code'];?>
" class="text-input fix-medium1-input"/>
                        </td>
                    </tr>
                    <tr>
                        <th>检验检疫状态：</th>
                        <td>
                            <select name="ciq_status">
                                <option value="" <?php if ($_smarty_tpl->tpl_vars['condition']->value['ciq_status']===''){?>selected<?php }?>>全部</option>
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ciqStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['condition']->value['ciq_status']!==''&&$_smarty_tpl->tpl_vars['condition']->value['ciq_status']==$_smarty_tpl->tpl_vars['key']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                                <?php } ?>
                            </select>
                        </td>
                        <th>物品清单号：</th>
                        <td>
                            <input type="text" name="pim_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['pim_code'];?>
" class="text-input fix-medium1-input"/>
                        </td>
                        <th>企业清单编号：</th>
                        <td>
                            <input type="text" name="pim_reference_no" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['pim_reference_no'];?>
" class="text-input fix-medium1-input"/>
                        </td>
                        <!--
                        <th>电商企业代码：</th>
                        <td>
                            <input type="text" name="customer_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['customer_code'];?>
" class="text-input fix-medium1-input"/>
                        </td>
                        -->
                    </tr>
                    <!--
                    <tr>
                        <th>物流企业代码：</th>
                        <td>
                            <input type="text" name="logistic_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['logistic_customer_code'];?>
" class="text-input fix-medium1-input"/>
                        </td>
                        <th>支付企业代码：</th>
                        <td colspan="3">
                            <input type="text" name="pay_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['pay_customer_code'];?>
" class="text-input fix-medium1-input"/>
                        </td>
                    </tr>
                    -->
                    <tr>
                        <th>海关状态：</th>
                        <td>
                            <select name="customs_status">
                                <option value="" <?php if ($_smarty_tpl->tpl_vars['condition']->value['customs_status']===''){?>selected<?php }?>>全部</option>
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customsStatusRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['condition']->value['customs_status']!==''&&$_smarty_tpl->tpl_vars['condition']->value['customs_status']==$_smarty_tpl->tpl_vars['key']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                                <?php } ?>
                            </select>
                        </td>
                        <th>添加时间：</th>
                        <td colspan="3">                  
                            <input type="text" name="start_time" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['order_add_time'];?>
" class="datepicker text-input width140" readonly="true"/>    
                            <label><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <input type="text" name="end_time" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['order_end_time'];?>
" class="datepicker text-input width140" readonly="true"/>
                            </label>
                            <label>
                                <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> 
                            </label>                            
                        </td>
                    </tr>
                </table>
                <!-- <table>
                    <tr>
                        <td>                            
                            <label>订单号：
                                <input type="text" name="order_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['order_code'];?>
" class="text-input fix-medium1-input"/>
                            </label>                
                            <label>运单号：
                                <input type="text" name="wb_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['wb_code'];?>
" class="text-input fix-medium1-input"/>
                            </label>
                            <label>支付单号：
                                <input type="text" name="po_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['po_code'];?>
" class="text-input fix-medium1-input"/>
                            </label>                
                            <label>物品清单号：
                                <input type="text" name="pim_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['pim_code'];?>
" class="text-input fix-medium1-input"/>
                            </label>                       
                            <label>企业清单内部编号：
                                <input type="text" name="pim_reference_no" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['pim_reference_no'];?>
" class="text-input fix-medium1-input"/>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>                            
                            <label>电商企业代码：
                                <input type="text" name="customer_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['customer_code'];?>
" class="text-input fix-medium1-input"/>
                            </label> 
                            <label>物流企业代码：
                                <input type="text" name="logistic_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['logistic_customer_code'];?>
" class="text-input fix-medium1-input"/>
                            </label>                        
                            <label>支付企业代码：
                                <input type="text" name="pay_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['pay_customer_code'];?>
" class="text-input fix-medium1-input"/>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>                      
                            <label>添加时间：                      
                            <input type="text" name="start_time" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['order_add_time'];?>
" class="datepicker text-input width140" readonly="true"/>
                            </label>    
                            <label><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <input type="text" name="end_time" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['order_end_time'];?>
" class="datepicker text-input width140" readonly="true"/>
                            </label>                             
                        
                            <label>
                                <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> 
                            </label>                            
                        </td>
                    </tr>
                </table> -->
            </div>
        </form>
    </div>
</div>
<div class="btn_wrap">    
    <input class="statusBtn btn <?php if (empty($_smarty_tpl->tpl_vars['condition']->value['status'])&&!is_numeric($_smarty_tpl->tpl_vars['condition']->value['status'])){?>btn-active<?php }?>" value="全部<?php echo $_smarty_tpl->tpl_vars['statusGroupRows']->value['statusTotal'];?>
" name="status" type='button'>
    <?php  $_smarty_tpl->tpl_vars['appStatusRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['appStatusRow']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['appStatusRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['appStatusRow']->key => $_smarty_tpl->tpl_vars['appStatusRow']->value){
$_smarty_tpl->tpl_vars['appStatusRow']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['appStatusRow']->key;
?>
    <?php if (isset($_smarty_tpl->tpl_vars['statusGroupRows']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
    <input class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['condition']->value['status']==$_smarty_tpl->tpl_vars['key']->value&&is_numeric($_smarty_tpl->tpl_vars['condition']->value['status'])){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['appStatusRow']->value;?>
(<?php echo $_smarty_tpl->tpl_vars['statusGroupRows']->value[$_smarty_tpl->tpl_vars['key']->value];?>
)" name="status" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'>
    <?php }else{ ?>
    <input class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['condition']->value['status']==$_smarty_tpl->tpl_vars['key']->value&&is_numeric($_smarty_tpl->tpl_vars['condition']->value['status'])){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['appStatusRow']->value;?>
(0)" name="status" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'>
    <?php }?>
    <?php } ?>
</div>

<div class="bulk-actions align-left"  style="margin-top: 10px;margin-bottom:10px; border-radius: 4px 4px 4px 4px;">
    <?php if ($_smarty_tpl->tpl_vars['status']->value=="0"){?>
    <a class="button" href="#" onclick="compare();">三单对碰</a>
    <?php }?>
</div>
<div class="clear"></div>

<form  method="post" id="personitemform">
    <table class="table list formtable tableborder" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
            <tr>
                <th style="width: 20px;"><input type="checkbox" class="ordercheckAll">物品清单号</th>
                <th style="width: 260px;">状态</th>
                <th style="width: 200px;">订单号</th>
                <th style="width: 200px;">运单号</th>                
                <th style="width: 200px;">支付单号</th>
                <!--
                <?php if ($_smarty_tpl->tpl_vars['customerType']->value!='is_storage'){?>            
                <th>仓储企业代码</th>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['customerType']->value!='is_shipping'){?> 
                <th>物流企业代码</th>    
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['customerType']->value!='is_pay'){?>            
                <th>支付企业代码</th> 
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['customerType']->value!='is_ecommerce'){?> 
                <th>电商企业代码</th> 
                <?php }?>
                -->
                <th style="width: 200px;">申报时间</th>
                <th style="width: 260px;">添加时间</th>
                <th style="width: 200px;">操作</th>
            </tr>
        </thead>
        <tbody>    
            <?php if ($_smarty_tpl->tpl_vars['personItemRows']->value){?>
            <?php  $_smarty_tpl->tpl_vars['personItemRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['personItemRow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['personItemRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['personItemRow']->key => $_smarty_tpl->tpl_vars['personItemRow']->value){
$_smarty_tpl->tpl_vars['personItemRow']->_loop = true;
?>       
            <tr>
                <td class="text_center" style="vertical-align:middle;" width='250'>
                    <?php if ($_smarty_tpl->tpl_vars['personItemRow']->value['customs_status']=='1'&&$_smarty_tpl->tpl_vars['personItemRow']->value['is_comparison']=='0'){?>
                    <input type="checkbox" name="orderArr[]" ref="<?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_code'];?>
" class="orderArr" value="<?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_code'];?>
" />
                    <?php }?>
                    <?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_code'];?>

                </td>
                <td style="vertical-align:middle;">海关：<?php echo $_smarty_tpl->tpl_vars['customsStatusRows']->value[$_smarty_tpl->tpl_vars['personItemRow']->value['customs_status']];?>
<br/>检验检疫：<?php echo $_smarty_tpl->tpl_vars['ciqStatus']->value[$_smarty_tpl->tpl_vars['personItemRow']->value['ciq_status']];?>
</td>
                <td class="text_center" style="vertical-align:middle;"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['order_code'];?>
</td>
                <td class="text_center" style="vertical-align:middle;"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['wb_code'];?>
</td>
                <td class="text_center" style="vertical-align:middle;"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['po_code'];?>
</td>
                <!--
                <?php if ($_smarty_tpl->tpl_vars['customerType']->value!='is_storage'){?>            
                <td class="text_center" style="vertical-align:middle;" style="vertical-align:middle;"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['storage_customer_code'];?>
</td>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['customerType']->value!='is_shipping'){?> 
                <td class="text_center" style="vertical-align:middle;"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['logistic_customer_code'];?>
</td>    
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['customerType']->value!='is_pay'){?>            
                <td class="text_center" style="vertical-align:middle;"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pay_customer_code'];?>
</td> 
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['customerType']->value!='is_ecommerce'){?> 
                <td class="text_center" style="vertical-align:middle;"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['customer_code'];?>
</td> 
                <?php }?>
                -->   
                <td class="text_center" style="vertical-align:middle;"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['declare_date'];?>
</td>
                <td class="text_center" style="vertical-align:middle;"><?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_add_time'];?>
</td>
                <td class="text_center" style="vertical-align:middle;">
                    <?php if ($_smarty_tpl->tpl_vars['personItemRow']->value['customs_status']=='2'){?>
                         <a href="javascript:void(0);" onclick="parent.openMenuTab('/merchant/personal-items/edit/pim_code/<?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_code'];?>
','修改清单:<?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_code'];?>
','<?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_id'];?>
');return false;">修改 </a>
                    <?php }?>
                    <a href="javascript:void(0);" onclick="parent.openMenuTab('/merchant/personal-items/view/pim_code/<?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_code'];?>
','查看清单:<?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_code'];?>
','<?php echo $_smarty_tpl->tpl_vars['personItemRow']->value['pim_code'];?>
');return false;">查看 </a>
                </td>
            </tr>
            <?php } ?>
            <?php }else{ ?>
            <tr>
                <td class="text_center" style="vertical-align:middle;" width='250'></td>
                <td colspan="7" class="text_center">暂无数据</td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</form>
 <script type="text/javascript">

     $('.ordercheckAll').die('click').live('click',function(){
         if ($(this).is(':checked')) {
             $(".orderArr").attr('checked', true);

         } else {
             $(".orderArr").attr('checked', false);
         }
         changeTrColor();
     });

     /*伴随全选按钮是否选中而变色*/
     function changeTrColor(){

         $(".orderArr").each(function(){
             _this = $(this);
             if($('.ordercheckAll').is(':checked')){
                 set_tr_class(_this.parent().parent(), true);
             }else{
                 set_tr_class(_this.parent().parent(), false);
             }

         });
     }
     function alertTip(tip,width,height,notflash) {
         width = width?width:500;
         height = height?height:'auto';
         $('<div title="Note(Esc)"><p align="">' + tip + '</p></div>').dialog({
             autoOpen: true,
             width: width,
             height: height,
             modal: true,
             show:"slide",
             buttons: {
                 '关闭(Close)': function() {
                     $(this).dialog('close');
                     if(!(typeof(notflash)!="undefined" && notflash=='1')){
                         $('#pagerForm').submit();
                     }
                 }
             },
             close: function() {
                 $('#pagerForm').submit();
             }
         });
     }

     function compare(){
         var checkedSizesize = $('.orderArr:checked').size();
         if(checkedSizesize<=0){
             alertTip("请选择物品清单",'500','auto','1');
             return;
         }
         var param = $("#personitemform").serialize();
         $.ajax({
             type:"post",
             async:false,
             dataType:"json",
             url:"/merchant/personal-items/compare",
             data:param,
             success:function (json) {
                 var html = ""+json.message+"";
                 if(json.ask=='1'){
                     alertTip(html);
                 }else{
                     if(json.error){
                         html+=":<br/>";
                         $.each(json.error,function(k,v){
                             html+=""+v+"<br/>";
                         });
                     }
                     alertTip(html);
                 }
             }
         });
     }
 </script>
<div class="clear"></div>
<div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"  pageNumShown="10"></div>

<?php }} ?>