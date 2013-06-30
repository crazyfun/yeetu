<?php

class Paypal extends Paypal_Base {
	public function __construct($api_user='',$api_pwd='',$api_sign=''){
		parent::__construct($api_user,$api_pwd,$api_sign);
	}
	
	public function SetExpressCheckout($shopList,$returnUrl,$cancelUrl,$currencyCode,$custom,$others=array(), $recurringPaymentDesc=null ){
		$params['ReturnUrl'] = $returnUrl;
		$params['CANCELURL'] = $cancelUrl;
		$params['CURRENCYCODE'] = $currencyCode;
		$params['CUSTOM'] = $custom;
		$params = array_merge($params,$others);
		
		$params['AMT'] = 0;
		for($i=0;$i<count($shopList);$i++){
			$params['L_NAME'.$i] = $shopList[$i]['name'];
			$params['L_AMT'.$i]  = $shopList[$i]['amt'];
			$params['L_QTY'.$i]  = $shopList[$i]['qty'];
			$params['L_NUMBER'.$i] = $shopList[$i]['remark'];
			$params['AMT'] += $shopList[$i]['amt']*$shopList[$i]['qty'];
		}

		$params['ITEMAMT'] = $params['AMT'];
		
		return $this->nvpRequest('SetExpressCheckout',$params);
	}
	
	
	public function DoExpressCheckoutPayment($token,$paymentAmount,$currCodeType,$payerID,$shopArray = array(),$paymentType='Sale'){
		$params['TOKEN'] = $token;
		$params['PAYERID'] = $payerID;
		$params['PAYMENTACTION'] = $paymentType;
		$params['AMT'] = $paymentAmount;
		$params['CURRENCYCODE'] = $currCodeType;

		$params = array_merge($params, $shopArray);
		
		return $this->nvpRequest('DoExpressCheckoutPayment',$params);		
	}
	
	
	public function GetExpressCheckoutDetails($token){
		$params['TOKEN'] = $token;
		return $this->nvpRequest('GetExpressCheckoutDetails',$params);
	}
}