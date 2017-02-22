<li><{t}>LoginAccount<{/t}>：<{$user['account_email']}><{if $user['account_level'] != 0}>-<{$user['code']}><{/if}></li>
<li>
<{if $lang=='en_US'}>
<a onclick="changeLang('zh_CN')"><{t}>Chinese<{/t}></a>  
<{elseif $lang='zh'}>
<a onclick="changeLang('en_US')"><{t}>English<{/t}></a>  
<{/if}>

<li><a href="/merchant/customer/change-password" onclick="openMenuTab('/merchant/customer/change-password','<{t}>ChangePassword<{/t}>','tab-change-password');return false;"><{t}>ChangePassword<{/t}></a></li>		
<li><a href="/login/out"><{t}>Logout<{/t}></a></li>
</li>