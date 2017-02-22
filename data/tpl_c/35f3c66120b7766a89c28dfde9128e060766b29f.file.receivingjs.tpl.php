<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 15:38:15
         compiled from "/home/apache/www/import/oms/application/modules/default/views/js/receivingjs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35797441653b3b6e7777446-83129258%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35f3c66120b7766a89c28dfde9128e060766b29f' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/default/views/js/receivingjs.tpl',
      1 => 1396509297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35797441653b3b6e7777446-83129258',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3b6e77dd043_97258822',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3b6e77dd043_97258822')) {function content_53b3b6e77dd043_97258822($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?>$(function(){
    $('.statusBtn').bind('click',function(){
        var status = $(this).attr('ref');
        $('[name=receiving_status]').val(status);
        $('.statusBtn').removeClass('btn-active');
		$('#pagerForm #page').val(1);
        $(this).addClass('btn-active');		
        $('#pagerForm').submit();
    });
    //处理ASN
     $(".asncheckAll").die('click').live('click',function () {
         if ($(this).is(':checked')) {
             $(".AsnArr").attr('checked', true);
         } else {
             $(".AsnArr").attr('checked', false);
         }
		 changeTrColor();
     });

	/*伴随全选按钮是否选中而变色*/
	function changeTrColor(){
	
	
		$(".AsnArr").each(function(){
				_this = $(this);
				if($('.asncheckAll').is(':checked')){			
					set_tr_class(_this.parent().parent(), true);			
				}else{			
					set_tr_class(_this.parent().parent(), false);		
				}					
						
		});	
		
		
	}	 
    $('#batchSubmit').die().bind('click',function(){
        if($('#batchSelect').val()==''){
            alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
        }else{
            switch($('#batchSelect').val()){
                case "bacthConfirm":
                    bacthConfirm();
                    break;
                case "movepending":
                    movepending();
                    break;
                case "movedraft":
                    movedraft();
                    break;
                default:
                    alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InvalidParameter<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
','500','auto','1');
            }
        }
    })
});

 function bacthConfirm(){
     var checkedSizesize = $('.AsnArr:checked').size();
     if(checkedSizesize<=0){
         alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneASN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
         return;
     }
     var param = $("#asnDataForm").serialize();
     $.ajax({
         type:"post",
         async:false,
         dataType:"json",
         url:"/merchant/receiving/confirm",
         data:param,
         success:function (json) {
             var html = ""+json.message+"";
             if(json.detailmessage){
			 	
                     $.each(json.detailmessage,function(k,v){
                         html+="<br/>"+v;
                     });				
				
			 }
			 if(json.ask=='1'){
                 alertTipClose(html);
             }else{
                 if(json.error){
                     html+=":<br/>";
                     $.each(json.error,function(k,v){
                         html+=v+"<br/>";
                     });
                 }
                 alertTip(html);
             }
             //$('#pagerForm').submit();
         }
     });
 }
 function movepending(){
     var checkedSizesize = $('.AsnArr:checked').size();
     if(checkedSizesize<=0){
         alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneASN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
         return;
     }
     var param = $("#asnDataForm").serialize();
     $.ajax({
         type:"post",
         async:false,
         dataType:"json",
         url:"/merchant/receiving/pending",
         data:param,
         success:function (json) {
             var html = ""+json.message+"";
            
			 if(json.detailmessage){
			 	
                     $.each(json.detailmessage,function(k,v){
                         html+="<br/>"+v;
                     });				
				
			 }
			 
			 if(json.ask=='1'){
                 alertTipClose(html);
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
 function movedraft(){
     var checkedSizesize = $('.AsnArr:checked').size();
     if(checkedSizesize<=0){
         alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneASN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
         return;
     }
     var param = $("#asnDataForm").serialize();
     $.ajax({
         type:"post",
         async:false,
         dataType:"json",
         url:"/merchant/receiving/draft",
         data:param,
         success:function (json) {
             var html = ""+json.message+"";
		 		if(json.detailmessage){
			 	
                     $.each(json.detailmessage,function(k,v){
                         html+="<br/>"+v;
                     });				
				
			 	}			 
             if(json.ask=='1'){
                 alertTipClose(html);
             }else{
                 if(json.error){
                     html+=":<br/>";
                     $.each(json.error,function(k,v){
                         html+=""+v+"<br/>";
                     });
                 }
                 alertTip(html);
             }
             //$('#pagerForm').submit();
         }
     });
 }

function alertTip(tip,width,height,notflash) {
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tip_esc_escape<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
        height: height,
        modal: true,
        show:"slide",
        buttons: {
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                $(this).dialog('close');
                if(!(typeof(notflash)!="undefined" && notflash=='1')){
                    $('#pagerForm').submit();
                }
            }
        },
        close: function() {

        }
    });
}
function alertTipClose(tip,width,height,notflash){
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tip_esc_escape<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
        height: height,
        modal: true,
        show:"slide",
        buttons: {
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
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
function deleteAsn(url){
    $('<div title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tip_esc_escape<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><p align=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AreYouSureToDeleteTheASN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p></div>').dialog({
        autoOpen: true,
        width: 300,
        height: 'auto',
        modal: true,
        show:"slide",
        buttons: {
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
':function(){
                $(this).dialog("close");
            },
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                $(this).dialog("close");
                $.ajax({
                    type:'POST',
                    url:url,
                    dataType:"json",
                    cache:false,
                    success:function(json){
                        if(json.ask=='1'){
                            alertTipClose(json.message);
                        }else{
                            var html = '';
                            html+=json.message;
                            alertTip(json.message,'500','auto','1');
                        }
                    },
                    error:function(){
                        alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                    }
                });
            }
        },
        close: function() {

        }
    });

}
<?php }} ?>