<?php
/**
* kaitlyn
*/
class httpRequest
{
	private $url;

	private $type;

	private $appkey;

	private $v;

	private $page;

	
	function __construct($url,$type,$appkey,$v,$page)
	{
		$this->url=$url;
		$this->type=$type;
		$this->appkey=$appkey;
		$this->v=$v;
		$this->page=$page;
	}

	public function paramString(){
		return $this->url."&type=".$this->type."&appkey=".$this->appkey."&v=".$this->v."&page=".$this->page;
	}

	public function curl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// if ($this->readTimeout) {
		// 	curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
		// }
		// if ($this->connectTimeout) {
		// 	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
		// }
		curl_setopt ( $ch, CURLOPT_USERAGENT, "top-sdk-php" );
		//https 请求
		if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}

		// if (is_array($postFields) && 0 < count($postFields))
		// {
		// 	$postBodyString = "";
		// 	$postMultipart = false;
		// 	foreach ($postFields as $k => $v)
		// 	{
		// 		if(!is_string($v))
		// 			continue ;

		// 		if("@" != substr($v, 0, 1))//判断是不是文件上传
		// 		{
		// 			$postBodyString .= "$k=" . urlencode($v) . "&"; 
		// 		}
		// 		else//文件上传用multipart/form-data，否则用www-form-urlencoded
		// 		{
		// 			$postMultipart = true;
		// 			if(class_exists('\CURLFile')){
		// 				$postFields[$k] = new \CURLFile(substr($v, 1));
		// 			}
		// 		}
		// 	}
		// 	unset($k, $v);
		// 	curl_setopt($ch, CURLOPT_POST, true);
		// 	if ($postMultipart)
		// 	{
		// 		if (class_exists('\CURLFile')) {
		// 		    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
		// 		} else {
		// 		    if (defined('CURLOPT_SAFE_UPLOAD')) {
		// 		        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
		// 		    }
		// 		}
		// 		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// 	}
		// 	else
		// 	{
		// 		$header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
		// 		curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
		// 		curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
		// 	}
		// }
		$reponse = curl_exec($ch);
		
		if (curl_errno($ch))
		{
			throw new Exception(curl_error($ch),0);
		}
		else
		{
			$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if (200 !== $httpStatusCode)
			{
				throw new Exception($reponse,$httpStatusCode);
			}
		}
		curl_close($ch);
		return $reponse;
	}
}