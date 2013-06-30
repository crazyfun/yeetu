<?php
class EditvisAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_page();
    	$this->controller->user_tag='visitors';
    	$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'常用游客信息')
      );
		$this->controller->pt($this->id,array());
    	return true;
    }
  
  protected function do_action(){
		$user_contact=new Usercontact();
		$user_contact_datas="";
		$user_id=$_GET['user_id'];
		$id=$_REQUEST['id'];
		if(empty($id)){
			$user_contact_datas=$user_contact;
			$user_contact_datas->create_id=$user_id;
		}else{
			$user_contact_datas=$user_contact->get_table_datas($id);
			$contact_telephone=$user_contact_datas->contact_telephone;
			$tem_contact_telephone=explode('-',$contact_telephone);
	
			if(count($tem_contact_telephone)>=2){
				$user_contact_datas->area_code=$tem_contact_telephone[0];
				$user_contact_datas->contact_telephone=$tem_contact_telephone[1];
			}
		}
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		if(isset($_POST['Usercontact'])){
	  	 $user_contact_datas->attributes=$_POST['Usercontact'];
	  	 $user_contact_datas->area_code=$_POST['Usercontact']['area_code'];
	  	 $user_contact_datas->contact_type='2';
	  	 if($user_contact_datas->validate()){
	  	 	   $tem_contact_telephone=$user_contact_datas->contact_telephone;
           $contact_telephone=(!empty($user_contact_datas->area_code)?($user_contact_datas->area_code."-"):"").$tem_contact_telephone;
           $user_contact_datas->contact_telephone=$contact_telephone;
	  	 	   $result=$user_contact_datas->insert_usercontact();
	  	 	   $user_contact_datas->contact_telephone=$tem_contact_telephone;
	  	 	   $this->controller->f(CV::SUCCESS_OPERATE);
	     }
	  }
		$this->display("user_editvis",array("model"=>$user_contact_datas));
  }
 
 
    
}
?>
