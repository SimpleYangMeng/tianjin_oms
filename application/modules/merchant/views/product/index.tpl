<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
<div class="content-box-header" style="margin-top:5px">
    <h3 style="margin-left:5px"><{t}>ProductList<{/t}></h3>
    <div class="clear"></div>
</div>
    <form action="/merchant/product/index" method="post"  id="pagerForm">
        <input type="hidden" name="page" value="1" id="page" />
        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />
            <table class="left searchbartable" id="searchbox" style="word-wrap:break-word;table-layout:fixed;">
                <tr>
                    <th  class="nowrap">
                        <span class="nowrap">主管海关代码：</span>
                    </th>
                    <td>
                        <select name="customs_code" class="text-input width155">
                            <option value=''>全部</option>
                                <{foreach from=$customs item=item key=k }>
                                    <option value="<{$item['ie_port']}>" <{if isset($condition)&&($condition.customs_code ==$item['ie_port']) }>selected<{/if}>><{$item['ie_port_name']}></option>
                                <{/foreach}>
                        </select>
                        <div class="simplesearchsubmit" style="display:inline-block;"> 
                                <a onclick="searchForm()" class="button"><{t}>search<{/t}></a>   
                                <!-- <a onclick="exportData()" class="button"><{t}>export<{/t}></a>  -->
                                <a class="switch_search_model"><{t}>switch_to_advanced_search<{/t}></a> 
                        </div>
                    </td>
                    <!--123-->
                        <th  class="advanced_element">
                            进出口类型：
                        </th>
                        <td>
                            <span class="advanced_element">
                                <select class="text-input width155" name="ie_type">
                                    <option value="">全部</option>
                                    <{foreach from=$ieType item=item key=k }>
                                        <option value="<{$k}>" <{if ($k ==$condition.ie_type) }>selected<{/if}>><{$item}>
                                        </option>
                                    <{/foreach}>
                                </select>
                            </span>
                            
                        </td>
                        <!--123-->


                    <th  class="nowrap advanced_element">
                        <span class="advanced_element">属地检验检疫机构：</span>
                    </th>
                    <td>
                        <span class="advanced_element">
                            <select name="ins_unit_code" class="fix-medium2-input" style="width: 155px;">
                                <option value="">全部</option>
                                <{foreach from=$checkOrg item=item key=k }>
                                <option value="<{$item['organization_code']}>" <{if isset($condition)&&($condition.ins_unit_code ==$item['organization_code']) }>selected<{/if}>><{$item['organization_name']}>
                                </option>
                                <{/foreach}>
                            </select>
                        </span>
                    </td>
                    
                    <!--<th  class="nowrap advanced_element">
                        <span class="advanced_element"><{t}>productTitle<{/t}>：</span>
                    </th>
                    <td>
                        <span class="advanced_element"><input type="text" name="title" value="<{$condition.product_title}>" class='text-input width140'/></span>
                    </td>-->
                    <!-- <th class="nowrap">
                        <span class="advanced_element">海关编码：</span>
                    </th>
                    <td>
                        <span class="advanced_element">
                            <input type="text" name='hs_code' value="<{$condition.hs_code}>" class='text-input width155'/>
                        </span>
                    </td> -->
                </tr>
                <tr class="advanced_element">
                    <th  class="nowrap advanced_element">
                        <span class="advanced_element">海关备案编号：</span>
                    </th>
                    <td>
                        <span class="advanced_element">
                        <input type="text advanced_element" name="registerID" value="<{$condition.registerID}>" class='text-input width140'>
                            </span>
                    </td>
                    <th>检验检疫状态：</th>
                    <td>
                        <span class="advanced_element">
                           <select class="text-input width155" name="ciqStatus">
                               <option value="">全部</option>
                               <{foreach from=$ciqStatus item=item key=k }>
                                   <option value="<{$k}>" <{if isset($condition)&&($condition.product_status ===$k) }>selected<{/if}>><{$item}></option>
                               <{/foreach}>

                           </select>
                        </span>
                    </td>
                    <th>海关状态：</th>
                    <td>
                        <span class="advanced_element">
                           <select class="text-input width155" name="customsStatus">
                               <option value="">全部</option>
                               <{foreach from=$customsStatus item=item key=k }>
                                   <option value="<{$k}>" <{if isset($condition)&&($condition.product_status === $k) }>selected<{/if}>><{$item}></option>
                               <{/foreach}>

                           </select>
                        </span>
                    </td>
                </tr>
                <tr class="advanced_element"> 
                        <th  class="nowrap">
                            <span class="advanced_element">海关商品编码：</span>
                        </th>
                        <td>
                            <input type="text" name='hs_code' value="<{$condition.hs_code}>" class='text-input width155'/>
                        </td>
                        <th >
                            商品状态：
                        </th>
                        <td>
                            <span class="advanced_element">
                               <select class="text-input width155" name="productStatus">
                                   <option value="">全部</option>
                                   <{foreach from=$productStatus item=item key=k }>
                                       <option value="<{$k}>" <{if isset($condition)&&($condition.product_status === $k) }>selected<{/if}>><{$item}></option>
                                   <{/foreach}>

                               </select>
                            </span>
                        </td>
                        
                        <th>
                            <{t}>addTime<{/t}>：

                        </th>
                        <td colspan="2">
                            <input type="text" name="start_time" class="datepicker text-input width140" readonly="true"   value="<{$condition.product_add_time}>" /> &nbsp;<{t}>To<{/t}>&nbsp;
                            <input type="text" name="end_time" class="datepicker text-input width140" readonly="true"   value="<{$condition.product_end_time}>" />
                        </td>
                  </tr>
                 <tr class="advanced_element">
                     <th  class="nowrap advanced_element">
                         <span class="advanced_element"><{t}>productTitle<{/t}>：</span>
                     </th>
                     <td>
                         <span class="advanced_element"><input type="text" name="title" value="<{$condition.product_title}>" class='text-input width140'/></span>
                     </td>
                  </tr>
                  <tr >  
                        <td colspan="6" >
                            <div class="advancedsearchsubmit">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a onclick="searchForm()" class="button"><{t}>search<{/t}></a> 
                            <!-- <a onclick="exportData()" class="button"><{t}>export<{/t}></a>  -->
                            <a class="switch_search_model"><{t}>switch_to_advanced_search<{/t}></a>
                             </div> 
                        </td>
                  </tr>
            </table>
        <div>
        </div>
    </form>
