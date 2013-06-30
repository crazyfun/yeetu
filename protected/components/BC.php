<?php
class BC{
    private static $datas = array(
        'qa'=>array(
            '_default'=>array('问答中心'=>array('qa/index')),
            'index'=>array(),
            'ask'=>array('我要提问'=>array('qa/ask')),
            'view'=>array(),
            'category'=>array(),
            'self'=>array(),
            'search'=>array(),
        ),
        
        'site'=>array(
          '_default'=>array(),
          'index'=>array(),
        ),
        'travel'=>array(
          '_default'=>array(),
          'peripheral'=>array(),
          'domestic'=>array(),
          'nation'=>array(),
          'group'=>array(),
          'free'=>array(),
          'detail'=>array(),
          'bargain'=>array(),
          'travelmore'=>array(),
        ),
        'search'=>array(
          '_default'=>array(),
          'index'=>array(),
        
        ),
        
        'user'=>array(
          '_default'=>array(),
          'index'=>array(),
          'order'=>array(),
          'orderview'=>array(),
          'coupon'=>array(),
          'addcoupon'=>array(),
          'credit'=>array(),
          'reviews'=>array(),
          'head'=>array(),
          'editemail'=>array(),
          'editin'=>array(),
          'password'=>array(),
          'repeatactive'=>array(),
          'distribution'=>array(),
          'editdis'=>array(),
          'visitors'=>array(),
          'editvis'=>array(),
          'email'=>array(),
     		  'history' => array(),
        	'profile' => array(),
        ),
        
        'traveinfor'=>array(
           '_default'=>array(),
           'index'=>array(),
           'details'=>array(),
        ),

    );

    public static function _($cid,$aid,$datas=array()){
        $c = self::$datas[$cid];
        if(!empty($c)){
            $default = $c['_default'];
            $a = $c[$aid];
            if(isset($a)){
                if(!is_array($datas)){
                    $datas = array($datas=>'');
                }else if(!empty($datas)){
                    $last_key = end(array_keys($datas));
                    if($last_key === 0){
                        $last_key = $datas[0];
                        array_pop($datas);
                        $datas[$last_key] = "";
                    }
                }
                $_arr = array_merge($default,$a,$datas);
                $last_key = end(array_keys($_arr));
                $_arr[$last_key] = "";
                return $_arr;
            }
        }
        return array();
    }
}
