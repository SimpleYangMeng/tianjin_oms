<?php
require_once ('config.php');
$flagFile = APPLICATION_PATH . '/../data/log/dailyCollection.lock';
if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}
$link = fopen($flagFile, 'wb');
fclose($link);

$productDailyFile = APPLICATION_PATH . '/../data/product/'.date('Y/m/d').'/'.date("Ymd").".csv";
$customerDailyFile = APPLICATION_PATH . '/../data/customer/'.date('Y/m/d').'/'.date("Ymd").".csv";
$productCondition = array(
	'product_status'	=> 1,
);
$productColumnTitle	= array(
	'customer_code'		=> array("name"=>'电商企业代码'),
	'enp_name'			=> array("name"=>'电商企业名称'),
	'storage_enp_code'	=> array("name"=>'仓储企业代码'),
	'storage_enp_name'	=> array("name"=>'仓储企业名称'),
	'product_title'		=> array("name"=>'商品名称'),
	'hs_code'			=> array("name"=>'海关编码'),
	//'pu_code'			=> array("name"=>'申报单位'),
	'registerID'		=> array("name"=>'备案编号'),
	//'product_sku'		=> array("name"=>'商品货号'),
);
$products = Service_Product::getByCondition($productCondition);
$productData = dataFormat($productColumnTitle,$products);
exportCsv($productDailyFile,$productData);
$productNotice = Service_SjNotice::getByField('2','type');
if(empty($productNotice)){
	$lastId = Service_SjNotice::add(
		array(
			'sn_notice_serial_no'	=> date('YmdHis')."1",
			'sn_title'				=> '已审核的商品信息',
			'sn_info'				=> "已审核的商品信息资料(截止".date('Y-m-d H:i:s').")&nbsp;&nbsp;&nbsp;<a href='downloads(".$lastId.")'>下载</a>",
			"sn_add_time"			=> date("Y-m-d H:i:s"),
			"sn_update_time"		=> date("Y-m-d H:i:s"),
			"type"					=> 2,
			"down_url"				=> $productDailyFile,
		)
	);
	Service_SjNotice::update(
		array(
			'sn_info'				=> "已审核的商品信息资料(截止".date('Y-m-d H:i:s').")&nbsp;&nbsp;&nbsp;<a herf='#'  onclick='downloads(".$lastId.")'>下载</a>",
		),$lastId
	);
}else{
	$lastId = $productNotice['sn_id'];
	Service_SjNotice::update(
		array(
			'sn_notice_serial_no'	=> date('YmdHis')."1",
			'sn_title'				=> '已审核的商品信息',
			'sn_info'				=> "已审核的商品信息资料(截止".date('Y-m-d H:i:s').")&nbsp;&nbsp;&nbsp;<a herf='#' onclick='downloads(".$lastId.")'>下载</a>",
			"sn_add_time"			=> date("Y-m-d H:i:s"),
			"sn_update_time"		=> date("Y-m-d H:i:s"),
			"type"					=> 2,
			"down_url"				=> $productDailyFile,
		),$productNotice['sn_id']
	);
}

$customersColumnTitle	= array(
	'customer_code'		=> array("name"=>'客户代码'),
	'trade_name'		=> array("name"=>'企业名称'),
	'customs_code'		=> array("name"=>'主管海关','value'=>array('0208'=>'保税','0213'=>'东疆')),
	'is_storage'		=> array("name"=>'仓储企业','value'=>array('0'=>'否','1'=>'是')),
	'is_pay'			=> array("name"=>'支付企业','value'=>array('0'=>'否','1'=>'是')),
	'is_shipping'		=> array("name"=>'物流企业','value'=>array('0'=>'否','1'=>'是')),
	'is_ecommerce'		=> array("name"=>'电商企业','value'=>array('0'=>'否','1'=>'是')),
	'is_baoguan'		=> array("name"=>'报关企业','value'=>array('0'=>'否','1'=>'是')),
	'is_platform'		=> array("name"=>'电商平台','value'=>array('0'=>'否','1'=>'是')),
);
$customerCondition = array(
	'customer_status'	=> 2,
);
$customers	= Service_Customer::getByCondition($customerCondition);
$customersData = dataFormat($customersColumnTitle,$customers);
exportCsv($customerDailyFile,$customersData);
$customerNotice = Service_SjNotice::getByField('1','type');
if(empty($customerNotice)){
	$lastId = Service_SjNotice::add(
		array(
			'sn_notice_serial_no'	=> date('YmdHis')."2",
			'sn_title'				=> '已审核的企业备案信息',
			'sn_info'				=> "已审核的企业备案信息资料(截止".date('Y-m-d H:i:s').")&nbsp;&nbsp;&nbsp;<a href='#' onclick='downloads(".$lastId.")'>下载</a>",
			"sn_add_time"			=> date("Y-m-d H:i:s"),
			"sn_update_time"		=> date("Y-m-d H:i:s"),
			"type"					=> 1,
			"down_url"				=> $customerDailyFile,
		)
	);
	Service_SjNotice::update(
		array(
			'sn_info'				=> "已审核的企业备案信息资料(截止".date('Y-m-d H:i:s').")&nbsp;&nbsp;&nbsp;<a href='#' onclick='downloads(".$lastId.")'>下载</a>",
		),$lastId
	);
}else{
	$lastId = $customerNotice['sn_id'];
	Service_SjNotice::update(
		array(
			'sn_notice_serial_no'	=> date('YmdHis')."2",
			'sn_title'				=> '已审核的企业备案信息',
			'sn_info'				=> "已审核的企业备案信息资料(截止".date('Y-m-d H:i:s').")&nbsp;&nbsp;&nbsp;<a href='#' onclick='downloads(".$lastId.")'>下载</a>",
			"sn_add_time"			=> date("Y-m-d H:i:s"),
			"sn_update_time"		=> date("Y-m-d H:i:s"),
			"type"					=> 1,
			"down_url"				=> $customerDailyFile,
		),$customerNotice['sn_id']
	);
}
function dataFormat($title,$data){
	$titleColumn		= array();
	$titleArrayName		= array();
	$dataStr			= '';
	foreach($title as $key=>$val){
		$titleArrayName[] =  $val['name'];
		$titleColumn[]	= $key;
	}
	$titleStr = join(',',$titleArrayName)."\n";
	foreach($data as $key=>$val){
		foreach($titleColumn as $keyVal){
			if(isset($title[$keyVal]['value'])){
				$dataStr .= $title[$keyVal]['value'][$val[$keyVal]].",";
			}else{
				$dataStr .= $val[$keyVal].",";
			}
		}
		$dataStr .= "\n";
	}
	return iconv("UTF-8", "GBK//IGNORE", $titleStr.$dataStr);
}

function exportCsv($filename,$data)   
{
	$absolutePath = dirname($filename);
	if(!file_exists($absolutePath)) {
		mkdir($absolutePath, 0777, true);
	}
	$fp=fopen($filename,"wb");
	fputs($fp, $data);
	fclose($fp);
}
echo "[".date('Y-m-d H:i:s') ."]统计备案产品及备案企业结束\r\n";
@unlink($flagFile);