<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3 class="clearborder" style="margin-left:5px;">余额查询申请</h3>
    </div>
    <div class="pageHeader">
        <form action="/merchant/balance/add" method="post" id="addbalance">
            <!--<input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>-->
            <div class="searchBar">
                <table>
                    <tr>
                        <td class="form_title nowrap text_right" >身份证号：</td>
                        <td class="form_input">
                            <input type="text" value="" placeholder="<{t}>account_id_code_input<{/t}>" size="45" class="fix-medium1-input text-input" name="id_code" id="id_code" required>
                            <strong>*</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="form_title nowrap text_right">姓名：</td>
                        <td class="form_input">
                            <input type="text" placeholder="<{t}>account_real_name_tips_input<{/t}>" class="fix-medium1-input required text-input " name="name" value="" required size="45">
                            <strong>*</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="form_title"></td>
                        <td class="form_input">
                            <a onclick="dosubmit();return false;" class="button tijiao" href="javascript:void(0);"> 申请
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">

    $(function(){
        $('#id_code').blur(function (){
            var codeRegular = /^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/i;
            if(!codeRegular.test($(this).val())){
                $(this).next().text('身份证填写错误');
                $(this).focus();
            }else {
                $(this).next().text('');
            }
        });

    });

    function dosubmit(){
        var formdata =  $("#addbalance").serialize();
        var id_code = $("[name='id_code']").val();
        var name = $('[name="name"]').val();
        var errorHtml = "";
        if(id_code==""){
            errorHtml+='身份证号必须填写</br>';
        }
        if(name==""){
            errorHtml+="姓名必须填写</br>";
        }
        if(errorHtml!=""){
            alertTip(errorHtml);
            return false;
        }
        var myoptions = {
            url:'/merchant/balance/add',
            type:'POST',
            cache:false,
            dataType:'json',
            processData:true,
            data:formdata,
            success: function(json){
                var html ="";
                if(json.ask=='0'){
                    if(typeof (json.error)!="undefined"&&json.error!=""){
                        $.each(json.error,function(k,v){
                            html+=v+'</br>';
                        })
                    }
                    alertTip(html);
                }else{
                    $("#addbalance")[0].reset();
                    alertTip(json.message);
                }
            }
        };
        $.ajax(myoptions);
        return false;
    }

</script>
