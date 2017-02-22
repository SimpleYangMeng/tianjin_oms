<style type="text/css">
    .simple-table th { text-align: right; width: 110px;}
    .b-custom-select__title__text { margin: 4px 30px 3px 10px;}
</style>
<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">个人物品清单列表</h3>
    </div>
    <div class="pageHeader"> 
        <form name="searchASNForm"  method="post" action="/merchant/personal-items/list" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>
            <input type="hidden" name="customs_status" value="<{$condition['customs_status']}>" />
            <div class="searchBar">
                <table cellpadding="0" cellspacing="0" border="0" class="simple-table">
                    <tr>
                        <th>订单号：</th>
                        <td>
                            <input type="text" name="order_code" value="<{$condition['order_code']}>" class="text-input fix-medium1-input"/>
                        </td>
                        <th>运单号：</th>
                        <td>
                            <input type="text" name="wb_code" value="<{$condition['wb_code']}>" class="text-input fix-medium1-input"/>
                        </td>
                        <th>支付单号：</th>
                        <td>
                            <input type="text" name="po_code" value="<{$condition['po_code']}>" class="text-input fix-medium1-input"/>
                        </td>
                    </tr>
                    <tr>
                        <th>检验检疫状态：</th>
                        <td>
                            <select name="ciq_status">
                                <option value="" <{if $condition['ciq_status'] === ''}>selected<{/if}>>全部</option>
                                <{foreach from=$ciqStatus item=item key=key}>
                                <option value="<{$key}>" <{if $condition['ciq_status'] !== '' && $condition['ciq_status'] == $key}>selected<{/if}>><{$item}></option>
                                <{/foreach}>
                            </select>
                        </td>
                        <th>物品清单号：</th>
                        <td>
                            <input type="text" name="pim_code" value="<{$condition['pim_code']}>" class="text-input fix-medium1-input"/>
                        </td>
                        <th>企业清单编号：</th>
                        <td>
                            <input type="text" name="pim_reference_no" value="<{$condition['pim_reference_no']}>" class="text-input fix-medium1-input"/>
                        </td>
                        <!--
                        <th>电商企业代码：</th>
                        <td>
                            <input type="text" name="customer_code" value="<{$condition['customer_code']}>" class="text-input fix-medium1-input"/>
                        </td>
                        -->
                    </tr>
                    <!--
                    <tr>
                        <th>物流企业代码：</th>
                        <td>
                            <input type="text" name="logistic_customer_code" value="<{$condition['logistic_customer_code']}>" class="text-input fix-medium1-input"/>
                        </td>
                        <th>支付企业代码：</th>
                        <td colspan="3">
                            <input type="text" name="pay_customer_code" value="<{$condition['pay_customer_code']}>" class="text-input fix-medium1-input"/>
                        </td>
                    </tr>
                    -->
                    <tr>
                        <th>海关状态：</th>
                        <td>
                            <select name="customs_status">
                                <option value="" <{if $condition['customs_status'] === ''}>selected<{/if}>>全部</option>
                                <{foreach from=$customsStatusRows item=item key=key}>
                                <option value="<{$key}>" <{if $condition['customs_status'] !== '' && $condition['customs_status'] == $key}>selected<{/if}>><{$item}></option>
                                <{/foreach}>
                            </select>
                        </td>
                        <th>添加时间：</th>
                        <td colspan="3">                  
                            <input type="text" name="start_time" value="<{$condition['order_add_time']}>" class="datepicker text-input width140" readonly="true"/>    
                            <label><{t}>To<{/t}>
                            <input type="text" name="end_time" value="<{$condition['order_end_time']}>" class="datepicker text-input width140" readonly="true"/>
                            </label>
                            <label>
                                <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a> 
                            </label>                            
                        </td>
                    </tr>
                </table>
                <!-- <table>
                    <tr>
                        <td>                            
                            <label>订单号：
                                <input type="text" name="order_code" value="<{$condition['order_code']}>" class="text-input fix-medium1-input"/>
                            </label>                
                            <label>运单号：
                                <input type="text" name="wb_code" value="<{$condition['wb_code']}>" class="text-input fix-medium1-input"/>
                            </label>
                            <label>支付单号：
                                <input type="text" name="po_code" value="<{$condition['po_code']}>" class="text-input fix-medium1-input"/>
                            </label>                
                            <label>物品清单号：
                                <input type="text" name="pim_code" value="<{$condition['pim_code']}>" class="text-input fix-medium1-input"/>
                            </label>                       
                            <label>企业清单内部编号：
                                <input type="text" name="pim_reference_no" value="<{$condition['pim_reference_no']}>" class="text-input fix-medium1-input"/>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>                            
                            <label>电商企业代码：
                                <input type="text" name="customer_code" value="<{$condition['customer_code']}>" class="text-input fix-medium1-input"/>
                            </label> 
                            <label>物流企业代码：
                                <input type="text" name="logistic_customer_code" value="<{$condition['logistic_customer_code']}>" class="text-input fix-medium1-input"/>
                            </label>                        
                            <label>支付企业代码：
                                <input type="text" name="pay_customer_code" value="<{$condition['pay_customer_code']}>" class="text-input fix-medium1-input"/>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>                      
                            <label>添加时间：                      
                            <input type="text" name="start_time" value="<{$condition['order_add_time']}>" class="datepicker text-input width140" readonly="true"/>
                            </label>    
                            <label><{t}>To<{/t}>
                            <input type="text" name="end_time" value="<{$condition['order_end_time']}>" class="datepicker text-input width140" readonly="true"/>
                            </label>                             
                        
                            <label>
                                <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a> 
                            </label>                            
                        </td>
                    </tr>
                </table> -->
            </div>
        </form>
    </div>
