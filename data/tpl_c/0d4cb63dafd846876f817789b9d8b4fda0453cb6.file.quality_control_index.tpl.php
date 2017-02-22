<?php /* Smarty version Smarty-3.1.13, created on 2014-07-03 17:57:39
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/QC/quality_control_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103611241553b529130c6f29-51723837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d4cb63dafd846876f817789b9d8b4fda0453cb6' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/QC/quality_control_index.tpl',
      1 => 1404381416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103611241553b529130c6f29-51723837',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'condition' => 0,
    'warehouse' => 0,
    'row' => 0,
    'result' => 0,
    'item' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b52913217954_33818530',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b52913217954_33818530')) {function content_53b52913217954_33818530($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style>
    .abormaltd{
        color: red;
    }
</style>
<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
qc_list<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
    </div>



    <div class="pageHeader">
        <form action="/merchant/quality-control/list" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
            <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes"/>

            <div class="searchBar">
                <table>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ASNCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        </td>
                        <td style=" text-align:left">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['receiving_code'];?>
" name="receiving_code" class="text-input width180 "/>
                        </td>
                        <td style="text-align: right;color:#000;">
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        </td>
                        <td style=" text-align:left">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_sku'];?>
" name="product_sku" class="text-input width180 "/>
                        </td>
                        <td style="text-align:right;color:#000">
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
problemStatus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        </td>
                        <td>
                            <select class="text-input width195" name="abnormal">
                                <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
                                <option value="0" <?php if ($_smarty_tpl->tpl_vars['condition']->value['abnormal']=="0"){?> selected <?php }?>>否</option>
                                <option value="1" <?php if ($_smarty_tpl->tpl_vars['condition']->value['abnormal']=="1"){?> selected <?php }?>>是</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
QCDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        </td>
                        <td>
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['qc_finish_time_start'];?>
" name="qc_finish_time_start" class="datepicker text-input width180" />
                        </td>
                        <td style="text-align:center;color:#000">
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        </td>
                        <td>
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['qc_finish_time_end'];?>
" name="qc_finish_time_end" class="datepicker text-input width180" />
                        </td>
                        <td style="text-align:right;color:#000">
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        </td>
                        <td>
                            <select class="text-input width195" name="warehouse_id">
                                <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
                                <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['row']->value['warehouse_id']==$_smarty_tpl->tpl_vars['condition']->value['warehouse_id']){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_name'];?>
</option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        </td>
                        <td>
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['reference_no'];?>
" name="reference_no" class="text-input width180 " />
                        </td>
                        <td>
                            <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
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
            <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ASNCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
the_warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
QCquantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReceiptQuantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
available_quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
defective_quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <!--<th >状态</th>-->
            <th ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
problemStatus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <!--<th  style="width:260px">时间</th>-->
            <th ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
QCDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>

        </tr>
        </thead>
        <tbody>
        <?php if ($_smarty_tpl->tpl_vars['result']->value!=''){?>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <tr <?php if ($_smarty_tpl->tpl_vars['item']->value['qc_quantity_unsellable']>0){?>class="abormaltd"<?php }?>>
                <td style="text-align:center">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['reference_no'];?>

                </td>
                <td style="text-align:center">
                    <a title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="parent.openMenuTab('/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
','产品详情(<?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
)','productdetail<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
');return false;" href="/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
" class="edit"><span <?php if ($_smarty_tpl->tpl_vars['item']->value['qc_quantity_unsellable']>0){?>style="color:red;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
</span>
                    </a>
                </td>
                <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['warehouse_name'];?>
</td>
                <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['qc_quantity'];?>
</td>
                <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['qc_received_quantity'];?>
</td>
                <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['qc_quantity_sellable'];?>
</td>
                <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['qc_quantity_unsellable'];?>
</td>
                <!--<td style="text-align:center">
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['qc_status']=="0"){?>
                    草稿
                    <?php }elseif($_smarty_tpl->tpl_vars['item']->value['qc_status']=="1"){?>
                    完成
                    <?php }else{ ?>
                    已上架
                    <?php }?>
                </td>-->
                <td style="text-align:center">
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['qc_quantity_unsellable']>0){?>
                    是
                    <?php }else{ ?>
                    否
                    <?php }?>
                </td>
                <!--<td style="text-align:center">
                    创建时间：<?php echo $_smarty_tpl->tpl_vars['item']->value['qc_add_time'];?>

                    <br>质检日期：<?php echo $_smarty_tpl->tpl_vars['item']->value['qc_finish_time'];?>

                </td>-->
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['qc_finish_time'];?>
</td>
                <td style="text-align:center">
                    <a <?php if ($_smarty_tpl->tpl_vars['item']->value['qc_quantity_unsellable']>0){?>style="color:red;"<?php }?> href="javascript:QC('<?php echo $_smarty_tpl->tpl_vars['item']->value['qc_code'];?>
')"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
view<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                </td>
            </tr>
            <?php } ?>
        <?php }?>
        </tbody>
    </table>
</form>
<div class="panelBar">
    <div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"  pageNumShown="10"></div>
</div>


<div id="export_dialog" title="导出库存记录" style="display:none">
    <input type="radio" name="exportType" value="1" checked="checked">选择的库存记录<input type="radio" name="exportType" value="0">全部

</div>
<script>

    function QC(code) {
        window.open("/merchant/quality-control/qc/code/" + code);
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