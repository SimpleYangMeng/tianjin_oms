<!--此页可能是废弃页面!-->
<h2 class="contentTitle">组合产品</h2>
<div class="pageContent">
	<form method="post" action="/merchant/product/combine-add-save" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>SKU编号：</dt>
				<dd>
					<input name="sku" id="sku" class="required" type="text" />
				</dd>
			</dl>
			<dl>
				<dt>组合名称：</dt>
				<dd>
					<input name="title" id="title" class="required" type="text" size="50" />
				</dd>
			</dl>
			<dl>
				<dt>英文名称：</dt>
				<dd>
					<input name="title_en" id="title_en" type="text" size="50">
				</dd>
			</dl>
			<dl>
				<dt>添加产品：</dt>
				<dd>
					<a class="button" href="/merchant/product/repository" target="dialog" mask="true" title="产品库"><span>选择产品</span></a>
				</dd>				
			</dl>
			<div class="divider"></div>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>