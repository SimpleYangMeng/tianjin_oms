<div class="grid-780 grid-780-pd fn-hidden fn-clear">
    <div class="flow-steps">
        <ol class="num4">
            <li ><span class="first">注册账号</span></li>
            <li ><span>邮箱验证</span></li>
			<li  class="current"><span>注册条款</span></li>
            <li><span>完善资料</span></li>
            <li ><span>注册完成</span></li>
        </ol>
    </div>
    <div class="grid-780 fn-clear" >
		  <form id="registerForm" class="fm-layout" method="post" action="/register/step?current=3_1"  onsubmit="return docheck();">
            <fieldset>
                <p class="form-p">                 
                   <textarea class="text-input" type="text" style="height:500px; width: 100%" id="provision" name="provision">                   	
天津跨境贸易电子商务综合服务平台的条款如下:

版权本发行的版权由天津跨境贸易电子商务综合服务平台电子商务综合服务有限公司所有。

天津跨境贸易电子商务综合服务平台商标

  “天津跨境贸易电子商务综合服务平台”的注册商标的中文简体、繁体和英文，包括其文字及图形的组合，我公司已经向国家工商总局商标局申请商标注册，并获得批准。在该域名下的网页内容未经我公司授权允许，擅自使用 “天津跨境贸易电子商务综合服务平台”注册商标，属于恶意侵权行为。

网站内容准确性

  本公司网页可能包括由于疏忽大意的不准确现象或排版错误。一旦发现错误，天津跨境贸易电子商务综合服务平台将进行纠正。网页上的内容将定期进行更新，但是在未更新前可能出现不准确。全球独立运行的国际互联网站有成千上万之多，因此通过本网站而访问的某些信息可能来自于天津跨境贸易电子商务综合服务平台之外。 因此，天津跨境贸易电子商务综合服务平台对这些内容不承担任何义务或责任。

 
免责声明

  本网站中的服务、内容和信息仅以“按现状”的基础提供。在法律允许的最大范围内天津跨境贸易电子商务综合服务平台不提供任何陈述和保证，不论是明示的或是暗示的，包括但不限于适用于某特定用途、适销性和非侵权的暗示保证。天津跨境贸易电子商务综合服务平台公司以及许可方不保证本站点或系统提供的服务、内容和信息的准确性、完整性、安全性或及时性。通过天津跨境贸易电子商务综合服务平台系统或站点获取的信息不应构成任何在天津跨境贸易电子商务综合服务平台使用条款中没有明示的保证。一些具司法管辖权的地区不容许排除暗示保证，因此部分上述的排他条款可能不适用于您的情况。如果您是作为消费者面对免责条款，则这些规定不会影响您的法定权利，如果出现冲突，则您的权利不会被免除。您同意并声明这些使用条款中规定的对责任和保证的限制和排除是公平并且合理的。

 
责任限制

  在法律允许的最大范围内，在任何情况下，无论是根据担保、合同、侵权行为或其它任何法律理论，也无论天津跨境贸易电子商务综合服务平台是否被告知有此类损害的可能性，天津跨境贸易电子商务综合服务平台及其许可方或此站点中提到的其它第三方均不对由于此站点、天津跨境贸易电子商务综合服务平台OMS系统或者包含在站点中的服务、内容或信息的使用、无法使用或使用结果而造成的任何损害负责，包括但不限于由利润损失、数据丢失或业务中断所造成的损害。在适用法律允许的最大范围内，并 不对上述内容构成限制，您同意在任何情况下，无论是根据合同、侵权行为或其他，也无论起诉或索赔的方式，天津跨境贸易电子商务综合服务平台对任何损坏（直接或非直接）或者丢失承担的全部责任不超过100美元。在法律允许的最大范围内，在这些使用条款中为您陈述的补救条款将被排除并受限于这些使用条款中的明示内容。

 
信息披露

  由访问者向天津跨境贸易电子商务综合服务平台网页提供的所有信息都将被视为保密信息，除非由于提供服务所需，天津跨境贸易电子商务综合服务平台将不会将这些信息向任何第三方披露。
                   	
                   </textarea>
					<strong></strong>
				</p>
				<p class="form-p cl" style="margin: 6px 24px 6px;"> 
					<label style="cursor: pointer; float: right;"><input type="checkbox" value="1" name="is_agree"/><span style="margin-left: 6px;">同意</span></label>
				 </p>
				<p class="form-p" style="text-align:center;"> 
					<input type="submit" class="button" value="下一步" />
				</p>
				<ul id="registerinfo"></ul>	
			</fieldset>	
			</form>
    </div>
</div>
<script>
    function alertTip(tip) {  
		$('#registerinfo').empty();
		$('#registerinfo').show();
		$('<li class="error">'+tip+'</li>').appendTo($('#registerinfo'));
		//隐藏
		setTimeout(function (){
			$('#registerinfo').slideUp('slow');
		}, 2000);
		return;
		return false;
    }
	function docheck(){	
		var is_agree_bl = $("input[name='is_agree']").attr("checked");
		is_agree_bl = is_agree_bl || 'unchecked';
		if(is_agree_bl=='unchecked'){
			alertTip('不同意条款将不能进行后续注册流程');
			return false;
		}
		return true;
		
	}
</script>