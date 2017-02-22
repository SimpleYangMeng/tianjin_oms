<style>
    <!--
    *{margin:0px;padding:0px;font-size:12px;color:#000000;}

    @meida screen{

    }
    .print-main{
        font-size: 10px;
        width: 20cm;
        padding-top: 5px;
        text-align: center;
        margin: 0 auto;
        line-height:20px;
    }
    @meida print{
       .print-main{
        font-size: 10px;
        width: 20cm;
        padding-top: 5px;
       }
    }
    .print-table{
        width:98%;
        margin:0 auto;
    }
    table { border-collapse: separate; }
    .print-table td, .print-table th{
        border: 1px solid #000000;
        border-collapse: collapse;
    }
    .print-table .qiye td, .print-table .qiye th{
        border: 0px solid #000000;
        border-collapse: collapse;
        text-align: center;
    }
    .print-table .noborder td, .print-table .noborder th{
        border:none;
        border-collapse: collapse;
    }

    .info th {
        width:120px;
    }
    .info td {
        padding-left:5px;
    }
    * {
        word-break: break-all;
        word-wrap: break-word;
    }
    .imgWrap{
        width:75px;
        text-align:center;
    }
    .list td{
       text-align:center;
    }
    td,th{
        height:30px;
        white-space:nowrap;
    }
    .noborder td,th{
        height:30px;
        border-collapse: collapse;
        /*white-space:normal;*/
    }
   .baosui{
       /*float: left;
       clear: both;*/
       font-weight: 600;
   }
   .bond{
       font-weight: 600;
   }
   .left{
       float: left;
   }
   .clear{
       clear: both;
   }
    .print-table .noborder .xuxian{
       border-bottom:1px dashed #000000;
        border-collapse: collapse;

   }
    .print-table .noborder .shixian{
       border-bottom:1px solid #000000;
        border-collapse: collapse;
   }
   td div{
       margin-top: 5px;
       margin-bottom: 5px;
   }
    -->
</style>

<div class="print-main">
<{if !isset($asnInfo)}>
<div class='center'>入库单不存在</div>
<{else}>
<div style="width:20cm;text-align: center;">
    <div class="clear"><div class="left"><img  class='barcode' style="width:8.2cm;height:1cm;margin-left:0cm;" src="/default/index/barcode?code=<{$asnInfo.receiving_code}>"></div><div class='baosui left' style="padding-left: 50px;">中华人民共和国保税港区</div></div>
    <div class="clear" style="padding-left: 20px;padding-top:20px;"><div class="left">报关单:</div><div class="left bond" style="padding-left: 150px;"><{$asnInfo.form_type_name}></div></div>
    <div class="clear">
    <table cellspacing="0" cellpadding="0" class="print-table info" style="border-collapse:collapse;text-align: ;">
      <tr>
          <td>
              <div>仓库账册号</div>
              <div><{$asnInfo.warehouse_code}></div>
          </td>
          <td>
              <div>出入库单编号</div>
              <div><{$asnInfo.receiving_code}></div>
          </td>
          <td>
              <div>清单企业内部编号</div>
              <div><{$asnInfo.list_no}></div>
          </td>
          <td>
              <div>申请日期</div>
              <div><{$asnInfo.import_date|date_format:'%Y-%m-%d'}></div>
          </td>
          <td>
              <div>申报地海关(<{$asnInfo.decl_port}>)</div>
              <div><{$asnInfo.decl_port_name}></div>
          </td>
          <td>
              <div>申报单位(<{$asnInfo.agent_code}>)</div>
              <div><{$asnInfo.agent_name}></div>
          </td>
      </tr>
      <tr>
           <td>
                <div>进出口岸(<{$asnInfo.ie_port}>)</div>
                <div><{$asnInfo.ie_port_name}></div>
           </td>
           <td>
               <div>监管方式(<{$asnInfo.trade_mode}>)</div>
               <div><{$asnInfo.trade_mode_name}></div>
           </td>
           <td>
               <div>成交方式(<{$asnInfo.trans_mode}>)</div>
               <div><{$asnInfo.trans_mode_name}></div>
           </td>
           <td>
               <div>运输方式(<{$asnInfo.traf_mode}>)</div>
               <div><{$asnInfo.traf_mode_name}></div>
           </td>
           <td>
               <div>经营单位(<{$asnInfo.trade_co}>)</div>
               <div><{$asnInfo.trade_name}></div>
           </td>
           <td>
               <div>收(发)货单位(<{$asnInfo.owner_code}>)</div>
               <div><{$asnInfo.owner_name}></div>
           </td>
      </tr>
      <tr>
          <td>
              <div>起/抵运地(<{$asnInfo.trade_country_code}>)</div>
              <div><{$asnInfo.trade_country_name}></div>
          </td>
          <td>
              <div>征免性质</div>
              <div></div>
          </td>
          <td>
              <div>运输工具名称</div>
              <div><{$asnInfo.traf_name}></div>
          </td>
          <td>
              <div>航次</div>
              <div><{$asnInfo.voyage_no}></div>
          </td>
          <td>
              <div>业务类型(<{$asnInfo.form_type}>)</div>
              <div><{$asnInfo.form_type_name}></div>
          </td>
          <td>
              <div>提运单号</div>
              <div><{$asnInfo.bill_no}></div>
          </td>
      </tr>
      <tr>
          <td>
              <div>件数 <{$asnInfo.pack_no}></div>
          </td>
          <td>
              <div>包装种类(<{$asnInfo.wrap_type}>)</div>
			  <div><{$asnInfo.wrap_type_name}></div>
          </td>
          <td>
              <div>毛重 <{$asnInfo.roughweight}></div>
          </td>
          <td>
              <div>净重 <{$asnInfo.net_weight}></div>
          </td>
          <td>
              <div>操作员</div>
              <div><{$asnInfo.decl_person}></div>
          </td>
          <td>
              <div>指/抵运港(<{$asnInfo.destination_port}>)</div>
              <div><{$asnInfo.destination_port_name}></div>
          </td>
      </tr>
      <tr>
          <td>
              <div>转关单预录入号</div>
			  <div>&nbsp;</div>
          </td>
          <td colspan="2">
              <div>集装箱号</div>
			  <div><{$asnInfo.container}></div>
          </td>
		  <td>
              <div>仓库使用企业(<{$asnInfo.storage_co}>)</div>
			  <div><{$asnInfo.storage_name}></div>
          </td>
		  <td colspan="2">
              <div>备注   </div>
			  <div>&nbsp;</div>
          </td>
      </tr>
      <tr>
          <td colspan="6" style="padding-left: 0;">
			  <{if $detail neq 1}>
			  <table class="noborder"  cellpadding='0' cellspace='0' border="0" style="border-collapse:collapse;margin: 0;padding: 0;width:100%;">
                  <thead style="padding-left: 0;">
                    <tr>
                        <td style="padding: 0;" class="shixian">项号</td>
                        <td class="shixian">商品编码</td>
                        <td class="shixian">中文名称/规格型号</td>
                        <td class="shixian">数量/单位</td>
						<td class="shixian">法定数量/单位</td>
                        <td class="shixian">第二数量/单位</td>
                        <td class="shixian">单价</td>
						<td class="shixian">总价</td>
						<td class="shixian">币制</td>
                    </tr>
                  </thead>
				  <{if isset($asnInfo.mergerDetail)}>
                  <{foreach from=$asnInfo.mergerDetail item=item key=key}>
                  <tbody>
					<tr>
					   <td class="xuxian"><{$item.merge_g_no}></td>
                       <td class="xuxian"><{$item.code_ts}></td>
					   <td class="xuxian"><div style="white-space:normal;width:150px;"><{$item.g_name_cn}><br/><{$item.g_model}></div></td>
					   <td class="xuxian"><{$item.g_qty}>/<{$uom[$item.g_unit]['name']}></td>
					   <td class="xuxian"><{$item.qty_1}>/<{$uom[$item.unit_1]['name']}></td>
					   <td class="xuxian"><{if $item.qty_2 gt 0}><{$item.qty_2}>/<{$uom[$item.unit_2]['name']}><{/if}></td>
					   <td class="xuxian"><{$item.decl_price}></td>
					   <td class="xuxian"><{$item.decl_total}></td>
					   <td class="xuxian"><{$currency[$item.curr]['currency_hs_code']}></td>
					 </tr>
				  </tbody>
				  <{/foreach}>
				  <{/if}>
			  <{else}>
				<table class="noborder"  cellpadding='0' cellspace='0' border="0" style="border-collapse:collapse;margin: 0;padding: 0;">
                  <thead style="padding-left: 0;">
                    <tr>
                        <td style="padding: 0;" class="shixian">序号</td>
                        <td class="shixian">归并序号</td>
                        <td class="shixian">商品料件号</td>
                        <td class="shixian">商品编码</td>
                        <td class="shixian">中文名称/规格型号</td>
                        <td class="shixian">法定数量/单位</td>
                        <td class="shixian">数量/单位</td>
                        <td class="shixian">第二数量/单位</td>
                        <td class="shixian">单价</td>
                        <td class="shixian">总价</td>
                        <td class="shixian">币制</td>
                        <td class="shixian">原产国</td>
                        <td class="shixian">征免方式</td>
                    </tr>
                  </thead>
                  <tbody>
                  <{if isset($asnInfo.ASNDetail)}>
                  <{foreach from=$asnInfo.ASNDetail item=item key=key}>
                    <tr>
                       <td class="xuxian"><{$key+1}></td>
                       <td class="xuxian"><{$item.merge_g_no}></td>
                       <td class="xuxian"><{$item.goods_id}></td>
                       <td class="xuxian"><{$item.code_ts}></td>
                       <td class="xuxian"><div style="white-space:normal;width:150px;"><{$item.g_name_cn}><br/><{$item.g_model}></div></td>
                       <td class="xuxian"><{$item.qty_1}>/<{$uom[$item.unit_1]['name']}></td>
                       <td class="xuxian"><{$item.g_qty}>/<{$uom[$item.g_unit]['name']}></td>
                       <td class="xuxian"><{if $item.qty_2 gt 0}><{$item.qty_2}>/<{$uom[$item.unit_2]['name']}><{/if}></td>
                       <td class="xuxian"><{$item.decl_price}></td>
                       <td class="xuxian"><{$item.decl_total}></td>
                       <td class="xuxian"><{$currency[$item.curr]['currency_hs_code']}></td>
					   <td class="xuxian"><{$country[$item.origin_country]['country_name']}></td>
                       <td class="xuxian">全免
                           <!--<div><{$item.duty_mode}></div>-->
                           <!--<div>照章征收</div>-->
                       </td>
                    </tr>
                  <{/foreach}>
                  <{/if}>
                  </tbody>
              </table>
			  <{/if}>
          </td>
      </tr>
    </table>
    </div>
</div>

</div>
<{/if}>
</div>
