<?php
class Util{
	//过滤用户提交过来的值只能过滤到三维数组
	public static function reset_vars(){
		if(!empty($_REQUEST)){
			foreach((array)$_REQUEST as $key => $value){
				self::safe_var($key);
			}
		}
	}
	public static function safe_var($var,$var2=""){
		if(strlen(strval($var2))){
			if(is_array($_REQUEST[$var][$var2])){
				foreach($_REQUEST[$var][$var2] as $key => $value){
					$_REQUEST[$var][$var2][$key]=self::encode($value);
				}
			}else{
				$_REQUEST[$var][$var2]=self::encode($_REQUEST[$var][$var2]);  
			}
		}else{
			if(is_array($_REQUEST[$var])){
				foreach((array)$_REQUEST[$var] as $key => $value){
					self::safe_var($var,$key);
				}
			}else{
				$_REQUEST[$var]=self::encode($_REQUEST[$var]);
			}
		}
	}	

	public static function encode($val){
		$return_value=CHtml::encode($val);
		$return_value=addSlashes($return_value);
		$return_value=trim($return_value);
		return $return_value;
	}
/*******************************************
	取得当前時間
********************************************/
	public static function current_time($type) {
		switch ($type) {
		  case 'mysql':
				$d = date('Y-m-d H:i:s');
			  return $d;
			  break;
		 case 'timestamp':
				$d = time();
				return $d;
			  break;
		}
	}

	  
	  
    //获取线路时间的选择项
    public static function get_trave_start_date($start_date,$date_type){
        $explode_start_date=explode(",",$start_date);
        $return_date=array();
        if($date_type=='1'){
        	if(strlen($explode_start_date[0])){
            $return_date['s']=$explode_start_date[0];
        	}

       	 if(strlen($explode_start_date[1])){
            $return_date['m']=$explode_start_date[1];
        	}

        	if(strlen($explode_start_date[2])){
            $return_date['d']=$explode_start_date[2];
        	}
       	}else{
       		if(strlen($explode_start_date[0])){
            $return_date['s']=$explode_start_date[0];
        	}

       	 if(strlen($explode_start_date[1])){
            $return_date['open_date']=$explode_start_date[1];
        	}

        	if(strlen($explode_start_date[2])){
            $return_date['close_date']=$explode_start_date[2];
        	}
       		
       	}
        return $return_date;

    }
    //获取线路时间的显示字符串
    public static function get_trave_start_date_name($start_date,$date_type){
    	
        $explode_start_date=explode(",",$start_date);
        $return_date="";
        if($date_type=="1"){
        	if(strlen($explode_start_date[0])){
            $return_date.=$explode_start_date[0]."&nbsp;&nbsp;";
        	}

        	if(strlen($explode_start_date[1])){
            $regular_month=CV::$REGULAR_MONTH;
            $return_date.=$regular_month[$explode_start_date[1]];
        	}

        	if(strlen($explode_start_date[2])){
            $regular_day=CV::$REGULAR_DAY;
            $return_date.=$regular_day[$explode_start_date[2]];
       	 }
      }else{
      	 if(strlen($explode_start_date[0])){
            $return_date.=$explode_start_date[0]."&nbsp;&nbsp;";
        	}

        	if(strlen($explode_start_date[1])){
            
            $return_date.=$explode_start_date[1];
        	}

        	if(strlen($explode_start_date[2])){
            
            $return_date.="到".$explode_start_date[2];
       	 }
      	
      }
        return $return_date;
    }

    //建目录函数，其中参数$directoryName最后没有"/"，
    //要是有的话，以'/'打散为数组的时候，最后将会出现一个空值
    public static function makeDirectory($directoryName) {
        $directoryName = str_replace("\\","/",$directoryName);
        $dirNames = explode('/', $directoryName);
        $total = count($dirNames) ;
        $temp = '';
        for($i=0; $i < $total; $i++) {
            $temp .= $dirNames[$i].'/';
            if (!is_dir($temp)) {
                $oldmask = umask(0);
                if (!mkdir($temp, 0777)) exit("不能建立目录 $temp"); 
                umask($oldmask);
            }
        }
        return true;
    }
    
    
 public static function copyDir($dirFrom,$dirTo)  
 {  
     //如果遇到同名文件无法复制，则直接退出  
     if(is_file($dirTo)){  
         echo("无法建立目录 $dirTo");  
     }  
     if(!file_exists($dirTo)){  
         self::makeDirectory($dirTo);  
     }  
    $handle = opendir($dirFrom);    
    //readdir($handle); //去除./
    //readdir($handle);//去除../
    while (false !== ($file = readdir($handle))) {  
		if($file == '.' || $file== '..'){
			continue;
		}
        $fileFrom = $dirFrom."/".$file;  
        $fileTo = $dirTo."/".$file;  
        if(is_dir($fileFrom)){ 
            self::copyDir($fileFrom,$fileTo);  
        } else { 
            @copy($fileFrom,$fileTo);  
        }  
    }  
 }  
    //删除文件
    public static function delete_file($file_name,$file_path=""){
    	$file=$file_path.$file_name;
    	if(is_file($file)&&file_exists($file)){
    		unlink($file);
    	}
    }

