<?php
/**
 * 初始化需要用到的库文件
 */
header("Content-type:text/html;charset=utf8");
require('config/config.php');
require('class/ClientResponseHandler.class.php');
$resHandler = new ClientResponseHandler();
$cfg = new Config();

/**
 * 接收平台发送的数据等处理
 */
$resHandler->setContent($_POST);//接收平台的POST表单数据
$resHandler->setRSAKey($cfg->C('public_rsa_key'));//设置平台的公钥用于解密验签,在配置文件内修改
$resHandler->setSignType('RSA2');//设置加密类型

/**
 * 商户可以在该层外做订单重复验证
 */
if($resHandler->getParameter('result_status') == 'S'){//验资付款是否为成功状态
	if($resHandler->verifyRSASign()){//验证签名是否合法,以防非法刷单
		echo 'ok';//如果验签成功商户可再此调用自身的充值处理,并给上层接口返回ok/success 纯文本,请勿返回其他内容,以防上层判断出错导致频繁发送回调信息
		/**
		 * 商户可根据如下取值内容,进行自己的业务逻辑
		 */
		$resHandler->getParameter('ly_money');//获取上层返回的实际付款金额,以分为单位
		$resHandler->getParameter('ly_sys_order_no');//获取上层返回的平台订单号
		$resHandler->getParameter('ly_user_order_no');//获取上层返回的商户订单号
	}else{
		echo '验签失败,不做任何处理';
	}
}else{
	echo '付款失败,不做任何处理';
}