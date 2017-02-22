<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3 class="clearborder" style="margin-left:5px;">余额查询</h3>
    </div>
    <div class="pageHeader">
        <form action="/merchant/balance/index" method="post" id="pagerForm">
            <!--<input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>-->
            <div class="searchBar">
                <table>
                    <tr>
                        <td style="text-align:right;color:#000">
                            身份证
                        </td>
                        <td style="text-align:left;">
                            <input type="text" value="<{$query.id_code}>" placeholder="<{t}>account_id_code_input<{/t}>" class="text-input width140 " name="id_code">
                        </td>
                        <td style="text-align:right;color:#000">
                            姓名
                        </td>
                        <td style="text-align:left;">
                            <input type="text" placeholder="<{t}>account_real_name_tips_input<{/t}>" class="text-input width140 " name="name" value="<{$query.name}>">
                        </td>
                        <td style=" text-align:left">
                            <a class="button" href="#" onclick="$('#pagerForm').submit();return false;">
                            查询
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>
<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list " width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
            <tr>
                <th>身份证号码</th>
                <th>姓名</th>
                <th>余额</th>
                <th>查询时间</th>
                <th>状态</th>
            </tr>
        </thead>
        <tbody>
            <{if $result neq ""}>
                <{foreach from=$result item=row}>
                    <tr>
                        <td style="text-align:center"><{$row.id_code}></td>
                        <td style="text-align:center"><{$row.name}></td>
                        <td style="text-align:center"><{$row.balance}></td>
                        <td style="text-align:center"><{$row.create_time}></td>
                        <td style="text-align:center"><{$authStatus[$row.state]}></td>
                    </tr>
                <{/foreach}>
            <{/if}>
        </tbody>
    </table>
</form>
<div class="clear"></div>
<div class="panelBar">
    <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10">
    </div>
</div>
<script type="text/javascript">

    $(function(){

        $("#finance-list-box").alterBgColor();

    });

    function dosubmit(){
        var formdata =  $("#addAcount").serialize();
        var account_name = $("[name='account_name']").val();
        var account_email = $('[name="account_email"]').val();
        
        var errorHtml = "";
        
        var myoptions = {
            url:'/merchant/account/add',
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
                    $("#addAcount")[0].reset();
                    alertTip(json.message);
                }
            }
        };
        $.ajax(myoptions);
        return false;
    }

</script>