</div>






    <table  class="table" id="productlist"  style="margin-top:10px">
        <thead>
        <tr style="height:25px">
            <th style="width:8em" align="center" nowrap="nowrap" >主管海关代码</th>
            <th style="width:14em" align="center" >电商企业代码</th>
            <th  style="width:6em" align="center" nowrap="nowrap">海关备案编号</th>
            <th  style="width:6em" align="center" nowrap="nowrap">属地检验检疫机构</th>
            <th style="width:14em" align="center" ><{t}>productTitle<{/t}></th>
            
            
            <th  style="width:6em" align="center" nowrap="nowrap">海关商品编码</th>
            <th style="width:10em" align="center" nowrap="nowrap"><{t}>productBarcode1<{/t}></th>
          <{*  <th style="width:10em" align="center" nowrap="nowrap"><{t}>ProductCategory<{/t}></th>*}>
            <th style="width:5em" align="center" nowrap="nowrap"><{t}>productStatus<{/t}></th>
            <th style="width:5em" align="center" nowrap="nowrap">检验检疫状态</th>
            <th style="width:5em" align="center" nowrap="nowrap">海关状态</th>
            <th width="120" align="center" nowrap="nowrap"><{t}>addTime<{/t}></th>
            <th>检验检疫备案编号</th>
            <th align='center' width="100"><{t}>operate<{/t}></th>
        </tr>
        </thead>


        <tbody>
        <{if $result neq ""}>
        <{foreach from=$result item=item}>
            <tr target="pid"   rel="<{$item['product_id']}>">
                <td style="text-align:center;padding-left:5px">
                    <{if isset($customShow[$item['customs_code']])}>
                    <{$customShow[$item['customs_code']]}>
                    <{/if}>
                </td>
                <td style="text-align: center"><{$item['customer_code']}></td>
                <td   style="text-align:center">
                    <{$item['registerID']}>
                </td>
                <td   style="text-align:center"><{$item['ins_unit_name']}></td>
                <td   style="text-align:center"><{$item['product_title']}></td>
                
                
                  <td   style="text-align:center">
                    <{$item['hs_code']}>
                </td>
                <td   style="text-align:left">&nbsp;<{$item['product_barcode']}></td>
                <td   style="text-align:center">
                    <{$productStatus[$item['product_status']]}>
                </td>
                <td   style="text-align:center">
                    <{if isset($ciqStatus[$item['ciq_status']])}>
                    <{$ciqStatus[$item['ciq_status']]}>
                    <{/if}>
                </td>
                <td   style="text-align:center">
                    <{if isset($customsStatus[$item['customs_status']])}>
                    <{$customsStatus[$item['customs_status']]}>
                    <{/if}>
                </td>
                <td  style="text-align:center" class="nowrap"><{$item['product_add_time']}></td>
                <td><{$item['inspection_code']}></td>
                <td  style="text-align:center" nowrap="nowrap">
                    <a class="edit" onclick="parent.openMenuTab('/merchant/product/detail?productId=<{$item['product_id']}>','<{t}>ProductDetail<{/t}>(<{$item['registerID']}>)','productdetail<{$item['product_id']}>');return false;"
                        title="<{t}>ProductDetail<{/t}>" ><span><{t}>view<{/t}></span></a>
                    <span class="pipe">|</span>
                    <a class="edit" href="/merchant/product/print?productId=<{$item['product_id']}>" target="_blank">下载CIQ备案表格</a>
                </td>
            </tr>
            <{/foreach}>
        <{/if}>

        </tbody>

