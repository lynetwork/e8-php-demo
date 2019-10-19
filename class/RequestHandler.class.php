<?php
/**
 * 请求类
 * ============================================================================
 * api说明：
 * init(),初始化函数，默认给一些参数赋值，如cmdno,date等。
 * getGateURL()/setGateURL(),获取/设置入口地址,不包含参数值
 * getParameter()/setParameter()/unsetParameter(),获取/设置参数值/删除参数值
 * getAllParameters(),获取所有参数
 * getRequestURL(),获取带参数的请求URL
 * getDebugInfo(),获取debug信息
 * createRSASign(),创建RSA2签名字符串
 * 
 * ============================================================================
 *
 */
class RequestHandler {
	
	/** 网关url地址 */
	var $gateUrl;

	/* RSA私钥*/
	var $private_rsa_key;
	
	/** 请求的参数 */
	var $parameters;

	/** debug信息 */
	var $debugInfo;
	
	function __construct() {
		$this->RequestHandler();
	}
	
	function RequestHandler() {
		$this->gateUrl = "";
		$this->private_rsa_key = "";
		$this->parameters = array();
		$this->debugInfo = "";
	}
	
	/**
	*获取入口地址,不包含参数值
	*/
	function getGateURL() {
		return $this->gateUrl;
	}
	
	/**
	*设置入口地址,不包含参数值
	*/
	function setGateURL($gateUrl) {
		$this->gateUrl = $gateUrl;
	}

	/*设置RSA私钥*/
	function setRSAKey($key) {
		$this->private_rsa_key = $key;
	}

	/**
	*获取参数值
	*/
	function getParameter($parameter) {
		return isset($this->parameters[$parameter])?$this->parameters[$parameter]:'';
	}
	
	/**
	*设置参数值
	*/
	function setParameter($parameter, $parameterValue) {
		$this->parameters[$parameter] = $parameterValue;
	}
	/**
	 * 删除参数值
	 */
	function unsetParameter($parameter) {
		unset($this->parameters[$parameter]);
	}
    /**
     * 一次性设置参数
     */
    function setReqParams($post,$filterField=null){
        if($filterField !== null){
            forEach($filterField as $k=>$v){
                unset($post[$v]);
            }
        }
        
        //判断是否存在空值，空值不提交
        forEach($post as $k=>$v){
			if(empty($v)){
                unset($post[$k]);
            }
        }

        $this->parameters = $post;
    }
	
	/**
	*获取所有请求的参数
	*@return array
	*/
	function getAllParameters() {
		return $this->parameters;
	}
	
	/**
	*获取带参数的请求URL
	*/
	function getRequestURL() {
	
		$this->createRSASign();
		
		$reqPar = "";
		ksort($this->parameters);
		foreach($this->parameters as $k => $v) {
			$reqPar .= $k . "=" . urlencode($v) . "&";
		}
		
		//去掉最后一个&
		$reqPar = substr($reqPar, 0, strlen($reqPar)-1);
		
		$requestURL = $this->getGateURL() . "?" . $reqPar;
		
		return $requestURL;
		
	}
		
	/**
	*获取debug信息
	*/
	function getDebugInfo() {
		return $this->debugInfo;
	}
	
	/**
	*创建RSA2签名,规则是:按参数名称a-z排序,遇到空值的参数不参加签名。
	*/
	function createRSASign() {
		$signPars = "";
		ksort($this->parameters);
		foreach($this->parameters as $k => $v) {
			if("" != $v && "ly_sign" != $k) {
				$signPars .= $k . "=" . $v . "&";
			}
		}
		$signPars = substr($signPars, 0, strlen($signPars) - 1);//去掉最后一个&符
		$rsa_str = chunk_split($this->private_rsa_key, 64, "\n");
		$rsa_key = "-----BEGIN RSA PRIVATE KEY-----\n$rsa_str-----END RSA PRIVATE KEY-----\n";//将密钥转换为官方格式
		
		$res = openssl_get_privatekey($rsa_key);
		if ($this->getParameter('ly_sign_type') == 'RSA') {
			openssl_sign($signPars, $sign, $res);
		} else if ($this->getParameter('ly_sign_type') == 'RSA2') {
			openssl_sign($signPars, $sign, $res, OPENSSL_ALGO_SHA256);
		}
		openssl_free_key($res);
		$sign = base64_encode($sign);
		$this->setParameter("ly_sign", $sign);
		//创建签名并添加到参数列表ly_sign

		//debug信息
		//$this->_setDebugInfo($signPars . " => ly_sign:" . $sign);
	}
	
	/**
	*设置debug信息
	*/
	function _setDebugInfo($debugInfo) {
		$this->debugInfo = $debugInfo;
	}

}

?>