<!--此页可能是废弃页面!-->
<h2 class="contentTitle">产品信息</h2>
<div class="pageContent">
	<form method="post" action="/merchant/product/edit-save" enctype="multipart/form-data" class="pageForm required-validate" onsubmit="return iframeCallback(this, navTabAjaxDone);">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>海关编号：</dt>
				<dd>
					<input type="text" name="hscode" id="hscode" minlength="10" maxlength="10" class="required digits" value="<{$result['product_id']}>" />
					<span class="info">海关编号关联对应产品必须的申报要素</span>
				</dd>
			</dl>
			<dl>
				<dt>SKU编号：</dt>
				<dd>
					<input name="sku" id="sku" class="required" type="text" value="<{$result['product_sku']}>" />
				</dd>
			</dl>
			<dl>
				<dt>产品名称：</dt>
				<dd>
					<input name="title" id="title" class="required" type="text" size="50" value="<{$result['product_title']}>" />
				</dd>
			</dl>
			<dl>
				<dt>英文名称：</dt>
				<dd>
					<input name="title_en" id="title_en" type="text" size="50" value="<{$result['product_title_en']}>" />
				</dd>
			</dl>
			<dl>
				<dt>产品类型：</dt>
				<dd>
					<select name="type" class="required combox">
						<option value="">请选择...</option>
						<{if $category neq ""}>
							<{foreach from=$category item=item}>
								<option value="<{$item['pc_id']}>" <{if $item['pc_id'] eq $result['pc_id']}>selected<{/if}> ><{$item["pc_name"]}></option>
							<{/foreach}>
						<{/if}>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>产品单位：</dt>
				<dd>
					<select name="uom" class="required combox">
						<option value="">请选择...</option>
						<{if $uom neq ""}>
							<{foreach from=$uom item=item}>
								<option value="<{$item['code']}>" <{if $item['code'] eq $result['pu_code']}>selected<{/if}> ><{$item["name"]}></option>
							<{/foreach}>
						<{/if}>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>条码类型：</dt>
				<dd>
					<select name="barcode_type" class="required combox">
						<option value="0" <{if 0 eq $result['product_barcode_type']}>selected<{/if}> >默认类型</option>
						<option value="1" <{if 1 eq $result['product_barcode_type']}>selected<{/if}> >自定义类型</option>
						<option value="2" <{if 2 eq $result['product_barcode_type']}>selected<{/if}> >序列类型</option>
					</select>
					<{if 1 eq $result['product_barcode_type']}>
						<input name="barcode" id="barcode" type="text" value="<{$result['product_barcode']}>" />
					<{else}>
						<input name="barcode" id="barcode" type="text" style="display:none;" />
					<{/if}>
				</dd>
			</dl>
			<dl>
				<dt>产品规格：</dt>
				<dd>
					长度：<input type="text" name="length" id="length" size="10" class="separate" value="<{$result['product_length']}>"/>
					宽度：<input type="text" name="weight" id="weight" size="10" class="separate" value="<{$result['product_width']}>"/>
					高度：<input type="text" name="height" id="height" size="10" class="separate" value="<{$result['product_height']}>"/>
				</dd>
			</dl>
			<dl>
				<dt>产品价格：</dt>
				<dd>
					销售：<input type="text" name="sales_value" id="sales_value" size="10" class="separate" value="<{$result['product_sales_value']}>"/>
					采购：<input type="text" name="purchase_value" id="purchase_value" size="10" class="separate" value="<{$result['product_purchase_value']}>"/>
					申报：<input type="text" name="declared_value" id="declared_value" size="10" class="separate" value="<{$result['product_declared_value']}>"/>
				</dd>
			</dl>
			<{if $result['attached']|@count gt 0}>
				<{foreach from=$result['attached'] item=item name=customer}>
					<dl>
						<dt>产品图片：</dt>
						<dd>
							<input type="file" name="pic_<{$smarty.foreach.customer.iteration}>" id="pic_<{$smarty.foreach.customer.iteration}>" class="textInput" size="38" />
							<span class="info"><a target="_blank" href="<{$item['pa_path']}>">查看图片</a>不修改请留空！</span>
						</dd>
					</dl>
				<{/foreach}>
				<dl>
					<dt>&nbsp;</dt>
					<dd>
						<input id="add_pic" type="button" value="增加图片" />
					</dd>				
				</dl>				
			<{else}>
				<dl>
					<dt>产品图片：</dt>
					<dd>
						<input type="file" name="pic[]" id="pic" class="textInput" size="38" />
						<span class="info"><input id="add_pic" type="button" value="增加" /></span>
					</dd>				
				</dl>
			<{/if}>
		</div>
		<div class="formBar">
			<ul>
				<li>
					<div class="buttonActive">
						<div class="buttonContent">
							<input type="hidden" name="imgs" value="<{$result['attached']|@count}>" />
							<input type="hidden" name="eid"  value="<{$result['product_id']}>" />
							<button type="submit">提交</button>
						</div>
					</div>
				</li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>
<script type="text/javascript">
	function del_pic(index){
		$(".add_pic_"+index).remove()
	}
	$(function(){
		$("select[name='barcode_type']").change(function(){
			var selected = $(this).val();
			if (selected == 1) {
				$('#barcode').show();
			} else {
				$('#barcode').hide();
			}
		})		
		$("#add_pic").click(function(){
			i		= $("input[name^='pic_']").length+1;
			id		= "pic_"+i;
			cname	= "add_pic_"+i;
			position= $(this).parent().parent();			
			position.after('<dl class="'+cname+'"><dt>产品图片：</dt><dd><input type="file" id="'+id+'" name="'+id+'"  class="textInput" size="38" /><span class="info"><input type="button" onclick="del_pic('+i+')" value="删除" /></span></dd></dl>');
		});		
	})
</script>