</div>
<div class="btn_wrap">    
    <input class="statusBtn btn <{if empty($condition['status']) && !is_numeric($condition['status'])}>btn-active<{/if}>" value="全部<{$statusGroupRows.statusTotal}>" name="status" type='button'>
    <{foreach from=$appStatusRows item=appStatusRow name=appStatusRow key=key}>
    <{if isset($statusGroupRows[$key])}>
    <input class="statusBtn btn<{if $condition['status']==$key && is_numeric($condition['status'])}> btn-active<{/if}>" value="<{$appStatusRow}>(<{$statusGroupRows[$key]}>)" name="status" type='button' ref='<{$key}>'>
    <{else}>
    <input class="statusBtn btn<{if $condition['status']==$key && is_numeric($condition['status'])}> btn-active<{/if}>" value="<{$appStatusRow}>(0)" name="status" type='button' ref='<{$key}>'>
    <{/if}>
    <{/foreach}>
</div>

<div class="bulk-actions align-left"  style="margin-top: 10px;margin-bottom:10px; border-radius: 4px 4px 4px 4px;">
    <{if $status eq "0"}>
    <a class="button" href="#" onclick="compare();">三单对碰</a>
    <{/if}>
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
                <{if $customerType != 'is_storage'}>            
                <th>仓储企业代码</th>
                <{/if}>
                <{if $customerType != 'is_shipping'}> 
                <th>物流企业代码</th>    
                <{/if}>
                <{if $customerType != 'is_pay'}>            
                <th>支付企业代码</th> 
                <{/if}>
                <{if $customerType != 'is_ecommerce'}> 
                <th>电商企业代码</th> 
                <{/if}>
                -->
                <th style="width: 200px;">申报时间</th>
                <th style="width: 260px;">添加时间</th>
                <th style="width: 200px;">操作</th>
            </tr>
        </thead>
        <tbody>    
            <{if $personItemRows}>
            <{foreach from=$personItemRows item=personItemRow name=personItemRow}>       
            <tr>
                <td class="text_center" style="vertical-align:middle;" width='250'>
                    <{if $personItemRow.customs_status=='1' && $personItemRow.is_comparison=='0'}>
                    <input type="checkbox" name="orderArr[]" ref="<{$personItemRow.pim_code}>" class="orderArr" value="<{$personItemRow.pim_code}>" />
                    <{/if}>
                    <{$personItemRow.pim_code}>
                </td>
                <td style="vertical-align:middle;">海关：<{$customsStatusRows[$personItemRow.customs_status]}><br/>检验检疫：<{$ciqStatus[$personItemRow.ciq_status]}></td>
                <td class="text_center" style="vertical-align:middle;"><{$personItemRow.order_code}></td>
                <td class="text_center" style="vertical-align:middle;"><{$personItemRow.wb_code}></td>
                <td class="text_center" style="vertical-align:middle;"><{$personItemRow.po_code}></td>
                <!--
                <{if $customerType != 'is_storage'}>            
                <td class="text_center" style="vertical-align:middle;" style="vertical-align:middle;"><{$personItemRow.storage_customer_code}></td>
                <{/if}>
                <{if $customerType != 'is_shipping'}> 
                <td class="text_center" style="vertical-align:middle;"><{$personItemRow.logistic_customer_code}></td>    
                <{/if}>
                <{if $customerType != 'is_pay'}>            
                <td class="text_center" style="vertical-align:middle;"><{$personItemRow.pay_customer_code}></td> 
                <{/if}>
                <{if $customerType != 'is_ecommerce'}> 
                <td class="text_center" style="vertical-align:middle;"><{$personItemRow.customer_code}></td> 
                <{/if}>
                -->   
                <td class="text_center" style="vertical-align:middle;"><{$personItemRow.declare_date}></td>
                <td class="text_center" style="vertical-align:middle;"><{$personItemRow.pim_add_time}></td>
                <td class="text_center" style="vertical-align:middle;">
                    <{if $personItemRow.customs_status=='2'}>
                         <a href="javascript:void(0);" onclick="parent.openMenuTab('/merchant/personal-items/edit/pim_code/<{$personItemRow.pim_code}>','修改清单:<{$personItemRow.pim_code}>','<{$personItemRow.pim_id}>');return false;">修改 </a>
                    <{/if}>
                    <a href="javascript:void(0);" onclick="parent.openMenuTab('/merchant/personal-items/view/pim_code/<{$personItemRow.pim_code}>','查看清单:<{$personItemRow.pim_code}>','<{$personItemRow.pim_code}>');return false;">查看 </a>
                </td>
            </tr>
            <{/foreach}>
            <{else}>
            <tr>
                <td class="text_center" style="vertical-align:middle;" width='250'></td>
                <td colspan="7" class="text_center">暂无数据</td>
            </tr>
            <{/if}>
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
<div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>

