<style type="text/css">
form table .button:hover {
  text-decoration: underline;
}
</style>

<div class="content-box ui-tabs ui-corner-all ui-widget ui-widget-content" style="padding-bottom:10px;">
  <div class="content-box-header">
    <h3 style="margin-left:5px"><{t}>DistributorList<{/t}></h3>
  </div>

  <form method="post" action="/merchant/distributor/list" id="distributor-search-form">
    <table>
      <tr>
        <td class="form_title"><{t}>DistributorCode<{/t}>：</td>
        <td class="form_input">
          <input class="text-input width180" type="text" name="distributor_code" value="<{$code|escape:'html'}>" />
        </td>
        <td class="form_title"><{t}>DistributorName<{/t}>：</td>
        <td class="form_input">
          <input class="text-input width180" type="text" name="distributor_name" value="<{$name|escape:'html'}>" />
        </td>
        <td class="form_title"><{t}>DistributorStatus<{/t}>：</td>
        <td>
          <select class="text-input" name="distributor_status">
            <option value="-1"<{if -1 == $status}> selected="selected"<{/if}>><{t}>DistributorStatusAll<{/t}></option>
            <option value="1"<{if 1 == $status}> selected="selected"<{/if}>><{t}>DistributorStatusEnabled<{/t}></option>
            <option value="0"<{if 0 == $status}> selected="selected"<{/if}>><{t}>DistributorStatusDisabled<{/t}></option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <span class="button" id="distributor-search-action"><{t}>DistributorOperationSearch<{/t}></span>
          <span class="button" id="distributor-add-action"><{t}>DistributorOperationAdd<{/t}></span>
        </td>
      </tr>
    </table>
  </form>
</div>

<table class="table formtable tableborder" id="distributor-list-table" style="margin:10px 0;">
  <thead>
    <tr style="height:25px;">
      <th style="width:20%;"><{t}>DistributorCode<{/t}></th>
      <th style="width:30%;"><{t}>DistributorName<{/t}></th>
      <th style="width:10%;"><{t}>DistributorStatus<{/t}></th>
      <th style="width:20%;"><{t}>DistributorCreatedTime<{/t}></th>
      <th style="width:20%;"><{t}>DistributorOperation<{/t}></th>
    </tr>
  </thead>
  <tbody>
  <{foreach from=$data item=record}>
    <tr <{if 0 == $record@index % 2}>class="even"<{else}>class="odd"<{/if}>>
      <td style="text-align:center;"><{$record.distributor_code}></td>
      <td><{$record.distributor_name}></td>
      <td style="text-align:center;">
        <{if 0 == $record.distributor_status}>
        <{t}>DistributorStatusDisabled<{/t}>
        <{elseif 1 == $record.distributor_status}>
        <{t}>DistributorStatusEnabled<{/t}>
        <{else}>
        <{t}>DistributorStatusUnknown<{/t}>
        <{/if}>
      </td>
      <td style="text-align:center;"><{$record.distributor_created}></td>
      <td style="text-align:center;">
        <a href="javascript:void(0);" class="operation-edit" link="/merchant/distributor/edit/id/<{$record.distributor_id}>"><{t}>DistributorOperationEdit<{/t}></a>&nbsp;
        <a href="javascript:void(0);" class="operation-view" link="/merchant/distributor/view/id/<{$record.distributor_id}>"><{t}>DistributorOperationView<{/t}></a>
      </td>
    </tr>
  <{foreachelse}>
    <tr class="even"><td colspan="6" style="text-align:center;"><{t}>DistributorListNoData<{/t}></td></tr>
  <{/foreach}>
  </tbody>
</table>

<{if $total > 0}>
<form action="/merchant/distributor/list" method="post" id="pagerForm">
  <input type="hidden" name="page" value="1" id="page" />
  <input type="hidden" name="size" value="<{$size}>" id="pageSizes" />
  <input type="hidden" name="distributor_code" value="<{$code|escape:'html'}>" />
  <input type="hidden" name="distributor_name" value="<{$name|escape:'html'}>" />
  <input type="hidden" name="distributor_status" value="<{$status}>" />
</form>

<div class="pagination" targetType="navTab" totalCount="<{$total}>" numPerPage="<{$size}>" currentPage="<{$page}>" pageNumShown="10"></div>
<{/if}>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function ($) {
  $('#distributor-search-action').click(function (e) {
    $('#distributor-search-form').submit();
  });

  $('#distributor-add-action').click(function (e) {
    if (window.self !== window.top) {
      window.parent.openMenuTab('/merchant/distributor/add', '<{t}>DistributorAdd<{/t}>', 'tab-distributor-add', 0);
    }
    else {
      window.location.href = '/merchant/distributor/add';
    }
  });

  $('.operation-edit').click(function (e) {
    var link = $(this).attr('link');

    if (window.self !== window.top) {
      window.parent.openMenuTab(link, '<{t}>DistributorEdit<{/t}>', 'tab-distributor-edit', 0);
    }
    else {
      window.location.href = link;
    }
  });

  $('.operation-view').click(function (e) {
    var link = $(this).attr('link');

    if (window.self !== window.top) {
      window.parent.openMenuTab(link, '<{t}>DistributorView<{/t}>', 'tab-distributor-view', 0);
    }
    else {
      window.location.href = link;
    }
  });
});
//]]>
</script>
