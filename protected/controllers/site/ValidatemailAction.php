<?php
class ValidatemailAction extends  BaseAction{
  
   protected function beforeAction(){
    if(Yii::app()->request->isAjaxRequest){
    	return true;
     }else{
     	return false;
     }
    }
  protected function do_action(){	
  	       $user_id=$_REQUEST['user_id'];
  	       $user_id=empty($user_id)?Yii::app()->user->id:$user_id;
  	       $user=new User();
  	       $user_datas=$user->find(array('select'=>'id,email,user_login,salt','condition'=>'id=:id','params'=>array(':id'=>$user_id)));
		       $send_mail=new SendMail("Edit Email");
			  	 $registe_active=$this->controller->createAbsoluteUrl("user/useractive",array('user_id'=>$user_id,'active_code'=>Util::hc($user_datas->email,$user_datas->salt)));
			  	 $registe_active=CHtml::link($registe_active,$registe_active);
			  	 $result=$send_mail->send_edit_mail("",$user_datas->email,$user_datas->user_login,$registe_active);
			  	 $json_array=array();
			  	 if($result){
			  	 	$json_array['result']='Y';
			  	 }else{
			  	 	$json_array['result']='N';
			  	 }
			  	 echo json_encode($json_array);
  }
}
?>
