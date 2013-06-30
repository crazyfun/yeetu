<?php
class LoginAction extends BaseAction{
    protected function beforeAction(){
        $this->controller->init_login_page();
		$this->controller->pt($this->id,array());

        return true;
    }
    protected function do_action(){
    	 
    	  require_once('config.inc.php');
    	  require_once('uc_client/client.php');
    	  $ucenter_class=new UcenterClass();
        $ts = time();
        $login_type=$_POST['login_type'];
        $model=new User('HomeLogin');
        if($login_type=="homelogin"){
					$model->user_login=$_POST['user_login'];
					$model->password=$_POST['password'];
					$uc_result=$ucenter_class->register_ucenter_user($_POST['user_login'],$_POST['password']);
					if($uc_result<=0){
						if($uc_result == -1) {
							 $model->addError('user_login','用户名不存在');
            } elseif($uc_result == -2) {
          
	             $model->addError('password','密码不正确');
            } else {
	              $model->addError('user_login','登录错误');
            }
					}
					$get_errors=$model->getErrors();
					if(empty($get_errors)&&$model->validate() && $model->login()){
						$user_id=Yii::app()->user->id;
						$login_time=$model->old_login_time;
				    $date=new Date();
				    $diff_date=$date->dateDiff(intval($login_time));
				    //一天跟新一次
				    if(abs($diff_date)>=1){
				    	$credit=new Credit();
						  $user_login=Yii::app()->user->getName();
			        $credit_desc="会员:".$user_login.",在线登录赠送积分";
              $credit->set_credit_vars($user_id,"login_per_time",'1',$credit_desc);
				    }
				       //登录时判断是否在ucenter中注册过
				       $uc_user_data = uc_get_user($_POST['user_login']);
				        if(!$uc_user_data){
				          $uc_registe_datas=$model->find(array('select'=>'email','condition'=>'id=:user_id','params'=>array(':user_id'=>$user_id)));
				        	$register_uid = uc_user_register($_POST['user_login'],$_POST['password'],$uc_registe_datas->email);
				        }
				      //ucenter同步登录
					      list($uid, $username, $password, $email) = uc_user_login($_POST['user_login'],$_POST['password']);
					      if($uid > 0) {
				          $ucsynlogin = uc_user_synlogin($uid); 
				        }
				      $this->display('loginsuccess',array('redirect_url'=>Yii::app()->homeUrl,'ucsynlogin'=>$ucsynlogin));
				      exit;
			  		
					}
         $this->display('login',array('model'=>$model,'ts'=>$ts));
				}else if($login_type=="asklogin"){
					$model=new User('login');
				   if(isset($_POST['User'])){
            $model->attributes=$_POST['User'];
            $uc_result=$ucenter_class->register_ucenter_user($_POST['User']['user_login'],$_POST['User']['password']);
            if($uc_result<=0){
						if($uc_result == -1) {
							 $model->addError('user_login','用户名不存在');
            } elseif($uc_result == -2) {
          
	             $model->addError('password','密码不正确');
            } else {
	              $model->addError('user_login','登录错误');
            }
					}
					$get_errors=$model->getErrors();
            if(empty($get_errors)&&$model->validate("login") && $model->login()){
            	$user_id=Yii::app()->user->id;
						  $login_time=$model->old_login_time;
				      $date=new Date();
				      $diff_date=$date->dateDiff(intval($login_time));
				    //一天跟新一次
				      if(abs($diff_date)>=1){
				    	  $credit=new Credit();
						    $user_login=Yii::app()->user->getName();
			          $credit_desc="会员:".$user_login.",在线登录赠送积分";
                $credit->set_credit_vars($user_id,"login_per_time",'1',$credit_desc);
				       }
				        //登录时判断是否在ucenter中注册过
				       $uc_user_data = uc_get_user($_POST['User']['user_login']);
				        if(!$uc_user_data){
				          $uc_registe_datas=$model->find(array('select'=>'email','condition'=>'id=:user_id','params'=>array(':user_id'=>$user_id)));
				        	$register_uid = uc_user_register($_POST['User']['user_login'], $_POST['User']['password'],$uc_registe_datas->email);
				        }
				         //ucenter同步登录
					      list($uid, $username, $password, $email) = uc_user_login($_POST['User']['user_login'], $_POST['User']['password']);
					      if($uid > 0) {
				          $ucsynlogin = uc_user_synlogin($uid);
				         
				        }
				        $this->display('loginsuccess',array('redirect_url'=>$this->controller->createUrl("qa/index",array()),'ucsynlogin'=>$ucsynlogin));
				         exit;
            }
          }
           $this->display('login',array('model'=>$model,'ts'=>$ts,'login_type'=>$login_type));
        }else{
        $model=new User('login');
        if(isset($_POST['User'])){
            $model->attributes=$_POST['User'];
            $uc_result=$ucenter_class->register_ucenter_user($_POST['User']['user_login'],$_POST['User']['password']);
            if($uc_result<=0){
						if($uc_result == -1) {
							 $model->addError('user_login','用户名不存在');
            } elseif($uc_result == -2) {
          
	             $model->addError('password','密码不正确');
            } else {
	              $model->addError('user_login','登录错误');
            }
					}
					$get_errors=$model->getErrors();
            if(empty($get_errors)&&$model->validate("login") && $model->login()){
            	  $user_id=Yii::app()->user->id;
						    $login_time=$model->old_login_time;
				        $date=new Date();
				        $diff_date=$date->dateDiff(intval($login_time));
				        //一天跟新一次
				        if(abs($diff_date)>=1){
				    	    $credit=new Credit();
						      $user_login=Yii::app()->user->getName();
			            $credit_desc="会员:".$user_login.",在线登录赠送积分";
                  $credit->set_credit_vars($user_id,"login_per_time",'1',$credit_desc);
				        }
				        $returnUrl=Yii::app()->user->returnUrl;
				        if(is_array($returnUrl)){
				          $tem_redirect_url=array_shift($returnUrl);
				          $redirect_url=$this->controller->createUrl($tem_redirect_url,$returnUrl);
				        }else{
				        	$redirect_url=$returnUrl;
				        }
				        //登录时判断是否在ucenter中注册过
				       $uc_user_data = uc_get_user($_POST['User']['user_login']);
				        if(!$uc_user_data){
				          $uc_registe_datas=$model->find(array('select'=>'email','condition'=>'id=:user_id','params'=>array(':user_id'=>$user_id)));
				        	$registe_uid = uc_user_register($_POST['User']['user_login'], $_POST['User']['password'],$uc_registe_datas->email);
				        }
                //ucenter同步登录
					      list($uid, $username, $password, $email) = uc_user_login($_POST['User']['user_login'], $_POST['User']['password']);
					      if($uid > 0) {
				          $ucsynlogin = uc_user_synlogin($uid);
				          
				        }
				        $this->display('loginsuccess',array('redirect_url'=>$redirect_url,'ucsynlogin'=>$ucsynlogin));
				        exit;
            }
        }
         $this->display('login',array('model'=>$model,'ts'=>$ts,'login_type'=>$login_type));
      } 
    }
}
?>
