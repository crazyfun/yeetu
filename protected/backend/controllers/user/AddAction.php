<?php
class AddAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->init_page();
		return true;
	}
	protected function do_action(){	
		require_once('config.inc.php');
  	require_once('uc_client/client.php');
		$this->controller->bc(array("用户管理"=>array('/user/index'),'添加会员'));
		$model=new User("AdminRegiste");
		if(isset($_POST['User'])){
			if(!empty($_POST['User']['id'])){
				$model=$model->get_table_datas($_POST['User']['id']);
				$old_user_level=$model->level;
				$old_email=$model->email;
			}else{
				$model->user_active='2';
				$model->password=Util::randStr(6);
			  $model->con_password=$model->password;
			  $uid = uc_user_register($_POST['User']['user_login'],$model->password,$_POST['User']['email']);
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
			}
			$model->setScenario("AdminRegiste");
			$model->attributes=$_POST['User'];
		  $getErrors=$model->getErrors(); 
			if($model->validate()&&empty($getErrors)){
				$model->registe();
				if(empty($_POST['User']['id'])){
					$send_mail=new SendMail("Admin Registe");
					$result=$send_mail->send_admin_register_mail("",$model->email,$model->user_login,$model->con_password);
				}else{
					if($old_user_level!=$model->level){
						$service_link = Yii::app()->homeUrl.'/help/index/cid/2.html#q4';
			      $user_level_array=CV::$USER_LEVEL;
			      $account_level=$user_level_array[$model->level];
			      $send_mail=new SendMail("Account Upgrade");
			      $validate_flag=$model->validate_user_email();
		        if($validate_flag){
			        $send_mail->send_account_upgrade_mail("",$model->email,$model->user_login,$account_level,$service_link);
			      }
					}
					if($old_email!=$model->email){
						$ucresult = uc_user_edit($model->user_login,'','',$model->email,'1');
					}
				}
				$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$model=$model->get_table_datas($id,array());
			}
		}
		$this->display('add',array('model'=>$model));
	}
}
?>
