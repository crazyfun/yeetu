<?php
/**
 * 类
 */
class Alipay
{

   protected $gateway="";
    /**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function Alipay()
    {
    	$this->gateway="https://www.alipay.com/cooperate/gateway.do?";
    	$this->transport="https";
    }

    function __construct()
    {
        $this->alipay();
    }

    /**
     * 生成支付代码
     * @param   array   $order      订单信息
     * @param   array   $payment    支付方式信息
     */
    function get_code($order, $payment)
    {
        

        $real_method = $payment['alipay_pay_method'];

        switch ($real_method){
            case '0':
                $service = 'trade_create_by_buyer';
                break;
            case '1':
                $service = 'create_partner_trade_by_buyer';
                break;
            case '2':
                $service = 'create_direct_pay_by_user';
                break;
        }

        $agent = 'C4335319945672464113';

        $parameter = array(
            'agent'             => $agent,
            'service'           => $service,
            'partner'           => $payment['alipay_partner'],
            //'partner'           => ALIPAY_ID,
            '_input_charset'    => $payment['_input_charset'],
            'notify_url'        => $payment['notify_url'],    //return_url(basename(__FILE__, '.php')),
            'return_url'        => $payment['return_url'],   //return_url(basename(__FILE__, '.php')),
            /* 业务参数 */
            'subject'           => $order['subject'],
            'body'              => $order['body'],
            'out_trade_no'      => $order['out_trade_no'],
            'price'             => $order['price'],
            'quantity'          => 1,
            'payment_type'      => 1,
            /* 物流参数 */
            'logistics_type'    => 'EXPRESS',
            'logistics_fee'     => 0,
            'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
            /* 买卖双方信息 */
            'seller_email'      => $payment['seller_email']
        );
        ksort($parameter);
        reset($parameter);

        $param = '';
        $sign  = '';

        foreach ($parameter AS $key => $val)
        {
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }

        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment['alipay_key'];
        //$sign  = substr($sign, 0, -1). ALIPAY_AUTH;

        $button = '<div style="text-align:center"><input type="button" onclick="window.open(\''.$this->gateway.$param. '&sign='.md5($sign).'&sign_type=MD5\')" value="提交" /></div>';
        return $button;
    }

    /********************************************************************************/

    /**对notify_url的认证
	*返回的验证结果：true/false
     */
    function notify_verify($partner,$alipay_key) {
    	 $notify_id = urldecode($_REQUEST["notify_id"]);
        //获取远程服务器ATN结果，验证是否是支付宝服务器发来的请求
        if($this->transport == "https") {
            $veryfy_url = $this->gateway. "service=notify_verify" ."&partner=" .$partner. "&notify_id=".$notify_id;
        } else {
            $veryfy_url = $this->gateway. "partner=".$partner."&notify_id=".$notify_id;
        }
       
        
        $veryfy_result = $this->get_verify($veryfy_url);
        
        //生成签名结果
		if(empty($_REQUEST)) {	
			return false;
		}
		else{
			
				$post          = $this->para_filter($_POST);	    //对所有POST返回的参数去空
			  $sort_post     = $this->arg_sort($post);	    //对所有POST反馈回来的数据排序
			  $mysign  = $this->build_mysign($sort_post,$alipay_key,"MD5");   //生成签名结果
			if (preg_match("/true$/i",$veryfy_result) && $mysign == $_REQUEST["sign"]) {
				return true;
			} else {
				return false;
			}
		}
    }
    
  function arg_sort($array) {
	    ksort($array);
	    reset($array);
	    return $array;
	}
    
   function para_filter($parameter) {
	    $para = array();
	    while (list ($key, $val) = each ($parameter)) {
	        if($key == "sign" || $key == "sign_type" || $val == "")continue;
	        else	$para[$key] = $parameter[$key];
	    }
	    return $para;
	}
	
	

		function build_mysign($sort_array,$key,$sign_type = "MD5") {
	    $prestr = $this->create_linkstring($sort_array);     	//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
	    $prestr = $prestr.$key;							//把拼接后的字符串再与安全校验码直接连接起来
	    $mysgin = $this->sign($prestr,$sign_type);			    //把最终的字符串签名，获得签名结果
	    return $mysgin;
	}
	
		function create_linkstring($array) {
	    $arg  = "";
	    while (list ($key, $val) = each ($array)) {
	        $arg.=$key."=".$val."&";
	    }
	    $arg = substr($arg,0,count($arg)-2);		     //去掉最后一个&字符
	    return $arg;
	}
	
	
		function sign($prestr,$sign_type) {
	    $sign='';
	    if($sign_type == 'MD5') {
	        $sign = md5($prestr);
	    }elseif($sign_type =='DSA') {
	        //DSA 签名方法待后续开发
	        die("DSA 签名方法待后续开发，请先使用MD5签名方式");
	    }else {
	        die("支付宝暂不支持".$sign_type."类型的签名方式");
	    }
	    return $sign;
	}

    /**对return_url的认证
	*return 验证结果：true/false
     */
    function return_verify($partner) {
        //获取远程服务器ATN结果，验证是否是支付宝服务器发来的请求
        if($this->transport == "https") {
            $veryfy_url = $this->gateway. "service=notify_verify" ."&partner=" .$partner. "&notify_id=".$_GET["notify_id"];
        } else {
            $veryfy_url = $this->gateway. "partner=".$partner."&notify_id=".$_GET["notify_id"];
        }
        $veryfy_result = $this->get_verify($veryfy_url);
        
        //生成签名结果
		if(empty($_GET)) {							//判断GET来的数组是否为空
			return false;
		}
		else {
			
			if (preg_match("/true$/i",$veryfy_result) ) {            
				return true;
			}else {
				return false;
			}
		}
    }

    /********************************************************************************/

    /**获取远程服务器ATN结果
	*$url 指定URL路径地址
	*return 服务器ATN结果集
     */
    function get_verify($url,$time_out = "60") {
        $urlarr     = parse_url($url);
        $errno      = "";
        $errstr     = "";
        $transports = "";
        if($urlarr["scheme"] == "https") {
            $transports = "ssl://";
            $urlarr["port"] = "443";
        } else {
            $transports = "tcp://";
            $urlarr["port"] = "80";
        }
        $fp=@fsockopen($transports . $urlarr['host'],$urlarr['port'],$errno,$errstr,$time_out);
        if(!$fp) {
            die("ERROR: $errno - $errstr<br />\n");
        } else {
            fputs($fp, "POST ".$urlarr["path"]." HTTP/1.1\r\n");
            fputs($fp, "Host: ".$urlarr["host"]."\r\n");
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: ".strlen($urlarr["query"])."\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $urlarr["query"] . "\r\n\r\n");
            while(!feof($fp)) {
                $info[]=@fgets($fp, 1024);
            }
            fclose($fp);
            $info = implode(",",$info);
            return $info;
        }
    }
    
}

?>