<?php
require_once('config.inc.php');
require_once('uc_client/client.php');
class UcenterClass{
  public function register_ucenter_user($user_login,$user_password){
  	 
  	  list($uid, $username, $password, $email) = uc_user_login($user_login, $user_password);
  	  
  	  if($uid>0){
	     $user_registe=new User("registe");
	     $user_datas=$user_registe->find(array('select'=>'id,salt,credit','condition'=>'user_login=:user_login','params'=>array(':user_login'=>$user_login)));
	     $dz_credit=uc_user_getcredit(1,$uid,1);
	     
	     if(!empty($user_datas)){
	     	  $user_id=$user_datas->id;
	     	  $update_datas['email']=$email;
	     	  $update_datas['password']=Util::hc($user_password,$user_datas->salt);
	     	  if($dz_credit!=$user_datas['credit']){
	     	  	$update_datas['credit']=$dz_credit;
	     	  }
	     	  $user_registe->update_table_datas($user_id,$update_datas);
	     }else{
	     	 $user_registe->user_login=$username;
	     	 $user_registe->password=$user_password;
	     	 $user_registe->con_password=$user_password;
	     	 $user_registe->email=$email;
	     	 $user_registe->agreement='1';
	     	 $user_registe->user_active='2';
			   $user_registe->status='1';
			   $user_registe->level='1';
			   $user_registe->credit=$dz_credit;
	     	 if($user_registe->validate()){
			      $user_registe->registe();
			      $credit=new Credit();
			      $credit_desc="会员:".$user_registe->user_login.",在线注册赠送积分";
            $credit->set_credit_vars($user_registe->id,"register",'1',$credit_desc); 
            $coupon_consume=new CouponConsume();
            $system=new System();
			      $coupon_value=$system->get_system_value("register_coupon");
            $conpon_desc="会员:".$user_registe->user_login.",在线注册赠送抵用劵";
            $result=$coupon_consume->insert_coupon_consume_datas($user_registe->id,'1',$coupon_value,$conpon_desc);
			      $send_mail=new SendMail("Registe Email");
			      $registe_active=Yii::app()->getController()->createAbsoluteUrl("register/useractive",array('user_id'=>$user_registe->id,'active_code'=>Util::hc($user_registe->email,$user_registe->salt)));
			      $registe_active=CHtml::link($registe_active,$registe_active);
			      $send_mail->send_register_mail("",$user_registe->email,$user_registe->user_login,$registe_active);
			   }
	     }
	      return $uid;
	   }else{
	   	  return true;
	   }
	    

  }  
}
?>
