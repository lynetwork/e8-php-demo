<?php
/**
 * 初始化需要用到的库文件
 */
require('config/config.php');
require('class/RequestHandler.class.php');
require('class/PayHttpClient.class.php');
$reqHandler = new RequestHandler();
$pay = new PayHttpClient();
$cfg = new Config();

/**
 * 组成下单参数
 */
$orderid = 'test'.date("YmdHis").rand(10000,99999);//生成订单号-商户根据自己情况做修改
$reqHandler->setGateUrl($cfg->C('ly_url'));//设置下单请求的URL地址,配置文件中修改
$reqHandler->setRSAKey($cfg->C('private_rsa_key'));//设置用来签名的RSA用户私钥,配置文件中修改
$reqHandler->setReqParams($_POST,array('method'));//设置常规请求参数,来自页面的部分数据,在index内修改
$reqHandler->setParameter('ly_user_id',$cfg->C('ly_user_id'));//设置下单请求的商户ID,在配置文件中修改
$reqHandler->setParameter('ly_order_no',$orderid);//设置生成好的订单号

$reqHandler->unsetParameter('parter');//去掉两个无用的参数
$reqHandler->unsetParameter('key');//去掉两个无用的参数

/**
 * 创建签名并下单
 */
if($reqHandler->getParameter('ly_scan_code') == 'true'){
	/***
	 * 如果是直反二维码为POST请求,返回JSON数据
	 */
	$reqHandler->createRSASign();//创建签名
	$pay->setReqContent($reqHandler->getGateURL(),$reqHandler->getAllParameters());//生成待发送的数据
	$pay->call();//发送POST请求
	$parames = json_decode($pay->getResContent(),true);//接收平台返回的JSON数据
	if($parames['result_status']){
		echo '付款类型:' .$parames['trade_type'].'</br>';
		echo '付款金额:' .$parames['money'].'</br>';
		echo '创建时间:' .$parames['create_time'].'</br>';
		echo '上层系统单号:' .$parames['sys_order_no'].'</br>';
		echo '商户系统单号:' .$parames['user_order_no'].'</br>';
		echo '二维码连接:' .$parames['qr_code'].'</br>';
		echo '下单状态:' .$parames['result_status'].'</br>';
		echo '返回消息:' .$parames['result_msg'].'</br>';
		echo '返回状态码:' .$parames['result_code'].'</br>';
	}else{
		echo '付款类型:' .$parames['trade_type'].'</br>';
		echo '付款金额:' .$parames['money'].'</br>';
		echo '商户系统单号:' .$parames['user_order_no'].'</br>';
		echo '下单失败:'.$parames['result_status'].'</br>';
		echo '返回消息:' .$parames['result_msg'].'</br>';
		echo '返回消息码:' .$parames['msg_enum'].'</br>';
		echo '返回的状态码:' .$parames['result_code'].'</br>';
	}


}else{
	/**
	 * 如果是跳转到我方扫码/收银台使用GET请求
	 */
	$url = $reqHandler->getRequestURL();
	Header("Location: $url");
}

