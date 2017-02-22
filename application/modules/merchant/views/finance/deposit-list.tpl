<div class="content-box  ui-tabs  ui-corner-all">

    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>rechargeLogSearch<{/t}></h3>        
    </div>

<div class="pageHeader">
    <form action="/merchant/finance/deposit-list" method="post" id="pagerForm">
        <input type="hidden" name="page" value="<{$page}>" id="page" />

        <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes" />

        <div class="searchBar">
            <table class="left">
                <tr>
					<th style="width:70px;color:#000" class="nowrap">
						<{t}>PaymentStatus<{/t}>：
					</th>
                    <td>
                        <select  class="text-input width155" name="cdo_payment_status">
                            <option value=""><{t}>all<{/t}></option>
                            <option value="PU" <{if $condition.cdo_payment_status eq "PU"}>selected<{/if}> ><{t}>Unpaid<{/t}></option>
                            <option value="PS" <{if $condition.cdo_payment_status eq "PS"}>selected<{/if}> ><{t}>SubmitPayment<{/t}></option>
                            <option value="PD" <{if $condition.cdo_payment_status eq "PD"}>selected<{/if}> ><{t}>Paid<{/t}></option>
                            <option value="DO" <{if $condition.cdo_payment_status eq "DO"}>selected<{/if}> ><{t}>Downloaded<{/t}></option>
                        </select>
                        <a  class="button" onclick="$('#pagerForm').submit();return false;"><{t}>search<{/t}></a>
                    </td>
                </tr>
            </table>

        </div>
    </form>
</div>
</div>

    <table class="table list" width="100%" layoutH="138" id="deposit-list-box" style="margin-top:5px;">
        <thead class="caption">
        <tr>
            <th align="center" ><{t}>CustomerCode<{/t}></th>
            <th align="center" ><{t}>PaymentStatus<{/t}></th>
            <th align="center" ><{t}>Amount<{/t}></th>
            <th align="center" ><{t}>currencyCode<{/t}></th>
            <th align="center" ><{t}>currencyRate<{/t}></th>
            <th align="center" ><{t}>Paid<{/t}></th>
            <th align="center" ><{t}>PaymentCode<{/t}></th>
            <th align="center" ><{t}>createDate<{/t}></th>
            <th align="center" ><{t}>lastUpdateTime<{/t}></th>
        </tr>
        </thead>
        <tbody>
        <{if $result}>
        <{foreach from=$result item=item}>
			<tr>
            <td><{$item.customer_code}></td>
            <td><{$item.cdo_payment_status}></td>
            <td><{$item.cdo_currency_value}></td>
            <td><{$item.currency_code}></td>
            <td><{$item.currency_rate}></td>
            <td><{$item.cdo_payment_fee}></td>
            <td><{$item.pm_code}></td>
            <td><{$item.cdo_add_date}></td>
            <td><{$item.cdo_update_time}></td>
			</tr>
            <{/foreach}>
		<{else}>
			<tr>
				<td colspan="9" class="text_center"><{t}>no_data<{/t}></td>
			</tr>
        <{/if}>
        </tbody>
    </table>
	<div class="clear"></div>
    <div class="panelBar">
        <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>"  pageNumShown="10"></div>
    </div>



<script>
$(function(){
   //按默认类   
    $("#deposit-list-box").alterBgColor();
    
})
</script>