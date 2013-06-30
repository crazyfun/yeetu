<?php
class EditemailAction extends  BaseAction{
  
    protected function beforeAction(){
      $this->controller->init_page();
		  $this->controller->user_tag='information';
		  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'修改邮箱')
      );
		  $this->controller->pt($this->id,array());
    	return true;
    }

  
  protected function do_action(){
  	require_once('config.inc.php');
    require_once('uc_client/client.php');
    $user=new User("EditEmail");
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
	  $user_datas=$user->get_table_datas($user_id);
	  if(isset($_POST['User'])){
	  	 if(!empty($user_id)){
	  	 	$user=$user->get_table_datas($user_id);
	  	 }
	  	 $user->setScenario("EditEmail");
	  	 $user->id=$user_id;
	  	 $user->attributes=$_POST['User'];
	  	 $user->email_validate='1';
	  	 if($user->validate()){
	  	 	 if($_POST['User']['email']!=$user_datas->email){
			     $update_result=$user->insert_user();
			     if($update_result){
			     	 $change_user_datas=$user->find(array('select'=>'user_login','condition'=>'id=:user_id','params'=>array(':user_id'=>$user_id)));
					   $ucresult = uc_user_edit($change_user_datas->user_login,"","",$_POST['User']['email'],'1');
			     }
			     
			   	 $send_mail=new SendMail("Edit Email");
			  	 $registe_active=$this->controller->createAbsoluteUrl("user/useractive",array('user_id'=>$user_id,'active_code'=>Util::hc($_POST['User']['email'],$user_datas->salt)));
			  	 $registe_active=CHtml::link($registe_active,$registe_active);
			  	 $send_mail->send_edit_mail("",$_POST['User']['email'],$user_datas->user_login,$registe_active);
			     $this->display("user_editemail2",array("edit_email"=>$_POST['User']['email'],'user_id'=>$user_id));
			   }else{
			   	 $user->addError('email',"邮箱不能相同");
			   	 $this->display("user_editemail",array("user_datas"=>$user_datas,'model'=>$user));
			   }
			  
			 }else{
			     $this->display("user_editemail",array("user_datas"=>$user_datas,'model'=>$user));
			 }
	  }else{
		  $this->display("user_editemail",array("user_datas"=>$user_datas,'model'=>$user));
		}
   	
  }
  
}
?>
