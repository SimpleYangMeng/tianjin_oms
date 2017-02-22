<style type="text/css">
form table .button:hover {
  text-decoration: underline;
}

.ui-icon-circle-close {
  cursor: pointer;
}

.distributor-back {
  color: #cd0a0a;
  cursor: pointer;
}

.distributor-back:hover {
  text-decoration: underline;
}
</style>

<div class="content-box ui-tabs ui-corner-all ui-widget ui-widget-content">
  <div class="content-box-header">
    <h3 style="margin-left:5px"><{t}>DistributorEdit<{/t}></h3>
  </div>

  <{if 'info' == $tip}>
  <div class="ui-widget" style="margin:10px 0;" id="distributor-tip-info">
    <div style="padding:10px 10px;" class="ui-state-highlight ui-corner-all">
      <p>
        <span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
        <strong id="distributor-tip-info-content"><{t}>DistributorEditSuccess<{/t}>，<span class="distributor-back" id="distributor-list-view"><{t}>DistributorListView<{/t}></span></strong>
        <span style="float: right; margin-right: .3em;" class="ui-icon ui-icon-circle-close"></span>
      </p>
    </div>
  </div>
  <{elseif 'error' == $tip}>
  <div class="ui-widget" style="margin:10px 0;" id="distributor-tip-alert">
    <div style="padding:10px 10px;" class="ui-state-error ui-corner-all">
      <p>
        <span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
        <strong id="distributor-tip-alert-content"><{$message}></strong>
        <span style="float: right; margin-right: .3em;" class="ui-icon ui-icon-circle-close"></span>
      </p>
    </div>
  </div>
  <{/if}>

  <form method="post" action="/merchant/distributor/edit/id/<{$distributorId}>" id="distributor-edit-form">
    <table>
      <tr>
        <td class="form_title"><{t}>DistributorCode<{/t}>：</td>
        <td class="form_input">
          <{$code|escape:'html'}>
          <input class="text-input width195" type="hidden" name="distributor_code" id="distributor-code" value="<{$code|escape:'html'}>" />
        </td>
      </tr>
      <tr>
        <td class="form_title"><{t}>DistributorName<{/t}>：</td>
        <td class="form_input">
          <input class="text-input width195" type="text" name="distributor_name" id="distributor-name" value="<{$name|escape:'html'}>" /> <strong>*</strong>
        </td>
      </tr>
      <tr>
        <td class="form_title"><{t}>DistributorStatus<{/t}>：</td>
        <td>
          <select class="text-input" name="distributor_status" id="distributor-status">
            <option value="1"<{if 1 == $status}> selected="selected"<{/if}>><{t}>DistributorStatusEnabled<{/t}></option>
            <option value="0"<{if 0 == $status}> selected="selected"<{/if}>><{t}>DistributorStatusDisabled<{/t}></option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" class="button" id="distributor-edit-action" value="<{t}>DistributorOperationSave<{/t}>"/>
        </td>
      </tr>
    </table>
  </form>
</div>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function ($) {
  $('#distributor-list-view').click(function (e) {
    if (window.self !== window.top) {
      window.parent.openMenuTab('/merchant/distributor/list', '<{t}>DistributorList<{/t}>', 'tab-distributor-list', 1);
    }
    else {
      window.location.href = '/merchant/distributor/list';
    }
  });

  $('.ui-icon-circle-close').click(function (e) {
    $('#distributor-tip-info').hide();
    $('#distributor-tip-alert').hide();
  });
});
//]]>
</script>
