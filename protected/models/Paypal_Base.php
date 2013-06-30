<?php

class Paypal_Base{
	private $pcurl = null;
	private $user;
	private $pwd;
	private $sign;
	private $version = '63.0';
	private $nvpHeader;
	private $nvpStr;
	private $subject;
	
	function __construct($api_user='',$api_pwd='',$api_sign=''){
		$this->user = $api_user;
		$this->pwd = $api_pwd;
		$this->sign = $api_sign;
		
		$this->pcurl = curl_init();
		
		curl_setopt($this->pcurl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($this->pcurl, CURLOPT_SSL_VERIFYHOST, FALSE);
		
		curl_setopt($this->pcurl, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($this->pcurl, CURLOPT_POST, 1);
	}


	public function getSubject(){
		return $this->subject;
	}
	
	private function getNvpHeader(){
		$this->nvpHeader = "&PWD=".urlencode($this->pwd);
		$this->nvpHeader .= "&USER=".urlencode($this->user);
		$this->nvpHeader .= "&SIGNATURE=".urlencode($this->sign);
		$this->nvpHeader .= "&VERSION=" . urlencode($this->version);
		
		return $this->nvpHeader;
	}
	
	private function getNvpStr($params){
		$this->nvpStr = $this->getNvpHeader();
		foreach($params as $key=>$value){
			if(is_string($value))
				$value = urlencode($value);
			$this->nvpStr .= "&{$key}=" . $value;
		}
		if(isset($this->subject)){
			$this->nvpStr .= "&SUBJECT=" . urlencode($this->subject);
		}

		return $this->nvpStr;
	}
	
	public $errno = 0;
	public $error = '';

	public function nvpRequest($methodName,$params){
		$nvpStr = $this->getNvpStr($params);
		$nvpreq="METHOD=".urlencode($methodName).$nvpStr;

		curl_setopt($this->pcurl, CURLOPT_URL,$this->getPayPalApiUrl());
		curl_setopt($this->pcurl,CURLOPT_POSTFIELDS,$nvpreq);

		$response = curl_exec($this->pcurl);
		
		if(curl_errno($this->pcurl)){
			$this->errno = curl_errno($this->pcurl);
			$this->error = curl_error($this->pcurl);
			return false;
		}
		
		return $this->formatNVP($response);
	}
	
	private function formatNVP($nvpstr){	
		$intial=0;
	 	$nvpArray = array();
	
		while(strlen($nvpstr)){
			$keypos= strpos($nvpstr,'=');
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);
	
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
		}
		return $nvpArray;
	}
	
	private function getPayPalApiUrl(){
		return 'https://api-3t.paypal.com/nvp';
	}
	
	public function getPaypalUrl(){
		return 'https://www.paypal.com/webscr&cmd=_express-checkout&token=';
	}
}