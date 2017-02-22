<script src="/dwz/uploadify/scripts/jquery.uploadify.min.js" type="text/javascript"></script>
<link href="/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
.selected{ background-color:#CC9933;}
</style>

<style>
    form strong{color:red;}
    .imgWrap2 {
        width: 100px;
        height: 76px;
        margin: 0px;
        border: 0 none;
    }
    td{
        text-align: left;
    }
    .depotForm td {
        border: 1px solid #91bcdf;
        line-height: 1.5em;
        padding: 5px;
        vertical-align: top;
    }
    .depot_path {
        text-align: right;
        width: 200px;
    }
</style>
<div id="content" xmlns="http://www.w3.org/1999/html">

<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
<div class="content-box-header">
    <h3 style="margin-left:5px"><{t}>account_baseinfo<{/t}></h3>
    <div class="clear"></div>
</div>

    <div class="depotState" style="margin-top:0px;">

        <table width="100%" cellspacing="0" cellpadding="0" border="1" class="depotForm">
            <tbody>
                <tr>
                    <td width="200" class="depot_path">企业类型：</td>
                    <{if $customer.is_ecommerce eq 1}>
                        <td width="22%">电商企业</td>
                        <{elseif $customer.is_shipping eq 1}>
                        <td width="22%">物流企业
                        <{elseif $customer.is_pay eq 1}>
                        <td width="22%">支付企业
                        <{elseif $customer.is_storage eq 1}>
                        <td width="22%">仓储企业
                        <{elseif $customer.is_supervision eq 1}>
                        <td width="22%">监管场所
                        <{elseif $customer.is_platform eq 1}>
                        <td width="22%">电商平台企业
                        <{else}>
                        <td width="22%">
                    <{/if}>
                <td class="depot_path"><{t}>主管海关<{/t}>：</td>
                <td><{$ieport.ie_port_name}></td>
                <td class="depot_path"><{t}>企业英文名<{/t}>：</td>
                <td><{$customer.trade_name_en}></td>
                <!-- <td class="depot_path"><{t}>进出口类型<{/t}>：</td>
                <{if $customer.ie_type eq 'I'}>
                <td>进口</td>
                <{elseif $customer.is_shipping eq 1}>.
                <td>出口</td>
                <{/if}> -->
            </tr>
            <tr>
                <td class="depot_path"><{t}>企业名称<{/t}>：</td>
                <td><{$customer.trade_name}></td>
                <td class="depot_path">组织机构代码：</td>
                <td><{$customer.trade_co}></td>
                <td class="depot_path">企业注册地址：</td>
                <td><{$customer.customer_address}></td>
            </tr>
            <tr>
                <td class="depot_path">邮政编码：</td>
                <td><{$customer.customer_postno}></td>
                <td class="depot_path">联系电话：</td>
                <td><{$customer.customer_telephone}></td>
                <td class="depot_path"><{t}>联系人姓名<{/t}>：</td>
                <td><{$customer.bus_name}></td>
            </tr>
            <tr>
                <td class="depot_path"><{t}>营业执照编号<{/t}>：</td>
                <td><{$customer.bus_lic_reg_num}></td>
                <td class="depot_path"><{t}>企业网址<{/t}>：</td>
                <td><{$customer.web_address}></td>
                <td class="depot_path"><{t}>registerTime<{/t}>：</td>
                <td><{$customer.customer_reg_time}></td>
            </tr>
            <tr>
                <td class="depot_path">检验检疫备案号：</td>
                <td><{$customer.ciq_reg_num}></td>
                <td class="depot_path"><{t}>检验检疫锁定<{/t}>：</td>
                <td><{if $customer.ciq_is_lock eq "1"}>已锁定<{else}>未锁定<{/if}></td>
                <td width="10%" class="depot_path"><{t}>海关备案号<{/t}>：</td>
                <td><{$customer.customs_seq_id}></td>
            </tr>
            <{if $customer.is_ecommerce eq "1"}>
                <tr>
                    <td class="depot_path"><{t}>申报单位名称<{/t}>：</td>
                    <td><{$customer.agent_name}></td>
                    <td class="depot_path"><{t}>申报单位代码<{/t}>：</td>
                    <td colspan="3"><{$customer.agent_code}></td>
                </tr>
            <{/if}>
            <{if $customer.is_ecommerce eq "1"}>
                <tr>
                    <td class="depot_path"><{t}>店铺名称<{/t}>：</td>
                    <td><{$customer.eshop_name}></td>
                    <td class="depot_path"><{t}>电商平台网站<{/t}>：</td>
                    <td><{$customer.bus_web_address}></td>
                    <td class="depot_path"><{t}>ICP备案号<{/t}>：</td>
                    <td><{$customer.cn_icp_code}></td>
                </tr>
            <{/if}>
            <tr>
                <td class="depot_path">邮箱：</td>
                <td><{$customer.customer_email}></td>
                <td width="10%" class="depot_path"><{t}>企业代码<{/t}>：</td>
                <td width="20%"><{$customer.customer_code}></td>
                <td width="10%" class="depot_path"><{t}>统一社会信用代码<{/t}>：</td>
                <td width="20%"><{$customer.credit_code}></td>
            </tr>
            
            <tr>
                <td class="depot_path">企业法人或负责人：</td>
                <td><{$customer.corporate}></td>
                <td class="depot_path">企业法人或负责人证件号码：</td>
                <td><{$customer.corporate_num}></td>
                <td class="depot_path">企业法人或负责人联系电话：</td>
                <td><{$customer.corporate_phone}></td>
            </tr>
            <tr>
                <{if $customer.is_storage eq "1" || $customer.is_ecommerce eq "1"}>
                    <td class="depot_path"><{t}>企业海关编码<{/t}>：</td>
                    <td><{$customer.customs_reg_num}></td>
                    <td class="depot_path"><{t}>检验检疫编码<{/t}>：</td>
                    <td><{$customer.ciq_num}></td>
                <{/if}> 
                <{if $customer.is_pay eq "1"}>
                    <td class="depot_path"><{t}>支付业务许可证<{/t}>：</td>
                    <td colspan="5"><{$customer.pay_bus_lic}></td>
                <{/if}> 
                <{if $customer.is_shipping eq "1"}>
                    <td class="depot_path"><{t}>快递业务许可证<{/t}>：</td>
                    <td colspan="5"><{$customer.exp_bus_lic}></td>
                <{/if}>
                <{if $customer.is_storage eq "1"}>
                    <td class="depot_path"><{t}>仓库面积<{/t}>：</td>
                    <td><{$customer.warehouse_area}>㎡</td>
                <{/if}>
                <{if $customer.is_supervision eq "1"}>
                    <td class="depot_path"><{t}>监管场所批准证书编号<{/t}>：</td>
                    <td colspan="5"><{$customer.is_supervision}></td>
             <!--    <td class="depot_path"><{t}>业务类型<{/t}>：</td>
                <td><{$business}></td> -->
                <{/if}>
            </tr>
             <tr>
                
                <{if $customer.is_supervision eq "1" || $customer.is_storage eq "1" || $customer.is_ecommerce eq "1"}>
                    <td class="depot_path">有效期：</td>
                    <td><{$customer.validity_date}></td>
                    <td class="depot_path"><{t}>业务类型<{/t}>：</td>
                    <td colspan="3"><{$business}></td>
                <{else}>
                    <td class="depot_path">有效期：</td>
                    <td colspan="5"><{$customer.validity_date}></td>
                <{/if}>
                <!--
                <{if $customer.is_storage eq "1"}>
                    <td class="depot_path"><{t}>业务类型<{/t}>：</td>
                    <td><{$business}></td>
                <{/if}>
                <{if $customer.is_ecommerce eq "1"}>
                    <td class="depot_path"><{t}>业务类型<{/t}>：</td>
                    <td><{$business}></td>
                <{/if}>
                -->
            </tr> 
            <tr>
                <td class="depot_path"><{t}>updateTime<{/t}>：</td>
                <td><{$customer.customer_update_time}></td>
                <td class="depot_path"><{t}>lastPassTime<{/t}>：</td>
                <td><{$customer.password_update_time}></td>
                <td class="depot_path"><{t}>lastLoginTime<{/t}>：</td>
                <td><{$customer.last_login_time}></td>
            </tr>
            <tr>
                <td class="depot_path"><{t}>备注<{/t}>：</td>
                <td colspan="6"><{$customer.customer_note}></td>
            </tr>
            <!--<tr>
                <td class="depot_path"><{t}>备注<{/t}>：</td>
                <td><{$customer.customer_note}></td>
            </tr>-->
            <{if $customer.ciq_reject_reason neq ''}>
            <tr>
            <td class="depot_path">备案失败回执：</td>
            <td colspan="5"><{$customer.ciq_reject_reason}></td>
            </tr>
            <{/if}>
            </tbody>
        </table>
        <div class="clr"></div>
    </div>
    <div class="depotState">
</div>
<script>
  $('#file_upload').uploadify({
		'swf'      : '/dwz/uploadify/scripts/uploadify.swf',
		//'uploader' : '/customer/customer/uploadimg',
		'uploader' : '/index/uploadimg',
        'buttonText': '<{t}>LocalPictures<{/t}>',
        'fileTypeExts': '*.jpg;*.png;*.gif',
        'formData' : { '<{$session_name}>' : '<{$sessionid}>','customerCode':'<{$customer.customer_code}>' },
        'scriptData' : { '<{$session_name}>': '<{$sessionid}>','customerCode':'<{$customer.customer_code}>' },
        'debug':false,		
        'onUploadSuccess':function(file,data,response){
            //alert(data);
            var obj = jQuery.parseJSON(data);
            _loadImage(obj.data);
           // alert(data);
            //alert( 'id: ' + file.id+ ' - 索引: ' + file.index+ ' - 文件名: ' + file.name　+ ' - 文件大小: ' + file.size+ ' - 类型: ' + file.type+ ' - 创建日期: ' + file.creationdate+ ' - 修改日期: ' + file.modificationdate+ ' - 文件状态: ' + file.filestatus　+ ' - 服务器端消息: ' + data+ ' - 是否上传成功: ' + response);
        },
        'onUploadError':function(file, errorCode, errorMsg, errorString) {
               // alert('The file ' + file.name + ' could not be uploaded: ' + errorString+':errorCode:'+errorCode);
        }
  });
  
  
function _loadImage(serverData) {
	$("#pic_wrapper").empty();
    var url = serverData.url;	
    var imgWrap = $("<div class='imgWrap' style='height:160px;'></div>");
//	var fancybox = 	$("<a class='fancybox' href='"+serverData.url+"' data-fancybox-group='gallery' ></a>");
//	var img = $("<img src='"+serverData.thumb+"'/>");
//	fancybox.append(img);
    var input = $("<input type='hidden' name='picUrl[]' value='"+serverData.file_path+"'>");
	
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
    imgWrap.append('<img class="web_wrap_del" src="/images/minus_sign.gif" style="cursor: pointer;" alt="delete" class="deleteImage">');


    $("#pic_wrapper").append(imgWrap);

}  


    $(".imgWrap").live("dblclick",function(){
        $(this).remove();
    });
    $(".deleteImage").live("click",function(){
        $(this).parent(".imgWrap").remove();
    })
    $(".web_wrap_del").live('click',function(){
        $(this).parent().remove();
    });



 	$('.cbcheckAll').die('click').live('click',function(){
        if ($(this).is(':checked')) {
            $(".cb_arr").attr('checked', true);
			
        } else {
            $(".cb_arr").attr('checked', false);
        }
		changeTrColor();
    });
	

	
	
	/*伴随全选按钮是否选中而变色*/
	function changeTrColor(){
	
		$(".cb_arr").each(function(){
				_this = $(this);
				if($('.cbcheckAll').is(':checked')){			
					set_tr_class(_this.parent().parent(), true);			
				}else{			
					set_tr_class(_this.parent().parent(), false);		
				}					
						
		});		
	}
	

function set_tr_class(element, selected) {
    if (selected) {		
		if(!element.hasClass('selected')){
        	element.attr("class", "selected " + element.attr("class"));
		}
    } else {
        var css = element.attr("class");
        var position = css.indexOf('selected');

        element.attr("class", css.substring(position + 9));
    }
	
}	


$(function(){

 $('#exportTypeBox').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 850,
			position:[50,50],
            resizable: false,
            close:function(){
                //alert('close');
            },buttons:{
                '关闭': function() {
                    $('#exportTypeBox').dialog('close');
                },'确定': function() {

                    var exportType = $('[name=exportType]:checked').val();
                    //var exportformat = $('[name=exportformat]:checked').val();
					var exportformat = 'xls';				
                    $('.dateformate').val(exportformat);
                    if(exportType=='1'){
                        //选择的订单               

                        var param = $("#dataForm").serialize();						
                        var checkedSizesize = $('.cb_arr:checked').size();
                        if(checkedSizesize<=0){
                            alertTip("请选择至少一条交易记录",'500','auto','1');
                            return;
                        }
                        //alert($('#pagerForm').attr('action'));

                        $('#dataForm').attr('action','/customer/customer/export-transaction-records/customer_code/<{$customer.customer_code}>');
                        $('#dataForm').attr('method','POST');
                        $('#dataForm').submit();				
                        //$('#orderDataForm').removeAttr('action');
                        //$('#orderDataForm').removeAttr('method');

                    }else if(exportType=='0'){
                        //全部的订单
						
                        $('#pagerForm').attr('action','/customer/customer/export-transaction-records/customer_code/<{$customer.customer_code}>');
                        $('#pagerForm').attr('method','POST');
                        $('#pagerForm').submit();
                       
                        //$('#orderDataForm').removeAttr('method');

                    }
                    return;
                }
            }
        });	
});	
</script>
<div>