    //组合搜索语句 	
    public static function com_search_condition($com_search_value=array()){
        $return_search_condition="";
        foreach((array)$com_search_value as $key => $value){
            if(strlen($value)){
                $search_value=$key;
                $return_search_condition.=str_replace("w%",$value,$search_value)."&nbsp;&nbsp;";
            }
        }
        return $return_search_condition;
    }


    //格式化货币
    public static function fc($c) {
        return Yii::app ()->numberFormatter->formatCurrency ( $c, "¥");
    }

    //hash内容
    public static function hc($content, $salt=null) {
        if(strlen($salt)){
            return md5 ( $salt . md5 ( $content ) );
        }else {
            return md5($content);
        }
    }

    /*-------------------------------------------
     # 产生随机字串，可用来自动生成密码
     # 默认长度6位 字母和数字混合
     # $format ALL NUMBER CHAR 字串组成格式
     */
    public static  function randStr($len = 6, $format = 'ALL') {
        switch ($format) {
        case 'ALL' :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
            break;
        case 'CHAR' :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~';
            break;
        case 'NUMBER' :
            $chars = '0123456789';
            break;
        default :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        }
        mt_srand ( ( double ) microtime () * 1000000 * getmypid () );
        $password = "";
        while ( strlen ( $password ) < $len )
            $password .= substr ( $chars, (mt_rand () % strlen ( $chars )), 1 );
        return $password;
    }
    //判断是否为Email
    public static function ie($user_email) {
        $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
        if (strpos ( $user_email, '@' ) !== false && strpos ( $user_email, '.' ) !== false) {
            if (preg_match ( $chars, $user_email )) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //验证号码时候是手机号码或者电话号码$phone_type:All:全部验证 cell:手机 tele:座机 tc:小灵通
    public static function is_phone($user_phone,$phone_type='All'){
    	/*
    	switch($phone_type){
    		case 'tele':
    		    //座机验证规则
    	     $telephone=preg_match("/^(((\d{3}))|(\d{3}-))?((0\d{2,3})|0\d{2,3}-)?[1-9]\d{6,8}$/",$user_phone);
    	     if($telephone)
    	        return true;
    	     else
    	        return false;
    		   break;
    		case 'cell':
    		   //手机号码验证规则
    	    $cell_phone =preg_match("/(?:13\d{1}|1[548][01356789])\d{8}$/",$user_phone);
    	    if($cell_phone)
    	      return true;
    	    else
    	      return false;
    		   break;
    		case 'tc':
    		   	//小灵通验证规则
          	$tcphone=preg_match("/^1[3,5]\d{9}$/",$user_phone);
          	if($tcphone)
          	  return true;
          	else
          	  return false;
    		   break;
    		default:
    		   //手机号码验证规则
    	    $telephone=preg_match("/^(((\d{3}))|(\d{3}-))?((0\d{2,3})|0\d{2,3}-)?[1-9]\d{6,8}$/",$user_phone);
        	//座机验证规则
        	$cell_phone=preg_match("/(?:13\d{1}|1[548][01356789])\d{8}$/",$user_phone);
        	//小灵通验证规则
         	$tcphone=preg_match("/^1[3,5]\d{9}$/",$user_phone);
         	if($cell_phone||$telephone||$tcphone){
         		return true;
         	}else{
         		return false;
         	}
    		   break;
    	}
    	*/
    	return true;
   }
   
   


   
 //验证邮编
 
 function validate_zip($user_zip){
 	/*
 	$zip=preg_match("/^[0-9]{6}$/",$user_zip);
 	return $zip;
 	*/
 	return true;
}
    
//验证省份证号码    
function validation_filter_id_card($id_card)
{
	  
		if(strlen($id_card) == 18)
		{
			return self::idcard_checksum18($id_card);
		}elseif((strlen($id_card) == 15)){
			$id_card = self::idcard_15to18($id_card);
			return self::idcard_checksum18($id_card);
		}else{
			return false;
		}

	}
	// 计算身份证校验码，根据国家标准GB 11643-1999
	function idcard_verify_number($idcard_base)
	{
		if(strlen($idcard_base) != 17)
		{
			return false;
		}
		//加权因子
		$factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
		//校验码对应值
		$verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
		$checksum = 0;
		for ($i = 0; $i < strlen($idcard_base); $i++)
		{
			$checksum += substr($idcard_base, $i, 1) * $factor[$i];
		}
		$mod = $checksum % 11;
		$verify_number = $verify_number_list[$mod];
		return $verify_number;
	}
	// 将15位身份证升级到18位
	function idcard_15to18($idcard){
		if (strlen($idcard) != 15){
			return false;
		}else{
			// 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
			if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false){
				$idcard = substr($idcard, 0, 6) . '18'. substr($idcard, 6, 9);
			}else{
				$idcard = substr($idcard, 0, 6) . '19'. substr($idcard, 6, 9);
			}
		}
		$idcard = $idcard . self::idcard_verify_number($idcard);
		return $idcard;
	}
	// 18位身份证校验码有效性检查
	function idcard_checksum18($idcard){
		if (strlen($idcard) != 18){ return false; }
			$idcard_base = substr($idcard, 0, 17);
		if (self::idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){
			return false;
		}else{
			return true;
		}
	} 



	//写数据库时，对数据进行引用
	public static  function q($value) {
		return Yii::app ()->db->quoteValue ( $value );
	}

	// 截取中文字符串
	//$sourcestr 是要处理的字符串
	//$cutlength 为截取的长度(即字数)
	public static function cs($sourcestr, $cutlength) {
		$strArr = explode(" ", $sourcestr);
		if(count($strArr)!=1){
			$re=1;
		}else{
			$re=0;
		}	
		$returnstr = '';
		$cutlength=$cutlength+2;
		$i = 0;
		$n = 0;
		$str_length = strlen ( $sourcestr ); //字符串的字节数
		while ( ($n < $cutlength) and ($i <= $str_length) ) {
			$temp_str = substr ( $sourcestr, $i, 1 );
			$ascnum = Ord ( $temp_str ); //得到字符串中第$i位字符的ascii码
			if ($ascnum >= 224) //如果ASCII位高与224，
			{
				$returnstr = $returnstr . substr ( $sourcestr, $i, 3 ); //根据UTF-8编码规范，将3个连续的字符计为单个字符
				$i = $i + 3; //实际Byte计为3
				$n ++; //字串长度计1
			} elseif ($ascnum >= 192) //如果ASCII位高与192，
			{
				$returnstr = $returnstr . substr ( $sourcestr, $i, 2 ); //根据UTF-8编码规范，将2个连续的字符计为单个字符
				$i = $i + 2; //实际Byte计为2
				$n ++; //字串长度计1
			} elseif ($ascnum >= 65 && $ascnum <= 90) //如果是大写字母，
			{
				$returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
				$i = $i + 1; //实际的Byte数仍计1个
				$n =$n+0.5; //但考虑整体美观，大写字母计成半个高位字符
			}elseif($re)//判断空格
			{
				$returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
				$i = $i + 1; //实际的Byte数仍计1个
				$n =$n+0.5; //但考虑整体美观，大写字母计成半个个高位字符
			}else //其他情况下，包括小写字母和半角标点符号，
			{
				$returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
				$i = $i + 1; //实际的Byte数计1个
				$n = $n + 0.5; //小写字母和半角标点等与半个高位字符宽...
			}
		}
		//与i相比较 字节数比较
		if ($str_length > $i) {
			$returnstr = $returnstr . "…"; //超过长度时在尾处加上省略号
		}
		return $returnstr;
	}

	function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
	{
		if($code == 'UTF-8')
		{
			$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
			preg_match_all($pa, $string, $t_string);

			if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."…";
			return join('', array_slice($t_string[0], $start, $sublen));
		}
		else
		{
			$start = $start*2;
			$sublen = $sublen*2;
			$strlen = strlen($string);
			$tmpstr = '';

			for($i=0; $i< $strlen; $i++)
			{
				if($i>=$start && $i< ($start+$sublen))
				{
					if(ord(substr($string, $i, 1))>129)
					{
						$tmpstr.= substr($string, $i, 2);
					}
					else
					{
						$tmpstr.= substr($string, $i, 1);
					}
				}
				if(ord(substr($string, $i, 1))>129) $i++;
			}
			if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
			return $tmpstr;
		}
	} 


	//PHP获取字符串中英文混合长度

	function strLength($sourcestr,$charset=''){
		$str_length = mb_strlen($sourcestr,'UTF8'); //字符串的字节数
		return $str_length;
	/*
	  if($charset=='utf-8') $str = iconv('utf-8','gb2312',$str);
	$num = strlen($str);
	$cnNum = 0;
	for($i=0;$i<$num;$i++){
		if(ord(substr($str,$i+1,1))>127){
			$cnNum++;
			$i++;
		}
	}

	$enNum = $num-($cnNum*2);
	$number = ($enNum)+$cnNum*2;
	return ceil($number);
	 */

	/*
	 $i = 0;
	if($charset=='utf-8'){
		  $sourcestr = iconv('utf-8','gb2312',$sourcestr);
	 }
	 $str_length = strlen ( $sourcestr ); //字符串的字节数
	 while ( $i <= $str_length ) {
			$temp_str = substr ( $sourcestr, $i, 1 );
			$ascnum = Ord ( $temp_str ); //得到字符串中第$i位字符的ascii码

			if ($ascnum >= 224) //如果ASCII位高与224，
			{
			   //根据UTF-8编码规范，将3个连续的字符计为单个字符
				$i = $i + 3; //实际Byte计为3

			} elseif ($ascnum >= 192) //如果ASCII位高与192，
			{
				 //根据UTF-8编码规范，将2个连续的字符计为单个字符
				$i = $i + 2; //实际Byte计为2

			} elseif ($ascnum >= 65 && $ascnum <= 90) //如果是大写字母，
			{
				$i = $i + 1; //实际的Byte数仍计1个

			} else //其他情况下，包括小写字母和半角标点符号，
			{ 
				$i = $i + 1; //实际的Byte数计1个
			}
		}

		return ceil($i);
	 */
	}
	/*----- session ------*/
	//setSession
	public static function ss($key,$value){
		Yii::app ()->session->add ( $key, $value );
	}

	//getSession
	public static function gs($key){
		return Yii::app ()->session [$key];
	}

	//unsetSesion
	public static function us($key){
		Yii::app ()->session->add ( $key, null );
	}


	//等比例剪切图片
	public static function cut_trave_image($width,$height,$image_path,$image_name){
		$image = Yii::app()->image->load($image_path.$image_name);
		$image->resize($width, $height);
		$image->save(self::rename_thumb_file($width,$height,$image_path,$image_name)); 
	}


	//剪切一定宽度和高度的图片
	public static function crop_trave_image($width,$height,$image_path,$image_name,$top = 'center', $left = 'center'){
		$image = Yii::app()->image->load($image_path.$image_name);
		$image->crop($width, $height, $top, $left);
		$image->save(self::rename_thumb_file($width,$height,$image_path,$image_name)); 
	}

	//重命名剪切的图片
	public static function rename_thumb_file($width,$height,$file_path,$file_name){
		$explode_array=explode(".",$file_name);
		$implode_array=array();
		$thumb_name=$file_path."_".$width."_".$height."_".$explode_array[0]."_thumb";
		array_push($implode_array,$thumb_name);
		array_push($implode_array,end($explode_array));
		return implode('.',$implode_array);
	}

	//获取客户端的IP
	 public static function getip(){
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
			$ip = getenv("HTTP_CLIENT_IP");
		else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
			$ip = getenv("REMOTE_ADDR");
		else if (strlen($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
			$ip = $_SERVER['REMOTE_ADDR'];
		else
			$ip = "unknown";
		return($ip);
	} 

	//放大第一个字母
	public static function enlarge_first($string){
		$string=substr_replace($string, "<span class='enlarge_font'>".$string[0]."</span>", 0, 1); 
		return $string;
	}


	//得到评论的图片
	public static function get_rating_img($comment_total){
		switch($comment_total){
		case '1':
			return '<span class="item-rank-rst irr-star10"></span>';
			break;
		case '2':
			return '<span class="item-rank-rst irr-star20"></span>';
			break;
		case '3':
			return '<span class="item-rank-rst irr-star30"></span>';
			break;
		case '4':
			return '<span class="item-rank-rst irr-star40"></span>';
			break;
		case '5':
			return '<span class="item-rank-rst irr-star50"></span>';
			break;
		default:
			return '<span class="item-rank-rst irr-star"></span>';
			break;
		}
	}
	public static function ajax_msg($code,$msg,$params=array()){
		$result = array();
		$result['code'] = $code;
		$result["msg"] = $msg;
		if(empty($params)){
			$result['params'] = $params;
		}
		return json_encode($result);
	}
	/**
	 *填写内容的时候登录返回页面的内容
	 */
	public static function record_return_content($content){
		if(strlen($content)){
			$key = md5(time().self::randStr(10).$content);
			self::ss($key,$content);
			return $key;
		}
	}
	public static function get_return_content($key){
		return self::gs($key);
	}
	public static function replace_search_keyword($conent,$keyword){
		$keyword = trim($keyword);
		//    if(strlen($keyword)){
		$replace = "<span style='color:#FF6600'>".$keyword."</span>";
		return str_ireplace($keyword,$replace,$conent);
		//    }
		//   return $content;
	}


	//获得出发的地点
	public static function get_sregion(){
		$sregion_session=Yii::app()->session->get('sregion_datas');
		if(empty($sregion_session['id'])){
			$remote_ip=self::getip();
			$ip_convert=new IpConvert();
			$ip_content=$ip_convert->get_sregion_id($remote_ip);
			$return_array=Cfenzhan::model()->get_sfenzhan_select();
      $tem_trave_sregion=array_keys($return_array);
			if(!in_array($ip_content->id,$tem_trave_sregion)){
				$ip_content=array('id'=>'59','district_name'=>'上海市','district_en_name'=>'shs');
			}
			$sregion_datas=array('id'=>$ip_content['id'],'name'=>$ip_content['district_name'],'en_name'=>$ip_content['district_en_name']);
			Yii::app()->session->add('sregion_datas',$sregion_datas);
		}
	}

	//获得首页的广告位置
	public static function get_ad($ad_area_id,$ad_type="",$sregion_id=""){
		if(empty($ad_area_id))
			return;
		if(empty($sregion_id)){
			$sregion_session=Yii::app()->session->get('sregion_datas');
			$sregion_id=$sregion_session['id'];
		}
		$conditions=array();
		$params=array();
		array_push($conditions,"ad_area_id=:ad_area_id");
		$params[':ad_area_id']=$ad_area_id;
		if(!empty($ad_type)){
			array_push($conditions,"ad_type=:ad_type");
			$params[':ad_type']=$ad_type;
		}
		array_push($conditions,"ad_sregion_id=:sregion_id");
		$params[':sregion_id']=$sregion_id;
		$ad=new Ad();
		$ad_datas=$ad->find(implode(" AND ",$conditions),$params);
		return $ad_datas->ad_content;
	}

	public static function check_ip(){
		$check_ip = self::getip();
		$ip_model = IpFilter::model();
		$ip_data = $ip_model->findByAttributes(array('ip_address'=>$check_ip));
		if($ip_data->status == 1){
			return false;
		}else{
			return true;
		}
	}
	//重命名文件名
	public static function  rename_file($file_name){
		if(empty($file_name))
			return;
		$explode_array=explode(".",$file_name);
		$implode_array=array();
		array_push($implode_array,time());
		array_push($implode_array,end($explode_array));
		return implode('.',$implode_array);
	}
	/*
	 * 上传一个图片
	 * @param string $file_name 图片名称
	 * @param string $file_dir 上传图片的路径
	 * @param array $thumb 切割图片的尺寸"400*300,200*200"
	 * @return array 上传后的图片的路径
	 * @auther lxf
	 * @version 1.0.0
	 */
	public static function UploadFile($file_name,$file_dir,$thumb=""){
		  if(!empty($_FILES[$file_name]['name'])){
		   $upload_file=CUploadedFile::getInstancesByName($file_name);
		   $upload_file=$upload_file[0];
			 if(!is_dir($file_dir)){
			 	  self::makeDirectory($file_dir);
			 }
			 $image_name=self::rename_file($upload_file->name);
			 $upload_dir=$file_dir."/".$image_name;
			 if($upload_file!=null){
			   $result=$upload_file->saveAs($upload_dir);
			 }
			if($result){
				if(!empty($thumb)){
					$thumb_explode=explode(",",$thumb);
					foreach($thumb_explode as $key => $value){
						$size_thumb=explode("*",$value);
						$width=$size_thumb[0];
						$height=$size_thumb[1];
						self::cut_image($width,$height,$file_dir,$image_name);
					}
				}
			  return $upload_dir; 	
			}else{
				return null;
			}
		}else{
			return null;
		}				
						
	}
}
?>
