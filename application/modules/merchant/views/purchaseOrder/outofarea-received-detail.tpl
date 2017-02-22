<style type="text/css">
    <!--
    .tabContent {
        display: none;
    }

    .imgWrap {
        width: 76px;
        height: 76px;
        margin: 0px;
        border: 0 none;
    }
    .center{
        text-align: center;
    }
    .right{
        text-align: right;
    }
    -->
</style>
<div class="content-box  ui-tabs  ui-corner-all  ui-widget ui-widget-content">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>purchase_order_detail<{/t}></h3>        
    </div>


<div style="margin-right: 0px;" class="nbox_c marB10">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <tbody>
        <tr>
            <th class="center"><{t}>purchase_order_code<{/t}></th>
            <td><{$purchase_order_row.po_code}></td>
            <th><{t}>supplier_code<{/t}></th>
            <td><{$purchase_order_row.supply_code|default:'-'}></td>
        </tr>

        <tr>
            <th><{t}>createDate<{/t}></th>
            <td colspan="3"><{$purchase_order_row.create_time}></td>
      
        </tr>

      

        </tbody>
    </table>
	<div class='clear'></div>
</div>


<div class="tabs_header">
    <ul class="tabs">
        <!--<li class='active'>
            <a href="javascript:;" id='tab_attribute' class='tab'><span>attribute</span></a>
        </li>-->
        <li class='active'>
            <a href="javascript:;" id='tab_detail' class='tab'><span><{t}>purchase_order_detail<{/t}></span></a>
        </li>
        
    </ul>
</div>

<div class='tabContent' id='detail'>


		<table cellspacing="0" cellpadding="0" class="formtable tableborder">
			<thead>
			<tr>
				<th class="center" width='100'><{t}>purchase_order_code<{/t}></th>
				<th class="center"><{t}>sku<{/t}></th>
				<th class="center" width='100'><{t}>ChineseDescription<{/t}></th>
				<th class="center"><{t}>purchase_order_quantity<{/t}></th>		
				<th class="center"><{t}>QuantityReceived<{/t}></th>				
			</tr>
			</thead>
			<tbody>
			<{foreach from=$purchase_order_body_rows item=row}>
			<tr>
				<td><{$row.po_code}></td>
				<td><{$row.product_sku}></td>
				<td><{$row.product_title}></td>
				<td><{$row.order_quantity}></td>	
				<td><{$row.received_quantity|default:'0'}></td>				
			</tr>
			<{/foreach}>
			</tbody>
		</table>


</div>




<div class='clear'></div>
</div>
</div>

<script type="text/javascript">

    $(function(){

        $(".tab").click(function(){
            $(".tabContent").hide();

            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
            $("#"+$(this).attr("id").replace("tab_","")).show();
        });

        //$(".tabContent").eq(0).show();
        $("#detail").show();
    });
    //-->
</script>


<script>
$(function(){
    
    $("#detail").alterBgColor();
	
});
</script>