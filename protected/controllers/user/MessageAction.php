<?php
class MessageAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_ORDER,array());
		$this->controller->init_page();
		$this->controller->user_tag='message';
		$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,array('用户中心'=>array("user/index"),'我的站内信'));
		$this->controller->pt($this->id,array());
		return true;
	}

	protected function do_action(){
		$this->display("user_message",array());
  }
}
?>
