<?php
class RegisteAction extends BaseAction{
  
    protected function beforeAction(){
       $this->controller->init_page();
       $this->controller->pt($this->id,array());
       return true;
    }
  protected function do_action(){	
  	require_once('config.inc.php');
  	require_once('uc_client/client.php');
  	$model=new User("registe");
  	if(isset($_POST['User'])){
  		    $model->attributes=$_POST['User'];
			    $model->user_active='1';
			    $model->status='1';
			    $model->level='1';
			    if($model->validate()){
			      //ucenter注册
			        $uid = uc_user_register($_POST['User']['user_login'], $_POST['User']['password'], $_POST['User']['email']);
		          if($uid <= 0) {
			          if($uid == -1) {
			          	   $model->addError('user_login','用户名不合法');
			          } elseif($uid == -2) {
			          	   $model->addError('user_login','包含要允许注册的词语');
			          } elseif($uid == -3) {
			          	   $model->addError('user_login','用户名已经存在');
			          } elseif($uid == -4) {
			          	    $model->addError('email','Email格式有误');
			          } elseif($uid == -5) {
			          	   $model->addError('email','Email不允许注册');
			          } elseif($uid == -6) {
			          	    $model->addError('email','该 Email已经被注册');
			          } 
		         }
		      $get_errors=$model->getErrors();
          if(empty($get_errors)){
			        $model->registe();
			        $credit=new Credit();
			        $credit_desc="会员:".$model->user_login.",在线注册赠送积分";
              $credit->set_credit_vars($model->id,"register",'1',$credit_desc);
              $coupon_consume=new CouponConsume();
              $system=new System();
			        $coupon_value=$system->get_system_value("register_coupon");
              $conpon_desc="会员:".$model->user_login.",在线注册赠送抵用劵";
              $result=$coupon_consume->insert_coupon_consume_datas($model->id,'1',$coupon_value,$conpon_desc);
			        $send_mail=new SendMail("Registe Email");
			        $registe_active=$this->controller->createAbsoluteUrl("register/useractive",array('user_id'=>$model->id,'active_code'=>Util::hc($model->email,$model->salt)));
			        $registe_active=CHtml::link($registe_active,$registe_active);
			        $send_mail->send_register_mail("",$model->email,$model->user_login,$registe_active);
			        $this->display('register_accomplish',array('model'=>$model));
			    }else{
			    	$this->display('index',array('model'=>$model));
			    }
			  }else{
			  	$this->display('index',array('model'=>$model));
			  }
  	}else{
  		$this->display('index',array('model'=>$model));
  	}
  
			
		
  }
}
?>
