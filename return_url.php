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
$resHandler->setContent($_REQUEST);//接收平台的所有数据
$resHandler->setRSAKey($cfg->C('public_rsa_key'));//设置平台的公钥用于解密验签,在配置文件内修改
$resHandler->setSignType('RSA2');//设置加密类型

/**
 * 商户可以在该层外做订单重复验证
 */
if($resHandler->getParameter('result_status') == 'S'){//验资付款是否为成功状态
		/**
		 * 商户可根据如下取值内容,进行自己的业务逻辑
		 */
		$singstatus = '';
		if($resHandler->verifyRSASign()){
			$singstatus = '成功';
		}else{
			$singstatus = '失败';
		}
		echo '验签结果:'.$singstatus.'</br>';
		echo '实际付款金额:'.$resHandler->getParameter('ly_money').'</br>';//获取上层返回的实际付款金额,以分为单位
		echo '平台系统订单号:'.$resHandler->getParameter('ly_sys_order_no').'</br>';//获取上层返回的平台订单号
		echo '商户系统订单号:'.$resHandler->getParameter('ly_user_order_no').'</br>';//获取上层返回的商户订单号

}else{
	echo '付款失败,不做任何处理';
}
/**
 * 同步通知页面,暂不做验签,官方推荐不要将同步通知作为最终的实际付款操作,该方法若付款人关闭浏览器后将无法正常工作,最终结果以异步通知为准
 */
?>