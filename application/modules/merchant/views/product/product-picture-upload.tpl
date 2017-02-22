
<script language="javascript" type="text/javascript"
	src="/js/swfupload/swfupload.js"></script>
<script language="javascript" type="text/javascript"
	src="/js/swfupload/handlers.js"></script>

<script type="text/javascript">

function _loadWebImage(url) {
	var imgWrap = $("<div class='imgWrap'></div>");		
//	var fancybox = 	$("<a class='fancybox' href='"+serverData.url+"' data-fancybox-group='gallery' ></a>");		
//	var img = $("<img src='"+serverData.thumb+"'/>");		
//	fancybox.append(img);
	var input = $("<input type='hidden' name='picLink[]' value='"+url+"'>");
	
	var img = new Image();
	img.src = url;
	var wrapWidth = 140;
	var wrapHeight = 140;
	var marginLeft = 0;
	var marginTop = 0;
	var width_ = height_ = 0;
	img.onload = function () {
		var width  = this.width;
		var height = this.height;

		var  scale_org = wrapWidth/wrapHeight;

		if (wrapWidth / width > wrapHeight / height)
		{
			height_ = wrapHeight;
			width_ = width  * wrapHeight/height;
		} else
		{
			width_ = wrapWidth;
			height_ = height * wrapWidth/width;
		}
		marginLeft = (wrapWidth-width_)/2+1;
		marginTop = (wrapHeight-height_)/2+1;
		//alert(height_);
		img.style.width=width_+"px";
		img.style.height=height_+"px";
		img.style.marginLeft=marginLeft+"px";
		img.style.marginTop=marginTop+"px";					
		imgWrap.append(img);
	};

	img.onerror = function () {
		this.onload = this.onerror = null;
	};

	
	
	imgWrap.append(input);
	
	$("#pic_wrapper").append(imgWrap);		
}

<!--
var swfu = null;
function swfuInit() {
    swfu = new SWFUpload({
    // Backend Settings
    upload_url : "/merchant/product/upload",
    post_params : {"customerId":"<{$customerId}>"},
    file_post_name : "Filedata",	
    // File Upload Settings
    file_size_limit : "1000", // 2MB
    file_types : "*.jpg; *.gif; *.png;",
    file_types_description : "选择 JPEG/PNG/gif 格式文件",
    file_upload_limit : "10",
    //file_queue_limit:"1",
    file_queue_error_handler : fileQueueError,
    file_dialog_complete_handler : fileDialogComplete,
    upload_progress_handler : uploadProgress,
    upload_error_handler : uploadError,
    upload_success_handler : uploadSuccess,
    upload_complete_handler : uploadComplete,
    upload_start_handler:uploadStart,
    
    
    button_image_url : "/js/swfupload/85x100.gif",
    button_placeholder_id : "spanButtonPlaceholder",
    button_width : 85,
    button_height : 25,
    button_text : 'Upload Image',
    button_text_top_padding : 2,
    button_text_left_padding : 8,
    
    button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
    button_cursor : SWFUpload.CURSOR.HAND,
    
    // Flash Settings
    flash_url : "/js/swfupload/swfupload.swf",
    
    custom_settings : {
    upload_target : "divFileProgressContainer"
    },
    
    // Debug Settings
    debug : false
    });
};
function isurl(str_url){
   // var strregex = "(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])?";
    //var re=new RegExp(strregex);
    var regexp = new RegExp("(http[s]{0,1})://[a-zA-Z0-9\\.\\-]+\\.([a-zA-Z]{2,4})(:\\d+)?(/[a-zA-Z0-9\\.\\-~!@#$%^&amp;*+?:_/=<>]*)?", "gi");
    if (regexp.test(str_url)){
        return (true);
    }else{
        return (false);
    }
}
jQuery(function() {
    swfuInit();


    $("#uploadWebImage").click(function(){
        var web_wrap = $("<div class='web_wrap'>URL:<input type='text' class='web_img_url' value='' size='45'><img alt='delete' src='/images/minus_sign.gif' class='web_wrap_del'></div> ");
        
        var web_wrap_add = $("<div class='web_wrap_add'><img src='/images/plus_sign.gif' class='web_wrap_add_op'>&nbsp;&nbsp;<input type='button'  value='OK' class='bgBtn4 addWebImageBtn'></div>");
        var web_wrapper= $("<div class='web_wrapper'></div>");
        web_wrapper.append(web_wrap_add).append(web_wrap);
        var off =  $(this).offset();
        container_pop_show("add web image",web_wrapper.html(),true,500,off.left,off.top+25);
    });

    $(".web_wrap_add_op").live('click',function(){
        var web_wrap = $("<div class='web_wrap'>URL:<input type='text' class='web_img_url' value='' size='45'><img alt='delete' src='/images/minus_sign.gif' class='web_wrap_del'></div> ");
        $(this).parent().parent().append(web_wrap);
    });
    $(".addWebImageBtn").live('click',function(){
        $(this).parent().parent().find(".web_img_url").each(function(){
            var url = $(this).val()
            if(isurl(url)){
                if($.trim(url)!=''){
                    _loadWebImage(url);
                }
            } else{
                alert('url error');
            }
            /*if($.trim(url)!=''){
            	_loadWebImage(url);
            }*/
        });
        container_pop_hide();
    });
    $(".imgWrap").live("dblclick",function(){    	
    	$(this).remove();    	
    });
    $(".web_wrap_del").live('click',function(){
        $(this).parent().remove();
    });

    initProductImgAdapt();//see-->main.js
});

//-->
</script>

<table width="100%" cellspacing="0" cellpadding="3"
	class="formtable">
	<tr>
		<th width="120" valign='middle'>Upload:&nbsp;</th>
		<td valign='middle'>
			<div style="position: relative;">
			    <div style='width:90px;float:left;padding:0px 0 0 0px;'>
				    <span id="spanButtonPlaceholder"></span>
			    </div>
				<input type="button" style="color: #000000; font-size: 14px;font-family: monospace;" class="bgBtn4" value="Web Image" id='uploadWebImage'>
				<div id="divFileProgressContainer" class="divFileProgressContainer"></div>
				<div class='red clear' style='padding-top:10px;'>Note: Double Click Picture To Remove
				</div>
				<div style="position: relative;padding:10px 0 0;" id='pic_wrapper' class='clear'>
				<{if isset($productInfo)&&$productInfo['attach']}>
				    <{foreach from=$productInfo.attach item=att name=att}>
                        <div class="imgWrap">
                        <{if $att.pa_file_type=='img'}>
						<input type="hidden"
							value="<{$att.pa_path}>"
							name="picUrl[]"><img
							src="<{$att.url}>"
							style="width: 140px; height: 140px; display:none;" title='duble click to remove!'>
					   
					    <{else}>
					    <input type="hidden"
							value="<{$att.pa_path}>"
							name="picLink[]"><img
							src="<{$att.url}>"
							style="width: 140px; height: 140px; display:none;" title='duble click to remove!'>
					   
					    <{/if}>
					     </div>
				    <{/foreach}>				
				<{/if}>
				
				</div>
			</div>
		</td>
	</tr>
</table>