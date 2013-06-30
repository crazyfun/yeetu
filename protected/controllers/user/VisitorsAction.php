<?php
class VisitorsAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_VISITORS,array());
    	$this->controller->init_page();
    	$this->controller->user_tag='visitors';
    	$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'游客信息管理')
      );
		$this->controller->pt($this->id,array());
    	return true;
    }
   
  protected function do_action(){
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		$criteria=new CDbCriteria();
		$criteria->condition="t.create_id=:user_id AND t.contact_type=:contact_type";
		$criteria->params=array(':user_id'=>$user_id,':contact_type'=>'2');
		$criteria->order='t.create_time DESC';
		$user_contact=new Usercontact();
		$user_contact_number=$user_contact->count($criteria);
		$pages=new CPagination($user_contact_number);
		$pages->pageSize=20;
		$pages->applyLimit($criteria);//给$criteria->limit offset等符值
		$pages->params=array();
		$user_contact_datas=$user_contact->findAll($criteria);
		$this->display("user_visitors",array('pages'=>$pages,'user_contact_datas'=>$user_contact_datas));
  }
 
 
    
}
?>
