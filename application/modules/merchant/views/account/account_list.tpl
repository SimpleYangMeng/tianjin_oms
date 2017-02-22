<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>account_list1<{/t}></h3>
    </div>
    <div class="pageHeader">
        <form action="/merchant/account/list" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>
            <div class="searchBar">
                <table>
                    <tr>
                        <td style="text-align:right;color:#000">
                            <{t}>user_name<{/t}>：
                        </td>
                        <td style="text-align: left;">
                            <input type="text" value="<{$condition.account_name}>" name="account_name" class="text-input width140 "/>
                        </td>
                        <td style="text-align:right;color:#000">
                            <{t}>email_address<{/t}>：
                        </td>
                        <td style=" text-align:left">
                            <input type="text" value="<{$condition.account_email}>" name="account_email" class="text-input width140 "/>
                        </td>
                        <td style=" text-align:left">
                            <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a>
                            <!--<a type="button" class="button" id="export">导出库存记录</a>-->
                        </td>
                    </tr>
                </table>

            </div>
        </form>
    </div>
</div>
<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
        <tr>
            <th><{t}>account_code<{/t}></th>
            <th><{t}>user_name<{/t}></th>
            <th><{t}>email_address<{/t}></th>
            <th><{t}>status<{/t}></th>
            <th><{t}>account_auth_status<{/t}></th>
            <th><{t}>addTime<{/t}></th>
            <!--<th >更新时间</th>-->
            <th><{t}>operate<{/t}></th>
        </tr>
        </thead>
        <tbody>
        <{if $result neq ""}>
        <{foreach from=$result item=row}>
            <tr>
                <td style="text-align:center" id="account-<{$row.account_id}>"><{$row.account_code}></td>
                <td style="text-align:center"><{$row.account_name}></td>
                <td style="text-align:center"><{$row.account_email}></td>
                <td style="text-align:center"><{if $row.account_status eq "1"}>可用<{else}>禁用<{/if}></td>
                <td style="text-align:center"><{$authStatus[$row.account_auth_status]}></td>
                <td style="text-align:center"><{$row.add_time}></td>
                <!--<td style="text-align:center"><{$row.account_update_time}></td>-->
                <td style="text-align:center">
                  <{if $row.account_auth_status eq 2 || $row.account_level =='0'}>
                      <{if $row.account_status eq "1"}>
                        <a href="javascript:void(0);" onclick="forbidden('/merchant/account/forbidden/type/notuse/account_id/<{$row.account_id}>','notuse');">禁用</a>
                      <{elseif $row.account_status eq "0"}>
                        <a href="javascript:void(0);" onclick="foruse('/merchant/account/forbidden/type/use/account_id/<{$row.account_id}>','use');">启用</a>
                      <{/if}>
                  <{else}>
                    <!-- 取消分配功能
                      <a href="javascript:grantAccountPrivilege(<{$row.account_id}>);">分配权限</a><span class="pipe">|</span>
                    -->
                    <{if $row.account_status eq "1"}>
                        <span>禁用</span>
                    <{elseif $row.account_status eq "0"}>
                        <span>启用</span>
                    <{/if}>
                  <{/if}>
                </td>
            </tr>
            <{/foreach}>
        <{/if}>
        </tbody>
    </table>
</form>
<div class="clear"></div>
<div class="panelBar">
    <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>
</div>

<!-- 取消分配
<div id="changeAccountStatusTip" style="display:none;" title="信息提示"></div>
<div id="grantAccountPrivilege" style="display:none;" title="权限分配">
<form id="assigned-privilege-form">
  <table style="width:100%;border-collapse:separate;">
  <{foreach from=$privilege item=module}>
  <tr><td style="text-align:left;background-color:#f2f2f2;"><label><input type="checkbox" value="<{$module.id}>" id="privilege-module-<{$module.id}>" /> <{$module.display_name}></label></td></tr>
  <tr><td style="background-color:#ffffff;position:relative;text-align:left;">
    <{foreach from=$module.items item=right}>
    <div style="float:left;margin-left:20px;width:232px;"><label><input type="checkbox" module="<{$module.id}>" id="privilege-<{$right.id}>" name="privilege[<{$module.id}>][]" value="<{$right.id}>" /> <{$right.display_name}></label></div>
    <{/foreach}>
  <div style="clear:both;height:0;overflow:hidden;"></div></td></tr>
  <{/foreach}>
  </table>
  <input type="hidden" name="account" id="privilege-account" value="" />
</form>
</div>
-->

