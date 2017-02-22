<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 15:49:10
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/receiving/receiving-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20714055153b3b976f15766-71654787%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5778d0936e40261fa2e85958ac623d3c19161e6d' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/receiving/receiving-create.tpl',
      1 => 1396509568,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20714055153b3b976f15766-71654787',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'actions' => 0,
    'modify' => 0,
    'receiving' => 0,
    'receiving_code' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3b97703ede6_21790469',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3b97703ede6_21790469')) {function content_53b3b97703ede6_21790469($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style type="text/css">
    #ASNForm tbody th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;

    }
    #ASNForm tbody td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
   *#ASNForm tbody span.error{
        top:auto;
    }
    span.error{
        top:auto;
    }
</style>
<style>
  #subProducts .textInput{
      float:none;;
  }
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all asncontent">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><?php echo $_smarty_tpl->tpl_vars['actions']->value;?>
</h3>
        <div class="clear"></div>
    </div>			
				
    

<!--<div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
fff">
</div>-->
<div class="infoTips" id="messageTip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
			
</div>
<div id="selectModelDialog" title="" class="hidden">
<table>
    <tr>
        <td align='right'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_asn_model<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
        <td align='left'>
			<input type="button" value='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectingMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' class="ui-state-default button selectmodelbtn" model='1' receive_type='0'>
            <input type="button" value='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryMode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' class="ui-state-default button selectmodelbtn" model='0'  receive_type='0'>
			<input type="button" value='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
return_mode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' class="ui-state-default button selectmodelbtn" model='0'  receive_type='1'>
			
        </td>
    </tr>
</table>


</div>
</div>

<script type="text/javascript">
    $(function(){
        //开始时提示
        $('#selectModelDialog').dialog({
            autoOpen: false,
			position:[50,50],
            modal: false,
            bgiframe:true,
            width: 800,
            resizable: true
        });
        <?php if (isset($_smarty_tpl->tpl_vars['modify']->value)&&$_smarty_tpl->tpl_vars['modify']->value=='1'){?>
            getreceiveModel('<?php echo $_smarty_tpl->tpl_vars['receiving']->value['receive_model_type'];?>
','<?php echo $_smarty_tpl->tpl_vars['receiving']->value['receiving_type'];?>
');
        <?php }else{ ?>
        //处理模式
        $('#selectModelDialog').dialog('open');
        $('.selectmodelbtn').bind('click',function(){
            //alert($(this).attr('model'));
            $('#ordermodeltext').html($(this).val());
            $('[name=ordermodel]').val($(this).attr('model'))
            $('.modelcontent').show();
            $('.asncontent').hide();			
            getreceiveModel($(this).attr('model'),$(this).attr('receive_type'));
        });
        $('.modelcontent').hide();
        <?php }?>
    });
    //得带模板内容
    
	function getreceiveModel(receivemodel,receive_type_input){
		//alert(receivemodel);
        var receivemodel = receivemodel||0;
		var receive_type =  receive_type_input|| '0';
		var ASNCode = '<?php echo $_smarty_tpl->tpl_vars['receiving_code']->value;?>
';
        $.ajax({type:'get',
            dataType:'html',
            url:'/merchant/receiving/create',
            data:{'receivemodel':receivemodel,'receive_type':receive_type,'type':'getTpl','ASNCode':ASNCode},
            success:function(html){			  
               $('.model').hide();		    
               $('.asncontent').html(html).show();			  
               $('#selectModelDialog').dialog('close');
               //$('.content-box-header').remove();
            }});
		
    }//function getreceiveModel(receivemodel){

</script><?php }} ?>