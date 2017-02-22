<style type="text/css">
    #ASNForm tbody th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;

    }
    #ASNForm tbody td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
   *#ASNForm tbody span.error{
        top:auto;
    }
    span.error{
        top:auto;
    }
</style>
<style>
  #subProducts .textInput{
      float:none;
  }
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all asncontent">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><{$actions}></h3>
        <div class="clear"></div>
    </div>			
				
    

<!--<div id="dialog" title="<{t}>SelectProduct<{/t}>fff">
</div>-->
<div class="infoTips" id="messageTip" title="<{t}>InformationTips<{/t}>">
			
</div>
<div id="selectModelDialog" title="" class="hidden">
<table>
    <tr>
        <td align='right'><{t}>please_select_asn_model<{/t}>:</td>
        <td align='left'>
			<input type="button" value='<{t}>CollectingMode<{/t}>' class="ui-state-default button selectmodelbtn" model='1' receive_type='0'>
            <input type="button" value='<{t}>DeliveryMode<{/t}>' class="ui-state-default button selectmodelbtn" model='0'  receive_type='0'>
			<input type="button" value='<{t}>return_mode<{/t}>' class="ui-state-default button selectmodelbtn" model='0'  receive_type='1'>
			
        </td>
    </tr>
</table>


</div>
</div>

<script type="text/javascript">
    $(function(){
        //开始时提示
        $('#selectModelDialog').dialog({
            autoOpen: false,
			position:[50,50],
            modal: false,
            bgiframe:true,
            width: 800,
            resizable: true
        });
        <{if isset($modify) && $modify=='1' }>
            getreceiveModel('<{$receiving.receive_model_type}>','<{$receiving.receiving_type}>');
        <{else}>
        //处理模式
        $('#selectModelDialog').dialog('open');
        $('.selectmodelbtn').bind('click',function(){
            //alert($(this).attr('model'));
            $('#ordermodeltext').html($(this).val());
            $('[name=ordermodel]').val($(this).attr('model'))
            $('.modelcontent').show();
            $('.asncontent').hide();			
            getreceiveModel($(this).attr('model'),$(this).attr('receive_type'));
        });
        $('.modelcontent').hide();
        <{/if}>
    });
    //得带模板内容
    
	function getreceiveModel(receivemodel,receive_type_input){
		//alert(receivemodel);
        var receivemodel = receivemodel||0;
		var receive_type =  receive_type_input|| '0';
		var ASNCode = '<{$receiving_code}>';
        $.ajax({type:'get',
            dataType:'html',
            url:'/merchant/receiving/create',
            data:{'receivemodel':receivemodel,'receive_type':receive_type,'type':'getTpl','ASNCode':ASNCode},
            success:function(html){			  
               $('.model').hide();		    
               $('.asncontent').html(html).show();			  
               $('#selectModelDialog').dialog('close');
               //$('.content-box-header').remove();
            }});
		
    }//function getreceiveModel(receivemodel){

</script>