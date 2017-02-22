(function($) {
    $.fn.extend({
        "alterBgColor":function(options){
            //设置默认值
			
            option=$.extend({
                odd:"odd",
                even:"even",
                selected:"selected",
				except:".son",
				enabled_click_alter:true
            },options); //注意这个options 同上面的function(options)中的option是同一个对象

            //隔行变色
			
			$(this).addClass('formtable tableborder');
            //$("tbody>tr[class!=order_product]:even",this).addClass(option.even);
            //$("tbody>tr[class!=order_product]:odd",this).addClass(option.odd);
           // $("tbody>tr:not(.order_product):even",this).addClass(option.even);
            //$("tbody>tr:not(.order_product):odd",this).addClass(option.odd);           	
		    //$("tbody>tr:not(.son):even",$(this)).addClass(option.even); 
			//$("tbody>tr:not(.son):odd",$(this)).addClass(option.odd); 
			$('table table tr').addClass('son');
			$(this).find("tbody>tr:not(.son):even").addClass(option.even);
			$(this).find("tbody>tr:not(.son):odd").addClass(option.odd);
		   /*
            //单击行变色
            $('tbody>tr',this).click(function(){
                var hasSelected = $(this).hasClass(option.selected);
                $(this)[hasSelected?"removeClass":"addClass"](option.selected)
                .find(":checkbox").attr('checked',!hasSelected);
            });
            $("tbody>tr:has(:checked)",this).addClass(option.selected);
           */
            return this;  //返回this，使方法可链
        }
   
    });

})(jQuery);