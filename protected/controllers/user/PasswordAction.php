<?php
class PasswordAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_PASSWORD,array());
    	$this->controller->init_page();
    	$this->controller->user_tag="password";
    	$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'修改密码')
      );
		$this->controller->pt($this->id,array());
    	return true;
    }
  
  protected function do_action(){
  	require_once('config.inc.php');
    require_once('uc_client/client.php');
		$user=new User("ChangePassword");
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		if(isset($_POST['User'])){
			$user->user_password=$_POST['User']['user_password'];
			$user_datas=$user->user_password_validate($user_id);
			if(!empty($user_datas)){
				 $user->password=$_POST['User']['password'];
				 $user->con_password=$_POST['User']['con_password'];
				if($user->validate()){
					 $update_user_datas['password']=Util::hc($user->password,$user_datas->salt);
					 $result=$user->update_table_datas($user_id,$update_user_datas,array());
					 if($result){
					   $change_user_datas=$user->find(array('select'=>'user_login','condition'=>'id=:user_id','params'=>array(':user_id'=>$user_id)));
					   $ucresult = uc_user_edit($change_user_datas->user_login, $_POST['User']['user_password'], $_POST['User']['password'], "");
					 }
					 $this->controller->f(CV::SUCCESS_PASSWORD);
					 
				}
			}
		}
		$this->display("user_password",array("model"=>$user));
  }
 
 
    
}
?>
