<style>
    <!--
    .tabContent {
        display: none;
    }

    .imgWrap {
        width: 100px;
        height: 76px;
        margin: 0px;
        border: 0 none;
    }
.images-box { min-height: 90px; border: 1px #aaaaaa dashed; box-sizing: border-box; /*overflow: scroll;*/}
.images-box > div { display: inline-block; box-orient: horizontal; box-pack: center; box-align: center; position: relative; }
.images-box > div > .img {margin: 5px; max-width: 80px; max-height: 80px; -moz-border-bottom-colors: none; -moz-border-left-colors: none; -moz-border-right-colors: none; -moz-border-top-colors: none; background-color: #fff; border-bottom-color: #3c763d; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; border-bottom-style: solid; border-bottom-width: 1px; border-image-outset: 0 0 0 0; border-image-repeat: stretch stretch; border-image-slice: 100% 100% 100% 100%; border-image-source: none; border-image-width: 1 1 1 1; border-left-color: #3c763d; border-left-style: solid; border-left-width: 1px; border-right-color: #3c763d; border-right-style: solid; border-right-width: 1px; border-top-color: #3c763d; border-top-left-radius: 4px; border-top-right-radius: 4px; border-top-style: solid; border-top-width: 1px; display: inline-block; line-height: 1.42857; max-width: 100%; padding-bottom: 4px; padding-left: 4px; padding-right: 4px; padding-top: 4px; transition-delay: 0s; transition-duration: 0.2s; transition-property: all; transition-timing-function: ease-in-out; float: left;}
.images-box > div > span.img { width: 80px; height: 80px; background-color: #3c763d; font-size: 24px; font-weight: bold; text-align: center; line-height: 80px;}
.images-box > div > .img:hover{opacity:0.2;}
.images-box > div > .opacity  {opacity:0.2;}
.images-box > div > div { position: absolute; width: 100%; box-pack: center; box-align: center; left: 0; top: 0; text-align: center; font-weight: bold; }
.images-box > div > a{ background-image: url(/images/icons/icon_missing.png); height: 17px; width: 17px; display: block; position: absolute; z-index: 99; right: 4px; top: 4px;}

    -->
</style>


<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-thumbs.css" />

<script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/js/fancybox/jquery.fancybox-thumbs.js"></script>

<div class="content-box  ui-tabs  ui-corner-all" >
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>ProductDetail<{/t}></h3>        
    </div>
<div style="margin-right: 0px; padding: 6px;" class="content-box nbox_c marB10 product_detail cl">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder" width='100%'>
        <tbody>
        <tr>
            <th>进出口类型：</th>
            <td><{$ieType[$productRow.ie_type]}>&nbsp;&nbsp;【 <{$productRow.ie_type}> 】</td>
            <th>主管海关代码：</th>
            <td><{$iePortInfo.ie_port_name}>&nbsp;&nbsp;【 <{$productRow.customs_code}> 】</td>
        </tr>
        <tr>
            <th>属地检验检疫机构</th>
            <td><{$productRow.ins_unit_name}></td>
            <th><{t}>pname<{/t}>：</th>
            <td><{$productRow.product_title}></td>
        </tr>
        <tr>
            <th><{t}>productBarcode1<{/t}>：</th>
            <td><{$productRow.product_barcode}></td>
            <th>电商企业代码：</th>
            <td><{$productRow.customer_code}></td>
        </tr>
        <tr>
            <th>电商企业名称：</th>
            <td><{$productRow.enp_name}></td>
            <th>申报单位企业代码：</th>
            <td><{$productRow.storage_customer_code}></td>
        </tr>
        <tr>
            <th>申报单位企业名称：</th>
            <td><{$productRow.storage_enp_name}></td>        
            <th>申报单位操作人代码：</th>
            <td><{$productRow.storage_account_code}></td>
        </tr>
        <tr>
            <th>品牌:</th>
            <td ><{$productRow.brand}></td>        
            <th>商品货号：</th>
            <td><{$productRow.product_sku}></td>
        </tr>
         <tr>
            <th>申报单位：</th>
            <td><{$productRow.product_uom}>&nbsp;&nbsp;【<{$productRow.pu_code}>】</td>
            <th>法定单位：</th>
            <td><{$productRow.first_uom}>&nbsp;&nbsp;【<{$productRow['g_unit']}>】</td>
        </tr>
        <tr>
            <th>第二单位:</th>
            <td ><{$productRow.second_uom}>&nbsp;&nbsp;【<{$productRow['second_unit']}>】</td>
            <th>毛重(KG)：</th>
            <td><{$productRow.product_weight}></td>
        </tr>
        <tr>
            <th>净重(KG)：</th>
            <td><{$productRow.product_net_weight}></td>
            <th><{t}>申报币制<{/t}>：</th>
            <td><{$currency[$productRow.currency_code]}>&nbsp;&nbsp;【<{$productRow.currency_code}>】</td> 
        </tr>
        <tr>
            <th><{t}>declaredValue<{/t}>：</th>
            <td><{$productRow.product_declared_value}></td>
            <th>规格型号:</th>
            <td><{$productRow.product_model}></td>
        </tr>
        <tr>
            <th>海关商品编码：</th>
            <td><{$productRow.hs_code}></td>
            <th><{t}>productStatus<{/t}>：</th>
            <td>
                <{if isset($productStatus[$productRow.product_status])}>
                    <{$productStatus[$productRow.product_status]}>
                <{else}>
                    <{$productRow.product_status}>
                <{/if}>
            </td>
        </tr>
        <tr>
            <th><{t}>country_code_of_origin<{/t}>：</th>
            <{if isset($productRow.country_code_of_origin_name)}>
            <td><{$productRow.country_code_of_origin}>&nbsp;&nbsp;<{$productRow.country_code_of_origin_name}></td>
            <{else}>
            <td></td>
            <{/if}>        
            <th>海关状态：</th>
            <td>
                <{if isset($customsStatus[$productRow.customs_status])}>
                    <{$customsStatus[$productRow.customs_status]}>
                <{else}>
                    <{$productRow.customs_status}>
                <{/if}>
            </td>
        </tr>
        <tr>
            <th>检验检疫状态：</th>
            <td>
                <{if isset($ciqStatus[$productRow.ciq_status])}>
                    <{$ciqStatus[$productRow.ciq_status]}>
                <{else}>
                    <{$productRow.ciq_status}>
                <{/if}>
            </td>        
            <th>主要成分：</th>
            <td><{$productRow.element}></td>
        </tr>
        <tr>
            <th>用途：</th>
            <td><{$productRow.use_way}></td>
            <th>生产企业：</th>
            <td><{$productRow.enterprises_name}></td>
        </tr>
        <tr>
            <th>供应商：</th>
            <td><{$productRow.supplier}></td>
            <th><{t}>goodsTaxCode<{/t}>：</th>
            <{if isset($productRow.gt_code) && $productRow.gt_code}>
            <td><{$productRow.gt_name}>&nbsp;&nbsp;【<{$productRow.gt_code}>】</td>
            <{else}>
            <td></td>
            <{/if}>
        </tr>
        <tr>
            <th><{t}>parcelTax<{/t}>：</th>
            <td><{$productRow.parcel_tax}></td>
            <th><{t}>ProductAddTime<{/t}>：</th>
            <td><{$productRow.product_add_time}></td>
        </tr>
        <tr>
            <th><{t}>LastUpdatedProducts<{/t}>：</th><td><{$productRow.product_update_time}></td>
            <th>海关备案编号：</th>
            <td><{$productRow.registerID}></td>
        </tr>
		<tr>
            <th>是否锁定：</th><td><{if $productRow.is_lock eq 'N'}>否<{else if $productRow.is_lock eq 'Y'}>是<{/if}></td>
            <th>海关品名：</th>
            <td><{$productRow.hs_goods_name}></td>
        </tr>
        <tr>
            <th><{t}>remark<{/t}>：</th>
            <td><{$productRow.product_description}></td>
            <th>检验检疫备案编号：</th>
            <td><{$productRow.inspection_code}></td>
        </tr>
        <{if $productRow.ciq_reject_reason neq ''}>
        <tr>
            <th>商检错误回执：</th>
            <td colspan="3"><{$productRow.ciq_reject_reason}></td>
        </tr>
        <{/if}>
        </tbody>
    </table>
</div>



<div class="tabs_header cl content-box-header" style="margin: 10px 0 4px;">
    <ul class="tabs cl" style="padding-top: 2px;">
        <li class='active'>  <a href="javascript:;" id='tab_productlog' class='tab'><span><{t}>ProductLogs<{/t}></span></a></li>
        <li><a href="javascript:;" id='tab_orderProduct' class='tab'><span><{t}>ProductOrders<{/t}></span></a></li>
        <li><a href="javascript:;" id='tab_productImage' class='tab'><span>附件信息</span></a></li>
    </ul>
</div>

<div class='tabContent' id='productlog'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th align="center" width="100px"><{t}>LogType<{/t}></th>
            <th align="center" width="100px"><{t}>operater<{/t}></th>
            <th align="center" width="150px"><{t}>addTime<{/t}></th>
            <th align="center" width="100px"><{t}>AccessIP<{/t}></th>
            <th align="center" ><{t}>remark<{/t}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach from=$productLog item=row}>
        <tr>
            <td><{if $row.pl_type eq "1"}><{t}>StateModification<{/t}><{else}><{t}>ContentModification<{/t}><{/if}></td>
            <td><{if $row.customer_id > 0}><{$row.account_name}><{else}><{t}>system<{/t}><{/if}></td>
            <td><{$row.pl_add_time}></td>
            <td><{$row.pl_ip}></td>
            <td><{$row.pl_note}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
	
</div>


<!--产品订单-->
<div class='tabContent' id='orderProduct'>
    <table  cellspacing="0" cellpadding="0" class="formtable tableborder" >
        <thead>
        <tr>
            <th align="center" ><{t}>orderCode<{/t}></th>
            <th align="center" >海关备案编号</th>
            <th align="center" ><{t}>quantity<{/t}></th>           
         <!--    <th align="center" ><{t}>addTime<{/t}></th>
            <th align="center" ><{t}>lastEditTime<{/t}></th> -->
        </tr>
        </thead>
        <tbody>
        <{foreach from=$orderProduct item=row}>
        <tr>
            <td style='text-align:center'><{$row.order_code}></td>
            <td  style='text-align:center'><{$productRow.registerID}></td>
            <td  style='text-align:center'><{$row.quantity}></td>           
   <!--          <td  style='text-align:center'><{$row.op_add_time}></td>
            <td  style='text-align:center'><{$row.op_update_time}></td> -->
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>




<div class='tabContent' id='productImage'>
   <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th>附件名称</th>
            <th>附件类型</th>
            <th>附件内容</th>
            <th><{t}>addTime<{/t}></th>
        </tr>
        </thead>
        <{foreach from=$productImage item=row}>
        <tr>
            <td><{$row.pa_name}></td>
            <td><{if isset($attachedType[$row.pa_type])}><{$attachedType[$row.pa_type]}><{/if}></td>
            <td>
                <div class="imgWrap" style=" white-space: nowrap; ">
                    <{*<a data-fancybox-group="gallery" class="fancybox"*}>
                    <a
                    <{if $row.pa_file_type eq "img"}>
                        href="/merchant/product/view-attach/aid/<{$row.pa_id}>"
                    <{else}>
                        href="<{$row.pa_path}>"
                    <{/if}> style="width:76px;" target="_blank">
                        <img 
                        <{if $row.pa_file_type eq "img"}>
                            src="data:image/png;base64,<{$row.pa_content}>"
                        <{else}>
                            src="<{$row.pa_path}>"
                        <{/if}>
                             style="width: 100px; height: 75px; margin-left: 1px; margin-top: 1px;">
                    </a>
                </div>
            </td>
            <td><{$row.pa_update_time}></td>
        </tr>
        <{/foreach}>
    </table>
</div>


<div class='clear'></div>
</div>


</div>
<script type="text/javascript">

    $(function(){
		//$(".tabContent").show();
        $(".tab").click(function(){
            $(".tabContent").hide();
			// $(".tabContent").show();
			//return;
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
            $("#"+$(this).attr("id").replace("tab_","")).show();
        });



        //$(".tabContent").eq(0).show();
        $("#productlog").show();

        $('.fancybox').fancybox({
            prevEffect	: 'none',
            nextEffect	: 'none',
            loop : true,
            autoPlay : false,
            helpers	: {
                title	: {
                    type: 'outside'
                },
                overlay	: {
                    opacity : 0.8,
                    css : {
                        'background-color' : '#000'
                    }
                },
                thumbs	: {
                    width	: 100,
                    height	: 100
                }
            }
        });

    });
	
	var product_sku = "";
	//page,rec_num,pageSize,url,page_size_max
    function multiPage(page,total,pageSize,url,page_size_max){
        var html = '<div url="'+url+'" pagenumshown="10" currentpage="'+page+'" numperpage="'+pageSize+'" totalcount="'+total+'" targettype="navTab" class="pagination">';
        html+='<a href="#" class="prev" onclick="loadData(1,'+pageSize+',\''+url+'\')"><{t}>home<{/t}></a>';

        totalPage = Math.ceil(total/pageSize);
        pnl = 6;
        page = parseInt(page);
        page = (page<1 || page>totalPage)?1:page;
        start_page = page-3>0?page-3:1;
        end_page = page+2>=6?page+2:6;
        if(end_page>totalPage) end_page = totalPage;
        if(page>1){
            prePage = parseInt(page)-1;
            html+='<a href="#" class="prev" onclick="loadData('+prePage+','+pageSize+',\''+url+'\')">&lt; <{t}>Previous<{/t}></a>';
        }else{
            html+='<a href="#" class="prev">&lt; <{t}>Previous<{/t}></a>';
        }
        for(i=start_page;i<=end_page;i++){
            if(i==page){
                html+='<span class="current">'+page+'</span>';
            }else{
                html+='<a href="#" onclick="loadData('+i+','+pageSize+',\''+url+'\')">'+i+'</a>';
            }
        }
        if(page<end_page){
            nextPage = parseInt(page)+1;
            html+='<a href="#" class="next" onclick="loadData('+nextPage+','+pageSize+',\''+url+'\')"><{t}>Next<{/t}> &gt;</a>';
        }else{
            html+='<a href="#" class="next"><{t}>Next<{/t}> &gt;</a>';
        }
        html+='<a href="#" class="last" onclick="loadData('+totalPage+','+pageSize+',\''+url+'\')"><{t}>LastPage<{/t}></a>';
        html+='<label><{t}>Show<{/t}>&nbsp;<input type="text" onkeydown="return onlyNum(this)" onchange="changePageSize(this,'+page+',\''+url+'\')" style="width:25px;ime-mode:Disabled;" value="'+pageSize+'" id="pageSize">&nbsp;    </label>';
        html+='<label style="margin-left:0px;padding-left:0px"><span style="padding-right:0px;margin-right:0px"><{t}>Total<{/t}>：</span><span style="font-weight:bold; margin:0;padding-left:0px">'+totalPage+'</span></label>';
        html+='<div class="clear"></div>';
        html+="</div>";
        return html;
    }

    function onlyNum(obj){
        return true;
    }

    function changePageSize(obj,page,url){
        pageSize = $(obj).val();
        var reg1 =  /^\d+$/;
        if(!pageSize.match(reg1)){
            alert('<{t}>numeric<{/t}>');
            return false;
        }
        $.ajax({
            type:'Post',
            async: false,
            url:url,
            data:'page='+page+'&pageSize='+pageSize,
            dataType:'json',
            success:function(json){
                var html="";
                $.each(json.data,function(k,v){
                    html+="<tr>";
                    html+="<td>"+product_sku+"</td>";
                    html+="<td>"+ v.warehouse_name+"</td>";
                    html+="<td>"+ v.pil_onway+"</td>";
                    html+="<td>"+v.pil_pending+"</td>";
                    html+="<td>"+v.pil_sellable+"</td>";
                    html+="<td>"+v.pil_unsellable+"</td>";
                    html+="<td>"+v.pil_reserved+"</td>";
                    html+="<td>"+v.pil_shipped+"</td>";
                    html+="<td>"+v.pil_expire+"</td>";
                    html+="<td>"+v.from_it_code+"</td>";
                    html+="<td>"+v.to_it_code+"</td>";
                    html+="<td>"+v.pil_quantity+"</td>";
                    html+="<td>"+v.pil_add_time+"</td>";
                    html+="</tr>";
                });
                var pagination = multiPage(json.page,json.total,json.pageSize,json.url,1000);
                html+='<tr>';
                html+='<td colspan="11">'+pagination+'</td>';
                html+='</tr>';
                $("#inventoryLogData").html(html);
                $("#inventoryLog>table").alterBgColor();
            }
        });
    }

    function loadData(page,pageSize,url){
        $.ajax({
            type:'Post',
            async: false,
            url:url,
            data:'page='+page+'&pageSize='+pageSize,
            dataType:'json',
            success:function(json){
                var html="";
                $.each(json.data,function(k,v){
                    html+="<tr>";
                    html+="<td>"+product_sku+"</td>";
                    html+="<td>"+ v.warehouse_code+"</td>";
                    html+="<td>"+ v.pil_onway+"</td>";
                    html+="<td>"+v.pil_sellable+"</td>";
                   <{* html+="<td>"+v.pil_unsellable+"</td>";*}>
                    html+="<td>"+v.pil_reserved+"</td>";
                    html+="<td>"+v.pil_shipped+"</td>";
                    html+="<td>"+v.from_it_code+"</td>";
                    html+="<td>"+v.to_it_code+"</td>";
                    html+="<td>"+v.pil_quantity+"</td>";
                    html+="<td>"+v.pil_add_time+"</td>";
                    html+="</tr>";
                });
                var pagination = multiPage(json.page,json.total,json.pageSize,json.url,1000);
                html+='<tr>';
                html+='<td colspan="11">'+pagination+'</td>';
                html+='</tr>';
                $("#inventoryLogData").html(html);
                $("#inventoryLog>table").alterBgColor();
            }
        });
    }
    //-->
</script>
<script>
$(function(){
   //按默认类   
    $("table").alterBgColor();
    
})
</script>