<{if isset($errorTip)}>
<script type="text/javascript">
    alertTip("<{$errorTip}>");
</script>
<{else}>
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/jquery.datetimepicker.css">
<script type="text/javascript" src="/js/datetimepicker/build/jquery.datetimepicker.full.js"></script>
<style type="text/css">
.content-box{padding:10px;}
table{border-collapse:collapse;border-spacing:0;}
.form-table{width:100%;font-size:13px;margin-top: -1px;}
.form-table th{text-align:right;font-weight:bold;padding:8px 5px;border:1px solid #D8E0E4; background:none repeat scroll 0 0 #e1effb;}
.form-table td{padding:8px 3px;border:1px solid #D8E0E4;text-align:center;}
.form-table td.left{width:20%;font-weight:bold;text-align:right;border:1px solid #D8E0E4;}
.form-table td.right{width:30%;text-align:left;border:1px solid #D8E0E4;}
.form-table td.form_title{width:20%;font-weight:bold;text-align:right;border:1px solid #D8E0E4;}
.form-table td.error{display:none;color:red;background:#FDFFD2;text-align:center;border:1px solid #D8E0E4;}
.form-table td textarea.medium-input,.form-table .text-input{height:14px;resize:none;  border-radius: 2px;}
.form-input{height:28px;outline:0;border:1px solid #D8E0E4;padding:0 5px;}
.form-input,.text-input{width:160px;height:28px;outline:0;border:1px solid #D8E0E4;padding:0 5px;}
</style>
<link rel="stylesheet" type="text/css" href="/js/nice-validator-0.8.1/jquery.validator.css" />
<script type="text/javascript" src="/js/nice-validator-0.8.1/jquery.validator.js"></script>
<script type="text/javascript" src="/js/nice-validator-0.8.1/local/zh-CN.js"></script>
<div class="content-box  ui-tabs  ui-corner-all" >
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">企业备案修改</h3>
    </div>
    <form class="pageForm" id="enterpriseForm" autocomplete="off">
        <div class="product">
            <table class="form-table" style="width: 100%;">
                <tr>
                    <th colspan="5" class="text_left">企业备案信息</th>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right">
                        企业名称
                    </td>
                    <td class="form_input">
                       <input type="text" 
                       data-rule="required" 
                       data-msg-required="企业名称必填"
                       data-tip="备案企业名称"
                       name="trade_name"
                       value="<{$customerRow.trade_name}>"
                       class="form fix-medium2-input text-input"
                       id="trade_name"
                       />
                       <span class="msg-box n-right" style="position:static;" for="trade_name"></span>
                    </td> 
                    <td class="form_title nowrap text_right">
                        企业英文名称
                    </td>
                    <td class="form_input">
                        <input type="text"                       
                        data-tip="备案企业名称（选填）"
                        name="trade_name_en" 
                        value="<{$customerRow.trade_name_en}>" 
                        class="form fix-medium2-input text-input"
                        id="trade_name_en"
                         />
                        <span class="msg-box n-right" style="position:static;" for="trade_name_en"></span>
                    </td>   
                </tr>

                <tr>   
                    <td class="form_title nowrap text_right">
                        企业组织机构代码
                    </td>
                    <td class="form_input">
                       <input type="text" 
                       name="trade_co"                     
                       data-rule="required" 
                       data-msg-required="企业组织机构代码必填"
                       data-tip="备案企业组织机构代码"
                       value="<{$customerRow.trade_co}>" 
                       id="trade_co"
                       class="form fix-medium2-input text-input" />
                       <span class="msg-box n-right" style="position:static;" for="trade_co"></span>
                    </td>               
                    <td class="form_title nowrap text_right">
                        企业注册地址
                    </td>
                    <td class="form_input">
                       <input type="text" 
                       name="customer_address"                     
                       data-rule="required" 
                       data-msg-required="企业企业注册地址"
                       data-tip="备案企业注册地址"
                       id="customer_address"
                       value="<{$customerRow.customer_address}>" 
                       class="form fix-medium2-input text-input" />
                       <span class="msg-box n-right" style="position:static;" for="customer_address"></span>
                    </td>                  
                </tr>

                <tr>   
                     
                    <td class="form_title nowrap text_right">
                        营业执照编号
                    </td>
                    <td class="form_input">
                       <input type="text" name="bus_lic_reg_num" id="bus_lic_reg_num" value="<{$customerRow.bus_lic_reg_num}>" class="form fix-medium2-input text-input" />
                       <span for="trade_name_en" style="position: static;" class="msg-box n-right"><span class="msg-wrap n-tip" id="bus_lic_reg_num_msg" role="alert"><span class="n-icon"></span><span class="n-msg">营业执照编号和社会信用代码二选一</span></span></span>
                    </td>               
                     
                     <td class="form_title nowrap text_right">
                        社会信用代码
                    </td>
                    <td class="form_input">
                       <input type="text" name="credit_code" id="credit_code" value="<{$customerRow.credit_code}>" class="form fix-medium2-input text-input" />
                       <span for="trade_name_en" style="position: static;" class="msg-box n-right"><span class="msg-wrap n-tip" id="credit_code_msg" role="alert"><span class="n-icon"></span><span class="n-msg">营业执照编号和社会信用代码二选一</span></span></span>
                    </td>           
                </tr>

                <tr>   
                    <td class="form_title nowrap text_right">
                        联系人姓名
                    </td>
                    <td class="form_input">
                       <input type="text" 
                       name="bus_name" 
                       data-rule="required" 
                       data-msg-required="联系人姓名必填"
                       data-tip="联系人姓名必填"
                       id="bus_name"
                       value="<{$customerRow.bus_name}>" class="form fix-medium2-input text-input" />
                       <span class="msg-box n-right" style="position:static;" for="bus_name"></span>
                    </td>              
                    <td class="form_title nowrap text_right">
                        联系电话
                    </td>
                    <td class="form_input">
                       <input type="text" name="customer_telephone" 
                       data-rule="required" 
                       data-msg-required="联系电话必填"
                       data-tip="联系电话必填"
                       id="customer_telephone"
                       value="<{$customerRow.customer_telephone}>" class="form fix-medium2-input text-input" />
                       <span class="msg-box n-right" style="position:static;" for="customer_telephone"></span>
                    </td>                  
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        邮政编码
                    </td>
                    <td class="form_input">
                       <input type="text" name="customer_postno" 
                       data-rule="required" 
                       data-msg-required="邮政编码必填"
                       data-tip="邮政编码必填"
                       id="customer_postno"
                       value="<{$customerRow.customer_postno}>" class="form fix-medium2-input text-input" />
                       <span class="msg-box n-right" style="position:static;" for="customer_postno"></span>
                    </td> 
                    
                    <td class="form_title nowrap text_right">
                        企业网址
                    </td>
                    <td class="form_input">
                       <input type="text" name="web_address" 
                       data-rule="required" 
                       data-msg-required="企业网址必填"
                       data-tip="企业网址必填"
                       id="web_address"
                       value="<{$customerRow.web_address}>" class="form fix-medium2-input text-input" />
                       <span class="msg-box n-right" style="position:static;" for="web_address"></span>
                    </td>                  
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        企业法人
                    </td>
                    <td class="form_input">
                       <input type="text" name="corporate" 
                       data-rule="required" 
                       data-msg-required="企业法人必填"
                       data-tip="企业法人必填"
                       id="corporate"
                       value="<{$customerRow.corporate}>" class="form fix-medium2-input text-input" />
                       <span class="msg-box n-right" style="position:static;" for="corporate"></span>
                    </td>
                    <td class="form_title nowrap text_right">
                        企业法人证件号码
                    </td>
                    <td class="form_input">
                       <input type="text" name="corporate_num" 
                       data-rule="required" 
                       data-msg-required="企业法人证件号码必填"
                       data-tip="企业法人证件号码必填"
                       id="corporate_num"
                       value="<{$customerRow.corporate_num}>" class="form fix-medium2-input text-input" />
                       <span class="msg-box n-right" style="position:static;" for="corporate_num"></span>
                    </td>                  
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        企业法人联系电话
                    </td>
                    <td class="form_input">
                       <input type="text" name="corporate_phone" 
                       data-rule="required" 
                       data-msg-required="企业法人联系电话必填"
                       data-tip="企业法人联系电话必填"
                       id="corporate_phone"
                       value="<{$customerRow.corporate_phone}>" class="form fix-medium2-input text-input" />
                       <span class="msg-box n-right" style="position:static;" for="corporate_phone"></span>
                    </td>
                    <td class="form_title nowrap text_right">
                        有效期
                    </td>
                    <td class="form_input">
                       <input type="text" name="validity_date" 
                       data-rule="required" 
                       data-msg-required="有效期必填"
                       data-tip="有效期必填"
                       id="validity_date"
                       value="<{$customerRow.validity_date}>" class="secondsDatepicker form fix-medium2-input text-input" />
                       <span class="msg-box n-right" style="position:static;" for="validity_date"></span>
                    </td>                  
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                       业务类型(多选) 
                    </td>
                    <td class="form_input nowrap" colspan="3">
                        <label>保税进口：
                            <{if $customerRow.is_business_in == 1}>
                            <input type="checkbox" value="is_business_in" data-rule="checked[1~]" checked="checked" name="business_type[]" />
                            <{else}>
                            <input type="checkbox" value="is_business_in" data-rule="checked[1~]" name="business_type[]" />
                            <{/if}>
                        </label>
                        <label>保税出口：
                            <{if $customerRow.is_business_export == 1}>
                            <input type="checkbox" value="is_business_export" checked="checked" name="business_type[]" />
                            <{else}>
                            <input type="checkbox" value="is_business_export" name="business_type[]" />
                            <{/if}>
                        </label>                        
                    </td> 
                </tr> 
                <tr>
                    <td class="form_title nowrap text_right">
                        备注
                    </td>
                    <td colspan="3">
                        <textarea name="customer_note" class="large-input"><{$customerRow.customer_note}></textarea>
                    </td>                    
                </tr>              
            </table>
            <{if $customerRow.is_ecommerce}>
            <table class="form-table" style="width: 100%;">
                <tr>
                    <th colspan="5" class="text_left">电商企业备案信息</th>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        申报单位
                    </td>
                    <td>
                        <input type="text" name="agent_code" 
                        data-rule="required" 
                        data-msg-required="申报单位必填"
                        data-tip="申报单位必填"
                        id="agent_code"
                        value="<{$customerRow.agent_code}>" class="form fix-medium2-input text-input" />
                        <span class="msg-box n-right" style="position:static;" for="agent_code"></span>
                    </td>   
                    <td class="form_title nowrap text_right">
                        电商平台网站
                    </td>
                    <td>
                        <input type="text" name="bus_web_address" 
                        data-rule="required" 
                        data-msg-required="电商平台网站必填"
                        data-tip="电商平台网站必填"
                        id="bus_web_address"
                        value="<{$customerRow.bus_web_address}>" class="form fix-medium2-input text-input" />
                        <span class="msg-box n-right" style="position:static;" for="bus_web_address"></span>
                    </td>                    
                </tr> 

                <tr>
                    <td class="form_title nowrap text_right">
                        网店名称
                    </td>
                    <td>
                        <input type="text" name="eshop_name" 
                        data-rule="required" 
                        data-msg-required="网店名称必填"
                        data-tip="网店名称必填"
                        id="eshop_name"
                        value="<{$customerRow.eshop_name}>" class="form fix-medium2-input text-input" />
                        <span class="msg-box n-right" style="position:static;" for="eshop_name"></span>
                    </td>   
                    <td class="form_title nowrap text_right">
                        ICP备案号
                    </td>
                    <td>
                        <input type="text" name="customer_c_i_c" 
                        data-rule="required" 
                        data-msg-required="ICP备案号必填"
                        data-tip="ICP备案号必填"
                        id="customer_c_i_c"
                        value="<{$customerRow.customer_c_i_c}>" class="form fix-medium2-input text-input" />
                        <span class="msg-box n-right" style="position:static;" for="customer_c_i_c"></span>
                    </td>                    
                </tr> 
            </table>
            <{/if}>
            <{if $customerRow.is_storage}>
            <table class="form-table" style="width: 100%;">
                <tr>
                    <th colspan="5" class="text_left">仓储企业备案信息</th>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        企业海关代码
                    </td>
                    <td>
                        <input type="text" name="customs_reg_num" 
                        data-rule="required" 
                        data-msg-required="企业海关代码必填"
                        data-tip="企业海关代码必填"
                        id="customs_reg_num"
                        value="<{$customerRow.customs_reg_num}>" class="form fix-medium2-input text-input" />
                        <span class="msg-box n-right" style="position:static;" for="customs_reg_num"></span>
                    </td>   
                    <td class="form_title nowrap text_right">
                        仓库面积
                    </td>
                    <td>
                        <input type="text" name="warehouse_area" 
                        data-rule="required" 
                        data-msg-required="仓库面积必填"
                        data-tip="仓库面积必填"
                        id="warehouse_area"
                        value="<{$customerRow.warehouse_area}>" class="form fix-medium2-input text-input" />
                        <span class="msg-box n-right" style="position:static;" for="warehouse_area"></span>
                    </td>                    
                </tr>                 
            </table>
            <{/if}>
            <{if $customerRow.is_shipping}>
            <table class="form-table" style="width: 100%;">
                <tr>
                    <th colspan="5" class="text_left">物流企业备案信息</th>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        快递业务许可证
                    </td>
                    <td colspan="3" class="text_left">
                        <input type="text" name="exp_bus_lic" 
                        data-rule="required" 
                        data-msg-required="快递业务许可证必填"
                        data-tip="快递业务许可证必填"
                        id="exp_bus_lic"
                        value="<{$customerRow.exp_bus_lic}>" class="form fix-medium2-input text-input" />
                        <span class="msg-box n-right" style="position:static;" for="exp_bus_lic"></span>
                    </td>   
                                        
                </tr>                 
            </table>
            <{/if}>
            <{if $customerRow.is_pay}>
            <table class="form-table" style="width: 100%;">
                <tr>
                    <th colspan="5" class="text_left">支付企业备案信息</th>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        支付业务许可证
                    </td>
                    <td colspan="3" class="text_left">
                        <input type="text" name="pay_bus_lic" 
                        data-rule="required" 
                        data-msg-required="支付业务许可证必填"
                        data-tip="支付业务许可证必填"
                        id="pay_bus_lic"
                        value="<{$customerRow.pay_bus_lic}>" class="form fix-medium2-input text-input" />
                        <span class="msg-box n-right" style="position:static;" for="pay_bus_lic"></span>
                    </td>   
                                        
                </tr>                 
            </table>
            <{/if}>
            <table class="form-table" style="width: 100%;">
            <th colspan='5' class="text_center">               
                <input type="submit" class="form-input" value="提交修改">                
            </th>
            </table>
        </div>
    </form>    
</div>
<script type="text/javascript">
    $('.secondsDatepicker').datetimepicker({
      format:'Y-m-d H:i:00',
      lang:'zh'
    });
// bus_lic_reg_num
// credit_code
    $('#enterpriseForm').bind('valid.form', function(){
        var _bus = $('#bus_lic_reg_num').val();
        var _credit = $('#credit_code').val();
        if(_bus == '' && _credit == ''){
            $("#bus_lic_reg_num_msg, #credit_code_msg").removeClass('n-tip');
            $("#bus_lic_reg_num_msg, #credit_code_msg").addClass('n-error');
            return false;
        }
        $.ajax({
            url: '/merchant/customer/baseinfo-update',
            type: 'POST',
            data: $(this).serialize(),
            dataType:'json',
            success: function(json){
                console.log(json);          
            }
        });
        return false;
    });
</script>
<{/if}>


         <!--    <table class="form-table" style="width: 100%;">
                <tr>
                    <th colspan="5" class="text_left">电商企业备案信息</th>
                </tr>

                <tr>
                    <td class="form_title nowrap text_right">
                        申报单位
                    </td>
                    <td>
                        <input type="text" name="" value="<{$customerRow.agent_code}>" class="form fix-medium2-input text-input" />
                    </td>   
                    <td class="form_title nowrap text_right">
                        电商平台网站
                    </td>
                    <td>
                        <input type="text" name="" value="<{$customerRow.bus_web_address}>" class="form fix-medium2-input text-input" />
                    </td>                    
                </tr>                 
            </table> -->