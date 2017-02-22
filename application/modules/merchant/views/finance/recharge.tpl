<style>
   .tabContent {
        display: none;
    }
    .clearfix:after {
        clear: both;
        content: " ";
        display: block;
        height: 0;
        overflow: hidden;
        visibility: hidden;
    }
    .div-ul {
        /*border-bottom: 1px dotted #B7B7B7;*/
        overflow: hidden;
        padding-bottom: 10px;
        padding-top: 2px;
 	    width: 100%;
		
		
    }
    .moneyWrap {
        height: 25px;
        margin-bottom: 10px;
        padding: 20px 0;
    }
    .btn_pay {
        border: medium none;
        cursor: pointer;
        font-family: Arial,Helvetica,sans-serif;
        background-color: #35C2E0;
        color: #FFFFFF;
        font-size: 15px;
        font-weight: bold;
        height: 34px;
        line-height: 34px;
        width: 132px;
    }
    .outline_div ul.outline_ul {
        border-bottom: 1px dotted #B7B7B7;
        padding-bottom: 25px;
		color:#444;
    }
    .outline_div ul.outline_ul li {
        font-size: 14px;
        height: 18px;
        padding: 10px 30px 0 0;
    }
	
    ul, li {
        list-style: none outside none;
    }
    .spanstrong{
        margin: 0;
        padding: 0;
        vertical-align: baseline;
        color: #666;
        font: bold 14px arial,sans-serif;
    }
	 ul.tabs li{
		padding-bottom:10px;
		
	}
	
</style>

<div class="content-box  ui-tabs  ui-corner-all">

    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>CustomerRecharge<{/t}></h3>        
    </div>

	<div style="margin-left:25px;margin-top:10px;width:80%;text-align:left;background-color: #FBF1F1;border: 1px solid #FACACA;font-size: 13px;line-height: 24px;padding: 10px 24px;">
    <div class="tips_text"><{t}>Account<{/t}>：<{$customer.customer_code}><br /><{t}>AccountAmount<{/t}>：
        <span style="color: #DD3431;font-size: 24px;font-weight: bold;"><{$balance.cb_value}></span><{$customer.customer_currency}><br />
        <span style="color: #DB5351;font-size: 12px;line-height: 24px;"><{t}>BalanceInsufficient<{/t}></span>
    </div>
</div>
<div style="margin-left:25px;padding-top: 25px;width:80%;text-align: left;">
    <h3 style="font-size: 16px;"><{t}>SelectRecharge<{/t}></h3>
    <div class="tabs_header" style="margin-top: 4px;;">
        <ul class="tabs">
            <li class='active'>
                <a href="javascript:;" id='tab_Platform' class='tab'><span><{t}>PaymentPlatform<{/t}></span></a>
            </li>
            <li><a href="javascript:;" id='tab_online' class='tab'><span><{t}>OnlinePayment<{/t}></span></a></li>
        </ul>
    </div>

    <div class='tabContent' id='Platform'>
        <form onsubmit="return false;">
        <div class="div-ul clearfix" >
            <ul>
                <li style="float:left;height: 42px; line-height:42px;width: 180px; ">
                    <input type="radio" onclick="" value="paypal" name="paymentMethod" class="radio" id="BankCode-paypal"><img alt="Paypal" src="/images/paypal.gif"   style="vertical-align:middle;"/>
                    
                </li>
                <li style="float:left;height: 42px;line-height:42px;width: 180px;">
                    <input type="radio" onclick="" value="alipay" name="paymentMethod" class="radio" id="BankCode-alipay"><img alt="" src="/images/alipay.gif" style="vertical-align:middle;"/>
                    
                </li>
            </ul>
       	<div class="clear"></div>
        <div class="moneyWrap" style="float:left;">
            <span><{t}>RechargeAmount<{/t}>：</span>
            <input type="text" maxlength="10" value="" name="amount" class="amount_init" id="amount-input">
            <span id="currencyType"><{$customer.customer_currency}></span>
            <div class="clearfix"></div>
        </div>
		<div class="clear"></div>
        <div class="suBtn" style="display: block;margin-bottom:10px">
            <button class="btn_pay"><{t}>DetermineRecharge<{/t}></button>
        </div>
        </form>
    </div>
	</div>
    <div class="tabContent" id="online">
        <div class="outline_div clearfix" style="display: block;">
            <ul class="outline_ul">
                <li> <span class="spanstrong">Company Name:</span> &nbsp;CARGO SERVICES (CHINA) LIMITED SHENZHEN BRANCH</li>
                <li> <span class="spanstrong">Bank:</span> CHINA MERCHANTS BANK SHENZHEN ANLIAN BRANCH </li>
                <li> <span class="spanstrong">Address:</span> ROOT NO.B01, 1/F, ANLIAN PLAZA, NO.4018, JINTIAN ROAD, FUTIAN DISTRICT, SHENZHEN, P.R. CHINA </li>
                <li>
                    <span class="spanstrong">USD：</span>
                    <span class="red strong">814781163832001</span>
                </li>
            </ul>
            <div class="outline_tips">

            </div>
        </div>
    </div>

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


        $("#Platform").show();
    });
    //-->
</script>