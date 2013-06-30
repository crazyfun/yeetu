<?php
class UseractiveAction extends  BaseAction{
  
    protected function beforeAction(){
      $this->controller->init_page();
      $this->controller->pt($this->id,array());
    	return true;
    }

  protected function do_action(){
			$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		$active_code=$_GET['active_code'];
		$model=new User("EditEmail");
		$user_datas=$model->get_table_datas($user_id,array());
		$user_active=Util::hc($user_datas->email,$user_datas->salt);
		if($user_active==$active_code){
			 $update_array['email_validate']=2;
			 $model->update_table_datas($user_datas->id,$update_array);
			 $this->display('user_editemail3',array());
		}else{
			 $this->controller->f(CV::ERROR_CODE);
			 $this->display('user_editemailfailed',array('user_id'=>$user_id));
		}
  }
 
 
    
}
?>
