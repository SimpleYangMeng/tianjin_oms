<style type="text/css">
table .button:hover {
  text-decoration: underline;
}
</style>

<div class="content-box ui-tabs ui-corner-all ui-widget ui-widget-content">
  <div class="content-box-header">
    <h3 style="margin-left:5px"><{t}>DistributorDetail<{/t}></h3>
  </div>

  <table class="table tableborder" style="width:100%;margin-bottom:5px;">
    <tr class="even">
      <td style="width:15%;text-align:center;font-weight:bold;"><{t}>DistributorCode<{/t}></td>
      <td style="width:35%;text-align:left;"><{$code}></td>
      <td style="width:15%;text-align:center;font-weight:bold;"><{t}>DistributorName<{/t}></td>
      <td style="width:35%;text-align:left;"><{$name}></td>
    </tr>
    <tr class="odd">
      <td style="width:15%;text-align:center;font-weight:bold;"><{t}>DistributorStatus<{/t}></td>
      <td style="width:35%;text-align:left;">
        <{if 0 == $status}>
        <{t}>DistributorStatusDisabled<{/t}>
        <{elseif 1 == $status}>
        <{t}>DistributorStatusEnabled<{/t}>
        <{else}>
        <{t}>DistributorStatusUnknown<{/t}>
        <{/if}>
      </td>
      <td style="width:15%;text-align:center;font-weight:bold;"><{t}>DistributorCustomerCode<{/t}></td>
      <td style="width:35%;text-align:left;"><{$customerCode}></td>
    </tr>
    <tr class="even">
      <td style="width:15%;text-align:center;font-weight:bold;"><{t}>DistributorCreator<{/t}></td>
      <td style="width:35%;text-align:left;"><{$creator}></td>
      <td style="width:15%;text-align:center;font-weight:bold;"><{t}>DistributorCreatedTime<{/t}></td>
      <td style="width:35%;text-align:left;"><{$created}></td>
    </tr>
    <tr class="odd">
      <td style="width:15%;text-align:center;font-weight:bold;"><{t}>DistributorModifier<{/t}></td>
      <td style="width:35%;text-align:left;"><{$modifier}></td>
      <td style="width:15%;text-align:center;font-weight:bold;"><{t}>DistributorModifiedTime<{/t}></td>
      <td style="width:35%;text-align:left;"><{$modified}></td>
    </tr>
    <tr>
      <td colspan="4" style="height:28px;text-align:left;">
        <span id="distributor-edit-action" class="button" link="/merchant/distributor/edit/id/<{$distributorId}>"><{t}>DistributorOperationEdit<{/t}></span>
        <{* <span id="distributor-list-action" class="button"><{t}>DistributorList<{/t}></span> *}>
      </td>
    </tr>
  </table>
</div>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function ($) {
  $('#distributor-list-action').click(function (e) {
    if (window.self !== window.top) {
      window.parent.openMenuTab('/merchant/distributor/list', '<{t}>DistributorList<{/t}>', 'tab-distributor-list', 1);
    }
    else {
      window.location.href = '/merchant/distributor/list';
    }
  });

  $('#distributor-edit-action').click(function (e) {
    var link = $(this).attr('link');

    if (window.self !== window.top) {
      window.parent.openMenuTab(link, '<{t}>DistributorEdit<{/t}>', 'tab-distributor-edit', 1);
    }
    else {
      window.location.href = link;
    }
  });
});
//]]>
</script>
