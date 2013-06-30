<?php
class PT{
    private static $datas = array(
		   'site'=>array(
		     '_default'=>'易途旅游网_旅游线路_自助游_跟团游_公司旅游',
			   'login'=>'会员登录-易途旅游网',
			   'forgotpassword'=>'忘记密码-易途旅游网',
			   'sendemail'=>'忘记密码-易途旅游网',
		  ),
		  'registe'=>array(
		     '_default'=>'会员注册-易途旅游网',
		  ),
       'qa'=>array(
           '_default'=>'问答中心-易途旅游网',
           'ask'=>'我要提问-易途旅游网',
        ),
        'user' => array(
        	'_default' => '会员中心-易途旅游网',
        	'order' => '我的订单_会员中心-易途旅游网',
        	'coupon' => '抵用劵_会员中心-易途旅游网',
        	'addcoupon'=>'增加抵用劵_会员中心-易途旅游网',
        	'credit'=>'用户积分_会员中心-易途旅游网',
        	'head'=>'修改头像_会员中心-易途旅游网',
        	'profile'=>'个人资料_会员中心-易途旅游网',
        	'editin'=>'修改个人资料_会员中心-易途旅游网',
        	'editemail'=>'修改邮箱_会员中心-易途旅游网',
        	'useractive'=>'修改邮箱_会员中心-易途旅游网',
        	'password'=>'修改密码_会员中心-易途旅游网',
        	'reviews'=>'我的点评_会员中心-易途旅游网',
        	'history'=>'浏览历史记录_会员中心-易途旅游网',
        	'distribution'=>'配送地址管理_会员中心-易途旅游网',
        	'editdis'=>'添加/修改配送地址_会员中心-易途旅游网',
        	'visitors'=>"游客信息管理_会员中心-易途旅游网",
        	'editvis'=>'添加/修改游客信息_会员中心-易途旅游网',
        ),
       'help' => array(
        	'_default' => '帮助中心',
        ),
		   'search' => array(
		      '_default'=>'旅游线路搜索-易途旅游网',
        ),
        'traveinfor'=>array(
           '_default'=>'旅游资讯-易途旅游网',
           'index'=>'旅游资讯-易途旅游网',
        ),
    );

    public static function _($cid,$aid=null,$datas=array()){
   
        //$pt = Yii::app()->name;
        $arr = self::$datas[$cid];
       
        if(!empty($arr)){
            $at = $arr[$aid];
            if(!empty($at)){
            	$pt = empty($pt) ? $at : $pt."_".$at;
            }else{
            	if(empty($datas)){
            	 $default = $arr['_default'];
               if(!empty($default)){
                 $pt .= $default;
                }
               }
            }
        }

        $other = implode("_",$datas);
        if(!empty($other)){
            $pt = empty($pt) ? $other : $pt."_".$other;
        }

        $pt .=  Yii::app()->name;

        return $pt;
    }
}
