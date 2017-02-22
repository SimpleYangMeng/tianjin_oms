<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=7"/>
    <title>二维码打印</title>
</head>
<body>
<{foreach item=item from=$qrCodeData}>
<div>
<img src="data:image/png;base64,<{$item.qrCode}>"/>
<div style="text-align:center;width:220px;"><{$item.seqNo}>*<{$item.qty}></div>
</div>
<{/foreach}>
</body>
</html>