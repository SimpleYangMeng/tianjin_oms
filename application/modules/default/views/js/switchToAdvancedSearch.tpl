<script>
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
					$(option.button_id).html('<{t}>switch_to_simple_search<{/t}>');
					$('.simplesearchsubmit').hide();
					$('.advancedsearchsubmit').show();
				
			}
			
			function switchsimple(){
					$(option.advanced_element).hide();
					$(option.button_id).html('<{t}>switch_to_advanced_search<{/t}>');
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
</script>