<script>
jQuery(document).ready(function ($) {
  /* -- 取消权限分配
  $('#changeAccountStatusTip').dialog({
    autoOpen : false,
    modal : true,
    buttons : {
      '关闭' : function () {
        $(this).dialog('close');
      }
    }
  });
  
  $('#grantAccountPrivilege').dialog({
    width : 800,
    autoOpen : false,
    modal : true
  });
  */
 
  $('[id^="privilege-module-"]').click(function (e) {
    var module = $(this).attr('id').split('-').pop();
    var privilege = $('input[type="checkbox"][name^="privilege[' + module + ']"]');

    if ($(this).is(':checked')) {
      privilege.each(function () {
        $(this).attr('checked', true);
      });
    }
    else {
      privilege.each(function () {
        $(this).attr('checked', false);
      });
    }
  });

  $('input[type="checkbox"][name^="privilege["]').click(function (e) {
    var module = $('#privilege-module-' + $(this).attr('module'));
    var name = $(this).attr('name');
    var privilege = $('input[type="checkbox"][name="' + name + '"]');
    var privilegeChecked = $('input[type="checkbox"][name="' + name + '"]:checked');

    if ($(this).is(':checked') && privilege.length === privilegeChecked.length) {
      module.attr('checked', true);
    }
    else {
      if (module.is(':checked')) {
        module.attr('checked', false);
      }
    }
  });
});

// 账号权限分配
/*
function grantAccountPrivilege(id) {
  var account = $('#account-' + id).text();
  var tipDialog = $('#changeAccountStatusTip');
  $('#privilege-account').val(id);

  // 获取已分配的权限
  $.ajax({
    url : '/merchant/account/get-assigned-privilege',
    type : 'POST',
    dataType : 'json',
    async : false,
    data : {
      account : id
    },
    success : function (data) {
      if (1 == data.status) {
        for (var i in data.data) {
          var pc = data.data[i].items.length;

          for (var j in data.data[i].items) {
            $('#privilege-' + data.data[i].items[j].id).attr('checked', true);
          }

          if (pc == $('[name^="privilege[' + data.data[i].id + ']"]').size()) {
            $('#privilege-module-' +  data.data[i].id).attr('checked', true);
          }
        }
      }else {
        tipDialog.html(data.message).dialog('open');
      }
    },
    error : function () {
      // empty
    }
  });

  // 权限分配弹出框
  $('#grantAccountPrivilege').dialog({
    title : '【' + account + '】权限分配',
    autoOpen : true,
    buttons : {
      '取消' : function () {
        $(this).dialog('close');
      },
      '分配' : function () {
        var self = $(this);

        if ($('input[type="checkbox"][name^="privilege["]:checked').size() < 1) {
          tipDialog.html('至少需要分配一项权限').dialog('open');
          return ;
        }

        $.ajax({
          url : '/merchant/account/assign-privilege',
          type : 'POST',
          dataType : 'json',
          async : true,
          data : $('#assigned-privilege-form').serialize(),
          success : function (res) {
            if (1 == res.status) {
              tipDialog.html('子账号【' + account + '】' + res.message).dialog('open');
              self.dialog('close');
            }
            else {
              tipDialog.html(res.message).dialog('open');
            }
          },
          error : function () {
            tipDialog.html('请求无法到达，请稍候再试').dialog('open');
          }
        });
      }
    },
    close : function () {
      $('#assigned-privilege-form').find('input[type="checkbox"]').attr('checked', false);
    }
  });
}
*/
    function forbidden(url,type){
        $('<div title="Note(Esc)"><p align=""><{t}>disable_this_account_tip<{/t}></p></div>').dialog({
            autoOpen: true,
            width: 300,
            height: 'auto',
            modal: true,
            show:"slide",
            position: ['center', 100],
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
                                alertTip(json.message,'500','auto','1');
                               // $('#pagerForm').submit();
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

    function foruse(url){
        $('<div title="Note(Esc)"><p align=""><{t}>enable_the_account_tip<{/t}></p></div>').dialog({
            autoOpen: true,
            width: 300,
            height: 'auto',
            modal: true,
            show:"slide",
            position: ['center', 100],
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
                                alertTip(json.message,'500','auto','1');
                               // $('#pagerForm').submit();
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

    $(function(){
        //按默认类
        $("#finance-list-box").alterBgColor();
        $('#export').bind('click',function(){
            $('#export_dialog').dialog('open');
        });

    });
    //全选
    $('.checkAll').die('click').live('click',function(){
        if ($(this).is(':checked')) {
            $(".Arr").attr('checked', true);

        } else {
            $(".Arr").attr('checked', false);
        }
        changeTrColor();
    });
    /*伴随全选按钮是否选中而变色*/
    function changeTrColor(){
        $(".Arr").each(function(){
            _this = $(this);
            if($('.checkAll').is(':checked')){
                set_tr_class(_this.parent().parent(), true);
            }else{
                set_tr_class(_this.parent().parent(), false);
            }
        });
    }
</script>