<?php

/**
 * 后台应答类
 * ============================================================================
 * api说明：
 * getContent() / setContent(), 获取/设置原始内容
 * getParameter()/setParameter(),获取/设置参数值
 * getAllParameters(),获取所有参数
 * getDebugInfo(),获取debug信息
 * verifyRSASign(),获取RSA2签名结果
 * 
 * ============================================================================
 *
 */

class ClientResponseHandler  {

	/* 平台RSA公钥 */
	var $public_rsa_key;

	/** 签名类型 */
	var $signtype;
	
	/** 应答的参数 */
	var $parameters;
	
	/** debug信息 */
	var $debugInfo;
	
	//原始内容
	var $content;
	
	function __construct() {
		$this->ClientResponseHandler();
	}
	
	function ClientResponseHandler() {
		$this->public_rsa_key = "";
		$this->signtype = "";
		$this->parameters = array();
		$this->debugInfo = "";
		$this->content = "";
	}

	/*设置平台公钥*/
	function setRSAKey($key) {
		$this->public_rsa_key = $key;
	}

	/*设置签名类型*/
	function setSignType($type) {
		$this->signtype = $type;
	}
	
	//设置原始内容
	function setContent($content) {
		$this->content = $content;
		$this->parameters = $content;
	}
	
	//获取原始内容
	function getContent() {
		return $this->content;
	}
	
	/**
	*获取参数值
	*/	
	function getParameter($parameter) {
		return isset($this->parameters[$parameter])?$this->parameters[$parameter] : '';
	}
	
	/**
	*设置参数值
	*/	
	function setParameter($parameter, $parameterValue) {
		$this->parameters[$parameter] = $parameterValue;
	}
	
	/**
	*获取所有请求的参数
	*@return array
	*/
	function getAllParameters() {
		return $this->parameters;
	}	
	
	/**
	*验证RSA签名,规则是:按参数名称a-z排序,遇到空值的参数不参加签名。
	*true:是
	*false:否
	*/
	function verifyRSASign() {
		$signPars = "";
		ksort($this->parameters);
		foreach($this->parameters as $k => $v) {
			if("ly_sign" != $k && "" != $v) {
				$signPars .= $k . "=" . $v . "&";
			}
		}
		$signPars = substr($signPars, 0, strlen($signPars) - 1);

		$rsa_str = chunk_split($this->public_rsa_key, 64, "\n");
		$rsa_key = "-----BEGIN PUBLIC KEY-----\n$rsa_str-----END PUBLIC KEY-----\n";
		
		$res = openssl_get_publickey($rsa_key);
		if ($this->signtype == 'RSA') {
			$result = (bool)openssl_verify($signPars, base64_decode($this->getParameter("ly_sign")), $res);
			openssl_free_key($res);
			return $result;
		} else if($this->signtype == 'RSA2') {
			$result = (bool)openssl_verify($signPars, base64_decode($this->getParameter("ly_sign")), $res, OPENSSL_ALGO_SHA256);
			openssl_free_key($res);
			return $result;
		}
	}
	
	/**
	*获取debug信息
	*/	
	function getDebugInfo() {
		return $this->debugInfo;
	}
	
	/**
	*设置debug信息
	*/	
	function _setDebugInfo($debugInfo) {
		$this->debugInfo = $debugInfo;
	}
	
}


?>