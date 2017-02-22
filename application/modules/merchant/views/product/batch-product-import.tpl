<style type="text/css">
    .tableborder th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;
        width: 30%;
    }
    .tableborder td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    .message-warning
    {
        color: #5f5200;
		padding:5px;
		min-height:300px;
		
    }
    .error
    {
        margin: 0;
        padding: 8px 0 0 0;
        height: 1%;
        display: block;
        clear: both;
        overflow: hidden;
        color: #FF0000;
        padding-left: 20px;
    }
</style>
<div class="content-box  ui-tabs  ui-corner-all" style="height:800px">

    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>BatchProductExport<{/t}></h3> 
		<div class="clear"></div>       
    </div>
	
	
 	

	

	
	<!--<form action="/merchant/product/batch-product-insert" method="post" id="XLSInputForm">	-->
	<form action="/merchant/product-batch-upload/batch-product-import-preview" method="post" id="XLSInputForm"  enctype="multipart/form-data" onsubmit="return checkform()">	
		<table cellspacing="0" cellpadding="0" class="tableborder">
			<tr>
			<th><{t}>please_select_upload_file<{/t}>:</th>
			<td><input type="file" name="XMLForInput" id="XMLForInput" />
			<font style="color:red;"><{t}>please_select_xls_file<{/t}></font>
			</td>
			</tr>


			<tr>
			<th><{t}>sample_file_download<{/t}>:</th>
			<td>
			<img src="/images/download.png" style="width:25px;"><span style="color:#999"><{t}>download_templete<{/t}>:</span><a  style="color:#666666;text-decoration:underline;" href="/merchant/product-batch-upload/product-batch-import-templete"><{t}>product_template<{/t}></a>
			</td>
			</tr>	
			
			<tr>
			<td colspan="2" style="padding-left:35%;">
			<input  type="submit"  class="button buttonheight" value="<{t}>batch_upload<{/t}>" />		
			</td></tr>			
			
		</table>
		
	</form>	
<{if $result && $result.ask==1 }>

	<table cellspacing="0" cellpadding="0" class="formtable tableborder"  style="margin-top:10px">
            <thead>
            <tr>
                <th style=" text-align:center" ><{t}>skuCode<{/t}></th>             
                <th style=" text-align:center"><{t}>notice<{/t}></th>
            </tr>
			<{foreach name=data key=index from=$result.data item=row}>
			
			<tr>
				<td><{$row.product_sku}></td><td>
				
				<{foreach from=$row.error item=error }>
    			<{$error}>
    			<{/foreach}>
				
				
				</td>
			</tr>
			
			<{/foreach}>
            </thead>
            <tbody id='orderproducts'>          

            </tbody>
        </table>
	

<{/if}>

<br/>
<{if isset($uploadinfo) && ($uploadinfo['ask']=='0')}>
<div class="message-warning">
   <div><{$uploadinfo['message']}></div>
    <{foreach from=$uploadinfo['error'] item=error }>
    <div class="error"><{$error}></div>
    <{/foreach}>
</div>
<{/if}>

	
</div>



<script type="text/javascript">
    function checkform(){
        if(!$('#XMLForInput').val()){
            alertTip('<{t}>make_sure_that_you_have_selected_a_file<{/t}>');
            return false;
        }
        return true;
    }
</script>

<script>
function resetbox(){         
             $("#orderproducts").html('');          

}
</script>