</table>

<div class="clear"></div>
<div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10" url="<{$url}>"></div>


<script>
function deleteProduct(url){
    $('<div title="Note(Esc)"><p align=""><{t}>AreYouSureToDeleteTheProduct<{/t}></p></div>').dialog({
        autoOpen: true,
        width: 300,
        height: 'auto',
        modal: true,
        show:"slide",
        buttons: {
            '<{t}>cancel<{/t}>':function(){
                $(this).dialog("close");
            },
            '<{t}>Determine<{/t}>': function() {
                $(this).dialog("close");
                $.ajax({
                    type:'POST',
                    url:url,
                    dataType:"json",
                    cache:false,
                    success:function(json){
                        if(json.ask=='1'){
                            alertTip(json.message);
                            $('#pagerForm').submit();
                        }else{
                            var html = '';
                            html+=json.message;
                            alertTip(json.message,'500','auto','1');
                        }
                    },
                    error:function(){
                        alertTip('<{t}>error<{/t}>');
                    }
                });
            }
        },
        close: function() {

        }
    });

}

function exportData(){
    var from1   = $("#pagerForm");
    from1.attr('action','/merchant/product/export');
    from1.submit();
}
function searchForm(){
    var from1   = $("#pagerForm");
    from1.attr('action','/merchant/product/index');
    from1.submit();
}

$(function(){
   //按默认类   
    $("#productlist").alterBgColor();
    $("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"productlist_search_mode"});
    
})
$(function(){
    $('.switch_search_model').click(function(){
        $('#pagerForm')[0].reset();
        $('#pagerForm').find('input').not('[name="page"]').each(function(){
            if($(this).attr('name') != 'page' && $(this).attr('name') != 'pageSize'){
                $(this).val('');
            }     
        })
        $('#pagerForm').find('select').each(function(){
            $(this).find('option:selected').attr('selected',false);
            $(this).find('option:first').attr('selected','selected');
            $(this).trigger('update');
            //$(this).siblings('.b-custom-select').find('.b-custom-select__title__text').text($(this).find('option:first').text())
        })
    })
})
$(function(){  
    //$("#productlist").colResizable();  
}); 
</script>