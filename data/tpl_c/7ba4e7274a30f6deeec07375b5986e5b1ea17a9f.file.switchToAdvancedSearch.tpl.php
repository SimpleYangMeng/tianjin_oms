<?php /* Smarty version Smarty-3.1.13, created on 2016-02-17 11:24:57
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\default\views\js\switchToAdvancedSearch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1745656c3e8094a2776-67960864%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ba4e7274a30f6deeec07375b5986e5b1ea17a9f' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\default\\views\\js\\switchToAdvancedSearch.tpl',
      1 => 1455677485,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1745656c3e8094a2776-67960864',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c3e8094ad181_35925332',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c3e8094ad181_35925332')) {function content_56c3e8094ad181_35925332($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><script>
(function($) {
    $.fn.extend({
        "switchToAdvancedSearch":function(options){
            //设置默认值			
            option=$.extend({              
                button_id:"#switch_search_model",
				advanced_element:".advanced_element",
				cookName:"search_mode"
				
            },options); //注意这个options 同上面的function(options)中的option是同一个对象
          	var cookName = option.cookName;
			//alert(cookName);
			if(typeof($(this).attr('id'))=='undefined'){return;}
			//alert($(option.advanced_element).size());

			function init(){				
				$('.simplesearchsubmit').css({'marginLeft':10});
			}
			init();
			
			if(typeof($.cookie(cookName))!='undefined'){
				if($.cookie(cookName)=='advanced'){
					switchtoadvanced();
				}else if($.cookie(cookName)=='common'){
					switchsimple();
				}else{
					if($(option.advanced_element).size()>0){
						switchsimple();
					}					
					
				}				
			
			
			}
			
			function switchtoadvanced(){
					$(option.advanced_element).show();
					$(option.button_id).html('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_simple_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
					$('.simplesearchsubmit').hide();
					$('.advancedsearchsubmit').show();
				
			}
			
			function switchsimple(){
					$(option.advanced_element).hide();
					$(option.button_id).html('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
					$('.simplesearchsubmit').show();
					$('.advancedsearchsubmit').hide();
			}			
			
			
			
			
			//----------------------------------------------
			$(option.button_id).click(function(event){				
				if($(option.advanced_element+':hidden').size()>0){
					 switchtoadvanced();
					 $.cookie(cookName,'advanced');
				}else{
					switchsimple();
					$.cookie(cookName,'common');
				}			
				event.stopPropagation();				
				
			}); 
		 //------------------------------------------------
            return this;  //返回this，使方法可链
        }
   
    });

})(jQuery);
</script><?php }} ?>